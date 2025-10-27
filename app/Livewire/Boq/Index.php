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

    public function delete($slug)
    {
        $boq = Boq::where('slug', $slug)->get();
        foreach ($boq as $item) {
            $item->delete();
        }
        session()->flash('success', 'BOQ deleted successfully!');
    }

    public function render()
    {
        $projects = Project::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('code', 'like', '%' . $this->search . '%')
                    ->orWhere('client', 'like', '%' . $this->search . '%');
            })
            ->has('boqs') // Only include projects with BOQs
            ->with(['boqs' => function ($query) {
                $query->whereNull('parent_id')
                    ->where('company_id', auth()->user()->company_id)
                    ->with('children');
            }])
            ->paginate($this->perPage);

        return view('livewire.boq.index', compact('projects'));
    }
}