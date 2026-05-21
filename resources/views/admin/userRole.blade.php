@extends("layouts.app")

@section("mainContent")
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

<div class="main-card content shadow-sm">
    <div id="users">
        <div class="card bg-white">
            <div class="card-header">
                <h4>Users Roles</h4>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Role Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Super Admin</td>
                                <td>Active</td>
                                <td>
                                    <button class="btn btn-primary btn-sm d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#assignModal">
                                        <i class="bi bi-person-plus"></i>
                                    </button>
                                </td>
                            </tr>

                            <tr>
                                <td>2</td>
                                <td>Admin</td>
                                <td>Active</td>
                                <td>
                                    <button class="btn btn-primary btn-sm d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#assignModal">
                                        <i class="bi bi-person-plus"></i>
                                    </button>
                                </td>
                            </tr>

                            <tr>
                                <td>3</td>
                                <td>Warehouse</td>
                                <td>Active</td>
                                <td>
                                    <button class="btn btn-primary btn-sm d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#assignModal">
                                        <i class="bi bi-person-plus"></i>
                                    </button>
                                </td>
                            </tr>

                            <tr>
                                <td>4</td>
                                <td>Sales Manager</td>
                                <td>Active</td>
                                <td>
                                    <button class="btn btn-primary btn-sm d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#assignModal">
                                        <i class="bi bi-person-plus"></i>
                                    </button>
                                </td>
                            </tr>

                            <tr>
                                <td>5</td>
                                <td>MIS</td>
                                <td>Active</td>
                                <td>
                                    <button class="btn btn-primary btn-sm d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#assignModal">
                                        <i class="bi bi-person-plus"></i>
                                    </button>
                                </td>
                            </tr>

                            <tr>
                                <td>6</td>
                                <td>Quality</td>
                                <td>Active</td>
                                <td>
                                    <button class="btn btn-primary btn-sm d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#assignModal">
                                        <i class="bi bi-person-plus"></i>
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
    <div class="modal fade" id="assignModal">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Assign Role to User</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <select id="multiSelect" multiple>
                        <option value="1">Books</option>
                        <option value="2">Movies</option>
                        <option value="3">Electronics</option>
                        <option value="4">Home</option>
                        <option value="5">Beauty</option>
                    </select>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Assign</button>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
                document.addEventListener("DOMContentLoaded", function () {
                    const element = document.getElementById("multiSelect");

                    new Choices(element, {
                        removeItemButton: true,
                        searchEnabled: true,
                        placeholder: true,
                        placeholderValue: "Select User",
                        itemSelectText: "",
                        shouldSort: false,
                    });
                });
            </script>

@endsection