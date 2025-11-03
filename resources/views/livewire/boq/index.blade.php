<div class="row row-sm">
    <!-- Search & Per Page -->
    <div class="col-sm-12 col-md-6 mb-3">
        <label class="d-inline-flex align-items-center gap-2">
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
    <div class="col-sm-12 col-md-6 mb-3 text-end">
        <input type="search" class="form-control form-control-sm d-inline-block w-auto" placeholder="Search..."
            wire:model.live="search">
        <a href="{{ route('boq.create') }}" class="btn btn-sm btn-primary">
            <i class="bi bi-plus-circle"></i>
        </a>
    </div>

    <!-- Projects Grid + Modal -->
    <div x-data="{ 
        openModal: @entangle('showDeleteModal'), 
        activeSlug: @entangle('activeSlug') 
    }" wire:poll.keep-alive>
        @forelse($projects as $project)
        @php
        $boq = $project->boqs->first();
        @endphp

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body d-flex flex-column">
                    <!-- Header -->
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <small class="text-muted">
                            {{ \Carbon\Carbon::parse($project->start_date)->format('d M Y') }}
                        </small>
                        <div class="dropdown" wire:ignore>
                            <button class="btn btn-sm p-1" data-bs-toggle="dropdown">
                                <i class="bi bi-three-dots-vertical"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="{{route('boq.preview',$boq->slug)}}" class="dropdown-item">
                                    Preview BOQ
                                </a>
                                <a href="{{ route('boq.edit', $boq->slug) }}" class="dropdown-item">
                                    Edit BOQ
                                </a>
                                <button class="dropdown-item text-danger"
                                    @click="openModal = true">
                                    Delete BOQ
                                </button>
                            </div>
                            <div x-show="openModal" class="modal-backdrop" style="display: none;">
                                    <div class="modal-box">
                                        <div class="modal-header p-0">
                                            <div class="modal-title">Confirm Delete</div>
                                            <button class="close-btn" @click="openModal = false">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete?
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-cancel" @click="openModal = false">Cancel</button>
                                            <button class="btn btn-delete"
                                                wire:click="delete('{{ $project->id }}')" @click="openModal = false">Delete</button>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>

                    <!-- Project Info -->
                    <h5 class="card-title mb-1 text-capitalize">{{ $project->name }}</h5>
                    <p class="text-muted small mb-2">{{ $project->client }}</p>

                    <span class="badge mb-3 align-self-start
                            @if($project->status === 'ongoing') bg-info
                            @elseif($project->status === 'completed') bg-success
                            @elseif($project->status === 'pending') bg-danger
                            @else bg-secondary @endif">
                        {{ ucfirst($project->status) }}
                    </span>

                    <!-- BOQ Status -->
                    <div class="mt-auto">
                        <small class="text-success">
                            <i class="bi bi-check2-circle"></i>
                            BOQ Created
                        </small>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5 text-muted">
            No projects with BOQ found.
        </div>
        @endforelse
    </div>

   @if($projects->hasPages())
    <!-- Pagination -->
    <div class="d-flex justify-content-between mt-4 w-100">
        <div>
            Showing {{ $projects->firstItem() }} to {{ $projects->lastItem() }} of {{ $projects->total() }} entries
        </div>
        <div>{{ $projects->links() }}</div>
    </div>
    @endif
</div>

@push('styles')
<style>
   
    .modal-backdrop {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1050;
    }

    .modal-box {
        background: white;
        border-radius: 8px;
        width: 400px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
    }

    .modal-header {
        padding: 1rem;
        border-bottom: 1px solid #dee2e6;
        font-weight: 600;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .modal-body {
        padding: 1rem;
    }

    .modal-footer {
        padding: 1rem;
        display: flex;
        justify-content: flex-end;
        gap: 0.5rem;
    }
</style>
@endpush