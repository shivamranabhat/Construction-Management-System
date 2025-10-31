<?php

namespace App\Livewire\Item;

use Livewire\Component;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Support\Str;

class Edit extends Component
{
    public $slug;
    public $name = '';
    public $category_id = '';
    public $type = 'Product';
    public $description = '';
    public $unit = '';
    public $reorder_level = 0;

    public function mount($slug)
    {
        $this->slug = $slug;
        $item = Item::where('slug', $slug)->firstOrFail();

        $this->name = $item->name;
        $this->category_id = $item->category_id;
        $this->type = $item->type;
        $this->description = $item->description;
        $this->unit = $item->unit;
        $this->reorder_level = $item->reorder_level;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'type' => 'required|in:Product,Service',
            'description' => 'nullable|string',
            'unit' => 'required|string|max:50',
            'reorder_level' => 'required|integer|min:0',
        ];
    }

    public function update()
    {
        $this->validate();

        $item = Item::where('slug', $this->slug)->firstOrFail();

        $item->update([
            'name' => $this->name,
            'category_id' => $this->category_id,
            'type' => $this->type,
            'description' => $this->description,
            'unit' => $this->unit,
            'reorder_level' => $this->reorder_level,
            'slug' => Str::slug($this->name . '-' . uniqid()),
        ]);

        session()->flash('success', 'Item updated successfully.');
        return redirect()->route('item.index');
    }

    public function render()
    {
        $categories = Category::orderBy('name')->get();
        return view('livewire.item.edit', compact('categories'));
    }
}
