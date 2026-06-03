@extends("layouts.app")
@section("mainContent")

{{-- @php echo "<pre>"; print_r($productionLineData); @endphp --}}
<div class="main-card content shadow-sm">
    <div class="production-line-user">
        <div class="row justify-content-center">
            @if ($productionLineData)
                @php $counter = 1; @endphp
                @foreach ($productionLineData as $pData)

                <!-- Production Time Exceeded Card Starts -->

                <div class="card bg-white rounded border-none col-md-6 pt-2 pb-2" id="production_line_exceed_card_{{ $counter }}" style="display: none;">
                    <!-- TITLE -->
                    <div class="title-div">
                        <h5 class="plu-title">
                          {{ $pData["line_name"] }}
                        </h5>
                        <span>Submit Time Exceeded Reason</span>
                    </div>

                    <form action="{{ url("warehouse/productionIssueUpload") }}" method="post" class="generalformloader">
                        @csrf
                        <input type="hidden" name="production_line_id" value="{{ $pData["id"] }}">
                        <div class="col-12">
                            <label>Select Issue Type</label>
                            <select name="issue_type_id" class="form-select custom-field" required>
                                @if ($productionIssueData)
                                    @foreach ($productionIssueData as $issueData)
                                        <option value="{{ $issueData["id"] }}">{{ $issueData["production_issue_types"] }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-12">
                            <label>Remark</label>
                            <textarea name="summary" cols="30" class="form-control" rows="10"></textarea>
                        </div>                        
                        <div class="col-12 pt-4">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>

                <!-- Production Time Exceeded Card Ends -->

                <!-- Production Line Card Starts -->

                <div class="col-md-6" id="production_line_card_{{ $counter }}">
                    <div class="plu-card h-100" id="card_{{ $counter }}">

                        <!-- TITLE -->
                        <h5 class="plu-title">
                            {{ $pData["line_name"] }}
                        </h5>

                        <!-- DATE TIME -->
                        <div class="dt-box">
                            <div class="dt-shiftfrom">
                                <label>Shift From</label>
                                <input type="datetime-local" value="{{ session("shift_from") }}" class="dt-input" readonly>
                            </div>

                            <div class="dt-shifto">
                                <label>Shift To</label>
                                <input type="datetime-local" value="{{ session("shift_to") }}" class="dt-input" readonly>
                            </div>
                        </div>

                        <!-- TIMER -->
                        <div class="plu-timer">
                            <span id="timer_{{ $counter }}">05:00</span>
                        </div>
                        <div class="selectline pt-2 pb-2">
                            <label>Select FG:</label>
                            <select
                                name="selected_fg"
                                class="form-select custom-field fg-select"
                                id="fg_select_{{ $counter }}"
                            >
                                <option value="">
                                    Select FG
                                </option>
                                @foreach ($pData["fg"] as $fData)
                                    <option
                                        value="{{ $fData['id'] }}"
                                        data-name="qty[{{ $fData['id'] }}]"
                                        data-max="{{ $fData['max_quantity'] }}"
                                        data-fg="{{ $fData['fg_cat_name'] }}"
                                    >
                                        {{ $fData["fg_cat_name"] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- FORM -->
                        <form id="" method="post" action="{{ url("warehouse/uploadProduction") }}" class="generalformloader">
                            @csrf
                            <input type="hidden" name="fgID" id="productionFgId_{{ $counter }}">
                            <input type="hidden" class="productionLine" name="productionLineId" id="productionLineId_{{ $counter }}" value="{{ $pData["id"] }}">
                            <div class="plu-inner-card marbo h-100">
                                <h6 class="detail-heading">Details</h6>
                                <div class="rmpm-user-row pt-4">
                                    <input
                                        type="number"
                                        inputmode="decimal"
                                        step="0.001"
                                        name="production_quantity"
                                        class="qty-input"
                                        id="qty_input_{{ $counter }}"
                                        min="1"
                                        placeholder="Enter Qty"
                                        required
                                        disabled
                                    >
                                    <input value="cases" readonly>
                                </div>
                                <div class="aman">
                                    <div class="quantity-box shadow-sm">
                                        Total Quantity:
                                        <span id="totalQty_{{ $counter }}">0 Cases</span>
                                    </div>
                                </div>
                            </div>

                            <!-- SUBMIT -->
                            <div class="text-center mt-5">
                                <button type="submit" class="plu-submit-btn" id="submitBtn_{{ $counter }}" disabled>
                                    Submit
                                </button>
                            </div>

                        </form>

                        <!-- ACTION BUTTONS -->
                        <div class="plu-actions">
                            <button type="button" id="startBtn_{{ $counter }}" onclick="startTimer({{ $counter }})" class="plu-start">
                                Start
                            </button>
                            <button type="button" id="stopBtn_{{ $counter }}" onclick="stopTimer({{ $counter }})" class="plu-stop" disabled>
                                Stop
                            </button>
                        </div>

                    </div>
                </div>

                <!-- Production Line Card Ends -->

                @php $counter++; @endphp
                @endforeach
            @endif

        </div>
    </div>

</div>


<script>

    let timerIntervals = {};

    // ----- Handle Timer and Other things on reload
    function onReloadPageGetData() {
        $.ajax({
            url: "{{ url('warehouse/getProductionTimerUpdate') }}",
            type: "GET",
            success: function(response) {
                if (response.status == "success") {
                    let productionData = response.productionData;

                    // ---- Loop Through All Production Lines
                    productionData.forEach(function(pData) {

                        // ---- Database Start Time
                        let productionStartTime = new Date(
                            pData.production_start_time.replace(" ", "T")
                        );

                        // ---- Timer Seconds from DB
                        let timerSeconds = pData.production_timer_seconds ?? 300;

                        // ---- Calculate End Time
                        let productionEndTime = new Date(
                            productionStartTime.getTime() + (timerSeconds * 1000)
                        );

                        // ---- Current Time
                        let currentTime = new Date();

                        // ---- Check Timer Running or Expired
                        if (productionEndTime > currentTime) {
                            $("#totalQty_" + pData.counter_id).html(`${response.totalStock[pData.production_line_id]} Cases`);
                            console.log("Timer Still Running");

                            // ---- Remaining Seconds
                            let remainingSeconds = Math.floor(
                                (productionEndTime - currentTime) / 1000
                            );

                            // ---- Start Remaining Timer
                            setTimersOnLoad(
                                pData.counter_id,
                                productionStartTime,
                                timerSeconds
                            );

                            // ---- Update UI
                            $("#startBtn_" + pData.counter_id).prop("disabled", true);
                            $("#submitBtn_" + pData.counter_id).prop("disabled", false);
                            $("#stopBtn_" + pData.counter_id).prop("disabled", false);
                            $("#fg_select_" + pData.counter_id).prop("disabled", true);
                            $("#qty_input_" + pData.counter_id).prop("disabled", false);
                            $("#fg_select_" + pData.counter_id).val(pData.fgId);
                            $("#productionFgId_" + pData.counter_id).val(pData.fgId);

                        } else {
                            // ---- Update Exceeded Limit

                            $.ajax({
                                url: "{{ url('warehouse/productionDelayAlert') }}",
                                type: "GET",
                                data: {
                                    production_line_id: pData.production_line_id
                                },
                                success: function(response)
                                {
                                    alert("Time Exceeded");
                                    $("#production_line_card_" + pData.counter_id).hide();
                                    $("#production_line_exceed_card_" + pData.counter_id).show();
                                },
                                error: function(error)
                                {
                                    console.log(error);
                                }
                            });

                            // ---- Timer Expired
                            $("#startBtn_" + pData.counter_id).prop("disabled", true);
                            $("#submitBtn_" + pData.counter_id).prop("disabled", true);
                            $("#stopBtn_" + pData.counter_id).prop("disabled", true);
                            $("#fg_select_" + pData.counter_id).prop("disabled", true);
                            $("#fg_select_" + pData.counter_id).val("");
                            $("#qty_input_" + pData.counter_id).val("");
                            $("#qty_input_" + pData.counter_id).prop("disabled", true);

                            updateTimerDisplay(
                                pData.counter_id,
                                0
                            );

                            console.log(
                                "Production Time Exceeded For Counter:",
                                pData.counter_id
                            );
                        }

                    });
                }
            },
            error: function(error)
            {
                console.log(error);
            }
        });
    }

    onReloadPageGetData();

    // ---- On Page Reload Set the timer to their original value
    function setTimersOnLoad(counterID, productionStartTime, timerSeconds = 300) {
        clearInterval(timerIntervals[counterID]);
        timerIntervals[counterID] = setInterval(function () {
            let currentTime = new Date();
            let elapsedSeconds = Math.floor(
                (currentTime - productionStartTime) / 1000
            );

            let remainingSeconds = timerSeconds - elapsedSeconds;
            if (remainingSeconds < 0) {
                remainingSeconds = 0;
            }

            updateTimerDisplay(counterID, remainingSeconds);
            if (remainingSeconds <= 0) {
                clearInterval(timerIntervals[counterID]);
                $("#startBtn_" + counterID).prop("disabled", true);
                $("#submitBtn_" + counterID).prop("disabled", true);
                $("#stopBtn_" + counterID).prop("disabled", true);
                $("#fg_select_" + counterID).prop("disabled", true);

                // Refresh from server
                onReloadPageGetData();
            }

        }, 1000);
    }

    // ---- Update Timer UI
    function updateTimerDisplay(counterID, totalSeconds) {

        let minutes = Math.floor(totalSeconds / 60);
        let seconds = totalSeconds % 60;

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;
        $("#timer_" + counterID).text(minutes + ":" + seconds);
    }

    // ------ On Click of start timer
    function startTimer(counterID) {

        let fgSelected = $("#fg_select_" + counterID).val();
        if (!fgSelected) {
            alert("Kindly select fg type first!!");
        } else {
            setStartTimer(counterID);
        }
    }

    // ------- On Click of stop timer
    function stopTimer(counterID) {
        $.ajax({
            url: "{{ url('warehouse/updateProductionTime') }}",
            type: "GET",
            data: {
                production_status: "stop",
                production_line_id: $("#productionLineId_" + counterID).val()
            },
            success: function(response)
            {
                if (response.status == "success") {
                    // console.log(response.data);

                    // ---- Disable/Enable Buttons
                    $("#productionFgId_" + counterID).val("");
                    $("#startBtn_" + counterID).prop("disabled", false);
                    $("#submitBtn_" + counterID).prop("disabled", true);
                    $("#stopBtn_" + counterID).prop("disabled", true);
                    $("#fg_select_" + counterID).prop("disabled", false);
                    $("#qty_input_" + counterID).prop("disabled", true);

                    
                }
            },
            error: function(error)
            {
                console.log(error);
            }
        });
    }

    // ---- Start Timer API
    function setStartTimer(counterID) {
        $.ajax({
            url: "{{ url('warehouse/updateProductionTime') }}",
            type: "GET",
            data: {
                production_status: "start",
                counter_id: counterID,
                fg_id: $("#fg_select_" + counterID).val(),
                production_line_id: $("#productionLineId_" + counterID).val()
            },
            success: function(response)
            {
                if (response.status == "success") {
                    console.log(response.data);

                    // ---- Disable/Enable Buttons
                    $("#productionFgId_" + counterID).val($("#fg_select_" + counterID).val());
                    $("#startBtn_" + counterID).prop("disabled", true);
                    $("#submitBtn_" + counterID).prop("disabled", false);
                    $("#stopBtn_" + counterID).prop("disabled", false);
                    $("#fg_select_" + counterID).prop("disabled", true);
                    $("#qty_input_" + counterID).prop("disabled", false);

                    // ---- Start Real Time Countdown
                    let timerSeconds = response.data.production_timer_seconds ?? 300;
                    let productionStartTime = new Date();

                    setTimersOnLoad(
                        counterID,
                        productionStartTime,
                        timerSeconds
                    );
                }
            },
            error: function(error)
            {
                console.log(error);
            }
        });
    }

    document.addEventListener("visibilitychange", function () {
        if (!document.hidden) {
            onReloadPageGetData();
        }
    });

</script>

@endsection