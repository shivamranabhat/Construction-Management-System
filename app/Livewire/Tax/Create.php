<?php

namespace App\Livewire\Tax;

use Livewire\Component;
use App\Models\Tax;
use Illuminate\Support\Str;

class Create extends Component
{
    public $name;
    public $rate;

    protected $rules = [
        'name' => 'required|string|max:255',
        'rate' => 'required|numeric|min:0',
    ];

    public function save()
    {
        $this->validate();

        Tax::create([
            'name' => $this->name,
            'rate'=>$this->rate,
            'slug' => Str::slug('tax'.'-'.$this->name.'-'.now()),
            'company_id' => auth()->user()->company_id,
        ]);

        session()->flash('success', 'Tax created successfully!');
        return redirect()->route('tax.index');
    }

    public function render()
    {
        return view('livewire.tax.create');
    }
}

