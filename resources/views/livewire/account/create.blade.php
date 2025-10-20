<div class="col-xl-12">
    <div class="card custom-card">
        <div class="card-header justify-content-between">
            <div class="card-title">Create</div>
            <a href="{{route('account.index')}}" class="btn btn-primary btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                </svg>
            </a>
        </div>

        <div class="card-body">
            <form wire:submit.prevent="store" enctype="multipart/form-data">
                <div class="row gy-3">
                    <div class="col-12 col-md-6">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" wire:model="name" placeholder="Alex Smith">
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" wire:model="email" placeholder="someone@gmail.com">
                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" wire:model="password" placeholder="******">
                        @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" placeholder="******"
                            wire:model="password_confirmation">
                        @error('password_confirmation') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3 col-12" x-data="{ showPreview: {{ $image || $existingImage ? 'true' : 'false' }} }">
                        <label class="form-label">Profile Image</label>
                        <input type="file" class="form-control" accept="image/*" wire:model="image" x-on:change="
            showPreview = true;
            $refs.preview.src = URL.createObjectURL($event.target.files[0])
        ">

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
                <div class="col-12">
                    <label class="form-label">Role</label>
                    <select class="form-select" wire:model="selectedRole">
                        <option value="">Select a role</option>
                        @foreach($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                    @error('selectedRole') <span class="text-danger">Please select a role</span> @enderror
                </div>


                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Save
                        <x-spinner />
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>