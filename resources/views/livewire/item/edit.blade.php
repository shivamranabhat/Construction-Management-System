<div x-data="{ type: @entangle('type') }">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h5>Edit</h5>
            <a href="{{ route('item.index') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-arrow-left"></i>
            </a>
        </div>
        <div class="card-body">

            <form wire:submit="update">
                <div class="row g-3">
                    <div class="row">
                        <!-- Type Toggle Buttons -->
                        <div class="col-12 col-md-6">
                            <label class="form-label">Type <span class="text-danger">*</span></label>
                            <div class="btn-group d-flex gap-3" role="group">
                                <input type="radio" class="btn-check" id="type-product" wire:model="type"
                                    value="Product">
                                <label class="btn border"
                                    :class="type === 'Product' ? 'btn-primary text-white' : 'btn-outline-primary'"
                                    for="type-product" style="min-width: 120px;" x-on:click="type = 'Product'">
                                    Product
                                </label>

                                <input type="radio" class="btn-check" id="type-service" wire:model="type"
                                    value="Service">
                                <label class="btn border"
                                    :class="type === 'Service' ? 'btn-primary text-white' : 'btn-outline-primary'"
                                    for="type-service" style="min-width: 120px;" x-on:click="type = 'Service'">
                                    Service
                                </label>
                            </div>
                            @error('type') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-0 col-md-6"></div>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" wire:model.live="name" class="form-control" required>
                        @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label">Category</label>
                        <select wire:model="category_id" class="form-select">
                            <option value="">Select a Category</option>
                            @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>


                    <div class="col-12 col-md-6">
                        <label class="form-label">Unit <span class="text-danger">*</span></label>
                        <input type="text" wire:model.live="unit" class="form-control" required>
                        @error('unit') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label">Reorder Level <span class="text-danger">*</span></label>
                        <input type="number" wire:model.live="reorder_level" class="form-control" min="0" required>
                        @error('reorder_level') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label">Description</label>
                        <textarea wire:model.live="description" class="form-control" rows="3"></textarea>
                    </div>


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