<div class="container-fluid py-4" wire:poll.keep-alive>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1 fw-bold">Purchase</h2>
            <p class="text-muted mb-0">Record stock receipts from vendors</p>
        </div>
        <a href="{{ route('purchase.create') }}" class="btn btn-primary shadow-sm">
            <i class="bi bi-plus-circle"></i> New Purchase
        </a>
    </div>

    <div class="card shadow-sm mb-4 border-0">
        <div class="card-body">
            <div class="row g-3 align-items-center">
                <div class="col-md-6">
                    <div class="position-relative">
                        <i class="bi bi-search position-absolute top-50 start-3 translate-middle-y text-muted"></i>
                        <input type="text" wire:model.live.debounce.500ms="search" class="form-control ps-5"
                            placeholder="Search purchase...">
                    </div>
                </div>
                <div class="col-md-3">
                    <select wire:model.live="status_filter" class="form-select">
                        <option value="">All Status</option>
                        <option value="draft">Draft</option>
                        <option value="received">Received</option>
                        <option value="partial">Partial</option>
                    </select>
                </div>
                <div class="col-md-3 text-end">
                    <small class="text-muted">{{ $purchases->total() }} purchases</small>
                </div>
            </div>
        </div>
    </div>

    @if($purchases->count())
    <div class="row g-4">
        @foreach($purchases as $purchase)
        <div class="col-md-6 col-xl-4" x-data="{ openModal: false }">
            <div class="card h-100 shadow-sm border-0 hover-shadow">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h5 class="mb-1 fw-bold text-success">
                                <a href="{{ route('purchase.edit', $purchase) }}" class="text-decoration-none">
                                    #{{ $purchase->purchase_number }}
                                </a>
                            </h5>
                            <small class="text-muted">{{ \Carbon\Carbon::parse($purchase->purchase_date)->format('d M
                                Y') }}</small>
                        </div>

                        <div class="dropdown" wire:ignore>
                            <button class="btn btn-sm p-1" data-bs-toggle="dropdown">
                                <i class="bi bi-three-dots-vertical"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">

                                <a href="{{ route('purchase.edit', $purchase->slug) }}" class="dropdown-item">
                                    Edit
                                </a>
                                <button class="dropdown-item text-danger" @click="openModal = true">
                                    Delete
                                </button>
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
                                        <button class="btn btn-delete" wire:click="delete('{{ $purchase->slug }}')"
                                            @click="openModal = false">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-building text-muted me-2"></i>
                            <span class="fw-semibold">{{ $purchase->vendor->name }}</span>
                        </div>
                        @if($purchase->project)
                        <div class="d-flex align-items-center text-muted small">
                            <i class="bi bi-folder me-2"></i>
                            {{ $purchase->project->name }}
                        </div>
                        @endif
                    </div>
                    <div class="d-flex justify-content-between align-items-end mb-2">
                        <div>
                            <p class="text-muted mb-1 small">Total Amount</p>
                            <h4 class="mb-0 fw-bold">${{ number_format($purchase->total_price, 2) }}</h4>
                        </div>

                    </div>
                    <small class="text-muted">
                        Entered by {{ $purchase->enteredBy?->name ?? 'Unknown' }}
                        @if($purchase->updated_by)
                        <br>Updated by {{ $purchase->updater?->name ?? 'Unknown' }}
                        @endif
                    </small>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center bg-light border-0 px-4 py-3">
                    <small class="text-primary">
                        Note: {{ $purchase->notes ?? 'No notes for now.' }}
                    </small>
                    <span class="badge rounded-pill px-3 py-2
                                    @if($purchase->status === 'received') bg-success
                                    @elseif($purchase->status === 'partial') bg-warning text-dark
                                    @else bg-secondary @endif">
                        {{ ucfirst($purchase->status) }}
                    </span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="mt-5">{{ $purchases->links() }}</div>
    @else
    
    <div class="text-center py-5">
            <div class="card border-0 shadow-sm mx-auto">
                <div class="card-body p-5">
                    <div class="mb-4">
                        <i class="bi bi-cart display-1 text-primary"></i>
                    </div>
                    <h3 class="text-dark mb-3">No Purchases Yet</h3>
                    <p class="text-muted mb-4">
                        Start tracking your purchases by creating your first one.
                    </p>
                    <a href="{{ route('purchase.create') }}"
                       class="btn btn-primary btn-lg d-inline-flex align-items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                             class="bi bi-plus-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                        </svg>
                        Create First Purchase
                    </a>
                </div>
            </div>
        </div>
    @endif
</div>

@push('styles')
<style>
    .hover-shadow {
        transition: all 0.2s;
    }

    .hover-shadow:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
    }
</style>
@endpush