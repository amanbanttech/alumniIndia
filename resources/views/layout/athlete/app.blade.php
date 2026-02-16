<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
  data-assets-path="/athlete_assets/assets/" data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <title>AlumniIndia - {{ $pageTitle ?? '' }}</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="{{ asset('athlete_assets/assets/img/favicon/favicon.ico') }}" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap"
    rel="stylesheet" />


  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">


  <!-- Icons -->
  <link rel="stylesheet" href="{{ asset('athlete_assets/assets/vendor/fonts/boxicons.css') }}" />
  <!-- Core CSS -->
  <link rel="stylesheet" href="{{ asset('athlete_assets/assets/vendor/css/core.css') }}" />
  <link rel="stylesheet" href="{{ asset('athlete_assets/assets/vendor/css/theme-default.css') }}" />
  <link rel="stylesheet" href="{{ asset('athlete_assets/assets/css/demo.css') }}" />

  <style>
    /* ===== DASHBOARD WIREFRAME STYLE ===== */

    .dashboard-title {
      text-align: center;
      font-weight: 600;
      margin-bottom: 30px;
      border-bottom: 2px solid red;
      padding-bottom: 10px;
    }

    .metric-card {
      border: 2px solid red;
      border-radius: 0;
      min-height: 180px;
    }

    .metric-card h6 {
      text-align: center;
      font-weight: 600;
      color: red;
      border-bottom: 1px solid red;
      padding-bottom: 6px;
      margin-bottom: 12px;
    }

    .metric-card ul {
      padding-left: 15px;
    }

    .metric-card ul li {
      color: red;
      font-size: 14px;
      margin-bottom: 6px;
    }

    /* footer style like image */
    .dashboard-footer {
      border-top: 2px solid red;
      text-align: center;
      margin-top: 40px;
      padding-top: 10px;
      color: green;
      font-size: 14px;
    }
  </style>


  <!-- Vendors -->
  <link rel="stylesheet"
    href="{{ asset('athlete_assets/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

  <script src="{{ asset('athlete_assets/assets/vendor/js/helpers.js') }}"></script>
  <script src="{{ asset('athlete_assets/assets/js/config.js') }}"></script>
</head>

<body>
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">



      <!-- ================= SIDEBAR ================= -->
      <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
        <div class="app-brand demo">
          <a href="{{ route('admin.dashboard') }}" class="app-brand-link">
            <span class="app-brand-text demo menu-text fw-bolder ms-2">
              Alumni
            </span>
          </a>
          <a href="javascript:void(0);" class="layout-menu-toggle menu-link ms-auto d-xl-none">
            <i class="bx bx-chevron-left"></i>
          </a>
        </div>

        <ul class="menu-inner py-1">
          <li class="menu-item {{ request()->routeIs('athlete.dashboard') ? 'active' : '' }}">
            <a href="{{ route('athlete.dashboard') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-home-circle"></i>
              <div>Dashboard</div>
            </a>
          </li>




        </ul>
      </aside>
      <!-- ================= /SIDEBAR ================= -->

      <div class="layout-page">

        <!-- ================= NAVBAR ================= -->
        <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached bg-navbar-theme">

          <!-- mobile toggle -->
          <div class="layout-menu-toggle navbar-nav d-xl-none">
            <a class="nav-item nav-link px-0" href="javascript:void(0)">
              <i class="bx bx-menu"></i>
            </a>
          </div>

          <!-- RIGHT SIDE PROFILE -->
          <div class="navbar-nav ms-auto">
            <ul class="navbar-nav flex-row align-items-center ms-auto">
              <li class="nav-item dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="#" data-bs-toggle="dropdown">
                  <div class="avatar avatar-online">
                    <img src="{{ Auth::user()->image
  ? asset('athlete_assets/images/' . Auth::user()->image)
  : asset('athlete_assets/assets/img/avatars/1.png') }}" class="w-px-40 h-auto rounded-circle">
                  </div>
                </a>

                <ul class="dropdown-menu dropdown-menu-end">
                  <li class="dropdown-item-text">
                    <strong>{{ auth()->user()->name ?? 'Admin' }}</strong>
                  </li>
                  <li>
                    <div class="dropdown-divider"></div>
                  </li>
                  <li>
                    <a class="dropdown-item" href="{{ route('athlete.profile') }}">
                      <i class="bx bx-power-off me-2"></i> My Profile
                    </a>
                  </li>
                  <li>
                    <div class="dropdown-divider"></div>
                  </li>
                  <li>
                    <a class="dropdown-item" href="{{ route('athlete.logout') }}">
                      <i class="bx bx-power-off me-2"></i> Logout
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>

        </nav>

        <!-- ================= /NAVBAR ================= -->

        <!-- ================= CONTENT ================= -->
        <div class="content-wrapper">
          <div class="container-xxl flex-grow-1 container-p-y">
            @yield('content')
          </div>

          <!-- <footer class="content-footer footer bg-footer-theme text-end px-4 py-2">
            © {{ date('Y') }} Alumni Connect
          </footer> -->
        </div>
        <!-- ================= /CONTENT ================= -->

      </div>
    </div>
  </div>

  <!-- JS -->
  <script src="{{ asset('athlete_assets/assets/vendor/libs/jquery/jquery.js') }}"></script>
  <script src="{{ asset('athlete_assets/assets/vendor/js/bootstrap.js') }}"></script>
  <script src="{{ asset('athlete_assets/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
  <script src="{{ asset('athlete_assets/assets/vendor/js/menu.js') }}"></script>
  <script src="{{ asset('athlete_assets/assets/js/main.js') }}"></script>
</body>

</html>