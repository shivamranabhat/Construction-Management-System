<div class="col-xl-12">
    <div class="card custom-card">
        <div class="card-header justify-content-between">
            <div class="card-title">Create User Account</div>
            <a href="{{ route('account.index') }}" class="btn btn-primary btn-sm">
                Back
            </a>
        </div>

        <div class="card-body">
            <form wire:submit.prevent="store" enctype="multipart/form-data">
                <div class="row gy-3">
                    <!-- Name & Email -->
                    <div class="col-12 col-md-6">
                        <label class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" wire:model.blur="name" placeholder="John Doe">
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" wire:model.blur="email" placeholder="john@example.com">
                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Password -->
                    <div class="col-12 col-md-6">
                        <label class="form-label">Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" wire:model.blur="password">
                        @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label">Confirm Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" wire:model.blur="password_confirmation">
                        @error('password_confirmation') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Profile Image -->
                    <div class="col-12 mb-3" x-data="{ showPreview: {{ $image ? 'true' : 'false' }} }">
                        <label class="form-label">Profile Image (Optional)</label>
                        <input type="file" class="form-control" accept="image/*" wire:model="image"
                            x-on:change="$refs.preview.src = URL.createObjectURL($event.target.files[0]); showPreview = true;">

                        <img x-ref="preview" x-show="showPreview" :src="$refs.preview?.src"
                            class="mt-3 rounded shadow-sm"
                            style="height: 120px; width: 120px; object-fit: cover; border: 2px solid #ddd;">

                        @error('image') <small class="text-danger d-block">{{ $message }}</small> @enderror
                    </div>
                </div>

                <hr class="my-5">

                <!-- Assign Role -->
                <h5>Assign Role</h5>
                <div class="col-12 col-md-6 mb-4">
                    <select class="form-select" wire:model="selectedRole">
                        <option value="">-- Select Role --</option>
                        @foreach($roles as $role)
                        <option value="{{ $role->id }}">{{ ucfirst($role->name) }}</option>
                        @endforeach
                    </select>
                    @error('selectedRole') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <hr class="my-5">

                <!-- Assign Projects via Checkboxes -->
                <h5>Assign Projects <small class="text-muted">(Optional)</small></h5>
                <p>Select the projects this user should have access to:</p>

                <div class="row">
                    @forelse($projects as $project)
                    <div class="col-12 col-md-6 col-lg-4 mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" wire:model="selectedProjects"
                                value="{{ $project->id }}" id="project-{{ $project->id }}">

                            <label class="form-check-label fw-medium" for="project-{{ $project->id }}">
                                {{ $project->name }}
                                @if($project->code)
                                <span class="text-muted small">({{ $project->code }})</span>
                                @endif
                            </label>
                        </div>
                    </div>
                    @empty
                    <div class="col-12">
                        <div class="alert alert-info">
                            No projects found for your company.
                        </div>
                    </div>
                    @endforelse
                </div>

                <!-- Selected Projects Count -->
                @if(count($selectedProjects))
                <div class="alert alert-success py-2 mt-3">
                    <strong>{{ count($selectedProjects) }}</strong> project(s) selected:
                    @foreach($projects->whereIn('id', $selectedProjects) as $proj)
                    <span class="badge bg-primary me-1">{{ $proj->name }}</span>
                    @endforeach
                </div>
                @endif

                @error('selectedProjects')
                <span class="text-danger">{{ $message }}</span>
                @enderror


                <!-- Action Buttons -->
                <div class="d-flex gap-3 justify-content-end my-4">
                    <a href="{{ route('account.index') }}" class="btn btn-outline-secondary">
                        Cancel
                    </a>
                    @can('create-account')
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
                    <button type="submit" class="btn btn-primary" disabled>
                        Save
                    </button>
                    @endcan
                </div>
            </form>
        </div>
    </div>
</div>