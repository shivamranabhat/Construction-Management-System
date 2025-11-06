<?php

namespace App\Livewire\Vendor;

use Livewire\Component;
use App\Models\Vendor;
use Illuminate\Support\Str;

class Create extends Component
{
    public $name, $email, $phone, $address, $PAN;

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'PAN' => 'nullable|string|max:20',
        ]);

        Vendor::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'PAN' => $this->PAN,
            'company_id' => auth()->user()->company_id,
            'slug' => Str::slug($this->name) . '-' . now(),
        ]);

        return redirect()->route('vendor.index')->with('success', 'Vendor created successfully!');
    }

    public function render()
    {
        return view('livewire.vendor.create');
    }
}
