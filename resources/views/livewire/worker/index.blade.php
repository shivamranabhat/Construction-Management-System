<div class="col-xl-12">
    <div class="card custom-card">
        <div class="card-header justify-content-between">
            <div class="card-title">Workers</div>
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
                    <div class="dataTables_filter d-flex justify-content-end align-items-center gap-2">
                        <label>
                            <input type="search" class="form-control form-control-sm"
                                placeholder="Search name, phone, role or project..."
                                wire:model.live.debounce.300ms="search">
                        </label>

                        @can('create-worker')
                        <a href="{{ route('worker.create') }}" class="btn btn-sm btn-primary">
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
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Project</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($workers as $index => $worker)
                        <tr>
                            <td>{{ $workers->firstItem() + $index }}</td>
                            <td>{{ $worker->name }}</td>
                            <td>{{ $worker->phone ?? '—' }}</td>
                            <td>{{ $worker->role ?? '—' }}</td>
                            <td>{{ $worker->project->name ?? '—' }}</td>
                            <td x-data="{ openModal: false }">
                                <div class="hstack gap-2">
                                    @can('update-worker')
                                    <a href="{{ route('worker.edit', $worker->slug) }}"
                                        class="btn btn-icon btn-warning-transparent rounded-pill" title="Edit Worker">
                                        <i class="ri-edit-line"></i>
                                    </a>
                                    @else
                                    <button type="button" disabled
                                        class="btn btn-icon btn-warning-transparent rounded-pill">
                                        <i class="ri-edit-line"></i>
                                    </button>
                                    @endcan

                                    @can('delete-worker')
                                    <button type="button" @click="openModal = true"
                                        class="btn btn-icon btn-danger-transparent rounded-pill" title="Delete Worker">
                                        <i class="ri-delete-bin-line"></i>
                                    </button>
                                    @else
                                    <button type="button" disabled
                                        class="btn btn-icon btn-danger-transparent rounded-pill">
                                        <i class="ri-delete-bin-line"></i>
                                    </button>
                                    @endcan
                                </div>

                                <!-- Delete Confirmation Modal -->
                                <div x-show="openModal" class="modal-backdrop" style="display: none;">
                                    <div class="modal-box">
                                        <div class="modal-header p-0">
                                            <div class="modal-title">Delete Worker?</div>
                                            <button class="close-btn" @click="openModal = false">×</button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete <strong>{{ $worker->name }}</strong>?<br>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-cancel" @click="openModal = false">Cancel</button>
                                            <button class="btn btn-delete" wire:click="delete({{ $worker->id }})"
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
                            <td colspan="6" class="text-center text-muted py-4">
                                No workers found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="row mt-4">
                <div class="col-sm-12 col-md-5">
                    <div class="dataTables_info">
                        Showing {{ $workers->firstItem() }} to {{ $workers->lastItem() }}
                        of {{ $workers->total() }} entries
                    </div>
                </div>
                <div class="col-sm-12 col-md-7">
                    <div class="dataTables_paginate paging_simple_numbers d-flex justify-content-end">
                        {{ $workers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>