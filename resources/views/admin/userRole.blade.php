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
                            @if ($roleData)
                                @php $counter = 1 @endphp
                                @foreach ($roleData as $rData)
                                    <tr>
                                        <td>{{ $counter++ }}</td>
                                        <td>{{ $rData["role_name"] }}</td>
                                        <td>{{ $rData["is_active"] = 1 ? "Active" : "Inactive" }}</td>
                                        <td>
                                            <button class="btn btn-info btn-sm" onclick="getUsersList({{ $rData['id'] }})" data-bs-toggle="modal" data-bs-target="#infoModal">
                                                <i class="fa fa-info"></i>
                                            </button>
                                            @if ($rData["id"] != 1)
                                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#assignModal">
                                                <i class="bi bi-person-plus"></i>
                                            </button>
                                            @else 
                                            
                                               <button class="btn btn-danger btn-sm" data-bs-toggle="" data-bs-target=""><i class="fa fa-x"></i></button>
                                            
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
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

    <div class="modal fade" id="infoModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Information</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">  
                    <!-- SKU CARD -->
                    <div class="card bg-white p-3 mb-3 custom-sku-card">
                        <!-- HEADER -->
                        <div class="row text-center fw-bold mb-2 border-bottom pb-2">
                            <div class="col-6">Full Name</div>
                            <div class="col-6">Email</div>
                        </div>
                        <!-- DYNAMIC DATA -->
                        <div id="infoUserContainer">
                        </div>
                    </div>
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

    function getUsersList(roleID) {
        $.ajax({
            url: "{{ url('/getUserDetailsOfRoleId') }}",
            type: "GET",
            data: {
                roleID: roleID
            },
            success: function(response) {
                if(response.status == "success") {
                    let userList = response.userList;
                    // User HTML
                    let html = '';
                    $.each(userList, function(index, item){
                        html += `
                            <div class="row text-center border-bottom py-2">
                                <div class="col-6 border-end">
                                    ${item.full_name}
                                </div>

                                <div class="col-6">
                                    ${item.email}
                                </div>
                            </div>
                        `;
                    });
                    // APPEND
                    $("#infoUserContainer").html(html);
                    // SHOW MODAL
                    $("#infoModal").modal("show");
                }
                else
                {
                    alert("No Data Found");
                }
            },
            error: function(error) {
                console.log(error);
            }
        });
    }


</script>


@endsection