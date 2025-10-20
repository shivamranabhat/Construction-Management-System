<div class="col-xl-12">
    <div class="card custom-card">
        <div class="card-header justify-content-between">
            <div class="card-title">Edit</div>
            <a href="{{route('role.index')}}" class="btn btn-primary btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                </svg>
            </a>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="update">
                <div class="row gy-4">
                    <div class="col-12">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" wire:model="name" placeholder="Role name">
                        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" wire:model="description"
                            placeholder="Enter description"></textarea>
                        @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                <div class="accordion accordion-flush mt-4" id="accordionModules">
                    @foreach ($modules as $module)
                    <div class="accordion-item" x-data="{ allSelected: false }">
                        <h2 class="accordion-header" id="heading-{{ $module->id }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse-{{ $module->id }}" aria-expanded="false"
                                aria-controls="collapse-{{ $module->id }}">
                                {{ ucfirst($module->name) }}
                            </button>
                        </h2>

                        <div id="collapse-{{ $module->id }}" class="accordion-collapse collapse"
                            aria-labelledby="heading-{{ $module->id }}" data-bs-parent="#accordionModules">
                            <div class="accordion-body">

                                @if ($module->permissions->count())
                                <div class="mb-2">
                                    <div class="form-check fs-6">
                                        <input type="checkbox" x-model="allSelected"
                                            @click="$refs.modulePerms.querySelectorAll('input[type=checkbox]').forEach(c => c.checked = $event.target.checked); 
                                                    $refs.modulePerms.querySelectorAll('input[type=checkbox]').forEach(c => c.dispatchEvent(new Event('input')))"
                                            id="select-all-{{ $module->id }}" class="form-check-input">
                                        <label for="select-all-{{ $module->id }}" class="form-check-label fw-semibold">
                                            Select All
                                        </label>
                                    </div>
                                </div>

                                <div class="row" x-ref="modulePerms">
                                    @foreach ($module->permissions as $permission)
                                    <div class="col-md-4 mb-2">
                                        <div class="form-check fs-6">
                                            <input class="form-check-input" type="checkbox"
                                                id="perm-{{ $permission->id }}" value="{{ $permission->id }}"
                                                wire:model="selectedPermissions" @if(in_array($permission->id,
                                            $selectedPermissions)) checked @endif>

                                            <label class="form-check-label" for="perm-{{ $permission->id }}">
                                                {{ ucfirst($permission->name) }}
                                            </label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @else
                                <p class="text-muted fs-6">No permissions available.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary px-4">Save <x-spinner /></button>
                </div>
            </form>
        </div>
    </div>
</div>