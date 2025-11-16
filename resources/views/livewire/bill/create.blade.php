<div class="container-fluid py-4" wire:loading.remove>
    <div class="card border-0 shadow-sm">
        <!-- Sticky Header -->
        <div class="card-header bg-white border-bottom sticky-top" style="top: 0; z-index: 10;">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 text-primary">
                    <i class="bi bi-receipt me-2"></i>Bill
                </h5>
                <a href="{{ route('bill.index') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-arrow-left"></i>
                </a>
            </div>
        </div>

        <div class="card-body p-4">
            <form wire:submit.prevent="save">
                <!-- Vendor, Project, Bill Number -->
                <div class="row g-4 mb-4">
                    <div class="col-lg-4">
                        <label class="form-label fw-semibold text-dark">
                            Vendor <span class="text-danger">*</span>
                        </label>
                        <select wire:model.live="vendor_id" class="form-select form-select-lg" required autofocus>
                            <option value="">Choose Vendor</option>
                            @foreach($vendors as $v)
                            <option value="{{ $v->id }}">{{ $v->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-4">
                        <label class="form-label fw-semibold text-dark">Project</label>
                        <select wire:model.live="project_id" class="form-select form-select-lg">
                            <option value="">Any Project</option>
                            <option value="global">Global (No Project)</option>
                            @foreach($projects as $p)
                            <option value="{{ $p->id }}">{{ $p->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-4">
                        <label class="form-label fw-semibold text-dark">Bill Number</label>
                        <input type="text" wire:model="bill_number" class="form-control form-control-lg"
                            placeholder="BILL-2025-001" required>
                    </div>
                </div>

                <!-- Dates -->
                <div class="row g-4 mb-5">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-dark">Bill Date</label>
                        <input type="date" wire:model="bill_date" class="form-control form-control-lg" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-dark">Due Date</label>
                        <input type="date" wire:model="due_date" class="form-control form-control-lg" required>
                    </div>
                </div>

                <!-- Items Section -->
                <div class="border rounded-3 p-4 bg-light mb-5" wire:loading.class="opacity-50">
                    <div class="d-flex align-items-center mb-3">
                        <h6 class="mb-0 text-primary fw-bold">
                            <i class="bi bi-cart-check me-2"></i>Bill Items
                        </h6>
                        @if($vendor_id && $project_id !== '')
                        <span class="ms-2 badge bg-primary">
                            {{ count($items) }} item{{ count($items) !== 1 ? 's' : '' }} loaded
                        </span>
                        @endif
                    </div>

                    @if(count($items) > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-primary">
                                <tr>
                                    <th>Item</th>
                                    <th width="100" class="text-center">Qty</th>
                                    <th width="140" class="text-end">Unit Price</th>
                                    <th width="100" class="text-center">Tax</th>
                                    <th width="140" class="text-end">Line Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($items as $i => $item)
                                <tr class="border-bottom">
                                    <td class="fw-medium">{{ $item['item_name'] }}</td>
                                    <td>
                                        <input type="number" wire:model.live="items.{{ $i }}.quantity"
                                            class="form-control form-control-sm text-center" min="1"
                                            style="width: 80px;" readonly>
                                    </td>
                                    <td>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text">£</span>
                                            <input type="number" step="0.01" wire:model.live="items.{{ $i }}.unit_price"
                                                class="form-control text-end" min="0" readonly>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-info fs-6">
                                            {{ $item['tax_rate'] }}%
                                        </span>
                                    </td>
                                    <td class="text-end fw-bold text-primary">
                                        £{{ number_format($item['quantity'] * $item['unit_price'], 2) }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="table-light fw-bold">
                                <tr>
                                    <td colspan="4" class="text-end">Subtotal</td>
                                    <td class="text-end">£{{ number_format($subtotal, 2) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-end">Tax</td>
                                    <td class="text-end text-primary">£{{ number_format($tax, 2) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-end">Grand Total</td>
                                    <td class="text-end">£{{ number_format($total, 2) }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    @else
                    <div class="text-center py-5 text-muted">
                        <i class="bi bi-inbox display-1"></i>
                        <p class="mt-3">
                            @if(!$vendor_id)
                            Please select a <strong>vendor</strong> first.
                            @elseif($project_id === '')
                            Now select a <strong>project</strong> to load unbilled items.
                            @else
                            <span wire:loading.remove wire:target="vendor_id,project_id">
                                No unbilled items found for this vendor & project.
                            </span>
                            @endif
                        </p>
                    </div>
                    @endif

                    <!-- Loading spinner when loading items -->
                    <div wire:loading wire:target="vendor_id,project_id" class="text-center py-3">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading items...</span>
                        </div>
                        <p class="mt-2 text-primary">Loading unbilled items...</p>
                    </div>
                </div>

                <!-- Notes -->
                <div class="mb-4">
                    <label class="form-label fw-semibold text-dark">Notes (Optional)</label>
                    <textarea wire:model="notes" class="form-control" rows="3"
                        placeholder="Add any internal notes or terms..."></textarea>
                </div>

                <!-- Action Buttons -->
                <div class="d-flex gap-3 justify-content-end">
                    <a href="{{ route('bill.index') }}" class="btn btn-outline-secondary">
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled" wire:target="save">
                        <span wire:loading.remove wire:target="save">
                            Save
                        </span>
                        <span wire:loading wire:target="save">
                            <span class="spinner-border spinner-border-sm" role="status"></span>
                            Saving...
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>