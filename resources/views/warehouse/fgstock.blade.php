@extends("layouts.app")
@section("mainContent")

<div class="main-card content shadow-sm">
    <div class="fg-stock">
        <div class="fg-card">
            <!-- HEADING -->
            <h2 class="text-center pb-5">FG Stock</h2>
            <div class="fg-stocks-datewise">
                <div class="fg-shift-box">
                    <div class="row">
                        <!-- SHIFT FROM -->
                        <div class="col-md-6 text-center">
                            <label>Shift From</label>
                            <div class="fg-shift-input">
                                <span>28 Apr 2026</span>
                                <br>
                                <strong>08:00 AM</strong>
                            </div>
                        </div>
                        <!-- SHIFT TO -->
                        <div class="col-md-6 text-center">
                            <label>Shift To</label>
                            <div class="fg-shift-input">
                                <span>28 Apr 2026</span>
                                <br>
                                <strong>08:00 PM</strong>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- TABLE -->
                <div class="table-responsive mt-3">
                    <table class="table fg-stocks table-bordered text-center">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>FG Stock</th>
                                <th>Production Line</th>
                                <th>Opening Stock</th>
                                <th>Production Stock Qty</th>
                                <th>Dispatch Qty</th>
                                <th>Closing Qty</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>1 Ltr</td>
                                <td>Company Owned Contractor Operated Line</td>
                                <td>500 Cases</td>
                                <td>1000 Cases</td>
                                <td>700 Cases</td>
                                <td>800 Cases</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="fg-stocks-datewise">
                <div class="fg-shift-box">
                    <div class="row">
                        <!-- SHIFT FROM -->
                        <div class="col-md-6 text-center">
                            <label>Shift From</label>
                            <div class="fg-shift-input">
                                <span>28 Apr 2026</span>
                                <br>
                                <strong>08:00 AM</strong>
                            </div>
                        </div>
                        <!-- SHIFT TO -->
                        <div class="col-md-6 text-center">
                            <label>Shift To</label>
                            <div class="fg-shift-input">
                                <span>28 Apr 2026</span>
                                <br>
                                <strong>08:00 PM</strong>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TABLE -->
                <div class="table-responsive mt-3">
                    <table class="table fg-stocks table-bordered text-center">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>FG Stock</th>
                                <th>Production Line</th>
                                <th>Opening Stock</th>
                                <th>Production Stock Qty</th>
                                <th>Dispatch Qty</th>
                                <th>Closing Qty</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>1 Ltr</td>
                                <td>Company Owned Contractor Operated Line</td>
                                <td>500 Cases</td>
                                <td>1000 Cases</td>
                                <td>700 Cases</td>
                                <td>800 Cases</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>


        </div>

    </div>



</div>

@endsection