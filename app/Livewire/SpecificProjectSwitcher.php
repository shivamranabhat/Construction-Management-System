<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Project;
use App\Models\ProjectUser;
use Illuminate\Support\Facades\Auth;

class SpecificProjectSwitcher extends Component
{
    public $projects = [];
    public $activeProjectId;

    public function mount()
    {
        $this->loadUserProjects();
        $this->activeProjectId = session('active_project_id');
    }

    /**
     * Load only projects the current user is assigned to
     */
    public function loadUserProjects()
    {
        $user = Auth::user();

        // If user is Company type → show ALL projects (god mode)
        if ($user->type === 'Company') {
            $this->projects = Project::where('company_id', $user->company_id)
                ->orderBy('name')
                ->get();
        } else {
            // Regular user → only assigned projects via ProjectUser pivot
            $this->projects = Project::whereHas('users', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->where('company_id', $user->company_id)
            ->orderBy('name')
            ->get();
        }
    }

    public function setActiveProject($projectId)
    {
        // Optional: validate that user actually has access
        $allowedProjectIds = $this->projects->pluck('id')->toArray();

        if (!in_array($projectId, $allowedProjectIds)) {
            return; // silently ignore or show error
        }

        session(['active_project_id' => $projectId]);
        $this->activeProjectId = $projectId;

        // Notify other components
        $this->dispatch('projectSwitched', $projectId);
    }

    public function clearActiveProject()
    {
        session()->forget('active_project_id');
        $this->activeProjectId = null;
        $this->dispatch('projectSwitched', null);
    }

    public function render()
    {
        // Re-load in render() to stay fresh on Livewire updates
        $this->loadUserProjects();

        return view('livewire.specific-project-switcher');
    }
}