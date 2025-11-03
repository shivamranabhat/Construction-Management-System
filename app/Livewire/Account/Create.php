<?php

namespace App\Livewire\Account;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class Create extends Component
{
    use WithFileUploads;

    public $name, $email, $password, $password_confirmation;
    public $selectedRole, $image, $existingImage;
    public $roles;

    public function mount()
    {
        $this->roles = Role::all();
        $this->existingImage = null;
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|string|min:6',
            'selectedRole' => 'nullable|exists:roles,id',
            'image' => 'nullable|image|max:2048', // max 2MB
        ]);

        $imagePath = $this->image ? $this->image->store('users', 'public') : null;
        $slug = Str::slug('acc'.'-'.$this->name.'-'.now());
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'image' => $imagePath,
            'company_id' => auth()->user()->company_id,
            'type'=>'user',
            'slug' => $slug,
        ]);

        if($this->selectedRole) {
        $user->roles()->sync([$this->selectedRole]);
        }

        return redirect()->route('account.index')->with('success', 'Account created successfully!');
    }

    public function render()
    {
        return view('livewire.account.create');
    }
}
