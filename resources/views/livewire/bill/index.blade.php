<div class="container-fluid py-4" wire:loading.remove>
    <!-- Header -->
    <div
        class="d-flex flex-column flex-lg-row justify-content-between align-items-start align-items-lg-center gap-3 mb-4">
        <div>
            <h4 class="mb-1 text-primary fw-bold">
                <i class="bi bi-receipt me-2"></i>Bills
            </h4>
            <p class="text-muted mb-0">View and manage all vendor bills</p>
        </div>
        <div class="d-flex gap-2 flex-wrap">
            <!-- ✅ Fixed Filter Toggle Button -->
            <button class="btn btn-outline-primary btn-sm d-flex align-items-center gap-1" wire:click="toggleFilters">
                <i class="bi bi-funnel"></i>
                <span class="d-none d-sm-inline">Filters</span>
                @if($activeFilters > 0)
                <span class="badge bg-primary rounded-pill">{{ $activeFilters }}</span>
                @endif
            </button>

            <a href="{{ route('bill.create') }}" class="btn btn-primary btn-sm d-flex align-items-center gap-1">
                <i class="bi bi-plus-circle"></i>
                <span class="d-none d-sm-inline">New Bill</span>
            </a>
        </div>
    </div>

    <!-- Filters (Collapsible) -->
    @if($showFilters)
    <div class="card border-0 shadow-sm mb-4" wire:transition.fade>
        <div class="card-body">
            <div class="row g-3">
                <!-- Search -->
                <div class="col-md-4">
                    <label class="form-label text-muted small">Search</label>
                    <input type="text" wire:model.live.debounce.400ms="search" class="form-control form-control-sm"
                        placeholder="Bill #, Vendor, Email...">
                </div>

                <!-- Status -->
                <div class="col-md-3">
                    <label class="form-label text-muted small">Status</label>
                    <select wire:model.live="status_filter" wire:change="$refresh" class="form-select form-select-sm">
                        <option value="">All Status</option>
                        <option value="draft">Draft</option>
                        <option value="sent">Sent</option>
                        <option value="paid">Paid</option>
                        <option value="overdue">Overdue</option>
                    </select>
                </div>

                <!-- Date Range -->
                <div class="col-md-3">
                    <label class="form-label text-muted small">Date Range</label>
                    <select wire:model.live="date_range" wire:change="$refresh" class="form-select form-select-sm">
                        <option value="">All Time</option>
                        <option value="7">Last 7 Days</option>
                        <option value="30">Last 30 Days</option>
                        <option value="90">Last 90 Days</option>
                        <option value="custom">Custom Range</option>
                    </select>
                </div>

                <!-- Custom Range -->
                @if($date_range === 'custom')
                <div class="col-md-3">
                    <label class="form-label text-muted small">From / To</label>
                    <div class="input-group input-group-sm">
                        <input type="date" wire:model.live="date_from" wire:change="$refresh" class="form-control">
                        <input type="date" wire:model.live="date_to" wire:change="$refresh" class="form-control">
                    </div>
                </div>
                @endif
            </div>

            <div class="mt-3 text-end">
                <button wire:click="toggleFilters" class="btn btn-link btn-sm text-muted">
                    <i class="bi bi-x"></i> Hide Filters
                </button>
            </div>
        </div>
    </div>
    @endif


    <!-- Summary Cards -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted small mb-1">Total Bills</p>
                            <h5 class="mb-0 text-primary">{{ $totalBills }}</h5>
                        </div>
                        <div class="bg-primary bg-opacity-10 rounded p-2">
                            <i class="bi bi-receipt text-primary" style="font-size:1.5rem"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted small mb-1">Unpaid</p>
                            <h5 class="mb-0 text-warning">{{ $unpaidCount }}</h5>
                        </div>
                        <div class="bg-warning bg-opacity-10 rounded p-2">
                            <i class="bi bi-clock-history text-warning" style="font-size:1.5rem"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted small mb-1">Overdue</p>
                            <h5 class="mb-0 text-danger">{{ $overdueCount }}</h5>
                        </div>
                        <div class="bg-danger bg-opacity-10 rounded p-2">
                            <i class="bi bi-exclamation-triangle text-danger" style="font-size:1.5rem"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted small mb-1">Total Amount</p>
                            <h5 class="mb-0 text-success">£{{ number_format($totalAmount, 2) }}</h5>
                        </div>
                        <div class="bg-success bg-opacity-10 rounded p-2">
                            <i class="bi bi-currency-pound text-success" style="font-size:1.5rem"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light small text-muted text-uppercase">
                        <tr>
                            <th>Bill #</th>
                            <th>Vendor</th>
                            <th>Project</th>
                            <th class="text-center">Due Date</th>
                            <th class="text-end">Amount</th>
                            <th class="text-center">Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bills as $bill)
                        <tr class="border-start {{ $bill->status === 'overdue' ? 'border-danger' : '' }}">
                            <td>
                                <a href="{{ route('bill.edit', $bill->slug) }}"
                                    class="text-decoration-none fw-semibold text-primary">
                                    #{{ $bill->bill_number }}
                                </a>
                                <br>
                                <small class="text-muted">{{ \Carbon\Carbon::parse($bill->bill_date)->format('d M Y')
                                    }}</small>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="bg-light rounded p-1">
                                        <i class="bi bi-person text-primary" style="font-size:0.9rem"></i>
                                    </div>
                                    <div>
                                        <div class="fw-medium">{{ $bill->vendor->name }}</div>
                                        <small class="text-muted">{{ $bill->vendor->email }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark">{{ $bill->project?->name ?? 'Global' }}</span>
                            </td>
                            <td class="text-center">
                                <span class="{{ $bill->status === 'overdue' ? 'text-danger' : 'text-muted' }}">
                                    {{ \Carbon\Carbon::parse($bill->due_date)->format('d M Y') }}
                                </span>
                            </td>
                            <td class="text-end fw-bold">£{{ number_format($bill->total, 2) }}</td>
                            <td class="text-center">
                                <span class="badge fw-medium {{
                                        $bill->status === 'paid' ? 'bg-success' :
                                        ($bill->status === 'draft' ? 'bg-secondary' :
                                        ($bill->status === 'overdue' ? 'bg-danger' : 'bg-warning'))
                                    }}">
                                    {{ ucfirst($bill->status) }}
                                </span>
                            </td>
                            <td x-data="{ openModal: false }">
                                 <div class="hstack gap-2">
                                    <a href="{{ route('bill.edit', $bill->slug) }}"
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
                                            <button class="btn btn-delete" wire:click="delete('{{ $bill->slug }}')"
                                                @click="openModal = false">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox display-1 d-block mb-3"></i>
                                <p>No bills found.</p>
                                <a href="{{ route('bill.create') }}" class="btn btn-primary btn-sm">
                                    Create Your First Bill
                                </a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="card-footer bg-white border-top-0 d-flex justify-content-between align-items-center py-3">
            <div class="text-muted small">
                Showing {{ $bills->firstItem() }} to {{ $bills->lastItem() }} of {{ $bills->total() }} bills
            </div>
            <div>{{ $bills->links() }}</div>
        </div>
    </div>
</div>