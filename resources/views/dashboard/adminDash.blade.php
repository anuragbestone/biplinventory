@extends("layouts.app") 
@section("mainContent")
<style>
   .graph-area {
   display: flex;
   align-items: flex-end;
   gap: 30px;
   overflow-x: auto;
   }
   .day-group {
   min-width: 120px;
   }
   .bars {
   display: flex;
   align-items: flex-end;
   gap: 35px;
   height: 300px;
   padding-right: 30px;
   }
   .bar {
   width: 22px;
   border-radius: 8px 8px 0 0;
   position: relative;
   transition: 0.3s;
   }
   .bar small {
   position: absolute;
   top: -22px;
   left: 10px;
   font-size: 11px;
   white-space: nowrap;
   }
   .bottle-mask{
   position:absolute;
   width:100%;
   height:100%;
   overflow:hidden;
   /* 🔥 MAGIC LINE */
   -webkit-mask-image: url("{{ asset("assets") }}/images/sdsd.svg");
   -webkit-mask-size: contain;
   -webkit-mask-repeat: no-repeat;
   -webkit-mask-position: center;
   mask-image: url("{{ asset("assets") }}/images/sdsd.svg");
   mask-size: contain;
   mask-repeat: no-repeat;
   mask-position: center;
   }
   .bottle-mask500ml{
   position:absolute;
   width:100%;
   height:100%;
   overflow:hidden;
   /* 🔥 MAGIC LINE */
   -webkit-mask-image: url("{{ asset("assets") }}/images/500ml.svg");
   -webkit-mask-size: contain;
   -webkit-mask-repeat: no-repeat;
   -webkit-mask-position: center;
   mask-image: url("{{ asset("assets") }}/images/500ml.svg");
   mask-size: contain;
   mask-repeat: no-repeat;
   mask-position: center;
   }
   .bottle-mask200ml{
   position:absolute;
   width:100%;
   height:100%;
   overflow:hidden;
   /* 🔥 MAGIC LINE */
   -webkit-mask-image: url("{{ asset("assets") }}/images/200ml.svg");
   -webkit-mask-size: contain;
   -webkit-mask-repeat: no-repeat;
   -webkit-mask-position: center;
   mask-image: url("{{ asset("assets") }}/images/200ml.svg");
   mask-size: contain;
   mask-repeat: no-repeat;
   mask-position: center;
   }
   .bottle-mask200mpink{
   position:absolute;
   width:100%;
   height:100%;
   overflow:hidden;
   /* 🔥 MAGIC LINE */
   -webkit-mask-image: url("{{ asset("assets") }}/images/200mlneeri.svg");
   -webkit-mask-size: contain;
   -webkit-mask-repeat: no-repeat;
   -webkit-mask-position: center;
   mask-image: url("{{ asset("assets") }}/images/200mlneeri.svg");
   mask-size: contain;
   mask-repeat: no-repeat;
   mask-position: center;
   }
   .bottle-mask2ltr{
   position:absolute;
   width:100%;
   height:100%;
   overflow:hidden;
   /* 🔥 MAGIC LINE */
   -webkit-mask-image: url("{{ asset("assets") }}/images/2ltrbottle.svg");
   -webkit-mask-size: contain;
   -webkit-mask-repeat: no-repeat;
   -webkit-mask-position: center;
   mask-image: url("{{ asset("assets") }}/images/2ltrbottle.svg");
   mask-size: contain;
   mask-repeat: no-repeat;
   mask-position: center;
   }
</style>


<div class="main-card shadow-sm">
    <h5 class="main-heading text-center mb-3 fw-light-custom">
        Welcome, <b class="fw-semibold">Bestone Inventory System</b>
    </h5>
    <div class="card shadow-sm p-3 mt-5" style="border-radius: 20px; background: #eef3fb59; border: #fff solid 1px">
        <!-- TOP BAR -->
        <div class="d-flex justify-content-between mx-auto align-items-center mb-3">
            <div class="card-wrapper">
                <!-- Floating Today Badge -->
                <div class="today-badge">
                    <div class="today-text">Today</div>
                    <div class="time-text">
                        {{ \Carbon\Carbon::now()->format('h:i A') }}
                    </div>
                </div>
            </div>
        </div>
        <div class="row pt-4">

            @if ($productionLineDataFG)
                @foreach ($productionLineDataFG as $productionLineValues)
            
                    <div class="col-md-6">
                        <div class="bottle-card shadow-sm">
                            <!-- Alert -->
                            <div class="d-flex align-items-center justify-content-between">
                                <button class="alert-btn" id="production_line_hault_alert_{{ $productionLineValues["productionLineDetails"]["id"] }}" style="display: none;">
                                    <i class="bi bi-exclamation-triangle-fill"></i>
                                    <span>Alert</span>
                                </button>
                                <div class="status-box">
                                    <span class="status-label" id="production_line_status_{{ $productionLineValues["productionLineDetails"]["id"] }}" style="display: none;">Status:</span>
                                    <span class="status-indicator deactive" id="production_line_alert_{{ $productionLineValues["productionLineDetails"]["id"] }}" style="display: none;"></span>
                                    <span class="status-time" id="production_line_last_active_{{ $productionLineValues["productionLineDetails"]["id"] }}" style="display: none;">0 min Ago</span>
                                </div>
                            </div>


                            <div class="linetext">
                                <h3 class="mt-2 fw-light-custom">{{ $productionLineValues["productionLineDetails"]["line_name"] }}</h3>
                                <p class="small text-muted" id="production_line_cases_{{ $productionLineValues["productionLineDetails"]["id"] }}"><b>Total 0 Cases</b></p>
                                <span id="production_line_status_for_inactive_{{ $productionLineValues["productionLineDetails"]["id"] }}">Production Is Not Active For This Line</span><br>
                                <span id="production_line_fg_{{ $productionLineValues["productionLineDetails"]["id"] }}" style="display: none;">Production Is Active For : 1 Ltr</span>
                            </div>

                            <div class="p-3 mt-5" style="border-radius: 20px; background: #eef3fb59; border: #fff solid 1px">
                                <div class="size-tabs group-left">
                                    @if ($productionLineValues["fgData"])
                                        @foreach ($productionLineValues["fgData"] as $pFGData)
                                            <div class="size-item" id="fg_status_{{ $productionLineValues["productionLineDetails"]["id"] }}_{{ $pFGData["id"] }}" style="display: none;">
                                                <!-- Active function below -->
                                                <button 
                                                    class="tab-btn" id="selected_fg_option_{{ $productionLineValues["productionLineDetails"]["id"] }}_{{ $pFGData["id"] }}" 
                                                    data-target="{{ $pFGData["main_id"] }}">
                                                    {{ $pFGData["fg_cat_name"] }}
                                                </button>
                                                <span class="case-text">0 Cases</span>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>

                                <!-- Bottle Html Starts -->
                                @if ($productionLineValues["fgData"])
                                    @foreach ($productionLineValues["fgData"] as $bottleData)
                                        <!-- Active function below -->
                                        <div 
                                            id="{{ $bottleData["main_id"] }}"
                                            class="tab-content">
                                            <div class="{{ $bottleData["main_class"] }}">
                                                <!-- BUTTONS -->
                                                <div class="bottle">
                                                    <audio
                                                        id="waterSound"
                                                        src="https://bestoneindia.com/bottlesui/universfield-fill-water-192164.mp3"
                                                    ></audio>
                                                    <div class="bottle-wrapper">
                                                        <div class="{{ $bottleData["sub_class"] }}">
                                                            <div class="{{ $bottleData["inner_class"] }}">
                                                                <div class="levels" id="levels"></div>
                                                                <div 
                                                                    class="water fg_water_capacity_{{ $productionLineValues["productionLineDetails"]["id"] }}_{{ $bottleData["id"] }}" 
                                                                    id="water">
                                                                    <div class="surface"></div>
                                                                    <div class="bubbles">
                                                                        <span></span>
                                                                        <span></span>
                                                                        <span></span>
                                                                        <span></span>
                                                                        <span></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <img src="{{ asset("assets") }}/{{ $bottleData["bottle_image"] }}" alt="" class="imgbottlebestone" />
                                                        </div>
                                                        <div class="indicators" id="indicators"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                <!-- Bottle Html Ends -->

                            </div>
                        </div>
                    </div>
                @endforeach
            @endif

        </div>
    </div>


    <div class="main-finishmaterial mt-4">
        <div class="row">
            <!-- LEFT COLUMN -->
            <div class="col-md-6">
                <div class="card card-custom">
                    <div class="header-box">
                        <img src="{{ asset("assets") }}/images/bottleimg.png" alt="img" />
                        <div>
                            <div class="title">Total Finish Goods</div>
                            <div class="sub-text">Total {{ $fgTotalQuantity }} Cases</div>
                        </div>
                    </div>
                    <table class="table table-borderless table-custom">
                        @if ($fgData)
                            @foreach ($fgData as $fData)
                                <tr>
                                    <td>{{ $fData["fg_cat_name"] }} ({{ $fData["fg_name"] }})</td>
                                    <td class="qty">{{ $fData["stock_quantity"] }} Cases</td>
                                </tr>
                            @endforeach
                        @endif
                    </table>
                </div>
            </div>
            <!-- RIGHT COLUMN -->
            <div class="col-md-6">
                <div class="card card-custom">
                    <div class="header-box">
                        <img src="{{ asset("assets") }}/images/factory.png" alt="img" />
                        <div>
                            <div class="title">Today's Production</div>
                            <div class="sub-text">Total {{ $currentDayTotalProduction }} Case</div>
                        </div>
                    </div>
                    <table class="table table-borderless table-custom">
                        @if ($currentdayProduction)
                            @foreach ($currentdayProduction as $cProduction)
                                <tr>
                                    <td>{{ $cProduction["fgData"]["fg_cat_name"] }} ({{ $cProduction["fgData"]["fg_name"] }})</td>
                                    <td class="qty">{{ $cProduction["production"] }} Cases</td>
                                </tr>
                            @endforeach
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="production-stats-main mt-4">
        <div class="production-card">
            <div class="d-flex align-items-center justify-content-between flex-wrap pb-5">
                <div class="header-spacer"></div>
                <div class="production-header">
                    <h2>Dispatch Stats</h2>
                    <p>
                        @if($selectedFilter == "1day")
                            Today Dispatch
                        @elseif($selectedFilter == "1month")
                            Last 1 Month Dispatch
                        @else
                            Last 7 Days Dispatch
                        @endif
                    </p>
                </div>
            
                <!-- FILTER -->
                <div>
                    <form method="GET">
                        <select
                            name="filter"
                            class="form-select"
                            onchange="this.form.submit()"
                        >
                            <option value="1day"
                                {{ $selectedFilter == "1day" ? "selected" : "" }}>
                                1 Day
                            </option>
                            <option value="7days"
                                {{ $selectedFilter == "7days" ? "selected" : "" }}>
                                7 Days
                            </option>
                            <option value="1month"
                                {{ $selectedFilter == "1month" ? "selected" : "" }}>
                                1 Month
                            </option>
                        </select>
                    </form>
                </div>
            </div>

            <div class="production-chart">
                <!-- Y AXIS -->
                <div class="y-axis">
                    <span>{{ $maxDispatchQty }}</span>
                    <span>{{ round($maxDispatchQty * 0.75) }}</span>
                    <span>{{ round($maxDispatchQty * 0.50) }}</span>
                    <span>{{ round($maxDispatchQty * 0.25) }}</span>
                    <span>0</span>
                </div>
                <!-- GRAPH -->
                <div class="graph-area">
                    @php
                        $barClasses = [
                            "bar1",
                            "bar2",
                            "bar3",
                            "bar4",
                            "bar5 pink"
                        ];
                    @endphp
                    @foreach($dispatchGraphData as $day => $dispatchValues)
                        <div class="day-group">
                            <div class="bars">
                                @foreach($fgCategories as $index => $cat)
                                    @php
                                        $qty = $dispatchValues[$cat["fg_cat_name"]] ?? 0;
                                        $height = 0;
                                        if($maxDispatchQty > 0){
                                            $height = ($qty / $maxDispatchQty) * 100;
                                        }
                                    @endphp
                                    <div
                                        class="bar {{ $barClasses[$index % 5] }}"
                                        style="height: {{ $height }}%"
                                    >
                                        <small>
                                            {{ $cat["fg_cat_name"] }}
                                        </small>
                                    </div>
                                @endforeach
                            </div>
                            <h4>{{ $day }}</h4>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    
    <div class="main-rmpm-rejection">
        <div class="row">
            <div class="col-md-6">
                <div class="total-rmpm mb-4 h-100">
                    <div class="d-flex align-items-center justify-content-between flex-wrap pb-5">
                        <!-- Left spacer -->
                        <div class="header-spacer"></div>
                        <h5 class="text-center section-title m-0 flex-grow-1">Total RM/PM Stock</h5>
                        <!-- Right Button -->
                        <div>
                            <a href="{{ url("stockReport") }}"><button class="btn btn-primary btn-sm">Details</button></a>
                        </div>
                    </div>
                    <div class="row text-center justify-content-center rm-row stockreportrmpm">
                        @if ($rmPmStockWiseData)
                            @foreach ($rmPmStockWiseData as $rSWData)
                                <div class="col-md-4 custom-col hover-card">
                                    <div class="hex-box">
                                        <div class="hex">
                                            <img src="{{ asset("assets") }}/{{ $rSWData["rm_pm_image"] }}" alt="{{ $rSWData["rm_pm_name"] }}" />
                                        </div>
                                    </div>
                                    <a>
                                        <div class="hex-btn">{{ $rSWData["rm_pm_name"] }}</div>
                                    </a>
                                    <!-- HOVER CARD -->
                                    <div class="hover-popup">
                                        <div class="hover-inner">
                                            <div class="hover-head">
                                                <span>Category</span>
                                                <span>Qty</span>
                                            </div>
                                            @foreach ($rSWData["rcData"] as $rStockData)
                                                <div class="hover-row">
                                                    <span>{{ $rStockData["rm_pm_cat_name"] }}</span>
                                                    <span>{{ $rStockData["stock_quantity"] }} {{ $rStockData["cat_unit"] }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
         
            <div class="col-md-6">
                <div class="rejection-main h-100 mb-4">
                    <div class="row rejection-row align-items-center">
                        <div class="rejection-title text-center pt-4">Total Rejection</div>
                            <div class="col-md-4">
                                <canvas id="pie_chart" height="250"></canvas>
                            </div>
                            <div class="col-md-8">
                                <div class="rejection-card">
                                    <div class="table-responsive">
                                        <table class="table rejection-table">
                                            <tbody>
                                                <tr class="table-item" data-index="0">
                                                    <td>
                                                        <div class="left-side">
                                                            <span class="item-name">Preform</span>
                                                            <span class="color-box preform"></span>
                                                        </div>
                                                    </td>
                                                    <td>152</td>
                                                </tr>
                                                <tr class="table-item" data-index="1">
                                                    <td>
                                                        <div class="left-side">
                                                            <span class="item-name">Caps</span>
                                                            <span class="color-box cap"></span>
                                                        </div>
                                                    </td>
                                                    <td>152</td>
                                                </tr>
                                                <tr class="table-item" data-index="2">
                                                    <td>
                                                        <div class="left-side">
                                                            <span class="item-name">Label</span>
                                                            <span class="color-box label"></span>
                                                        </div>
                                                    </td>
                                                    <td>20</td>
                                                </tr>
                                                <tr class="table-item" data-index="3">
                                                    <td>
                                                        <div class="left-side">
                                                            <span class="item-name">Sticker</span>
                                                            <span class="color-box sticker"></span>
                                                        </div>
                                                    </td>
                                                    <td>280</td>
                                                </tr>
                                                <tr class="table-item" data-index="4">
                                                    <td>
                                                        <div class="left-side">
                                                            <span class="item-name">LD</span>
                                                            <span class="color-box ld"></span>
                                                        </div>
                                                    </td>
                                                    <td>300</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   
        <!-- Production Graph Starts --->
        <div class="production-stats-main mt-4">
            <div class="production-card">
                <div class="d-flex align-items-center justify-content-between flex-wrap pb-5">
                    <div class="header-spacer"></div>
                    <div class="production-header">
                        <h2>Production Stats</h2>
                        <p>
                            @if($selectedProductionFilter == "1day")
                                Today Production
                            @elseif($selectedProductionFilter == "1month")
                                Last 1 Month Production
                            @else
                                Last 7 Days Production
                            @endif
                        </p>
                    </div>
                    <!-- SEPARATE FILTER -->
                    <div>
                        <form method="GET">
                            <!-- PRESERVE DISPATCH FILTER -->
                            <input
                                type="hidden"
                                name="filter"
                                value="{{ $selectedFilter }}"
                            >
                            <select
                                name="production_filter"
                                class="form-select"
                                onchange="this.form.submit()"
                            >
                                <option
                                    value="1day"
                                    {{
                                    $selectedProductionFilter == "1day"
                                    ? "selected"
                                    : ""
                                    }}
                                >
                                1 Day
                                </option>
                                <option
                                    value="7days"
                                    {{
                                    $selectedProductionFilter == "7days"
                                    ? "selected"
                                    : ""
                                    }}
                                >
                                    7 Days
                                </option>
                                <option
                                    value="1month"
                                    {{
                                    $selectedProductionFilter == "1month"
                                    ? "selected"
                                    : ""
                                    }}
                                >
                                    1 Month
                                </option>
                            </select>
                        </form>
                    </div>
                </div>
                <div class="production-chart">
                    <!-- Y AXIS -->
                    <div class="y-axis">
                        <span>{{ $maxProductionQty }}</span>
                        <span>{{ round($maxProductionQty * 0.75) }}</span>
                        <span>{{ round($maxProductionQty * 0.50) }}</span>
                        <span>{{ round($maxProductionQty * 0.25) }}</span>
                        <span>0</span>
                    </div>
                    <!-- GRAPH AREA -->
                    <div class="graph-area">
                        @php
                            $barClasses = [
                                "bar1",
                                "bar2",
                                "bar3",
                                "bar4",
                                "bar5 pink"
                            ];
                        @endphp
                        @foreach($productionGraphData as $day => $productionValues)
                            <div class="day-group">
                                <div class="bars">
                                    @foreach($fgCategories as $index => $cat)
                                        @php
                                            $qty =
                                            $productionValues[
                                            $cat["fg_cat_name"]
                                            ] ?? 0;
                                            $height = 0;
                                            if($maxProductionQty > 0){
                                                $height =
                                                (
                                                $qty /
                                                $maxProductionQty
                                                ) * 100;
                                            }
                                        @endphp
                                        <div
                                            class="bar {{ $barClasses[$index % 5] }}"
                                            style="height: {{ $height }}%"
                                        >
                                            <small>
                                                {{ $cat["fg_cat_name"] }}
                                            </small>
                                        </div>
                                    @endforeach
                                </div>
                                <h4>{{ $day }}</h4>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- Production Graph Ends --->
    </div>

    
<script>
document.querySelectorAll(".size-tabs").forEach(group => {
 
    const buttons = group.querySelectorAll(".tab-btn");
 
    buttons.forEach(btn => {
        btn.addEventListener("click", () => {
 
            // 1. Active button
            buttons.forEach(b => b.classList.remove("active"));
            btn.classList.add("active");
 
            // 2. Same column pakdo
            const col = group.closest(".col-md-6");
 
            // 3. Hide all
            const contents = col.querySelectorAll(".tab-content");
            contents.forEach(c => c.classList.remove("active"));
 
            // 4. Show target
            const target = btn.dataset.target;
            const activeDiv = col.querySelector("#" + target);
 
            if (activeDiv) {
                activeDiv.classList.add("active");
 
                // ðŸ”¥ YAHI ADD KARNA THA (INSIDE)
                const bottle = activeDiv.querySelector(".bottlemain");
                if(bottle){
                    startBottle(bottle);
                }
            }
 
        });
    });
 
});
</script>


            <script>

// ===============================
//  MAIN FUNCTION
// ===============================
function startBottle(container){

    const levelsContainer = container.querySelector(".levels");
    const indicators = container.querySelector(".indicators");
    const water = container.querySelector(".water");
    const audio = container.querySelector("audio");
    const bottle = container.querySelector(".bottle");

    if(!levelsContainer || !water || !bottle) return;

    // ===============================
    //  UNIQUE PREFIX PER BOTTLE
    // ===============================
    let prefix = "";

    if(container.classList.contains("bottlemain1ltr")) prefix = "b1";
    else if(container.classList.contains("bottlemain2ltr")) prefix = "b2";
    else if(container.classList.contains("bottlemain500ml")) prefix = "b500";
    else if(container.classList.contains("bottlemain200ml")) prefix = "b200";
    else if(container.classList.contains("bottlemain200mlpink")) prefix = "bpink";

    // ===============================
    //  LEVELS DATA
    // ===============================
    let levels = [];

    if(prefix === "b2"){
        levels = [
            { cases: 100, height: 0.15, msg: "Great Production 🔥" },
            { cases: 200, height: 0.35, msg: "Awesome Speed 🚀" },
            { cases: 300, height: 0.6, msg: "Keep Going 💪" },
            { cases: 400, height: 0.85, msg: "Target Achieved 🎯" },
        ];
    }
    else if(prefix === "b1"){
        levels = [
            { cases: 50, height: 0.2, msg: "Great Production 🔥" },
            { cases: 100, height: 0.4, msg: "Awesome Speed 🚀" },
            { cases: 150, height: 0.65, msg: "Keep Going 💪" },
            { cases: 200, height: 0.85, msg: "Target Achieved 🎯" },
        ];
    }
    else if(prefix === "b500"){
        levels = [
            { cases: 30, height: 0.25, msg: "Great Production 🔥" },
            { cases: 60, height: 0.45, msg: "Awesome Speed 🚀" },
            { cases: 90, height: 0.7, msg: "Keep Going 💪" },
            { cases: 120, height: 0.9, msg: "Target Achieved 🎯" },
        ];
    }
    else if(prefix === "b200"){
        levels = [
            { cases: 20, height: 0.3, msg: "Great Production 🔥" },
            { cases: 40, height: 0.5, msg: "Awesome Speed 🚀" },
            { cases: 60, height: 0.75, msg: "Keep Going 💪" },
            { cases: 80, height: 0.95, msg: "Target Achieved 🎯" },
        ];
    }
    else if(prefix === "bpink"){
        levels = [
            { cases: 20, height: 0.28, msg: "Great Production 🔥" },
            { cases: 40, height: 0.48, msg: "Awesome Speed 🚀" },
            { cases: 60, height: 0.72, msg: "Keep Going 💪" },
            { cases: 80, height: 0.92, msg: "Target Achieved 🎯" },
        ];
    }

    // ===============================
    //  RESET
    // ===============================
    levelsContainer.innerHTML = "";
    indicators.innerHTML = "";
    container.querySelectorAll(".popup").forEach(p => p.remove());
    water.style.height = "0%";

    // ===============================
    //  CREATE ELEMENTS
    // ===============================
    levels.forEach((lvl, i) => {

        // LEVEL LINE
        let line = document.createElement("div");
        line.className = `lvl lvl-${prefix}-${i}`;
        line.id = `lvl-${prefix}-${i}`;
        line.style.bottom = (lvl.height * 100) + "%";
        levelsContainer.appendChild(line);

        // INDICATOR
        let ind = document.createElement("div");
        ind.className = `indicator ind-${prefix}-${i}`;
        ind.id = `ind-${prefix}-${i}`;
        ind.style.bottom = (lvl.height * 100) + "%";
        ind.innerHTML = `
            <div class="line"></div>
            <div class="dot"></div>
            ${lvl.cases}
        `;
        indicators.appendChild(ind);

        // POPUP
        let pop = document.createElement("div");
        pop.className = `popup pop-${prefix}-${i}`;
        pop.id = `pop-${prefix}-${i}`;
        pop.style.bottom = (lvl.height * 100) + "%";
        pop.innerText = lvl.msg;
        bottle.appendChild(pop);
    });

    // ===============================
    //  ANIMATION
    // ===============================
    let currentIndex = 0;
    let currentHeight = 0;

    function animateTo(targetHeight, index){
        const speed = 0.001;

        if(audio){
            audio.currentTime = 0;
            audio.play().catch(()=>{});
        }

        function step(){
            currentHeight += speed;
            water.style.height = (currentHeight * 100) + "%";

            if(currentHeight >= targetHeight){
                currentHeight = targetHeight;
                levelsContainer.children[index]?.classList.add("active");
                let ind = indicators.children[index];
                if(ind){
                    ind.classList.add("active");
                    ind.querySelector(".dot")?.classList.add("blink");
                }

                container.querySelectorAll(".popup")[index]?.classList.add("active");
                if(audio) audio.pause();
                return;
            }

            requestAnimationFrame(step);
        }

        step();
    }

    function run(){
        if(currentIndex < levels.length){
            animateTo(levels[currentIndex].height, currentIndex);
            currentIndex++;
            setTimeout(run, 2500);
        }
    }

    run();
}


// ===============================
//  TAB SWITCH SYSTEM (FIXED)
// ===============================
document.querySelectorAll(".size-tabs").forEach(group => {
    const buttons = group.querySelectorAll(".tab-btn");
    buttons.forEach(btn => {
        btn.addEventListener("click", () => {
            buttons.forEach(b => b.classList.remove("active"));
            btn.classList.add("active");
            const col = group.closest(".col-md-6");
            col.querySelectorAll(".tab-content").forEach(c => {
                c.classList.remove("active");
            });

            const target = btn.dataset.target;
            const activeDiv = col.querySelector("#" + target);

            if(activeDiv){
                activeDiv.classList.add("active");
                const bottle = activeDiv.querySelector(".bottlemain");
                if(bottle){
                    setTimeout(() => startBottle(bottle), 100);
                }
            }
        });
    });
});


// ===============================
// FIRST LOAD
// ===============================
window.onload = () => {
    document.querySelectorAll(".tab-content.active").forEach(tab => {
        const bottle = tab.querySelector(".bottlemain");
        if(bottle){
            startBottle(bottle);
        }
    });
};

</script>

<script>
document.querySelectorAll(".size-tabs").forEach(group => {

    const buttons = group.querySelectorAll(".tab-btn");

    buttons.forEach(btn => {
        btn.addEventListener("click", () => {

            // 1. Active button
            buttons.forEach(b => b.classList.remove("active"));
            btn.classList.add("active");

            // 2. Same column pakdo
            const col = group.closest(".col-md-6");

            // 3. Hide all
            const contents = col.querySelectorAll(".tab-content");
            contents.forEach(c => c.classList.remove("active"));

            // 4. Show target
            const target = btn.dataset.target;
            const activeDiv = col.querySelector("#" + target);

            if (activeDiv) {
                activeDiv.classList.add("active");

                // ðŸ”¥ YAHI ADD KARNA THA (INSIDE)
                const bottle = activeDiv.querySelector(".bottlemain");
                if(bottle){
                    startBottle(bottle);
                }
            }

        });
    });

});
</script>

<!-- Bottle JS Starts --->
<script>

    function getProductionStatus() {
        $.ajax({
            url: "{{ url('/getProductionStatus') }}",
            type: "GET",
            success: function(response) {
                if (response.data.productionLineStatus) {
                    response.data.productionLineStatus.forEach(function(item) {
                        
                        if (item.productionData != null) {

                            let startTime = new Date(item.productionData.production_start_time.replace(/-/g, "/"));
                            let timerSeconds = item.productionData.production_timer_seconds;
                            let endTime = new Date(startTime.getTime() + (timerSeconds * 1000));
                            let currentTime = new Date();
                            let diffMilliseconds = currentTime - startTime;
                            let diffMinutes = Math.floor(diffMilliseconds / (1000 * 60));

                            $("#production_line_status_" + item.counter.id).show();
                            $("#production_line_last_active_" + item.counter.id).show();
                            $("#production_line_last_active_" + item.counter.id).html(`${diffMinutes} min's ago`);
                            $("#production_line_alert_" + item.counter.id).show();
                            
                            $("#fg_status_" + item.counter.id + "_" + item.productionData.fgId).show();
                            $("#selected_fg_option_" + item.counter.id + "_" + item.productionData.fgId).addClass("active");
                            $("#" + item.productionData.main_id).addClass("active");

                            const activeBottle = document.querySelector("#" + item.productionData.main_id + ".bottlemain");
                            if(activeBottle){
                                startBottle(activeBottle);
                            }

                            $("#fg_water_capacity_" + item.counter.id + "_" + item.productionData.fgId).css("height", "20%");

                            startBottle(".bottlemain");

                            if (currentTime > endTime) {
                                $("#production_line_hault_alert_" + item.counter.id).show();
                                $("#production_line_alert_" + item.counter.id)
                                    .addClass("deactive")
                                    .removeClass("active");
                                $("#production_line_status_for_inactive_" + item.counter.id).html(
                                    `Production Line Time Has Been Exceeded It's Limit`
                                );
                            } else {
                                $("#production_line_hault_alert_" + item.counter.id).hide();
                                $("#production_line_alert_" + item.counter.id)
                                    .addClass("active")
                                    .removeClass("deactive");
                                $("#production_line_status_for_inactive_" + item.counter.id).html(
                                    `Production Is Active For This Line`
                                );
                            }

                        } else {

                            $("#production_line_hault_alert_" + item.counter.id).hide();
                            $("#production_line_status_" + item.counter.id).hide();
                            $("#production_line_last_active_" + item.counter.id).hide();
                            $("#production_line_last_active_" + item.counter.id).html(`0 min's ago`);
                            $("#production_line_alert_" + item.counter.id).hide();
                            $("#production_line_status_for_inactive_" + item.counter.id).html(
                                    `Production Is Not Active For This Line`
                                );
                        }

                    });
                }
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    $(document).ready(function(){
        getProductionStatus();
        setInterval(function () {
            getProductionStatus();
        }, 10000);
    });

</script>
<!-- Bottle JS Ends --->

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const canvas = document.getElementById("pie_chart");
   
        if (!canvas) {
            console.error("Canvas not found!");
            return;
        }
   
        const ctx = canvas.getContext("2d");
   
        new Chart(ctx, {
            type: "doughnut",
            data: {
                labels: ["Preform", "Caps", "Label", "Sticker", "LD"],
                datasets: [
                    {
                        data: [152, 152, 20, 280, 300],
                        backgroundColor: ["#e96b63", "#36b0a9", "#4b5aa6", "#66b08a", "#f4be2c"],
                        borderWidth: 0,
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: "65%",
                plugins: {
                    legend: {
                        display: false,
                    },
                },
            },
        });
    });

</script>
@endsection