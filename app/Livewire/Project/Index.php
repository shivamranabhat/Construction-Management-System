<?php

namespace App\Livewire\Project;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Project;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function delete($slug)
    {
        $project = Project::where('slug', $slug)->first();
        if ($project) {
            $project->delete();
            session()->flash('success', 'Project deleted successfully!');
        }
    }

    public function render()
    {
        $projects = Project::where('name', 'like', "%{$this->search}%")
            ->orWhere('code', 'like', "%{$this->search}%")
            ->orWhere('client', 'like', "%{$this->search}%")
            ->orderByDesc('created_at')
            ->paginate($this->perPage);

        return view('livewire.project.index', compact('projects'));
    }
}
