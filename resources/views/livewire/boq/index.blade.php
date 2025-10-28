<div class="row row-sm">
    <div class="col-sm-12 col-md-6 mb-3">
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
    <div class="col-sm-12 col-md-6 mb-3">
        <div class="dataTables_filter d-flex justify-content-end align-items-center gap-2">
            <label>
                <input type="search" class="form-control form-control-sm" placeholder="Search..."
                    wire:model.live="search">
            </label>
            <a href="{{ route('boq.create') }}" class="btn btn-sm btn-primary">
                <i class="bi bi-plus-circle"></i> Create BOQ
            </a>
        </div>
    </div>

    <div x-data="{ openModal: false, activeBoqSlug: null }" wire:poll.keep-alive>
        @forelse($projects as $index => $project)
        <div class="col-xl-4 col-md-6">
            <div class="card mb-4">
                <div class="card-body p-0">
                    <div class="todo-widget-header d-flex justify-content-between align-items-end px-4 pt-4">
                        <span class="fs-12 text-muted">
                            Start Date: {{ \Carbon\Carbon::parse($project->start_date)->format('d M Y') }}
                        </span>
                        <div class="dropdown d-flex" wire:ignore>
                            <div class="drop-down-profile" data-bs-toggle="dropdown" role="button">
                                <i class="bi bi-three-dots-vertical"></i>
                            </div>
                            <div class="dropdown-menu fs-13">
                                <a class="dropdown-item" href="{{ route('project.edit', $project->slug) }}">Preview</a>
                                <a class="dropdown-item" href="{{ route('project.edit', $project->slug) }}">Download</a>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 pb-4 pt-2">
                        <div class="d-flex align-items-end">
                            <h5 class="fs-5 mb-0 mt-2 text-capitalize">{{ $project->name }}</h5>
                            <span class="badge px-2 py-1 ms-auto float-end 
                                @if($project->status === 'ongoing') bg-info 
                                @elseif($project->status === 'completed') bg-success 
                                @elseif($project->status === 'pending') bg-danger 
                                @else bg-secondary @endif"
                                style="font-size:0.9rem; text-transform: capitalize;">
                                {{ ucfirst($project->status) }}
                            </span>
                        </div>

                        <!-- BOQs for this Project -->
                        <div class="mt-3">
                            <h6 class="fs-14 mb-2">Bills of Quantities</h6>
                            <ul class="list-group">
                                @foreach($project->boqs as $boq)
                                <li class="list-group-item">
                                    <div class="d-flex justify-content-between align-items-end">
                                        <strong>{{ $boq->name }}</strong>
                                        <div class="dropdown d-flex">
                                            <div class="drop-down-profile" data-bs-toggle="dropdown" role="button">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </div>
                                            <div class="dropdown-menu fs-13" wire:ignore>
                                                <a class="dropdown-item" href="{{ route('boq.edit', $boq->slug) }}">Edit BOQ</a>
                                                <a class="dropdown-item"
                                                   @click="openModal = true; activeBoqSlug = '{{ $boq->slug }}'"
                                                   role="button">Delete BOQ</a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="text-center text-muted">No projects with BOQs found.</div>
        </div>
        @endforelse

        <!-- Single Modal Outside the Loop -->
        <div x-show="openModal" class="modal-backdrop" style="display: none;" @click.outside="openModal = false">
            <div class="modal-box">
                <div class="modal-header p-0">
                    <div class="modal-title">Confirm Delete</div>
                    <button class="close-btn" @click="openModal = false">&times;</button>
                </div>
                <div class="modal-body">Are you sure you want to delete?</div>
                <div class="modal-footer">
                    <button class="btn btn-cancel" @click="openModal = false">Cancel</button>
                    <button class="btn btn-delete" wire:click="delete(activeBoqSlug)" @click="openModal = false">Delete</button>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between mt-3">
            <div>
                Showing {{ $projects->firstItem() }} to {{ $projects->lastItem() }} of {{ $projects->total() }} entries
            </div>
            <div>{{ $projects->links() }}</div>
        </div>
    </div>

  
</div>