<?php

namespace App\Livewire\Account;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\User;
use App\Models\Role;
use App\Models\Project;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class Create extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $image;
    public $existingImage = null;

    public $selectedRole = '';
    public $selectedProjects = []; // Array of selected project IDs

    public $roles = [];
    public $projects = [];

    public function mount()
    {
        $this->roles = Role::all(['id', 'name']);

        // Load only projects from the authenticated user's company
        $this->projects = Project::where('company_id', auth()->user()->company_id)
            ->select('id', 'name', 'code')
            ->orderBy('name')
            ->get();
    }

    public function store()
    {
        $this->validate([
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required|string|min:8|confirmed',
            'password_confirmation'=> 'required',
            'selectedRole'          => 'nullable|exists:roles,id',
            'selectedProjects'      => 'nullable|array',
            'selectedProjects.*'    => 'exists:projects,id',
            'image'                 => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $this->image ? $this->image->store('users', 'public') : null;

        $slug = Str::slug('acc-' . $this->name . '-' . now()->timestamp);

        $user = User::create([
            'name'       => $this->name,
            'email'      => $this->email,
            'password'   => Hash::make($this->password),
            'image'      => $imagePath,
            'company_id' => auth()->user()->company_id,
            'type'       => 'user',
            'slug'       => $slug,
        ]);

        // Assign role
        if ($this->selectedRole) {
            $user->roles()->sync([$this->selectedRole]);
        }

        // Assign projects via checkboxes
        if (!empty($this->selectedProjects)) {
            $pivotData = array_map(fn($projectId) => [
                'project_id' => $projectId,
                'user_id'    => $user->id,
                'company_id' => auth()->user()->company_id,
                'created_at' => now(),
                'updated_at' => now(),
            ], $this->selectedProjects);

            DB::table('project_user')->insert($pivotData);
        }

        session()->flash('success', 'Account created successfully!');

        return redirect()->route('account.index');
    }

    public function render()
    {
        return view('livewire.account.create');
    }
}