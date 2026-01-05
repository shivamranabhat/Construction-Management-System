<?php

namespace App\Livewire\Attendance;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $search = '';
    public $dateFilter = '';

    protected $queryString = ['search', 'dateFilter'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function delete($attendanceId)
    {
        $attendance = Attendance::findOrFail($attendanceId);

        $this->authorize('delete-attendance'); // optional

        $attendance->delete();

        session()->flash('success', 'Attendance record deleted.');
    }

    public function render()
    {
        $attendances = Attendance::query()
            ->with(['worker', 'project'])
            ->when($this->search, fn($q) => $q->whereHas('worker', fn($wq) => $wq->where('name', 'like', "%{$this->search}%"))
                ->orWhereHas('project', fn($pq) => $pq->where('name', 'like', "%{$this->search}%")))
            ->when($this->dateFilter, fn($q) => $q->whereDate('date', $this->dateFilter))
            ->latest('date')
            ->paginate($this->perPage);

        return view('livewire.attendance.index', compact('attendances'));
    }
}