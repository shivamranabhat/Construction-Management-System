<div class="col-xl-12">
    <div class="card custom-card">
        <div class="card-header justify-content-between">
            <div class="card-title">Fuel Logs</div>
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
                                placeholder="Search vehicle, project or notes..."
                                wire:model.live.debounce.300ms="search">
                        </label>

                        @can('create-fuel-log')
                        <a href="{{ route('fuel-log.create') }}" class="btn btn-sm btn-primary">
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
                            <th>Vehicle</th>
                            <th>Project</th>
                            <th>Liters</th>
                            <th>Price/Liter</th>
                            <th>Total Cost</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody wire:poll.keep-alive>
                        @forelse($fuelLogs as $index => $log)
                        <tr>
                            <td>{{ $fuelLogs->firstItem() + $index }}</td>
                            <td>{{ \Carbon\Carbon::parse($log->date)->format('d M Y') }}</td>
                            <td>{{ $log->vehicle->registration_number ?? '—' }}</td>
                            <td>{{ $log->project?->name ?? '—' }}</td>
                            <td>{{ $log->liters }}</td>
                            <td>{{ number_format($log->price_per_liter, 2) }}</td>
                            <td><strong>{{ number_format($log->total_cost, 2) }}</strong></td>
                            <td x-data="{ openModal: false }">
                                <div class="hstack gap-2">
                                    @can('update-fuel-log')
                                    <a href="{{ route('fuel-log.edit', $log->slug) }}"
                                        class="btn btn-icon btn-warning-transparent rounded-pill" title="Edit Fuel Log">
                                        <i class="ri-edit-line"></i>
                                    </a>
                                    @else
                                    <button disabled class="btn btn-icon rounded-pill">
                                        <i class="ri-edit-line"></i>
                                    </button>
                                    @endcan

                                    @can('delete-fuel-log')
                                    <button type="button" @click="openModal = true"
                                        class="btn btn-icon btn-danger-transparent rounded-pill"
                                        title="Delete Fuel Log">
                                        <i class="ri-delete-bin-line"></i>
                                    </button>
                                    @else
                                    <button disabled class="btn btn-icon rounded-pill">
                                        <i class="ri-delete-bin-line"></i>
                                    </button>
                                    @endcan
                                </div>

                                <div x-show="openModal" class="modal-backdrop" style="display: none;">
                                    <div class="modal-box">
                                        <div class="modal-header p-0">
                                            <div class="modal-title">Delete Fuel Log?</div>
                                            <button class="close-btn" @click="openModal = false">×</button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete this fuel log?<br>
                                            <strong>{{ $log->vehicle?->registration_number ?? 'Unknown' }}</strong> —
                                            {{ \Carbon\Carbon::parse($log->date)->format('d M Y') }} — {{ $log->liters }} L
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-cancel" @click="openModal = false">Cancel</button>
                                            <button class="btn btn-delete" wire:click="delete({{ $log->id }})"
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
                                No fuel logs found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="row mt-4">
                <div class="col-sm-12 col-md-5">
                    <div class="dataTables_info">
                        Showing {{ $fuelLogs->firstItem() }} to {{ $fuelLogs->lastItem() }}
                        of {{ $fuelLogs->total() }} entries
                    </div>
                </div>
                <div class="col-sm-12 col-md-7">
                    <div class="dataTables_paginate paging_simple_numbers d-flex justify-content-end">
                        {{ $fuelLogs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>