@extends("layouts.app")
@section("mainContent")

<style>
    .production-chart {
    display: flex;
    align-items: flex-end;
    overflow-x: auto;
}

.graph-area {
    display: flex;
    align-items: flex-end;
    gap: 25px;
    min-width: max-content;
    width: 100%;
}

.day-group {
    min-width: 90px;
    text-align: center;
}

.bars {
    height: 350px;
    display: flex;
    align-items: flex-end;
    gap: 6px;
}

.bar {
    width: 22px;
    border-radius: 8px 8px 0 0;
    position: relative;
    transition: 0.3s;
}

.bar small {
    position: absolute;
    top: -20px;
    left: 10px;
    font-size: 10px;
    white-space: nowrap;
}

.bar1 {
    background: #c8d6ff;
}

.bar2 {
    background: #9eb5ff;
}

.bar3 {
    background: #7f9cff;
}

.bar4 {
    background: #b8c8f0;
}

.bar5 {
    background: #ff8ab3;
}

.pink {
    background: #ff7aa8;
}
</style>

<div class="main-card content shadow-sm">
    <div class="production-stats-main mt-4">
        <div class="production-card">
            <div class="d-flex align-items-center justify-content-between flex-wrap pb-5">
                <!-- Left spacer -->
                <div class="header-spacer"></div>
                <div class="production-header">
                    <h2>Production Stats</h2>
                    <p>Last 7 Days Production</p>
                </div>
                <!-- Right Button -->
                <div>
                    <form method="GET">
                        <select name="filter" class="form-select form-select-sm" onchange="this.form.submit()">
                            <option value="7days" {{ $selectedFilter == '7days' ? 'selected' : '' }}>
                                Last 7 Days
                            </option>
                            <option value="month" {{ $selectedFilter == 'month' ? 'selected' : '' }}>
                                Last Month
                            </option>
                            <option value="year" {{ $selectedFilter == 'year' ? 'selected' : '' }}>
                                Last Year
                            </option>
                        </select>
                    </form>
                </div>
            </div>
            <div class="production-chart">
                <!-- Y Axis -->
                <div class="y-axis">
                    <span>8k</span>
                    <span>6k</span>
                    <span>4k</span>
                    <span>2k</span>
                    <span>0</span>
                </div>

                <!-- Graph Area -->
                <div class="graph-area">
                    @foreach ($productionGraphData as $graph)
                        <div class="day-group">
                            <div class="bars">
                                @php
                                    $colors = [
                                        "bar1",
                                        "bar2",
                                        "bar3",
                                        "bar4",
                                        "bar5 pink"
                                    ];
                
                                    $maxHeight = 100;
                                    $maxStock = 2000;
                                @endphp
                                @forelse ($graph["data"] as $index => $item)
                                    @php
                                        $height = ($item["stock_quantity"] / $maxStock) * $maxHeight;
                                        if ($height < 5) {
                                            $height = 5;
                                        }
                
                                        if ($height > 100) {
                                            $height = 100;
                                        }
                                    @endphp
                                    <div class="bar {{ $colors[$index % count($colors)] }}"
                                        style="height: {{ $height }}%">
                                        <small>
                                            {{ $item["fg_cat_name"] }}
                                        </small>
                                    </div>
                                @empty
                                    <div class="bar bar1" style="height:5%">
                                        <small>0</small>
                                    </div>
                                @endforelse
                            </div>
                
                            <h4>
                                {{ \Carbon\Carbon::parse($graph["date"])->format('d M') }}
                            </h4>
                        </div>
                    @endforeach
                
                </div>
            </div>
        </div>
    </div>

    <div class="overall-status-main">
        <!-- FILTER ROW -->
        <!--<div class="row align-items-end mb-3">-->
        <!--    <div class="col-md-4">-->
        <!--        <label>Date</label>-->
        <!--        <input type="date" class="form-control" />-->
        <!--    </div>-->

        <!--    <div class="col-md-4">-->
        <!--        <label>Product</label>-->
        <!--        <select class="form-control">-->
        <!--            <option>1 Ltr.</option>-->
        <!--            <option>500ml</option>-->
        <!--            <option>200ml</option>-->
        <!--            <option>200ml Pink</option>-->
        <!--        </select>-->
        <!--    </div>-->

        <!--    <div class="col-md-3">-->
        <!--        <button class="os-filter-btn"><i class="fa-solid fa-filter"></i> Filter</button>-->
        <!--    </div>-->
        <!--</div>-->

        <!-- EXPORT BUTTON -->
        <!--<div class="mb-3">-->
        <!--    <button class="os-export-btn"><i class="fa-solid fa-file-excel"></i> Excel</button>-->
        <!--</div>-->

        <!-- TABLE -->
        <div class="table-responsive">
            <table class="table table-bordered overall-status-table-main">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Date</th>
                        <th>Transaction</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($productionData)
                        @php $counter = 1 @endphp
                        @foreach ($productionData as $pData)
                            @if ($pData["data"])
                    <tr>
                        <td>{{ $counter++ }}</td>
                        <td>{{ $pData["date"] }}</td>
                        <td>
                            <div class="os-cards-wrap">
                                <!-- CARD 1 -->
                                <div class="os-cards">
                                    <div class="os-cards-body">
                                        <div class="os-cards-header">
                                            <span><b>SKU</b></span
                                                        ><span><b>Qty</b></span>
                                        </div>
                                        @foreach ($pData["data"] as $details)
                                            <div>
                                                <span>{{ $details["fg_cat_name"] }} ({{ $details["fg_name"] }})</span>
                                                <span>{{ $details["stock_quantity"] }} Cases</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <button class="os-edit-btn">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                        </td>
                    </tr>
                            @endif
                        @endforeach
                    @endif
                </tbody>
            </table>
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