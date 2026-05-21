<div class="header-wrapper d-flex justify-content-between align-items-center">
    <!-- LOGO -->
    <div class="logo">
        <a href="#"><img src="{{ asset("assets") }}/images/logo.png.webp" /></a>
    </div>

    <!-- TOGGLE BUTTON (Mobile Only) -->
    <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#mobileMenu">
        <i class="bi bi-list"></i>
    </button>

    <!-- COLLAPSE START -->
    <div class="collapse d-lg-flex headermob align-items-center justify-content-between w-100" id="mobileMenu">
        <!-- MENU -->
        <div class="menu-pill shadow-sm">
            <div class="menu-item active">
                <a href="{{ url('dashboard') }}"><i class="bi bi-house"></i></a>
            </div>
            <div class="dropdown">
                <div class="menu-item dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="bi bi-building"></i> Warehouse
                </div>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ url("rejectionUpdate") }}">Rejection Update</a></li>

                    {{-- <li><a class="dropdown-item" href="{{ url("rmPmProcurementUpdate") }}">RM/PM Procurement update</a></li> --}}
                    <li><a class="dropdown-item" href="{{ url("stockReport") }}">Stock Report</a></li>
                    <li><a class="dropdown-item" href="{{ url("productionReport") }}">Production Report</a></li>
                </ul>
            </div>
            <div class="dropdown">
                <div class="menu-item dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="bi bi-briefcase"></i> Sales Report
                </div>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ url("orderNDispatch") }}">Order & Dispatch</a></li>
                </ul>
            </div>

            <!--<div class="dropdown">-->
            <!--    <div class="menu-item dropdown-toggle" data-bs-toggle="dropdown">-->
            <!--        <i class="bi bi-people"></i> Users-->
            <!--    </div>-->
            <!--    <ul class="dropdown-menu">-->
            <!--        <li><a class="dropdown-item" href="{{ url("userRole") }}">User Role</a></li>-->
            <!--        <li><a class="dropdown-item" href="{{ url("modules") }}">Modules</a></li>-->
            <!--        <li><a class="dropdown-item" href="{{ url("permissions") }}">Permission</a></li>-->
            <!--    </ul>-->
            <!--</div>-->

            <!--<div class="dropdown">-->
            <!--    <div class="menu-item dropdown-toggle" data-bs-toggle="dropdown">-->
            <!--        <i class="bi bi-gear"></i> Setting-->
            <!--    </div>-->
            <!--    <ul class="dropdown-menu">-->
            <!--        <li><a class="dropdown-item" href="{{ url("email") }}">Email</a></li>-->
            <!--        <li><a class="dropdown-item" href="{{ url("whatsAppMessaging") }}">Whatsapp Message</a></li>-->
            <!--        <li><a class="dropdown-item" href="warning.html">Warnings</a></li>-->
            <!--        <li><a class="dropdown-item" href="{{ url("productionIssue") }}">Production Issues</a></li>-->
            <!--        <li><a class="dropdown-item" href="#">Threshold</a></li>-->
            <!--        <li><a class="dropdown-item" href="{{ url("fgPmFormula") }}">Fg Pm Formula</a></li>-->
            <!--    </ul>-->
            <!--</div>-->
        </div>

        <!-- RIGHT ICONS -->
        <div class="d-flex align-items-center">
            <!-- Notification -->
            <div class="icon-btn position-relative">
                <i class="bi bi-bell"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 10px">
                                3
                            </span>
            </div>

            <!-- Profile Dropdown -->
            <div class="dropdown">
                <div class="icon-btn dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="bi bi-person"></i>
                </div>

                <ul class="dropdown-menu dropdown-menu-end mt-2">
                    <li>
                        <a class="dropdown-item d-flex align-items-center gap-2" href="{{ url("admin/profile") }}">
                            <i class="bi bi-person-circle"></i> Profile
                        </a>
                    </li>

                    <li>
                        <hr class="dropdown-divider" />
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center gap-2 text-danger" href="{{ url("logout") }}">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- COLLAPSE END -->
</div>