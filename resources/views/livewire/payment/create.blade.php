<div class="container-fluid py-4">
    <div class="card border-0 shadow-sm">
         <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center p-3">
            <h5 class="mb-0 text-primary">
                Payment
            </h5>
            <a href="{{ route('payment.index') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-arrow-left"></i>
            </a>
        </div>
        <div class="card-body p-4">
            <form wire:submit.prevent="save">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label">Bill</label>
                        <select wire:model.live="bill_id" class="form-select @error('bill_id') is-invalid @enderror"
                            required>
                            <option value="">Select Bill</option>
                            @foreach($bills as $bill)
                            <option value="{{ $bill->id }}">
                                #{{ $bill->bill_number }} - {{ $bill->vendor->name }}
                                (Due: £{{ number_format($bill->remaining_amount, 2) }})
                            </option>
                            @endforeach
                        </select>
                        @error('bill_id') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Amount</label>
                        <div class="input-group">
                            <span class="input-group-text">£</span>
                            <input type="number" step="0.01" wire:model.live="amount"
                                class="form-control @error('amount') is-invalid @enderror" required>
                        </div>
                        @error('amount') <span class="text-danger small d-block">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Payment Date</label>
                        <input type="date" wire:model="payment_date"
                            class="form-control @error('payment_date') is-invalid @enderror" required>
                        @error('payment_date') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Payment Method</label>
                        <select wire:model="payment_method" class="form-select">
                            <option value="bank_transfer">Bank Transfer</option>
                            <option value="cash">Cash</option>
                            <option value="card">Card</option>
                            <option value="cheque">Cheque</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Reference</label>
                        <input type="text" wire:model="reference" class="form-control" placeholder="e.g. BACS123">
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Notes</label>
                        <textarea wire:model="notes" class="form-control" rows="3"></textarea>
                    </div>
                </div>

                <div class="d-flex gap-3 justify-content-end mt-4">
                    <a href="{{ route('payment.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                        <span wire:loading.remove>Save</span>
                        <span wire:loading>Saving...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>