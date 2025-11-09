<div class="container-fluid py-4">
    @if($stocks->isNotEmpty())
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 mb-4">
        <div></div>
        <div class="d-flex gap-2">
            <input type="text" wire:model.live.debounce.500ms="search" class="form-control form-control-sm"
                placeholder="Search item..." style="width: 200px;">
            <select wire:model.live="project_filter" class="form-select form-select-sm" style="width: auto;">
                <option value="">All Projects</option>
                <option value="0">Global (No Project)</option>
                @foreach($projects as $p)
                <option value="{{ $p->id }}">{{ $p->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    @endif

    <div wire:poll-keep-alive>
        @if ($stocks->isEmpty())
        <div class="text-center py-5">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-5">
                    <div class="mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor"
                            class="bi bi-box-seam text-muted" viewBox="0 0 16 16">
                            <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404 1.45L8.186 3.5l3.937 1.45L14.5 3.5l-6.314-2.387ZM13.5 5.5l-2.5 1v5l2.5 1v-6Zm-1 6.5-2-1.2v-4.6l2 1.2v4.4ZM8.5 5.5l-2.5 1v5l2.5 1v-6Zm-1 6.5-2-1.2v-4.6l2 1.2v4.4ZM2.5 5.5l2.5 1v5l-2.5 1v-6Z" />
                        </svg>
                    </div>
                    <h3 class="text-dark mb-3">No Stock Records</h3>
                    <p class="text-muted mb-4">Stock will appear here once you start making purchases.</p>
                    <a href="{{ route('purchase.create') }}" class="btn btn-primary">Create Purchase</a>
                </div>
            </div>
        </div>

        @else
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light small text-muted text-uppercase">
                            <tr>
                                <th>Item</th>
                                <th>Project</th>
                                <th class="text-center">Stock</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($stocks as $stock)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="bg-light rounded p-2">
                                            <i class="bi bi-box-seam text-primary" style="font-size:1rem"></i>
                                        </div>
                                        <div>
                                            <div class="fw-semibold">{{ $stock->item->name }}</div>
                                            <small class="text-muted">{{ $stock->item->unit ?? 'pcs' }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark">
                                        {{ $stock->project?->name ?? 'Global' }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span class="badge {{ $stock->total_stock > 0 ? 'bg-success' : 'bg-danger' }} fs-6">
                                        {{ $stock->total_stock }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('stock.show', $stock->slug) }}"
                                        class="btn btn-outline-primary btn-sm" title="View Details">
                                        View
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white border-top-0 py-3">
                {{ $stocks->links() }}
            </div>
        </div>
        @endif
    </div>
</div>