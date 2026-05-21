@extends("layouts.app")

@section("mainContent")
{{-- @php echo "<pre>"; print_r($productionLineData); @endphp --}}
<div class="main-card content shadow-sm">


    {{-- <div class="production-line-user">
        <div class="row justify-content-center">
            @if ($productionLineData)
                @php $counter = 1; @endphp
                @foreach ($productionLineData as $pData)
            <div class="col-md-6">
                <div class="plu-card h-100">
                    <div class="dt-box">
                    <div class="dt-shiftfrom">
                        <label>Shift From</label>
                        <input type="datetime-local" class="dt-input"></div>
                    <div class="dt-shifto">
                        <label>Shift To</label>
                        <input type="datetime-local" class="dt-input"></div>
                    </div>
                    <!-- TIMER -->
                    <div class="plu-timer">
                        <span id="timer_{{ $counter }}">05:00</span>
                    </div>

                    <!-- HEADING -->
                    <h5 class="plu-title">
                    {{ $pData["line_name"] }}
                </h5>

                    <!-- FORM -->
                    <form method="post" action="{{ url("warehouse/uploadProduction") }}">
                        @csrf
                        <div class="plu-inner-card">
                            <h6>Details</h6>
                            @foreach ($pData["fg"] as $fData)
                            <div class="plu-row 1ltr">
                                <input type="text" value="{{ $fData["fg_cat_name"] }}" readonly>
                                <input type="number" name="{{ $fData["id"] }}[]" placeholder="Enter Qty">
                                <input type="text" value="Kg" readonly>
                            </div>
                            @endforeach
                        </div>

                        <div class="text-center mt-4">
                            <button type="button" onclick="updateProduction({{ $counter }})" class="plu-submit-btn" disabled>Submit</button>
                        </div>

                    </form>

                    <!-- START STOP -->
                    <div class="plu-actions">
                        <button id="startBtn_{{ $counter }}" onclick="startTimer({{ $counter }})" class="plu-start">Start</button>
                        <button id="stopBtn_{{ $counter }}" class="plu-stop" onclick="stopTimer({{ $counter }})" disabled>Stop</button>
                    </div>

                </div>
            </div>
                @endforeach
            @endif

        </div>
    </div> --}}


    <div class="production-line-user">
        <div class="row justify-content-center">

            @if ($productionLineData)
                @php $counter = 1; @endphp

                @foreach ($productionLineData as $pData)

                <div class="col-md-6">
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
                            <span id="timer_{{ $counter }}">02:00</span>
                        </div>

                        <!-- FORM -->
                        <form id="form_{{ $counter }}" class="generalformloader">

                            @csrf

                            <input type="hidden" class="productionLine" name="productionLine" value="{{ $pData["id"] }}">
                            <div class="plu-inner-card marbo h-100">
                                <h6>Details</h6>

                                @foreach ($pData["fg"] as $fData)

                                <div class="plu-row">

                                    <input type="text" value="{{ $fData['fg_cat_name'] }}" readonly>
                                    <input type="number" min="0" step="0.01" name="qty[{{ $fData['id'] }}]" placeholder="Enter Qty" class="qty-input" disabled>
                                    <input type="text" value="Cases" readonly>

                                </div>

                                @endforeach

                            </div>

                            <!-- SUBMIT -->
                            <div class="text-center mt-4">
                                <button type="button" onclick="updateProduction({{ $counter }})" class="plu-submit-btn" id="submitBtn_{{ $counter }}" disabled>
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

                @php $counter++; @endphp

                @endforeach
            @endif

        </div>
    </div>



    <div class="user-production-issue" style="display: none;">
        <div class="upi-card">
            <!-- HEADER -->
            <div class="upi-card-head">
                Production Issue
            </div>
            <!-- BODY -->
            <div class="upi-card-body">
                <form method="post" action="{{ url("warehouse/productionIssueUpload") }}" class="generalformloader">
                    @csrf
                    <!-- SELECT LINE -->
                    <div class="upi-field">
                        <label>Select Line</label>
                        <select name="production_line_id" required>
                            @if ($productionLineData)
                                @foreach ($productionLineData as $pLineData)
                                    <option value="{{ $pLineData["id"] }}">{{ $pLineData["line_name"] }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <!-- ISSUE TYPE -->
                    <div class="upi-field">
                        <label>Select Issue Type</label>
                        <select name="issue_type_id" required>
                            @if ($productionIssueData)
                                @foreach ($productionIssueData as $pData)
                                    <option value="{{ $pData["id"] }}">{{ $pData["production_issue_types"] }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <!-- TEXTAREA -->
                    <div class="upi-field">
                        <label>Summary</label>
                        <textarea name="summary" placeholder="Add Summary..." required></textarea>
                    </div>
                    <!-- BUTTON -->
                    <div class="text-center">
                        <button type="submit" class="upi-submit-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>


<script>
    let productionDelayFlags = @json($productionDelayFlags);

    // STORE ALL INTERVALS
    let intervals = {};

    // PAGE LOAD
    document.addEventListener("DOMContentLoaded", function() {

        // DISABLE KEYBOARD ENTRY
        document.querySelectorAll('.dt-input').forEach(input => {
            input.addEventListener('keydown', function(e){
                e.preventDefault();
            });
        });

        // TRACK IF ANY DELAY FOUND
        let hasDelay = false;

        // CHECK DELAY FLAGS
        document.querySelectorAll('.productionLine').forEach(input => {

            let productionLineId = input.value;

            let card = input.closest('.plu-card');

            let timer = card.querySelector('.plu-timer span');

            let counter = card.id.split('_')[1];

            // DELAY EXISTS
            if(productionDelayFlags[productionLineId] == 1)
            {
                hasDelay = true;

                // DISABLE CARD
                disableCard(counter);

                // RED BORDER
                card.style.border = "2px solid red";

                // RED TIMER
                timer.style.color = "red";

                // SHOW ISSUE BOX
                document.querySelector('.user-production-issue')
                    .style.display = 'flex';

                // AUTO SELECT CURRENT LINE
                let lineSelect = document.querySelector(
                    'select[name="production_lin_id"]'
                );

                if(lineSelect)
                {
                    lineSelect.value = productionLineId;
                }
            }

        });

        // SHOW ALERT ONLY ONCE
        if(hasDelay)
        {
            alert(
                "Production time exceeded for one or more lines. Kindly upload the reason."
            );
        }

    });


    function disableCard(counter)
    {
        let card = document.getElementById(
            'card_' + counter
        );

        // DISABLE INPUTS
        card.querySelectorAll(
            'input, button, select, textarea'
        ).forEach(element => {

            element.disabled = true;

        });

        // VISUAL EFFECT
        card.style.opacity = "0.7";

        // ADD CLASS
        card.classList.add('disabled-card');
    }



    // ENABLE COMPLETE CARD
    function enableCard(counter) {
        let card = document.getElementById('card_' + counter);

        // ENABLE ALL INPUTS
        card.querySelectorAll('input, button, select, textarea')
            .forEach(element => {

            element.disabled = false;

        });

        // RESET DEFAULT BUTTON STATE
        document.getElementById(
            'stopBtn_' + counter
        ).disabled = true;

        document.getElementById(
            'submitBtn_' + counter
        ).disabled = true;

        // UI RESET
        card.style.opacity = "1";
        card.style.pointerEvents = "auto";
    }


    // START TIMER
    function startTimer(counter)
    {
        let timerElement = document.getElementById('timer_' + counter);
        let startBtn = document.getElementById('startBtn_' + counter);
        let stopBtn = document.getElementById('stopBtn_' + counter);
        let submitBtn = document.getElementById('submitBtn_' + counter);
        let form = document.getElementById('form_' + counter);

        // GET PRODUCTION LINE ID
        let productionLine =
            form.querySelector('.productionLine').value;

        // AJAX CALL
        $.ajax({
            url: "{{ url('warehouse/startProductionTimerWhatsapp') }}",
            type: "GET",
            data: {
                production_line_id: productionLine
            },

            success: function(response)
            {
                console.log("Timer start recorded");
                console.log(response);
            },

            error: function(error)
            {
                console.log(error);
            }
        });

        // PREVENT MULTIPLE INTERVALS
        if(intervals[counter])
        {
            return;
        }

        // ENABLE INPUTS
        form.querySelectorAll('.qty-input').forEach(input => {
            input.disabled = false;
        });

        // ENABLE DATETIME
        let shiftInputs = document.querySelectorAll(
            '#card_' + counter + ' .dt-input'
        );

        shiftInputs.forEach(input => {
            input.disabled = false;
        });

        // BUTTONS
        startBtn.disabled = true;
        stopBtn.disabled = false;
        submitBtn.disabled = false;

        // START TIMER
        startCountdown(counter, 120);
    }



    // COUNTDOWN FUNCTION
    function startCountdown(counter, totalSeconds)
    {
        let timerElement = document.getElementById('timer_' + counter);
        intervals[counter] = setInterval(function(){
            let minutes = Math.floor(totalSeconds / 60);
            let seconds = totalSeconds % 60;
            timerElement.innerHTML =
                String(minutes).padStart(2,'0')
                + ":"
                + String(seconds).padStart(2,'0');
            totalSeconds--;

            // TIMER COMPLETE
            if(totalSeconds < 0)
            {
                clearInterval(intervals[counter]);
                delete intervals[counter];
                timerElement.innerHTML = "00:00";
                document.getElementById(
                    'startBtn_' + counter
                ).disabled = false;
                document.getElementById(
                    'stopBtn_' + counter
                ).disabled = true;


                // CURRENT FORM
                let form = document.getElementById(
                    'form_' + counter
                );

                // GET PRODUCTION LINE
                let productionLine =
                    form.querySelector('.productionLine').value;

                // CURRENT CARD
                let card = document.getElementById(
                    'card_' + counter
                );

                // RED ALERT UI
                card.style.border = "2px solid red";
                timerElement.style.color = "red";

                // DISABLE COMPLETE CARD
                disableCard(counter);


                // ALERT MESSAGE
                alert(
                    "Production time exceeded its limit. Kindly upload the reason."
                );


                // SHOW ISSUE BOX
                document.querySelector('.user-production-issue')
                    .style.display = 'flex';


                // AUTO SELECT LINE
                let lineSelect = document.querySelector(
                    'select[name="production_lin_id"]'
                );

                if(lineSelect)
                {
                    lineSelect.value = productionLine;
                }


                // AJAX GET REQUEST
                $.ajax({
                    url: "{{ url('warehouse/productionDelayAlert') }}",
                    type: "GET",
                    data: {
                        production_line_id : productionLine
                    },
                    success: function(response)
                    {
                        console.log(
                            "Production delay alert sent"
                        );
                    },
                    error: function(error)
                    {
                        console.log(error);
                    }
                });
            }
        },1000);
    }



    // STOP TIMER
    function stopTimer(counter)
    {
        clearInterval(intervals[counter]);
        delete intervals[counter];
        let timerElement = document.getElementById(
            'timer_' + counter
        );
        let startBtn = document.getElementById(
            'startBtn_' + counter
        );
        let stopBtn = document.getElementById(
            'stopBtn_' + counter
        );
        let submitBtn = document.getElementById(
            'submitBtn_' + counter
        );
        let form = document.getElementById(
            'form_' + counter
        );

        // GET PRODUCTION LINE ID
        let productionLine =
            form.querySelector('.productionLine').value;

        // AJAX CALL
        $.ajax({
            url: "{{ url('warehouse/stopProductionTimer') }}",
            type: "GET",
            data: {
                production_line_id: productionLine
            },

            success: function(response)
            {
                console.log("Timer stopped");
                console.log(response);
            },

            error: function(error)
            {
                console.log(error);
            }
        });

        // RESET TIMER
        timerElement.innerHTML = "02:00";
        timerElement.style.color = "";

        // RESET CARD BORDER
        document.getElementById(
            'card_' + counter
        ).style.border = "";

        // BUTTON RESET
        startBtn.disabled = false;
        stopBtn.disabled = true;
        submitBtn.disabled = true;

        // RESET INPUTS
        form.querySelectorAll('.qty-input').forEach(input => {
            input.value = '';
            input.disabled = true;

        });

        // HIDE ISSUE BOX
        document.querySelector('.user-production-issue')
            .style.display = 'none';
    }



    // SUBMIT FUNCTION
    function updateProduction(counter)
    {
        let form = document.getElementById(
            'form_' + counter
        );

        let qtyInputs = form.querySelectorAll(
            '.qty-input'
        );

        let shiftInputs = document.querySelectorAll(
            '#card_' + counter + ' .dt-input'
        );

        let productionLine =
            form.querySelector(".productionLine").value;
        let shiftFrom = shiftInputs[0].value;
        let shiftTo = shiftInputs[1].value;

        // SHIFT FROM VALIDATION
        if(shiftFrom == '')
        {
            alert("Please select Shift From");
            return;
        }

        // SHIFT TO VALIDATION
        if(shiftTo == '')
        {
            alert("Please select Shift To");
            return;
        }

        // DATE VALIDATION
        let fromDate = new Date(shiftFrom);
        let toDate = new Date(shiftTo);
        if(toDate <= fromDate)
        {
            alert(
                "Shift To should be greater than Shift From"
            );
            return;
        }

        // QTY VALIDATION
        let hasQty = false;
        qtyInputs.forEach(input => {
            let value = parseFloat(input.value);
            if(value > 0)
            {
                hasQty = true;
            }
        });

        if(!hasQty)
        {
            alert("Kindly enter some quantity");
            return;
        }

        // FORM DATA
        let formData = new FormData(form);
        formData.append('shift_from', shiftFrom);
        formData.append('shift_to', shiftTo);
        formData.append(
            "productionLine",
            productionLine
        );

        // CURRENT CARD
        let card = document.getElementById(
            'card_' + counter
        );

        // FREEZE COMPLETE CARD
        card.style.pointerEvents = "none";
        card.style.opacity = "0.7";

        // DISABLE ALL BUTTONS
        card.querySelectorAll('button')
        .forEach(button => {

            button.disabled = true;

        });

        // AJAX
        $.ajax({
            url: "{{ url('warehouse/uploadProduction') }}",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN':
                    $('meta[name="csrf-token"]').attr('content')
            },

            beforeSend: function(){
                console.log("Submitting...");
            },

            success: function(response)
            {

                // UNFREEZE CARD
                card.style.pointerEvents = "auto";
                card.style.opacity = "1";

                // KEEP START BUTTON DISABLED
                document.getElementById(
                    'startBtn_' + counter
                ).disabled = true;

                // ENABLE STOP BUTTON
                document.getElementById(
                    'stopBtn_' + counter
                ).disabled = false;

                // ENABLE SUBMIT BUTTON
                document.getElementById(
                    'submitBtn_' + counter
                ).disabled = false;

                if(response.status == "ok")
                {
                    alert(response.message);

                    // CLEAR TIMER
                    clearInterval(intervals[counter]);

                    delete intervals[counter];

                    // RESET QTY ONLY
                    form.querySelectorAll('.qty-input')
                        .forEach(input => {

                        input.value = '';

                    });

                    // RESET TIMER UI
                    document.getElementById(
                        'timer_' + counter
                    ).innerHTML = "02:00";

                    // REMOVE ALERT UI
                    document.getElementById(
                        'card_' + counter
                    ).style.border = "";

                    document.getElementById(
                        'timer_' + counter
                    ).style.color = "";

                    // HIDE ISSUE BOX
                    // document.querySelector(
                    //     '.user-production-issue'
                    // ).style.display = 'none';

                    // RESTART TIMER
                    startCountdown(counter, 120);
                }
                else
                {
                    alert(response.message);
                }
            },

            error: function(xhr)
            {
                console.log(xhr);
                if(
                    xhr.responseJSON
                    &&
                    xhr.responseJSON.message
                )
                {
                    alert(xhr.responseJSON.message);
                }
                else
                {
                    alert("Something went wrong");
                }
            }

        });
    }

</script>

@endsection