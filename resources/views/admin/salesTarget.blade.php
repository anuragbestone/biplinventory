@extends("layouts.app")
@section("mainContent")

<style>
    #orderTable th,
    #orderTable td {
        vertical-align: middle;
        white-space: nowrap;
    }

    .dataTables_wrapper {
        overflow-x: auto;
    }
</style>

    <div class="main-card content shadow-sm">
        <div class="orders">
            <!-- CARD -->
            <div class="card p-3 bg-white">
                <!-- HEADER -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="m-0">Sales Targets</h5>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#generateTargetModal">
                        New Target
                    </button>
                </div>

                <!-- TABLE -->
                <div class="table-responsive">
                    <table id="salesTable" class="table table-bordered ordertable order-tableadmin text-center">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Target Date</th>
                                <th>Employee</th>
                                <th>Given Target</th>
                                <th>Achieved Target</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($salesData)
                                @php $counter = 1 @endphp
                                @foreach($salesData as $salesDetail)
                                <tr>
                                    <td>{{ $counter++ }}</td>
                                    <td>{{ \Carbon\Carbon::parse($salesDetail["target_date"])->format("M, y") }}</td>
                                    <td>{{ $salesDetail["full_name"] }}</td>
                                    <td>
                                        <span class="badge bg-primary">
                                            {{ $salesDetail["target_quantity"] }} Cases
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge {{ $salesDetail["target_quantity"] == $salesDetail["achieved_target_quantity"] ? "bg-success" : "bg-warning" }}">
                                            {{ $salesDetail["achieved_target_quantity"] }}
                                        </span>
                                    </td>
                                    <td>
                                    <td>
                                        <button class="btn btn-info btn-sm" onclick="getSalesDetails({{ $salesDetail['id'] }})" data-bs-toggle="modal" data-bs-target="#infoModal">
                                            <i class="fa fa-info"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm">
                                            <i class="fa fa-pencil"></i>
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


        <div class="modal fade" id="infoModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>Information</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <!-- ORDER INFO -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="fw-bold">Order ID</label>
                                <input type="text" id="info_order_id" class="form-control" readonly>
                            </div>

                            <div class="col-md-6">
                                <label class="fw-bold">Order Date</label>
                                <input type="text" id="info_order_date" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="fw-bold">Dispatch Date</label>
                            <input type="text" id="info_dispatch_date" class="form-control" readonly>
                        </div>

                        <!-- SKU CARD -->
                        <div class="card bg-white p-3 mb-3 custom-sku-card">

                            <!-- HEADER -->
                            <div class="row text-center fw-bold mb-2 border-bottom pb-2">
                                <div class="col-6">SKU</div>
                                <div class="col-6">QTY</div>
                            </div>

                            <!-- DYNAMIC DATA -->
                            <div id="infoSkuContainer">
                            </div>

                        </div>

                        <!-- ADDRESS -->
                        <label class="fw-bold">Address</label>
                        <textarea
                            class="form-control"
                            rows="3"
                            id="info_dispatch_address"
                            readonly></textarea>
                    </div>
                </div>
            </div>
        </div>



        <div class="modal fade" id="generateTargetModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>Generate Target</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="{{ url("generateTarget") }}" class="generalformloader" method="post">
                        @csrf
                        <div class="modal-body">
                            <!-- TARGET DATE -->
                            <label>Target Date</label>
                            <input name="target_date" type="date" class="form-control mb-3" min="{{ date("Y-m-d") }}" required>
                            
                            <!-- TARGET QTY -->
                            <label>Target Quantity</label>
                            <input type="number" class="form-control" name="target_quantity" placeholder="cases" min="1">

                            <!-- TARGET USER -->
                            <label for="">Employee</label>
                            <select name="user_id" class="form-control" id="" required>
                                <option value="">Select User</option>
                                @if ($userData)
                                    @foreach ($userData as $uData)
                                        <option value="{{ $uData["id"] }}">{{ $uData["full_name"] ." - ". $uData["email"] }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="submit">Generate</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




<script>

    $(document).ready(function () {

        $('#salesTable').DataTable({
            responsive: true,
            autoWidth: false,
            pageLength: 10,
            ordering: true,
            searching: true,
            scrollX: true,
            columnDefs: [
                {
                    orderable: false,
                    targets: [7]
                }
            ]
        });

    });

</script>

<script>

    function getOrderDetails(orderID) {

        $.ajax({
            url: "{{ url('/getOrderDetailsData') }}",
            type: "GET",
            data: {
                orderID: orderID
            },

            success: function(response) {

                if(response.status == "success")
                {

                    let orderData =
                        response.data.orderData;

                    let orderDetails =
                        response.data.orderDetails;

                    // ORDER INFO
                    $("#info_order_id").val(
                        orderData.order_id
                    );

                    $("#info_order_date").val(
                        formatDate(orderData.order_date)
                    );

                    $("#info_dispatch_date").val(
                        formatDate(orderData.order_dispatch_date)
                    );

                    $("#info_dispatch_address").val(
                        orderData.dispatch_address ?? ''
                    );

                    // SKU HTML
                    let html = '';

                    $.each(orderDetails, function(index, item){

                        html += `
                            <div class="row text-center border-bottom py-2">
                                <div class="col-6 border-end">
                                    ${item.fg_cat_name}
                                </div>

                                <div class="col-6">
                                    ${item.fg_quantity}
                                </div>
                            </div>
                        `;
                    });

                    // APPEND
                    $("#infoSkuContainer").html(html);

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

    // DATE FORMAT
    function formatDate(dateString)
    {
        let date = new Date(dateString);

        return date.toLocaleDateString('en-GB', {
            day: '2-digit',
            month: 'short',
            year: 'numeric'
        });
    }

</script>

@endsection