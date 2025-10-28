<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Project;

class SpecificProjectSwitcher extends Component
{
    public $projects;
    public $activeProjectId;

    public function mount()
    {
        $this->projects = Project::all();
        $this->activeProjectId = session('active_project_id');
    }

    public function setActiveProject($projectId)
    {
        session(['active_project_id' => $projectId]);
        $this->activeProjectId = $projectId;

        // Emit event so other components can react
        $this->dispatch('projectSwitched', $projectId);
    }

    public function clearActiveProject()
    {
        session()->forget('active_project_id');
        $this->dispatch('projectSwitched', null); // reset other components
    }


    public function render()
    {
        $projects = Project::all();
        return view('livewire.specific-project-switcher', compact('projects'));
    }
}
