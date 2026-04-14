<div class="header-container">
    <div class="logo-section for-desktop">
        <a href="{{ url('/') }}">
            <img src="{{ asset('frontend_assets/assets/images/logo-black.png') }}" alt="logo">
        </a>
    </div>

    <div class="menu-section">
        <!-- TOP BAR -->
        <div class="top-bar">
            <div class="div-one-socials"></div>

            <div class="for-desktop">
                <div class="top-right-links">
                    <a href="{{ route('frontend.about') }}">About Us</a>
                    <a href="{{ route('athlete.login') }}">#JoinAthletes</a>
                    <a href="{{ route('athlete.register.view') }}">#ProudToBeAlumni</a>
                    <a href="{{ route('frontend.contactus') }}">Help Desk</a>

                    <div class="login-dropdown-wrapper">
                        <a href="#" class="login-link">
                            Log In <i class="fas fa-chevron-down"></i>
                        </a>

                        <div class="login-dropdown">
                            <a href="#"><i class="fas fa-user"></i> Students</a>
                            <a href="#"><i class="fas fa-users"></i> Alumni</a>
                            <a href="{{ route('university.login') }}"><i class="fas fa-university"></i> Universities</a>
                            <a href="{{ route('athlete.login') }}"><i class="fas fa-running"></i> Athletes</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- MOBILE TOP -->
            <div class="for-mobile" style="width: 100%;">
                <div class="top-right-links">
                    <div class="div-mobile-access">
                        <a href="{{ route('frontend.contactus') }}">Help Desk</a>

                        <div class="login-dropdown-wrapper">
                            <a href="#" class="login-link">
                                Log In <i class="fas fa-chevron-down"></i>
                            </a>

                            <div class="login-dropdown">
                                <a href="#"><i class="fas fa-user"></i> Students</a>
                                <a href="#"><i class="fas fa-users"></i> Alumni</a>
                                <a href="#"><i class="fas fa-university"></i> Universities</a>
                                <a href="#"><i class="fas fa-running"></i> Athletes</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- NAVBAR -->
        <div class="div-desktop-new">

            <div class="logo-section for-mobile">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('frontend_assets/assets/images/logo-black.png') }}" alt="logo">
                </a>
            </div>

            <div class="nav-area">
                <div class="nav-content">

                    <button class="mobile-toggle" onclick="toggleMobileMenu()">
                        <i class="fas fa-bars"></i>
                    </button>

                    <ul class="main-nav" id="mainNav">

                        <li><a href="{{ route('frontend.index') }}">Home</a></li>

                        <!-- SERVICES -->
                        <li>
                            <a href="#">Services <i class="fas fa-chevron-down"></i></a>

                            <div class="mega-menu">
                                <div class="mega-menu-content">

                                    <!-- Alumni -->
                                    <div class="mega-card">
                                        <div class="mega-card-header">
                                            <div class="chevron-ads">
                                                <div class="mega-icon">
                                                    <i class="fas fa-graduation-cap"></i>
                                                </div>
                                                <h3 class="mega-card-title">Alumni Connect</h3>
                                            </div>
                                            <i class="fas fa-chevron-down"></i>
                                        </div>

                                        <ul class="mega-links">
                                            <li><a href="#">Register/Login</a></li>
                                            <li><a href="{{ route('frontend.mentorshipprogram') }}">Mentorship Program</a></li>
                                            <li><a href="{{ route('frontend.donation') }}">Donation</a></li>
                                            <li><a href="{{ route('frontend.scholarshipandevents') }}">Events</a></li>
                                            <li><a href="{{ route('frontend.finduniversity') }}">Find your University</a></li>
                                        </ul>
                                    </div>

                                    <!-- Students -->
                                    <div class="mega-card">
                                        <div class="mega-card-header">
                                            <div class="chevron-ads">
                                                <div class="mega-icon">
                                                    <i class="fas fa-running"></i>
                                                </div>
                                                <h3 class="mega-card-title">Students & Athletes</h3>
                                            </div>
                                            <i class="fas fa-chevron-down"></i>
                                        </div>

                                        <ul class="mega-links">
                                            <li><a href="#">Register/Log In</a></li>
                                            <li><a href="{{ route('frontend.scholarshipandevents') }}">Scholarship Programs</a></li>
                                            <li><a href="#">Find Mentor</a></li>
                                            <li><a href="{{ route('frontend.finduniversity') }}">Explore Universities</a></li>
                                        </ul>
                                    </div>

                                    <!-- Universities -->
                                    <div class="mega-card">
                                        <div class="mega-card-header">
                                            <div class="chevron-ads">
                                                <div class="mega-icon">
                                                    <i class="fas fa-university"></i>
                                                </div>
                                                <h3 class="mega-card-title">Universities & Colleges</h3>
                                            </div>
                                            <i class="fas fa-chevron-down"></i>
                                        </div>

                                        <ul class="mega-links">
                                            <li><a href="{{ route('university.login') }}">Log In</a></li>
                                            <li><a href="{{ route('frontend.donation') }}">Donation Campaigns</a></li>
                                            <li><a href="{{ route('frontend.scholarshipandevents') }}">Scholarships & Events</a></li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </li>

                        <!-- RESOURCES -->
                        <li>
                            <a href="#">Resources <i class="fas fa-chevron-down"></i></a>
                            <ul class="dropdown">
                                <li><a href="{{ route('frontend.workshop') }}">Explore Workshops</a></li>
                                <li><a href="{{ route('frontend.blog') }}">Blog</a></li>
                                <li><a href="#">Athletes Videos</a></li>
                                <li><a href="{{ url('scholarship-and-events') }}">Scholarships & Events</a></li>
                            </ul>
                        </li>

                        <li><a href="{{ url('donation-campaigns') }}">Donation Campaigns</a></li>
                        <li><a href="{{ url('scholarship-and-events') }}">Scholarship</a></li>

                        <!-- MOBILE LINKS -->
                        <li class="for-mobile"><a href="{{ url('about-us') }}">About Us</a></li>
                        <li class="for-mobile"><a href="{{ route('athlete.login') }}">#JoinAthletes</a></li>
                        <li class="for-mobile"><a href="{{ route('athlete.register.view') }}">#ProudToBeAlumni</a></li>

                    </ul>

                    <div class="search-box">
                        <a href="{{ url('contact-us') }}">
                            <button class="btn btn--snakeBorder">Join the Community</button>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>