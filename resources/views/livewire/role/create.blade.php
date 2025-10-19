<div class="col-xl-12">
    <div class="card custom-card">
        <div class="card-header justify-content-between">
            <div class="card-title"> Create </div>
        </div>
        <div class="card-body">
            <div class="row gy-4">
                <div class="col-12">
                    <label for="input-text" class="form-label">Name
                    </label> <input type="text" class="form-control" id="input-text"
                        placeholder="Eg: Site Owner, Supervisor, Driver..." wire:model="name">
                </div>
                <div class="col-12">
                    <label for="input-text" class="form-label">Description
                    </label> <textarea type="text" class="form-control" id="input-text" wire:model="description"
                        placeholder="Enter description"></textarea>
                </div>
            </div>
            <div class="accordion accordion-flush mt-2" id="accordionFlushExample">
                @foreach ($modules as $module)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading-{{ $module->id }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse-{{ $module->id }}" aria-expanded="false"
                            aria-controls="collapse-{{ $module->id }}">
                            {{ ucfirst($module->name) }}
                        </button>
                    </h2>

                    <div id="collapse-{{ $module->id }}" class="accordion-collapse collapse"
                        aria-labelledby="heading-{{ $module->id }}" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">

                            @if ($module->permissions->count() > 0)
                            <div class="row">
                                @foreach ($module->permissions as $permission)
                                <div class="col-md-4 mb-2">
                                    <div class="form-check fs-6">
                                        <input class="form-check-input" type="checkbox" id="perm-{{ $permission->id }}"
                                            value="{{ $permission->id }}">
                                        <label class="form-check-label" for="perm-{{ $permission->id }}">
                                            {{ ucfirst($permission->name) }}
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @else
                            <p class="text-muted mb-0 fs-5">No permissions available for this module.</p>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="button mt-4">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>

    </div>
</div>