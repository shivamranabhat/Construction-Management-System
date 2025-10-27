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
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-body d-flex p-3 align-items-center">
                <div class="main-content-label mb-0 mg-t-8">Create Project</div>
                <div class="ms-auto"><a class="d-block fs-20" data-bs-placement="top" data-bs-toggle="tooltip"
                        href="{{route('project.create')}}" aria-label="Add New Project"
                        data-bs-original-title="Add New Project"><i class="si si-plus text-muted"></i></a> </div>
            </div>
        </div>
    </div>

    @forelse($projects as $index => $project)
    <div class="col-xl-4 col-md-6" x-data="{ openModal: false }">
        <div class="card mb-4">
            <div class="card-body p-0">
                <div class="todo-widget-header d-flex justify-content-between align-items-end pt-2 px-4">
                    <span class="fs-12 text-muted">
                        Start Date: {{ \Carbon\Carbon::parse($project->start_date)->format('d M Y') }}
                    </span>
                    
                    
                    <div class="dropdown d-flex">
                        <div class="drop-down-profile" data-bs-toggle="dropdown" role="button"><i
                                class="bi bi-three-dots-vertical"></i></div>
                        <div class="dropdown-menu fs-13"> <a class="dropdown-item"
                                href="{{ route('project.edit', $project->slug) }}">Edit</a> <a class="dropdown-item"
                                href="javascript:void(0);">Mark As Important</a> <a class="dropdown-item"
                                @click="openModal = true" role="button">Delete</a>
                            </div>
                        </div>
                        <div x-show="openModal" class="modal-backdrop" style="display: none;">
                            <div class="modal-box">
                                <div class="modal-header p-0">
                                    <div class="modal-title">Confirm Delete</div> <button class="close-btn"
                                        @click="openModal = false">&times;</button>
                                </div>
                                <div class="modal-body"> Are you sure you want to delete? </div>
                                <div class="modal-footer"> <button class="btn btn-cancel"
                                        @click="openModal = false">Cancel</button> <button class="btn btn-delete"
                                        wire:click="delete('{{ $project->slug }}')"
                                        @click="openModal = false">Delete</button> </div>
                            </div>
                        </div>
                </div>
                <div class="px-4 pb-4 pt-2 ">
                    <div class="d-flex align-items-end">

                        <h5 class="fs-5 mb-0 mt-2 text-capitalize">{{$project->name}}</h5>
                        <span class="badge px-2 py-1 ms-auto float-end 
                                            @if($project->status === 'ongoing') bg-info 
                                            @elseif($project->status === 'completed') bg-success 
                                            @elseif($project->status === 'pending') bg-danger 
                                            @else bg-secondary @endif"
                            style="font-size:0.9rem; text-transform: capitalize;">
                            {{ ucfirst($project->status) }}
                        </span>
                    </div>
                </div>
                <div class="px-4 pb-4 pt-2 border-top">
                    <h5 class="fs-14 mb-0 mt-2 text-capitalize">Code: {{$project->code}}</h5>
                    <h5 class="fs-14 mb-0 mt-2 text-capitalize">Client: {{$project->client}}</h5>
                </div>

            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="text-center text-muted">No projects found.</div>
    </div>
    @endforelse


</div>