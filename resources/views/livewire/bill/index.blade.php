<div class="container-fluid py-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1 fw-bold text-dark">Bills</h2>
            <p class="text-muted mb-0">Manage all vendor bills in one place</p>
        </div>
        <div>
            <a href="{{ route('bill.create') }}" class="btn btn-primary shadow-sm px-4">
                <i class="bi bi-plus-lg me-2"></i>New Bill
            </a>
        </div>
    </div>

    <!-- Search & Filters -->
    <div class="card shadow-sm mb-4 border-0">
        <div class="card-body">
            <div class="row g-3 align-items-center">
                <div class="col-md-6">
                    <div class="position-relative">
                        <i class="bi bi-search position-absolute top-50 start-3 translate-middle-y text-muted"></i>
                        <input 
                            type="text" 
                            wire:model.live.debounce.500ms="search" 
                            class="form-control ps-5" 
                            placeholder="Search by bill number or vendor..."
                            style="border-radius: 12px;">
                    </div>
                </div>
                <div class="col-md-3">
                    <select class="form-select" wire:model.live="status_filter">
                        <option value="">All Status</option>
                        <option value="draft">Draft</option>
                        <option value="paid">Paid</option>
                        <option value="partial">Partial</option>
                    </select>
                </div>
                <div class="col-md-3 text-end">
                    <small class="text-muted">{{ $bills->total() }} bills</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Bills Grid -->
    @if($bills->count() > 0)
        <div class="row g-4">
            @foreach($bills as $bill)
                <div class="col-md-6 col-xl-4">
                    <div class="card h-100 shadow-sm border-0 hover-shadow transition-all" 
                         style="border-radius: 16px; transition: all 0.3s ease;">
                        <div class="card-body p-4">
                            <!-- Header: Bill Number & Status -->
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h5 class="mb-1 fw-bold text-primary">
                                        <a href="{{ route('bill.edit', $bill) }}" class="text-decoration-none">
                                            #{{ $bill->bill_number }}
                                        </a>
                                    </h5>
                                    <small class="text-muted">
                                        {{ $bill->bill_date->format('d M Y') }}
                                    </small>
                                </div>
                                <span class="badge rounded-pill px-3 py-2
                                    @if($bill->status === 'paid') bg-success
                                    @elseif($bill->status === 'partial') bg-warning text-dark
                                    @else bg-secondary @endif
                                    ">
                                    {{ ucfirst($bill->status) }}
                                </span>
                            </div>

                            <!-- Vendor & Project -->
                            <div class="mb-3">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bi bi-building text-muted me-2"></i>
                                    <span class="fw-semibold">{{ $bill->vendor->name ?? 'Unknown Vendor' }}</span>
                                </div>
                                @if($bill->project)
                                    <div class="d-flex align-items-center text-muted small">
                                        <i class="bi bi-folder me-2"></i>
                                        {{ $bill->project->name }}
                                    </div>
                                @endif
                            </div>

                            <!-- Amount -->
                            <div class="d-flex justify-content-between align-items-end">
                                <div>
                                    <p class="text-muted mb-1 small">Total Amount</p>
                                    <h4 class="mb-0 fw-bold text-dark">
                                        ${{ number_format($bill->total_price, 2) }}
                                    </h4>
                                </div>
                                <div>
                                    <a href="{{ route('bill.edit', $bill) }}" 
                                       class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Footer: Entered By -->
                        <div class="card-footer bg-light border-0 px-4 py-3">
                            <small class="text-muted">
                                <i class="bi bi-person-circle me-1"></i>
                                {{ $bill->enteredBy?->name ?? 'System' }}
                            </small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-5">
            {{ $bills->links('vendor.livewire.bootstrap') }}
        </div>
    @else
        <!-- Empty State -->
        <div class="text-center py-5">
            <div class="mb-4">
                <i class="bi bi-receipt display-1 text-muted opacity-25"></i>
            </div>
            <h4 class="text-muted mb-3">No bills found</h4>
            <p class="text-muted">Start by creating your first vendor bill.</p>
            <a href="{{ route('bill.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-2"></i>Create First Bill
            </a>
        </div>
    @endif
</div>
@push('styles')
<style>
.hover-shadow {
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
}
.hover-shadow:hover {
    transform: translateY(-4px);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}
.transition-all {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}
</style>
@endpush
