@extends("layouts.app")

@section("mainContent")

<div class="main-card content shadow-sm">
    <div id="modules">
        <div class="card bg-white">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between flex-wrap">
                    <h4 class="text-left m-0 flex-grow-1">Users Modules</h4>

                    <!-- Right Button -->
                    <div>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createmodule">
                            Create
                        </button>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Module Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>FG Stock Master</td>
                                <td>Active</td>
                                <td>
                                    <button class="btn btn-primary btn-sm d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#assignModal">
                                        <i class="bi bi-gear"></i>
                                    </button>
                                </td>
                            </tr>

                            <tr>
                                <td>2</td>
                                <td>Rejection Master</td>
                                <td>Active</td>
                                <td>
                                    <button class="btn btn-primary btn-sm d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#assignModal">
                                        <i class="bi bi-gear"></i>
                                    </button>
                                </td>
                            </tr>

                            <tr>
                                <td>3</td>
                                <td>Production Line Log</td>
                                <td>Active</td>
                                <td>
                                    <button class="btn btn-primary btn-sm d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#assignModal">
                                        <i class="bi bi-gear"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="createmodule">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Create Module</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label class="form-label">Module Name</label>
                            <input type="text" class="form-control custom-field" />
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Route</label>
                            <input type="text" class="form-control custom-field" />
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Request Send</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection