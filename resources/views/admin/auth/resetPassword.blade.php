<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="../assets/"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>AlumniIndia - Reset Password </title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('admin_assets/assets/img/favicon/favicon.ico') }}" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('admin_assets/assets/vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('admin_assets/assets/vendor/css/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin_assets/assets/vendor/css/theme-default.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin_assets/assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet"
        href="{{ asset('admin_assets/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="{{ asset('admin_assets/assets/vendor/css/pages/page-auth.css') }}" />

    <!-- Helpers -->
    <script src="{{ asset('admin_assets/assets/vendor/js/helpers.js') }}"></script>

    <!-- Config -->
    <script src="{{ asset('admin_assets/assets/js/config.js') }}"></script>
    <style>
        body {
            background-color: #e6e6e6;
        }
    </style>
</head>

<body>
    <!-- Content -->




    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="div-section-all-logins auth-ui">
                <!-- Forgot Password -->
                <div class="row">
                    <div class="col-md-6 auth-left">
                        <div class="auth-left-content">
                            <h2>Welcome to Admin Login</h2>
                            <p>
                                Securely access your admin dashboard to manage alumni data and platform operations.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="login-sections">
                            <!-- Logo -->
                            <div class="app-brand justify-content-center">
                                <a href="index.html" class="app-brand-link gap-2">
                                    <img src="{{ asset('admin_assets/images/logo-black.png') }}" alt="logo">
                                </a>
                            </div>
                            <!-- /Logo -->
                            <div class="left-and">
                                <h1>Reset Password</h1>
                            </div>
                            <p>Enter your login details to access your account securely.</p>
                            <form method="post" action="{{route('admin.resetPassword.submit', $token)}}"
                                enctype="multipart/form-data">

                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @csrf

                                <div class="mb-3">
                                    <input type="hidden" name="token" value="{{ $token }}">

                                    <label for="email" class="form-label">New Password <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge"> <input type="password"
                                            class="form-control" id="password" name="password"
                                            placeholder="Enter new password">
                                        <span class="input-group-text cursor-pointer">
                                            <i class="bx bx-hide toggle-password"></i>
                                        </span>
                                    </div>

                                    @error('password')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>


                                <div class="mb-3">
                                    <input type="hidden" name="token" value="{{ $token }}">

                                    <label for="email" class="form-label">Confirm Password <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge"> <input type="password"
                                            placeholder="Enter confirm password" class="form-control"
                                            name="password_confirmation" value="">
                                        <span class="input-group-text cursor-pointer">
                                            <i class="bx bx-hide toggle-password"></i>
                                        </span>
                                    </div>

                                    @error('password_confirmation')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>


                                <div class="">

                                    <button class="btn btn-primary d-grid w-100 btn-rest" type="submit">Reset</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <!-- /Register -->
        </div>
    </div>



    <!-- Core JS -->
    <script src="{{ asset('admin_assets/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('admin_assets/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('admin_assets/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('admin_assets/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('admin_assets/assets/vendor/js/menu.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('admin_assets/assets/js/main.js') }}"></script>

    <!-- <script async defer src="https://buttons.github.io/buttons.js"></script> -->

    <script>
        $(document).on("click", ".toggle-password", function () {

            let input = $(this).closest(".input-group").find("input");

            $(this).toggleClass("bx-hide bx-show");

            if (input.attr("type") === "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    </script>

</body>

</html>