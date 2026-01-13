<div class="col-xl-12">
    <div class="card custom-card">
        <div class="card-header justify-content-between">
            <div class="card-title">Add New Worker</div>
            <a href="{{ route('worker.index') }}" class="btn btn-primary btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                </svg>
            </a>
        </div>

        <div class="card-body">
            <form wire:submit="submit">
                <div class="row gy-4">
                    <div class="col-12">
                        <label class="form-label">
                            Worker Name <span class="text-danger">*</span>
                        </label>
                        <input type="text" wire:model.live="name"
                            class="form-control @error('name') is-invalid @enderror" required />
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-xl-6 col-md-6">
                        <label class="form-label">Phone</label>
                        <input type="text" wire:model.live="phone"
                            class="form-control @error('phone') is-invalid @enderror" />
                        @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-xl-6 col-md-6">
                        <label class="form-label">Role / Skill</label>
                        <input type="text" wire:model.live="role"
                            class="form-control @error('role') is-invalid @enderror"
                            placeholder="e.g., Mason, Carpenter, Electrician" />
                        @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                </div>

                <div class="d-flex gap-3 justify-content-end mt-4">
                    <a href="{{ route('worker.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    @can('create-worker')
                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled" wire:target="submit">
                        <span wire:loading.remove wire:target="submit">Save</span>
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
        </div>
    </div>
</div>