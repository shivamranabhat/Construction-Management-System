<div class="container-fluid py-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">New Purchase</h4>
            <a href="{{route('purchase.index')}}" class="btn btn-primary btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                </svg>
            </a>
        </div>
        <div class="card-body p-0">
            <form wire:submit="save">
                <!-- Header -->
                <div class="border-bottom px-4 py-3">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label>Date</label>
                            <input type="date" wire:model.live="purchase_date" class="form-control form-control-sm">
                        </div>
                        <div class="col-md-3">
                            <label>Purchase #</label>
                            <input type="text" wire:model.live="purchase_number" class="form-control form-control-sm">
                        </div>
                        <div class="col-md-3">
                            <label>Vendor</label>
                            <select wire:model.live="vendor_id" class="form-select form-select-sm">
                                <option value="">Select</option>
                                @foreach($vendors as $v) <option value="{{ $v->id }}">{{ $v->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Project</label>
                            <select wire:model.live="project_id" class="form-select form-select-sm">
                                <option value="">None</option>
                                @foreach($projects as $p) <option value="{{ $p->id }}">{{ $p->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Item Table -->
                <div class="p-4">
                    <h6 class="mb-3">Item Table</h6>
                    <div class="table-responsive">
                        <table class="table table-borderless align-middle">
                            <thead class="bg-light small text-muted">
                                <tr>
                                    <th>ITEM DETAILS</th>
                                    <th>QUANTITY</th>
                                    <th>RATE</th>
                                    <th>TAX</th>
                                    <th>AMOUNT</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($lines as $i => $line)
                                <tr>
                                    <td class="position-relative">
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text bg-white border-0">
                                                <i class="bi bi-box-seam text-primary text-muted"></i>
                                            </span>
                                            <input type="text" wire:model.live="lines.{{ $i }}.item_name"
                                                wire:focus="showItemDropdown.{{ $i }} = true"
                                                class="form-control form-control-sm border-start-0"
                                                placeholder="Type or click to select an item." autocomplete="off"
                                                style="padding-left: 0.5rem;">
                                        </div>

                                        @if(isset($showItemDropdown[$i]) && $showItemDropdown[$i])
                                        <div class="bg-white border rounded shadow-sm mt-1"
                                            style="z-index: 1000; width: 100%; max-height: 320px; overflow-y: auto;">
                                            @php
                                            $query = $item_search[$i] ?? '';
                                            $items = \App\Models\Item::where('company_id', auth()->user()->company_id ??
                                            1)
                                            ->where('name', 'like', "%{$query}%")
                                            ->limit(10)
                                            ->get();
                                            @endphp

                                            @forelse($items as $item)
                                            <div class="px-3 py-2 hover-bg-light border-bottom"
                                                wire:click="selectItem({{ $i }}, {{ $item->id }})"
                                                style="cursor: pointer;">
                                                <div class="d-flex justify-content-between">
                                                    <strong>{{ $item->name }}</strong>
                                                    <small class="text-muted">{{ $item->unit }}</small>
                                                </div>
                                                <small class="text-muted">Reorder: {{ $item->reorder_level }}</small>
                                            </div>
                                            
                                            @empty
                                            <div class="p-3">
                                                @if(strlen($query) > 0)
                                                <p class="text-muted mb-2 border-bottom pb-2">No results found. Try a
                                                    different keyword.
                                                </p>
                                                
                                                @else
                                                <p class="text-muted">Start typing to search items...</p>
                                                @endif
                                            </div>
                                            @endforelse
                                            <div class="p-3">
                                                <a href="{{route('item.create')}}"
                                                    class="btn btn-sm btn-primary w-auto d-inline-flex align-items-center gap-1 mt-2">
                                                    <i class="bi bi-plus"></i> Add New Item
                                                </a>
                                            </div>
                                        </div>
                                        @endif
                                    </td>
                                    <td>
                                        <input type="number" wire:model.live="lines.{{ $i }}.quantity" min="1"
                                            class="form-control form-control-sm text-center" style="width: 70px;">
                                    </td>
                                    <td>
                                        <input type="number" step="0.01" wire:model.live="lines.{{ $i }}.rate" min="0"
                                            class="form-control form-control-sm text-end" style="width: 90px;">
                                    </td>
                                    <td>
                                        <select wire:model.live="lines.{{ $i }}.tax_id"
                                            class="form-select form-select-sm">
                                            <option value="">Select a Tax</option>
                                            @foreach($taxes as $t) <option value="{{ $t->id }}">{{ $t->name }}
                                                {{$t->rate}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="fw-bold">
                                        {{ number_format($line['amount'], 2) }}
                                    </td>
                                    <td>
                                        <button type="button" wire:click="removeLine({{ $i }})"
                                            class="btn text-danger"><i class="bi bi-x-lg"></i></button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">No items</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Only "Add" button -->
                    <div class="mt-3">
                        <button type="button" wire:click="addEmptyRow"
                            class="btn btn-sm btn-outline-primary d-flex align-items-center gap-1">
                            <i class="bi bi-plus-circle"></i> Add
                        </button>
                    </div>
                </div>

                <!-- Totals -->
                <div class="border-top px-4 py-3 bg-light">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Customer Notes</label>
                            <textarea wire:model.live="notes" class="form-control form-control-sm" rows="2"
                                placeholder="Will be displayed on purchase order."></textarea>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-sm table-borderless mb-0">
                                <tr>
                                    <td>Sub Total</td>
                                    <td class="text-end">{{ number_format($sub_total, 2) }}</td>
                                </tr>
                                <tr>
                                    <td>Tax</td>
                                    <td class="text-end">{{ number_format($tax_total, 2) }}</td>
                                </tr>
                                <tr class="fw-bold fs-5">
                                    <td>Total</td>
                                    <td class="text-end text-primary">{{ number_format($grand_total, 2) }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="border-top px-4 py-3 d-flex justify-content-end gap-2">
                    <a href="{{ route('purchase.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Save Purchase</button>
                </div>
            </form>
        </div>
    </div>

</div>


@push('style')
<style>
    .hover-bg-light:hover {
        background-color: #f8f9fa !important;
    }
</style>
@endpush