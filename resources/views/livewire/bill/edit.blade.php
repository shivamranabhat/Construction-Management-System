<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Edit Bill #{{ $bill->bill_number }}</h4>
                </div>
                <div class="card-body">
                    @if (session()->has('message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form wire:submit="save">
                        {{-- Header --}}
                        <div class="row g-3 mb-4">
                            <div class="col-md-3">
                                <label class="form-label fw-bold">Bill Date <span class="text-danger">*</span></label>
                                <input type="date" wire:model="bill_date" class="form-control @error('bill_date') is-invalid @enderror">
                                @error('bill_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold">Bill Number <span class="text-danger">*</span></label>
                                <input type="text" wire:model="bill_number" class="form-control @error('bill_number') is-invalid @enderror">
                                @error('bill_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold">Vendor <span class="text-danger">*</span></label>
                                <select wire:model="vendor_id" class="form-select @error('vendor_id') is-invalid @enderror">
                                    <option value="">Select Vendor</option>
                                    @foreach($vendors as $vendor)
                                        <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                                    @endforeach
                                </select>
                                @error('vendor_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold">Project</label>
                                <select wire:model="project_id" class="form-select">
                                    <option value="">No Project</option>
                                    @foreach($projects as $project)
                                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Line Items Table --}}
                        <div class="table-responsive mb-4">
                            <table class="table table-bordered align-middle" x-data="billLineCalc()">
                                <thead class="table-light">
                                    <tr>
                                        <th width="30%">Item Name</th>
                                        <th width="12%">Qty</th>
                                        <th width="15%">Unit Price</th>
                                        <th width="15%">Tax</th>
                                        <th width="15%">Line Total</th>
                                        <th width="8%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($lines as $index => $line)
                                        <tr>
                                            <td>
                                                <input 
                                                    type="text" 
                                                    wire:model.live="lines.{{ $index }}.name" 
                                                    wire:change="updatedLines({{ $index }}, 'name')"
                                                    class="form-control form-control-sm"
                                                    placeholder="Type item name..."
                                                    x-on:input="calcLine({{ $index }})">
                                                @if(isset($line['item_id']))
                                                    <small class="text-muted d-block">ID: {{ $line['item_id'] }}</small>
                                                @endif
                                            </td>
                                            <td>
                                                <input 
                                                    type="number" 
                                                    wire:model.live="lines.{{ $index }}.quantity" 
                                                    class="form-control form-control-sm" 
                                                    min="1"
                                                    x-on:input="calcLine({{ $index }})">
                                            </td>
                                            <td>
                                                <input 
                                                    type="number" 
                                                    step="0.01" 
                                                    wire:model.live="lines.{{ $index }}.unit_price" 
                                                    class="form-control form-control-sm" 
                                                    min="0"
                                                    x-on:input="calcLine({{ $index }})">
                                            </td>
                                            <td>
                                                <select wire:model.live="lines.{{ $index }}.tax_id" class="form-select form-select-sm" x-on:change="calcLine({{ $index }})">
                                                    <option value="">No Tax</option>
                                                    @foreach($taxes as $tax)
                                                        <option value="{{ $tax->id }}">{{ $tax->name }} ({{ $tax->rate }}%)</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="fw-bold">
                                                <span x-text="formatCurrency(lineTotals[{{ $index }}] || 0)"></span>
                                            </td>
                                            <td>
                                                <button 
                                                    type="button" 
                                                    wire:click="removeLine({{ $index }})" 
                                                    class="btn btn-sm btn-outline-danger">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted">No items added</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                <tfoot>
                                    <tr class="table-primary">
                                        <td colspan="4" class="text-end fw-bold fs-5">Grand Total:</td>
                                        <td class="fw-bold fs-5">${{ number_format($total_price, 2) }}</td>
                                        <td>
                                            <button type="button" wire:click="addLine" class="btn btn-sm btn-success">
                                                Add Line
                                            </button>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Status</label>
                                <select wire:model="status" class="form-select">
                                    <option value="draft">Draft</option>
                                    <option value="paid">Paid</option>
                                    <option value="partial">Partial</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Notes</label>
                                <textarea wire:model="notes" class="form-control" rows="3" placeholder="Internal notes..."></textarea>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button 
                                type="button" 
                                wire:click="confirmDelete" 
                                class="btn btn-danger">
                                Delete Bill
                            </button>

                            <div>
                                <a href="{{ route('bill.index') }}" class="btn btn-secondary me-2">Cancel</a>
                                <button type="submit" class="btn btn-primary">
                                    Update Bill
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Delete Confirmation Modal --}}
    @if($showDeleteModal)
    <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Confirm Delete</h5>
                    <button type="button" wire:click="$set('showDeleteModal', false)" class="btn-close btn-close-white"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to <strong>permanently delete</strong> this bill?</p>
                    <p class="text-muted small">This will reverse stock and cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="$set('showDeleteModal', false)" class="btn btn-secondary">Cancel</button>
                    <button type="button" wire:click="deleteBill" class="btn btn-danger">Yes, Delete</button>
                </div>
            </div>
        </div>
    </div>
    @endif
    {{-- Alpine.js for Real-time Line Totals --}}
    <script>
    function billLineCalc() {
        return {
            lineTotals: @json($lines)->map(line => (line.quantity || 0) * (line.unit_price || 0)),
    
            calcLine(index) {
                const qty = document.querySelector(`[wire\\:model="lines.${index}.quantity"]`)?.value || 0;
                const price = document.querySelector(`[wire\\:model="lines.${index}.unit_price"]`)?.value || 0;
                const taxId = document.querySelector(`[wire\\:model="lines.${index}.tax_id"]`)?.value;
                let subtotal = qty * price;
                // Fetch tax rate via Livewire (simplified)
                const taxRate = taxId ? @json($taxes)->find(t => t.id == taxId)?.rate || 0 : 0;
                this.lineTotals[index] = subtotal + (subtotal * taxRate / 100);
            },
    
            formatCurrency(value) {
                return new Intl.NumberFormat('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }).format(value);
            }
        }
    }
    </script>
</div>


