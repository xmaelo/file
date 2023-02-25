<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="icon" href="/assets/images/favicon/favicon.png" type="/assets/image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap">
    <link rel="stylesheet" href="/admin-assets/libraries/@fortawesome/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="/admin-assets/libraries/halfmoon/css/halfmoon.min.css">
    <link rel="stylesheet" href="/admin-assets/css/style.css">
</head>

<body class="dark-mode with-custom-css-scrollbars with-custom-webkit-scrollbars">
    <div class="page-wrapper">
        <div class="content-wrapper">
            <div class="container h-full">
                <div class="row justify-content-center align-items-center h-full">
                    <div class="col-12 col-sm-8 col-md-6 col-lg-4">
                        <div class="text-center">
                            <img src="/assets/images/logo/logo.jpg" alt="logo" width="150">
                        </div>
                        <div class="card p-15">
                            <h1 class="card-title">
                                <i class="fa fa-sign-in-alt mr-5"></i> Login
                            </h1>
                            <form action="{{ route('login') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="username" class="required">Enter Username</label>
                                    <input id="username" placeholder="Username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" required autocomplete="off">
                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <small>{{ $message }}</small>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password" class="required">Enter password</label>
                                    <input id="password" placeholder="Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="off">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <small>{{ $message }}</small>
                                        </span>
                                    @enderror
                                </div>
                                <div class="text-right">
                                    <button class="btn">
                                        <i class="fa fa-sign-in-alt mr-5"></i> {{ __('Login') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/admin-assets/libraries/halfmoon/js/halfmoon.min.js"></script>
    <script src="/admin-assets/js/script.js"></script>
</body>

</html>
