{{-- <div class="col-xl-12">
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
                                <div class="col-12 col-md-4"><textarea wire:model.live="mainBoqs.{{ $index }}.boqs.{{ $bIndex }}.item_description" rows="1" class="form-control" placeholder="Description"></textarea></div>
                                <div class="col-12 col-md-1"><input type="text" wire:model.live="mainBoqs.{{ $index }}.boqs.{{ $bIndex }}.unit" class="form-control" placeholder="Unit"></div>
                                <div class="col-12 col-md-1"><input type="number" wire:model.live="mainBoqs.{{ $index }}.boqs.{{ $bIndex }}.quantity" class="form-control" placeholder="Qty"></div>
                                <div class="col-12 col-md-1"><input type="number" wire:model.live="mainBoqs.{{ $index }}.boqs.{{ $bIndex }}.unit_rate" class="form-control" placeholder="Rate"></div>
                                <div class="col-12 col-md-1"><input type="number" class="form-control" value="{{ (float)($boq['quantity'] ?? '') * (float)($boq['unit_rate'] ?? '') }}" placeholder="Total" readonly></div>
                                                                <div class="col-12 col-md-3"><textarea wire:model.live="mainBoqs.{{ $index }}.boqs.{{ $bIndex }}.summary" rows="1" class="form-control" placeholder="Summary"></textarea></div>
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
                                            <div class="col-12 col-md-4"><textarea type="text" wire:model.live="mainBoqs.{{ $index }}.subBoqs.{{ $subIndex }}.boqs.{{ $bIndex }}.item_description" class="form-control" rows="1" placeholder="Description"></textarea></div>
                                            <div class="col-12 col-md-1"><input type="text" wire:model.live="mainBoqs.{{ $index }}.subBoqs.{{ $subIndex }}.boqs.{{ $bIndex }}.unit" class="form-control" placeholder="Unit"></div>
                                            <div class="col-12 col-md-1"><input type="number" wire:model.live="mainBoqs.{{ $index }}.subBoqs.{{ $subIndex }}.boqs.{{ $bIndex }}.quantity" class="form-control" placeholder="Qty"></div>
                                            <div class="col-12 col-md-1"><input type="number" wire:model.live="mainBoqs.{{ $index }}.subBoqs.{{ $subIndex }}.boqs.{{ $bIndex }}.unit_rate" class="form-control" placeholder="Rate"></div>
                                            <div class="col-12 col-md-1"><input type="number" class="form-control" value="{{ (float)($boq['quantity'] ?? 0) * (float)($boq['unit_rate'] ?? 0) }}" readonly></div>
                                            <div class="col-12 col-md-3"><textarea wire:model.live="mainBoqs.{{ $index }}.subBoqs.{{ $subIndex }}.boqs.{{ $bIndex }}.summary" rows="1" class="form-control" placeholder="Summary"></textarea>
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
</div> --}}



<div class="col-xl-12">
    <div class="card custom-card">
        <div class="card-header justify-content-between">
            <div class="card-title">Create</div>
            <a href="{{ route('boq.index') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-arrow-left"></i>
            </a>
        </div>

        <div class="card-body">
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
                                <div class="col-12 col-md-4"><textarea wire:model.live="mainBoqs.{{ $index }}.boqs.{{ $bIndex }}.item_description" rows="1" class="form-control" placeholder="Description"></textarea></div>
                                <div class="col-12 col-md-1"><input type="text" wire:model.live="mainBoqs.{{ $index }}.boqs.{{ $bIndex }}.unit" class="form-control" placeholder="Unit"></div>
                                <div class="col-12 col-md-1"><input type="number" wire:model.live="mainBoqs.{{ $index }}.boqs.{{ $bIndex }}.quantity" class="form-control" placeholder="Qty"></div>
                                <div class="col-12 col-md-1"><input type="number" wire:model.live="mainBoqs.{{ $index }}.boqs.{{ $bIndex }}.unit_rate" class="form-control" placeholder="Rate"></div>
                                <div class="col-12 col-md-1"><input type="number" class="form-control" value="{{ (float)($boq['quantity'] ?? 0) * (float)($boq['unit_rate'] ?? 0) }}" readonly></div>
                                <div class="col-12 col-md-3"><textarea wire:model.live="mainBoqs.{{ $index }}.boqs.{{ $bIndex }}.summary" rows="1" class="form-control" placeholder="Summary"></textarea></div>
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
                                        <div class="col-12 col-md-8"><textarea wire:model.live="mainBoqs.{{ $index }}.subBoqs.{{ $subIndex }}.name" class="form-control" rows="1" placeholder="Sub BOQ Name"></textarea></div>
                                        <div class="col-12 col-md-1"><input type="number" wire:model.live="mainBoqs.{{ $index }}.subBoqs.{{ $subIndex }}.boqCount" class="form-control" placeholder="No. of Items"></div>
                                        <div class="col-12 col-md-2"><button class="btn btn-secondary" wire:click="generateSubSubBoqs({{ $index }}, {{ $subIndex }})" type="button">Generate Sub BOQs</button></div>
                                    </div>

                                    @foreach($sub['boqs'] as $bIndex => $boq)
                                        <div class="row g-2 mb-2 ps-3">
                                            <div class="col-12 col-md-1"><input type="text" wire:model.live="mainBoqs.{{ $index }}.subBoqs.{{ $subIndex }}.boqs.{{ $bIndex }}.serial_number" class="form-control" placeholder="Serial No"></div>
                                            <div class="col-12 col-md-4"><textarea wire:model.live="mainBoqs.{{ $index }}.subBoqs.{{ $subIndex }}.boqs.{{ $bIndex }}.item_description" rows="1" class="form-control" placeholder="Description"></textarea></div>
                                            <div class="col-12 col-md-1"><input type="text" wire:model.live="mainBoqs.{{ $index }}.subBoqs.{{ $subIndex }}.boqs.{{ $bIndex }}.unit" class="form-control" placeholder="Unit"></div>
                                            <div class="col-12 col-md-1"><input type="number" wire:model.live="mainBoqs.{{ $index }}.subBoqs.{{ $subIndex }}.boqs.{{ $bIndex }}.quantity" class="form-control" placeholder="Qty"></div>
                                            <div class="col-12 col-md-1"><input type="number" wire:model.live="mainBoqs.{{ $index }}.subBoqs.{{ $subIndex }}.boqs.{{ $bIndex }}.unit_rate" class="form-control" placeholder="Rate"></div>
                                            <div class="col-12 col-md-1"><input type="number" class="form-control" value="{{ (float)($boq['quantity'] ?? 0) * (float)($boq['unit_rate'] ?? 0) }}" readonly></div>
                                            <div class="col-12 col-md-3"><textarea wire:model.live="mainBoqs.{{ $index }}.subBoqs.{{ $subIndex }}.boqs.{{ $bIndex }}.summary" rows="1" class="form-control" placeholder="Summary"></textarea></div>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach

           

            <!-- TAX TOGGLE & LIVE SUMMARY -->
            @if(!empty($mainBoqs))
                <div class="mt-4 border-top pt-3">

                    <!-- Toggle with wire:model.live -->
                    <div class="d-flex align-items-center mb-3">
                        <label class="form-label me-2 mb-0">Apply Tax?</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" wire:model.live="taxEnabled">
                        </div>
                    </div>

                    <!-- Tax Select (only if enabled) -->
                    @if($taxEnabled)
                        <div class="row g-2 mb-3">
                            <div class="col-md-4">
                                <select wire:model.live="taxId" class="form-select">
                                    <option value="">-- Select Tax --</option>
                                    @foreach($taxes as $tax)
                                        <option value="{{ $tax->id }}">{{ $tax->name }} ({{ $tax->rate }}%)</option>
                                    @endforeach
                                </select>
                                @error('taxId') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    @endif

                    <!-- Live Calculations -->
                    @php
                        $subtotal = collect($mainBoqs)->sum(function ($main) {
                            $sum = 0;
                            if (!($main['subToggled'] ?? false)) {
                                foreach ($main['boqs'] ?? [] as $b) {
                                    $sum += (float)($b['quantity'] ?? 0) * (float)($b['unit_rate'] ?? 0);
                                }
                            } else {
                                foreach ($main['subBoqs'] ?? [] as $sub) {
                                    foreach ($sub['boqs'] ?? [] as $b) {
                                        $sum += (float)($b['quantity'] ?? 0) * (float)($b['unit_rate'] ?? 0);
                                    }
                                }
                            }
                            return $sum;
                        });

                        $taxAmount = 0;
                        $taxRate = 0;
                        if ($taxEnabled && $taxId) {
                            $tax = $taxes->firstWhere('id', $taxId);
                            if ($tax) {
                                $taxRate = $tax->rate;
                                $taxAmount = $subtotal * $taxRate / 100;
                            }
                        }

                        $total = $subtotal + $taxAmount;
                    @endphp

                    <div class="row">
                        <div class="col-md-6 offset-md-6 text-end">
                            <table class="table table-sm table-borderless">
                                <tr>
                                    <td class="text-end fw-bold">Subtotal :</td>
                                    <td class="text-end">{{ number_format($subtotal, 2) }}</td>
                                </tr>
                                @if($taxEnabled && $taxId && $taxRate > 0)
                                    <tr>
                                        <td class="text-end">Tax ({{ $taxRate }}%) :</td>
                                        <td class="text-end">{{ number_format($taxAmount, 2) }}</td>
                                    </tr>
                                @endif
                                <tr class="border-top">
                                    <td class="text-end fw-bold">Total :</td>
                                    <td class="text-end">{{ number_format($total, 2) }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
            <!-- END TAX -->
             @if(!empty($mainBoqs))
                <button class="btn btn-primary px-4 py-2" wire:click="save" type="button">Save</button>
            @endif
        </div>
    </div>
</div>