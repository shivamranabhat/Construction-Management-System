<div class="container-fluid py-4" wire:loading.remove>
    <!-- Header -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <div>
            <h4 class="mb-1 text-dark fw-bold">Payment History</h4>
            <p class="text-muted mb-0">Track all incoming and outgoing payments</p>
        </div>
        <a href="{{ route('payment.create') }}" class="btn btn-primary d-flex align-items-center gap-2 shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
            </svg>
            Record Payment
        </a>
    </div>

    <!-- Filters & Search -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-4">
            <div class="row g-3 align-items-end">
                <div class="col-md-5">
                    <label class="form-label text-muted small fw-medium">Search</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search text-muted" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                            </svg>
                        </span>
                        <input 
                            type="text" 
                            wire:model.live.debounce.500ms="search" 
                            class="form-control border-start-0 ps-0" 
                            placeholder="Bill #, reference, method..." 
                            aria-label="Search payments">
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="form-label text-muted small fw-medium">Per Page</label>
                    <select wire:model.live="perPage" class="form-select">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
                <div class="col-md-4 text-md-end">
                    <small class="text-muted">
                        Showing {{ $payments->firstItem() }}–{{ $payments->lastItem() }} of {{ $payments->total() }} payments
                    </small>
                </div>
            </div>
        </div>
    </div>

    <!-- Payments Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0" wire:poll.keep-alive>
            @if($payments->count())
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light text-dark small">
                            <tr>
                                <th class="ps-4">S.N.</th>
                                <th class="ps-4">Date</th>
                                <th>Bill</th>
                                <th class="text-end">Amount</th>
                                <th>Method</th>
                                <th>Status</th>
                                <th class="pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($payments as $payment)
                            <tr class="border-bottom">
                                <td>
                                    <div class="fw-medium ps-4">{{ $payments->firstItem() + $loop->index }}</div>
                                </td>
                                <!-- Date -->
                                <td class="ps-4 text-nowrap">
                                    <div class="fw-medium">{{ $payment->payment_date->format('d M Y') }}</div>
                                    <small class="text-muted">{{ $payment->payment_date->diffForHumans() }}</small>
                                </td>

                                <!-- Bill -->
                                <td>
                                    <a href="{{ route('bill.edit', $payment->slug) }}" class="text-decoration-none fw-medium text-primary">
                                        #{{ $payment->bill->bill_number }}
                                    </a>
                                    <div class="small text-muted">{{ $payment->bill->vendor->name }}</div>
                                </td>

                                <!-- Amount -->
                                <td class="text-end fw-bold text-primary">
                                    {{ number_format($payment->amount, 2) }}
                                </td>

                                <!-- Method -->
                                <td style="text-transform: capitalize">
                                   {{ str_replace('_', ' ', $payment->payment_method) }}
                                </td>

                              

                                <!-- Status -->
                                <td>
                                    @php
                                        $status = $payment->bill->status;
                                        $badge = match($status) {
                                            'paid' => 'bg-success text-white',
                                            'partially_paid' => 'bg-warning text-dark',
                                            default => 'bg-secondary text-white',
                                        };
                                        $label = ucfirst(str_replace('_', ' ', $status));
                                    @endphp
                                    <span class="badge rounded-pill px-3 py-2 {{ $badge }}">
                                        {{ $label }}
                                    </span>
                                </td>

                               <td x-data="{ openModal: false }">
                                 <div class="hstack gap-2">
                                    <a href="{{ route('payment.edit', $payment->slug) }}"
                                        class="btn btn-icon btn-info-transparent rounded-pill">
                                        <i class="ri-edit-line"></i>
                                    </a>
                                  
                                    <button type="button" @click="openModal = true"
                                        class="btn btn-icon btn-danger-transparent rounded-pill">
                                        <i class="ri-delete-bin-line"></i>
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
                                            <button class="btn btn-delete" wire:click="delete('{{ $payment->slug }}')"
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

            @else
                <!-- Empty State -->
                <div class="text-center py-5">
                    <div class="mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-receipt text-muted opacity-50" viewBox="0 0 16 16">
                            <path d="M1.92.506a.5.5 0 0 1 .434.14l1 1a.5.5 0 0 1 0 .707l-1 1a.5.5 0 0 1-.707 0l-1-1a.5.5 0 0 1 0-.707l1-1zM8 2a.5.5 0 0 1 .5.5V4h1.5a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V5H6a.5.5 0 0 1 0-1h1.5V2.5A.5.5 0 0 1 8 2z"/>
                            <path d="M4.5 6h7a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .5-.5zM5 7v6h6V7H5z"/>
                            <path d="M1.5 13.5a.5.5 0 0 1 .5-.5h12a.5.5 0 0 1 0 1H2a.5.5 0 0 1-.5-.5z"/>
                        </svg>
                    </div>
                    <h5 class="text-muted mb-2">No payments recorded yet</h5>
                    <p class="text-muted mb-3">Start by recording your first payment.</p>
                    <a href="{{ route('payment.create') }}" class="btn btn-primary">
                        Record First Payment
                    </a>
                </div>
            @endif
        </div>
         <!-- Pagination -->
        <div class="card-footer bg-white border-top-0 d-flex justify-content-between align-items-center py-3">
            <div class="text-muted small">
                Showing {{ $payments->firstItem() }} to {{ $payments->lastItem() }} of {{ $payments->total() }} payments
            </div>
            <div>{{ $payments->links() }}</div>
        </div>
    </div>

  
</div>