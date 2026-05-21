@extends("layouts.app")

@section("mainContent")
{{-- @php echo "<pre>";print_r($rmpmData);die(); @endphp --}}
<div class="main-card content shadow-sm">

    <div class="rmpm-user-main-entry">
        <h2 class="text-center section-title m-0 flex-grow-1 pb-5">RM/PM Entry</h2>
        
           

            <div class="col-md-12">
                <div class="dt-box">
                    <div class="dt-shiftfrom">
                        <label>Shift From</label>
                        <input type="datetime-local" name="shift_from" value="{{ session("shift_from") }}" class="dt-input" id="shift_from" required onpaste="return false" readonly>
                    </div>
                    <div class="dt-shifto">
                        <label>Shift To</label>
                        <input type="datetime-local" name="shift_to" value="{{ session("shift_to") }}" class="dt-input" id="shift_to" required onpaste="return false" readonly>
                    </div>
                </div>
            </div>

            <form class="generalformloader" action="{{ url("warehouse/rmpmentry") }}" method="get">
                @csrf
                <input type="hidden" name="filter" value="1">
                <div class="maincard-line">
                    <div class="row mb-3 center-row">
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
            <form  class="generalformloader" method="post" action="{{ url("warehouse/rmpmentryDo") }}">
                @csrf
                <input type="hidden" name="production_line_id" value="{{ $selected_production_line_id }}">
                <input type="hidden" name="shift_from" value="{{ session("shift_from") }}">
                <input type="hidden" name="shift_to" value="{{ session("shift_to") }}">
                @php
                    $hasData = 0;
                @endphp

                <div class="row">

                    @if ($rmpmData)

                        @foreach ($rmpmData as $rData)

                            @if (!empty($rData["catData"]))

                                @php
                                    $hasData = 1;
                                @endphp

                                <div class="col-md-4 mb-3">
                                    <div class="rmpm-user-card">

                                        <div class="rmpm-user-card-head">
                                            {{ $rData["rm_pm_name"] }}
                                        </div>

                                        <div class="rmpm-user-card-body">

                                            @foreach ($rData["catData"] as $rcData)

                                            <div class="rmpm-user-row">

                                                <input
                                                    value="{{ $rcData['rm_pm_cat_name'] }}"
                                                    readonly
                                                >

                                                <input
                                                    type="number"
                                                    inputmode="decimal"
                                                    step="0.001"
                                                    id="rmPmCat_{{ $rcData['id'] }}"
                                                    name="{{ $rcData['id'] }}[]"
                                                    min="0"
                                                    placeholder="Enter Qty"

                                                    {!! isset($fg_id) && $rData["rm_pm_name"] == "Preform"
                                                        ? 'onkeyup="setRmPmData('.$rcData['id'].', '.$fg_cat_id.')"'
                                                        : 'readonly'
                                                    !!}
                                                >

                                                <input
                                                    value="{{ $rcData['cat_unit'] }}"
                                                    readonly
                                                >

                                            </div>

                                            @endforeach

                                        </div>
                                    </div>
                                </div>

                            @endif

                        @endforeach

                    @endif

                </div>

                @if ($hasData == 1)

                <div class="text-center mt-3">
                    <button type="submit" class="rmpm-user-submit-btn">
                        Submit
                    </button>
                </div>

                @endif


            </form>

    </div>

</div>


<script>

    let formulaData = @json($formulaData ?? []);

    function setRmPmData(rmPmCatId, fgCatId)
    {
        // Stop if no formula data
        if (formulaData.length === 0) {
            return;
        }

        let enteredQty = parseFloat(
            $("#rmPmCat_" + rmPmCatId).val()
        );

        console.log(formulaData);

        let index = formulaData.findIndex(
            item => item.rm_pm_cat_id == rmPmCatId
        );

        let bottlesCreated = enteredQty / parseFloat(formulaData[index].rm_pm_cat_quantity);

        console.log(formulaData[index]);
        

        // Clear all calculated fields if empty
        if (isNaN(enteredQty) || enteredQty <= 0) {

            formulaData.forEach(function(item){

                $("#rmPmCat_" + item.rm_pm_cat_id).val("");

            });

            return;
        }

        
        // Calculate all RM/PM quantities
        formulaData.forEach(function(item){

            // Skip current preform field
            if (item.rm_pm_cat_id == rmPmCatId) {
                return;
            }

            let finalQty =
                bottlesCreated * parseFloat(item.rm_pm_cat_quantity);

            $("#rmPmCat_" + item.rm_pm_cat_id).val(
                finalQty.toFixed(3)
            );

        });
    }

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

<script>
    document.addEventListener("DOMContentLoaded", function () {

        const shiftFrom = document.getElementById("shift_from");
        const shiftTo = document.getElementById("shift_to");

        // Disable keyboard typing
        shiftFrom.addEventListener("keydown", function (e) {
            e.preventDefault();
        });

        shiftTo.addEventListener("keydown", function (e) {
            e.preventDefault();
        });

        shiftFrom.addEventListener("change", function () {

            shiftTo.min = shiftFrom.value;

            if (shiftTo.value) {

                const fromDate = new Date(shiftFrom.value);
                const toDate = new Date(shiftTo.value);

                if (toDate <= fromDate) {

                    alert("Shift To must be greater than Shift From");

                    shiftTo.value = "";
                }
            }
        });

        shiftTo.addEventListener("change", function () {

            const fromDate = new Date(shiftFrom.value);
            const toDate = new Date(shiftTo.value);

            if (toDate <= fromDate) {

                alert("Shift To must be greater than Shift From");

                shiftTo.value = "";
            }
        });

        document.querySelectorAll(".qty-input").forEach(function(input){

            input.addEventListener("keydown", function(e){

                // BLOCK: e, E, +, -
                if (
                    e.key === "e" ||
                    e.key === "E" ||
                    e.key === "+" ||
                    e.key === "-"
                ) {
                    e.preventDefault();
                }

            });

            input.addEventListener("input", function(){

                // REMOVE INVALID CHARACTERS
                this.value = this.value
                    .replace(/[^0-9.]/g, '')   // allow only numbers and dot
                    .replace(/(\..*)\./g, '$1'); // allow only one dot

            });

        });

    });
</script>



@endsection