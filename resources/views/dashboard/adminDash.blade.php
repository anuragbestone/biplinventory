@extends("layouts.app") @section("mainContent")


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
    gap: 5px;
    height: 300px;
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
    left: -5px;
    font-size: 11px;
    white-space: nowrap;
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


            <!-- LEFT CARD -->
            <div class="col-md-6">
                <div class="bottle-card shadow-sm">
                    <!-- Alert -->
                    <div class="d-flex align-items-center justify-content-between">
                        <button class="alert-btn">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                            <span id="">Line Is Off</span>
                        </button>

                        <div class="status-box">
                            <span class="status-label">Status:</span>

                            <span class="status-indicator deactive"></span>

                            <span class="status-time">6 min Ago</span>
                        </div>
                    </div>

                    <div class="linetext">
                        <h3 class="mt-2 fw-light-custom">Company Owned Contractor Operated Line</h3>
                        <p class="small text-muted"><b>Total 1700 Cases</b></p>
                    </div>

                    <!-- Buttons -->
                    <div class="size-tabs mb-3">
                        <div class="size-item active">
                            <button class="size-btn">1 Ltr</button>
                            <span class="case-text">1200 Cases</span>
                        </div>

                        <div class="size-item">
                            <button class="size-btn">2 Ltr</button>
                            <span class="case-text">600 Cases</span>
                        </div>
                    </div>
                    <div class="bottlemain">
                        <div class="bottle">
                            <audio id="waterSound" src="https://bestoneindia.com/plantbottle/universfield-fill-water-192164.mp3"></audio>

                            <div class="bottle-wrapper">
                                <div class="bottle">
                                    <div class="bottle-mask">
                                        <div class="levels" id="levels"></div>

                                        <div class="water" id="water">
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
                                    <img src="{{ asset("assets") }}/images/sdsd.svg" alt="" class="imgbottlebestone" />
                                </div>

                                <div class="indicators" id="indicators"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <!-- RIGHT CARD -->
            <div class="col-md-6">
                <div class="bottle-card shadow-sm">
                    <!-- Alert -->
                    <div class="d-flex align-items-right justify-content-end">
                        <div class="status-box lineb">
                            <span class="status-label">Status:</span>

                            <span class="status-indicator active"></span>

                            <span class="status-time">2 min Ago</span>
                        </div>
                    </div>

                    <div class="linetext">
                        <h3 class="mt-2 fw-light-custom">Company Owned Contractor Operated Line</h3>
                        <p class="small text-muted"><b>Total 1700 Cases</b></p>
                    </div>

                    <!-- Buttons -->
                    <div class="size-tabs mb-3">
                        <div class="size-item active">
                            <button class="size-btn">200ml</button>
                            <span class="case-text">1200 Cases</span>
                        </div>

                        <div class="size-item">
                            <button class="size-btn pink">200ml</button>
                            <span class="case-text">600 Cases</span>
                        </div>

                        <div class="size-item">
                            <button class="size-btn">500ml</button>
                            <span class="case-text">600 Cases</span>
                        </div>
                    </div>
                    <div class="bottlemain">
                        <div class="bottle">
                            <audio id="waterSound" src="https://bestoneindia.com/plantbottle/universfield-fill-water-192164.mp3"></audio>

                            <div class="bottle-wrapper">
                                <div class="bottle">
                                    <div class="bottle-mask">
                                        <div class="levels" id="levels"></div>

                                        <div class="water" id="water">
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
                                    <img src="{{ asset("assets") }}/images/sdsd.svg" alt="" class="imgbottlebestone" />
                                </div>

                                <div class="indicators" id="indicators"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
    const levelsContainer = document.getElementById("levels");
                const indicators = document.getElementById("indicators");
                const water = document.getElementById("water");
                const audio = document.getElementById("waterSound");

                // data
                const levels = [
                    { cases: 50, height: 0.18, msg: "Great Production 🔥" },
                    { cases: 100, height: 0.34, msg: "Awesome Speed 🚀" },
                    { cases: 150, height: 0.5, msg: "Keep Going 💪" },
                    { cases: 200, height: 0.66, msg: "Target Achieved 🎯" },
                ];

                // UI generate
                levels.forEach((lvl, i) => {
                    const line = document.createElement("div");
                    line.className = "lvl";
                    line.style.bottom = lvl.height * 100 + "%";
                    line.id = "lvl" + i;
                    levelsContainer.appendChild(line);

                    const ind = document.createElement("div");
                    ind.className = "indicator";
                    ind.style.bottom = lvl.height * 100 + "%";
                    ind.id = "ind" + i;

                    ind.innerHTML = `
    <div class="line"></div>
    <div class="dot"></div>
    ${lvl.cases} Cases
  `;

                    indicators.appendChild(ind);

                    const pop = document.createElement("div");
                    pop.className = "popup";
                    pop.style.bottom = lvl.height * 100 + "%";
                    pop.id = "pop" + i;
                    pop.innerText = lvl.msg;

                    document.querySelector(".bottle").appendChild(pop);
                });

                let currentIndex = 0;
                let currentHeight = 0;

                function animateTo(targetHeight, index) {
                    const speed = 0.001;

                    audio.currentTime = 0;
                    audio.play();

                    function step() {
                        currentHeight += speed;
                        water.style.height = currentHeight * 100 + "%";

                        if (currentHeight >= targetHeight) {
                            currentHeight = targetHeight;

                            document.getElementById("lvl" + index).classList.add("active");

                            const ind = document.getElementById("ind" + index);
                            ind.classList.add("active");
                            ind.querySelector(".dot").classList.add("blink");

                            const pop = document.getElementById("pop" + index);
                            pop.classList.add("active");

                            audio.pause();

                            return;
                        }

                        requestAnimationFrame(step);
                    }

                    step();
                }

                // demo
                setInterval(() => {
                    if (currentIndex < levels.length) {
                        animateTo(levels[currentIndex].height, currentIndex);
                        currentIndex++;
                    }
                }, 3000);

                // ðŸ”“ unlock audio
                document.body.addEventListener(
                    "click",
                    () => {
                        audio.play();
                    },
                    { once: true }
                );
</script>



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