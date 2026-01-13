<div class="col-xl-12">
    <div class="card custom-card">
        <div class="card-header justify-content-between">
            <div class="card-title">Vehicles</div>
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
                                placeholder="Search reg. number, make, model..."
                                wire:model.live.debounce.300ms="search">
                        </label>
                        <a href="{{ route('vehicle.create') }}" class="btn btn-sm btn-primary">
                            <i class="bi bi-plus-circle"></i> New
                        </a>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table text-nowrap">
                    <thead class="table-primary">
                        <tr>
                            <th>S.N.</th>
                            <th>Registration No</th>
                            <th>Make</th>
                            <th>Model</th>
                            <th>Fuel Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($vehicles as $index => $vehicle)
                        <tr>
                            <td>{{ $vehicles->firstItem() + $index }}</td>
                            <td><strong>{{ $vehicle->registration_number }}</strong></td>
                            <td>{{ $vehicle->make ?? '—' }}</td>
                            <td>{{ $vehicle->model ?? '—' }}</td>
                            <td>{{ $vehicle->fuel_type ?? '—' }}</td>
                            <td x-data="{ openModal: false }">
                                <div class="hstack gap-2">
                                    @can('update-vehicle')
                                    <a href="{{ route('vehicle.edit', $vehicle->slug) }}"
                                        class="btn btn-icon btn-warning-transparent rounded-pill" title="Edit Vehicle">
                                        <i class="ri-edit-line"></i>
                                    </a>
                                    @else
                                    <button disabled class="btn btn-icon btn-danger-transparent rounded-pill">
                                        <i class="ri-edit-line"></i>
                                    </button>
                                    @endcan

                                    @can('delete-vehicle')
                                    <button type="button" @click="openModal = true"
                                        class="btn btn-icon btn-danger-transparent rounded-pill" title="Delete Vehicle">
                                        <i class="ri-delete-bin-line"></i>
                                    </button>
                                    @else
                                    <button disabled class="btn btn-icon btn-danger-transparent rounded-pill">
                                        <i class="ri-delete-bin-line"></i>
                                    </button>
                                    @endcan
                                </div>

                                <div x-show="openModal" class="modal-backdrop" style="display: none;">
                                    <div class="modal-box">
                                        <div class="modal-header p-0">
                                            <div class="modal-title">Delete Vehicle?</div>
                                            <button class="close-btn" @click="openModal = false">×</button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete <strong>{{ $vehicle->registration_number
                                                }}</strong>?<br>
                                            This action cannot be undone.
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-cancel" @click="openModal = false">Cancel</button>
                                            <button class="btn btn-delete" wire:click="delete({{ $vehicle->id }})"
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
                                No vehicles found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="row mt-4">
                <div class="col-sm-12 col-md-5">
                    <div class="dataTables_info">
                        Showing {{ $vehicles->firstItem() }} to {{ $vehicles->lastItem() }}
                        of {{ $vehicles->total() }} entries
                    </div>
                </div>
                <div class="col-sm-12 col-md-7">
                    <div class="dataTables_paginate paging_simple_numbers d-flex justify-content-end">
                        {{ $vehicles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>