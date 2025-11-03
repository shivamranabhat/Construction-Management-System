{{--
<div class="col-xl-12">
    <div class="card custom-card">
        <div class="card-header justify-content-between">
            <div class="card-title">Edit</div>
            <a href="{{ route('boq.index') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-arrow-left"></i>
            </a>
        </div>

        <div class="card-body"
            x-data="{ openModal: @entangle('showDeleteModal'), deleteType: @entangle('deleteType') }">
            <!-- Delete Confirmation Modal -->
            <div x-show="openModal" class="modal-backdrop" style="display: none;"
                @click.away="openModal = false; $wire.closeModal()">
                <div class="modal-box">
                    <div class="modal-header p-0">
                        <div class="modal-title">Confirm Delete</div>
                        <button class="close-btn" @click="openModal = false; $wire.closeModal()">&times;</button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this <span
                            x-text="deleteType === 'main' ? 'BOQ' : deleteType === 'sub' ? 'Sub BOQ' : deleteType === 'subsub' ? 'Sub BOQ Item' : 'BOQ Item'"></span>?
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-cancel" @click="openModal = false; $wire.closeModal()">Cancel</button>
                        <button class="btn btn-delete"
                            @click="openModal = false; $wire[deleteType === 'main' ? 'deleteMainBoq' : deleteType === 'sub' ? 'deleteSubBoq' : deleteType === 'subsub' ? 'deleteSubSubBoq' : 'deleteMainBoqItem']()">Delete</button>
                    </div>
                </div>
            </div>

            <!-- Select Project -->
            <div class="mb-3">
                <label class="form-label">Project</label>
                <select wire:model.live="project_id" class="form-select">
                    <option value="">-- Select Project --</option>
                    @foreach($projects as $project)
                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                    @endforeach
                </select>
                @error('project_id') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <!-- Add Main BOQ -->
            <button class="btn btn-primary mb-3" wire:click="addMainBoq" type="button">+ Add BOQ</button>

            @foreach($mainBoqs as $index => $main)
            <div class="border p-3 rounded mb-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h6>BOQ {{ $index + 1 }}</h6>
                    <button class="btn btn-danger btn-sm"
                        @click="openModal = true; $wire.confirmDelete('main', { mainIndex: {{ $index }} })">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>

                <div class="row g-2 mb-2">
                    <div class="col-12 col-md-1">
                        <input type="text" wire:model.live="mainBoqs.{{ $index }}.serial_number" class="form-control"
                            placeholder="Serial">
                    </div>
                    <div class="col-12 col-md-4">
                        <input type="text" wire:model.live="mainBoqs.{{ $index }}.name" class="form-control"
                            placeholder="BOQ Name">
                    </div>
                    @if(!$main['subToggled'])
                    <div class="col-12 col-md-1">
                        <input type="number" wire:model.live="mainBoqs.{{ $index }}.boqCount" class="form-control"
                            placeholder="No. of Items">
                    </div>
                    <div class="col-12 col-md-2">
                        <button class="btn btn-secondary" wire:click="generateMainBoqs({{ $index }})"
                            type="button">Generate Items</button>
                    </div>
                    @endif
                    <div class="col-12 col-md-2 d-flex align-items-center">
                        <label class="form-label me-2 mb-0">Sub BOQ?</label>
                        <div x-data="{ toggled: @entangle('mainBoqs.'.$index.'.subToggled') }" @change.debounce.500ms="
                            if(toggled){
                                if(!$wire.mainBoqs[{{ $index }}].subBoqs.length){
                                    $wire.call('generateSubBoqs', {{ $index }});
                                }
                            } else {
                                if(!$wire.mainBoqs[{{ $index }}].boqs.length){
                                    $wire.call('generateMainBoqs', {{ $index }});
                                }
                            }
                        " class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" x-model="toggled">
                        </div>
                    </div>
                </div>

                <!-- Main BOQ Items -->
                @if(!$main['subToggled'])
                @foreach($main['boqs'] as $bIndex => $boq)
                <div class="row g-2 mb-2 ps-3 align-items-center">
                    <div class="col-12 col-md-1">
                        <input type="text" wire:model.live="mainBoqs.{{ $index }}.boqs.{{ $bIndex }}.serial_number"
                            class="form-control" placeholder="Serial No">
                    </div>
                    <div class="col-12 col-md-4">
                        <textarea type="text"
                            wire:model.live="mainBoqs.{{ $index }}.boqs.{{ $bIndex }}.item_description"
                            class="form-control" placeholder="Description" rows="1"></textarea>
                    </div>
                    <div class="col-12 col-md-1">
                        <input type="text" wire:model.live="mainBoqs.{{ $index }}.boqs.{{ $bIndex }}.unit"
                            class="form-control" placeholder="Unit">
                    </div>
                    <div class="col-12 col-md-1">
                        <input type="number" wire:model.live="mainBoqs.{{ $index }}.boqs.{{ $bIndex }}.quantity"
                            class="form-control" placeholder="Qty">
                    </div>
                    <div class="col-12 col-md-1">
                        <input type="number" wire:model.live="mainBoqs.{{ $index }}.boqs.{{ $bIndex }}.unit_rate"
                            class="form-control" placeholder="Rate">
                    </div>
                    <div class="col-12 col-md-1">
                        <input type="number" class="form-control"
                            value="{{ (float)($boq['quantity'] ?? 0) * (float)($boq['unit_rate'] ?? 0) }}" readonly>
                    </div>
                    <div class="col-12 col-md-2">
                        <textarea type="text" wire:model.live="mainBoqs.{{ $index }}.boqs.{{ $bIndex }}.summary"
                            class="form-control" placeholder="Summary" rows="1"></textarea>
                    </div>
                    <div class="col-12 col-md-1">
                        <button class="btn btn-danger btn-sm"
                            @click="openModal = true; $wire.confirmDelete('mainitem', { mainIndex: {{ $index }}, boqIndex: {{ $bIndex }} })">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>
                @endforeach
                @endif

                <!-- Sub BOQs -->
                @if($main['subToggled'])
                <div class="border-start mt-3 ps-3">
                    <div class="row g-2 mb-2">
                        <div class="col-12 col-md-1">
                            <input type="number" wire:model.live="mainBoqs.{{ $index }}.subCount" class="form-control"
                                placeholder="No. of Sub BOQs">
                        </div>
                        <div class="col-12 col-md-2">
                            <button class="btn btn-secondary" wire:click="generateSubBoqs({{ $index }})"
                                type="button">Generate Sub BOQs</button>
                        </div>
                    </div>

                    @foreach($main['subBoqs'] as $subIndex => $sub)
                    <div class="border rounded p-3 mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6>Sub BOQ {{ $subIndex + 1 }}</h6>
                            <button class="btn btn-danger btn-sm"
                                @click="openModal = true; $wire.confirmDelete('sub', { mainIndex: {{ $index }}, subIndex: {{ $subIndex }} })">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                        <div class="row g-2 mb-2">
                            <div class="col-12 col-md-1">
                                <input type="text"
                                    wire:model.live="mainBoqs.{{ $index }}.subBoqs.{{ $subIndex }}.serial_number"
                                    class="form-control" placeholder="Serial No">
                            </div>
                            <div class="col-12 col-md-4">
                                <textarea type="text"
                                    wire:model.live="mainBoqs.{{ $index }}.subBoqs.{{ $subIndex }}.name"
                                    class="form-control" placeholder="Sub BOQ Name" rows="1"></textarea>
                            </div>
                            <div class="col-12 col-md-2">
                                <input type="number"
                                    wire:model.live="mainBoqs.{{ $index }}.subBoqs.{{ $subIndex }}.boqCount"
                                    class="form-control" placeholder="No. of Items">
                            </div>
                            <div class="col-12 col-md-2">
                                <button class="btn btn-secondary"
                                    wire:click="generateSubSubBoqs({{ $index }}, {{ $subIndex }})"
                                    type="button">Generate Items</button>
                            </div>
                        </div>

                        @foreach($sub['boqs'] as $bIndex => $boq)
                        <div class="row g-2 mb-2 ps-3 align-items-center">
                            <div class="col-12 col-md-1">
                                <input type="text"
                                    wire:model.live="mainBoqs.{{ $index }}.subBoqs.{{ $subIndex }}.boqs.{{ $bIndex }}.serial_number"
                                    class="form-control" placeholder="Serial">
                            </div>
                            <div class="col-12 col-md-4">
                                <textarea type="text"
                                    wire:model.live="mainBoqs.{{ $index }}.subBoqs.{{ $subIndex }}.boqs.{{ $bIndex }}.item_description"
                                    class="form-control" placeholder="Description" rows="1"></textarea>
                            </div>
                            <div class="col-12 col-md-1">
                                <input type="text"
                                    wire:model.live="mainBoqs.{{ $index }}.subBoqs.{{ $subIndex }}.boqs.{{ $bIndex }}.unit"
                                    class="form-control" placeholder="Unit">
                            </div>
                            <div class="col-12 col-md-1">
                                <input type="number"
                                    wire:model.live="mainBoqs.{{ $index }}.subBoqs.{{ $subIndex }}.boqs.{{ $bIndex }}.quantity"
                                    class="form-control" placeholder="Qty">
                            </div>
                            <div class="col-12 col-md-1">
                                <input type="number"
                                    wire:model.live="mainBoqs.{{ $index }}.subBoqs.{{ $subIndex }}.boqs.{{ $bIndex }}.unit_rate"
                                    class="form-control" placeholder="Rate">
                            </div>
                            <div class="col-12 col-md-1">
                                <input type="number" class="form-control"
                                    value="{{ (float)($boq['quantity'] ?? 0) * (float)($boq['unit_rate'] ?? 0) }}"
                                    readonly>
                            </div>
                            <div class="col-12 col-md-2">
                                <textarea type="text"
                                    wire:model.live="mainBoqs.{{ $index }}.subBoqs.{{ $subIndex }}.boqs.{{ $bIndex }}.summary"
                                    class="form-control" placeholder="Summary" rows="1"></textarea>
                            </div>
                            <div class="col-12 col-md-1">
                                <button class="btn btn-danger btn-sm"
                                    @click="openModal = true; $wire.confirmDelete('subsub', { mainIndex: {{ $index }}, subIndex: {{ $subIndex }}, boqIndex: {{ $bIndex }} })">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
            @endforeach

            @if(!empty($mainBoqs))
            <button class="btn btn-primary" wire:click="save" type="button">Save </button>
            @endif
        </div>
    </div>
    <style>

    </style>
</div> --}}

<div class="col-xl-12">
    <div class="card custom-card">
        <div class="card-header justify-content-between">
            <div class="card-title">Edit BOQ</div>
            <a href="{{ route('boq.index') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-arrow-left"></i>
            </a>
        </div>

        <div class="card-body"
            x-data="{ openModal: @entangle('showDeleteModal'), deleteType: @entangle('deleteType') }">
            <!-- Delete Modal -->
            <div x-show="openModal" class="modal-backdrop" style="display: none;"
                @click.away="openModal = false; $wire.closeModal()">
                <div class="modal-box">
                    <div class="modal-header p-0">
                        <div class="modal-title">Confirm Delete</div>
                        <button class="close-btn" @click="openModal = false; $wire.closeModal()">×</button>
                    </div>
                    <div class="modal-body">
                        Delete this <span
                            x-text="deleteType === 'main' ? 'BOQ' : deleteType === 'sub' ? 'Sub BOQ' : 'Item'"></span>?
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-cancel" @click="openModal = false; $wire.closeModal()">Cancel</button>
                        <button class="btn btn-delete"
                            @click="openModal = false; $wire[deleteType === 'main' ? 'deleteMainBoq' : deleteType === 'sub' ? 'deleteSubBoq' : deleteType === 'subsub' ? 'deleteSubSubBoq' : 'deleteMainBoqItem']()">
                            Delete
                        </button>
                    </div>
                </div>
            </div>

            <!-- Project -->
            <div class="mb-3">
                <label class="form-label">Project</label>
                <select wire:model.live="project_id" class="form-select" disabled>
                    <option value="{{ $project_id }}">{{ \App\Models\Project::find($project_id)->name }}</option>
                </select>
            </div>



            <!-- Add Main BOQ -->
            <button class="btn btn-primary mb-3" wire:click="addMainBoq" type="button">+ Add BOQ</button>

            @foreach($mainBoqs as $index => $main)
            <div class="border p-3 rounded mb-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h6>BOQ {{ $index + 1 }}</h6>
                    <button class="btn btn-danger btn-sm"
                        @click="openModal = true; $wire.confirmDelete('main', { mainIndex: {{ $index }} })">
                        Delete
                    </button>
                </div>

                <div class="row g-2 mb-2">
                    <div class="col-12 col-md-1">
                        <input type="text" wire:model.live="mainBoqs.{{ $index }}.serial_number" class="form-control"
                            placeholder="Serial">
                    </div>
                    <div class="col-12 col-md-4">
                        <input type="text" wire:model.live="mainBoqs.{{ $index }}.name" class="form-control"
                            placeholder="BOQ Name">
                    </div>
                    @if(!$main['subToggled'])
                    <div class="col-12 col-md-1">
                        <input type="number" wire:model.live="mainBoqs.{{ $index }}.boqCount" class="form-control"
                            placeholder="Items">
                    </div>
                    <div class="col-12 col-md-2">
                        <button class="btn btn-secondary" wire:click="generateMainBoqs({{ $index }})">Generate</button>
                    </div>
                    @endif
                    <div class="col-12 col-md-2 d-flex align-items-center">
                        <label class="form-label me-2 mb-0">Sub BOQ?</label>
                        <div x-data="{ toggled: @entangle('mainBoqs.'.$index.'.subToggled') }" @change.debounce.500ms="
                                if(toggled && !$wire.mainBoqs[{{ $index }}].subBoqs.length) $wire.generateSubBoqs({{ $index }});
                                else if(!toggled && !$wire.mainBoqs[{{ $index }}].boqs.length) $wire.generateMainBoqs({{ $index }});
                             " class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" x-model="toggled">
                        </div>
                    </div>
                </div>

                <!-- Main Items -->
                @if(!$main['subToggled'])
                @foreach($main['boqs'] as $bIndex => $boq)
                <div class="row g-2 mb-2 ps-3 align-items-center">
                    <div class="col-12 col-md-1"><input type="text"
                            wire:model.live="mainBoqs.{{ $index }}.boqs.{{ $bIndex }}.serial_number"
                            class="form-control" placeholder="S.No"></div>
                    <div class="col-12 col-md-4"><textarea
                            wire:model.live="mainBoqs.{{ $index }}.boqs.{{ $bIndex }}.item_description"
                            class="form-control" rows="1" placeholder="Description"></textarea></div>
                    <div class="col-12 col-md-1"><input type="text"
                            wire:model.live="mainBoqs.{{ $index }}.boqs.{{ $bIndex }}.unit" class="form-control"
                            placeholder="Unit"></div>
                    <div class="col-12 col-md-1"><input type="number"
                            wire:model.live="mainBoqs.{{ $index }}.boqs.{{ $bIndex }}.quantity" class="form-control"
                            placeholder="Qty"></div>
                    <div class="col-12 col-md-1"><input type="number"
                            wire:model.live="mainBoqs.{{ $index }}.boqs.{{ $bIndex }}.unit_rate" class="form-control"
                            placeholder="Rate"></div>
                    <div class="col-12 col-md-1"><input type="number" class="form-control"
                            value="{{ (float)($boq['quantity'] ?? 0) * (float)($boq['unit_rate'] ?? 0) }}" readonly>
                    </div>
                    <div class="col-12 col-md-2"><textarea
                            wire:model.live="mainBoqs.{{ $index }}.boqs.{{ $bIndex }}.summary" class="form-control"
                            rows="1" placeholder="Summary"></textarea></div>
                    <div class="col-12 col-md-1">
                        <button class="btn btn-danger btn-sm"
                            @click="openModal = true; $wire.confirmDelete('mainitem', { mainIndex: {{ $index }}, boqIndex: {{ $bIndex }} })">
                            Delete
                        </button>
                    </div>
                </div>
                @endforeach
                @endif

                <!-- Sub BOQs -->
                @if($main['subToggled'])
                <div class="border-start mt-3 ps-3">
                    <div class="row g-2 mb-2">
                        <div class="col-12 col-md-1"><input type="number"
                                wire:model.live="mainBoqs.{{ $index }}.subCount" class="form-control"
                                placeholder="Sub BOQs"></div>
                        <div class="col-12 col-md-2"><button class="btn btn-secondary"
                                wire:click="generateSubBoqs({{ $index }})">Generate</button></div>
                    </div>

                    @foreach($main['subBoqs'] as $subIndex => $sub)
                    <div class="border rounded p-3 mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6>Sub BOQ {{ $subIndex + 1 }}</h6>
                            <button class="btn btn-danger btn-sm"
                                @click="openModal = true; $wire.confirmDelete('sub', { mainIndex: {{ $index }}, subIndex: {{ $subIndex }} })">
                                Delete
                            </button>
                        </div>
                        <div class="row g-2 mb-2">
                            <div class="col-12 col-md-1"><input type="text"
                                    wire:model.live="mainBoqs.{{ $index }}.subBoqs.{{ $subIndex }}.serial_number"
                                    class="form-control" placeholder="S.No"></div>
                            <div class="col-12 col-md-4"><textarea
                                    wire:model.live="mainBoqs.{{ $index }}.subBoqs.{{ $subIndex }}.name"
                                    class="form-control" rows="1" placeholder="Name"></textarea></div>
                            <div class="col-12 col-md-2"><input type="number"
                                    wire:model.live="mainBoqs.{{ $index }}.subBoqs.{{ $subIndex }}.boqCount"
                                    class="form-control" placeholder="Items"></div>
                            <div class="col-12 col-md-2"><button class="btn btn-secondary"
                                    wire:click="generateSubSubBoqs({{ $index }}, {{ $subIndex }})">Generate</button>
                            </div>
                        </div>

                        @foreach($sub['boqs'] as $bIndex => $boq)
                        <div class="row g-2 mb-2 ps-3 align-items-center">
                            <div class="col-12 col-md-1"><input type="text"
                                    wire:model.live="mainBoqs.{{ $index }}.subBoqs.{{ $subIndex }}.boqs.{{ $bIndex }}.serial_number"
                                    class="form-control" placeholder="S.No"></div>
                            <div class="col-12 col-md-4"><textarea
                                    wire:model.live="mainBoqs.{{ $index }}.subBoqs.{{ $subIndex }}.boqs.{{ $bIndex }}.item_description"
                                    class="form-control" rows="1" placeholder="Desc"></textarea></div>
                            <div class="col-12 col-md-1"><input type="text"
                                    wire:model.live="mainBoqs.{{ $index }}.subBoqs.{{ $subIndex }}.boqs.{{ $bIndex }}.unit"
                                    class="form-control" placeholder="Unit"></div>
                            <div class="col-12 col-md-1"><input type="number"
                                    wire:model.live="mainBoqs.{{ $index }}.subBoqs.{{ $subIndex }}.boqs.{{ $bIndex }}.quantity"
                                    class="form-control" placeholder="Qty"></div>
                            <div class="col-12 col-md-1"><input type="number"
                                    wire:model.live="mainBoqs.{{ $index }}.subBoqs.{{ $subIndex }}.boqs.{{ $bIndex }}.unit_rate"
                                    class="form-control" placeholder="Rate"></div>
                            <div class="col-12 col-md-1"><input type="number" class="form-control"
                                    value="{{ (float)($boq['quantity'] ?? 0) * (float)($boq['unit_rate'] ?? 0) }}"
                                    readonly></div>
                            <div class="col-12 col-md-2"><textarea
                                    wire:model.live="mainBoqs.{{ $index }}.subBoqs.{{ $subIndex }}.boqs.{{ $bIndex }}.summary"
                                    class="form-control" rows="1" placeholder="Summary"></textarea></div>
                            <div class="col-12 col-md-1">
                                <button class="btn btn-danger btn-sm"
                                    @click="openModal = true; $wire.confirmDelete('subsub', { mainIndex: {{ $index }}, subIndex: {{ $subIndex }}, boqIndex: {{ $bIndex }} })">
                                    Delete
                                </button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
            @endforeach
            <!-- Tax -->
            <div class="mb-3 d-flex align-items-center gap-3">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" wire:model.live="taxEnabled">
                    <label class="form-label mb-0">Enable Tax</label>
                </div>
                @if($taxEnabled)
                <select wire:model.live="taxId" class="form-select w-auto">
                    <option value="">-- Select Tax --</option>
                    @foreach($taxes as $tax)
                    <option value="{{ $tax->id }}">{{ $tax->name }} ({{ $tax->rate }}%)</option>
                    @endforeach
                </select>
                @endif
                @error('taxId') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <!-- === TOTALS === -->
            <div class="mt-5 p-4 bg-light rounded border">
                <div class="row justify-content-end">
                    <div class="col-md-4">
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td class="text-end fw-bold pe-3">Subtotal:</td>
                                <td class="text-end">{{ number_format($subtotal, 2) }}</td>
                            </tr>
                            @if($taxEnabled && $taxId)
                            @php $tax = $taxes->firstWhere('id', $taxId); @endphp
                            <tr>
                                <td class="text-end pe-3">Tax ({{ $tax->rate ?? 0 }}%):</td>
                                <td class="text-end">{{ number_format($taxAmount, 2) }}</td>
                            </tr>
                            @endif
                            <tr class="border-top">
                                <td class="text-end fw-bold pe-3">Total:</td>
                                <td class="text-end fw-bold">{{ number_format($total, 2) }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            @if(!empty($mainBoqs))
            <button class="btn btn-primary px-4 py-2 mt-3" wire:click="save">Save</button>
            @endif
        </div>
    </div>
    <style>
        .modal-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1050;
        }

        .modal-box {
            background: white;
            border-radius: 8px;
            width: 400px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            padding: 1rem;
            border-bottom: 1px solid #dee2e6;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-title {
            font-weight: 600;
        }

        .close-btn {
            background: none;
            border: none;
            font-size: 1.5rem;
        }

        .modal-body {
            padding: 1rem;
        }

        .modal-footer {
            padding: 1rem;
            display: flex;
            justify-content: flex-end;
            gap: 0.5rem;
        }

        .btn-cancel {
            background: #6c757d;
            color: white;
        }

        .btn-delete {
            background: #dc3545;
            color: white;
        }
    </style>
</div>