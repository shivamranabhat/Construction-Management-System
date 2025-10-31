<?php

namespace App\Livewire\Company;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Edit extends Component
{
    use WithFileUploads;

    public $company;
    public $name;
    public $slug;
    public $email;
    public $password;
    public $password_confirmation;
    public $image;
    public $existingImage;

    public function mount($slug)
    {
        $this->company = Company::where('slug', $slug)->firstOrFail();
        $this->name = $this->company->name;
        $this->slug = $this->company->slug;

        $admin = $this->company->users->first();
        $this->email = $admin->email ?? '';
        $this->existingImage = $admin->image ?? null;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . optional($this->company->users->first())->id,
            'password' => 'nullable|confirmed|min:6',
            'image' => 'nullable|image|max:2048',
        ]);

        // Update company
        $this->company->update([
            'name' => $this->name,
            'slug' => Str::slug('com'.'-'.$this->name.'-'.now()),
        ]);

        $admin = $this->company->users->first();

        $imagePath = $this->image ? $this->image->store('users', 'public') : $this->existingImage;

        // Update admin
        if ($admin) {
            $admin->update([
                'name' => $this->name,
                'email' => $this->email,
                'image' => $imagePath,
                'password' => $this->password ? Hash::make($this->password) : $admin->password,
            ]);
        }
        
        return redirect()->route('company.index')->with('success', 'Company updated successfully!');
    }

    public function render()
    {
        return view('livewire.company.edit');
    }
}
