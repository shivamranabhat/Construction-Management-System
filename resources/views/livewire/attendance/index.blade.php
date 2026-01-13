<div class="col-xl-12">
    <div class="card custom-card">
        <div class="card-header justify-content-between">
            <div class="card-title">Worker Attendance</div>
        </div>

        <div class="card-body">
            <div class="row mb-2">
                <div class="col-sm-12 col-md-4">
                    <div class="dataTables_length">
                        <label style="display:inline-flex; gap:0.5rem; align-items:center">
                            Show
                            <select wire:model.live="perPage" class="form-select form-select-sm w-auto">
                                <option>10</option>
                                <option>25</option>
                                <option>50</option>
                                <option>100</option>
                            </select>
                            entries
                        </label>
                    </div>
                </div>

                <div class="col-sm-12 col-md-8">
                    <div class="d-flex justify-content-end gap-2 flex-wrap">
                        <input type="date" wire:model.live="dateFilter" class="form-control form-control-sm w-auto"
                            placeholder="Filter by Date">

                        <input type="search" wire:model.live.debounce.300ms="search"
                            class="form-control form-control-sm w-auto" placeholder="Search worker/project...">

                        @can('create-attendance')
                        <a href="{{ route('attendance.create') }}" class="btn btn-sm btn-primary">
                            <i class="bi bi-plus-circle"></i> Mark Attendance
                        </a>
                        @endcan
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table text-nowrap">
                    <thead class="table-primary">
                        <tr>
                            <th>S.N.</th>
                            <th>Date</th>
                            <th>Worker</th>
                            <th>Project</th>
                            <th>In Time</th>
                            <th>Out Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody wire:poll.keep-alive>
                        @forelse($attendances as $index => $attendance)
                        <tr>
                            <td>{{ $attendances->firstItem() + $index }}</td>
                            <td>{{ \Carbon\Carbon::parse($attendance->date)->format('d M Y') }}</td>
                            <td>{{ $attendance->worker->name }}</td>
                            <td>{{ $attendance->project->name }}</td>
                            <td>{{ $attendance->in_time ? \Carbon\Carbon::parse($attendance->in_time)->format('h:i A') : '—' }}</td>
                            <td>{{ $attendance->out_time ?\Carbon\Carbon::parse($attendance->out_time)->format('h:i A') : '—' }}</td>
                           
                            <td x-data="{ openModal: false }">
                                <div class="hstack gap-2">
                                    @can('update-attendance')
                                    <a href="{{ route('attendance.edit', $attendance->slug) }}"
                                        class="btn btn-icon btn-warning-transparent rounded-pill" title="Edit">
                                        <i class="ri-edit-line"></i>
                                    </a>
                                    @else
                                    <button type="button" disabled
                                        class="btn btn-icon btn-warning-transparent rounded-pill">
                                        <i class="ri-edit-line"></i>
                                    </button>
                                    @endcan

                                    @can('delete-attendance')
                                    <button type="button" @click="openModal = true"
                                        class="btn btn-icon btn-danger-transparent rounded-pill" title="Delete">
                                        <i class="ri-delete-bin-line"></i>
                                    </button>
                                    @else
                                    <button type="button" disabled
                                        class="btn btn-icon btn-danger-transparent rounded-pill">
                                        <i class="ri-delete-bin-line"></i>
                                    </button>
                                    @endcan
                                </div>

                                <div x-show="openModal" class="modal-backdrop" style="display: none;" wire:ignore>
                                    <div class="modal-box">
                                        <div class="modal-header p-0">
                                            <div class="modal-title">Delete Attendance?</div>
                                            <button class="close-btn" @click="openModal = false">×</button>
                                        </div>
                                        <div class="modal-body">
                                            Delete attendance for <strong>{{ $attendance->worker->name }}</strong>
                                            on {{ \Carbon\Carbon::parse($attendance->date)->format('d M Y') }}?
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-cancel" @click="openModal = false">Cancel</button>
                                            <button class="btn btn-delete"
                                                wire:click="delete({{ $attendance->id }})"
                                                @click="openModal = false">
                                                Delete
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">No attendance records found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="row mt-4">
                <div class="col-sm-12 col-md-5">
                    <div class="dataTables_info">
                        Showing {{ $attendances->firstItem() }} to {{ $attendances->lastItem() }}
                        of {{ $attendances->total() }} entries
                    </div>
                </div>
                <div class="col-sm-12 col-md-7">
                    <div class="dataTables_paginate paging_simple_numbers d-flex justify-content-end">
                        {{ $attendances->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>