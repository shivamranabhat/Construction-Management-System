<div class="col-12">
    <div class="card custom-card">
        <div class="card-header justify-content-between">
            <div class="card-title">Create</div>
            <a href="{{ route('company.index') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-arrow-left"></i>
            </a>
        </div>

        <div class="card-body">
            <form wire:submit.prevent="store" enctype="multipart/form-data">
                <div class="row gy-3">
                    <div class="col-md-6">
                        <label class="form-label">Company Name</label>
                        <input type="text" class="form-control" wire:model="name" placeholder="Company Name">
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Admin Email</label>
                        <input type="email" class="form-control" wire:model="email" placeholder="Admin Email">
                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" wire:model="password" placeholder="Password">
                        @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" wire:model="password_confirmation" placeholder="Confirm Password">
                        @error('password_confirmation') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-12" x-data="{ showPreview: false }">
                        <label class="form-label">Admin Image</label>
                        <input type="file" class="form-control" accept="image/*"
                            wire:model="image"
                            x-on:change="
                                showPreview = true;
                                $refs.preview.src = URL.createObjectURL($event.target.files[0]);
                            ">

                        <img x-ref="preview" x-show="showPreview"
                             class="mt-2 rounded" style="height:100px;width:100px;object-fit:cover;display:none;"
                             onload="this.style.display='block'">

                        @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="mt-4 d-flex">
                    <button type="submit" class="btn btn-primary">Save <x-spinner /></button>
                </div>
            </form>
        </div>
    </div>
</div>
