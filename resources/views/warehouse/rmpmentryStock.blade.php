@extends("layouts.app")
@section("mainContent")

<div class="main-card content shadow-sm">
    <div class="rmpm-user-main-entry">
        <h2 class="text-center section-title m-0 flex-grow-1 pb-5">RM/PM Entry Stock</h2>
        <form  class="generalformloader" method="post" action="{{ url("warehouse/rmpmentryStockDo") }}">
            @csrf
            <div class="row">
                @if ($rmpmData)
                    @foreach ($rmpmData as $rData)
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
                                                readonly class="category"
                                            >
                                            <input
                                                type="number"
                                                inputmode="decimal"
                                                step="0.001"
                                                id="rmPmCat_{{ $rcData['id'] }}"
                                                name="{{ $rcData['id'] }}[]"
                                                min="0"
                                                placeholder="Enter Qty"
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
                    @endforeach
                @endif
            </div>

            <div class="text-center mt-3">
                <button type="submit" class="rmpm-user-submit-btn">
                    Submit
                </button>
            </div>
        </form>
    </div>
</div>

@endsection