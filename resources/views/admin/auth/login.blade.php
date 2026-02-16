<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="../assets/"
  data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>AlumniIndia - Admin Login</title>

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="{{ asset('admin_assets/assets/img/favicon/favicon.ico') }}" />
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

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
  body{
      background-color: #e6e6e6;}
 </style>
</head>

<body>
  <!-- Content -->

  <div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
       <div class="div-section-all-logins auth-ui">
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
            <div class="left-and"><h1>Log In</h1></div>
           <p>Enter your login details to access your account securely.</p>
            <form id="formAuthentication" class="mb-3" action="{{ route('admin.login.submit') }}" method="POST">
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
                <label class="form-label">Email <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="email" placeholder="Enter your email" @error('email')
                is-invalid @enderror value="{{ old('email') }}">
                @error('email')
                  <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
              </div>
              <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between">
                  <label class="form-label" for="password">Password <span class="text-danger">*</span></label>
                </div>
                <div class="input-group input-group-merge">
                  <input type="password" class="form-control" name="password" placeholder="Enter your password"
                    @error('password') is-invalid @enderror value="{{ old('password') }}">
                  <span class="input-group-text cursor-pointer">
                    <i class="bx bx-hide"></i>
                  </span>
                  @error('password')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                  @enderror
                </div>
                <div class="text-end mb-4">
                  <a href="{{ route('admin.forgot.password.view') }}">
                    <small>Forgot Password?</small>
                  </a>

                </div>

              </div>
            
              <div class="mb-3">
                <button class="btn btn-primary d-grid w-100" type="submit">Log In</button>
              </div>
            </form>
           </div>
          </div>
        </div>
       </div>
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
</body>

</html>