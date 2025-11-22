<div class="container-fluid py-4">
    <div
        class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <div>
            <h4 class="mb-1 fw-bold text-dark">Material Requisitions</h4>
            <p class="text-muted mb-0">Manage and track all material requests</p>
        </div>
        <a href="{{ route('requisition.create') }}" class="btn btn-primary d-flex align-items-center gap-2 shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle"
                viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                <path
                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
            </svg>
            New Requisition
        </a>
    </div>


    <!-- Filters -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-4">
            <div class="row g-3 align-items-end">
                <div class="col-md-5">
                    <label class="form-label small text-muted fw-medium">Search</label>
                    <input type="text" wire:model.live.debounce.500ms="search" class="form-control"
                        placeholder="Requisition # or purpose...">
                </div>
                <div class="col-md-4">
                    <label class="form-label small text-muted fw-medium">Status</label>
                    <select wire:model.live="status" class="form-select">
                        <option value="">All Status</option>
                        <option value="draft">Draft</option>
                        <option value="pending_pm">Pending PM</option>
                        <option value="pm_approved">PM Approved</option>
                        <option value="owner_approved">Owner Approved</option>
                        <option value="rejected">Rejected</option>
                    </select>
                </div>
                <div class="col-md-3 text-md-end">
                    <small class="text-muted">Showing {{ $requisitions->firstItem() }}–{{ $requisitions->lastItem() }}
                        of {{ $requisitions->total() }}</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            @if($requisitions->count())
            <div class="table-responsive">
                <table class="table table-hover mb-0" wire:poll-keep-alive>
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">S.N.</th>
                            <th>Req #</th>
                            <th>Project</th>
                            <th>Required By</th>
                            <th>Items</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($requisitions as $index=>$req)
                        <tr>
                            <td class="ps-4">{{ $requisitions->firstItem()+$index }}</td>
                            <td>
                                <div class="fw-bold text-primary">#{{ $req->requisition_number }}</div>
                                <small class="text-muted">{{ $req->created_at->format('d M Y') }}</small>
                            </td>
                            <td>{{ $req->project->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($req->required_date)->format('d M Y') }}</td>
                            <td>{{ $req->items->count() }} items</td>
                            <td>
                                @php
                                $badge = match($req->status) {
                                'draft' => 'bg-secondary',
                                'pending_pm', 'pending_procurement', 'pending_owner' => 'bg-warning text-dark',
                                'pm_approved', 'procurement_approved', 'owner_approved' => 'bg-info',
                                'po_created', 'delivered' => 'bg-success',
                                'rejected' => 'bg-danger',
                                default => 'bg-light text-dark',
                                };
                                @endphp
                                <span class="badge {{ $badge }} px-3 py-2">
                                    {{ ucwords(str_replace('_', ' ', $req->status)) }}
                                </span>
                            </td>
                            <td x-data="{ openModal: false }">
                                <div class="d-flex gap-2">
                                    @can('update-requisition')
                                    <a href="{{ route('requisition.edit', $req->id) }}"
                                        class="btn btn-icon btn-info-transparent rounded-pill">
                                        <i class="ri-edit-line"></i>
                                    </a>
                                    @else
                                    <button class="btn btn-icon btn-info-transparent rounded-pill" disabled>
                                        <i class="ri-edit-line"></i>
                                    </button>
                                    @endcan
                                    <a href="{{ route('requisition.show', $req->id) }}"
                                        class="btn btn-icon btn-info-transparent rounded-pill">
                                        <i class="ri-eye-line"></i>
                                    </a>

                                    @can('delete-requisition')
                                    <button type="button" @click="openModal = true"
                                        class="btn btn-icon btn-danger-transparent rounded-pill">
                                        <i class="ri-delete-bin-line"></i>
                                    </button>
                                    @else
                                    <button type="button" class="btn btn-icon btn-danger-transparent rounded-pill"
                                        disabled>
                                        <i class="ri-delete-bin-line"></i>
                                    </button>
                                    @endcan
                                </div>
                                <div x-show="openModal" class="modal-backdrop" style="display: none;">
                                    <div class="modal-box">
                                        <div class="modal-header p-0">
                                            <div class="modal-title">Confirm Delete</div>
                                            <button class="close-btn" @click="openModal = false">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete?
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-cancel" @click="openModal = false">Cancel</button>
                                            <button class="btn btn-delete" wire:click="delete('{{ $req->id }}')"
                                                @click="openModal = false">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer bg-white">
                {{ $requisitions->links() }}
            </div>
            @else
            <div class="text-center py-5">
                <p class="text-muted">No requisitions found.</p>
                <a href="{{ route('requisition.create') }}" class="btn btn-primary">Create First Requisition</a>
            </div>
            @endif
        </div>
    </div>
</div>