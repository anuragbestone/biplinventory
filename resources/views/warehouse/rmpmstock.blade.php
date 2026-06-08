@extends("layouts.app")

@section("mainContent")

<div class="main-card content shadow-sm">
    <div class="fg-stock">
        <div class="fg-card">

            <!-- HEADING -->
            <h2 class="text-center pb-5">RM/PM Stock</h2>
            <div class="rm-pm-user">
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

                <div class="table-responsive mt-3">
                    <table class="table rmpm-stock table-bordered text-center">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>RM/PM</th>
                                <th>Opening Stock Qty</th>
                                <th>Received Stock Qty</th>
                                <th>Used Stock Qty</th>
                                <th>Closing Stock Qty</th>
                                <th>Rejection</th>
                            </tr>
                        </thead>
                        <tbody>

                            <!-- ROW 1 PRE-FORM -->
                            <tr class="rmpm-main">
                                <td rowspan="4">1</td>
                                <td class="text-start heading">Preform</td>
                                <td colspan="5"></td>
                            </tr>
                            <tr>
                                <td class="text-start ps-4">7 gm</td>
                                <td>75</td>
                                <td>2900</td>
                                <td>1400</td>
                                <td>1575</td>
                                <td>0.1%</td>
                            </tr>
                            <tr>
                                <td class="text-start ps-4">11 gm</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0%</td>
                            </tr>
                            <tr>
                                <td class="text-start ps-4">17 gm</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0%</td>
                            </tr>

                            <!-- ROW 2 CAP -->
                            <tr class="rmpm-main">
                                <td rowspan="3">2</td>
                                <td class="text-start heading">Cap (in PCS)</td>
                                <td colspan="5"></td>
                            </tr>
                            <tr>
                                <td class="text-start ps-4">Blue </td>
                                <td>182076</td>
                                <td>0</td>
                                <td>182076</td>
                                <td>182076</td>
                                <td>0%</td>
                            </tr>
                            <tr>
                                <td class="text-start ps-4">Pink</td>
                                <td>182076</td>
                                <td>0</td>
                                <td>182076</td>
                                <td>182076</td>
                                <td>0%</td>
                            </tr>

                            <!-- ROW 3 CAP -->
                            <tr class="rmpm-main">
                                <td rowspan="4">3</td>
                                <td class="text-start heading">BOPP Label (KG.)</td>
                                <td colspan="5"></td>
                            </tr>
                            <tr>
                                <td class="text-start ps-4">200ml </td>
                                <td>18</td>
                                <td>0</td>
                                <td>18</td>
                                <td>0</td>
                                <td>0%</td>
                            </tr>
                            <tr>
                                <td class="text-start ps-4">500ml</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0%</td>
                            </tr>
                            <tr>
                                <td class="text-start ps-4">1000ml</td>
                                <td>140</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0.4%</td>
                            </tr>

                            <!-- ROW 4 CAP -->
                            <tr class="rmpm-main">
                                <td rowspan="2">4</td>
                                <td class="text-start heading">Sticker (in PCS)</td>
                                <td colspan="5"></td>
                            </tr>
                            <tr>
                                <td class="text-start ps-4">200ml </td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0%</td>
                            </tr>
                            <!-- ROW 5 CAP -->
                            <tr class="rmpm-main">
                                <td rowspan="4">5</td>
                                <td class="text-start heading">LD Roll (KG.)</td>
                                <td colspan="5"></td>
                            </tr>
                            <tr>
                                <td class="text-start ps-4">520mmx90m </td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0%</td>
                            </tr>
                            <tr>
                                <td class="text-start ps-4">560mmx90m</td>
                                <td>150</td>
                                <td>1953</td>
                                <td>745</td>
                                <td>1%</td>
                                <td>0%</td>
                            </tr>
                            <tr>
                                <td class="text-start ps-4">600mmx90m</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0%</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

</div>

@endsection