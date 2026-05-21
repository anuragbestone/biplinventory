<div class="header-wrapper d-flex justify-content-between align-items-center">
    <!-- LOGO -->
    <div class="logo">
        <img src="{{ asset("assets") }}/images/logo.png.webp" />
    </div>

    <!-- TOGGLE BUTTON (Mobile Only) -->
    <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#mobileMenu">
        <i class="bi bi-list"></i>
    </button>

    <!-- COLLAPSE START -->
    <div class="collapse d-lg-flex headermob align-items-center justify-content-between w-100" id="mobileMenu">
        <!-- MENU -->
        <div class="menu-pill shadow-sm">
            <div class="menu-item {{ request()->path() == "dashboard" ? "active" : "" }}">
                <a href="{{ url("dashboard") }}"><i class="bi bi-house"></i></a>
            </div>
            <div class="menu-item {{ request()->path() == "warehouse/rmpmentry" ? "active" : "" }}"><a class="dropdown-item" href="{{ url("warehouse/rmpmentry") }}"><i class="bi bi-file-earmark-text"></i>  RM/PM Entry</a></div>
            <div class="menu-item {{ request()->path() == "warehouse/production" ? "active" : "" }}"><a class="dropdown-item" href="{{ url("warehouse/production") }}"><i class="bi bi-file-earmark-text"></i> Production</a></div>
            <div class="menu-item {{ request()->path() == "warehouse/rejection" ? "active" : "" }}"><a class="dropdown-item" href="{{ url("warehouse/rejection") }}"><i class="bi bi-file-earmark-text"></i> Rejection</a></div>
            <!--<div class="menu-item {{ request()->path() == "warehouse/rmpmstock" ? "active" : "" }}"><a class="dropdown-item" href="{{ url("warehouse/rmpmstock") }}"><i class="bi bi-file-earmark-text"></i>  RM/PM Stock</a></div>-->
            <!--<div class="menu-item {{ request()->path() == "warehouse/fgstock" ? "active" : "" }}"><a class="dropdown-item" href="{{ url("warehouse/fgstock") }}"><i class="bi bi-file-earmark-text"></i> FG Stock</a></div>-->
            <!--<div class="menu-item {{ request()->path() == "warehouse/order" ? "active" : "" }}"><a class="dropdown-item" href="{{ url("warehouse/order") }}"><i class="bi bi-file-earmark-text"></i> Order</a></div>-->
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
                        <a class="dropdown-item d-flex align-items-center gap-2" href="{{ url("warehouse/profile") }}">
                            <i class="bi bi-person-circle"></i> Profile
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center gap-2" href="{{ url("warehouse/deleteShift") }}">
                            <i class="bi bi-person-circle"></i> Delete Shift (Dev)
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center gap-2" href="{{ url("warehouse/addOrderDev") }}">
                            <i class="bi bi-person-circle"></i> Add Order (Dev)
                        </a>
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