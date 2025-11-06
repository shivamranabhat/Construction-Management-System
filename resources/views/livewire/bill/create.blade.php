<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>New Bill</h3>
                </div>
                <div class="card-body">
                    @if (session()->has('message'))
                        <div class="alert alert-success">{{ session('message') }}</div>
                    @endif

                    <form wire:submit="save">
                        {{-- Header --}}
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <label class="form-label">Bill Date</label>
                                <input type="date" wire:model="bill_date" class="form-control">
                                @error('bill_date') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Bill Number</label>
                                <input type="text" wire:model="bill_number" class="form-control">
                                @error('bill_number') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Vendor</label>
                                <select wire:model="vendor_id" class="form-select">
                                    <option value="">Select Vendor</option>
                                    @foreach($vendors as $vendor)
                                        <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                                    @endforeach
                                </select>
                                @error('vendor_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Project</label>
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
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>Item Name</th>
                                        <th>Quantity</th>
                                        <th>Unit Price</th>
                                        <th>Tax</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($lines as $index => $line)
                                        <tr>
                                            <td>
                                                <input type="text" wire:model="lines.{{ $index }}.name" wire:change="updatedLines({{ $index }}, 'name')" class="form-control" placeholder="Enter item name or select">
                                                @if(isset($line['item_id']))
                                                    <small class="text-muted">ID: {{ $line['item_id'] }}</small>
                                                @endif
                                            </td>
                                            <td>
                                                <input type="number" wire:model="lines.{{ $index }}.quantity" class="form-control" min="1">
                                            </td>
                                            <td>
                                                <input type="number" step="0.01" wire:model="lines.{{ $index }}.unit_price" class="form-control" min="0">
                                            </td>
                                            <td>
                                                <select wire:model="lines.{{ $index }}.tax_id" class="form-select">
                                                    <option value="">No Tax</option>
                                                    @foreach($taxes as $tax)
                                                        <option value="{{ $tax->id }}">{{ $tax->name }} ({{ $tax->rate }}%)</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>${{ number_format($line['total_price'] ?? 0, 2) }}</td>
                                            <td>
                                                <button type="button" wire:click="removeLine({{ $index }})" class="btn btn-sm btn-danger">Remove</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4" class="text-end fw-bold">Grand Total:</td>
                                        <td>${{ number_format($total_price, 2) }}</td>
                                        <td>
                                            <button type="button" wire:click="addLine" class="btn btn-sm btn-success">Add Line</button>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Status</label>
                                <select wire:model="status" class="form-select">
                                    <option value="draft">Draft</option>
                                    <option value="paid">Paid</option>
                                    <option value="partial">Partial</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Notes</label>
                                <textarea wire:model="notes" class="form-control" rows="3"></textarea>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('bill.index') }}" class="btn btn-secondary me-2">Cancel</a>
                            <button type="submit" class="btn btn-primary">Save Bill</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('billForm', () => ({
            calculateLineTotal(index) {
                // Local calc for instant feedback
                const qty = this.$wire.$el.querySelector(`[wire\\:model="lines.${index}.quantity"]`).value;
                const price = this.$wire.$el.querySelector(`[wire\\:model="lines.${index}.unit_price"]`).value;
                // Update display...
            }
        }));
    });
    </script>
</div>
