@extends("layouts.app")
@section("mainContent")

<div id="loaderOverlay" style="
    display:none;
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,0.5);
    z-index:9999;
">

    <div style="
        position:absolute;
        top:50%;
        left:50%;
        transform:translate(-50%, -50%);
        color:white;
        font-size:20px;
    ">
        Loading...
    </div>

</div>

@php
//echo "<pre>";print_r($rmPmData);
@endphp

    <div class="overall-status-main">
        <!-- TABLE -->
        <form action="{{ url("fgPmFormulaUpload") }}" method="POST">
            <div class="table-responsive">
                <table class="table table-bordered rmpm-fg-formula">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>SKU</th>
                            @if ($rmPmData)
                                @foreach ($rmPmData as $rData)
                                    <th>{{ $rData["rm_pm_name"] }}</th>
                                @endforeach
                            @endif
                        </tr>
                    </thead>

                    <tbody>
                        @php $counter = 1 @endphp
                        @if ($fgData)
                            @foreach ($fgData as $fData)
                                <tr>
                                    <td>{{ $counter++ }}</td>
                                    <td>{{ $fData["fg_cat_name"] }} ({{ $fData["fg_name"] }})</td>

                                    @if ($rmPmData)
                                        @foreach ($rmPmData as $rData)
                                            <td>
                                                <div class="rmpm-card">
                                                    <a href="#" onclick="getRmPmCatDataByID({{ $rData['id'] }}, {{ $fData['id'] }})">
                                                        <div class="rmpm-card rmpm-toggle">Detail</div>
                                                    </a>
                                                </div>
                                            </td>
                                        @endforeach
                                    @endif

                                </tr>
                            @endforeach
                        @endif

                    </tbody>
                </table>
            </div>
            {{-- <div class="justify-content-center text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div> --}}
        </form>

    </div>

    <div class="modal fade rmpm-fg-formula" id="rmpm-fg-formula" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- HEADER -->
                <div class="modal-header">
                    <h5 class="modal-title" id="card-title">Preform</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ url("fgPmFormulaUpload") }}" method="POST">
                    @csrf
                    <!-- BODY -->
                    <div class="modal-body">
                        <div class="rmpm-inner-card" id="rmpmCard">
                        </div>
                    </div>
                    <input type="hidden" name="fg_cat_id" id="fg_cat_id">
                    <!-- FOOTER -->
                    <div class="modal-footer">
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


<script>

    function getRmPmCatDataByID(rmpmId, fgCatId) {
        $("#loaderOverlay").show();
        $("#fg_cat_id").val(fgCatId);
        $.ajax({
            url: "{{ url('/getRmPmCatDataByID') }}",
            type: "GET",
            data: {
                rmPmId: rmpmId,
                fgCatId: fgCatId
            },

            success: function(response)
            {   
                if (response.status == "success") {
                    $("#card-title").html(response.rmPmName);
                    $("#rmpmCard").html("");
                    let rmPmHtml = '<div class="rmpm-row">';
                    for (let values of response.rmPmCatData) {
                        rmPmHtml += `<label>
                            ${values.rm_pm_cat_name}
                            </label>
                            <input 
                                type="checkbox" 
                                name="rmSelected[${values.id}]" 
                                ${values.rm_pm_cat_quantity != null ? "checked" : ""}
                            >
                            <input 
                                type="number" 
                                value="${values.rm_pm_cat_quantity != null ? values.rm_pm_cat_quantity : 0}" 
                                name="quantity[${values.id}]" placeholder="Enter Qty" step="0.0001"
                            >`;
                    }
                    
                    rmPmHtml += '</div>';
                    $("#rmpmCard").html(rmPmHtml);
                    $("#rmpm-fg-formula").modal("show");
                    $("#loaderOverlay").hide();
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

@endsection