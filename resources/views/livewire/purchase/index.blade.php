<div class="container-fluid py-4">
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
                        <input type="text" wire:model.live.debounce.500ms="search" class="form-control ps-5" placeholder="Search purchase...">
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
                <div class="col-md-6 col-xl-4">
                    <div class="card h-100 shadow-sm border-0 hover-shadow">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h5 class="mb-1 fw-bold text-success">
                                        <a href="{{ route('purchase.edit', $purchase) }}" class="text-decoration-none">
                                            #{{ $purchase->purchase_number }}
                                        </a>
                                    </h5>
                                    <small class="text-muted">{{ \Carbon\Carbon::parse($purchase->purchase_date)->format('d M Y') }}</small>
                                </div>
                                <span class="badge rounded-pill px-3 py-2
                                    @if($purchase->status === 'received') bg-success
                                    @elseif($purchase->status === 'partial') bg-warning text-dark
                                    @else bg-secondary @endif">
                                    {{ ucfirst($purchase->status) }}
                                </span>
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
                            <div class="d-flex justify-content-between align-items-end">
                                <div>
                                    <p class="text-muted mb-1 small">Total Amount</p>
                                    <h4 class="mb-0 fw-bold">${{ number_format($purchase->total_price, 2) }}</h4>
                                </div>
                                <a href="{{ route('purchase.edit', $purchase) }}" class="btn btn-outline-primary btn-sm rounded-pill">
                                    Edit
                                </a>
                            </div>
                        </div>
                        <div class="card-footer bg-light border-0 px-4 py-3">
                            <small class="text-muted">
                                Entered by {{ $purchase->enteredBy?->name ?? 'Unknown' }}
                                @if($purchase->updated_by)
                                    <br>Updated by {{ $purchase->updater?->name ?? 'Unknown' }}
                                @endif
                            </small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-5">{{ $purchases->links() }}</div>
    @else
        <div class="text-center py-5">
            <i class="bi bi-cart display-1 text-muted opacity-25"></i>
            <h4 class="text-muted mb-3">No purchases yet</h4>
            <a href="{{ route('purchase.create') }}" class="btn btn-primary">Create First Purchase</a>
        </div>
    @endif
</div>

@push('styles')
<style>
.hover-shadow { transition: all 0.2s; }
.hover-shadow:hover { transform: translateY(-4px); box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1); }
</style>
@endpush