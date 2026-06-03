@extends("layouts.app")

@section("mainContent")

<div class="main-card content shadow-sm">
    <div class="procure-wrapper">
        <div class="procure-box">
            <h5 class="procure-title">Add Rejection Entry</h5>

            <!-- Date Row -->
            <div class="row mb-3 center-row mx-auto">
                <div class="col-md-6">
                    <label class="procure-label">Shift from</label>
                    <input type="datetime-local" name="shift_from" value="{{ session("shift_from") }}" class="procure-input" readonly />
                </div>
                <div class="col-md-6">
                    <label class="procure-label">Shift to</label>
                    <input type="datetime-local" name="shift_to" value="{{ session("shift_to") }}" class="procure-input" readonly />
                </div>
            </div>

            <form class="generalformloader" action="{{ url("warehouse/rejection") }}" method="get">
                @csrf
                <input type="hidden" name="filter" value="1">
                <div class="maincard-line">
                    <div class="row mb-3 center-row mx-auto">
                        <select name="production_line_id" class="form-select custom-field" {{ $selected_production_line_id == 0 ? "" : "disabled" }}>
                            @if ($productionLine)
                                @foreach ($productionLine as $pLine)
                                    <option value="{{ $pLine["id"] }}" {{ $selected_production_line_id == $pLine["id"] ? "selected" : "" }}>{{ $pLine["line_name"] }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <div class="card pb-20">
                    <div class="row filter-card">
                        <div class="col-md-5">
                            <select name="fg" class="form-select custom-field" id="getFgCat">
                                <option value="0">Select Bottle</option>
                                    @foreach ($fgData as $fData)
                                        <option value="{{ $fData["id"] }}" {{ isset($fg_id) && $fg_id == $fData["id"] ? "selected" : "" }}>{{ $fData["fg_name"] }}</option>
                                    @endforeach
                            </select>
                        </div>
                        
                        <div class="col-md-5">
                            <select name="fg_cat" class="form-select custom-field" id="getPreform" disabled>
                                <option value="0">Select Sku</option>
                            </select>
                        </div>
                            
                        <div class="col-md-2 align-items-right justify-content-between">
                            <button class="btn btn-primary btn-sm" id="preformFilter" type="submit" disabled>
                                <i class="fa-solid fa-filter"></i> Filter
                            </button>
                        </div>
                    </div>
                        
                </div>
            </form>
        </div>
        
        
        @if ($filter == 1)
            <form id="rejectionForm" class="generalformloader" action="{{ url("warehouse/uploadRejection") }}" method="post">
                @csrf
                <div class="procure-box">
                    <input type="hidden" name="production_line_id" value="{{ $selected_production_line_id }}">
                    <input type="hidden" name="shift_from" value="{{ session("shift_from") }}">
                    <input type="hidden" name="shift_to" value="{{ session("shift_to") }}">
                
                    <div class="maincard-procure" id="">
                        @if ($rmpmData)
                            @foreach ($rmpmData as $rValues)
                                <div class="procure-card">
                                    <h6 class="blowinghead mb-3">{{ $rValues["rm_pm_name"] }}</h6>
                                    @if ($rValues["catData"])
                                        @foreach ($rValues["catData"] as $rcData)
                                            <div class="row g-3">
                                                <!-- Category -->
                                                <div class="col-md-1">
                                                    <label class="form-label">Category</label>
                                                    <input type="text" class="procure-input" value="{{ $rcData["rm_pm_cat_name"] }}" readonly />
                                                </div>

                                                <!-- Total Consumed -->
                                                <div class="col-md-3">
                                                    <label class="form-label">Total Consumed</label>
                                                    <input type="number" min="0" max="{{ $rcData["stock_quantity"] }}" placeholder="Max Quantity : {{ $rcData["stock_quantity"] }}" name="catId[{{ $rcData["id"] }}]" step="any" class="form-control custom-field consumed-input" />
                                                </div>

                                                <!-- Unit -->
                                                <div class="col-md-1">
                                                    <label class="form-label">Unit</label>
                                                    <input type="text" class="form-control custom-field readonly-input" value="{{ $rcData["cat_unit"] }}" readonly />
                                                </div>

                                                <!-- Rejection -->
                                                <div class="col-md-3">
                                                    <label class="form-label">Rejection</label>
                                                    <input type="number" min="0" max="{{ $rcData["stock_quantity"] }}" placeholder="Max Quantity : {{ $rcData["stock_quantity"] }}" name="rejectionCat[{{ $rcData["id"] }}]" step="any" class="form-control custom-field rejection-input" />
                                                </div>

                                                <!-- Unit -->
                                                <div class="col-md-1">
                                                    <label class="form-label">Unit</label>
                                                    <input type="text" class="form-control custom-field readonly-input" value="{{ $rcData["cat_unit"] }}" readonly />
                                                </div>

                                                <!-- Rejection % -->
                                                <div class="col-md-3">
                                                    <label class="form-label">Rejection %</label>
                                                    <input type="text" name="rejection_percentage[{{ $rcData["id"] }}]" class="form-control custom-field rejection-percentage"  readonly/>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif

                                </div>
                            @endforeach
                        @endif
                    </div>

                    <!-- ---->
                    <div class="modal fade" id="rejectionModal">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content shift-modal">
                                <!-- HEADER -->
                                <div class="modal-header">
                                    <h4 class="mb-0">Rejection Exceeded</h4>
                                    <button class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- SHIFT ROW -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="rmpm-field">
                                                <label>Total Rejection</label>
                                                <input type="text" name="total_rejection" id="all_rejection" readonly class="dt-input">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="rmpm-field">
                                                <label>Rejection Reason</label>
                                                <textarea name="remark" class="dt-input" id="" cols="30" rows="10"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer rmpm-footer">
                                    <button class="rmpm-approve" type="button">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <button type="submit" class="procure-btn">Calculate</button>
                </div>
            </form>
        @endif
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function(){

        // FORM
        const form =
            document.getElementById("rejectionForm");

        if(!form)
        {
            console.log("Form not found");
            return;
        }

        // BUTTONS
        const calculateBtn = document.querySelector(".procure-btn");

        const modalSubmitBtn = document.querySelector("#rejectionModal .rmpm-approve");

        // MODAL
        const rejectionModal = new bootstrap.Modal(
                document.getElementById('rejectionModal')
            );

        // INPUTS
        const totalRejectionInput = document.getElementById("all_rejection");

        const remarkField = document.querySelector("textarea[name='remark']");

        // FLAG
        let modalApproved = false;

        // AUTO CALCULATE REJECTION %
        document.querySelectorAll('.procure-card').forEach(card => {

            let rows = card.querySelectorAll('.row');
            rows.forEach(row => {

                let consumedInput =
                    row.querySelector('.consumed-input');

                let rejectionInput =
                    row.querySelector('.rejection-input');

                let percentageInput =
                    row.querySelector('.rejection-percentage');

                // FUNCTION
                function calculatePercentage()
                {

                    let maxConsumed =
                        parseFloat(
                            consumedInput.getAttribute('max')
                        ) || 0;

                    let maxRejection =
                        parseFloat(
                            rejectionInput.getAttribute('max')
                        ) || 0;

                    let consumed =
                        parseFloat(consumedInput.value) || 0;

                    let rejection =
                        parseFloat(rejectionInput.value) || 0;

                    // CHECK CONSUMED MAX
                    if(consumed > maxConsumed)
                    {
                        alert(
                            "Consumed quantity cannot be greater than "
                            + maxConsumed
                        );

                        consumedInput.value = '';
                        percentageInput.value = '';
                        return;
                    }

                    // CHECK REJECTION MAX
                    if(rejection > maxRejection)
                    {
                        alert(
                            "Rejection quantity cannot be greater than "
                            + maxRejection
                        );

                        rejectionInput.value = '';
                        percentageInput.value = '';
                        return;
                    }

                    // REJECTION CANNOT BE GREATER THAN CONSUMED
                    if(rejection > consumed)
                    {
                        alert(
                            "Rejection quantity cannot be greater than Total Consumed quantity."
                        );

                        rejectionInput.value = '';
                        percentageInput.value = '';
                        return;
                    }

                    // PREVENT DIVISION BY ZERO
                    if(consumed <= 0)
                    {
                        percentageInput.value = '';
                        return;
                    }

                    // CALCULATE %
                    let percentage =
                        (rejection / consumed) * 100;

                    // SHOW 2 DECIMAL
                    percentageInput.value =
                        percentage.toFixed(2) + '%';
                }

                // SKIP IF INPUTS NOT FOUND
                if(!consumedInput || !rejectionInput || !percentageInput)
                {
                    return;
                }

                // EVENTS
                consumedInput.addEventListener(
                    'input',
                    calculatePercentage
                );

                rejectionInput.addEventListener(
                    'input',
                    calculatePercentage
                );

            });

        });


        // MAIN FORM SUBMIT
        form.addEventListener("submit", function(e){

            form.dataset.skipLoader = "true";

            // IF MODAL ALREADY APPROVED
            if(modalApproved)
            {
                return true;
            }

            e.preventDefault();
            let totalConsumed = 0;
            let totalRejected = 0;

            // ALL INPUTS
            document.querySelectorAll(".consumed-input")
                .forEach(input => {
                    totalConsumed +=
                        parseFloat(input.value) || 0;
                });

            document.querySelectorAll(".rejection-input")
                .forEach(input => {
                    totalRejected +=
                        parseFloat(input.value) || 0;
                });

            // PREVENT DIVISION BY ZERO
            if(totalConsumed <= 0)
            {
                alert("Please enter consumed quantity.");
                return;
            }

            // TOTAL %
            let totalPercentage =
                (totalRejected / totalConsumed) * 100;

            // STORE TOTAL %
            totalRejectionInput.value =
                totalPercentage.toFixed(2) + '%';

            // FLAG
            let isExceeded = false;

            // CHECK EVERY ROW
            document.querySelectorAll(".rejection-percentage")
                .forEach(input => {

                    let value =
                        parseFloat(input.value) || 0;

                    if(value > 1)
                    {
                        isExceeded = true;
                    }
                });

            // SHOW MODAL IF ANY ROW > 1%
            if(isExceeded)
            {
                rejectionModal.show();
            }
            else
            {
                modalApproved = true;
                form.dataset.skipLoader = "false";
                form.submit();
            }

        });


        // MODAL SUBMIT BUTTON
        modalSubmitBtn.addEventListener("click", function(e){
            e.preventDefault();

            // CHECK REMARK
            if(remarkField.value.trim() == "")
            {
                alert("Please enter rejection reason.");
                rejectionModal.show();
                return;
            }

            // FINAL SUBMIT
            modalApproved = true;
            form.dataset.skipLoader = "false";
            form.submit();

        });

    });

</script>



<script>

    $("#getFgCat").change(function() {
        getFgCatData($(this).val());
    })

    function getFgCatData(id, selectedFgCatId = 0) {
        $.ajax({
            url: "{{ url('/warehouse/getFgCatDataById') }}",
            type: "GET",
            data: {
                fgId: id
            },

            success: function(response)
            {   
                if (response.status == "success") {
                        
                    // Enable dropdown
                    $("#getPreform").prop("disabled", false);

                    // Clear old options
                    $("#getPreform").html(
                        '<option value="0">Select Sku</option>'
                    );

                    // Add new options
                    $.each(response.fgCatData, function(index, value) {

                        $("#getPreform").append(
                            `<option value="${value.id}">
                                ${value.fg_cat_name}
                            </option>`
                        );

                    });

                    if (selectedFgCatId != 0) {
                        $("#getPreform").val(selectedFgCatId);
                    }

                } else {
                    alert("No Data Available!!");
                    $("#loaderOverlay").hide();
                }
            },

            error: function(error)
            {
                console.log(error);
            }
        });
    }

</script>

<script>
    $("#getPreform").change(function() {
        if ($(this).val() != 0) {
            $("#preformFilter").prop("disabled", false);
        }
    });
</script>

@if (isset($fg_id) && isset($fg_cat_id))
<script>

    $(document).ready(function () {

        getFgCatData(
            {{ $fg_id }},
            {{ $fg_cat_id }}
        );

        $("#preformFilter").prop("disabled", false);

    });

</script>
@endif


@endsection