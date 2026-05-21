@extends("layouts.app")

@section("mainContent")

<div class="main-card content shadow-sm">

    <div class="user-order bg-white">
        <div class="table-responsive">
            <table class="table table-bordered user-orders">
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
                    <tr>
                        <td>1</td>
                        <td>A1B2</td>
                        <td>26/04/2026</td>
                        <td>
                            <div class="os-card-wrap">
                                <!-- CARD 1 -->
                                <div class="os-card">
                                    <div class="os-card-header">Preform</div>

                                    <div class="os-card-body">
                                        <div>
                                            <span><b>Category</b></span
                                                        ><span><b>Qty</b></span>
                                        </div>
                                        <div><span>7gm</span><span>200 Kg</span></div>
                                        <div><span>11gm</span><span>50 Kg</span></div>
                                        <div><span>17gm</span><span>9000 Pc</span></div>
                                    </div>
                                </div>


                            </div>
                        </td>
                        <td><span class="badge bg-warning">Pending</span></td>

                        <td>S.O Enterprises Rajasthan</td>
                        <td>26/04/2026</td>
                        <td><span class="badge bg-warning">Pending</span></td>
                        <td>


                            <button class="os-edit-btn has-tooltip" data-bs-toggle="modal" data-bs-target="#userorderModal" title="Production" data-bs-placement="top">
                                <i class="fa-solid fa-box"></i>
                            </button>


                            <button class="os-edit-btn has-tooltip" data-bs-toggle="modal" data-bs-target="#userdispatchModal" title="Dispatch" data-bs-placement="top">
                                <i class="fa-solid fa-truck"></i>
                            </button>

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>



</div>
<div class="modal fade" id="userorderModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rmpm-modal">
            <!-- HEADER -->
            <div class="modal-header">
                <h4 class="mb-0">Order Updates</h4>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- BODY -->
            <div class="modal-body">
                <div class="order-field text-center">
                    <label>Date</label>
                    <div class="rmpm-date">25 Apr 2026</div>
                </div>

                <!-- SHIFT ROW -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="order-field">
                            <label>Shift From</label>
                            <input type="text" class="custom-field form-control" value="08:00 AM" readonly />
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="order-field">
                            <label>Shift To</label>
                            <input type="text" class="custom-field form-control" value="08:00 PM" readonly />
                        </div>
                    </div>
                </div>

                <div class="order-field">
                    <label>Production Status</label>
                    <select class="custom-field form-control">
                        <option>Pending</option>
                        <option>Complete</option>
                    </select>
                </div>
            </div>

            <!-- FOOTER -->
            <div class="modal-footer rmpm-footer">
                <button class="btn btn-primary">Submit</button>

            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="userdispatchModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rmpm-modal">
            <!-- HEADER -->
            <div class="modal-header">
                <h4 class="mb-0">Dispatch Updates</h4>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- BODY -->
            <div class="modal-body">
                <div class="order-field text-center">
                    <label>Date</label>
                    <div class="rmpm-date">25 Apr 2026</div>
                </div>

                <!-- SHIFT ROW -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="order-field">
                            <label>Shift From</label>
                            <input type="text" class="custom-field form-control" value="08:00 AM" readonly />
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="order-field">
                            <label>Shift To</label>
                            <input type="text" class="custom-field form-control" value="08:00 PM" readonly />
                        </div>
                    </div>
                </div>

                <div class="order-field">
                    <label>Dispatch Status</label>
                    <select class="custom-field form-control">
                        <option>Pending</option>
                        <option>Complete</option>
                    </select>
                </div>
            </div>

            <!-- FOOTER -->
            <div class="modal-footer rmpm-footer">
                <button class="btn btn-primary">Submit</button>

            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
    
        document.querySelectorAll('.has-tooltip').forEach(el => {
            new bootstrap.Tooltip(el);
        });
    
    });
</script>

@endsection