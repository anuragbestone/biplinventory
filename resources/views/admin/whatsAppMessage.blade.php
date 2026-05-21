@extends("layouts.app")

@section("mainContent")

<div class="main-card content shadow-sm">
    <div class="setting-main">
        <div class="email-template">
            <div class="d-flex align-items-center justify-content-between flex-wrap">
                <!-- Left spacer -->
                <div class="header-spacer"></div>

                <div class="production-header">
                    <h2>Whatsapp Template</h2>
                </div>
                <!-- Right Button -->
                <div>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">
                        <i class="fa-solid fa-plus"></i> Create
                    </button>
                </div>
            </div>

            <!-- TABLE CARD -->
            <div class="card bg-white">
                <div class="card-body table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Template Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Rejection Warning</td>
                                <td><span class="badge bg-success">Active</span></td>
                                <td>
                                    <!-- EDIT -->
                                    <button class="st-btn edit" data-bs-toggle="modal" data-bs-target="#editModal">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>

                                    <!-- DELETE -->
                                    <button class="st-btn delete" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>

                                    <!-- ASSIGN -->
                                    <button class="st-btn assign" data-bs-toggle="modal" data-bs-target="#assignModal">
                                        <i class="fa-solid fa-user-plus"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <div class="w-100">
                        <small>Template Name</small>
                        <h5 class="mb-0">Rejection Warning</h5>
                    </div>
                    <button class="btn-close position-absolute end-0 me-2" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div>
                        <label>Message</label>
                        <textarea class="custom-field form-control" rows="4">
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took. </textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="w-100">Rejection Warning</h5>
                    <button class="btn-close position-absolute end-0 me-2" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body text-center">
                    <h5>Do You want to Delete this template?</h5>
                </div>

                <div class="modal-footer justify-content-center">
                    <button class="btn btn-success">Yes</button>
                    <button class="btn btn-danger">No</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="assignModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Assign Whatsapp Access to User</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <label>User</label>
                    <select id="whatsappmultiSelect" multiple>
                        <option value="1">Books</option>
                        <option value="2">Movies</option>
                        <option value="3">Electronics</option>
                        <option value="4">Home</option>
                        <option value="5">Beauty</option>
                    </select>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary">Assign</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="createModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- HEADER -->
                <div class="modal-header">
                    <h5 class="w-100 text-center">Template Create</h5>
                    <button class="btn-close position-absolute end-0 me-2" data-bs-dismiss="modal"></button>
                </div>

                <!-- BODY -->
                <div class="modal-body">
                    <!-- TEMPLATE NAME -->
                    <div class="mb-2">
                        <label>Template Name</label>
                        <input type="text" class="form-control" placeholder="Enter template name" />
                    </div>

                    <!-- USER SELECT -->
                    <div class="mb-2">
                        <label>User</label>
                        <select id="multiSelect" multiple>
                            <option value="1">Books</option>
                            <option value="2">Movies</option>
                            <option value="3">Electronics</option>
                            <option value="4">Home</option>
                            <option value="5">Beauty</option>
                        </select>
                    </div>

                    <!-- BODY TEXTAREA -->
                    <div>
                        <label>Message</label>
                        <textarea class="form-control" rows="4" placeholder="Enter email content..."></textarea>
                    </div>
                </div>

                <!-- FOOTER -->
                <div class="modal-footer">
                    <button class="btn btn-primary">Create</button>
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
<script>
    document.addEventListener("DOMContentLoaded", function () {
                    const element = document.getElementById("whatsappmultiSelect");

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