@extends("layouts.app")
@section("mainContent")

<div class="main-card content shadow-sm">
    <div class="dashboard">

        <div class="top-section">

            <div class="heading">
                <h1>Sales Dashboard</h1>
                <p>Track your sales performance and achieve your targets</p>
            </div>

            <div class="cards">

                <div class="card">
                    <div class="icon blue">🎯</div>
                    <h4>This Month Target</h4>
                    <h2>{{ $targetData[0]["target_quantity"] }}</h2>
                    <span>Cases</span>
                </div>

                <div class="card">
                    <div class="icon green">✅</div>
                    <h4>Total Achieved</h4>
                    <h2>{{ $targetData[0]["achieved_target_quantity"] }}</h2>
                    <span>Cases</span>
                </div>

                <div class="card">
                    <div class="icon orange">📈</div>
                    <h4>Remaining</h4>
                    <h2>{{ $targetData[0]["target_quantity"] - $targetData[0]["achieved_target_quantity"] }}</h2>
                    <span>Cases</span>
                </div>

                <div class="card">
                    <div class="icon purple">🏆</div>
                    <h4>Achievement</h4>
                    <h2>{{ round(($targetData[0]["achieved_target_quantity"]/$targetData[0]["target_quantity"])*100 , 2) }}%</h2>
                    <span>Of Target</span>
                </div>

            </div>

        </div>


        @php
            $target = $targetData[0]['target_quantity'] ?? 0;
            $achieved = $targetData[0]['achieved_target_quantity'] ?? 0;
        @endphp

        <div class="progress-section" id="progress-report">

            <div class="section-title">Monthly Target Progress</div>

            <div class="progress-wrapper">

                <div class="circle-progress" id="circleProgress">
                    <div class="circle-inner">
                        <h2 id="progressPercent">0%</h2>
                        <p id="achievedText">0 Achieved</p>
                    </div>
                </div>

                <div class="line-progress">

                    <div class="line-track">
                        <div class="floating-achievement" id="floatingCard">
                            <h3 id="floatingNumber">0</h3>
                            <p>Achieved</p>
                        </div>

                        <div class="line-fill" id="lineFill"></div>
                    </div>

                    <div class="milestones">

                        <div class="milestone-card">
                            <h3>0</h3>
                            <p>Cases</p>
                        </div>

                        <div class="milestone-card">
                            <h3>{{ number_format($target * 0.25) }}</h3>
                            <p>Cases</p>
                        </div>

                        <div class="milestone-card">
                            <h3>{{ number_format($target * 0.50) }}</h3>
                            <p>Cases</p>
                        </div>

                        <div class="milestone-card">
                            <h3>{{ number_format($target * 0.75) }}</h3>
                            <p>Cases</p>
                        </div>
                        
                        <div class="milestone-card">
                            <h3>{{ number_format($target) }}</h3>
                            <p>Cases</p>
                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="table-section" id="sales-report">

            <div class="section-title">Sales by SKU</div>

            <table>

                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>SKU</th>
                        <th>Total Sale</th>
                        <th>Achievement</th>

                    </tr>
                </thead>

                <tbody>

                    <tr>
                        <td>1</td>
                        <td>2 L</td>
                        <td>500 Cases</td>
                        <td>1.79%</td>

                    </tr>

                    <tr>
                        <td>2</td>
                        <td>1 L</td>
                        <td>800 Cases</td>
                        <td>2.86%</td>

                    </tr>

                    <tr>
                        <td>3</td>
                        <td>200 ml</td>
                        <td>200 Cases</td>
                        <td>0.71%</td>

                    </tr>

                    <tr>
                        <td>4</td>
                        <td>200 ml (P)</td>
                        <td>1500 Cases</td>
                        <td>5.36%</td>

                    </tr>

                    <tr>
                        <td>5</td>
                        <td>500 ml</td>
                        <td>700 Cases</td>
                        <td>2.50%</td>

                    </tr>

                </tbody>

            </table>

            

        </div>


        <div class="sales-generate-order-main" id="generate-order-report">
          <div class="card bg-white">
            dvffd
          </div>
        </div>

    </div>

</div>

<script>

const target = {{ $target }};
const achieved = {{ $achieved }};

const percentage = target > 0
    ? (achieved / target) * 100
    : 0;

const circle = document.getElementById('circleProgress');
const progressText = document.getElementById('progressPercent');
const achievedText = document.getElementById('achievedText');
const lineFill = document.getElementById('lineFill');
const floatingCard = document.getElementById('floatingCard');
const floatingNumber = document.getElementById('floatingNumber');

const milestoneCards = document.querySelectorAll('.milestone-card');

const milestoneValues = [
    0,
    target * 0.25,
    target * 0.50,
    target * 0.75,
    target
];

milestoneCards.forEach((card, index) => {

    if(index !== 0){
        card.style.opacity = '0';
        card.style.transform = 'translateY(40px)';
        card.style.transition = '0.5s ease';
    }

});

let current = 0;

const counter = setInterval(() => {

    current += 0.1;

    if(current >= percentage){
        current = percentage;
        clearInterval(counter);
    }

    const safeCurrent = Number(current.toFixed(1));

    circle.style.background =
        `conic-gradient(#2f67ff ${safeCurrent * 3.6}deg,#edf2ff 0deg)`;

    progressText.innerHTML = `${safeCurrent}%`;

    let currentAchieved;

    if(current >= percentage){

        // Final value should exactly match database value
        currentAchieved = achieved;

    } else {

        currentAchieved = Math.round(
            (current / percentage) * achieved
        );

    }

    achievedText.innerHTML =
        `${currentAchieved.toLocaleString()} Achieved`;

    floatingNumber.innerHTML =
        currentAchieved.toLocaleString();

    lineFill.style.width = `${safeCurrent}%`;

    floatingCard.style.left = `${safeCurrent}%`;

    milestoneValues.forEach((value, index) => {

        if(currentAchieved >= value){

            milestoneCards[index].style.opacity = '1';
            milestoneCards[index].style.transform =
                'translateY(0px)';

        }

    });

}, 25);

</script>

@endsection