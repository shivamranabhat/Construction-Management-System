<div x-data="{ type: @entangle('type'), openModal: false }">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h5>Create</h5>
            <a href="{{ route('item.index') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-arrow-left"></i>
            </a>
        </div>

        <div class="card-body">
            <form wire:submit="save" wire:loading.attr="disabled" wire:target="save">
                <div class="row g-3">
                    <div class="row">
                        <!-- Type -->
                        <div class="col-12 col-md-6">
                            <label class="form-label">Type <span class="text-danger">*</span></label>
                            <div class="btn-group d-flex gap-3" role="group">
                                <input type="radio" class="btn-check" id="type-product" wire:model="type"
                                    value="Product">
                                <label class="btn border"
                                    :class="type === 'Product' ? 'btn-primary text-white' : 'btn-outline-primary'"
                                    for="type-product" style="min-width: 120px;">Product</label>

                                <input type="radio" class="btn-check" id="type-service" wire:model="type"
                                    value="Service">
                                <label class="btn border"
                                    :class="type === 'Service' ? 'btn-primary text-white' : 'btn-outline-primary'"
                                    for="type-service" style="min-width: 120px;">Service</label>
                            </div>
                            @error('type') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-0 col-md-6"></div>
                    </div>


                    <!-- Name -->
                    <div class="col-12 col-md-6">
                        <label class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" wire:model="name" class="form-control" placeholder="Enter name">
                        @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                    <!-- Category -->
                    <div class="col-12 col-md-6">
                        <label class="form-label">Category</label>
                        <select wire:model="category_id" class="form-select flex-grow-1">
                            <option value="">Select a Category</option>
                            @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        <button type="button" class="btn" @click="openModal = true">
                            + New Category
                        </button>
                        @error('category_id') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <!-- Modal -->
                    <div x-show="openModal" class="modal-backdrop" style="display: none;">
                        <div class="modal-box">
                            <div class="modal-header p-0">
                                <div class="modal-title">New Category</div>
                                <button class="close-btn" @click="openModal = false">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" wire:model="category_name" class="form-control"
                                        placeholder="Enter name">
                                    @error('category_name') <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-secondary me-2"
                                        @click="openModal = false">Cancel</button>
                                    <button type="button" class="btn btn-primary" wire:click="addCategory"
                                        @click="openModal = false">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Unit -->
                    <div class="col-12 col-md-6">
                        <label class="form-label">Unit <span class="text-danger">*</span></label>
                        <input type="text" wire:model="unit" class="form-control" placeholder="e.g., kg, pcs, m">
                        @error('unit') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>


                    <!-- Reorder Level -->
                    <div class="col-12 col-md-6">
                        <label class="form-label">Reorder Level <span class="text-danger">*</span></label>
                        <input type="number" wire:model="reorder_level" class="form-control" min="0">
                        @error('reorder_level') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <!-- Description -->
                    <div class="col-12">
                        <label class="form-label">Description</label>
                        <textarea wire:model="description" class="form-control" rows="3"></textarea>
                    </div>
                </div>

                <div class="mt-4">
                    <button class="btn btn-primary">Save 
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
