<div class="col-xl-12">
    <div class="card custom-card">
        <div class="card-header justify-content-between">
            <div class="card-title">Edit Vehicle</div>
            <a href="{{ route('vehicle.index') }}" class="btn btn-primary btn-sm">
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
                        <label class="form-label">
                            Registration Number <span class="text-danger">*</span>
                        </label>
                        <input type="text" wire:model.live="registration_number"
                               class="form-control @error('registration_number') is-invalid @enderror"
                               required placeholder="e.g. GJ05AB1234" />
                        @error('registration_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-xl-6 col-md-6">
                        <label class="form-label">Make</label>
                        <input type="text" wire:model.live="make"
                               class="form-control @error('make') is-invalid @enderror"
                               placeholder="e.g. Tata, Mahindra, Ashok Leyland" />
                        @error('make') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-xl-6 col-md-6">
                        <label class="form-label">Model</label>
                        <input type="text" wire:model.live="model"
                               class="form-control @error('model') is-invalid @enderror"
                               placeholder="e.g. Ace Gold, Bolero Pikup" />
                        @error('model') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-xl-6 col-md-6">
                        <label class="form-label">Fuel Type</label>
                        <select wire:model.live="fuel_type" class="form-select @error('fuel_type') is-invalid @enderror">
                            <option value="">Select Fuel Type</option>
                            <option value="Petrol">Petrol</option>
                            <option value="Diesel">Diesel</option>
                            <option value="CNG">CNG</option>
                            <option value="Electric">Electric</option>
                        </select>
                        @error('fuel_type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="d-flex gap-3 justify-content-end mt-4">
                    <a href="{{ route('vehicle.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary"
                            wire:loading.attr="disabled" wire:target="update">
                        <span wire:loading.remove wire:target="update">Save</span>
                        <span wire:loading wire:target="update">
                            <span class="spinner-border spinner-border-sm"></span> Saving...
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>