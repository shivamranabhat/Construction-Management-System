<div class="col-xl-12">
    <div class="card custom-card">
        <div class="card-header justify-content-between">
            <div class="card-title">Edit User</div>
            <a href="{{ route('account.index') }}" class="btn btn-primary btn-sm">Back</a>
        </div>

        <div class="card-body">
            <form wire:submit.prevent="update"
                x-data="{ showPreview: {{ $image || $existingImage ? 'true' : 'false' }} }" x-init="
                    window.addEventListener('hidePreview', () => { showPreview = false; $refs.preview.src=''; });
                  " enctype="multipart/form-data">

                <div class="row gy-3">
                    <div class="col-12 col-md-6">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" wire:model="name">
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" wire:model="email">
                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" wire:model="password">
                        @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" wire:model="password_confirmation">
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label">Profile Image</label>
                        <input type="file" class="form-control" accept="image/*" wire:model="image"
                            x-on:change="showPreview = true; $refs.preview.src = URL.createObjectURL($event.target.files[0])">

                        <img x-ref="preview" x-show="showPreview"
                            src="{{ $image ? $image->temporaryUrl() : ($existingImage ? asset('storage/'.$existingImage) : '') }}"
                            class="mt-2 rounded" style="height: 100px; width: 100px; object-fit: cover;">
                        @error('image') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>
                <h5 class="mt-4">Assign Roles</h5>
                <p>The user will have the access to following roles. You can restrict the permission from <a
                        href="{{route('role.index')}}" style="color:rgb(43, 28, 255);">Role</a>
                    page.</p>
                <hr>
                <div class="mt-4">
                    <label class="form-label">Role</label>
                    <select class="form-select" wire:model="selectedRole">
                        <option value="">Select a role</option>
                        @foreach($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                    @error('selectedRole') <small class="text-danger">Please select a role</small> @enderror
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Update
                        <x-spinner />
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>