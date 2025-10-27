{{-- <div class="col-xl-12">
    <div class="card custom-card">
        <div class="card-header justify-content-between">
            <div class="card-title">Edit</div>
            <a href="{{ route('boq.index') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-arrow-left"></i>
            </a>
        </div>

        <div class="card-body" x-data>
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
                    <button class="btn btn-danger btn-sm" wire:click="deleteMainBoq({{ $index }})"
                        onclick="return confirm('Are you sure you want to delete this Main BOQ?')">
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
                    <div class="col-md-2 d-flex align-items-center">
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
                    <div class="col-12 col-md-6">
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
                    <div class="col-12 col-md-1">
                        <button class="btn btn-danger btn-sm"
                            wire:click="deleteMainBoqItem({{ $index }}, {{ $bIndex }})"
                            onclick="return confirm('Are you sure you want to delete this item?')">
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
                                wire:click="deleteSubBoq({{ $index }}, {{ $subIndex }})"
                                onclick="return confirm('Are you sure you want to delete this Sub BOQ?')">
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
                                    class="form-control" placeholder="Sub BOQ Name" rows='1'></textarea>
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
                            <div class="col-12 col-md-6">
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
                            <div class="col-12 col-md-1">
                                <button class="btn btn-danger btn-sm"
                                    wire:click="deleteSubSubBoq({{ $index }}, {{ $subIndex }}, {{ $bIndex }})"
                                    onclick="return confirm('Are you sure you want to delete this item?')">
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
            <button class="btn btn-primary" wire:click="save" type="button">Update All</button>
            @endif
        </div>
    </div>
</div> --}}

<div class="col-xl-12">
    <div class="card custom-card">
        <div class="card-header justify-content-between">
            <div class="card-title">Edit</div>
            <a href="{{ route('boq.index') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-arrow-left"></i>
            </a>
        </div>

        <div class="card-body" x-data="{ openModal: @entangle('showDeleteModal'), deleteType: @entangle('deleteType') }">
            <!-- Delete Confirmation Modal -->
            <div x-show="openModal" class="modal-backdrop" style="display: none;" @click.away="openModal = false; $wire.closeModal()">
                <div class="modal-box">
                    <div class="modal-header p-0">
                        <div class="modal-title">Confirm Delete</div>
                        <button class="close-btn" @click="openModal = false; $wire.closeModal()">&times;</button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this <span x-text="deleteType === 'main' ? 'BOQ' : deleteType === 'sub' ? 'Sub BOQ' : deleteType === 'subsub' ? 'Sub BOQ Item' : 'BOQ Item'"></span>?
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
                    <button class="btn btn-danger btn-sm" @click="openModal = true; $wire.confirmDelete('main', { mainIndex: {{ $index }} })">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>

                <div class="row g-2 mb-2">
                    <div class="col-12 col-md-1">
                        <input type="text" wire:model.live="mainBoqs.{{ $index }}.serial_number" class="form-control" placeholder="Serial">
                    </div>
                    <div class="col-12 col-md-4">
                        <input type="text" wire:model.live="mainBoqs.{{ $index }}.name" class="form-control" placeholder="BOQ Name">
                    </div>
                    @if(!$main['subToggled'])
                    <div class="col-12 col-md-1">
                        <input type="number" wire:model.live="mainBoqs.{{ $index }}.boqCount" class="form-control" placeholder="No. of Items">
                    </div>
                    <div class="col-12 col-md-2">
                        <button class="btn btn-secondary" wire:click="generateMainBoqs({{ $index }})" type="button">Generate Items</button>
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
                        <input type="text" wire:model.live="mainBoqs.{{ $index }}.boqs.{{ $bIndex }}.serial_number" class="form-control" placeholder="Serial No">
                    </div>
                    <div class="col-12 col-md-6">
                        <textarea type="text" wire:model.live="mainBoqs.{{ $index }}.boqs.{{ $bIndex }}.item_description" class="form-control" placeholder="Description" rows="1"></textarea>
                    </div>
                    <div class="col-12 col-md-1">
                        <input type="text" wire:model.live="mainBoqs.{{ $index }}.boqs.{{ $bIndex }}.unit" class="form-control" placeholder="Unit">
                    </div>
                    <div class="col-12 col-md-1">
                        <input type="number" wire:model.live="mainBoqs.{{ $index }}.boqs.{{ $bIndex }}.quantity" class="form-control" placeholder="Qty">
                    </div>
                    <div class="col-12 col-md-1">
                        <input type="number" wire:model.live="mainBoqs.{{ $index }}.boqs.{{ $bIndex }}.unit_rate" class="form-control" placeholder="Rate">
                    </div>
                    <div class="col-12 col-md-1">
                        <input type="number" class="form-control" value="{{ (float)($boq['quantity'] ?? 0) * (float)($boq['unit_rate'] ?? 0) }}" readonly>
                    </div>
                    <div class="col-12 col-md-1">
                        <button class="btn btn-danger btn-sm" @click="openModal = true; $wire.confirmDelete('mainitem', { mainIndex: {{ $index }}, boqIndex: {{ $bIndex }} })">
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
                            <input type="number" wire:model.live="mainBoqs.{{ $index }}.subCount" class="form-control" placeholder="No. of Sub BOQs">
                        </div>
                        <div class="col-12 col-md-2">
                            <button class="btn btn-secondary" wire:click="generateSubBoqs({{ $index }})" type="button">Generate Sub BOQs</button>
                        </div>
                    </div>

                    @foreach($main['subBoqs'] as $subIndex => $sub)
                    <div class="border rounded p-3 mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6>Sub BOQ {{ $subIndex + 1 }}</h6>
                            <button class="btn btn-danger btn-sm" @click="openModal = true; $wire.confirmDelete('sub', { mainIndex: {{ $index }}, subIndex: {{ $subIndex }} })">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                        <div class="row g-2 mb-2">
                            <div class="col-12 col-md-1">
                                <input type="text" wire:model.live="mainBoqs.{{ $index }}.subBoqs.{{ $subIndex }}.serial_number" class="form-control" placeholder="Serial No">
                            </div>
                            <div class="col-12 col-md-4">
                                <textarea type="text" wire:model.live="mainBoqs.{{ $index }}.subBoqs.{{ $subIndex }}.name" class="form-control" placeholder="Sub BOQ Name" rows="1"></textarea>
                            </div>
                            <div class="col-12 col-md-2">
                                <input type="number" wire:model.live="mainBoqs.{{ $index }}.subBoqs.{{ $subIndex }}.boqCount" class="form-control" placeholder="No. of Items">
                            </div>
                            <div class="col-12 col-md-2">
                                <button class="btn btn-secondary" wire:click="generateSubSubBoqs({{ $index }}, {{ $subIndex }})" type="button">Generate Items</button>
                            </div>
                        </div>

                        @foreach($sub['boqs'] as $bIndex => $boq)
                        <div class="row g-2 mb-2 ps-3 align-items-center">
                            <div class="col-12 col-md-1">
                                <input type="text" wire:model.live="mainBoqs.{{ $index }}.subBoqs.{{ $subIndex }}.boqs.{{ $bIndex }}.serial_number" class="form-control" placeholder="Serial">
                            </div>
                            <div class="col-12 col-md-6">
                                <textarea type="text" wire:model.live="mainBoqs.{{ $index }}.subBoqs.{{ $subIndex }}.boqs.{{ $bIndex }}.item_description" class="form-control" placeholder="Description" rows="1"></textarea>
                            </div>
                            <div class="col-12 col-md-1">
                                <input type="text" wire:model.live="mainBoqs.{{ $index }}.subBoqs.{{ $subIndex }}.boqs.{{ $bIndex }}.unit" class="form-control" placeholder="Unit">
                            </div>
                            <div class="col-12 col-md-1">
                                <input type="number" wire:model.live="mainBoqs.{{ $index }}.subBoqs.{{ $subIndex }}.boqs.{{ $bIndex }}.quantity" class="form-control" placeholder="Qty">
                            </div>
                            <div class="col-12 col-md-1">
                                <input type="number" wire:model.live="mainBoqs.{{ $index }}.subBoqs.{{ $subIndex }}.boqs.{{ $bIndex }}.unit_rate" class="form-control" placeholder="Rate">
                            </div>
                            <div class="col-12 col-md-1">
                                <input type="number" class="form-control" value="{{ (float)($boq['quantity'] ?? 0) * (float)($boq['unit_rate'] ?? 0) }}" readonly>
                            </div>
                            <div class="col-12 col-md-1">
                                <button class="btn btn-danger btn-sm" @click="openModal = true; $wire.confirmDelete('subsub', { mainIndex: {{ $index }}, subIndex: {{ $subIndex }}, boqIndex: {{ $bIndex }} })">
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
            <button class="btn btn-primary" wire:click="save" type="button">Update All</button>
            @endif
        </div>
    </div>
    <style>

    </style>
</div>
