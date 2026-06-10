@extends("layouts.app")
@section("mainContent")

            <div class="main-card content shadow-sm">
    <div class="user-dashboard">
        <div class="row">
            <div class="col-md-11">
                <!-- HEADER -->
                <div class="ud-header">
                    <h4>Dashboard</h4>
                    <p>Monitor stock, production & operations</p>
                </div>
            </div>
            @if (empty($shiftData) || $shiftData->shift_over_status == 1)
            <div class="col-md-1">
                <a class="buttonshift align-items-right gap-2" href="#" data-bs-toggle="modal" data-bs-target="#shiftModal"> <i class="fa fa-calendar"></i> Shift </a>
            </div>
            @endif
        </div>
        
        <!-- SECTIONS -->
        <div class="mt-4">
            <div class="rmpm-dashboard">

                <!-- RM/PM Stock CARD -->
                <div class="rmpm-dash-card">
                    <div class="header-box">
                        <img src="{{ asset("assets") }}/images/rmpmstock.png" alt="img">
                        <div>
                            <div class="title">
                                <h3>Total RM/PM Stock</h3></div>
                        </div>
                    </div>
                    <div class="rmpm-box">

                        <!-- HEADER ROW -->
                        <div class="rmpm-row rmpm-head">
                            <span>RM/PM</span>
                            <span>QTY</span>
                        </div>
                        <div class="rmpm-divider"></div>
                        @if ($rmpmData)
                            @foreach ($rmpmData as $rData)
                        <div class="blockcard">
                            <div class="rmpm-subtitle">{{ $rData["rm_pm_name"] }}</div>
                            <div class="rmpm-divider dotted"></div>
                            @if ($rData["rcData"])
                                @foreach ($rData["rcData"] as $rcData)
                                    <div class="rmpm-row">
                                        <span>{{ $rcData["rm_pm_cat_name"] }}</span>
                                        <span>{{ $rcData["stock_quantity"] }} {{ $rcData["cat_unit"] }}</span>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <!-- RM/PM Procured (Remaining) CARD -->
                <div class="rmpm-dash-card">
                    <div class="header-box">
                        <img src="{{ asset("assets") }}/images/rmpmstock.png" alt="img">
                        <div>
                            <div class="title">
                                <h3>Total RM/PM Remaining (After Consumed)</h3></div>
                        </div>
                    </div>
                    <div class="rmpm-box">

                        <!-- HEADER ROW -->
                        <div class="rmpm-row rmpm-head">
                            <span>RM/PM</span>
                            <span>QTY</span>
                        </div>
                        <div class="rmpm-divider"></div>
                        @if ($rmpmConsumedData)
                            @foreach ($rmpmConsumedData as $rData)
                        <div class="blockcard">
                            <div class="rmpm-subtitle">{{ $rData["rm_pm_name"] }}</div>
                            <div class="rmpm-divider dotted"></div>
                            @if ($rData["rcData"])
                                @foreach ($rData["rcData"] as $rcData)
                                    <div class="rmpm-row">
                                        <span>{{ $rcData["rm_pm_cat_name"] }}</span>
                                        <span>{{ $rcData["stock_quantity"] }} {{ $rcData["cat_unit"] }}</span>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <!-- FG CARD -->
                <div class="rmpm-dash-card">
                    <div class="header-box">
                        <img src="{{ asset("assets") }}/images/bottleimg.png" alt="img">
                        <div>
                            <div class="title">
                                <h3>Total FG</h3></div>
                        </div>
                    </div>
                    <div class="rmpm-box">
 
                        <!-- HEADER -->
                        <div class="rmpm-row rmpm-head">
                            <span>FG</span>
                            <span>QTY</span>
                        </div>
                        <div class="rmpm-divider"></div>
                        @if ($fgData)
                            @foreach ($fgData as $fData)
                        <div class="blue-card">
                                @if ($fData["fgcData"])
                                    @foreach ($fData["fgcData"] as $fgcValues)
                                        <div class="rmpm-row">
                                            <span>{{ $fgcValues["fg_cat_name"] }}</span>
                                            <span>{{ $fgcValues["stock_quantity"] }} cases</span>
                                        </div>
                                    @endforeach
                                @endif
                        </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="shiftModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shift-modal">

            <!-- HEADER -->
            <div class="modal-header">
                <h4 class="mb-0">Enter Your Shift</h4>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ url("warehouse/updateShift") }}" class="generalformloader" method="post">
                @csrf
                <div class="modal-body">

                    <!-- SHIFT ROW -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="rmpm-field">
                                <label>Shift From</label>
                                <input type="datetime-local" name="shift_from" id="shift_from" class="dt-input">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="rmpm-field">
                                <label>Shift To</label>
                                <input type="datetime-local" name="shift_to" id="shift_to" class="dt-input">
                            </div>
                        </div>
                    </div>
                    <div class="rmpm-field">

                    </div>
                </div>

                <!-- FOOTER -->
                <div class="modal-footer rmpm-footer">
                    <button class="rmpm-approve" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

@if (empty($shiftData) || $shiftData->shift_over_status == 1)
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let shiftModal =
            new bootstrap.Modal(
                document.getElementById('shiftModal')
            );
        shiftModal.show();
    });
</script>
@endif

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const shiftFrom = document.getElementById("shift_from");
        const shiftTo = document.getElementById("shift_to");
        
        // DISABLE KEYBOARD ENTRY
        document.querySelectorAll(".dt-input").forEach(input => {

            // Prevent typing
            input.addEventListener("keydown", function(e){
                e.preventDefault();
            });

            // Prevent paste
            input.addEventListener("paste", function(e){
                e.preventDefault();
            });
        });

        // WHEN SHIFT FROM CHANGES
        shiftFrom.addEventListener("change", function () {

            // Set minimum value for shift_to
            shiftTo.min = this.value;

            // Reset shift_to if smaller than shift_from
            if (shiftTo.value && shiftTo.value <= this.value) {
                shiftTo.value = "";
            }
        });

        // FORM VALIDATION
        document.querySelector("form").addEventListener("submit", function(e){
            if (shiftFrom.value === "" || shiftTo.value === "") {
                alert("Please select both shift timings.");
                e.preventDefault();
                return;
            }

            // shift_to must be greater than shift_from
            if (new Date(shiftTo.value) <= new Date(shiftFrom.value)) {
                alert("Shift To must be greater than Shift From.");
                e.preventDefault();
            }
        });

    });
</script>

@endsection