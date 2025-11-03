<?php

namespace App\Livewire\Boq;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Project;
use App\Models\Boq;

class Index extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $search = '';

    public function delete($project_id)
    {
        Boq::where('project_id', $project_id)->delete();
        session()->flash('success', 'BOQ deleted successfully!');
        $this->resetPage();
    }

    public function render()
    {
        $projects = Project::query()
            ->when($this->search, function ($q) {
                $q->where('name', 'like', "%{$this->search}%")
                  ->orWhere('code', 'like', "%{$this->search}%")
                  ->orWhere('client', 'like', "%{$this->search}%");
            })
            ->has('boqs') // Only projects with BOQ
            ->with(['boqs' => fn($q) => $q->whereNull('parent_id')
                ->select('id', 'project_id', 'slug')
            ])
            ->paginate($this->perPage);

        return view('livewire.boq.index', compact('projects'));
    }
}