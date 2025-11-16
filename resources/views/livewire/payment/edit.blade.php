<div class="container-fluid py-4" wire:loading.remove>
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center p-3">
            <h5 class="mb-0 text-primary">
                Edit Payment
            </h5>
            <a href="{{ route('payment.index') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-arrow-left"></i>
            </a>
        </div>

        <div class="card-body p-4">
            <form wire:submit.prevent="save">
                <div class="row g-4">
                    <!-- Bill (Read-only) -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-dark">Bill</label>
                        <div class="input-group">
                            <span class="input-group-text">#</span>
                            <input 
                                type="text" 
                                value="{{ $payment->bill->bill_number }} - {{ $payment->bill->vendor->name }}" 
                                class="form-control bg-white" 
                                readonly>
                        </div>
                        <small class="text-muted d-block">
                            Total: £{{ number_format($payment->bill->total, 2) }} 
                            | Paid: £{{ number_format($payment->bill->total_paid - $payment->amount + $amount, 2) }}
                            | Remaining: £{{ number_format($payment->bill->remaining_amount + $payment->amount - $amount, 2) }}
                        </small>
                    </div>

                    <!-- Amount -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-dark">
                            Amount <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">£</span>
                            <input 
                                type="number" 
                                step="0.01" 
                                wire:model.live="amount" 
                                class="form-control @error('amount') is-invalid @enderror" 
                                min="0.01" 
                                required>
                        </div>
                        @error('amount') 
                            <span class="text-danger small d-block">{{ $message }}</span> 
                        @enderror
                    </div>

                    <!-- Payment Date -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-dark">
                            Payment Date <span class="text-danger">*</span>
                        </label>
                        <input 
                            type="date" 
                            wire:model="payment_date" 
                            class="form-control @error('payment_date') is-invalid @enderror" 
                            required>
                        @error('payment_date') 
                            <span class="text-danger small">{{ $message }}</span> 
                        @enderror
                    </div>

                    <!-- Payment Method -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-dark">
                            Payment Method <span class="text-danger">*</span>
                        </label>
                        <select 
                            wire:model="payment_method" 
                            class="form-select @error('payment_method') is-invalid @enderror" 
                            required>
                            <option value="bank_transfer">Bank Transfer</option>
                            <option value="cash">Cash</option>
                            <option value="card">Card</option>
                            <option value="cheque">Cheque</option>
                        </select>
                        @error('payment_method') 
                            <span class="text-danger small">{{ $message }}</span> 
                        @enderror
                    </div>

                    <!-- Reference -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-dark">Reference</label>
                        <input 
                            type="text" 
                            wire:model="reference" 
                            class="form-control" 
                            placeholder="e.g. BACS123, CHQ456">
                    </div>

                    <!-- Notes -->
                    <div class="col-md-12">
                        <label class="form-label fw-semibold text-dark">Notes</label>
                        <textarea 
                            wire:model="notes" 
                            class="form-control" 
                            rows="3" 
                            placeholder="Any additional details..."></textarea>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="d-flex gap-3 justify-content-end mt-5">
                    <a href="{{ route('payment.index') }}" class="btn btn-outline-secondary">
                        Cancel
                    </a>
                    <button 
                        type="submit" 
                        class="btn btn-primary" 
                        wire:loading.attr="disabled"
                        wire:target="save">
                        <span wire:loading.remove wire:target="save">Update Payment</span>
                        <span wire:loading wire:target="save">
                            <span class="spinner-border spinner-border-sm" role="status"></span>
                            Updating...
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>