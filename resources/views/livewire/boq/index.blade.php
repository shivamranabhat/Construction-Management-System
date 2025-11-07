<div class="row row-sm">
    @if($projects->count() > 0)
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
            Create
        </a>
    </div>
    @endif

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
                                <button class="dropdown-item text-danger" @click="openModal = true">
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
                                        <button class="btn btn-delete" wire:click="delete('{{ $project->id }}')"
                                            @click="openModal = false">Delete</button>
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
        <div class="text-center py-5">
            <div class="card border-0 shadow-sm mx-auto">
                <div class="card-body p-5">
                    <!-- Icon -->
                    <div class="mb-4">
                        <svg viewBox="0 0 24 24" fill="none" width="80" height="80" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M21 6V3.50519C21 2.92196 20.3109 2.61251 19.875 2.99999C19.2334 3.57029 18.2666 3.57029 17.625 2.99999C16.9834 2.42969 16.0166 2.42969 15.375 2.99999C14.7334 3.57029 13.7666 3.57029 13.125 2.99999C12.4834 2.42969 11.5166 2.42969 10.875 2.99999C10.2334 3.57029 9.26659 3.57029 8.625 2.99999C7.98341 2.42969 7.01659 2.42969 6.375 2.99999C5.73341 3.57029 4.76659 3.57029 4.125 2.99999C3.68909 2.61251 3 2.92196 3 3.50519V14M21 10V20.495C21 21.0782 20.3109 21.3876 19.875 21.0002C19.2334 20.4299 18.2666 20.4299 17.625 21.0002C16.9834 21.5705 16.0166 21.5705 15.375 21.0002C14.7334 20.4299 13.7666 20.4299 13.125 21.0002C12.4834 21.5705 11.5166 21.5705 10.875 21.0002C10.2334 20.4299 9.26659 20.4299 8.625 21.0002C7.98341 21.5705 7.01659 21.5705 6.375 21.0002C5.73341 20.4299 4.76659 20.4299 4.125 21.0002C3.68909 21.3876 3 21.0782 3 20.495V18"
                                    stroke="rgb(1, 98, 232)" stroke-width="1.5" stroke-linecap="round"></path>
                                <path d="M7.5 15.5H11.5M16.5 15.5H14.5" stroke="rgb(1, 98, 232)" stroke-width="1.5"
                                    stroke-linecap="round"></path>
                                <path d="M16.5 12H12.5M7.5 12H9.5" stroke="rgb(1, 98, 232)" stroke-width="1.5"
                                    stroke-linecap="round"></path>
                                <path d="M7.5 8.5H16.5" stroke="rgb(1, 98, 232)" stroke-width="1.5" stroke-linecap="round">
                                </path>
                            </g>
                        </svg>

                    </div>

                    <!-- Title -->
                    <h3 class="text-dark mb-3">No BOQ Yet</h3>

                    <!-- Description -->
                    <p class="text-muted mb-4">
                        Organize your project by creating a BOQ first. This helps track costs and progress.
                    </p>

                    <!-- CTA Button -->
                    <a href="{{ route('boq.create') }}"
                        class="btn btn-primary btn-lg d-inline-flex align-items-center gap-2 px-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="bi bi-plus-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            <path
                                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                        </svg>
                        Create First BOQ
                    </a>
                </div>
            </div>
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