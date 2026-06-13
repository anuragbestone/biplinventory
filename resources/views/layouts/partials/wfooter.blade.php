            <div class="footer-inventory">@ {{ date("Y") }} Bestone Inventory Systems. All Rights Reserved.</div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.ripples/0.5.3/jquery.ripples.min.js"></script>
        <script src="https://cdn.fusioncharts.com/fusioncharts/latest/fusioncharts.js"></script>
        <script src="https://cdn.fusioncharts.com/fusioncharts/latest/themes/fusioncharts.theme.fusion.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        
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
                    html: @json(session('error')),
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

            document.addEventListener("keydown", function(e) {
                // CHECK ENTER KEY
                if(e.key === "Enter") {
                    // CURRENT ELEMENT
                    let element = document.activeElement;

                    // ALLOW TEXTAREA ENTER
                    if(element.tagName === "TEXTAREA") {
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
                        } else {
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

    </body>    
</html>