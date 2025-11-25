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
            @if ($isLocked)
            <div class="lock-screen-container">
                <div class="lock-icon">
                    <svg width="50" height="50" viewBox="0 0 24 24" fill="none">
                        <path d="M17 10H7V7a5 5 0 0 1 10 0v3z" stroke="#3B82F6" stroke-width="2"
                            stroke-linecap="round" />
                        <rect x="5" y="10" width="14" height="12" rx="2" stroke="#3B82F6" stroke-width="2" />
                    </svg>
                </div>

                <h2 class="lock-title">This requisition is locked</h2>
                <p class="lock-message">{{ $lockReason }}</p>
            </div>
            @else

            <form wire:submit.prevent="save">
                <!-- Project & Date -->
                <div class="row g-4 mb-4">
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
                        <div></div>
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
                            @error("items.{$index}.item_id") <span class="text-danger small d-block">{{ $message
                                }}</span> @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label small text-muted">Quantity</label>
                            <input type="number" step="0.01" wire:model.live="items.{{ $index }}.quantity"
                                class="form-control form-control-sm" min="0.01" required>
                            @error("items.{$index}.quantity") <span class="text-danger small d-block">{{ $message
                                }}</span> @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label small text-muted">Remarks</label>
                            <input type="text" wire:model="items.{{ $index }}.remarks"
                                class="form-control form-control-sm">
                        </div>

                        <div class="col-md-1">
                            @can('delete-requisition')
                            <button type="button" wire:click="removeItemRow({{ $index }})" class="btn text-danger"><i
                                    class="bi bi-x-lg"></i></button>
                            @endcan
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-4 text-muted">
                        No items added yet.
                    </div>
                    @endforelse
                    <div class="mt-3">
                        <button type="button" wire:click="addItemRow"
                            class="btn btn-sm btn-outline-primary d-flex align-items-center gap-1">
                            <i class="bi bi-plus-circle"></i> Add
                        </button>
                    </div>
                </div>

                <!-- Submit -->
                <div class="d-flex justify-content-end gap-3">
                    <a href="{{ route('requisition.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    @if(auth()->user()->can('update-requisition') && !$isLocked)
                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled" wire:target="save">
                        <span wire:loading.remove wire:target="save">Save</span>
                        <span wire:loading wire:target="save">
                            <span class="spinner-border spinner-border-sm" role="status"></span>
                            Saving...
                        </span>
                    </button>
                    @else
                    <button class="btn btn-primary" disabled>
                        Save
                    </button>
                    @endif
                </div>
            </form>
            @endif
        </div>
    </div>
    <style>
        .lock-screen-container {
            max-width: 600px;
            margin: 80px auto;
            padding: 40px 30px;
            background: #ffffff;
            border-radius: 16px;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .lock-icon svg {
            margin-bottom: 20px;
        }

        .lock-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #1F2937;
            margin-bottom: 8px;
        }

        .lock-message {
            font-size: 1rem;
            color: #6B7280;
            line-height: 1.5;
        }
    </style>
</div>