<?php

namespace App\Livewire\Tax;

use Livewire\Component;
use App\Models\Tax;

class Edit extends Component
{
    public $name, $slug;
    public $rate;
    public $tax;

    public function mount($slug)
    {
        $this->tax = Tax::where('slug', $slug)
            ->firstOrFail();
        $this->name = $this->tax->name;
        $this->rate = $this->tax->rate;
        $this->slug = $this->tax->slug;
    }

    protected $rules = [
        'name' => 'required|string|max:255',
        'rate' => 'required|numeric|min:0',
    ];

    public function update()
    {
        $this->validate();

        $this->tax->update([
            'name' => $this->name,
            'rate'=>$this->rate,
        ]);

        session()->flash('success', 'Tax updated successfully!');
        return redirect()->route('tax.index');
    }

    public function render()
    {
        return view('livewire.tax.edit');
    }
}

