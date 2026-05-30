<div class="header-wrapper d-flex justify-content-between align-items-center">
                <!-- LOGO -->
                <div class="logo">
                    <a href="{{ url("dashboard") }}"><img src="{{ asset("assets") }}/images/logo.png.webp" /></a>
                </div>

                <!-- TOGGLE BUTTON (Mobile Only) -->
                <button
                    class="navbar-toggler d-lg-none"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#mobileMenu"
                >
                    <i class="bi bi-list"></i>
                </button>

                <!-- COLLAPSE START -->
                <div
                    class="collapse d-lg-flex headermob align-items-center justify-content-between w-100"
                    id="mobileMenu"
                >
                    <!-- MENU -->
                    <div class="menu-pill shadow-sm">
                        
                        <div class="menu-item">
                           <li><a class="dropdown-item" href="#sales-report"><i class="bi bi-building"></i> Sales By SKU</a></li> 
                        </div>
                        <div class="menu-item active">
                            <a href="{{ url('dashboard') }}"><i class="bi bi-house"></i></a>
                        </div>
                        <div class="menu-item">
                             <li><a class="dropdown-item" href="#generate-order-report"><i class="bi bi-cart-check"></i> Generate Orders</a></li>
                        </div>

                        

                        
                    </div>

                    <!-- RIGHT ICONS -->
                    <div class="d-flex align-items-center">
                        <!-- Notification -->
                        <div class="icon-btn position-relative">
                            <i class="bi bi-bell"></i>
                            <span
                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                                style="font-size: 10px"
                            >
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
                                    <a class="dropdown-item d-flex align-items-center gap-2" href="{{ url("sales/profile") }}">
                                        <i class="bi bi-person-circle"></i> Profile
                                    </a>
                                </li>

                                <li><hr class="dropdown-divider" /></li>

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