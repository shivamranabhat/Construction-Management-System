<?php


namespace App\Livewire\Boq;

use Livewire\Component;
use App\Models\Boq;
use App\Models\Project;

class Preview extends Component
{
    public $slug;
    public $project;
    public $boqs = [];
    public $tax = null;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->loadBoqData();
    }

    public function loadBoqData()
    {
        // Get the main BOQ (parent_id null) using slug
        $mainBoq = Boq::where('slug', $this->slug)
            ->whereNull('parent_id')
            ->with(['project', 'tax'])
            ->firstOrFail();

        // Set project
        $this->project = $mainBoq->project;

        // Set tax if enabled
        $this->tax = $mainBoq->tax;

        // Load full hierarchy: Main → Sub → Items
        $this->boqs = Boq::where('slug', $this->slug)
            ->whereNull('parent_id')
            ->with([
                'children' => function ($query) {
                    $query->orderBy('serial_number');
                },
                'children.children' => function ($query) {
                    $query->orderBy('serial_number');
                }
            ])
            ->get();
    }

    public function render()
    {
        return view('livewire.boq.preview');
    }
}
