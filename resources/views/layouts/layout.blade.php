<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Phyxle Infotech (Pvt) Ltd">
    <title>@yield('title') | {{ config('app.name') }}</title>
    <link rel="icon" href="/assets/images/favicon/favicon.png" type="/assets/image/png">
    <link rel="apple-touch-icon" href="/assets/images/apple-touch-icon.png">
    <link rel="stylesheet" href="/assets/css/preloader.css">
    <link rel="stylesheet" href="/assets/css/simplebar.css">
    <link rel="stylesheet" href="/assets/css/tiny-slider.css">
    <link rel="stylesheet" href="/assets/css/filepond-image-preview.css">
    <link rel="stylesheet" href="/assets/css/filepond.css">
    <link rel="stylesheet" href="/assets/css/flatpickr.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <script src="{{ asset('/assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/countdown/jquery.countdown.min.js') }}"></script>
    <script src="/assets/js/preloader.js"></script>
</head>

<body class="bg-light">
    <div class="page-loading active">
        <div class="page-loading-inner">
            <div class="page-spinner"></div>
            <span>Loading...</span>
        </div>
    </div>
    <main class="page-wrapper">
        <div class="modal fade" id="signin-modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered my-0 mx-auto p-2" style="max-width: 950px;">
                <div class="modal-content border-light">
                    <div class="modal-body py-sm-0 px-0 py-2">
                        <button class="btn-close position-absolute end-0 me-3 top-0 mt-3" type="button" data-bs-dismiss="modal"></button>
                        <div class="row mx-0">
                            <div class="col-md-6 p-sm-5 p-4">
                                <h2 class="h3 mb-sm-5 mb-4">Hey there!<br>Welcome back.</h2>
                                <img class="d-block mx-auto" src="/assets/images/sign-in.svg" width="344" alt="login">
                                <div class="mt-sm-5 mt-4">
                                    <span class="opacity-60">Don't have an account?</span>
                                    <a class="text-dark opacity-60" href="#signup-modal" data-bs-toggle="modal" data-bs-dismiss="modal">Sign up here</a>
                                </div>
                            </div>
                            <div class="col-md-6 border-start-md border-dark px-sm-5 pb-sm-5 pt-md-5 px-4 pt-2 pb-4">
                                <form action="{{ route('login') }}" method="post">
                                    @csrf
                                    <h4>Login details</h4>
                                    <div class="mb-4">
                                        <label class="form-label mb-2" for="login-username">User name <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" id="login-username" name="username" minlength="3" required>
                                    </div>
                                    <div class="mb-4">
                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                            <label class="form-label mb-0" for="login-password">Password <span class="text-danger">*</span></label>
                                            <a class="fs-sm text-dark" href="#forget-password-modal" data-bs-toggle="modal" data-bs-dismiss="modal">Forgot password?</a>
                                        </div>
                                        <div class="password-toggle">
                                            <input class="form-control" type="password" id="login-password" name="password" minlength="6" maxlength="32" required>
                                            <label class="password-toggle-btn" aria-label="Show/Hide password">
                                                <input class="password-toggle-check" type="checkbox">
                                                <span class="password-toggle-indicator"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <button class="btn btn-accent bg-gradient btn-lg w-100 border-0" type="submit">Login</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="signup-modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered my-0 mx-auto p-2" style="max-width: 950px;">
                <div class="modal-content border-light">
                    <div class="modal-body py-sm-0 px-0 py-2">
                        <button class="btn-close position-absolute end-0 me-3 top-0 mt-3" type="button" data-bs-dismiss="modal"></button>
                        <div class="row mx-0">
                            <div class="col-md-6 p-sm-5 p-4">
                                <h2 class="h3 mb-sm-5 mb-4">Join us.<br>Get premium benefits.</h2>
                                <ul class="list-unstyled mb-sm-5 mb-4">
                                    <li class="d-flex mb-2"><i class="fi-check-circle text-primary me-2 mt-1"></i><span>Add and promote
                                            your listings</span></li>
                                    <li class="d-flex mb-2"><i class="fi-check-circle text-primary me-2 mt-1"></i><span>Easily manage your
                                            wishlist</span></li>
                                    <li class="d-flex mb-0"><i class="fi-check-circle text-primary me-2 mt-1"></i><span>Leave
                                            reviews</span></li>
                                </ul>
                                <img class="d-block mx-auto" src="/assets/images/sign-up.svg" width="344" alt="register">
                                <div class="mt-sm-4 pt-md-3">
                                    <span class="opacity-60">Already have an account?</span>
                                    <a class="text-dark opacity-60" href="#signin-modal" data-bs-toggle="modal" data-bs-dismiss="modal">Sign in here</a>
                                </div>
                            </div>
                            <div class="col-md-6 border-start-md border-dark px-sm-5 pb-sm-5 pt-md-5 px-4 pt-2 pb-4">
                                <form class="needs-validation" action="/accounts/register" method="post">
                                    @csrf
                                    <h4>Company details</h4>
                                    <div class="mb-4">
                                        <label class="form-label" for="register-company">Company <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" id="register-company" name="company" maxlength="255" required>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label" for="register-addition">Addition</label>
                                        <input class="form-control" type="text" id="register-addition" name="addition" maxlength="255">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label" for="register-street">Street/Number <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" id="register-street" name="street" maxlength="255" required>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label" for="register-post-box">Post box</label>
                                        <input class="form-control" type="text" id="register-post-box" name="post_box" maxlength="255">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label" for="register-postcode">Postcode <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" id="register-postcode" name="postcode" maxlength="255" required>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label" for="register-town">Town <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" id="register-town" name="town" maxlength="255" required>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label" for="register-country">Country <span class="text-danger">*</span></label>
                                        <select name="country" id="register-country" class="form-select" required>
                                            <option value="Switzerland" selected>Switzerland</option>
                                        </select>
                                    </div>

                                    <h4>Personal Details</h4>
                                    <div class="mb-4">
                                        <label class="form-label" for="register-form-of-address">Form of address
                                            <span class="text-danger">*</span></label>
                                        <select name="form_of_address" id="register-form-of-address" class="form-select" required>
                                            <option value="Mr." selected>Mr.</option>
                                            <option value="Mrs.">Mrs.</option>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label" for="register-first-name">First name <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" id="register-first-name" name="first_name" maxlength="255" required>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label" for="register-surname">Surname <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" id="register-surname" name="surname" maxlength="255" required>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label" for="register-email">Email address <span class="text-danger">*</span></label>
                                        <input class="form-control" type="email" id="register-email" name="email" maxlength="255" required>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label" for="register-telephone">Telephone number <span class="text-danger">*</span></label>
                                        <input class="form-control" type="tel" id="register-telephone" name="phone" placeholder="Enter telephone" maxlength="15" required>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label" for="register-mobile">Mobile phone number</label>
                                        <input class="form-control" type="tel" id="register-mobile" name="mobile" placeholder="Enter mobile number" maxlength="15">
                                    </div>
                                    <div class="mb-4 test">
                                        <label class="form-label" for="ide">IDE Number</label>
                                        <div class="d-flex align-items-center">
                                            <span class="mx-1">CHE-</span>

                                            <input class="form-control mx-1" type="number" id="ide" name="ide-1" placeholder="XXX" maxlength="3" oninput="javascript: if (this.value.length > 3) this.value = this.value.slice(0, 3);" >
                                            .
                                            <input class="form-control mx-1" type="number" id="ide" name="ide-2" placeholder="XXX" maxlength="3" oninput="javascript: if (this.value.length > 3) this.value = this.value.slice(0, 3);" >
                                            .
                                            <input class="form-control mx-1" type="number" id="ide" name="ide-3" placeholder="XXX" maxlength="3" oninput="javascript: if (this.value.length > 3) this.value = this.value.slice(0, 3);" >
                                        </div>
                                    </div>
                                    <div class="mb-5">
                                        <label class="form-label" for="register-preferred-language">Preferred
                                            language</label>
                                        <select name="lang" id="register-preferred-language" class="form-select">
                                            <option value="English" selected>English</option>
                                            <option value="German">German</option>
                                            <option value="Franch">French</option>
                                            <option value="Italian">Italian</option>
                                        </select>
                                    </div>
                                    <h4>Login details</h4>
                                    <div class="mb-4">
                                        <label class="form-label" for="register-username">Username <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" id="register-username" name="username" minlength="3" maxlength="8" required>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label" for="register-password">Password <span class="text-danger">*</span></label>
                                        <div class="password-toggle">
                                            <input class="form-control" type="password" id="register-password" name="password" minlength="6" maxlength="32" required>
                                            <label class="password-toggle-btn" aria-label="Show/hide password">
                                                <input class="password-toggle-check" type="checkbox">
                                                <span class="password-toggle-indicator"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label" for="register-confirm-password">Confirm password
                                            <span class="text-danger">*</span></label>
                                        <div class="password-toggle">
                                            <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" minlength="6" maxlength="32" required>
                                            <label class="password-toggle-btn" aria-label="Show/hide password">
                                                <input class="password-toggle-check" type="checkbox">
                                                <span class="password-toggle-indicator"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-check mb-4">
                                        <input class="form-check-input" type="checkbox" id="register-agree-to-terms" name="agree-to-terms" required>
                                        <label class="form-check-label" for="register-agree-to-terms">
                                            <span class="opacity-70">By joining, I agree to the</span>
                                            <a href="/how-it-works/terms" class="text-dark">Terms of use</a>
                                            <span class="opacity-70">and</span>
                                            <a href="/how-it-works/policy" class="text-dark">Privacy policy</a>.
                                        </label>
                                    </div>
                                    <button class="btn btn-accent bg-gradient btn-lg w-100 border-0" type="submit">Register</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="forget-password-modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered my-0 mx-auto p-2" style="max-width: 950px;">
                <div class="modal-content border-light">
                    <div class="modal-body py-sm-0 px-0 py-2">
                        <button class="btn-close position-absolute end-0 me-3 top-0 mt-3" type="button" data-bs-dismiss="modal"></button>
                        <div class="row mx-0">
                            <div class="col-md-6 p-sm-5 p-4">
                                <h2 class="h3 mb-sm-5 mb-4">Forgot password?<br>Send password reset email.</h2>
                                <img class="d-block mx-auto" src="/assets/images/sign-in.svg" width="344" alt="login">
                                <div class="mt-sm-5 mt-4">
                                    <span class="opacity-60">Don't have an account?</span>
                                    <a class="text-dark opacity-60" href="#signup-modal" data-bs-toggle="modal" data-bs-dismiss="modal">Sign up here</a>
                                    <br>
                                    <span class="opacity-60">Already have an account?</span>
                                    <a class="text-dark opacity-60" href="#signin-modal" data-bs-toggle="modal" data-bs-dismiss="modal">Sign in here</a>
                                </div>
                            </div>
                            <div class="col-md-6 border-start-md border-dark px-sm-5 pb-sm-5 pt-md-5 px-4 pt-2 pb-4">
                                <form action="/forgot-password" method="post">
                                    @csrf
                                    <h4>Account details</h4>
                                    <div class="mb-4">
                                        <label class="form-label mb-2" for="forget-password-email">Email address <span class="text-danger">*</span></label>
                                        <input class="form-control" type="email" id="forget-password-email" name="email" maxlength="255" value="" required>
                                    </div>
                                    <button class="btn btn-accent bg-gradient btn-lg w-100 border-0" type="submit">Send
                                        email</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <header class="navbar navbar-expand-lg navbar-light fixed-top" data-scroll-header>
            <div class="container">
                <a class="navbar-brand me-3 me-xl-4" href="/">
                    <img class="d-block" src="/assets/images/logo/logo.jpg" width="116" alt="logo">
                </a>
                <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="dropdown ms-n3 me-3 d-none d-lg-block order-lg-3">
                    <button class="btn btn-link btn-sm dropdown-toggle fw-normal py-2" type="button" data-bs-toggle="dropdown">
                        <i class="fi-globe me-2"></i>{{ Config::get('languages')[App::getLocale()] }}
                    </button>
                    <div class="dropdown-menu w-100">
                        @foreach (Config::get('languages') as $lang => $language)
                        <a class="dropdown-item" href="{{ route('lang.switch', $lang) }}">{{ $language }}</a>
                        @endforeach
                    </div>
                </div>
                @if (session()->has('client_id'))
                <div class="dropdown d-none d-lg-block order-lg-3 my-n2 me-3">
                    <a class="d-block py-2" href="/accounts/profile">
                        <img class="rounded-circle" src="/assets/images/avatar.png" width="40" alt="avatar">
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <div class="d-flex align-items-start border-bottom border-light mb-2 px-3 py-1" style="width: 16rem;">
                            <img class="rounded-circle" src="/assets/images/avatar.png" width="48" alt="avatar">
                            <div class="ps-2">
                                <h6 class="fs-base text-dark mb-0">{{ auth()->user()->username }}</h6>
                                <div class="fs-xs py-2">
                                    {{ auth()->user()->phone }}<br>{{ auth()->user()->email }}
                                </div>
                            </div>
                        </div>
                        <a class="dropdown-item" href="/accounts/profile">
                            <i class="fi-user me-2"></i>Profile
                        </a>
                        <a class="dropdown-item" href="/accounts/invoices">
                            <i class="fi-file me-2"></i>Invoices
                            <span class="badge bg-faded-light ms-2">0</span>
                        </a>
                        <a class="dropdown-item" href="/accounts/current-vehicles">
                            <i class="fi-car me-2"></i>Current vehicles
                            <span class="badge bg-faded-light ms-2">0</span>
                        </a>
                        <a class="dropdown-item" href="/accounts/sold-vehicles">
                            <i class="fi-cash me-2"></i>Sold vehicles
                            <span class="badge bg-faded-light ms-2">0</span>
                        </a>
                        <a class="dropdown-item" href="/accounts/purchased-vehicles">
                            <i class="fi-cart me-2"></i>Purchased vehicles
                            <span class="badge bg-faded-light ms-2">0</span>
                        </a>
                        <a class="dropdown-item" href="/accounts/dashboard">
                            <i class="fi-ticket me-2"></i>Conditional Bids
                            <span class="badge bg-faded-light ms-2">0</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/accounts/logout">Logout</a>
                    </div>
                </div>
                @endif
                @if (!session()->has('client_id'))
                <div class="order-lg-3 d-flex flex-column">
                    <a class="btn btn-accent bg-gradient btn-sm order-lg-3 mb-2 border-0" href="#signin-modal" data-bs-toggle="modal"><i class="fi-user me-2"></i>Login</a>
                    <a class="btn btn-link btn-sm d-none d-lg-block order-lg-3" href="#signup-modal" data-bs-toggle="modal"><i class="fi-user-plus me-2"></i>Register</a>
                </div>
                @endif
                <div class="collapse navbar-collapse order-lg-2" id="navbarNav">
                    <ul class="navbar-nav navbar-nav-scroll" style="max-height: 35rem;">
                        <li class="nav-item {{ $id == 'index' ? 'active' : '' }}"><a class="nav-link" href="/">Home</a></li>
                        <li class="nav-item {{ $id == 'about' ? 'active' : '' }}"><a class="nav-link" href="/fastauktion/about">About Us</a></li>
                        <li class="nav-item {{ $id == 'instructions' ? 'active' : '' }}"><a class="nav-link" href="/how-it-works/instructions">Instructions</a></li>
                        <li class="nav-item {{ $id == 'prices' ? 'active' : '' }}"><a class="nav-link" href="/how-it-works/prices">Prices</a></li>
                        @if (session()->has('client_id'))
                        <li class="nav-item {{ $id == 'sell-your-car' ? 'active' : '' }}"><a class="nav-link" href="/accounts/car/sell">Sell Your Car</a></li>
                        <li class="nav-item dropdown <?php echo $id == 'account' ? 'active' : ''; ?>">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Account</a>
                            <ul class="dropdown-menu">
                                <li class="dropdown">
                                    <a class="dropdown-item dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Profile</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="/accounts/profile">Profile</a></li>
                                        <li><a class="dropdown-item" href="/accounts/invoices">Invoices</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a class="dropdown-item dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Vehicles</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="/accounts/current-vehicles">Current
                                                vehicles</a></li>
                                        <li><a class="dropdown-item" href="/accounts/sold-vehicles">Sold
                                                vehicles</a></li>
                                        <li><a class="dropdown-item" href="/accounts/purchased-vehicles">Purchased
                                                vehicles</a></li>
                                    </ul>
                                </li>
                                <li><a class="dropdown-item" href="/accounts/logout">Logout</a></li>
                            </ul>
                        </li>
                        @endif
                        <li class="nav-item dropdown d-lg-none">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fi-globe me-2"></i>English
                            </a>
                            <div class="dropdown-menu">
                                @foreach (Config::get('languages') as $lang => $language)
                                @if ($lang != App::getLocale())
                                <a class="dropdown-item" href="{{ route('lang.switch', $lang) }}">{{ $language }}</a>
                                @endif
                                @endforeach
                            </div>
                        </li>
                        @if (session()->has('client_id'))
                        <li class="nav-item dropdown d-lg-none">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img class="rounded-circle me-2" src="images/avatar.png" width="30" alt="avatar">Test Corporation
                            </a>
                            <div class="dropdown-menu">
                                <div class="ps-3">
                                    <div class="fs-xs py-2">000 000 000<br>testcorporation@test.com</div>
                                </div>
                                <a class="dropdown-item" href="/accounts/profile">
                                    <i class="fi-user me-2"></i>Profile
                                </a>
                                <a class="dropdown-item" href="/accounts/invoices">
                                    <i class="fi-file me-2"></i>Invoices
                                    <span class="badge bg-faded-light ms-2">0</span>
                                </a>
                                <a class="dropdown-item" href="/accounts/current-vehicle">
                                    <i class="fi-car me-2"></i>Current vehicles
                                    <span class="badge bg-faded-light ms-2">0</span>
                                </a>
                                <a class="dropdown-item" href="/accounts/sold-vehicles">
                                    <i class="fi-cash me-2"></i>Sold vehicles
                                    <span class="badge bg-faded-light ms-2">0</span>
                                </a>
                                <a class="dropdown-item" href="/accounts/purchased-vehicles">
                                    <i class="fi-cart me-2"></i>Purchased vehicles
                                    <span class="badge bg-faded-light ms-2">0</span>
                                </a>
                                <a class="dropdown-item" href="/accounts/dashboard">
                                    <i class="fi-ticket me-2"></i>Conditional Bids
                                    <span class="badge bg-faded-light ms-2">0</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/accounts/logout">Logout</a>
                            </div>
                        </li>
                        @endif
                        @if (!session()->has('client_id'))
                        <li class="nav-item d-lg-none"><a class="nav-link" href="#signin-modal" data-bs-toggle="modal"><i class="fi-user me-2"></i>Login</a></li>
                        <li class="nav-item d-lg-none"><a class="nav-link" href="#signup-modal" data-bs-toggle="modal"><i class="fi-user-plus me-2"></i>Register</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </header>

        @if (session()->has('reg_success'))
        <div class="container mt-6">
            <div class="alert alert-success">
                Registration successful. Verification email has been sent to your email. Please verify your email.
            </div>
        </div>
        @endif
        @if (session()->has('updated'))
        <div class="container mt-6">
            <div class="alert alert-success">
                {{session()->get('updated')}}
            </div>
        </div>
        @endif
        @if ($errors->any())
        <div class="container">
            <div class="alert alert-danger mt-6">

                @foreach ($errors->all() as $e)
                <div>{{ $e }}</div>
                @endforeach
            </div>
        </div>
        @endif
        @if (session()->has('not_apporved'))
        <div class="container">

            <div class="alert alert-danger mt-6">
                {{ session()->get('not_apporved') }}
            </div>
        </div>
        @endif
        @if (session()->has('login_success'))
        <div class="container mt-6">
            <div class="alert alert-success">
                {{ session()->get('login_success') }}
            </div>
        </div>
        @endif

        @if (session()->has('error'))
        <div class="container mt-6">
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        </div>
        @endif
        @if (session()->has('verified'))
        <div class="container mt-6">
            <div class="alert alert-success">
                {{ session()->get('verified') }}
            </div>
        </div>
        @endif


        @yield('content')
    </main>
    <footer class="footer border-top">
        <div class="py-4">
            <div class="d-sm-flex align-items-center justify-content-between container">
                <a class="d-inline-block" href="/"><img src="/assets/images/logo/logo.jpg" width="116" alt="logo"></a>
                <div class="d-flex pt-sm-0 pt-3">
                    <div class="dropdown ms-n3">
                        <button class="btn btn-link btn-sm dropdown-toggle fw-normal py-2" type="button" data-bs-toggle="dropdown">
                            <i class="fi-globe me-2"></i>{{ Config::get('languages')[App::getLocale()] }}
                        </button>
                        <div class="dropdown-menu w-100">
                            @foreach (Config::get('languages') as $lang => $language)
                            <a class="dropdown-item" href="{{ route('lang.switch', $lang) }}">{{ $language }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pt-lg-5 pb-lg-4 container pt-4 pb-3">
            <div class="row pt-lg-0 pt-2">
                <div class="col-md-3 col-sm-6 mb-sm-4 mb-2">
                    <h3 class="fs-base text-dark">Contact us</h3>
                    <a class="d-flex align-items-center text-decoration-none mb-2" href="#">
                        <i class="fi-map-pin me-2"></i>
                        <span class="text-dark opacity-50">Chemin de maillefer 34 1052 le mont sur lausanne</span>
                    </a>
                    <a class="d-flex align-items-center text-decoration-none mb-2" href="#">
                        <i class="fi-phone me-2"></i>
                        <span class="text-dark opacity-50">+41797705163</span>
                    </a>
                    <a class="d-flex align-items-center text-decoration-none mb-2" href="#">
                        <i class="fi-mail me-2"></i>
                        <span class="text-dark opacity-50">murugesu.sathursan@hotmail.com</span>
                    </a>
                    <div class="d-flex flex-wrap pt-4">
                        <a class="btn btn-icon btn-translucent-dark btn-xs rounded-circle me-2 mb-2" href="#"><i class="fi-facebook"></i></a>
                        <a class="btn btn-icon btn-translucent-dark btn-xs rounded-circle me-2 mb-2" href="#"><i class="fi-twitter"></i></a>
                        <a class="btn btn-icon btn-translucent-dark btn-xs rounded-circle me-2 mb-2" href="#"><i class="fi-telegram"></i></a>
                        <a class="btn btn-icon btn-translucent-dark btn-xs rounded-circle mb-2" href="#"><i class="fi-messenger"></i></a>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-sm-4 mb-2">
                    <h3 class="fs-base text-dark">Quick links</h3>
                    <ul class="list-unstyled fs-sm">
                        <li><a class="text-dark text-decoration-none opacity-50" href="/">Home</a></li>
                        <li><a class="text-dark text-decoration-none opacity-50" href="/fastauktion/about">About us</a>
                        </li>
                        <li><a class="text-dark text-decoration-none opacity-50" href="/how-it-works/instructions">Instructions</a></li>
                        <li><a class="text-dark text-decoration-none opacity-50" href="/accounts/car/sell">Sell your
                                car</a></li>
                        <li><a class="text-dark text-decoration-none opacity-50" href="/how-it-works/prices">Prices</a>
                        </li>
                        <li><a class="text-dark text-decoration-none opacity-50" href="/fastauktion/jobs">Jobs</a></li>
                    </ul>
                </div>
                <div class="col-md-3 col-sm-6 mb-sm-4 mb-2">
                    <h3 class="fs-base text-daek">FastAuktion</h3>
                    <ul class="list-unstyled fs-sm">
                        <li><a class="text-dark text-decoration-none opacity-50" href="/fastauktion/about">About us</a>
                        </li>
                        <li><a class="text-dark text-decoration-none opacity-50" href="/fastauktion/jobs">Jobs</a></li>
                        <li><a class="text-dark text-decoration-none opacity-50" href="/fastauktion/imprint">Imprint</a></li>
                        <li><a class="text-dark text-decoration-none opacity-50" href="/how-it-works/terms">Terms and
                                conditions</a></li>
                        <li><a class="text-dark text-decoration-none opacity-50" href="/how-it-works/policy">Privacy
                                policy</a></li>
                        <li><a class="text-dark text-decoration-none opacity-50" href="/gdrp">GDPR</a></li>
                    </ul>
                </div>
                <div class="col-md-3 col-sm-6 mb-sm-4 mb-2">
                    <h3 class="fs-base text-daek">Account</h3>
                    <ul class="list-unstyled fs-sm">
                        <li><a class="text-dark text-decoration-none opacity-50" href="/accounts/profile">Profile</a>
                        </li>
                        <li><a class="text-dark text-decoration-none opacity-50" href="/accounts/invoices">Invoices</a>
                        </li>
                        <li><a class="text-dark text-decoration-none opacity-50" href="/accounts/current-vehicles">Current vehicles</a></li>
                        <li><a class="text-dark text-decoration-none opacity-50" href="/accounts/sold-vehicles">Sold
                                vehicles</a></li>
                        <li><a class="text-dark text-decoration-none opacity-50" href="/accounts/purchased-vehicles">Purchased vehicles</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="d-lg-flex align-items-center justify-content-between fs-sm container pb-3">
            <div class="d-flex justify-content-center order-lg-2 mb-3 flex-wrap">
                <a class="nav-link text-dark text-decoration-none fw-normal opacity-50" href="/how-it-works/terms">Terms and conditions</a>
                <a class="nav-link text-dark text-decoration-none fw-normal opacity-50" href="/how-it-works/policy">Privacy policy</a>
                <a class="nav-link text-dark text-decoration-none fw-normal opacity-50" href="/gdrp">GDPR</a>
            </div>
            <p class="text-lg-start order-lg-1 mb-lg-0 text-center">
                <span class="text-daek opacity-50">&copy; 2022</span>
                <a class="text-dark text-decoration-none fw-bold opacity-50" href="/">Fast Life Sàrl</a>.
                <span class="text-daek opacity-50">All Rights Reserved.</span>
                <!-- Designed By Phyxle (https://phyxle.com). -->
            </p>
        </div>
    </footer>
    <a class="btn-scroll-top" href="#top" data-scroll>
        <span class="btn-scroll-top-tooltip text-muted fs-sm me-2">Top</span>
        <i class="btn-scroll-top-icon fi-chevron-up"></i>
    </a>
    <script src="/assets/js/bootstrap-bundle.js"></script>
    <script src="/assets/js/simplebar.js"></script>
    <script src="/assets/js/smooth-scroll-polyfills.js"></script>
    <script src="/assets/js/jarallax.js"></script>
    <script src="/assets/js/jarallax-element.js"></script>
    <script src="/assets/js/filepond-file-validate-type.js"></script>
    <script src="/assets/js/filepond-file-validate-size.js"></script>
    <script src="/assets/js/filepond-image-preview.js"></script>
    <script src="/assets/js/filepond-image-crop.js"></script>
    <script src="/assets/js/filepond-image-resize.js"></script>
    <script src="/assets/js/filepond-image-transform.js"></script>
    <script src="/assets/js/filepond.js"></script>
    <script src="/assets/js/flatpickr.js"></script>
    <script src="/assets/js/cleave.js"></script>
    <script src="{{ asset('assets/js/tiny-slider.js') }}"></script>
    <script src="/assets/js/script.js"></script>

    <!-- <script type="text/javascript">
        function addDecimalPoints() {
            var inputElement = document.getElementById('ide');
            inputElement.value = inputElement.value.replace(/\D/g, '');
            var inputValue = inputElement.value.replace('.', '').split("").reverse().join(""); // reverse
            var newValue = '';
            for (var i = 0; i < inputValue.length; i++) {
                if (i % 3 == 0) {
                    newValue += '.';
                }
                newValue += inputValue[i];
            }
            inputElement.value = newValue.split("").reverse().join("");
        }

        function decimalPoints() {
            //  console.log('changed');
            // let target = document.getElementById('ide');
            //  console.log(target);
            // // target.value = target.value.toLocaleString()

            // document.getElementById('ide').innerHTML = target.toLocaleString();

            return this.each(function() {
                $(this).text($(this).text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
            })

        } -->
    </script>

    @yield('scripts')

    @stack('body-scripts')


</body>

</html>