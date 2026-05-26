@extends("layouts.app")

@section("mainContent")

<div class="main-card content shadow-sm">
    <div class="total-stock-main">
        <div class="total-rmpm mb-4 h-100">
            <div class="align-items-center justify-content-between flex-wrap pb-5">
                <!-- Left spacer -->
                <div class="header-spacer"></div>

                <h5 class="text-center section-title m-0 flex-grow-1">Stock Report (Current Status)</h5>

                <!-- Right Button -->
            </div>
            <div class="row text-center justify-content-center rm-row stockreportrmpm">
                
                @if ($rmPmStockWiseData)
                    @foreach ($rmPmStockWiseData as $rSWData)
                        <div class="col-md-2 custom-col hover-card">
                            <div class="hex-box">
                                <div class="hex">
                                    <img src="{{ asset("assets") }}/{{ $rSWData["rm_pm_image"] }}" alt="{{ $rSWData["rm_pm_name"] }}" />
                                </div>
                            </div>
                            <a>
                                <div class="hex-btn">{{ $rSWData["rm_pm_name"] }}</div>
                            </a>

                            <!-- HOVER CARD -->
                            <div class="hover-popup">
                                <div class="hover-inner">
                                    <div class="hover-head">
                                        <span>Category</span>
                                        <span>Qty</span>
                                    </div>
                                    @foreach ($rSWData["rcData"] as $rStockData)
                                        <div class="hover-row">
                                            <span>{{ $rStockData["rm_pm_cat_name"] }}</span>
                                            <span>{{ $rStockData["stock_quantity"] }} {{ $rStockData["cat_unit"] }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
        </div>
    </div>

    <div class="rmpm-procurement-main">
        <h5 class="text-center section-title m-0 flex-grow-1 pb-5">RM/PM Procurement Detail</h5>
        <div class="rmpm-table-wrap">
            <div class="card bg-white">
                <div class="table-responsive table-pad">
                    <table class="table rmpm-table adminrmpmtable table-bordered">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Line</th>
                            <th>Shift</th>
                            <th>Overall Procured</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        
                        
                        @if ($dailyStockTransactionData)
                            @php $counter = 1  @endphp
                            @foreach ($dailyStockTransactionData as $dData)
                                @if ($dData["data"])
                        <!-- ROW 1 -->
                        <tr class="rmpm-rows">
                            <td>{{ $counter++ }}</td>
                            <td>{{ $dData["data"][0]["line_name"] }}</td>

                            <td>
                                <strong>{{ $dData["date"] }}</strong>
                            </td>

                            <td>
                                <div class="rmpm-card">
                                    <div class="rmpm-card rmpm-toggle">Detail</div>
                                </div>
                            </td>

                            <td>
                                <span class="rmpm-status">
                                                <i class="fa fa-check-square"></i>
                                            </span>
                            </td>

                            <td>
                                <button class="rmpm-btn" data-bs-toggle="modal" data-bs-target="#procuredModal">
                                    <i class="fa fa-pen"></i>
                                </button>
                            </td>
                        </tr>
                        
                        <!-- EXPAND -->
                        <tr class="rmpm-expand">
                            <td colspan="6">
                                <div class="rmpm-expand-box">
                                    <h6 class="rmpm-expand-title">
                                                    {{ $dData["data"][0]["line_name"] }}
                                                </h6>

                                    <table class="table rmpm-inner-table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Category</th>
                                                <th>Type</th>
                                                <th>Total Procured</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @php $subCounter = 1  @endphp
                                            @foreach ($dData["data"] as $detailsD)
                                            <tr>
                                                <td>{{ $subCounter++ }}</td>
                                                <td>{{ $detailsD["rm_pm_name"] }}</td>
                                                <td>{{ $detailsD["rm_pm_cat_name"] }}</td>
                                                <td>
                                                    {{ $detailsD["stock_quantity"] }}
                                                    <span class="rmpm-badge">{{ $detailsD["cat_unit"] }}</span>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                        
                                @endif
                            @endforeach
                        @endif
                       
                    </tbody>
                </table>
                </div>
                
            </div>
        </div>
    </div>
    



    <div class="rmpm-procurement-main">
        <h5 class="text-center section-title m-0 flex-grow-1 pb-5">RM/PM Stock Detail</h5>
        <div class="rmpm-table-wrap">
            <div class="card bg-white">
                <div class="table-responsive table-pad">
                    <table class="table stock-details table-bordered">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Date</th>
                            <th>Overall</th>
                        </tr>
                    </thead>

                    <tbody>
                        
                        
                        @if ($dailyStockWarehouseData)
                            @php $counter = 1  @endphp
                            @foreach ($dailyStockTransactionData as $dData)
                                @if ($dData["data"])
                        <!-- ROW 1 -->
                        <tr class="rmpm-rows">
                            <td>{{ $counter++ }}</td>
                            <td>
                                <strong>{{ $dData["date"] }}</strong>
                            </td>

                            <td>
                                <div class="rmpm-card">
                                    <div class="rmpm-card rmpm-toggle">Detail</div>
                                </div>
                            </td>
                        </tr>
                        
                        <!-- EXPAND -->
                        <tr class="rmpm-expand">
                            <td colspan="3">
                                <div class="rmpm-expand-box">
                                    <table class="table rmpm-inner-table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Category</th>
                                                <th>Type</th>
                                                <th>Total Added</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @php $subCounter = 1  @endphp
                                            @foreach ($dData["data"] as $detailsD)
                                            <tr>
                                                <td>{{ $subCounter++ }}</td>
                                                <td>{{ $detailsD["rm_pm_name"] }}</td>
                                                <td>{{ $detailsD["rm_pm_cat_name"] }}</td>
                                                <td>
                                                    {{ $detailsD["stock_quantity"] }}
                                                    <span class="rmpm-badge">{{ $detailsD["cat_unit"] }}</span>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                        
                                @endif
                            @endforeach
                        @endif
                       
                    </tbody>
                </table>
                </div>
                
            </div>
        </div>
    </div>
    

    <div class="modal fade" id="procuredModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rmpm-modal">
                <!-- HEADER -->
                <div class="modal-header">
                    <h4 class="mb-0">Procured Detail</h4>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- BODY -->
                <div class="modal-body">
                    <div class="rmpm-field text-center">
                        <label>Date</label>
                        <div class="rmpm-date">25 Apr 2026</div>
                    </div>

                    <!-- SHIFT ROW -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="rmpm-field">
                                <label>Shift From</label>
                                <input type="text" class="rmpm-input" value="08:00 AM" readonly />
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="rmpm-field">
                                <label>Shift To</label>
                                <input type="text" class="rmpm-input" value="08:00 PM" readonly />
                            </div>
                        </div>
                    </div>

                    <div class="rmpm-field">
                        <label>Remarks</label>
                        <textarea class="rmpm-input">
                            Material received and processed successfully.</textarea>
                    </div>
                </div>

                <!-- FOOTER -->
                <div class="modal-footer rmpm-footer">
                    <button class="rmpm-approve">Approve</button>
                    <button class="rmpm-reject">Reject</button>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    document.querySelectorAll(".rmpm-toggle").forEach((card) => {
        card.addEventListener("click", function (e) {
            e.stopPropagation(); // safety

            let row = this.closest("tr");
            let expandRow = row.nextElementSibling;

            if (expandRow.style.display === "table-row") {
                expandRow.style.display = "none";
            } else {
                expandRow.style.display = "table-row";
            }
        });
    });
</script>


@endsection