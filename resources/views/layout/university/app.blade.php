<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
  data-assets-path="/university_assets/assets/" data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <title>AlumniIndia - {{ $pageTitle ?? '' }}</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <!-- <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" /> -->
  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="{{ asset('university_assets/assets/img/favicon/favicon.png') }}" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css"> 


  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">

  <!-- Icons -->
  <link rel="stylesheet" href="{{ asset('university_assets/assets/vendor/fonts/boxicons.css') }}" />
  <!-- Core CSS -->
  <link rel="stylesheet" href="{{ asset('university_assets/assets/vendor/css/core.css') }}" />
  <link rel="stylesheet" href="{{ asset('university_assets/assets/vendor/css/theme-default.css') }}" />
  <link rel="stylesheet" href="{{ asset('university_assets/assets/css/demo.css') }}" />
  <!-- Vendors -->
  <link rel="stylesheet"
    href="{{ asset('university_assets/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <script src="{{ asset('university_assets/assets/vendor/js/helpers.js') }}"></script>
  <script src="{{ asset('university_assets/assets/js/config.js') }}"></script>
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



</head>

<body>
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">

      <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
        <div class="app-brand demo">
          <a href="{{ route('frontend.index') }}" class="app-brand-link">
            <img src="{{ asset('university_assets/images/logo-white.png') }}" alt="logo">
          </a>
          <a href="javascript:void(0);" class="layout-menu-toggle menu-link ms-auto d-xl-none">
            <i class="bx bx-chevron-left"></i>
          </a>
        </div>

        <ul class="menu-inner py-1">
          <li class="menu-item {{ request()->routeIs('university.dashboard') ? 'active' : '' }}">
            <a href="{{ route('university.dashboard') }}" class="menu-link">
              <i class="fas fa-layer-group"></i>
              <div>Dashboard</div>
            </a>
          </li>

          <li class="menu-item {{ request()->routeIs('university.subUniversity.list') ? 'active' : '' }}">
            <a href="{{ route('university.subUniversity.list') }}" class="menu-link">
              <i class="fa fa-university"></i>
              <div>Manage Sub-University Admins</div>
            </a>
          </li>

          <li class="menu-item {{ request()->routeIs('university.course.add') ? 'active' : '' }}">
            <a href="{{ route('university.course.add') }}" class="menu-link">
              <i class="fa fa-graduation-cap"></i>
              <div>University Courses</div>
            </a>
          </li>

          <li class="menu-item {{ request()->routeIs('university.sport.list') ? 'active' : '' }}">
            <a href="{{ route('university.sport.list') }}" class="menu-link">
              <i class='fas fa-futbol'></i>
              <div>Manage Sports</div>
            </a>
          </li>

          <li class="menu-item {{ request()->routeIs('university.mentor.list') ? 'active' : '' }}">
            <a href="{{ route('university.mentor.list') }}" class="menu-link">
              <i class="fa fa-user" aria-hidden="true"></i>
              <div>Manage Mentors (Coaches)</div>
            </a>
          </li>

          <li class="menu-item {{ request()->routeIs('university.scholarship.list') ? 'active' : '' }}">
            <a href="{{ route('university.scholarship.list') }}" class="menu-link">
          <i class="fa fa-user-graduate"></i> 
              <div>Manage Scholarships</div>
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
                  <div class="d-flex align-items-center gap-2">
                    <div class="avatar avatar-online">
                      <img src="{{ Auth::user()->image
  ? asset('university_assets/images/' . Auth::user()->image)
  : asset('university_assets/assets/img/avatars/1.png') }}" class="w-px-40 h-auto rounded-circle">
                    </div>
                    <div class="admin-info text-start">
                      <div class="admin-name">
                        {{ auth()->user()->name ?? 'Admin' }}
                      </div>
                      <div class="admin-role">
                        University Admin
                      </div>
                    </div>

                    <!-- Chevron -->
                    <i class="fas fa-chevron-down admin-chevron"></i>
                  </div>
                </a>

                <ul class="dropdown-menu dropdown-menu-end">
                  {{-- <li class="dropdown-item-text">
                    <strong>{{ auth()->user()->name ?? 'Admin' }}</strong>
                  </li>
                  <li>
                    <div class="dropdown-divider"></div>
                  </li> --}}
                  <li>
                    <a class="dropdown-item" href="{{ route('university.profile.view') }}">
                      <i class="fas fa-user"></i> My Profile
                    </a>
                  </li>
                  <li>
                    <div class="dropdown-divider"></div>
                  </li>
                  <li>
                    <a class="dropdown-item" href="{{ route('university.deactivateView') }}">
                      <i class="fas fa-user"></i> Deactivate Account
                    </a>
                  </li>
                  <li>
                    <div class="dropdown-divider"></div>
                  </li>
                  <li>
                    <a class="dropdown-item" href="{{ route('university.logout') }}">
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

          <footer class="content-footer footer bg-footer-theme text-end px-4 py-2">
            © {{ date('Y') }} 
              Alumni India. Powered by<a href="https://www.banttech.com/" target="_blank" class="text-decoration-none"> <b style="color: #fff;">Banttech</b>
            </a>
          </footer>
        </div>
        <!-- ================= /CONTENT ================= -->

      </div>
    </div>
  </div>

  <!-- JS -->
  <!-- <script src="{{ asset('university_assets/assets/vendor/libs/jquery/jquery.js') }}"></script> -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="{{ asset('university_assets/assets/vendor/js/bootstrap.js') }}"></script>
  <script src="{{ asset('university_assets/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
  <script src="{{ asset('university_assets/assets/vendor/js/menu.js') }}"></script>
  <script src="{{ asset('university_assets/assets/js/main.js') }}"></script>

  @stack('scripts')
</body>

</html>