<div class="container-fluid py-4">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 text-primary">
                    Edit Requisition #{{ $requisition->requisition_number }}
                </h5>
               <a href="{{ route('requisition.index') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-arrow-left"></i>
                </a>
            </div>
        </div>

        <div class="card-body p-4">
            <form wire:submit.prevent="save">
                <!-- Project & Date -->
                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Project <span class="text-danger">*</span></label>
                        <select wire:model.live="project_id" class="form-select @error('project_id') is-invalid @enderror" required>
                            <option value="">Select Project</option>
                            @foreach(auth()->user()->company->projects as $project)
                                <option value="{{ $project->id }}">{{ $project->name }}</option>
                            @endforeach
                        </select>
                        @error('project_id') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Required By <span class="text-danger">*</span></label>
                        <input type="date" wire:model="required_date" class="form-control @error('required_date') is-invalid @enderror" required>
                        @error('required_date') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Purpose -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">Purpose / Justification <span class="text-danger">*</span></label>
                    <textarea wire:model="purpose" class="form-control @error('purpose') is-invalid @enderror" rows="3" required></textarea>
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

                    @forelse($items as $index => $item)
                    <div class="row g-3 align-items-end mb-3 pb-3 border-bottom">
                        <div class="col-md-5">
                            <label class="form-label small text-muted">Item</label>
                            <select wire:model="items.{{ $index }}.item_id" class="form-select form-select-sm" required>
                                <option value="">Select Item</option>
                                @foreach($availableItems as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                            </select>
                            @error("items.{$index}.item_id") <span class="text-danger small d-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-2">
                            <label class="form-label small text-muted">Quantity</label>
                            <input type="number" step="0.01" wire:model.live="items.{{ $index }}.quantity" class="form-control form-control-sm" min="0.01" required>
                            @error("items.{$index}.quantity") <span class="text-danger small d-block">{{ $message }}</span> @enderror
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
                            <input type="text" wire:model="items.{{ $index }}.remarks" class="form-control form-control-sm">
                        </div>

                        <div class="col-md-1">
                            <button type="button" wire:click="removeItemRow({{ $index }})" class="btn btn-sm btn-outline-danger w-100">
                                Remove
                            </button>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-4 text-muted">
                        No items added yet.
                    </div>
                    @endforelse
                </div>

                <!-- Submit -->
                <div class="d-flex justify-content-end gap-3">
                    <a href="{{ route('requisition.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    <button 
                        type="submit" 
                        class="btn btn-primary"
                        wire:loading.attr="disabled"
                        wire:target="save">
                        <span wire:loading.remove wire:target="save">Update Requisition</span>
                        <span wire:loading wire:target="save">
                            <span class="spinner-border spinner-border-sm" role="status"></span>
                            Updating...
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>