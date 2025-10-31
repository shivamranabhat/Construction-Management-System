<div x-data="{ openVendorModal: false }">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h5>New Purchase</h5>
            <a href="{{ route('purchases.index') }}" class="btn btn-secondary btn-sm">Back</a>
        </div>

        <div class="card-body">
            @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form wire:submit="save">
                <div class="row g-3">

                    <!-- Item -->
                    <div class="col-md-6">
                        <label class="form-label">Item <span class="text-danger">*</span></label>
                        <select wire:model="item_id" class="form-select">
                            <option value="">Select Item</option>
                            @foreach($items as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('item_id') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <!-- Quantity -->
                    <div class="col-md-3">
                        <label class="form-label">Quantity <span class="text-danger">*</span></label>
                        <input type="number" wire:model="quantity" class="form-control" min="1">
                        @error('quantity') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <!-- Unit Price -->
                    <div class="col-md-3">
                        <label class="form-label">Unit Price <span class="text-danger">*</span></label>
                        <input type="number" wire:model="unit_price" class="form-control" step="0.01" min="0">
                        @error('unit_price') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <!-- Vendor -->
                    <div class="col-md-6">
                        <label class="form-label">Vendor</label>
                        <div class="d-flex align-items-center gap-2">
                            <select wire:model="vendor_id" class="form-select flex-grow-1">
                                <option value="">Select Vendor</option>
                                @foreach($vendors as $vendor)
                                <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                                @endforeach
                            </select>
                            <button type="button" class="btn btn-outline-primary" @click="openVendorModal = true">
                                + New
                            </button>
                        </div>
                        @error('vendor_id') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <!-- Purchase Date -->
                    <div class="col-md-6">
                        <label class="form-label">Purchase Date <span class="text-danger">*</span></label>
                        <input type="date" wire:model="purchase_date" class="form-control">
                        @error('purchase_date') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                </div>

                <div class="mt-4">
                    <button class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Vendor Modal -->
    <div x-show="openVendorModal" class="modal-backdrop" style="display: none;">
        <div class="modal-box">
            <div class="modal-header p-0 d-flex justify-content-between align-items-center">
                <div class="modal-title">Add Vendor</div>
                <button class="close-btn" @click="openVendorModal = false">&times;</button>
            </div>
            <div class="modal-body">
                <div class="mb-2">
                    <label class="form-label">Name <span class="text-danger">*</span></label>
                    <input type="text" wire:model="vendor_name" class="form-control" placeholder="Vendor Name">
                    @error('vendor_name') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>
                <div class="mb-2">
                    <label class="form-label">Email</label>
                    <input type="email" wire:model="vendor_email" class="form-control" placeholder="Email">
                </div>
                <div class="mb-2">
                    <label class="form-label">Phone</label>
                    <input type="text" wire:model="vendor_phone" class="form-control" placeholder="Phone">
                </div>
                <div class="mb-2">
                    <label class="form-label">Address</label>
                    <input type="text" wire:model="vendor_address" class="form-control" placeholder="Address">
                </div>
                <div class="mb-3">
                    <label class="form-label">PAN</label>
                    <input type="text" wire:model="vendor_pan" class="form-control" placeholder="PAN">
                </div>

                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-secondary me-2"
                        @click="openVendorModal = false">Cancel</button>
                    <button type="button" class="btn btn-primary" wire:click="addVendor"
                        @click="openVendorModal = false">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>