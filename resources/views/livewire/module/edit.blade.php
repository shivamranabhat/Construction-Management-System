<div class="col-xl-12">
    <div class="card custom-card">
        <div class="card-header justify-content-between">
            <div class="card-title"> Edit </div>
            <a href="{{route('module.index')}}" class="btn btn-primary btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                </svg>
            </a>
        </div>
        <form class="card-body" wire:submit='update'>
            <div class="row gy-3">
                <div class="col-md-6 col-sm-12">
                    <label class="form-label">
                        Module Name <span class="text-danger">*</span>
                    </label>

                    <select class="form-select @error('name') is-invalid @enderror" wire:model="name">
                        <option value="">-- Select Module --</option>

                        @foreach([
                        'account' => 'Account',
                        'bill' => 'Bill',
                        'boq' => 'BOQ',
                        'category' => 'Category',
                        'item' => 'Item',
                        'module' => 'Module',
                        'payment' => 'Payment',
                        'project' => 'Project',
                        'purchase' => 'Purchase',
                        'requisition' => 'Requisition',
                        'role' => 'Role',
                        'tax' => 'Tax',
                        'vendor' => 'Vendor',
                        ] as $value => $label)
                        <option value="{{ $value }}" {{ $name===$value ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                        @endforeach
                    </select>

                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <small class="text-muted">
                        Changing module name will update all related permissions (e.g., view-project → view-account)
                    </small>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="d-flex gap-3 justify-content-end mt-4">
                <a href="{{ route('module.index') }}" class="btn btn-outline-secondary">
                    Cancel
                </a>
                @can('update-module')
                <button type="submit" class="btn btn-primary" wire:loading.attr="disabled" wire:target="update">
                    <span wire:loading.remove wire:target="update">
                        Save
                    </span>
                    <span wire:loading wire:target="update">
                        <span class="spinner-border spinner-border-sm" role="status"></span>
                        Saving...
                    </span>
                </button>
                @else
                <button class="btn btn-primary" disabled>
                    Save
                </button>
                @endcan
            </div>
        </form>

    </div>
</div>