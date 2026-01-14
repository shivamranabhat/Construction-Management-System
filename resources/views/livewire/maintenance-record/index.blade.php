<div class="col-xl-12">
    <div class="card custom-card">
        <div class="card-header justify-content-between">
            <div class="card-title">Maintenance Records</div>
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
                                placeholder="Search description, provider, vehicle..."
                                wire:model.live.debounce.300ms="search">
                        </label>
                        <a href="{{ route('maintenance-record.create') }}" class="btn btn-sm btn-primary">
                            <i class="bi bi-plus-circle"></i> New Record
                        </a>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table text-nowrap">
                    <thead class="table-primary">
                        <tr>
                            <th>S.N.</th>
                            <th>Date</th>
                            <th>Vehicle</th>
                            <th>Project</th>
                            <th>Type</th>
                            <th>Cost</th>
                            <th>Service Provider</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody wire:poll.keep-alive>
                        @forelse($records as $index => $record)
                        <tr>
                            <td>{{ $records->firstItem() + $index }}</td>
                            <td>{{ \Carbon\Carbon::parse($record->date)->format('d M Y') }}</td>
                            <td>{{ $record->vehicle->registration_number ?? '—' }}</td>
                            <td>{{ $record->project?->name ?? '—' }}</td>
                            <td>{{ $record->type ?? '—' }}</td>
                            <td><strong>{{ number_format($record->cost, 2) }}</strong></td>
                            <td>{{ $record->service_provider ?? '—' }}</td>
                            <td x-data="{ openModal: false }">
                                <div class="hstack gap-2">
                                    @can('update-vehicle')
                                    <a href="{{ route('maintenance-record.edit', $record->slug) }}"
                                        class="btn btn-icon btn-warning-transparent rounded-pill" title="Edit Record">
                                        <i class="ri-edit-line"></i>
                                    </a>
                                    @else
                                    <button class="btn btn-icon btn-secondary-transparent rounded-pill" title="Edit Record"
                                        disabled>
                                        <i class="ri-edit-line"></i>
                                    </button>
                                    @endcan

                                    @can('delete-vehicle')
                                    <button type="button" @click="openModal = true"
                                        class="btn btn-icon btn-danger-transparent rounded-pill" title="Delete Record">
                                        <i class="ri-delete-bin-line"></i>
                                    </button>
                                    @else
                                    <button class="btn btn-icon btn-secondary-transparent rounded-pill" title="Delete Record"
                                        disabled>
                                        <i class="ri-delete-bin-line"></i>
                                    </button>
                                    @endcan
                                </div>

                                <div x-show="openModal" class="modal-backdrop" style="display: none;">
                                    <div class="modal-box">
                                        <div class="modal-header p-0">
                                            <div class="modal-title">Delete Maintenance Record?</div>
                                            <button class="close-btn" @click="openModal = false">×</button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete this record?
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-cancel" @click="openModal = false">Cancel</button>
                                            <button class="btn btn-delete" wire:click="delete({{ $record->id }})"
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
                            <td colspan="8" class="text-center text-muted py-4">
                                No maintenance records found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="row mt-4">
                <div class="col-sm-12 col-md-5">
                    <div class="dataTables_info">
                        Showing {{ $records->firstItem() }} to {{ $records->lastItem() }}
                        of {{ $records->total() }} entries
                    </div>
                </div>
                <div class="col-sm-12 col-md-7">
                    <div class="dataTables_paginate paging_simple_numbers d-flex justify-content-end">
                        {{ $records->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>