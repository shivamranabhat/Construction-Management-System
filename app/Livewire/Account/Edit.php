<?php

namespace App\Livewire\Account;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Edit extends Component
{
    use WithFileUploads;

    public $slug;
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $image;
    public $existingImage;
    public $selectedRole;
    public $user;

    public function mount($slug)
    {
        $this->user = User::where('slug', $slug)->whereDoesntHave('roles', function ($query) {
                    $query->where('name', 'Super Admin');
                })->firstOrFail();
        $this->slug = $slug;
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->existingImage = $this->user->image;
        $this->selectedRole = optional($this->user->roles->first())->id;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->user->id,
            'password' => 'nullable|confirmed|min:6',
            'selectedRole' => 'required|exists:roles,id',
            'image' => 'nullable|image|max:2048',
        ]);

        $role = Role::find($this->selectedRole);
        $slug = Str::slug('acc'.'-'.$this->name.'-'.now());
        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'slug' => $slug,
        ];

        if ($this->password) {
            $data['password'] = Hash::make($this->password);
        }

        if ($this->image) {
            $data['image'] = $this->image->store('users', 'public');
        }

        $this->user->update($data);

        // Update role
        $this->user->roles()->sync([$this->selectedRole]);

        // Reset password and image preview
        $this->reset(['password', 'password_confirmation', 'image']);
        $this->existingImage = $this->user->image;

        return redirect()->route('account.index')->with('success', 'Account updated successfully!');
    }

    public function render()
    {
        $roles = Role::latest()->get();
        return view('livewire.account.edit', compact('roles'));
    }
}
