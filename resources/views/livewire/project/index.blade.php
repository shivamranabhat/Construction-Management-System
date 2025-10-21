<div class="col-xl-12">
    <div class="card custom-card">
        <div class="card-header">
            <div class="card-title">Projects</div>
        </div>

        <div class="card-body">
            <div class="row mb-2">
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
                        <a href="{{ route('project.create') }}" class="btn btn-sm btn-primary">
                            <i class="bi bi-plus-circle"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table text-nowrap">
                    <thead class="table-primary">
                        <tr>
                            <th>S.N.</th>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Client</th>
                            <th>Status</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Budget</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($projects as $index => $project)
                        <tr>
                            <td>{{ $projects->firstItem() + $index }}</td>
                            <td>{{ $project->name }}</td>
                            <td>{{ $project->code }}</td>
                            <td>{{ $project->client }}</td>
                            <td>
                                <span class="badge px-2 py-1 
                                        @if($project->status === 'ongoing') bg-info 
                                        @elseif($project->status === 'completed') bg-success 
                                        @elseif($project->status === 'pending') bg-danger 
                                        @else bg-secondary @endif" style="font-size:0.9rem; text-transform: capitalize;">
                                    {{ ucfirst($project->status) }}
                                </span>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($project->start_date)->format('d M Y') }}</td>
                            <td>{{ $project->end_date ? \Carbon\Carbon::parse($project->end_date)->format('d M Y') : '-'
                                }}</td>
                            <td>${{ number_format($project->budget, 2) }}</td>
                            <td>
                                <a href="{{ route('project.edit', $project->slug) }}"
                                    class="btn btn-icon btn-info-transparent rounded-pill">
                                    <i class="ri-edit-line"></i>
                                </a>
                                <button wire:click="delete('{{ $project->slug }}')"
                                    class="btn btn-icon btn-danger-transparent rounded-pill"
                                    onclick="return confirm('Are you sure you want to delete this project?')">
                                    <i class="ri-delete-bin-line"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted">No projects found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between mt-3">
                <div>
                    Showing {{ $projects->firstItem() }} to {{ $projects->lastItem() }} of {{ $projects->total() }}
                    entries
                </div>
                <div>{{ $projects->links() }}</div>
            </div>
        </div>
    </div>
</div>