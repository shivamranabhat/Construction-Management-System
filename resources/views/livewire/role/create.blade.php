<div class="col-xl-12">
    <div class="card custom-card">
        <div class="card-header justify-content-between">
             <div class="card-title"> Create </div>
            <a href="{{route('role.index')}}" class="btn btn-primary btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                </svg>
            </a>
        </div>

        <div class="card-body" x-data x-on:reset-select-all.window="
                    document.querySelectorAll('[id^=select-all-]').forEach(el => el.checked = false);
                    document.querySelectorAll('[class^=perm-]').forEach(el => el.checked = false);
                ">
            <form wire:submit.prevent="save">
                <div class="row gy-4">
                    <div class="col-12">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" placeholder="Eg: Site Owner, Supervisor..."
                            wire:model="name">
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" placeholder="Enter description"
                            wire:model="description"></textarea>
                        @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="accordion accordion-flush mt-4" id="accordionFlushExample">
                    @foreach ($modules as $module)
                    <div class="accordion-item" x-data="{
                        allSelected: false,
                        toggleAll() {
                            this.allSelected = !this.allSelected;
                            document.querySelectorAll('.perm-{{ $module->id }}').forEach(el => {
                                el.checked = this.allSelected;
                                el.dispatchEvent(new Event('change'));
                            });
                        }
                    }">

                        <h2 class="accordion-header" id="heading-{{ $module->id }}">
                            <button class="accordion-button collapsed fs-5" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse-{{ $module->id }}" aria-expanded="false"
                                aria-controls="collapse-{{ $module->id }}">
                                {{ ucfirst($module->name) }}
                            </button>
                        </h2>

                        <div id="collapse-{{ $module->id }}" class="accordion-collapse collapse"
                            aria-labelledby="heading-{{ $module->id }}" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">

                                @if ($module->permissions->count())
                                {{-- Select All Checkbox --}}
                                <div class="mb-3">
                                    <div class="form-check fs-5">
                                        <input class="form-check-input" type="checkbox"
                                            id="select-all-{{ $module->id }}" x-model="allSelected" @click="toggleAll">
                                        <label class="form-check-label" for="select-all-{{ $module->id }}">
                                            Select All
                                        </label>
                                    </div>
                                </div>

                                <div class="row">
                                    @foreach ($module->permissions as $permission)
                                    <div class="col-md-4 mb-2">
                                        <div class="form-check fs-5">
                                            <input class="form-check-input perm-{{ $module->id }}" type="checkbox"
                                                id="perm-{{ $permission->id }}" value="{{ $permission->id }}"
                                                wire:model="selectedPermissions">
                                            <label class="form-check-label" for="perm-{{ $permission->id }}">
                                                {{ ucfirst($permission->name) }}
                                            </label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @else
                                <p class="text-muted fs-6 mb-0">No permissions available for this module.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>


                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Save
                        <x-spinner />
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>