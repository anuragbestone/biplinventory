@extends("layouts.app")
@section("mainContent")

<div class="main-card content shadow-sm">
    <div class="dispatch-stats-main mt-4">
        <div class="production-card">
            <div class="d-flex align-items-center justify-content-between flex-wrap pb-5">
                <!-- Left spacer -->
                <div class="header-spacer"></div>

                <div class="production-header">
                    <h2>Dispatch Stats</h2>
                    <p>Last 7 Days Production</p>
                </div>
                <!-- Right Button -->
                <div>
                    <button class="btn btn-primary btn-sm">
                        <i class="fa-solid fa-filter"></i> Filter
                    </button>
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
                    <!-- Day 1 -->
                    <div class="day-group">
                        <div class="bars">
                            <div class="bar bar1" style="height: 75%">
                                <small>1.1L</small>
                            </div>
                            <div class="bar bar2" style="height: 85%">
                                <small>2L</small>
                            </div>
                            <div class="bar bar3" style="height: 95%">
                                <small>300ml</small>
                            </div>
                            <div class="bar bar4" style="height: 65%">
                                <small>500ml</small>
                            </div>
                            <div class="bar bar5 pink" style="height: 85%">
                                <small>200ml</small>
                            </div>
                        </div>
                        <h4>Day 1</h4>
                    </div>

                    <!-- Day 2 -->
                    <div class="day-group">
                        <div class="bars">
                            <div class="bar bar1" style="height: 60%"><small>1L</small></div>
                            <div class="bar bar2" style="height: 75%"><small>1.1L</small></div>
                            <div class="bar bar3" style="height: 40%"><small>2L</small></div>
                            <div class="bar bar4" style="height: 55%"><small>500ml</small></div>
                            <div class="bar bar5 pink" style="height: 65%"><small>200ml</small></div>
                        </div>
                        <h4>Day 2</h4>
                    </div>

                    <!-- Day 3 -->
                    <div class="day-group">
                        <div class="bars">
                            <div class="bar bar1" style="height: 35%"><small>1L</small></div>
                            <div class="bar bar2" style="height: 45%"><small>300ml</small></div>
                            <div class="bar bar3" style="height: 20%"><small>1L</small></div>
                            <div class="bar bar4" style="height: 30%"><small>500ml</small></div>
                            <div class="bar bar5 pink" style="height: 40%"><small>200ml</small></div>
                        </div>
                        <h4>Day 3</h4>
                    </div>

                    <!-- Day 4 -->
                    <div class="day-group">
                        <div class="bars">
                            <div class="bar bar1" style="height: 55%"><small>1L</small></div>
                            <div class="bar bar2" style="height: 70%"><small>200ml</small></div>
                            <div class="bar bar3" style="height: 30%"><small>2L</small></div>
                            <div class="bar bar4" style="height: 40%"><small>500ml</small></div>
                            <div class="bar bar5 pink" style="height: 50%"><small>200ml</small></div>
                        </div>
                        <h4>Day 4</h4>
                    </div>

                    <!-- Day 5 -->
                    <div class="day-group">
                        <div class="bars">
                            <div class="bar bar1" style="height: 85%"><small>200ml</small></div>
                            <div class="bar bar2" style="height: 75%"><small>1L</small></div>
                            <div class="bar bar3" style="height: 35%"><small>2L</small></div>
                            <div class="bar bar4" style="height: 55%"><small>500ml</small></div>
                            <div class="bar bar5 pink" style="height: 65%"><small>200ml</small></div>
                        </div>
                        <h4>Day 5</h4>
                    </div>

                    <!-- Day 6 -->
                    <div class="day-group">
                        <div class="bars">
                            <div class="bar bar1" style="height: 75%"><small>1.1L</small></div>
                            <div class="bar bar2" style="height: 95%"><small>300ml</small></div>
                            <div class="bar bar3" style="height: 30%"><small>2L</small></div>
                            <div class="bar bar4" style="height: 55%"><small>500ml</small></div>
                            <div class="bar bar5 pink" style="height: 85%"><small>200ml</small></div>
                        </div>
                        <h4>Day 6</h4>
                    </div>

                    <!-- Day 7 -->
                    <div class="day-group">
                        <div class="bars">
                            <div class="bar bar1" style="height: 50%"><small>1L</small></div>
                            <div class="bar bar2" style="height: 65%"><small>200ml</small></div>
                            <div class="bar bar3" style="height: 25%"><small>2L</small></div>
                            <div class="bar bar4" style="height: 50%"><small>500ml</small></div>
                            <div class="bar bar5 pink" style="height: 65%"><small>200ml</small></div>
                        </div>
                        <h4>Day 7</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="overall-status-main">
        <!-- FILTER ROW -->
        <div class="row align-items-end mb-3">
            <div class="col-md-4">
                <label>Date</label>
                <input type="date" class="form-control" />
            </div>

            <div class="col-md-4">
                <label>Product</label>
                <select class="form-control">
                    <option>1 Ltr.</option>
                    <option>500ml</option>
                    <option>200ml</option>
                    <option>200ml Pink</option>
                </select>
            </div>

            <div class="col-md-3">
                <button class="os-filter-btn"><i class="fa-solid fa-filter"></i> Filter</button>
            </div>
        </div>

        <!-- EXPORT BUTTON -->
        <div class="mb-3">
            <button class="os-export-btn"><i class="fa-solid fa-file-excel"></i> Excel</button>
        </div>

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
                    <tr>
                        <td>1</td>
                        <td>26/04/2026</td>

                        <td>
                            <div class="os-cards-wrap">
                                <!-- CARD 1 -->
                                <div class="os-cards">
                                    <div class="os-cards-body">
                                        <div class="os-cards-header">
                                            <span><b>SKU</b></span
                                                        ><span><b>Qty</b></span>
                                        </div>
                                        <div><span>2 Ltr.</span><span>400 Cases</span></div>
                                        <div><span>1 Ltr.</span><span>700 cases</span></div>
                                        <div><span>500ml</span><span>1500 Cases</span></div>
                                        <div><span>200ml</span><span>2500 Cases</span></div>
                                        <div><span>200ml (Pink)</span><span>1000 cases</span></div>
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
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection