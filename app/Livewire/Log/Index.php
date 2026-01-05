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

        if (Auth::user()->type !== 'Company') {
            session()->flash('error', 'Unauthorized.');
            return;
        }

        $log->approve(); // Deducts stock

        session()->flash('success', "Log #{$log->slug} approved and stock deducted.");
    }

    public function reject($logId)
    {
        $log = Log::findOrFail($logId);

        if (Auth::user()->type !== 'Company') {
            session()->flash('error', 'Unauthorized.');
            return;
        }

        if ($log->status !== 'pending') {
            session()->flash('error', 'Only pending logs can be rejected.');
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

        $this->authorize('delete-log');

        if ($log->status === 'approved') {
            session()->flash('error', 'Cannot delete approved log.');
            return;
        }

        $log->delete();

        session()->flash('success', "Log #{$log->slug} deleted successfully.");
    }

    public function render()
    {
        $logs = Log::query()
            ->when($this->search, function ($q) {
                $q->where('slug', 'like', "%{$this->search}%")
                  ->orWhere('date', 'like', "%{$this->search}%")
                  ->orWhereHas('project', fn($pq) => $pq->where('name', 'like', "%{$this->search}%"));
            })
            ->latest('date')
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.log.index', compact('logs'));
    }
}