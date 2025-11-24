<?php

namespace App\Livewire\Project;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;

    protected $paginationTheme = 'bootstrap'; // if using Bootstrap

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function delete($slug)
    {
        $project = Project::where('slug', $slug)
            ->where('company_id', Auth::user()->company_id)
            ->when(Auth::user()->type !== 'Company', function ($q) {
                // Regular users can only delete if assigned
                return $q->whereHas('users', fn($query) => $query->where('user_id', Auth::id()));
            })
            ->firstOrFail();

        $project->delete();
        session()->flash('success', 'Project deleted successfully!');
    }

    public function render()
    {
        $user = Auth::user();

        $projects = Project::query()
            ->when($user->type !== 'Company', function ($query) use ($user) {
                // Regular user → only show assigned projects
                return $query->whereHas('users', function ($q) use ($user) {
                    $q->where('user_id', $user->id);
                });
            })
            ->where('company_id', $user->company_id)
            ->where(function ($query) {
                $query->where('name', 'like', "%{$this->search}%")
                      ->orWhere('code', 'like', "%{$this->search}%")
                      ->orWhere('client', 'like', "%{$this->search}%");
            })
            ->orderByDesc('created_at')
            ->paginate($this->perPage);

        return view('livewire.project.index', compact('projects'));
    }
}