@extends("layouts.app")
@section("mainContent")

<style>
    /* Boy vector */
    .floating-achievement .boy img {
        width: 50px;
        height: auto;
        transform: scaleX(-1); /* push direction */
    }



    /* Optional push animation */
    .floating-achievement .boy img {
        animation: push 1s infinite alternate ease-in-out;
    }

    @keyframes push {
        0% { transform: scaleX(-1) translateX(0); }
        100% { transform: scaleX(-1) translateX(5px); }
    }
    .boy {
        position: absolute;
        left: -49px;
    }

</style>

<div class="main-card sales-role content shadow-sm">
    <div class="dashboard">

        <div class="top-section">

            <div class="heading">
                <h1>Sales Dashboard</h1>
                <p>Track your sales performance and achieve your targets</p>
            </div>

            <div class="cards">
                @if ($targetData)
                <div class="card">
                    <div class="icon blue">🎯</div>
                    <h4>This Month Target</h4>
                    <h2>{{ $targetData[0]["target_quantity"] }}</h2>
                    <span>Cases</span>
                </div>

                <div class="card">
                    <div class="icon green">✅</div>
                    <h4>Total Achieved</h4>
                    <h2>{{ $targetData[0]["achieved_target_quantity"] }}</h2>
                    <span>Cases</span>
                </div>

                <div class="card">
                    <div class="icon orange">📈</div>
                    <h4>Remaining</h4>
                    <h2>{{ $targetData[0]["target_quantity"] - $targetData[0]["achieved_target_quantity"] }}</h2>
                    <span>Cases</span>
                </div>

                <div class="card">
                    <div class="icon purple">🏆</div>
                    <h4>Achievement</h4>
                    <h2>{{ round(($targetData[0]["achieved_target_quantity"]/$targetData[0]["target_quantity"])*100 , 2) }}%</h2>
                    <span>Of Target</span>
                </div>
                @else
                <div class="card">
                    <div class="icon blue">🎯</div>
                    <h4>This Month Target</h4>
                    <h2>0</h2>
                    <span>Cases</span>
                </div>

                <div class="card">
                    <div class="icon green">✅</div>
                    <h4>Total Achieved</h4>
                    <h2>0</h2>
                    <span>Cases</span>
                </div>

                <div class="card">
                    <div class="icon orange">📈</div>
                    <h4>Remaining</h4>
                    <h2>0</h2>
                    <span>Cases</span>
                </div>

                <div class="card">
                    <div class="icon purple">🏆</div>
                    <h4>Achievement</h4>
                    <h2>0%</h2>
                    <span>Of Target</span>
                </div>
                @endif
            </div>

        </div>


        @php
            $target = $targetData[0]['target_quantity'] ?? 0;
            $achieved = $targetData[0]['achieved_target_quantity'] ?? 0;
        @endphp

        <div class="progress-section" id="progress-report">

            <div class="section-title">Monthly Target Progress</div>

            <div class="progress-wrapper">

                <div class="circle-progress" id="circleProgress">
                    <div class="circle-inner">
                        <h2 id="progressPercent">0%</h2>
                        <p id="achievedText">0 Achieved</p>
                    </div>
                </div>

                <div class="line-progress">

                    <div class="line-track">
    
                        <div class="floating-achievement" id="floatingCard">
                            <div class="boy">
                                <img src="{{ asset("assets") }}/images/boy.png" alt="boy">
                            </div>
                    
                            <div class="content">
                                <h3 id="floatingNumber">0</h3>
                                <p>Achieved</p>
                            </div>
                        </div>
                    
                        <div class="line-fill" id="lineFill"></div>
                    
                    </div>

                    <div class="milestones">

                        <div class="milestone-card">
                            <h3>0</h3>
                            <p>Cases</p>
                        </div>

                        <div class="milestone-card">
                            <h3>{{ number_format($target * 0.25) }}</h3>
                            <p>Cases</p>
                        </div>

                        <div class="milestone-card">
                            <h3>{{ number_format($target * 0.50) }}</h3>
                            <p>Cases</p>
                        </div>

                        <div class="milestone-card">
                            <h3>{{ number_format($target * 0.75) }}</h3>
                            <p>Cases</p>
                        </div>
                        
                        <div class="milestone-card">
                            <h3>{{ number_format($target) }}</h3>
                            <p>Cases</p>
                        </div>

                    </div>
                </div>
            </div>

        </div>

        <div class="table-section" id="sales-report">
            <div class="section-title">Sales by SKU</div>
            <table>
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>SKU</th>
                        <th>Total Sale</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($progressReport)
                        @php $counter = 1 @endphp
                        @foreach ($progressReport as $pReport)
                            <tr>
                                <td>{{ $counter++ }}</td>
                                <td>{{ $pReport["fgData"]["fg_cat_name"] }}</td>
                                <td>{{ $pReport["totalSold"] }} Cases</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>


        <div class="sales-generate-order-main" id="generate-order-report">
            <div class="card bg-white">
                
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="m-0">Orders</h5>
                    <button class="btn btn-primary btn-sm" id="generateOrder">
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
                                <th>Payment Status</th>
                                <th>Payment Approved Status</th>
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
                                        <td><span class="badge {{ $orderDetails["payment_status"] == 1 ? "bg-success" : "bg-warning" }}">
                                            {{ $orderDetails["payment_status"] == 1 ? "Completed" : "Pending" }}</span></td>
                                        <td><span class="badge {{ $orderDetails["payment_approve_status"] == 1 ? "bg-success" : "bg-warning" }}">
                                            {{ $orderDetails["payment_approve_status"] == 1 ? "Approved" : "Pending" }}</span></td>
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
                                            
                                            <button {{ $orderDetails["payment_status"] == 1 ? "disabled" : "" }} class="btn btn-info btn-sm" onclick="updatePaymentStatus({{ $orderDetails['id'] }})" data-bs-toggle="modal" data-bs-target="#paymentModal">
                                                <i class="fa fa-info"></i>
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
                        readonly>
                    </textarea>

                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="paymentModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>PAYMENT STATUS</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">

                    <form action="{{ url('/updatePaymentStatus') }}" method="post" class="generalformloader">
                        @csrf
                        <input type="hidden" name="order_id" id="payment_order_id">
                        <div class="mb-3">
                            <label class="fw-bold">Payment Status</label>
                            <select name="payment_status" class="form-control" required>
                                <option value="">Select Status</option>
                                <option value="1">Completed</option>
                                <option value="0">Pending</option>
                            </select>
                        </div>

                        <button class="btn btn-primary" type="submit">Update</button>
                    </form>
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
                                <div class="d-flex justify-content-between border-bottom p-2 popupcard">
                                    <span class="border-end pe-2 w-50">{{ $fData["fg_cat_name"] }}</span>
                                    <span class="ps-2 w-50 text-end">
                                        <input type="number" min="0" 
                                            max="{{ $fData['stock_quantity'] }}" 
                                            name="fgCat[{{ $fData['id'] }}]"
                                            {{ (($fData['stock_quantity'] == 0) || (!$fData['stock_quantity'])) ? 'disabled' : '' }}> Cases
                                    </span>
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

                            <div class="mb-3">
                                <label for="" class="fw-bold">Payment Status</label>
                                <select name="payment_status" class="form-control" id="">
                                    <option value="0" selected>Pending</option>
                                    <option value="1">Completed</option>
                                </select>
                            </div>

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

    const target = {{ $target }};
    const achieved = {{ $achieved }};
    const percentage = target > 0
        ? (achieved / target) * 100
        : 0;

    const circle = document.getElementById('circleProgress');
    const progressText = document.getElementById('progressPercent');
    const achievedText = document.getElementById('achievedText');
    const lineFill = document.getElementById('lineFill');
    const floatingCard = document.getElementById('floatingCard');
    const floatingNumber = document.getElementById('floatingNumber');
    const milestoneCards = document.querySelectorAll('.milestone-card');
    const milestoneValues = [
        0,
        target * 0.25,
        target * 0.50,
        target * 0.75,
        target
    ];

    milestoneCards.forEach((card, index) => {
        if(index !== 0){
            card.style.opacity = '0';
            card.style.transform = 'translateY(40px)';
            card.style.transition = '0.5s ease';
        }
    });

    let current = 0;
    const counter = setInterval(() => {
        current += 0.1;
        if(current >= percentage){
            current = percentage;
            clearInterval(counter);
        }

        const safeCurrent = Number(current.toFixed(1));
        circle.style.background =
            `conic-gradient(#2f67ff ${safeCurrent * 3.6}deg,#edf2ff 0deg)`;
        progressText.innerHTML = `${safeCurrent}%`;
        let currentAchieved;
        if(current >= percentage){

            // Final value should exactly match database value
            currentAchieved = achieved;
        } else {
            currentAchieved = Math.round(
                (current / percentage) * achieved
            );
        }

        achievedText.innerHTML =
            `${currentAchieved.toLocaleString()} Achieved`;
        floatingNumber.innerHTML =
            currentAchieved.toLocaleString();
        lineFill.style.width = `${safeCurrent}%`;
        floatingCard.style.left = `${safeCurrent}%`;
        milestoneValues.forEach((value, index) => {
            if(currentAchieved >= value){
                milestoneCards[index].style.opacity = '1';
                milestoneCards[index].style.transform =
                    'translateY(0px)';
            }
        });
    }, 25);

</script>


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

    function updatePaymentStatus(orderID) {
        $("#payment_order_id").val(orderID);
    }

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

    $("#generateOrder").click(function() {
        let totalStock = {{ $totalStockQuantity }};
        if (totalStock > 0) {
            $("#generateOrderModal").modal("show");
        } else {
            Swal.fire({
                text: "Kindly Add FG First!!",
                icon: "error"
            }); 
        }
    });

</script>

@endsection