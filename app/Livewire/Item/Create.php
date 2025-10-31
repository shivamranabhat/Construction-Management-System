<?php

namespace App\Livewire\Item;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\Component;

class Create extends Component
{
    public $name = '';
    public $category_id = '';
    public $category_name = '';
    public $type = 'Product';
    public $description = '';
    public $unit = '';
    public $reorder_level = 0;
    public $categories = [];

    protected $rules = [
        'name' => 'required|string|max:255',
        'type' => 'required|string|max:100',
        'category_id' => 'nullable|exists:categories,id',
        'description' => 'nullable|string',
        'unit' => 'required|string|max:50',
        'reorder_level' => 'required|integer|min:0',
    ];

    /** Mount the component */
    public function mount()
    {
        $this->loadCategories();
    }

    /** Load categories for the current company */
    public function loadCategories()
    {
        $this->categories = Category::where('company_id', auth()->user()->company_id)
            ->orderBy('name')
            ->get();
    }

    /** Add a new category from the modal */
    public function addCategory()
    {
        $this->validateOnly('category_name', [
            'category_name' => 'required|string|max:255',
        ]);

        $category = Category::create([
            'name'       => $this->category_name,
            'company_id' => auth()->user()->company_id,
            'slug'       => Str::slug('cat-' . $this->category_name . '-' . now()),
        ]);

        // Reload categories to keep collection consistent
        $this->loadCategories();

        // Auto-select the newly added category
        $this->category_id = $category->id;

        // Reset modal field
        $this->reset('category_name');

        // Optional success message
        session()->flash('success', 'Category added successfully.');
    }

    /** Save the new item */
    public function save()
    {
        $this->validate();

        Item::create([
            'name'           => $this->name,
            'type'           => $this->type,
            'category_id'    => $this->category_id,
            'description'    => $this->description,
            'unit'           => $this->unit,
            'reorder_level'  => $this->reorder_level,
            'company_id'     => auth()->user()->company_id,
            'slug'           => Str::slug('item-' . $this->name . '-' . now()),
        ]);

        return redirect()->route('item.index')->with('success', 'Item created successfully.');
    }

    public function render()
    {
        return view('livewire.item.create', [
            'categories' => $this->categories,
        ]);
    }
}
