<div class="col-xl-12">
    <div class="card custom-card">
        <div class="card-header justify-content-between">
            <div class="card-title">Daily Logs</div>
        </div>

        <div class="card-body">

            <div class="row mb-2">
                <div class="col-sm-12 col-md-6">
                    <div class="dataTables_length">
                        <label style="display:inline-flex; gap:0.5rem; align-items:center">
                            Show
                            <select wire:model.live="perPage" class="form-select form-select-sm w-auto">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                            entries
                        </label>
                    </div>
                </div>

                <div class="col-sm-12 col-md-6">
                    <div class="dataTables_filter d-flex justify-content-end align-items:center gap-2">
                        <label>
                            <input type="search" class="form-control form-control-sm"
                                placeholder="Search by date, slug or project..."
                                wire:model.live.debounce.300ms="search">
                        </label>

                        @can('create-log')
                        <a href="{{ route('log.create') }}" class="btn btn-sm btn-primary">
                            <i class="bi bi-plus-circle"></i> New
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
                            <th>Project</th>
                            <th>Manpower</th>
                            <th>Hours</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody wire:poll.keep-alive>
                        @forelse($logs as $index => $log)
                        <tr>
                            <td>{{ $logs->firstItem() + $index }}</td>
                            <td>{{ \Carbon\Carbon::parse($log->date)->format('d M Y') }}</td>
                            <td>{{ $log->project->name ?? '—' }}</td>
                            <td>{{ $log->manpower_count }}</td>
                            <td>{{ $log->hours }}</td>
                            <td>
                                @switch($log->status)
                                @case('approved') <span class="badge bg-success">Approved</span> @break
                                @case('pending') <span class="badge bg-warning">Pending</span> @break
                                @case('rejected') <span class="badge bg-danger">Rejected</span> @break
                                @endswitch
                            </td>
                            <td>{{ \Carbon\Carbon::parse($log->created_at)->format('d M Y') }}</td>

                            <td x-data="{ openModal: false, actionType: '', logId: {{ $log->id }} }">
                                <div class="hstack gap-2">
                                    <a href="{{ route('log.show', $log->slug) }}"
                                        class="btn btn-icon btn-info-transparent rounded-pill" title="View">
                                        <i class="ri-eye-line"></i>
                                    </a>

                                    @can('update-log')
                                    @if($log->status === 'pending')
                                    <a href="{{ route('log.edit', $log->slug) }}"
                                        class="btn btn-icon btn-warning-transparent rounded-pill" title="Edit">
                                        <i class="ri-edit-line"></i>
                                    </a>
                                    @else
                                    <button disabled class="btn btn-icon btn-warning-transparent rounded-pill">
                                        <i class="ri-edit-line"></i>
                                    </button>
                                    @endif

                                    @endcan

                                    @if(Auth::user()->type === 'Company' && $log->status === 'pending')
                                    <button wire:click="approve({{ $log->id }})"
                                        class="btn btn-icon btn-success-transparent rounded-pill" title="Approve">
                                        <i class="ri-check-line"></i>
                                    </button>

                                    <button @click="openModal = true; actionType = 'reject'; logId = {{ $log->id }}"
                                        class="btn btn-icon btn-danger-transparent rounded-pill" title="Reject">
                                        <i class="ri-close-line"></i>
                                    </button>
                                    @endif

                                    @if(Auth::user()->type !== 'Company')
                                    @can('delete-log')
                                    @if(in_array($log->status, ['pending', 'rejected']))
                                    <button @click="openModal = true; actionType = 'delete'; logId = {{ $log->id }}"
                                        class="btn btn-icon btn-danger-transparent rounded-pill" title="Delete">
                                        <i class="ri-delete-bin-line"></i>
                                    </button>
                                    @else
                                    <button disabled class="btn btn-icon btn-danger-transparent rounded-pill">
                                        <i class="ri-delete-bin-line"></i>
                                    </button>
                                    @endif
                                    @endcan
                                    @endif
                                </div>

                                <div x-show="openModal" class="modal-backdrop" style="display: none;" wire:ignore>
                                    <div class="modal-box">
                                        <div
                                            class="modal-header p-0 d-flex justify-content-between align-items-center mb-3">
                                            <div class="modal-title fs-5">
                                                <span
                                                    x-text="actionType === 'reject' ? 'Reject Log' : 'Delete Log'"></span>?
                                            </div>
                                            <button class="close-btn btn btn-sm" @click="openModal = false">×</button>
                                        </div>

                                        <div class="modal-body">
                                            <p>Are you sure you want to <strong
                                                    x-text="actionType === 'reject' ? 'reject' : 'permanently delete'"></strong>
                                                this log?</p>
                                        </div>

                                        <div class="modal-footer d-flex gap-2 justify-content-end">
                                            <button class="btn btn-outline-secondary"
                                                @click="openModal = false">Cancel</button>

                                            <template x-if="actionType === 'reject'">
                                                <button class="btn btn-danger" wire:click="reject(logId)"
                                                    @click="openModal = false">
                                                    Reject
                                                </button>
                                            </template>

                                            <template x-if="actionType === 'delete'">
                                                <button class="btn btn-danger" wire:click="delete(logId)"
                                                    @click="openModal = false">
                                                    Delete
                                                </button>
                                            </template>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">No logs found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="row mt-4">
                <div class="col-sm-12 col-md-5">
                    <div class="dataTables_info">
                        Showing {{ $logs->firstItem() }} to {{ $logs->lastItem() }} of {{ $logs->total() }} entries
                    </div>
                </div>
                <div class="col-sm-12 col-md-7">
                    <div class="dataTables_paginate paging_simple_numbers d-flex justify-content-end">
                        {{ $logs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>