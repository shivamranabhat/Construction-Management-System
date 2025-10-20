<div class="col-xl-12">
    <div class="card custom-card">
        <div class="card-header justify-content-between">
            <div class="card-title">Role List</div>
        </div>

        <div class="card-body">
            {{-- Top Controls --}}
            <div class="row mb-3">
                <div class="col-sm-12 col-md-6">
                    <div class="dataTables_length">
                        <label style="display:inline-flex; gap:0.5rem; align-items:center">
                            Show
                            <select wire:model.live="perPage" class="form-select form-select-sm w-auto">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                            entries
                        </label>
                    </div>
                </div>

                <div class="col-sm-12 col-md-6">
                    <div class="dataTables_filter d-flex justify-content-end align-items-center gap-2">
                        <label>
                            <input type="search" class="form-control form-control-sm" placeholder="Search..."
                                wire:model.live="search">
                        </label>
                        <a href="{{ route('role.create') }}" class="btn btn-sm btn-primary">
                            <i class="bi bi-plus-circle"></i>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Role Table --}}
            <div class="table-responsive">
                <table class="table text-nowrap">
                    <thead class="table-primary">
                        <tr>
                            <th scope="col">S.N.</th>
                            <th scope="col">Role Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($roles as $index => $role)
                            <tr>
                                <th scope="row">{{ $roles->firstItem() + $index }}</th>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->description ?? '—' }}</td>
                                <td>{{ $role->created_at->format('d M Y') }}</td>
                                <td>
                                    <div class="hstack gap-2 fs-6">
                                        <a href="{{ route('role.edit', $role->slug) }}"
                                            class="btn btn-icon btn-info-transparent rounded-pill">
                                            <i class="ri-edit-line"></i>
                                        </a>
                                        <button wire:click="delete({{ $role->slug }})"
                                            class="btn btn-icon btn-danger-transparent rounded-pill">
                                            <i class="ri-delete-bin-line"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">No roles found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="row mt-3">
                <div class="col-sm-12 col-md-5">
                    <div class="dataTables_info">
                        Showing {{ $roles->firstItem() ?? 0 }} to {{ $roles->lastItem() ?? 0 }} of {{ $roles->total() }} entries
                    </div>
                </div>
                <div class="col-sm-12 col-md-7 d-flex justify-content-end">
                    {{ $roles->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
