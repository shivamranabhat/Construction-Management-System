<div class="container-fluid py-4">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 text-primary">
                    Create Requisition
                </h5>
                 <a href="{{ route('requisition.index') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-arrow-left"></i>
            </a>
            </div>
        </div>

        <div class="card-body p-4">
            @if($errors->has('approval_chain'))
            <div class="alert alert-danger">
                <strong>Approval Chain Missing:</strong><br>
                {!! $errors->first('approval_chain') !!}
            </div>
            @endif
            <form wire:submit.prevent="save">
                <!-- Project & Date -->
                <div class="row g-4 mb-4">
                    <!-- Project Selection -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Project <span class="text-danger">*</span></label>

                        @if($singleProject)
                        <!-- Only one project → show as readonly -->
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-building"></i>
                            </span>
                            <input type="text" value="{{ $userProjects->first() }}" class="form-control" readonly>
                            <input type="hidden" wire:model="project_id" value="{{ $project_id }}">
                        </div>
                        <small class="text-muted">Your assigned project</small>
                        @else
                        <!-- Multiple projects → dropdown -->
                        <select wire:model.live="project_id"
                            class="form-select @error('project_id') is-invalid @enderror" required>
                            <option value="">Select Project</option>
                            @foreach($userProjects as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                        @error('project_id') <span class="text-danger small">{{ $message }}</span> @enderror
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Required By <span class="text-danger">*</span></label>
                        <input type="date" wire:model="required_date"
                            class="form-control @error('required_date') is-invalid @enderror" required>
                        @error('required_date') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Purpose -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">Purpose / Justification <span
                            class="text-danger">*</span></label>
                    <textarea wire:model="purpose" class="form-control @error('purpose') is-invalid @enderror" rows="3"
                        required></textarea>
                    @error('purpose') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>

                <!-- Items -->
                <div class="border rounded-3 p-4 bg-light mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="mb-0 text-primary fw-bold">Materials Required</h6>
                        <button type="button" wire:click="addItemRow" class="btn btn-sm btn-outline-success">
                            Add Item
                        </button>
                    </div>

                    @foreach($items as $index => $item)
                    <div class="row g-3 align-items-end mb-3 pb-3 border-bottom">
                        <div class="col-md-5">
                            <label class="form-label small text-muted">Item</label>
                            <input type="text" wire:model.live.debounce.300ms="itemSearch" wire:loading.remove
                                class="form-control form-control-sm" placeholder="Search item by code or name...">
                            <select wire:model="items.{{ $index }}.item_id" class="form-select form-select-sm mt-1"
                                required>
                                <option value="">Select Item</option>
                                @foreach($availableItems as $name => $id)
                                <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                            </select>
                            @error("items.{$index}.item_id") <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-2">
                            <label class="form-label small text-muted">Quantity</label>
                            <input type="number" step="0.01" wire:model="items.{{ $index }}.quantity"
                                class="form-control form-control-sm" min="0.01" required>
                        </div>

                        <div class="col-md-2">
                            <label class="form-label small text-muted">Unit</label>
                            <select wire:model="items.{{ $index }}.unit" class="form-select form-select-sm">
                                <option>nos</option>
                                <option>kg</option>
                                <option>meter</option>
                                <option>liter</option>
                                <option>box</option>
                            </select>
                        </div>

                        <div class="col-md-2">
                            <label class="form-label small text-muted">Remarks</label>
                            <input type="text" wire:model="items.{{ $index }}.remarks"
                                class="form-control form-control-sm">
                        </div>

                        <div class="col-md-1">
                            <button type="button" wire:click="removeItemRow({{ $index }})"
                                class="btn btn-sm btn-outline-danger">
                                Remove
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>

                @can('create-requisition')
                <!-- Submit -->
                <div class="d-flex justify-content-end gap-3">
                    <a href="{{ route('requisition.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                        <span wire:loading.remove>Save</span>
                        <span wire:loading>Saving...</span>
                    </button>
                </div>
                @endcan
            </form>
        </div>
    </div>
</div>