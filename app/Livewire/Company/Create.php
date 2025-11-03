<?php

namespace App\Livewire\Company;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Create extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $image;

    public function store()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'image' => 'nullable|image|max:2048',
            
        ]);

        // Create company
        $company = Company::create([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
        ]);

        // Handle image upload
        $imagePath = $this->image ? $this->image->store('users', 'public') : null;

        // Create default user for company
        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'image' => $imagePath,
            'type' => 'company',
            'company_id' => $company->id,
            'slug' => Str::slug('com'.'-'.$this->name.'-'.now()),
        ]);
        return redirect()->route('company.index')->with('success', 'Company created successfully!');
    }

    public function render()
    {
        return view('livewire.company.create');
    }
}
