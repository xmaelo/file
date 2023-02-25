<header class="navbar navbar-expand-lg navbar-light fixed-top" data-scroll-header>
    <div class="container">
        <a class="navbar-brand me-3 me-xl-4" href="index.php">
            <img class="d-block" src="images/logo.jpg" width="116" alt="logo">
        </a>
        <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="dropdown ms-n3 me-3 d-none d-lg-block order-lg-3">
            <button class="btn btn-link btn-sm dropdown-toggle fw-normal py-2" type="button" data-bs-toggle="dropdown">
                <i class="fi-globe me-2"></i>English
            </button>
            <div class="dropdown-menu w-100">
                <a class="dropdown-item" href="#">English</a>
                <a class="dropdown-item" href="#">Deutsch</a>
                <a class="dropdown-item" href="#">Français</a>
                <a class="dropdown-item" href="#">Español</a>
            </div>
        </div>

        <!-- If logged in -->
        <!--<div class="dropdown d-none d-lg-block order-lg-3 my-n2 me-3">
            <a class="d-block py-2" href="profile.php">
                <img class="rounded-circle" src="images/avatar.png" width="40" alt="avatar">
            </a>
            <div class="dropdown-menu dropdown-menu-end">
                <div class="d-flex align-items-start border-bottom border-light px-3 py-1 mb-2" style="width: 16rem;">
                    <img class="rounded-circle" src="images/avatar.png" width="48" alt="avatar">
                    <div class="ps-2">
                        <h6 class="fs-base text-dark mb-0">Test Corporation</h6>
                        <div class="fs-xs py-2">000 000 000<br>testcorporation@test.com</div>
                    </div>
                </div>
                <a class="dropdown-item" href="profile.php">
                    <i class="fi-user me-2"></i>Profile
                </a>
                <a class="dropdown-item" href="invoices.php">
                    <i class="fi-file me-2"></i>Invoices
                    <span class="badge bg-faded-light ms-2">0</span>
                </a>
                <a class="dropdown-item" href="current-vehicles.php">
                    <i class="fi-car me-2"></i>Current vehicles
                    <span class="badge bg-faded-light ms-2">0</span>
                </a>
                <a class="dropdown-item" href="sold-vehicles.php">
                    <i class="fi-cash me-2"></i>Sold vehicles
                    <span class="badge bg-faded-light ms-2">0</span>
                </a>
                <a class="dropdown-item" href="purchased-vehicles.php">
                    <i class="fi-cart me-2"></i>Purchased vehicles
                    <span class="badge bg-faded-light ms-2">0</span>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Logout</a>
            </div>
        </div>-->
        <!-- End if logged in -->

        <!-- If not logged in -->
        <a class="btn btn-link btn-sm d-none d-lg-block order-lg-3" href="#signup-modal" data-bs-toggle="modal"><i class="fi-user-plus me-2"></i>Register</a>
        <a class="btn btn-accent bg-gradient border-0 btn-sm ms-2 order-lg-3" href="#signin-modal" data-bs-toggle="modal"><i class="fi-user me-2"></i>Login</a>
        <!-- End if not logged in -->

        <div class="collapse navbar-collapse order-lg-2" id="navbarNav">
            <ul class="navbar-nav navbar-nav-scroll" style="max-height: 35rem;">
                <li class="nav-item <?php echo $id == 'index' ? 'active' : '' ?>">
                    <a class="nav-link" href="index.php">
                        <span class="nav-link-title">Auction</span>
                        <span class="nav-link-subtitle">Current auction</span>
                    </a>
                </li>
                <li class="nav-item dropdown <?php echo $id == 'how-it-works' ? 'active' : '' ?>">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="nav-link-title">How It Works</span>
                        <span class="nav-link-subtitle">Instructions, prices, GTC, DPR</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="instructions.php">Instructions</a></li>
                        <li><a class="dropdown-item" href="prices.php">Prices</a></li>
                        <li><a class="dropdown-item" href="terms-and-conditions.php">Terms and conditions</a></li>
                        <li><a class="dropdown-item" href="privacy-policy.php">Privacy policy</a></li>
                    </ul>
                </li>

                <!-- If not logged in -->
                <li class="nav-item">
                    <a class="nav-link" href="#signup-modal" data-bs-toggle="modal">
                        <span class="nav-link-title">Registration</span>
                        <span class="nav-link-subtitle">Join to bid and sell</span>
                    </a>
                </li>
                <li class="nav-item dropdown <?php echo $id == 'car-auction' ? 'active' : '' ?>">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="nav-link-title">FastAuktion</span>
                        <span class="nav-link-subtitle">All about FastAuktion</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="about-us.php">About us</a></li>
                        <li><a class="dropdown-item" href="jobs.php">Jobs</a></li>
                        <li><a class="dropdown-item" href="imprint.php">Imprint</a></li>
                    </ul>
                </li>
                <!-- End if not logged in -->

                <!-- If logged in -->
                <!--<li class="nav-item <?php echo $id == 'sell-your-car' ? 'active' : '' ?>">
                    <a class="nav-link" href="sell-your-car.php">
                        <span class="nav-link-title">Sell Your Car</span>
                        <span class="nav-link-subtitle">Place your car in bid</span>
                    </a>
                </li>
                <li class="nav-item dropdown <?php echo $id == 'account' ? 'active' : '' ?>">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="nav-link-title">Account</span>
                        <span class="nav-link-subtitle">Settings, cars, invoices</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="dropdown">
                            <a class="dropdown-item dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Profile</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                                <li><a class="dropdown-item" href="invoices.php">Invoices</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-item dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Vehicles</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="current-vehicles.php">Current vehicles</a></li>
                                <li><a class="dropdown-item" href="sold-vehicles.php">Sold vehicles</a></li>
                                <li><a class="dropdown-item" href="purchased-vehicles.php">Purchased vehicles</a></li>
                            </ul>
                        </li>
                        <li><a class="dropdown-item" href="#">Logout</a></li>
                    </ul>
                </li>-->
                <!-- End if logged -->

                <li class="nav-item dropdown d-lg-none">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="nav-link-title"><i class="fi-globe me-2"></i></span>
                        <span class="nav-link-title">English</span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">English</a>
                        <a class="dropdown-item" href="#">Deutsch</a>
                        <a class="dropdown-item" href="#">Français</a>
                        <a class="dropdown-item" href="#">Español</a>
                    </div>
                </li>

                <!-- If logged in -->
                <!--<li class="nav-item dropdown d-lg-none">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img class="rounded-circle me-2" src="images/avatar.png" width="30" alt="avatar">
                        <div class="nav-link-title">Test Corporation</div>
                    </a>
                    <div class="dropdown-menu">
                        <div class="ps-3">
                            <div class="fs-xs py-2">000 000 000<br>testcorporation@test.com</div>
                        </div>
                        <a class="dropdown-item" href="profile.php">
                            <i class="fi-user me-2"></i>Profile
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fi-file me-2"></i>Invoices
                            <span class="badge bg-faded-light ms-2">0</span>
                        </a>
                        <a class="dropdown-item" href="current-vehicles.php">
                            <i class="fi-car me-2"></i>Current vehicles
                            <span class="badge bg-faded-light ms-2">0</span>
                        </a>
                        <a class="dropdown-item" href="sold-vehicles.php">
                            <i class="fi-cash me-2"></i>Sold vehicles
                            <span class="badge bg-faded-light ms-2">0</span>
                        </a>
                        <a class="dropdown-item" href="purchased-vehicles.php">
                            <i class="fi-cart me-2"></i>Purchased vehicles
                            <span class="badge bg-faded-light ms-2">0</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Logout</a>
                    </div>
                </li>-->
                <!-- End if logged in -->

                <!-- If not logged in -->
                <li class="nav-item d-lg-none">
                    <a class="nav-link d-flex align-items-center" href="#signin-modal" data-bs-toggle="modal">
                        <span class="nav-link-title"><i class="fi-user me-2"></i></span>
                        <span class="nav-link-title">Login</span>
                    </a>
                </li>
                <li class="nav-item d-lg-none">
                    <a class="nav-link d-flex align-items-center" href="#signup-modal" data-bs-toggle="modal">
                        <span class="nav-link-title"><i class="fi-user-plus me-2"></i></span>
                        <span class="nav-link-title">Register</span>
                    </a>
                </li>
                <!-- End if not logged in -->
            </ul>
        </div>
    </div>
</header>
