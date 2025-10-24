<div class="col-xl-8 mx-auto">
    <div class="card custom-card">
        <div class="card-header justify-content-between">
            <div class="card-title">Edit</div>
            <a href="{{ route('company.index') }}" class="btn btn-primary btn-sm"><i class="bi bi-arrow-left"></i></a>
        </div>

        <div class="card-body">
            <form wire:submit.prevent="update" enctype="multipart/form-data">
                <div class="row gy-3">
                    <div class="col-md-6">
                        <label class="form-label">Company Name</label>
                        <input type="text" class="form-control" wire:model="name">
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Admin Email</label>
                        <input type="email" class="form-control" wire:model="email">
                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" wire:model="password" placeholder="Leave blank to keep old password">
                        @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" wire:model="password_confirmation">
                        @error('password_confirmation') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-12" x-data="{ showPreview: {{ $image || $existingImage ? 'true' : 'false' }} }">
                        <label class="form-label">Admin Image</label>
                        <input type="file" class="form-control" accept="image/*"
                               wire:model="image"
                               x-on:change="
                                   showPreview = true;
                                   $refs.preview.src = URL.createObjectURL($event.target.files[0]);
                               ">

                        <img x-ref="preview" x-show="showPreview"
                             src="{{ $image ? $image->temporaryUrl() : ($existingImage ? asset('storage/'.$existingImage) : '') }}"
                             class="mt-2 rounded" style="height:100px;width:100px;object-fit:cover;">
                        @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Save <x-spinner /></button>
                </div>
            </form>
        </div>
    </div>
</div>
