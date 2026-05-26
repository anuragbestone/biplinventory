<script>
    $(document).ready(function () {
        $(".water-white-bg").ripples({
            resolution: 512,
            dropRadius: 18,
            perturbance: 0.03,
            interactive: true,

            /* reflection effect */
            crossOrigin: "",
        });

        /* Water color overlay */
        $(".water-white-bg").append('<div class="water-color-overlay"></div>');
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).mousemove(function (e) {
        $(".mouse-glow").css({
            left: e.pageX + "px",
            top: e.pageY + "px",
        });
    });
</script>

@if (session('success'))
<script>
    Swal.fire({
        text: @json(session('success')),
        icon: "success"
    });
</script>
@endif

@if (session('error'))
<script>
    Swal.fire({
        text: @json(session('error')),
        icon: "error"
    });
</script>
@endif

<script>
    document.addEventListener("submit", function (e) {
        const form = e.target;
        // Only target forms having this class
        if (!form.classList.contains("generalformloader")) {
            return;
        }

        // Skip loader condition
        if (form.dataset.skipLoader === "true") {
            return;
        }

        const loader = document.getElementById("pageLoader");
        if (loader) {
            // Show loader
            loader.style.display = "flex";
            // Freeze screen scroll
            document.body.style.overflow = "hidden";
            // Prevent clicking entire screen
            document.body.style.pointerEvents = "none";
            // Allow loader interaction
            loader.style.pointerEvents = "all";
        }
    });

    document.addEventListener("keydown", function(e)
        {
            // CHECK ENTER KEY
            if(e.key === "Enter")
            {
                // CURRENT ELEMENT
                let element = document.activeElement;
                // ALLOW TEXTAREA ENTER
                if(element.tagName === "TEXTAREA")
                {
                    return;
                }
                // PREVENT FORM SUBMIT
                e.preventDefault();
                // GET ALL FOCUSABLE ELEMENTS
                let focusable = Array.from(
                    document.querySelectorAll(
                        'input:not([disabled]), select:not([disabled]), textarea:not([disabled]), button:not([disabled])'
                    )
                ).filter(el => el.offsetParent !== null);
                // CURRENT INDEX
                let index = focusable.indexOf(element);
                // NEXT ELEMENT
                let nextElement = focusable[index + 1];
                // MOVE FOCUS
                if(nextElement)
                {
                    nextElement.focus();
                }
            }
        });
</script>

<div class="footer-inventory">© 2026 Bestone Inventory Systems. All Rights Reserved.</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.ripples/0.5.3/jquery.ripples.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

<!-- DataTables Bootstrap 5 -->
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>

<script>
    function hitApiToGetNotifications() {
        $.ajax({
            url: "{{ url('/getNotificationUpdates') }}",
            type: "GET",
            success: function(response) {
                console.log(response);
                if(response.status == "success") {
                    let notificationData = response.notificationData;
                    let html = '';
                    // Notification Count
                    $("#notificationCount").text(notificationData.length);
                    // No Data
                    if(notificationData.length == 0) {
                        html = `
                            <div class="p-3 text-center">
                                No Notifications Found
                            </div>
                        `;
                    } else {
                        $.each(notificationData, function(index, item){
                            // Convert Date
                            let createdDate = new Date(item.created_at);
                            let formattedDate = createdDate.toLocaleDateString('en-IN', {
                                day: '2-digit',
                                month: 'short'
                            });
                            let formattedTime = createdDate.toLocaleTimeString('en-IN', {
                                hour: '2-digit',
                                minute: '2-digit'
                            });
                            // CHECK UNREAD
                            let unreadClass = item.is_clicked == 0 ? 'unread' : '';
                            html += `
                                <a 
                                    href="/${item.route_address}?id=${item.id}"
                                    class="text-decoration-none text-dark"
                                >
                                    <div class="notification-item ${unreadClass}">
                                        <div class="d-flex justify-content-between">
                                            <h6>
                                                ${item.notification_title}
                                            </h6>
                                            <span class="notif-date">
                                                ${formattedDate}
                                            </span>
                                        </div>
                                        <div class="notif-message">
                                            ${item.notification_msg.replace(/\n/g, "<br>")}
                                        </div>
                                        <div class="notif-footer">
                                            <span class="status-dot"></span>
                                            <small>
                                                ${formattedTime}
                                            </small>
                                        </div>
                                    </div>
                                </a>
                            `;
                        });
                    }

                    // Append Notifications
                    $(".notification-list").html(html);

                    // CHECK ANY NEW NOTIFICATION
                    let hasNewNotification = notificationData.some(item => item.is_clicked == 0);
                    if(hasNewNotification) {
                        $("#notificationToast").html(`
                            <div class="fw-bold">
                                New Notifications
                            </div>
                            <small>
                                New notifications have arrived.
                            </small>
                        `);
                        // Bell Ring
                        $("#notificationBell").addClass("bell-ring");
                        setTimeout(function(){
                            $("#notificationBell").removeClass("bell-ring");
                        }, 2000);
                        // Show Toast
                        $("#notificationToast").fadeIn(300);
                        setTimeout(function(){
                            $("#notificationToast").fadeOut(300);
                        }, 4000);
                    }
                }
                else
                {
                    $(".notification-list").html(`
                        <div class="p-3 text-center">
                            No Notifications Found
                        </div>
                    `);
                }

            },

            error: function(error) {
                console.log(error);
            }
        });

    }



    $(document).ready(function(){
        const bell = $("#notificationBell");
        const dropdown = $("#notificationDropdown");
        // First Call
        hitApiToGetNotifications();
        // Every 15 Seconds
        setInterval(function () {
            hitApiToGetNotifications();
        }, 15000);
        // Bell Animation
        bell.addClass("bell-ring");
        setTimeout(function(){
            bell.removeClass("bell-ring");
        }, 2000);

        // Toggle Dropdown
        bell.click(function(e){
            e.stopPropagation();
            dropdown.fadeToggle(200);
        });


        // Close Dropdown
        $(document).click(function(e){
            if(
                !$(e.target).closest("#notificationWrapper").length
            ){
                dropdown.fadeOut(200);
            }
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

</body>
</html>