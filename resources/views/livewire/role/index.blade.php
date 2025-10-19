<div class="col-xl-12">
    <div class="card custom-card">
        <div class="card-header justify-content-between">
            <div class="card-title"> Index </div>
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
                        <a wire:navigate href="{{ route('role.create') }}" class="btn btn-sm btn-primary">
                            <i class="bi bi-plus-circle"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table text-nowrap">
                    <thead class="table-primary">
                        <tr>
                            <th scope="col">S.N.</th>
                            <th scope="col">Transaction Id</th>
                            <th scope="col">Created</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Harshrath</th>
                            <td>#5182-3467</td>
                            <td>24 May 2022</td>
                            <td>
                                <div class="hstack gap-2 fs-25"> <a href="javascript:void(0);"
                                        class="btn btn-icon btn-info-transparent rounded-pill"><i
                                            class="ri-edit-line"></i></a> <a href="javascript:void(0);"
                                        class="btn btn-icon btn-danger-transparent rounded-pill"><i
                                            class="ri-delete-bin-line"></i></a> </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Zozo Hadid</th>
                            <td>#5182-3412</td>
                            <td>02 July 2022</td>
                            <td>
                                <div class="hstack gap-2"> <a href="javascript:void(0);"
                                        class="btn btn-icon btn-info-transparent rounded-pill"><i
                                            class="ri-edit-line"></i></a> <a href="javascript:void(0);"
                                        class="btn btn-icon btn-danger-transparent rounded-pill"><i
                                            class="ri-delete-bin-line"></i></a> </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Martiana</th>
                            <td>#5182-3423</td>
                            <td>15 April 2022</td>
                            <td>
                                <div class="hstack gap-2"> <a href="javascript:void(0);"
                                        class="btn btn-icon btn-info-transparent rounded-pill"><i
                                            class="ri-edit-line"></i></a> <a href="javascript:void(0);"
                                        class="btn btn-icon btn-danger-transparent rounded-pill"><i
                                            class="ri-delete-bin-line"></i></a> </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Alex Carey</th>
                            <td>#5182-3456</td>
                            <td>17 March 2022</td>
                            <td>
                                <div class="hstack gap-2"> <a href="javascript:void(0);"
                                        class="btn btn-icon btn-info-transparent rounded-pill"><i
                                            class="ri-edit-line"></i></a> <a href="javascript:void(0);"
                                        class="btn btn-icon btn-danger-transparent rounded-pill"><i
                                            class="ri-delete-bin-line"></i></a> </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row mt-4">
                <div class="col-sm-12 col-md-5">
                    <div class="dataTables_info">
                        Showing 1 to 10 of 50 entries</div>
                </div>
                <div class="col-sm-12 col-md-7">
                    <div class="dataTables_paginate paging_simple_numbers d-flex justify-content-end">
                        <ul class="pagination">
                            <li class="paginate_button page-item previous" id="file-export_previous"><a href="#"
                                    aria-controls="file-export" data-dt-idx="0" tabindex="0"
                                    class="page-link">Previous</a></li>
                            <li class="paginate_button page-item active"><a href="#" aria-controls="responsiveDataTable"
                                    data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                            <li class="paginate_button page-item "><a href="#" aria-controls="responsiveDataTable"
                                    data-dt-idx="2" tabindex="0" class="page-link">2</a></li>
                            <li class="paginate_button page-item "><a href="#" aria-controls="responsiveDataTable"
                                    data-dt-idx="3" tabindex="0" class="page-link">3</a></li>
                            <li class="paginate_button page-item "><a href="#" aria-controls="responsiveDataTable"
                                    data-dt-idx="4" tabindex="0" class="page-link">4</a></li>
                            <li class="paginate_button page-item "><a href="#" aria-controls="responsiveDataTable"
                                    data-dt-idx="5" tabindex="0" class="page-link">5</a></li>
                            <li class="paginate_button page-item next" id="responsiveDataTable_next"><a href="#"
                                    aria-controls="responsiveDataTable" data-dt-idx="6" tabindex="0"
                                    class="page-link">Next</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>