<?php

namespace App\Livewire\Item;

use App\Models\Item;
use App\Models\Category;
use Livewire\Component;
use Livewire\Attributes\On;

class CreateModal extends Component
{
    public $show = false;
    public $index = 0;

    // Item fields
    public $type = 'Product';
    public $name = '';
    public $category_id = '';
    public $unit = 'pcs';
    public $reorder_level = 0;
    public $description = '';

    // Category modal
    public $openCategoryModal = false;
    public $category_name = '';

    public $categories = []; // Initialize as empty array

    public function mount()
    {
        $this->loadCategories(); // Always load on mount
    }

    #[On('open-add-item-modal')]
    public function open($payload)
    {
        $this->index = $payload['index'] ?? 0;
        $this->name = $payload['name'] ?? '';
        $this->reset(['type', 'category_id', 'unit', 'reorder_level', 'description', 'category_name', 'openCategoryModal']);
        $this->loadCategories();
        $this->show = true;
    }

    public function loadCategories()
    {
        $companyId = auth()->user()->company_id ?? 1;
        $this->categories = Category::where('company_id', $companyId)
            ->orderBy('name')
            ->get()
            ->toArray(); // Ensure it's an array
    }

    public function addCategory()
    {
        $this->validate([
            'category_name' => 'required|string|max:255',
        ]);

        $companyId = auth()->user()->company_id ?? 1;

        $category = Category::create([
            'name' => $this->category_name,
            'company_id' => $companyId,
            'slug' => \Illuminate\Support\Str::slug($this->category_name . '-' . now()->format('YmdHis')),
        ]);

        $this->category_id = $category->id;
        $this->category_name = '';
        $this->openCategoryModal = false;
        $this->loadCategories();
    }

    public function save()
    {
        $this->validate([
            'type' => 'required|in:Product,Service',
            'name' => 'required|string|max:255',
            'unit' => 'required|string|max:50',
            'reorder_level' => 'required|integer|min:0',
        ]);

        $companyId = auth()->user()->company_id ?? 1;

        $item = Item::create([
            'name' => $this->name,
            'type' => $this->type,
            'category_id' => $this->category_id ?: null,
            'unit' => $this->unit,
            'reorder_level' => $this->reorder_level,
            'description' => $this->description,
            'company_id' => $companyId,
            'slug' => \Illuminate\Support\Str::slug($this->name . '-' . now()->format('YmdHis')),
        ]);

        $this->dispatch('item-created', [
            'index' => $this->index,
            'item' => $item->toArray()
        ]);

        $this->reset();
        $this->show = false;
    }

    public function render()
    {
        return view('livewire.item.create-modal');
    }
}