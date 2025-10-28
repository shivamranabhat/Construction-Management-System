<div class="dropdown d-flex">
    @if($projects)
    <div class="drop-down-profile" data-bs-toggle="dropdown" role="button">
        <i class="bi bi-three-dots-vertical"></i>
    </div>
    <div class="dropdown-menu shadow-sm border-0 rounded-3 p-2" style="min-width: 260px;">
        <div class="d-flex justify-content-between align-items-center border-bottom mb-2">
            <div class="px-3 pb-2">
                <h6 class="fw-semibold text-secondary text-uppercase small mb-0">
                    <i class="bi bi-folder2-open me-2 text-primary" style="font-size:1rem"></i>Projects
                </h6>
            </div>
            <!-- Clear Active Project -->
            @if(session('active_project_id'))
            <span role="button" wire:click="clearActiveProject">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                    class="bi bi-arrow-counterclockwise mb-2" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 3a5 5 0 1 1-4.546 2.914.5.5 0 0 0-.908-.417A6 6 0 1 0 8 2z" />
                    <path
                        d="M8 4.466V.534a.25.25 0 0 0-.41-.192L5.23 2.308a.25.25 0 0 0 0 .384l2.36 1.966A.25.25 0 0 0 8 4.466" />
                </svg>
            </span>
            @endif
        </div>

        @forelse($projects as $project)
        <button type="button" wire:click="setActiveProject({{ $project->id }})"
            @class([ 'dropdown-item d-flex justify-content-between align-items-center rounded-2 py-2 px-3 mb-1'
            , 'bg-light text-primary fw-semibold'=> session('active_project_id') == $project->id,
            'text-dark' => session('active_project_id') != $project->id,
            ])
            >
            <span class="text-truncate">{{ $project->name }}</span>

            @if(session('active_project_id') == $project->id)
            <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill">
                Active
            </span>
            @else
            <i class="bi bi-arrow-return-right text-muted small"></i>
            @endif
        </button>
        @empty
        <div class="text-center text-muted py-2">
            <small>No projects found</small>
        </div>
        @endforelse
    </div>

    @endif
</div>