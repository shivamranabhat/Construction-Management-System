<?php

namespace App\Livewire\Vendor;

use Livewire\Component;
use App\Models\Vendor;
use App\Models\Company;
use Illuminate\Support\Str;

class Edit extends Component
{
    public $vendor;
    public $name, $email, $phone, $address, $PAN, $company_id;

    public function mount($slug)
    {
        $this->vendor = Vendor::where('slug', $slug)->firstOrFail();
        $this->fill($this->vendor->only('name', 'email', 'phone', 'address', 'PAN', 'company_id'));
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'PAN' => 'nullable|string|max:20',
        ]);

        $this->vendor->update([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'PAN' => $this->PAN,
            'company_id' => auth()->user()->company_id,
            'slug' => Str::slug($this->name) . '-' . now(),
        ]);

        return redirect()->route('vendors.index')->with('success', 'Vendor updated successfully!');
    }

    public function render()
    {
        return view('livewire.vendor.edit');
    }
}
