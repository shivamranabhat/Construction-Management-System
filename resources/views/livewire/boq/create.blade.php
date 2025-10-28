<div class="col-xl-12">
    <div class="card custom-card">
        <div class="card-header justify-content-between">
            <div class="card-title">Create</div>
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
            <button class="btn btn-primary mb-3" wire:click="addMainBoq" type="button">+ Add Main BOQ</button>

            @foreach($mainBoqs as $index => $main)
                <div class="border p-3 rounded mb-3">
                    <h6>Main BOQ {{ $index + 1 }}</h6>

                    <div class="row g-2 mb-2">
                        <div class="col-12 col-md-1">
                            <input type="text" wire:model.live="mainBoqs.{{ $index }}.serial_number" class="form-control" placeholder="Serial No">
                        </div>
                        <div class="col-12 col-md-4">
                            <input type="text" wire:model.live="mainBoqs.{{ $index }}.name" class="form-control" placeholder="BOQ Name">
                        </div>
                        @if(!$main['subToggled'])
                            <div class="col-12 col-md-1">
                                <input type="number" wire:model.live="mainBoqs.{{ $index }}.boqCount" class="form-control" placeholder="No. of Items">
                            </div>
                            <div class="col-12 col-md-2">
                                <button class="btn btn-secondary" wire:click="generateMainBoqs({{ $index }})" type="button">Generate Sub BOQs</button>
                            </div>
                        @endif
                        <div class="col-12 col-md-2 d-flex align-items-center">
                            <label class="form-label me-2 mb-0">Sub BOQ?</label>
                            <div x-data="{ toggled: @entangle('mainBoqs.'.$index.'.subToggled') }" class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" x-model="toggled">
                            </div>
                        </div>
                    </div>

                    <!-- Main BOQ Items -->
                    @if(!$main['subToggled'])
                        @foreach($main['boqs'] as $bIndex => $boq)
                            <div class="row g-2 mb-2 ps-3">
                                <div class="col-12 col-md-1"><input type="text" wire:model.live="mainBoqs.{{ $index }}.boqs.{{ $bIndex }}.serial_number" class="form-control" placeholder="Serial No"></div>
                                <div class="col-12 col-md-6"><textarea wire:model.live="mainBoqs.{{ $index }}.boqs.{{ $bIndex }}.item_description" rows="1" class="form-control" placeholder="Description"></textarea></div>
                                <div class="col-12 col-md-1"><input type="text" wire:model.live="mainBoqs.{{ $index }}.boqs.{{ $bIndex }}.unit" class="form-control" placeholder="Unit"></div>
                                <div class="col-12 col-md-1"><input type="number" wire:model.live="mainBoqs.{{ $index }}.boqs.{{ $bIndex }}.quantity" class="form-control" placeholder="Qty"></div>
                                <div class="col-12 col-md-1"><input type="number" wire:model.live="mainBoqs.{{ $index }}.boqs.{{ $bIndex }}.unit_rate" class="form-control" placeholder="Rate"></div>
                                <div class="col-12 col-md-1"><input type="number" class="form-control" value="{{ (float)($boq['quantity'] ?? '') * (float)($boq['unit_rate'] ?? '') }}" placeholder="Total" readonly></div>
                            </div>
                        @endforeach
                    @endif

                    <!-- Sub BOQs -->
                    @if($main['subToggled'])
                        <div class="border-start mt-3 ps-3">
                            <div class="row g-2 mb-2">
                                <div class="col-md-2"><input type="number" wire:model.live="mainBoqs.{{ $index }}.subCount" class="form-control" placeholder="No. of Sub BOQs"></div>
                                <div class="col-md-2"><button class="btn btn-secondary" wire:click="generateSubBoqs({{ $index }})" type="button">Generate Sub BOQs</button></div>
                            </div>

                            @foreach($main['subBoqs'] as $subIndex => $sub)
                                <div class="border rounded p-3 mb-3">
                                    <h6>Sub BOQ {{ $subIndex + 1 }}</h6>
                                    <div class="row g-2 mb-2">
                                        <div class="col-12 col-md-1"><input type="text" wire:model.live="mainBoqs.{{ $index }}.subBoqs.{{ $subIndex }}.serial_number" class="form-control" placeholder="Serial No"></div>
                                        <div class="col-12 col-md-8"><textarea type="text" wire:model.live="mainBoqs.{{ $index }}.subBoqs.{{ $subIndex }}.name" class="form-control" placeholder="Sub BOQ Name" rows="1"></textarea></div>
                                        <div class="col-12 col-md-1"><input type="number" wire:model.live="mainBoqs.{{ $index }}.subBoqs.{{ $subIndex }}.boqCount" class="form-control" placeholder="No. of Items"></div>
                                        <div class="col-12 col-md-2"><button class="btn btn-secondary" wire:click="generateSubSubBoqs({{ $index }}, {{ $subIndex }})" type="button">Generate Sub BOQs</button></div>
                                    </div>

                                    @foreach($sub['boqs'] as $bIndex => $boq)
                                        <div class="row g-2 mb-2 ps-3">
                                            <div class="col-12 col-md-1"><input type="text" wire:model.live="mainBoqs.{{ $index }}.subBoqs.{{ $subIndex }}.boqs.{{ $bIndex }}.serial_number" class="form-control" placeholder="Serial No"></div>
                                            <div class="col-12 col-md-7"><textarea type="text" wire:model.live="mainBoqs.{{ $index }}.subBoqs.{{ $subIndex }}.boqs.{{ $bIndex }}.item_description" class="form-control" rows="1" placeholder="Description"></textarea></div>
                                            <div class="col-12 col-md-1"><input type="text" wire:model.live="mainBoqs.{{ $index }}.subBoqs.{{ $subIndex }}.boqs.{{ $bIndex }}.unit" class="form-control" placeholder="Unit"></div>
                                            <div class="col-12 col-md-1"><input type="number" wire:model.live="mainBoqs.{{ $index }}.subBoqs.{{ $subIndex }}.boqs.{{ $bIndex }}.quantity" class="form-control" placeholder="Qty"></div>
                                            <div class="col-12 col-md-1"><input type="number" wire:model.live="mainBoqs.{{ $index }}.subBoqs.{{ $subIndex }}.boqs.{{ $bIndex }}.unit_rate" class="form-control" placeholder="Rate"></div>
                                            <div class="col-12 col-md-1"><input type="number" class="form-control" value="{{ (float)($boq['quantity'] ?? 0) * (float)($boq['unit_rate'] ?? 0) }}" readonly></div>
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
</div>
