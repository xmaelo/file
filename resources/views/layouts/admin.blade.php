<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Phyxle Infotech (Pvt) Ltd">
    <title>Admin Panel</title>
    <link rel="icon" href="/assets/images/favicon/favicon.png" type="/assets/image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap">
    <link rel="stylesheet" href="/admin-assets/libraries/@fortawesome/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="/admin-assets/libraries/halfmoon/css/halfmoon.min.css">
    <link rel="stylesheet" href="/assets/dist/css/select2.min.css">
    <link rel="stylesheet" href="/assets/dist/css/select2.css">
    <link rel="stylesheet" href="/admin-assets/tpicker/lib/tpicker.css">
    <link rel="stylesheet" href="/admin-assets/flatpickr/dist/themes/dark.css">
    <link rel="stylesheet" href="/admin-assets/css/style.css">
    <script src="/assets/js/jquery-3.6.0.min.js"></script>
    <script src="/assets/dist/js/select2.min.js"></script>
    <script src="/admin-assets/tpicker/lib/tpicker.js"></script>
    <script src="/admin-assets/tpicker/lib/tpicker.js"></script>
    <script src="/admin-assets/js/sweetaler.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery.soap@1.7.3/jquery.soap.min.js"></script>
</head>

<body class="dark-mode with-custom-css-scrollbars with-custom-webkit-scrollbars">
    <div class="page-wrapper with-navbar with-sidebar">
        <div class="navbar">
            <div class="navbar-content">
                <button id="sidebar" class="btn btn-square">
                    <i class="fa fa-bars"></i>
                </button>
            </div>
            <a href="/admin" class="navbar-brand">
                <img src="/assets/images/logo/logo.jpg" alt="logo" width="75" height="50"> Admin Panel
            </a>
            <span class="navbar-text">
                <span class="version"></span>
            </span>
        </div>
        <div class="sidebar">
            <div class="sidebar-menu">
                <h6 class="sidebar-title">Dashboard</h6>
                <div class="sidebar-divider"></div>
                <a href="/admin" class="sidebar-link sidebar-link-with-icon {{ 'admin' == request()->path() ? 'active' : '' }}">
                    <span class="sidebar-icon {{ 'admin' == request()->path() ? 'text-white bg-primary' : '' }}">
                        <i class="fa fa-home"></i>
                    </span>
                    Home
                </a>
                <a href="/admin/accounts/profile" class="sidebar-link sidebar-link-with-icon {{ 'admin/accounts/profile' == request()->path() ? 'active' : '' }}">
                    <span class="sidebar-icon {{ 'admin/accounts/profile' == request()->path() ? 'text-white bg-primary' : '' }}">
                        <i class="fa fa-user"></i>
                    </span>
                    Profile
                </a>
                <a href="/admin/accounts/logout" class="sidebar-link sidebar-link-with-icon {{ 'admin/logout' == request()->path() ? 'active' : '' }}">
                    <span class="sidebar-icon {{ 'admin/logout' == request()->path() ? 'text-white bg-primary' : '' }}">
                        <i class="fa fa-sign-out-alt"></i>
                    </span>
                    Logout
                </a>
                <h6 class="sidebar-title mt-20">Application</h6>
                <div class="sidebar-divider"></div>
                <a href="/admin/memberships" class="sidebar-link sidebar-link-with-icon {{ 'admin/memberships' == request()->path() ? 'active' : '' }}">
                    <span class="sidebar-icon {{ 'admin/memberships' == request()->path() ? 'text-white bg-primary' : '' }}">
                        <i class="fa fa-star"></i>
                    </span>
                    Memberships
                </a> 
                <a href="/admin/users" class="sidebar-link sidebar-link-with-icon {{ 'admin/users' == request()->path() ? 'active' : '' }}">
                    <span class="sidebar-icon {{ 'admin/users' == request()->path() ? 'text-white bg-primary' : '' }}">
                        <i class="fa fa-users"></i>
                    </span>
                    Users <span class="badge badge-primary ml-5">{{$contents[0]}}</span>
                </a>
                 <a href="/admin/invoices" class="sidebar-link sidebar-link-with-icon {{ 'admin/cars' == request()->path() ? 'active' : '' }}">
                    <span class="sidebar-icon {{ 'admin/invoices' == request()->path() ? 'text-white bg-primary' : '' }}">
                       <i class="fa fa-file-invoice"></i>
                    </span>
                    invoices  <span class="badge badge-primary ml-5">{{$contents[5]}}</span> 
                </a>

                <a href="/admin/cars" class="sidebar-link sidebar-link-with-icon {{ 'admin/cars' == request()->path() ? 'active' : '' }}">
                    <span class="sidebar-icon {{ 'admin/cars' == request()->path() ? 'text-white bg-primary' : '' }}">
                        <i class="fa fa-car"></i>
                    </span>
                    Cars <span class="badge badge-primary ml-5">{{$contents[1]}}</span>
                </a>
                <a href="/admin/sold-cars" class="sidebar-link sidebar-link-with-icon {{ 'admin/sold-cars' == request()->path() ? 'active' : '' }}">
                    <span class="sidebar-icon {{ 'admin/sold-cars' == request()->path() ? 'text-white bg-primary' : '' }}">
                        <i class="fa fa-car"></i>
                    </span>
                    Sold Cars <span class="badge badge-primary ml-5">{{$contents[3]}}</span>
                </a>
                <a href="/admin/search-cars" class="sidebar-link sidebar-link-with-icon {{ 'admin/search-cars' == request()->path() ? 'active' : '' }}">
                    <span class="sidebar-icon {{ 'admin/search-cars' == request()->path() ? 'text-white bg-primary' : '' }}">
                        <i class="fa fa-search"></i>
                    </span>
                    Search Cars <span class="badge badge-primary ml-5">{{$contents[4]}}</span>
                </a>
                <a href="/admin/schedule" class="sidebar-link sidebar-link-with-icon {{ 'admin/schedule' == request()->path() ? 'active' : '' }}">
                    <span class="sidebar-icon {{ 'admin/schedule' == request()->path() ? 'text-white bg-primary' : '' }}">
                        <i class="fa fa-gavel"></i>
                    </span>
                    Auctions <span class="badge badge-primary ml-5">{{$contents[2]}}</span>
                </a>
                <a href="/admin/prices" class="sidebar-link sidebar-link-with-icon {{ 'admin/prices' == request()->path() ? 'active' : '' }}">
                    <span class="sidebar-icon {{ 'admin/prices' == request()->path() ? 'text-white bg-primary' : '' }}">
                    <i class="fa fa-money-bill"></i>

                    </span>
                    Prices 
                </a>
                <h6 class="sidebar-title mt-20">External Links</h6>
                <div class="sidebar-divider"></div>
                <a href="/" target="_blank" class="sidebar-link sidebar-link-with-icon">
                    <span class="sidebar-icon bg-danger text-white">
                        <i class="fa fa-globe"></i>
                    </span>
                    Website
                </a>
            </div>
        </div>
        @yield("content")
    </div>
    <script src="/admin-assets/libraries/halfmoon/js/halfmoon.min.js"></script>
    <script src="/admin-assets/js/script.js"></script>
    <script src="/assets/js/flatpickr.js"></script>
    @yield('scripts')
</body>

</html>