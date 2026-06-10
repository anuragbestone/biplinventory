@extends("layouts.app")
@section("mainContent")

<div class="main-card content shadow-sm">
    <div id="modules">
        <div class="card bg-white">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between flex-wrap">
                    <h4 class="text-left m-0 flex-grow-1">Permissions</h4>

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
                    <table class="table table-bordered" id="permissionTable">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Route Name</th>
                                <th>Route</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($permissionData)
                                @php $counter = 1 @endphp
                                @foreach ($permissionData as $pData)
                                    <tr>
                                        <td>{{ $counter++ }}</td>
                                        <td>{{ $pData["moduleData"]["module_name"] }}</td>
                                        <td>{{ $pData["moduleData"]["module_route"] }}</td>
                                        @if ($pData["rolesData"])
                                            <td>
                                                <ul>
                                                    @foreach ($pData["rolesData"] as $rData)
                                                        <li>{{ $rData["role_name"] }}</li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                        @else
                                            <td></td>
                                        @endif
                                        <td>
                                            <button class="btn btn-primary btn-sm d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#assignModal">
                                                <i class="bi bi-gear"></i>
                                            </button>
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
    <div class="modal fade" id="createmodule">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Add Permission</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label class="form-label">Route</label>
                            <select name="module_id" class="form-control" id="moduleSelect" required>
                                <option value="">Select Route</option>
                                @if ($moduleData)
                                    @foreach ($moduleData as $routeValues)
                                        <option value="{{ $routeValues['id'] }}">{{ $routeValues['module_name'].' '.$routeValues['module_route'] }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Role</label>
                            <select name="role_id[]" class="form-control" id="multiSelect" multiple required>
                                <option value="">Select Role</option>
                                @if ($roleData)
                                    @foreach ($roleData as $roleValues)
                                        <option value="{{ $roleValues['id'] }}">{{ $roleValues['role_name'] }}</option>
                                    @endforeach
                                @endif
                            </select>
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

<script>

    $("#moduleSelect").change(function(){
        $.ajax({
            url: "{{ url('getRelatedRoleByModuleID') }}",
            type: "GET",
            data: {
                module_id: $(this).val(),
            },
            success: function(response)
            {
                if (response.status == "success") {
                    // console.log(response.data);

                    // ---- Disable/Enable Buttons
                    $("#productionFgId_" + counterID).val("");
                    $("#startBtn_" + counterID).prop("disabled", false);
                    $("#submitBtn_" + counterID).prop("disabled", true);
                    $("#stopBtn_" + counterID).prop("disabled", true);
                    $("#fg_select_" + counterID).prop("disabled", false);
                    $("#qty_input_" + counterID).prop("disabled", true);
                }
            },
            error: function(error)
            {
                console.log(error);
            }
        });
    });

</script>

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

    $(document).ready(function () {
        $('#permissionTable').DataTable({
            responsive: true,
            autoWidth: false,
            pageLength: 10,
            ordering: true,
            searching: true,
            scrollX: true,
            columnDefs: [
                {
                    orderable: true,
                    targets: [0]
                }
            ]
        });

    });

</script>

@endsection