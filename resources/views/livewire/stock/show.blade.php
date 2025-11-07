<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Stock Details</h5>
                    <a href="{{route('stock.index')}}" class="btn btn-primary btn-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                        </svg>
                    </a>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label text-muted small">Item</label>
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-light rounded p-3">
                                    <i class="bi bi-box-seam text-primary" style="font-size:1.4rem"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0">{{ $stock->item->name }}</h5>
                                    <small class="text-muted">{{ $stock->item->unit ?? 'pcs' }}</small>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label text-muted small">Current Stock</label>
                            <div class="display-6 fw-bold text-{{ $stock->stock > 0 ? 'success' : 'danger' }}">
                                {{ $stock->stock }}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label text-muted small">Project</label>
                            <p class="mb-0">
                                <span class="badge bg-light text-dark">
                                    {{ $stock->project?->name }}
                                </span>
                            </p>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label text-muted small">Source Purchase</label>
                            <p class="mb-0">
                                @if($stock->purchaseProduct?->purchase)
                                <a href="#" class="text-decoration-none">
                                    #{{ $stock->purchaseProduct->purchase->purchase_number }}
                                    <small class="text-muted">
                                        ({{ $stock->purchaseProduct->purchase->vendor?->name }})
                                    </small>
                                </a>
                                @else
                                <span class="text-muted">Manual / Initial Stock</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h6 class="mb-0">Quick Stats</h6>
                </div>
                <div class="list-group list-group-flush">
                    <div class="list-group-item d-flex justify-content-between">
                        <span>Total Received</span>
                        <strong>{{ $stock->stock }}</strong>
                    </div>
                    <div class="list-group-item d-flex justify-content-between">
                        <span>Unit</span>
                        <strong>{{ $stock->item->unit ?? 'pcs' }}</strong>
                    </div>
                    <div class="list-group-item d-flex justify-content-between">
                        <span>Last Updated</span>
                        <strong>{{ \Carbon\Carbon::parse($stock->updated_at)->format('d M Y') }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>