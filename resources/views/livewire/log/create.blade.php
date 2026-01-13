<div class="col-xl-12">
    <div class="card custom-card">
        <div class="card-header justify-content-between">
            <div class="card-title">
                Create Daily Log
                @if($singleProject)
                <small class="text-muted">– {{ $projectName }}</small>
                @endif
            </div>
            <a href="{{ route('log.index') }}" class="btn btn-primary btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                </svg>
            </a>
        </div>

        <div class="card-body">
            @if($noProjectAccess)
            <div class="alert alert-danger">
                {{ $errors->first('project_access') }}
            </div>
            @else
            <form wire:submit="submit">
                <div class="row gy-4">
                    <!-- Project Selection -->
                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <label class="form-label">Project <span class="text-danger">*</span></label>
                        @if($singleProject)
                        <!-- Only one project → show as readonly -->
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-building"></i>
                            </span>
                            <span class="form-control form-control-sm"> {{$userProjects->first() }}</span>
                            <input type="hidden" wire:model.live="project_id" value="{{ $project_id }}">
                        </div>
                        @else
                        <!-- Multiple projects → dropdown -->
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-building"></i>
                            </span>
                            <select wire:model.live="project_id"
                                class="form-select form-select-sm @error('project_id') is-invalid @enderror" required>
                                <option value="">Select Project</option>
                                @foreach($userProjects as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @endif
                        @error('project_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    <!-- Date -->
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                        <label class="form-label">Date <span class="text-danger">*</span></label>
                        <input type="date" wire:model.live="date"
                            class="form-control @error('date') is-invalid @enderror" required />
                        @error('date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <!-- Manpower & Hours -->
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                        <label class="form-label">Manpower Count <span class="text-danger">*</span></label>
                        <input type="number" min="0" wire:model.live="manpower_count"
                            class="form-control @error('manpower_count') is-invalid @enderror" required />
                        @error('manpower_count') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                        <label class="form-label">Hours Worked <span class="text-danger">*</span></label>
                        <input type="number" min="0" wire:model.live="hours"
                            class="form-control @error('hours') is-invalid @enderror" required />
                        @error('hours') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <!-- Tasks -->
                    <div class="col-12">
                        <label class="form-label">Tasks Completed</label>
                        <textarea class="form-control" rows="4" wire:model.live="tasks"
                            placeholder="Enter tasks completed today, one per line..."></textarea>
                    </div>

                    <!-- Items Used -->
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <label class="form-label mb-0">Items Used from Stock</label>
                            <button type="button" wire:click="addItemRow" class="btn btn-outline-primary btn-sm"
                                @disabled(!$project_id)>
                                <i class="bi bi-plus-lg"></i> Add Item
                            </button>
                        </div>

                        @if(!$project_id)
                        <div class="alert alert-info">
                            Please select a project to view available stock items.
                        </div>
                        @elseif(count($itemRows) === 0)
                        <div class="text-center text-muted py-4 border rounded">
                            No items added yet.
                        </div>
                        @else
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>Item</th>
                                        <th>Quantity</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($itemRows as $index => $row)
                                    <tr>
                                        <td>
                                            <select wire:model.live="itemRows.{{ $index }}.item_id"
                                                class="form-select @error(" itemRows.$index.item_id") is-invalid
                                                @enderror">
                                                <option value="">Select Item</option>
                                                @foreach($availableStocks as $stock)
                                                <option value="{{ $stock['item_id'] }}">
                                                    {{ $stock['name'] }} ({{ $stock['available'] }} available)
                                                </option>
                                                @endforeach
                                            </select>
                                            @error("itemRows.$index.item_id")
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </td>
                                        <td>
                                            <input type="number" min="1"
                                                wire:model.live="itemRows.{{ $index }}.quantity"
                                                class="form-control @error(" itemRows.$index.quantity") is-invalid
                                                @enderror" />
                                            @error("itemRows.$index.quantity")
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </td>
                                        <td class="text-center">
                                            <button type="button" wire:click="removeItemRow({{ $index }})"
                                                class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endif

                        <small class="text-warning">
                            <strong>Note:</strong> Stock will be deducted only after admin approval.
                        </small>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="d-flex gap-3 justify-content-end mt-4">
                    <a href="{{ route('log.index') }}" class="btn btn-outline-secondary">Cancel</a>

                    @can('create-log')
                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled" wire:target="submit">
                        <span wire:loading.remove wire:target="submit">
                            Save
                        </span>
                        <span wire:loading wire:target="submit">
                            <span class="spinner-border spinner-border-sm"></span> Saving...
                        </span>
                    </button>
                    @else
                    <button class="btn btn-primary" disabled>Save
                    </button>
                    @endcan


                </div>
            </form>
            @endif
        </div>
    </div>
</div>