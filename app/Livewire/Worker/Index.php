<?php

namespace App\Livewire\Worker;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Worker;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $search = '';

    protected $queryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function delete($workerId)
    {
        $worker = Worker::findOrFail($workerId);

        $worker->delete();

        session()->flash('success', "Worker '{$worker->name}' deleted successfully.");
    }

    public function render()
    {
        $workers = Worker::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', "%{$this->search}%")
                      ->orWhere('phone', 'like', "%{$this->search}%")
                      ->orWhere('role', 'like', "%{$this->search}%");
                })->orWhereHas('project', function ($q) {
                    $q->where('name', 'like', "%{$this->search}%");
                });
            })
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.worker.index', compact('workers'));
    }
}