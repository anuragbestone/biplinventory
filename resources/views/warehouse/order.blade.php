@extends("layouts.app")

@section("mainContent")

<div class="main-card content shadow-sm">

    <div class="user-order bg-white">
        <div class="table-responsive">
            <table class="table table-bordered user-orders" id="orderTable">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Order ID</th>
                        <th>Order Date</th>
                        <th>Order Items Details</th>
                        <th>Production Status</th>
                        <th>Dispatch Address</th>
                        <th>Dispatch Date</th>
                        <th>Dispatch Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @if ($orderData)
                        @php $counter = 1 @endphp
                        @foreach ($orderData as $oValues)
                            <tr>
                                <td>{{ $counter++ }}</td>
                                <td>{{ $oValues["order"]["order_id"] }}</td>
                                <td>{{ $oValues["order"]["order_date"] }}</td>
                                <td>
                                    <div class="os-card-wrap">
                                        @if ($oValues["details"])
                                        <div class="os-card">
                                            <div class="os-card-body">
                                                <div>
                                                    <span><b>Category</b></span
                                                                ><span><b>Qty</b></span>
                                                </div>
                                                @foreach ($oValues["details"] as $details)
                                                    <div><span>{{ $details["fg_cat_name"] }} ({{ $details["fg_name"] }})</span><span>{{ $details["fg_quantity"] }} cases</span></div>
                                                @endforeach
                                            </div>
                                        </div>
                                        @endif


                                    </div>
                                </td>
                                <td><span class="badge bg-{{ $oValues["order"]["order_production_status"] == 0 ? 'warning' : 'success' }}">
                                    {{ $oValues["order"]["order_production_status"] == 0 ? 'Pending' : 'Processed' }}</span></td>

                                <td>{{ $oValues["order"]["dispatch_address"] }}</td>
                                <td>{{ $oValues["order"]["order_dispatch_date"] }}</td>
                                <td><span class="badge bg-{{ $oValues["order"]["order_dispatch_status"] == 0 ? 'warning' : 'success' }}">
                                    {{ $oValues["order"]["order_dispatch_status"] == 0 ? 'Pending' : 'Processed' }}</span></td>
                                <td>

                                    <button class="os-edit-btn has-tooltip" 
                                        onclick="dispatchOrder('{{ $oValues['order']['order_id'] }}')" 
                                        title="Dispatch" 
                                        data-bs-placement="top"
                                        {{ $oValues["order"]["order_dispatch_status"] == 1 ? "disabled" : "" }}
                                        >
                                        <i class="fa-solid fa-truck"></i>
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

<div class="modal fade" id="userdispatchModal">
    <div class="modal-dialog modal-dialog-centered">
        <form action="{{ url('warehouse/dispatchOrder') }}" method="post" class="generalformloader">
            @csrf
            <input type="hidden" name="order_id" id="order_id">
            <div class="modal-content rmpm-modal">
                <!-- HEADER -->
                <div class="modal-header">
                    <h4 class="mb-0">Dispatch Updates</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- BODY -->
                <div class="modal-body">
                    <div class="order-field text-center">
                        <label>Date</label>
                        <div class="rmpm-date">{{ \Carbon\Carbon::now()->format('d M Y') }}</div>
                    </div>

                    <!-- SHIFT ROW -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="order-field">
                                <label>Shift From</label>
                                <input type="text" class="custom-field form-control" name="shift_from" value="{{ session("shift_from") }}" readonly />
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="order-field">
                                <label>Shift To</label>
                                <input type="text" class="custom-field form-control" name="shift_to" value="{{ session("shift_to") }}" readonly />
                            </div>
                        </div>
                    </div>

                    <!-- SKU CARD -->
                    <div class="card bg-white p-3 mb-3 custom-sku-card mt-4">
                        <label class="text-center">Order Details</label>
                        <!-- HEADER -->
                        <div class="row text-center fw-bold mb-2 border-bottom pb-2">
                            <div class="col-3">SKU</div>
                            <div class="col-3">Given QTY</div>
                            <div class="col-6">Achieved QTY</div>
                        </div>

                        <!-- DYNAMIC DATA -->
                        <div id="infoSkuContainer">

                        </div>

                    </div>

                    <div class="order-field">
                        <label>Dispatch Status</label>
                        <select class="custom-field form-control" name="dispatch_status">
                            <option value="pending">Pending</option>
                            <option value="completed">Complete</option>
                        </select>
                    </div>
                </div>

                <!-- FOOTER -->
                <div class="modal-footer rmpm-footer">
                    <button class="btn btn-primary" type="submit">Submit</button>

                </div>
            </div>
        </form>
    </div>
</div>

<script>

    $(document).ready(function () {

        $('#orderTable').DataTable({
            responsive: true,
            autoWidth: true,
            pageLength: 5,
            ordering: true,
            searching: true,
            scrollX: true,
            columnDefs: [
                {
                    orderable: true,
                }
            ]
        });

    });

</script>

<script>
    function dispatchOrder(orderID) {
        $.ajax({
            url: "{{ url('/warehouse/getOrderDetailsDataByOrderCode') }}",
            type: "GET",
            data: {
                orderID: orderID
            },

            success: function(response) {

                if(response.status == "success") {
                    let orderDetails = response.data.orderDetails;

                    // SKU HTML
                    let html = '';

                    $.each(orderDetails, function(index, item){

                        html += `
                            <div class="row text-center border-bottom py-2 align-items-center">

                                <div class="col-3 border-end">
                                    ${item.fg_cat_name}
                                </div>

                                <div class="col-3 border-end">
                                    ${item.fg_quantity} cases
                                </div>

                                <div class="col-6">
                                    <div class="row g-2">

                                        <div class="col-8">
                                            <input type="number" name="fgCatId[${item.fg_cat_id}]" max="${item.fg_quantity}" value="${item.fg_quantity}" class="form-control">
                                        </div>

                                        <div class="col-4">
                                            <input type="text"
                                                class="form-control text-center"
                                                value="cases"
                                                readonly>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        `;
                    });

                    // APPEND
                    $("#infoSkuContainer").html(html);
                    $("#order_id").val(orderID);
                    $("#userdispatchModal").modal("show");

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