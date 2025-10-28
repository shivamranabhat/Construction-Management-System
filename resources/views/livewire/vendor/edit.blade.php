<div class="col-xl-12">
    <div class="card custom-card">
        <div class="card-header justify-content-between">
            <div class="card-title"> Edit </div>
            <a href="{{route('vendor.index')}}" class="btn btn-primary btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                </svg>
            </a>
        </div>
        <form class="card-body" wire:submit='update'>
            <div class="row gy-3">
                <div class="col-md-6 col-sm-12"> <label for="input-text" class="form-label">Name</label> <input
                        type="text" class="form-control" wire:model="name" placeholder="Vendor Name">
                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6 col-sm-12"> <label for="input-text" class="form-label">Email</label> <input
                        type="text" class="form-control" wire:model="email" placeholder="Vendor Email">
                    @error('email')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6 col-sm-12"> <label for="input-text" class="form-label">Phone</label> <input
                        type="text" class="form-control" wire:model="phone" placeholder="Vendor Phone">
                    @error('phone')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6 col-sm-12"> <label for="input-text" class="form-label">Address</label> <input
                        type="text" class="form-control" wire:model="address" placeholder="Vendor Address">
                    @error('address')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-sm-12"> <label for="input-text" class="form-label">PAN</label> <input
                        type="text" class="form-control" wire:model="PAN" placeholder="Vendor PAN">
                    @error('PAN')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="button mt-4">
                    <button type="submit" class="btn btn-primary">Save
                        <x-spinner />
                    </button>
                </div>
            </div>
        </form>

    </div>
</div>