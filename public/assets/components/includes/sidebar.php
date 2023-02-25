<aside class="col-lg-4 col-md-5 pe-xl-4 mb-5 mb-md-0">
    <div class="card card-body border-0 shadow-sm pb-1 me-lg-1">
        <div class="d-flex d-md-block d-lg-flex align-items-start pt-lg-2 mb-4">
            <img class="rounded-circle" src="images/avatar.png" width="48" alt="avatar">
            <div class="pt-md-2 pt-lg-0 ps-3 ps-md-0 ps-lg-3">
                <h2 class="fs-lg mb-0">Test Corporation</h2>
                <ul class="list-unstyled fs-sm mt-3 mb-0">
                    <li><a class="nav-link fw-normal p-0" href="tel:000000000"><i class="fi-phone opacity-60 me-2"></i>000 000 000</a></li>
                    <li><a class="nav-link fw-normal p-0" href="mailto:testcorporation@test.com"><i class="fi-mail opacity-60 me-2"></i>testcorporation@test.com</a></li>
                </ul>
            </div>
        </div>
        <a class="btn btn-accent bg-gradient border-0 btn-lg w-100 mb-3" href="sell-your-car.php"><i class="fi-plus me-2"></i>Sell your car</a>
        <a class="btn btn-outline-dark d-block d-md-none w-100 mb-3" href="#account-nav" data-bs-toggle="collapse">
            <i class="fi-align-justify me-2"></i>Menu
        </a>
        <div class="collapse d-md-block mt-3" id="account-nav">
            <div class="card-nav">
                <a class="card-nav-link <?php echo $subId == 'profile' ? 'active' : '' ?>" href="profile.php">
                    <i class="fi-user me-2"></i>Profile
                </a>
                <a class="card-nav-link <?php echo $subId == 'invoices' ? 'active' : '' ?>" href="invoices.php">
                    <i class="fi-file me-2"></i>Invoices
                    <span class="badge bg-secondary ms-2">0</span>
                </a>
                <a class="card-nav-link <?php echo $subId == 'current-vehicles' ? 'active' : '' ?>" href="current-vehicles.php">
                    <i class="fi-car me-2"></i>Current vehicles
                    <span class="badge bg-secondary ms-2">0</span>
                </a>
                <a class="card-nav-link <?php echo $subId == 'sold-vehicles' ? 'active' : '' ?>" href="sold-vehicles.php">
                    <i class="fi-cash me-2"></i>Sold vehicles
                    <span class="badge bg-secondary ms-2">0</span>
                </a>
                <a class="card-nav-link <?php echo $subId == 'purchased-vehicles' ? 'active' : '' ?>" href="purchased-vehicles.php">
                    <i class="fi-cart me-2"></i>Purchased vehicles
                    <span class="badge bg-secondary ms-2">0</span>
                </a>
                <a class="card-nav-link" href="#">
                    <i class="fi-logout me-2"></i>Logout
                </a>
            </div>
        </div>
    </div>
</aside>
