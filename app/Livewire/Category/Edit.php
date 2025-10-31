<?php

namespace App\Livewire\Category;

use Livewire\Component;
use App\Models\Category;

class Edit extends Component
{
    public $name, $slug;
    public $category;

    public function mount($slug)
    {
        $this->category = Category::where('slug', $slug)
            ->firstOrFail();
        $this->name = $this->category->name;
        $this->slug = $this->category->slug;
    }

    protected $rules = [
        'name' => 'required|string|max:255',
    ];

    public function update()
    {
        $this->validate();

        $this->category->update([
            'name' => $this->name,
        ]);

        session()->flash('success', 'Category updated successfully!');
        return redirect()->route('category.index');
    }

    public function render()
    {
        return view('livewire.category.edit');
    }
}

