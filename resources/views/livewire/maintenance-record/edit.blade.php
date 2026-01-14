<div class="col-xl-12">
    <div class="card custom-card">
        <div class="card-header justify-content-between">
            <div class="card-title">Edit Maintenance Record</div>
            <a href="{{ route('maintenance-record.index') }}" class="btn btn-primary btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                     class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                          d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
                </svg>
            </a>
        </div>

        <div class="card-body">
            <form wire:submit="update">
                <div class="row gy-4">
                    <div class="col-xl-6 col-md-6">
                        <label class="form-label">Vehicle <span class="text-danger">*</span></label>
                        <select wire:model.live="vehicle_id" class="form-select @error('vehicle_id') is-invalid @enderror" required>
                            <option value="">Select Vehicle</option>
                            @foreach($vehicles as $id => $reg)
                                <option value="{{ $id }}">{{ $reg }}</option>
                            @endforeach
                        </select>
                        @error('vehicle_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-xl-6 col-md-6">
                        <label class="form-label">Project <span class="text-danger">*</span></label>
                        <select wire:model.live="project_id" class="form-select @error('project_id') is-invalid @enderror" required>
                            <option value="">Select Project</option>
                            @foreach($userProjects as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                        @error('project_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-xl-4 col-md-6">
                        <label class="form-label">Date <span class="text-danger">*</span></label>
                        <input type="date" wire:model.live="date"
                               class="form-control @error('date') is-invalid @enderror" required />
                        @error('date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-xl-8 col-md-6">
                        <label class="form-label">Description <span class="text-danger">*</span></label>
                        <input type="text" wire:model.live="description"
                               class="form-control @error('description') is-invalid @enderror" required
                               placeholder="e.g. Oil change, brake pad replacement" />
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-xl-6 col-md-6">
                        <label class="form-label">Maintenance Type</label>
                        <input type="text" wire:model.live="type"
                               class="form-control @error('type') is-invalid @enderror"
                               placeholder="e.g. Routine Service, Repair, Inspection" />
                        @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-xl-6 col-md-6">
                        <label class="form-label">Cost <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" min="0" wire:model.live="cost"
                               class="form-control @error('cost') is-invalid @enderror" required />
                        @error('cost') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-xl-6 col-md-6">
                        <label class="form-label">Service Provider</label>
                        <input type="text" wire:model.live="service_provider"
                               class="form-control @error('service_provider') is-invalid @enderror"
                               placeholder="e.g. AutoCare Garage, Local Mechanic" />
                        @error('service_provider') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label">Notes</label>
                        <textarea wire:model.live="notes" rows="3"
                                  class="form-control @error('notes') is-invalid @enderror"
                                  placeholder="Additional details, invoice number, etc..."></textarea>
                        @error('notes') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="d-flex gap-3 justify-content-end mt-4">
                    <a href="{{ route('maintenance-record.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    @can('update-vehicle')
                    <button type="submit" class="btn btn-primary"
                            wire:loading.attr="disabled" wire:target="update">
                        <span wire:loading.remove wire:target="update">Save</span>
                        <span wire:loading wire:target="update">
                            <span class="spinner-border spinner-border-sm"></span> Saving...
                        </span>
                    </button>
                    @else
                    <button type="button" class="btn btn-secondary" disabled>Save</button>
                    @endcan
                </div>
            </form>
        </div>
    </div>
</div>