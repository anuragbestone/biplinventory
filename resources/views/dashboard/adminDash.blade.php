@extends("layouts.app") @section("mainContent")

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
                    <div class="time-text">12:25 PM</div>
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
                            <span>Alert</span>
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
                            <div class="sub-text">Total 11550 Case</div>
                        </div>
                    </div>

                    <table class="table table-borderless table-custom">
                        <tr>
                            <td>2 Ltr. (Blue)</td>
                            <td class="qty">550 Cases</td>
                        </tr>
                        <tr>
                            <td>1 Ltr. (Blue)</td>
                            <td class="qty">2750 Cases</td>
                        </tr>
                        <tr>
                            <td>500ml (Blue)</td>
                            <td class="qty">1750 Cases</td>
                        </tr>
                        <tr>
                            <td>200ml (Blue)</td>
                            <td class="qty">1500 Cases</td>
                        </tr>
                        <tr>
                            <td>200ml (Pink)</td>
                            <td class="qty">5000 Cases</td>
                        </tr>
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
                            <div class="sub-text">Total 1900 Case</div>
                        </div>
                    </div>

                    <table class="table table-borderless table-custom">
                        <tr>
                            <td>2 Ltr. (Blue)</td>
                            <td class="qty">100 Cases</td>
                        </tr>
                        <tr>
                            <td>1 Ltr. (Blue)</td>
                            <td class="qty">550 Cases</td>
                        </tr>
                        <tr>
                            <td>500ml (Blue)</td>
                            <td class="qty">100 Cases</td>
                        </tr>
                        <tr>
                            <td>200ml (Blue)</td>
                            <td class="qty">350 Cases</td>
                        </tr>
                        <tr>
                            <td>200ml (Pink)</td>
                            <td class="qty">800 Cases</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="production-stats-main mt-4">
        <div class="production-card">
            <div class="d-flex align-items-center justify-content-between flex-wrap pb-5">
                <!-- Left spacer -->
                <div class="header-spacer"></div>

                <div class="production-header">
                    <h2>Dispatch Stats</h2>
                    <p>Last 7 Days Dispatch</p>
                </div>
                <!-- Right Button -->
                <div>
                    <button class="btn btn-primary btn-sm">
                        <i class="fa-solid fa-filter"></i> Filter
                    </button>
                </div>
            </div>

            <div class="production-chart">
                <!-- Y Axis -->
                <div class="y-axis">
                    <span>8k</span>
                    <span>6k</span>
                    <span>4k</span>
                    <span>2k</span>
                    <span>0</span>
                </div>

                <!-- Graph Area -->
                <div class="graph-area">
                    <!-- Day 1 -->
                    <div class="day-group">
                        <div class="bars">
                            <div class="bar bar1" style="height: 75%">
                                <small>1.1L</small>
                            </div>
                            <div class="bar bar2" style="height: 85%">
                                <small>2L</small>
                            </div>
                            <div class="bar bar3" style="height: 95%">
                                <small>300ml</small>
                            </div>
                            <div class="bar bar4" style="height: 65%">
                                <small>500ml</small>
                            </div>
                            <div class="bar bar5 pink" style="height: 85%">
                                <small>200ml</small>
                            </div>
                        </div>
                        <h4>Day 1</h4>
                    </div>

                    <!-- Day 2 -->
                    <div class="day-group">
                        <div class="bars">
                            <div class="bar bar1" style="height: 60%"><small>1L</small></div>
                            <div class="bar bar2" style="height: 75%"><small>1.1L</small></div>
                            <div class="bar bar3" style="height: 40%"><small>2L</small></div>
                            <div class="bar bar4" style="height: 55%"><small>500ml</small></div>
                            <div class="bar bar5 pink" style="height: 65%"><small>200ml</small></div>
                        </div>
                        <h4>Day 2</h4>
                    </div>

                    <!-- Day 3 -->
                    <div class="day-group">
                        <div class="bars">
                            <div class="bar bar1" style="height: 35%"><small>1L</small></div>
                            <div class="bar bar2" style="height: 45%"><small>300ml</small></div>
                            <div class="bar bar3" style="height: 20%"><small>1L</small></div>
                            <div class="bar bar4" style="height: 30%"><small>500ml</small></div>
                            <div class="bar bar5 pink" style="height: 40%"><small>200ml</small></div>
                        </div>
                        <h4>Day 3</h4>
                    </div>

                    <!-- Day 4 -->
                    <div class="day-group">
                        <div class="bars">
                            <div class="bar bar1" style="height: 55%"><small>1L</small></div>
                            <div class="bar bar2" style="height: 70%"><small>200ml</small></div>
                            <div class="bar bar3" style="height: 30%"><small>2L</small></div>
                            <div class="bar bar4" style="height: 40%"><small>500ml</small></div>
                            <div class="bar bar5 pink" style="height: 50%"><small>200ml</small></div>
                        </div>
                        <h4>Day 4</h4>
                    </div>

                    <!-- Day 5 -->
                    <div class="day-group">
                        <div class="bars">
                            <div class="bar bar1" style="height: 85%"><small>200ml</small></div>
                            <div class="bar bar2" style="height: 75%"><small>1L</small></div>
                            <div class="bar bar3" style="height: 35%"><small>2L</small></div>
                            <div class="bar bar4" style="height: 55%"><small>500ml</small></div>
                            <div class="bar bar5 pink" style="height: 65%"><small>200ml</small></div>
                        </div>
                        <h4>Day 5</h4>
                    </div>

                    <!-- Day 6 -->
                    <div class="day-group">
                        <div class="bars">
                            <div class="bar bar1" style="height: 75%"><small>1.1L</small></div>
                            <div class="bar bar2" style="height: 95%"><small>300ml</small></div>
                            <div class="bar bar3" style="height: 30%"><small>2L</small></div>
                            <div class="bar bar4" style="height: 55%"><small>500ml</small></div>
                            <div class="bar bar5 pink" style="height: 85%"><small>200ml</small></div>
                        </div>
                        <h4>Day 6</h4>
                    </div>

                    <!-- Day 7 -->
                    <div class="day-group">
                        <div class="bars">
                            <div class="bar bar1" style="height: 50%"><small>1L</small></div>
                            <div class="bar bar2" style="height: 65%"><small>200ml</small></div>
                            <div class="bar bar3" style="height: 25%"><small>2L</small></div>
                            <div class="bar bar4" style="height: 50%"><small>500ml</small></div>
                            <div class="bar bar5 pink" style="height: 65%"><small>200ml</small></div>
                        </div>
                        <h4>Day 7</h4>
                    </div>
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
                            <button class="btn btn-primary btn-sm">Details</button>
                        </div>
                    </div>
                    <div class="row text-center justify-content-center rm-row">
                        <!-- Item 1 -->
                        <div class="col-md-4 custom-col">
                            <div class="hex-box">
                                <div class="hex">
                                    <img src="{{ asset("assets") }}/images/preforms.png" alt="Preform" />
                                </div>
                            </div>
                            <a href="#">
                                <div class="hex-btn">Preform</div>
                            </a>
                        </div>

                        <!-- Item 2 -->
                        <div class="col-md-4 custom-col">
                            <div class="hex-box">
                                <div class="hex">
                                    <img src="{{ asset("assets") }}/images/cap.png" alt="Cap" />
                                </div>
                            </div>
                            <a href="#">
                                <div class="hex-btn">Cap</div>
                            </a>
                        </div>

                        <!-- Item 3 -->
                        <div class="col-md-4 custom-col">
                            <div class="hex-box">
                                <div class="hex">
                                    <img src="{{ asset("assets") }}/images/label.png" alt="Label" />
                                </div>
                            </div>
                            <a href="#">
                                <div class="hex-btn">Label</div>
                            </a>
                        </div>

                        <!-- Item 4 -->
                        <div class="col-md-4 custom-col">
                            <div class="hex-box">
                                <div class="hex">
                                    <img src="{{ asset("assets") }}/images/sticker.png" alt="Sticker" />
                                </div>
                            </div>
                            <a href="#">
                                <div class="hex-btn">Sticker</div>
                            </a>
                        </div>

                        <!-- Item 5 -->
                        <div class="col-md-4 custom-col">
                            <a href="#">
                                <div class="hex-box">
                                    <div class="hex">
                                        <img src="{{ asset("assets") }}/images/ld.png" alt="LD" />
                                    </div>

                                    <div class="hex-btn">LD</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="rejection-main h-100 mb-4">
                    <div class="row rejection-row align-items-center">
                        <div class="rejection-title text-center">Total Rejection</div>
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

    <div class="production-stats-main mt-4">
        <div class="production-card">
            <div class="d-flex align-items-center justify-content-between flex-wrap pb-5">
                <!-- Left spacer -->
                <div class="header-spacer"></div>

                <div class="production-header">
                    <h2>Production Stats</h2>
                    <p>Last 7 Days Production</p>
                </div>
                <!-- Right Button -->
                <div>
                    <button class="btn btn-primary btn-sm">
                        <i class="fa-solid fa-filter"></i> Filter
                    </button>
                </div>
            </div>
            <div class="production-chart">
                <!-- Y Axis -->
                <div class="y-axis">
                    <span>8k</span>
                    <span>6k</span>
                    <span>4k</span>
                    <span>2k</span>
                    <span>0</span>
                </div>

                <!-- Graph Area -->
                <div class="graph-area">
                    <!-- Day 1 -->
                    <div class="day-group">
                        <div class="bars">
                            <div class="bar bar1" style="height: 75%">
                                <small>1.1L</small>
                            </div>
                            <div class="bar bar2" style="height: 85%">
                                <small>2L</small>
                            </div>
                            <div class="bar bar3" style="height: 95%">
                                <small>300ml</small>
                            </div>
                            <div class="bar bar4" style="height: 65%">
                                <small>500ml</small>
                            </div>
                            <div class="bar bar5 pink" style="height: 85%">
                                <small>200ml</small>
                            </div>
                        </div>
                        <h4>Day 1</h4>
                    </div>

                    <!-- Day 2 -->
                    <div class="day-group">
                        <div class="bars">
                            <div class="bar bar1" style="height: 60%"><small>1L</small></div>
                            <div class="bar bar2" style="height: 75%"><small>1.1L</small></div>
                            <div class="bar bar3" style="height: 40%"><small>2L</small></div>
                            <div class="bar bar4" style="height: 55%"><small>500ml</small></div>
                            <div class="bar bar5 pink" style="height: 65%"><small>200ml</small></div>
                        </div>
                        <h4>Day 2</h4>
                    </div>

                    <!-- Day 3 -->
                    <div class="day-group">
                        <div class="bars">
                            <div class="bar bar1" style="height: 35%"><small>1L</small></div>
                            <div class="bar bar2" style="height: 45%"><small>300ml</small></div>
                            <div class="bar bar3" style="height: 20%"><small>1L</small></div>
                            <div class="bar bar4" style="height: 30%"><small>500ml</small></div>
                            <div class="bar bar5 pink" style="height: 40%"><small>200ml</small></div>
                        </div>
                        <h4>Day 3</h4>
                    </div>

                    <!-- Day 4 -->
                    <div class="day-group">
                        <div class="bars">
                            <div class="bar bar1" style="height: 55%"><small>1L</small></div>
                            <div class="bar bar2" style="height: 70%"><small>200ml</small></div>
                            <div class="bar bar3" style="height: 30%"><small>2L</small></div>
                            <div class="bar bar4" style="height: 40%"><small>500ml</small></div>
                            <div class="bar bar5 pink" style="height: 50%"><small>200ml</small></div>
                        </div>
                        <h4>Day 4</h4>
                    </div>

                    <!-- Day 5 -->
                    <div class="day-group">
                        <div class="bars">
                            <div class="bar bar1" style="height: 85%"><small>200ml</small></div>
                            <div class="bar bar2" style="height: 75%"><small>1L</small></div>
                            <div class="bar bar3" style="height: 35%"><small>2L</small></div>
                            <div class="bar bar4" style="height: 55%"><small>500ml</small></div>
                            <div class="bar bar5 pink" style="height: 65%"><small>200ml</small></div>
                        </div>
                        <h4>Day 5</h4>
                    </div>

                    <!-- Day 6 -->
                    <div class="day-group">
                        <div class="bars">
                            <div class="bar bar1" style="height: 75%"><small>1.1L</small></div>
                            <div class="bar bar2" style="height: 95%"><small>300ml</small></div>
                            <div class="bar bar3" style="height: 30%"><small>2L</small></div>
                            <div class="bar bar4" style="height: 55%"><small>500ml</small></div>
                            <div class="bar bar5 pink" style="height: 85%"><small>200ml</small></div>
                        </div>
                        <h4>Day 6</h4>
                    </div>

                    <!-- Day 7 -->
                    <div class="day-group">
                        <div class="bars">
                            <div class="bar bar1" style="height: 50%"><small>1L</small></div>
                            <div class="bar bar2" style="height: 65%"><small>200ml</small></div>
                            <div class="bar bar3" style="height: 25%"><small>2L</small></div>
                            <div class="bar bar4" style="height: 50%"><small>500ml</small></div>
                            <div class="bar bar5 pink" style="height: 65%"><small>200ml</small></div>
                        </div>
                        <h4>Day 7</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
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