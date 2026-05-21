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
                    <h5 class="m-0">Orders</h5>

                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#generateOrderModal">
                        Generate Order
                    </button>
                </div>

                <!-- TABLE -->
                <div class="table-responsive">
                    <table id="orderTable" class="table table-bordered ordertable order-tableadmin text-center">

                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Order ID</th>
                                <th>Order Date</th>
                                <th>Production Status</th>
                                <th>Dispatch Status</th>
                                <th>Dispatch Date Given</th>
                                <th>Achieved Dispatch Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if ($orderData)
                                @php $counter = 1 @endphp
                                @foreach($orderData as $orderDetails)
                                <tr>
                                    <td>{{ $counter++ }}</td>
                                    <td>{{ $orderDetails["order_id"] }}</td>
                                    <td>{{ \Carbon\Carbon::parse($orderDetails["order_date"])->format("d M Y") }}</td>
                                    <td><span class="badge {{ $orderDetails["order_production_status"] == 1 ? "bg-success" : "bg-warning" }}">
                                        {{ $orderDetails["order_production_status"] == 1 ? "Completed" : "Pending" }}</span></td>
                                    <td><span class="badge {{ $orderDetails["order_dispatch_status"] == 1 ? "bg-success" : "bg-warning" }}">
                                        {{ $orderDetails["order_dispatch_status"] == 1 ? "Completed" : "Pending" }}</span></td>
                                    <td>{{ \Carbon\Carbon::parse($orderDetails["order_dispatch_date"])->format("d M Y") }}</td>
                                    <td>
                                        {{
                                            $orderDetails["order_dispatch_date_achieved"]
                                            ? \Carbon\Carbon::parse($orderDetails["order_dispatch_date_achieved"])->format("d M Y") : ""
                                        }}
                                    </td>
                                    <td>
                                        <button class="btn btn-info btn-sm" onclick="getOrderDetails({{ $orderDetails['id'] }})" data-bs-toggle="modal" data-bs-target="#infoModal">
                                            <i class="fa fa-info"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i>
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



        <div class="modal fade" id="generateOrderModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5>Generate Order Now</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="{{ url("generateOrder") }}" class="generalformloader" method="post">
                        @csrf
                        <div class="modal-body">

                            <!-- ORDER DATE -->
                            <label>Order Date</label>
                            <input name="order_date" type="date" class="form-control mb-3" required>

                            <!-- ORDER QTY -->
                            <label>Order Quantity</label>

                            <div class="card bg-white p-0 mb-3 custom-case-card">

                                <!-- HEADER -->
                                <div class="d-flex justify-content-between border-bottom fw-bold p-2">
                                    <span>SKU</span>
                                    <span>QTY</span>
                                </div>

                                @if ($fgCatData)
                                    @foreach ($fgCatData as $fData)
                                <!-- ROW 1 -->
                                <div class="d-flex justify-content-between border-bottom p-2">
                                    <span class="border-end pe-2 w-50">{{ $fData["fg_cat_name"] }}</span>
                                    <span class="ps-2 w-50 text-end"><input type="number" min="0" name="fgCat[{{ $fData["id"] }}]"> Cases</span>
                                </div>
                                    @endforeach
                                @endif

                            </div>

                            <!-- DISPATCH DATE -->
                            <label>Dispatch Date</label>
                            <input type="date" name="dispatch_date" class="form-control mb-3" required>

                            <!-- ADDRESS -->
                            <label>Dispatch Address</label>
                            <textarea class="form-control" name="dispatch_address" rows="3" required></textarea>

                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




<script>

    $(document).ready(function () {

        $('#orderTable').DataTable({
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