<div class="col-xl-12">
    <div class="card custom-card">
        <div class="card-header justify-content-between">
            <div class="card-title">Create</div>
            <a href="{{ route('project.index') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-arrow-left"></i>
            </a>
        </div>

        <div class="card-body">
            <form wire:submit.prevent="store">
                <div class="row gy-3">
                    <div class="col-12 col-md-6">
                        <label class="form-label">Project Name</label>
                        <input type="text" class="form-control" wire:model="name" placeholder="Enter project name">
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label">Project Code</label>
                        <input type="text" class="form-control" wire:model="code" placeholder="Enter project code">
                        @error('code') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label">Client Name</label>
                        <input type="text" class="form-control" wire:model="client" placeholder="Enter client name">
                        @error('client') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label">Budget</label>
                        <input type="number" class="form-control" wire:model="budget" placeholder="Enter budget amount">
                        @error('budget') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label">Start Date</label>
                        <input type="date" class="form-control" wire:model="start_date">
                        @error('start_date') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label">Est. End Date</label>
                        <input type="date" class="form-control" wire:model="end_date">
                        @error('end_date') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label">Status</label>
                        <select class="form-select" wire:model="status">
                            <option value="">Select Status</option>
                            <option value="ongoing">Ongoing</option>
                            <option value="completed">Completed</option>
                            <option value="pending">Pending</option>
                        </select>
                        @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="d-flex gap-3 justify-content-end my-4">
                    <a href="{{ route('account.index') }}" class="btn btn-outline-secondary">
                        Cancel
                    </a>
                    @can('create-project')
                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled" wire:target="store">
                        <span wire:loading.remove wire:target="store">
                            Save
                        </span>
                        <span wire:loading wire:target="store">
                            <span class="spinner-border spinner-border-sm" role="status"></span>
                            Saving...
                        </span>
                    </button>
                    @else
                    <button class="btn btn-primary" disabled>
                        Save
                    </button>
                    @endcan
                </div>
            </form>
        </div>
    </div>
</div>