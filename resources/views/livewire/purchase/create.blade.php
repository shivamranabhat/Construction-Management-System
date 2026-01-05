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
                        <!-- Date -->
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Date <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-calendar3"></i>
                                </span>
                                <input type="date" wire:model.live="purchase_date" class="form-control form-control-sm">
                            </div>
                        </div>

                        <!-- Purchase # -->
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Purchase</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-hash"></i>
                                </span>
                                <input type="text" wire:model.live="purchase_number"
                                    class="form-control form-control-sm">
                            </div>
                        </div>

                        <!-- Vendor -->
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Vendor <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-truck"></i>
                                </span>
                                <select wire:model.live="vendor_id" class="form-select form-select-sm">
                                    <option value="">Select Vendor</option>
                                    @forelse($vendors as $v)
                                    <option value="{{ $v->id }}">{{ $v->name }}</option>
                                    @empty
                                    <option value="" disabled>No vendors found</option>
                                    @endforelse
                                </select>
                            </div>
                            @error('vendor_id')
                            <small class="text-danger">Please select a vendor</small>
                            @enderror
                        </div>

                        <!-- Project -->
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Project <span class="text-danger">*</span></label>

                            @if($singleProject)
                            <!-- Only one project → show as readonly -->
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-building"></i>
                                </span>
                                <span class="form-control form-control-sm"> {{$userProjects->first() }}</span>
                                <input type="hidden" wire:model="project_id" value="{{ $project_id }}">
                            </div>
                            <small class="text-muted">Your assigned project</small>
                            @else
                            <!-- Multiple projects → dropdown -->
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-building"></i>
                                </span>
                                <select wire:model.live="project_id"
                                    class="form-select form-select-sm @error('project_id') is-invalid @enderror"
                                    required>
                                    <option value="">Select Project</option>
                                    @foreach($userProjects as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('project_id')
                            <small class="text-danger">Please select a project</small>
                            @enderror
                            @endif
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
                                        @error('lines.' . $i . '.item_name')
                                        <small class="text-danger">Please enter item name</small>
                                        @enderror
                                    </td>
                                    <td>
                                        <input type="number" wire:model.live="lines.{{ $i }}.quantity" min="1"
                                            class="form-control form-control-sm text-center" style="width: 70px;">
                                        @error('lines.' . $i . '.quantity')
                                        <small class="text-danger">Please enter quantity</small>
                                        @enderror
                                    </td>
                                    <td>
                                        <input type="number" wire:model.live="lines.{{ $i }}.rate" min="0"
                                            class="form-control form-control-sm text-end" style="width: 90px;">
                                        @error('lines.' . $i . '.rate')
                                        <small class="text-danger">Please enter rate</small>
                                        @enderror
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
                            <label>Notes</label>
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
                    @can('create-purchase')
                    <button type="submit" class="btn btn-primary d-flex align-items-center gap-1"
                        wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="save">Save Purchase</span>
                        <span wire:loading wire:target="save">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            <span aria-hidden="true">Saving…</span>
                        </span>
                    </button>
                    @else
                    <button class="btn btn-primary d-flex align-items-center gap-1" disabled>
                        Save
                    </button>
                    @endcan
                </div>
            </form>
        </div>
    </div>
    <!-- Requisition Import Modal -->
    @if($showRequisitionModal)
    <div class="modal fade show d-block custom-modal-backdrop" tabindex="-1">

        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content custom-modal-content">

                {{-- HEADER --}}
                <div class="modal-header">
                    <h5 class="modal-title fw-bold d-flex align-items-center">
                        <i class="bi bi-box-seam me-2"></i>
                        Found {{ $pendingRequisitions->count() }} Approved Requisition(s)
                    </h5>
                    <button type="button" wire:click="ignoreRequisitions" class="btn-close"></button>
                </div>

                {{-- BODY --}}
                <div class="modal-body">

                    <p class="mb-4 text-muted d-flex align-items-center">
                        <i class="bi bi-info-circle me-2"></i>
                        We found approved requisitions for this vendor. You may auto-fill items from one of them.
                    </p>

                    <div class="row g-3">
                        @foreach($pendingRequisitions as $req)
                        <div class="col-md-6">

                            <div class="p-4 requisition-card h-100" style="cursor: pointer;"
                                wire:click="useRequisition({{ $req->id }})">

                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <h6 class="fw-bold mb-0">
                                        <i class="bi bi-hash me-1"></i>{{ $req->requisition_number }}
                                    </h6>
                                    <span class="badge bg-primary">
                                        <i class="bi bi-check-circle me-1"></i> Approved
                                    </span>
                                </div>

                                <p class="small text-muted mb-1">
                                    <i class="bi bi-calendar-event me-1"></i>
                                    {{ $req->created_at->format('d M Y') }}
                                </p>

                                <p class="small text-muted mb-3">
                                    <i class="bi bi-building me-1"></i>
                                    {{ $req->project->name }}
                                </p>

                                <div class="fw-semibold text-primary d-flex align-items-center">
                                    <i class="bi bi-list-check me-2"></i>
                                    {{ $req->items->count() }} item(s)
                                </div>

                            </div>
                        </div>
                        @endforeach
                    </div>

                    {{-- Manual Entry Button --}}
                    <div class="mt-4 p-4 bg-light rounded-3 border text-center">
                        <button type="button" wire:click="ignoreRequisitions" class="btn btn-outline-dark">
                            <i class="bi bi-pencil-square me-1"></i>
                            No thanks, I'll enter items manually
                        </button>
                    </div>

                </div>

            </div>
        </div>
    </div>
    @endif

    <!-- Optional: Custom CSS -->
    <style>
        .custom-modal-backdrop {
            background: rgba(0, 0, 0, 0.35);
            backdrop-filter: blur(2px);
        }

        .custom-modal-content {
            background: #ffffff !important;
            color: #000 !important;
            border-radius: 14px;
            border: none;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .requisition-card {
            transition: all 0.25s ease;
            border-radius: 12px;
            background: #fafafa;
            border: 1px solid #e6e6e6;
        }

        .requisition-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
            border-color: #d0d0d0;
        }

        .hover-shadow:hover {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15) !important;
            transform: translateY(-4px);
            border-color: #4f46e5 !important;
        }

        .transition {
            transition: all 0.3s ease;
        }

        .hover-bg-light:hover {
            background-color: #f8f9fa !important;
        }
    </style>

</div>