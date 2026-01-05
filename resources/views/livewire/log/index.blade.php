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
                    <tbody>
                        @forelse($logs as $index => $log)
                        <tr>
                            <td>{{ $logs->firstItem() + $index }}</td>
                            <td>{{ \Carbon\Carbon::parse($log->date)->format('d M Y') }}</td>
                            <td>{{ $log->project->name ?? '—' }}</td>
                            <td>{{ $log->manpower_count }}</td>
                            <td>{{ $log->hours }}</td>
                            <td>
                                @switch($log->status)
                                    @case('approved')
                                        <span class="badge bg-success">Approved</span>
                                        @break
                                    @case('pending')
                                        <span class="badge bg-warning">Pending</span>
                                        @break
                                    @case('rejected')
                                        <span class="badge bg-danger">Rejected</span>
                                        @break
                                @endswitch
                            </td>
                            <td>{{ $log->created_at->format('d M Y') }}</td>

                            <td x-data="{ openModal: false, actionType: '' }">
                                <div class="hstack gap-2">
                                    <!-- View -->
                                    <a href="{{ route('log.show', $log->slug) }}"
                                       class="btn btn-icon btn-info-transparent rounded-pill"
                                       title="View Details">
                                        <i class="ri-eye-line"></i>
                                    </a>

                                    <!-- Edit (pending or rejected) -->
                                    @can('update-log')
                                        @if(in_array($log->status, ['pending', 'rejected']))
                                            <a href="{{ route('log.edit', $log->slug) }}"
                                               class="btn btn-icon btn-warning-transparent rounded-pill"
                                               title="Edit Log">
                                                <i class="ri-edit-line"></i>
                                            </a>
                                        @else
                                            <button disabled class="btn btn-icon btn-warning-transparent rounded-pill"
                                                    title="Cannot edit approved log">
                                                <i class="ri-edit-line"></i>
                                            </button>
                                        @endif
                                    @endcan

                                    <!-- Company Admin: Approve & Reject (only pending) -->
                                    @if(Auth::user()->type === 'Company')
                                        @if($log->status === 'pending')
                                            <button type="button" wire:click="approve({{ $log->id }})"
                                                    class="btn btn-icon btn-success-transparent rounded-pill"
                                                    title="Approve & Deduct Stock">
                                                <i class="ri-check-line"></i>
                                            </button>

                                            <button type="button"
                                                    @click="openModal = true; actionType = 'reject'"
                                                    class="btn btn-icon btn-danger-transparent rounded-pill"
                                                    title="Reject Log">
                                                <i class="ri-close-line"></i>
                                            </button>
                                        @endif
                                    @endif

                                    <!-- Non-Company User: Delete (pending or rejected) -->
                                    @if(Auth::user()->type !== 'Company')
                                        @can('delete-log')
                                            @if(in_array($log->status, ['pending', 'rejected']))
                                                <button type="button"
                                                        @click="openModal = true; actionType = 'delete'"
                                                        class="btn btn-icon btn-danger-transparent rounded-pill"
                                                        title="Delete Log">
                                                    <i class="ri-delete-bin-line"></i>
                                                </button>
                                            @else
                                                <button disabled class="btn btn-icon btn-danger-transparent rounded-pill"
                                                        title="Cannot delete approved log">
                                                    <i class="ri-delete-bin-line"></i>
                                                </button>
                                            @endif
                                        @endcan
                                    @endif
                                </div>

                                <!-- Dynamic Confirmation Modal -->
                                <div x-show="openModal" class="modal-backdrop" style="display: none;">
                                    <div class="modal-box">
                                        <div class="modal-header p-0">
                                            <div class="modal-title">
                                                <span x-text="actionType === 'reject' ? 'Reject' : 'Delete'"></span> Log?
                                            </div>
                                            <button class="close-btn" @click="openModal = false">×</button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to
                                            this log?
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-cancel" @click="openModal = false">
                                                Cancel
                                            </button>
                                            <button class="btn btn-delete"
                                                    wire:click="actionType === 'reject' ? reject({{ $log->id }}) : delete({{ $log->id }})"
                                                    @click="openModal = false">
                                                <span x-text="actionType === 'reject' ? 'Reject' : 'Delete'"></span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">
                                No logs found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="row mt-4">
                <div class="col-sm-12 col-md-5">
                    <div class="dataTables_info">
                        Showing {{ $logs->firstItem() }} to {{ $logs->lastItem() }}
                        of {{ $logs->total() }} entries
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