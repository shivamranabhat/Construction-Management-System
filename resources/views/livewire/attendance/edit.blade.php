<div class="col-xl-12">
    <div class="card custom-card">
        <div class="card-header justify-content-between">
            <div class="card-title">Edit Attendance</div>
            <a href="{{ route('attendance.index') }}" class="btn btn-primary btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                </svg>
            </a>
        </div>

        <div class="card-body">
            <form wire:submit="update">
                <div class="row gy-4">

                    <!-- Project Select -->
                    <div class="col-xl-6">
                        <label class="form-label">Project <span class="text-danger">*</span></label>
                        <select wire:model.live="project_id"
                            class="form-select @error('project_id') is-invalid @enderror" required>
                            <option value="">Select a Project</option>
                            @foreach($userProjects as $id => $name)
                            <option value="{{ $id }}" {{ old('project_id', $project_id)==$id ? 'selected' : '' }}>
                                {{ $name }}
                            </option>
                            @endforeach
                        </select>
                        @error('project_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <!-- Worker Select -->
                    <div class="col-xl-6">
                        <label class="form-label">Worker <span class="text-danger">*</span></label>
                        <select wire:model.live="worker_id" class="form-select @error('worker_id') is-invalid @enderror"
                            required>
                            <option value="">Select a Worker</option>
                            @forelse($workers as $worker)
                            <option value="{{ $worker->id }}" {{ old('worker_id', $worker_id)==$worker->id ? 'selected'
                                : '' }}>
                                {{ $worker->name }}
                            </option>
                            @empty
                            <option value="" disabled>No workers available</option>
                            @endforelse
                        </select>
                        @error('worker_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-xl-4">
                        <label class="form-label">Date <span class="text-danger">*</span></label>
                        <input type="date" wire:model.live="date"
                            class="form-control @error('date') is-invalid @enderror" required />
                        @error('date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-xl-4">
                        <label class="form-label">In Time</label>
                        <input type="time" wire:model.live="in_time"
                            class="form-control @error('in_time') is-invalid @enderror" />
                        @error('in_time') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-xl-4">
                        <label class="form-label">Out Time</label>
                        <input type="time" wire:model.live="out_time"
                            class="form-control @error('out_time') is-invalid @enderror" />
                        @error('out_time') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                </div>

                <div class="d-flex gap-3 justify-content-end mt-4">
                    <a href="{{ route('attendance.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    @can('edit-attendance')
                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled" wire:target="update">
                        <span wire:loading.remove wire:target="update">Save</span>
                        <span wire:loading wire:target="update">
                            <span class="spinner-border spinner-border-sm"></span> Saving...
                        </span>
                    </button>
                    @else
                    <button type="button" class="btn btn-primary" disabled>Save Changes</button>
                    @endcan
                </div>
            </form>
        </div>
    </div>
</div>