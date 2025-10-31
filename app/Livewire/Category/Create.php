<?php

namespace App\Livewire\Category;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;

class Create extends Component
{
    public $name;

    protected $rules = [
        'name' => 'required|string|max:255',
    ];

    public function save()
    {
        $this->validate();

        Category::create([
            'name' => $this->name,
            'slug' => Str::slug('cat'.'-'.$this->name.'-'.now()),
            'company_id' => auth()->user()->company_id,
        ]);

        session()->flash('success', 'Category created successfully!');
        return redirect()->route('category.index');
    }

    public function render()
    {
        return view('livewire.category.create');
    }
}

