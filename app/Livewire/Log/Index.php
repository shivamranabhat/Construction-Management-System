<?php

namespace App\Livewire\Log;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Log;
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

    public function approve($logId)
    {
        $log = Log::findOrFail($logId);

        // Only Company admins can approve
        if (Auth::user()->type !== 'Company') {
            session()->flash('error', 'Unauthorized action.');
            return;
        }

        $log->approve(); // This method deducts stock

        session()->flash('success', "Log #{$log->slug} approved and stock updated.");
    }

    public function reject($logId)
    {
        $log = Log::findOrFail($logId);
        if (Auth::user()->type !== 'Company') {
            session()->flash('error', 'Unauthorized action.');
            return;
        }
        $log->update(['status' => 'rejected']);
        session()->flash('warning', "Log #{$log->slug} has been rejected.");
    }
    public function delete($logId)
    {
        $log = Log::findOrFail($logId);

        if (Auth::user()->type === 'Company') {
            session()->flash('error', 'Company admins cannot delete logs.');
            return;
        }

        if ($log->status === 'approved') {
            session()->flash('error', 'Cannot delete an approved log.');
            return;
        }

        $log->delete();
        session()->flash('success', "Log #{$log->slug} deleted successfully.");
    }

    public function render()
    {
        $logs = Log::query()
            ->when($this->search, function ($query) {
                $query->where('date', 'like', "%{$this->search}%")
                      ->orWhere('slug', 'like', "%{$this->search}%")
                      ->orWhereHas('project', fn($q) => $q->where('name', 'like', "%{$this->search}%"));
            })
            ->orderByDesc('date')
            ->orderByDesc('created_at')
            ->paginate($this->perPage);
        return view('livewire.log.index', [
            'logs' => $logs,
        ]);
    }
}