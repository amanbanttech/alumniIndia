@extends('layout.frontend.app')

@section('content')



    <!-- ═══ Modal Overlay ═══ -->
    <div class="ea-overlay" id="ea-overlay" role="dialog" aria-modal="true" aria-label="Early Access Registration">

        <div class="ea-modal" id="ea-modal">


            <div class="ea-modal__header">
                <div class="ea-modal__logo">
                    <div class="ea-modal__logo-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.2">
                            <polygon
                                points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
                        </svg>
                    </div>
                    <span class="ea-modal__logo-text">Unlock Early Access</span>
                </div>

                <button class="ea-modal__close" id="ea-close-modal" aria-label="Close">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <line x1="18" y1="6" x2="6" y2="18" />
                        <line x1="6" y1="6" x2="18" y2="18" />
                    </svg>
                </button>
            </div>


            <div class="ea-modal__body">


                <div class="ea-steps" id="ea-steps">
                    <div class="ea-step ea-step--active" id="ea-step-1">
                        <div class="ea-step__dot">1</div>
                        <span class="ea-step__label">Details</span>
                    </div>
                    <div class="ea-step" id="ea-step-2">
                        <div class="ea-step__dot">2</div>
                        <span class="ea-step__label">Verify</span>
                    </div>
                    <div class="ea-step" id="ea-step-3">
                        <div class="ea-step__dot">✓</div>
                        <span class="ea-step__label">Done!</span>
                    </div>
                </div>


                <div class="ea-panel ea-panel--active" id="ea-panel-form">

                    <div class="ea-field">
                        <label class="ea-field__label" for="ea-name">
                            <i class="fas fa-user"></i>
                            Full Name
                        </label>
                        <input class="ea-field__input" id="ea-name" type="text" placeholder="Enter your name"
                            autocomplete="name" />
                    </div>

                    <div class="ea-field">
                        <label class="ea-field__label" for="ea-phone">
                            <i class="fas fa-phone"></i> Mobile Number
                        </label>
                        <div class="ea-field__phone-wrap">
                            <span class="ea-field__country-code">🇮🇳 +91</span>
                            <input class="ea-field__phone-input" id="ea-phone" type="tel"
                                placeholder="Enter your mobile number" maxlength="10" inputmode="numeric" />
                        </div>
                    </div>

                    <div class="ea-field">
                        <label class="ea-field__label" for="ea-role">
                            <i class="fas fa-user-tag"></i>
                            Role
                        </label>
                        <div class="ea-field__select-wrap">
                            <select class="ea-field__select" id="ea-role">
                                <option value="" disabled selected>Select your role</option>
                                <option value="alumni">Alumni</option>
                                <option value="athlete">Athlete</option>
                                <option value="student">Student</option>
                            </select>
                        </div>
                    </div>

                    <button class="ea-btn-primary" id="ea-send-otp-btn">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.2">
                            <path d="M22 2L11 13" />
                            <path d="M22 2L15 22l-4-9-9-4 20-7z" />
                        </svg>
                        Send OTP
                    </button>
                </div>


                <div class="ea-panel" id="ea-panel-otp">

                    <div class="ea-otp__info">
                        <div class="ea-otp__info-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.2">
                                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
                            </svg>
                        </div>
                        <div class="ea-otp__info-text">
                            <strong>OTP Sent!</strong>
                            We've sent a 6-digit code to <span id="ea-phone-display">+91 XXXXXXX123</span>
                        </div>
                    </div>

                    <div class="ea-otp__boxes">
                        <input class="ea-otp__box" type="text" maxlength="1" inputmode="numeric" pattern="[0-9]"
                            id="ea-otp-0" aria-label="OTP digit 1" />
                        <input class="ea-otp__box" type="text" maxlength="1" inputmode="numeric" pattern="[0-9]"
                            id="ea-otp-1" aria-label="OTP digit 2" />
                        <input class="ea-otp__box" type="text" maxlength="1" inputmode="numeric" pattern="[0-9]"
                            id="ea-otp-2" aria-label="OTP digit 3" />
                        <input class="ea-otp__box" type="text" maxlength="1" inputmode="numeric" pattern="[0-9]"
                            id="ea-otp-3" aria-label="OTP digit 4" />
                        <input class="ea-otp__box" type="text" maxlength="1" inputmode="numeric" pattern="[0-9]"
                            id="ea-otp-4" aria-label="OTP digit 5" />
                        <input class="ea-otp__box" type="text" maxlength="1" inputmode="numeric" pattern="[0-9]"
                            id="ea-otp-5" aria-label="OTP digit 6" />
                    </div>

                    <p class="ea-otp__resend">
                        Didn't receive? &nbsp;
                        <span id="ea-resend-timer-wrap">Resend in <span class="ea-otp__resend-timer"
                                id="ea-timer">30</span>s</span>
                        <button class="ea-otp__resend-btn" id="ea-resend-btn">Resend OTP</button>
                    </p>

                    <button class="ea-btn-primary" id="ea-verify-btn">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.2">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                            <polyline points="22 4 12 14.01 9 11.01" />
                        </svg>
                        Verify &amp; Continue
                    </button>
                </div>


                <div class="ea-panel" id="ea-panel-success">
                    <div class="ea-success">
                        <div class="ea-success__icon">
                            <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5">
                                <polyline points="20 6 9 17 4 12" />
                            </svg>
                        </div>
                        <h3 class="ea-success__title">Congratulations!!</h3>
                        <p class="ea-success__text">Welcome to the Athlete Portal early access. We'll notify you as soon
                            as
                            your spot is confirmed.</p>
                    </div>
                </div>

            </div>
        </div>
    </div>






    <section class="hero-banner">
        <div class="div-imag-ring">
            <img src="{{ asset('frontend_assets/assets/images/club-success-bg-circle.svg') }}" alt="circle">
        </div>
        <div class="container-fluid">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-10">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-md-6">
                            <div class="div-image-haedis">
                                <h1 class="hero-heading">Connecting Talent, Opportunity & Community
                                </h1>
                                <p>Designed for alumni, athletes, students, and universities to collaborate, support,
                                    and grow together.

                                </p>
                                <a href="#" class="cta-button cta-button-shine" id="ea-open-modal" aria-haspopup="dialog">
                                    <i class="fas fa-rocket"></i>
                                    Unlock Early Access to the App
                                </a>
                                <p class="be-amoung">Be among the first to explore scholarships, mentorship, <br> and
                                    athlete
                                    opportunities.
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="div-img-mobile">
                                <img src="{{ asset('frontend_assets/assets/images/alumnis.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="div-third-parts">
        <div class="container-sections">
            <div class="content-section">
                <div class="badge">
                    <span class="badge-icon"><i class="fas fa-running"></i></span>
                    Next Gen Sports Network
                </div>

                <h2>Where Alumni, Athletes & Opportunities Connect.</h2>

                <p class="description">
                    A unified platform to discover scholarships, mentor emerging talent, support university initiatives,
                    and showcase
                    athletes through short-form video—designed to create real impact and unlock opportunities.
                </p>

                <a href="{{ route('frontend.about') }}" class="learn-more">Discover Opportunities</a>
            </div>

            <div class="preview-section">
                <img src="{{ asset('frontend_assets/assets/images/athletes-videos.png') }}" alt="Opportunities">

            </div>
        </div>
    </section>



    <div class="curved-section">
        <div class="curve-bg"></div>
        <div class="hero-content">
            <h2 class="common-sections">One App. Four Communities. <br> Infinite Possibilities.</h2>
            <p>Alumni Connect brings alumni, students, athletes, and universities <br> together in one powerful
                ecosystem.


            </p>
            <div class="features">
                <div class="item">
                    <span class="icon"><i class="fas fa-running"></i></span>
                    <p>Athletes</p>
                </div>

                <div class="item">
                    <span class="icon"><i class="fas fa-users"></i></span>
                    <p>Alumni</p>
                </div>

                <div class="item">
                    <span class="icon"><i class="fas fa-university"></i></span>
                    <p>Universities</p>
                </div>
                <div class="item">
                    <span class="icon"><i class="fas fa-user"></i></span>
                    <p>Students</p>
                </div>
            </div>
        </div>
    </div>


    <div class="sticky-container">
        <div class="sticky-wrapper">
            <div class="left-content">
                <div class="section-item" data-section="1">
                    <div class="section-label"><i class="fas fa-running"></i>ATHLETES</div>
                    <h2 class="section-title">Unlock Opportunities. Get Discovered. Build Your Future.</h2>
                    <p class="section-description">
                        A dedicated platform built for athletes to grow beyond the field. Discover athletic scholarship
                        programs, connect with
                        experienced mentors, and explore top universities actively looking for talent. Showcase your
                        skills by uploading short
                        sports videos on our platform and get noticed by university coaches and recruiters.
                        <br>From representation to career guidance, we help you turn your performance into real
                        opportunities.

                    </p>
                    <div class="section-stat">
                        <span class="stat-number">80%
                        </span>
                        <span class="stat-label">of talented athletes miss scholarship and career opportunities due to
                            lack of visibility and right guidance.
                        </span>

                    </div>
                    <a href="#" class="learn-more-service">Get Discovered</a>

                </div>

                <div class="section-item" data-section="2">
                    <div class="section-label"><i class="fas fa-users"></i></i>ALUMNI</div>
                    <h2 class="section-title">Stay Connected. Give Back. Create Impact.</h2>
                    <p class="section-description">
                        A dedicated space for alumni to mentor the next generation, contribute to university
                        initiatives, participate in events,
                        and stay updated with everything happening at their alma mater.

                    </p>
                    <div class="section-stat">
                        <span class="stat-number">75%</span>
                        <span class="stat-label">of students never get the guidance they need—because those who could
                            help never get the platform to give back.</span>

                    </div><a href="#" class="learn-more-service">Give Back & Connect</a>
                </div>

                <div class="section-item" data-section="3">
                    <div class="section-label"><i class="fas fa-university"></i>UNIVERSITY</div>
                    <h2 class="section-title">Manage Talent. Maximize Impact. Drive Growth.
                    </h2>
                    <p class="section-description">
                        A powerful platform for universities to manage donation campaigns, discover and recruit skilled
                        students for
                        scholarships, explore athlete talent through short-form videos, and efficiently manage coaches,
                        mentees, scholarships,
                        and events—all in one place.

                    </p>
                    <div class="section-stat">
                        <span class="stat-number">85%</span>
                        <span class="stat-label">of talented students and athletes remain undiscovered—while
                            universities struggle to find and manage the right talent
                            efficiently.
                        </span>

                    </div><a href="{{ route('university.details') }}" class="learn-more-service">Manage & Grow Your Network</a>
                </div>

                <div class="section-item" data-section="4">
                    <div class="section-label"><i class="fas fa-user"></i>STUDENTS</div>
                    <h2 class="section-title">Explore, Learn & Unlock Opportunities.
                    </h2>
                    <p class="section-description">
                        A dynamic platform for students to discover athlete videos, showcase their own talent, connect
                        with mentors, explore
                        scholarships, and participate in events—helping them grow, learn, and unlock real opportunities.

                    </p>
                    <div class="section-stat">
                        <span class="stat-number">70%</span>
                        <span class="stat-label">of students miss out on opportunities—not due to lack of talent, but
                            lack of awareness, guidance, and the right platform
                            to showcase themselves.
                        </span>

                    </div><a href="#" class="learn-more-service">Start Exploring</a>
                </div>

            </div>


            <div class="right-sticky">
                <div class="right-images">
                    <div class="bg-shape shape-1" data-section="1"></div>
                    <div class="bg-shape shape-2" data-section="2"></div>
                    <div class="bg-shape shape-3" data-section="3"></div>
                    <div class="bg-shape shape-4" data-section="4"></div>

                    <div class="image-item" data-section="1">
                        <img src="{{ asset('frontend_assets/assets/images/athlete-showcase.png') }}" alt="ATHLETES">
                    </div>

                    <div class="image-item" data-section="2">
                        <img src="{{ asset('frontend_assets/assets/images/alumni-program.png') }}" alt="ALUMNI">
                    </div>

                    <div class="image-item" data-section="3">
                        <img src="{{ asset('frontend_assets/assets/images/university-connects.png') }}" alt="UNIVERSITY">
                    </div>
                    <div class="image-item" data-section="4">
                        <img src="{{ asset('frontend_assets/assets/images/donation-unlock.png') }}" alt="STUDENTS">
                    </div>
                </div>
            </div>
        </div>
        <div class="sticky-mobile">
            <div class="wrapper">
                <div class="carousel">
                    <div>
                        <div class="section-item" data-section="1">
                            <div class="section-label"><i class="fas fa-running"></i>ATHLETES</div>
                            <h2 class="section-title">Unlock Opportunities. Get Discovered. Build Your Future.</h2>
                            <p class="section-description">
                                A dedicated platform built for athletes to grow beyond the field. Discover athletic
                                scholarship
                                programs, connect with
                                experienced mentors, and explore top universities actively looking for talent. Showcase
                                your
                                skills by uploading short
                                sports videos on our platform and get noticed by university coaches and recruiters.
                                <br>From representation to career guidance, we help you turn your performance into real
                                opportunities.

                            </p>
                            <div class="section-stat">
                                <span class="stat-number">80%
                                </span>
                                <span class="stat-label">of talented athletes miss scholarship and career opportunities
                                    due to
                                    lack of visibility and right guidance.
                                </span>

                            </div>
                            <a href="#" class="learn-more-service">Get Discovereds</a>

                        </div>
                        <img src="{{ asset('frontend_assets/assets/images/athlete-showcase.png') }}" alt="ATHLETES">
                    </div>
                    <div>
                        <div class="section-item" data-section="2">
                            <div class="section-label"><i class="fas fa-users"></i></i>ALUMNI</div>
                            <h2 class="section-title">Stay Connected. Give Back. Create Impact.</h2>
                            <p class="section-description">
                                A dedicated space for alumni to mentor the next generation, contribute to university
                                initiatives, participate in events,
                                and stay updated with everything happening at their alma mater.

                            </p>
                            <div class="section-stat">
                                <span class="stat-number">75%</span>
                                <span class="stat-label">of students never get the guidance they need—because those who
                                    could
                                    help never get the platform to give back.</span>

                            </div><a href="#" class="learn-more-service">Give Back & Connect</a>
                        </div>

                        <img src="{{ asset('frontend_assets/assets/images/alumni-program.png') }}" alt="ALUMNI">
                    </div>
                    <div>
                        <div class="section-item" data-section="3">
                            <div class="section-label"><i class="fas fa-university"></i>UNIVERSITY</div>
                            <h2 class="section-title">Manage Talent. Maximize Impact. Drive Growth.
                            </h2>
                            <p class="section-description">
                                A powerful platform for universities to manage donation campaigns, discover and recruit
                                skilled
                                students for
                                scholarships, explore athlete talent through short-form videos, and efficiently manage
                                coaches,
                                mentees, scholarships,
                                and events—all in one place.

                            </p>
                            <div class="section-stat">
                                <span class="stat-number">85%</span>
                                <span class="stat-label">of talented students and athletes remain undiscovered—while
                                    universities struggle to find and manage the right talent
                                    efficiently.
                                </span>

                            </div><a href="{{ route('university.details') }}" class="learn-more-service">Manage & Grow Your
                                Network</a>
                        </div>
                        <img src="{{ asset('frontend_assets/assets/images/university-connects.png') }}" alt="UNIVERSITY">

                    </div>
                    <div>
                        <div class="section-item" data-section="4">
                            <div class="section-label"><i class="fas fa-user"></i>STUDENTS</div>
                            <h2 class="section-title">Explore, Learn & Unlock Opportunities.
                            </h2>
                            <p class="section-description">
                                A dynamic platform for students to discover athlete videos, showcase their own talent,
                                connect
                                with mentors, explore
                                scholarships, and participate in events—helping them grow, learn, and unlock real
                                opportunities.

                            </p>
                            <div class="section-stat">
                                <span class="stat-number">70%</span>
                                <span class="stat-label">of students miss out on opportunities—not due to lack of
                                    talent, but
                                    lack of awareness, guidance, and the right platform
                                    to showcase themselves.
                                </span>

                            </div><a href="#" class="learn-more-service">Start Exploring</a>
                        </div><img src="{{ asset('frontend_assets/assets/images/donation-unlock.png') }}" alt="STUDENTS">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="content-mobile-animated">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="div-animations-2">
                        <h2>Secure Your Athlete Future
                        </h2>
                        <p>All the tools you need to achieve your goals
                        </p>
                    </div>
                </div>
            </div>
            <div class="desktop-only">
                <div class="row ">
                    <div class="col-md-12">
                        <div class="scrollbar-container">
                            <div class="scroll-segment active"></div>
                            <div class="scroll-segment"></div>
                            <div class="scroll-segment"></div>
                            <div class="scroll-segment"></div>
                            <div class="scroll-segment"></div>
                        </div>

                        <div class="scroll-wrapper">

                            <div class="left-section">
                                <div class="list-block">
                                    <div class="list-item active" data-screen="1">
                                        <div class="com-sec-mobiles">
                                            <div class="afs-div"><i class="fas fa-user-circle"></i></div>
                                            <h3>Build Your Athlete Profile <br>
                                                <span>Create your digital athlete identity.</span>
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="list-item" data-screen="2">
                                        <div class="com-sec-mobiles">
                                            <div class="afs-div"><i class="fas fa-video"></i></div>
                                            <h3>Showcase Talent with Video Clips<br>
                                                <span>Upload your highlights. Let your skills speak.</span>
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="list-item" data-screen="3">
                                        <div class="com-sec-mobiles">
                                            <div class="afs-div">
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <h3>Boost Callback Score with Membership <br>
                                                <span>Increase visibility. Get noticed faster.</span>
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="list-item" data-screen="4">
                                        <div class="com-sec-mobiles">
                                            <div class="afs-div"><i class="fas fa-handshake"></i></div>
                                            <h3>Personal Mentor Match <br>
                                                <span>Guided growth with a mentor who understands your sport.</span>
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="list-item" data-screen="5">
                                        <div class="com-sec-mobiles">
                                            <div class="afs-div"><i class="fas fa-trophy"></i></div>
                                            <h3>Get University Sponsorships <br>
                                                <span>Unlock real opportunities from verified institutions.</span>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="right-section">
                                <div class="iphone-frame">

                                    <div class="screen-area">

                                        <div class="screen sms-screen active" data-index="1">
                                            <img src="{{ asset('frontend_assets/assets/images/athlete-buil.png') }}" alt="">
                                        </div>

                                        <div class="screen call-screen" data-index="2">
                                            <img src="{{ asset('frontend_assets/assets/images/showcase-talent.png') }}"
                                                alt="">
                                        </div>

                                        <div class="screen email-screen" data-index="3">
                                            <img src="{{ asset('frontend_assets/assets/images/boost-callback.png') }}"
                                                alt="">
                                        </div>

                                        <div class="screen slack-screen" data-index="4">
                                            <img src="{{ asset('frontend_assets/assets/images/alumni-connect-2.png') }}"
                                                alt="">
                                        </div>
                                        <div class="screen slack-screen" data-index="5">
                                            <img src="{{ asset('frontend_assets/assets/images/universyt-page.png') }}"
                                                alt="">
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


        </div>

        <div class="mobile-slider">

            <div class="mobile-content">
                <div class="slide active">
                    <div class="">
                        <div class="com-sec-mobiles">
                            <div class="afs-div"><i class="fas fa-user-circle"></i></div>
                            <h3>Build Your Athlete Profile <br>
                                <span>Create your digital athlete identity.</span>
                            </h3>
                        </div>
                    </div>
                </div>

                <div class="slide">
                    <div class="">
                        <div class="com-sec-mobiles">
                            <div class="afs-div"><i class="fas fa-video"></i></div>
                            <h3>Showcase Talent with Video Clips<br>
                                <span>Upload your highlights. Let your skills speak.</span>
                            </h3>
                        </div>
                    </div>
                </div>

                <div class="slide">
                    <div class="">
                        <div class="com-sec-mobiles">
                            <div class="afs-div">
                                <i class="fas fa-star"></i>
                            </div>
                            <h3>Boost Callback Score with Membership <br>
                                <span>Increase visibility. Get noticed faster.</span>
                            </h3>
                        </div>
                    </div>
                </div>

                <div class="slide">
                    <div class="">
                        <div class="com-sec-mobiles">
                            <div class="afs-div"><i class="fas fa-handshake"></i></div>
                            <h3>Personal Mentor Match <br>
                                <span>Guided growth with a mentor who understands your sport.</span>
                            </h3>
                        </div>
                    </div>
                </div>

                <div class="slide">
                    <div class="">
                        <div class="com-sec-mobiles">
                            <div class="afs-div"><i class="fas fa-trophy"></i></div>
                            <h3>Get University Sponsorships <br>
                                <span>Unlock real opportunities from verified institutions.</span>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- PHONE SCREEN -->
            <div class="mobile-screen">
                <img src="{{ asset('frontend_assets/assets/images/athlete-profile.png') }}" class="screens active">
                <img src="{{ asset('frontend_assets/assets/images/showcase-talent-video.png') }}" class="screens">
                <img src="{{ asset('frontend_assets/assets/images/score-call-back.png') }}" class="screens">
                <img src="{{ asset('frontend_assets/assets/images/mentor-program.png') }}" class="screens">
                <img src="{{ asset('frontend_assets/assets/images/university-sponsorship.png') }}" class="screens">
            </div>

            <!-- CONTROLS -->
            <div class="mobile-controls">
                <button id="prevBtn"><i class="fas fa-arrow-left"></i></button>
                <div class="dots">
                    <span class="dot active"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                </div>
                <button id="nextBtn"><i class="fas fa-arrow-right"></i></button>
            </div>

            <!-- COUNTER -->
            <div class="counter">1 / 5</div>

        </div>

    </section>


    <section class="game-section">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <h2 class="common-sections">Discover, Connect & Empower <br> the Future of Talent
                    </h2>
                    <h4 class="whree">Where Talent Meets Opportunity & Growth
                    </h4>
                    <br><br>
                    <div class="custom-carousel" role="list">
                        <div class="game-cards active-card" role="listitem" tabindex="0"
                            style="background-image:url({{ asset('frontend_assets/assets/images/indian-athlete.jpg') }});">
                            <div class="item-desc">
                                <h3><i class="fas fa-running"></i>Athletes</h3>
                                <p>Showcase your skills and unlock opportunities with top universities.</p>
                            </div>
                        </div>

                        <div class="game-cards" role="listitem" tabindex="0"
                            style="background-image:url({{ asset('frontend_assets/assets/images/alumni-indian.avif') }});">
                            <div class="item-desc">
                                <h3><i class="fas fa-users"></i>Alumni</h3>
                                <p>Support, mentor, and make a lasting impact on future generations.
                                </p>
                            </div>
                        </div>

                        <div class="game-cards" role="listitem" tabindex="0"
                            style="background-image:url({{ asset('frontend_assets/assets/images/india-university.jfif') }});">
                            <div class="item-desc">
                                <h3><i class="fas fa-university"></i>College / University</h3>
                                <p>Find the right talent and manage your programs seamlessly.</p>
                            </div>
                        </div>

                        <div class="game-cards" role="listitem" tabindex="0"
                            style="background-image:url({{ asset('frontend_assets/assets/images/student-indian.jpg') }});">
                            <div class="item-desc">
                                <h3><i class="fas fa-user"></i>Existing Students</h3>
                                <p>Discover, learn, and grow with the right opportunities and guidance.
                                </p>
                            </div>
                        </div>

                    </div>
                    <div class="button-wrapper">
                        <a href="#"><button class="btn-custom btn-primary">Get Started</button></a>
                        <a href="#"> <button class="btn-custom btn-outline">Find Your Subscription</button></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="custom-wave-section">
        <div class="div-wave-main">
            <div class="div-wave-one color-white"></div>
            <div class="div-wave-two color-aubergine"></div>
        </div>
        <h2 class="common-sections text-white">We’re in the business of empowering <br>education & sports communities.
        </h2>
        <div class="custom-wave-section__stats">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="custom-wave-section__stat">
                            <h3 class="custom-wave-section__stat-number">150+

                            </h3>
                            <p class="custom-wave-section__stat-text">Universities under one umbrella —
                                partnering to discover talent and offer opportunities

                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="custom-wave-section__stat">
                            <h3 class="custom-wave-section__stat-number">92%
                            </h3>
                            <p class="custom-wave-section__stat-text">of athletes say Alumni Connect helps them
                                showcase their talent more effectively
                                and secure the right scholarship


                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="custom-wave-section__stat">
                            <h3 class="custom-wave-section__stat-number">87%
                            </h3>
                            <p class="custom-wave-section__stat-text">of alumni report feeling more connected,
                                engaged, and able to support their alma mater
                                through Alumni Connect


                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="faq-section">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-9 width-faqs">
                    <h2 class="common-sections">Questions? We’ve Got Answers</h2>
                    <p class="com-ns">Find answers to common questions about our platform, services, and how we can help
                        you achieve
                        your goals.
                    </p>
                    <div class="row">
                        <div class="col-lg-6 mb-4 mb-lg-0">
                            <div class="faq-content">
                                <div class="faq-accordion">

                                    <div class="faq-item">
                                        <button class="faq-question active" onclick="toggleFaq(this)">
                                            <span>What is the purpose of this Alumni & Athlete app?</span>
                                            <span class="faq-icon"><i class="fas fa-arrow-right"></i></span>
                                        </button>
                                        <div class="faq-answer show">
                                            <p>The app connects students, athletes, and alumni to discover
                                                opportunities, build networks,
                                                and access career and community support—all in one place.</p>
                                        </div>
                                    </div>

                                    <div class="faq-item">
                                        <button class="faq-question" onclick="toggleFaq(this)">
                                            <span>Who can join the platform?</span>
                                            <span class="faq-icon"><i class="fas fa-arrow-right"></i></span>
                                        </button>
                                        <div class="faq-answer">
                                            <p>Students, athletes, alumni, coaches, and institutions can join. The
                                                platform is designed
                                                for anyone looking to connect, grow, or explore opportunities.</p>
                                        </div>
                                    </div>

                                    <div class="faq-item">
                                        <button class="faq-question" onclick="toggleFaq(this)">
                                            <span>How does the platform help student-athletes?</span>
                                            <span class="faq-icon"><i class="fas fa-arrow-right"></i></span>
                                        </button>
                                        <div class="faq-answer">
                                            <p>Athletes can showcase achievements, get discovered by universities,
                                                connect with coaches,
                                                and receive guidance on scholarships, recruitment, and future
                                                opportunities.</p>
                                        </div>
                                    </div>

                                    <div class="faq-item">
                                        <button class="faq-question" onclick="toggleFaq(this)">
                                            <span>Can I connect with alumni from my college?</span>
                                            <span class="faq-icon"><i class="fas fa-arrow-right"></i></span>
                                        </button>
                                        <div class="faq-answer">
                                            <p>Yes, the app allows you to join institution-based communities where you
                                                can connect with
                                                alumni, mentors, and other professionals for guidance and networking.
                                            </p>
                                        </div>
                                    </div>

                                    <div class="faq-item">
                                        <button class="faq-question" onclick="toggleFaq(this)">
                                            <span>Is my profile and personal data secure?</span>
                                            <span class="faq-icon"><i class="fas fa-arrow-right"></i></span>
                                        </button>
                                        <div class="faq-answer">
                                            <p>Your data is protected with secure encryption and privacy controls. Only
                                                authorized users
                                                and institutions can view your information.</p>
                                        </div>
                                    </div>

                                    <div class="faq-item">
                                        <button class="faq-question" onclick="toggleFaq(this)">
                                            <span>Do I need to pay to use the app?</span>
                                            <span class="faq-icon"><i class="fas fa-arrow-right"></i></span>
                                        </button>
                                        <div class="faq-answer">
                                            <p>The core features such as profile creation, networking, and community
                                                access are free.
                                                Additional premium tools may be offered as optional upgrades.</p>
                                        </div>
                                    </div>

                                </div>

                                <div class="decorative-line"></div>
                            </div>

                        </div>
                        <div class="col-lg-6">
                            <div class="faq-image">
                                <img src="{{ asset('frontend_assets/assets/images/faqs.png') }}" alt="alumni">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <section class="reviews-sections">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="common-sections">What Student-Athletes Say About Us</h2>
                    <p class="com-ns">Real stories from athletes who trusted our guidance and reached top colleges
                        across the country.
                    </p>
                </div>
            </div>
        </div>
        <div class="splide" role="group">
            <div class="splide__track" id="splide-track">
                <ul class="splide__list">
                    <li class="splide__slide">
                        <table cellpadding="0" cellspacing="10">
                            <tbody>
                                <tr>
                                    <td colspan="2" class="table-tops"><img decoding="async" loading="lazy"
                                            src="{{ asset('frontend_assets/assets/images/review-one.jpg') }}"
                                            alt="Testimony Image 1" title="Testimony Image 1">
                                    </td>
                                    <td rowspan="2" class="table-tmidks"><img decoding="async" loading="lazy"
                                            src="{{ asset('frontend_assets/assets/images/athlete-review-3.avif') }}"
                                            alt="Testimony Image 2" title="Testimony Image 2">
                                    </td>
                                </tr>
                                <tr>
                                    <td rowspan="2" class="table-tmidks table-2-sec">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod
                                            tempor incididunt ut labore et dolore magna
                                            aliqua.<br>
                                            <strong>Batch 2025<br>
                                                Football</strong>
                                        </p>
                                    </td>
                                    <td class="square table-2-sec">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod
                                            tempor incididunt ut labore et dolore magna
                                            aliqua.<br>
                                            <strong>Batch 2028<br>
                                                Softball</strong>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="table-tops"><img decoding="async" loading="lazy"
                                            src="{{ asset('frontend_assets/assets/images/athlete-review-2.avif') }}"
                                            alt="Testimony Image 3" title="Testimony Image 3">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </li>

                    <li class="splide__slide">
                        <table cellpadding="0" cellspacing="10">
                            <tbody>
                                <tr>
                                    <td colspan="2" class="table-tops"><img decoding="async" loading="lazy"
                                            src="{{ asset('frontend_assets/assets/images/review-one.jpg') }}"
                                            alt="Testimony Image 1" title="Testimony Image 1">
                                    </td>
                                    <td rowspan="2" class="table-tmidks"><img decoding="async" loading="lazy"
                                            src="{{ asset('frontend_assets/assets/images/athlete-review-3.avif') }}"
                                            alt="Testimony Image 2" title="Testimony Image 2">
                                    </td>
                                </tr>
                                <tr>
                                    <td rowspan="2" class="table-tmidks table-2-sec">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod
                                            tempor incididunt ut labore et dolore magna
                                            aliqua.<br>
                                            <strong>Batch 2025<br>
                                                Football</strong>
                                        </p>
                                    </td>
                                    <td class="square table-2-sec">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod
                                            tempor incididunt ut labore et dolore magna
                                            aliqua.<br>
                                            <strong>Batch 2028<br>
                                                Softball</strong>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="table-tops"><img decoding="async" loading="lazy"
                                            src="{{ asset('frontend_assets/assets/images/athlete-review-2.avif') }}"
                                            alt="Testimony Image 3" title="Testimony Image 3">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </li>

                    <li class="splide__slide">
                        <table cellpadding="0" cellspacing="10">
                            <tbody>
                                <tr>
                                    <td colspan="2" class="table-tops"><img decoding="async" loading="lazy"
                                            src="{{ asset('frontend_assets/assets/images/review-one.jpg') }}"
                                            alt="Testimony Image 1" title="Testimony Image 1">
                                    </td>
                                    <td rowspan="2" class="table-tmidks"><img decoding="async" loading="lazy"
                                            src="{{ asset('frontend_assets/assets/images/athlete-review-3.avif') }}"
                                            alt="Testimony Image 2" title="Testimony Image 2">
                                    </td>
                                </tr>
                                <tr>
                                    <td rowspan="2" class="table-tmidks table-2-sec">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod
                                            tempor incididunt ut labore et dolore magna
                                            aliqua.<br>
                                            <strong>Batch 2025<br>
                                                Football</strong>
                                        </p>
                                    </td>
                                    <td class="square table-2-sec">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod
                                            tempor incididunt ut labore et dolore magna
                                            aliqua.<br>
                                            <strong>Batch 2028<br>
                                                Softball</strong>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="table-tops"><img decoding="async" loading="lazy"
                                            src="{{ asset('frontend_assets/assets/images/athlete-review-2.avif') }}"
                                            alt="Testimony Image 3" title="Testimony Image 3">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </li>

                    <li class="splide__slide">
                        <table cellpadding="0" cellspacing="10">
                            <tbody>
                                <tr>
                                    <td colspan="2" class="table-tops"><img decoding="async" loading="lazy"
                                            src="{{ asset('frontend_assets/assets/images/review-one.jpg') }}"
                                            alt="Testimony Image 1" title="Testimony Image 1">
                                    </td>
                                    <td rowspan="2" class="table-tmidks"><img decoding="async" loading="lazy"
                                            src="{{ asset('frontend_assets/assets/images/athlete-review-3.avif') }}"
                                            alt="Testimony Image 2" title="Testimony Image 2">
                                    </td>
                                </tr>
                                <tr>
                                    <td rowspan="2" class="table-tmidks table-2-sec">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod
                                            tempor incididunt ut labore et dolore magna
                                            aliqua.<br>
                                            <strong>Batch 2025<br>
                                                Football</strong>
                                        </p>
                                    </td>
                                    <td class="square table-2-sec">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod
                                            tempor incididunt ut labore et dolore magna
                                            aliqua.<br>
                                            <strong>Batch 2028<br>
                                                Softball</strong>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="table-tops"><img decoding="async" loading="lazy"
                                            src="{{ asset('frontend_assets/assets/images/athlete-review-2.avif') }}"
                                            alt="Testimony Image 3" title="Testimony Image 3">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </li>
                </ul>
            </div>

        </div>
    </section>


    <section class="universities-section">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-lg-4 col-md-12 mb-5 width-customs">
                            <h2 class="universities-title mt-3">
                                Building Stronger University Communities

                            </h2>

                            <p class="universities-desc mt-3">
                                Bring students, alumni, and institutions together to collaborate, engage, and create
                                meaningful opportunities—all in one
                                connected platform.

                            </p>

                            <a href="{{ route('frontend.finduniversity') }}" class="btn universities-btn mt-4">
                                Explore the Network <i class="fa-solid fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                        <div class="col-lg-8 col-md-12 width-customs">
                            <div class="universities-grid">

                                <div class="universities-item"><img
                                        src="{{ asset('frontend_assets/assets/images/logo-three.png') }}"
                                        alt="university-logo">
                                </div>
                                <div class="universities-item"><img
                                        src="{{ asset('frontend_assets/assets/images/logo-four.png') }}"
                                        alt="university-logo">
                                </div>
                                <div class="universities-item"><img
                                        src="{{ asset('frontend_assets/assets/images/logo-five.png') }}"
                                        alt="university-logo">
                                </div>
                                <div class="universities-item"><img
                                        src="{{ asset('frontend_assets/assets/images/logo-six.png') }}"
                                        alt="university-logo">
                                </div>
                                <div class="universities-item"><img
                                        src="{{ asset('frontend_assets/assets/images/logo-seven.png') }}"
                                        alt="university-logo">
                                </div>
                                <div class="universities-item"><img
                                        src="{{ asset('frontend_assets/assets/images/logo-eight.png') }}"
                                        alt="university-logo">
                                </div>
                                <div class="universities-item"><img
                                        src="{{ asset('frontend_assets/assets/images/logo-nine.png') }}"
                                        alt="university-logo">
                                </div>
                                <div class="universities-item"><img
                                        src="{{ asset('frontend_assets/assets/images/logo-ten.png') }}"
                                        alt="university-logo">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="download-apps">
        <div class="img-2d"><img src="{{ asset('frontend_assets/assets/images/mobile-3.png') }}" alt=""></div>
        <div class="container-fluid">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-4">
                </div>
                <div class="col-md-4 width-top-2">
                    <div class="content-download">
                        <h3>Coming Soon to <br> Google Play & App Store</h3>
                        <!-- <h3>Download the app for a seamless experience.</h3> -->
                        <div class="div-fls-downlaod-ap">
                            <a href="#" class="left-two"><img
                                    src="{{ asset('frontend_assets/assets/images/playstore.svg') }}" alt=""></a>
                            <a href="#" class="right-two"><img
                                    src="{{ asset('frontend_assets/assets/images/app-store.svg') }}" alt=""></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">

                    <div class="img-3d"><img src="{{ asset('frontend_assets/assets/images/rights.png') }}" alt=""></div>
                </div>
            </div>
        </div><img src="{{ asset('frontend_assets/assets/images/girls.png') }}" alt="" class="img-23s">
    </section>




    <!----mobile-frame-animationfor-mobile-->
    <script>
        document.addEventListener("DOMContentLoaded", function () {

            const slides = document.querySelectorAll(".slide");
            const screens = document.querySelectorAll(".mobile-screen img");
            const dots = document.querySelectorAll(".dot");
            const counter = document.querySelector(".counter");

            const nextBtn = document.getElementById("nextBtn");
            const prevBtn = document.getElementById("prevBtn");
            const slider = document.querySelector(".mobile-slider");

            let current = 0;

            // Safety check
            if (!slides.length || !screens.length || !nextBtn || !prevBtn) {
                console.warn("Slider elements not found");
                return;
            }

            function updateSlider(index) {
                slides.forEach((s, i) => s.classList.toggle("active", i === index));
                screens.forEach((img, i) => img.classList.toggle("active", i === index));

                if (dots.length) {
                    dots.forEach((d, i) => d.classList.toggle("active", i === index));
                }

                if (counter) {
                    counter.innerText = `${index + 1} / ${slides.length}`;
                }
            }

            // Arrow Controls
            nextBtn.addEventListener("click", () => {
                current = (current + 1) % slides.length;
                updateSlider(current);
            });

            prevBtn.addEventListener("click", () => {
                current = (current - 1 + slides.length) % slides.length;
                updateSlider(current);
            });

            // Swipe Support
            if (slider) {
                let startX = 0;

                slider.addEventListener("touchstart", e => {
                    startX = e.touches[0].clientX;
                });

                slider.addEventListener("touchend", e => {
                    let endX = e.changedTouches[0].clientX;

                    if (startX - endX > 50) {
                        nextBtn.click();
                    } else if (endX - startX > 50) {
                        prevBtn.click();
                    }
                });
            }

            // Initial Load
            updateSlider(current);

        });
    </script>


    <!---login-all-mobile-->
    <script>
        document.querySelectorAll('.for-mobile .login-link').forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                const dropdown = this.nextElementSibling;
                dropdown.classList.toggle('active');
            });
        });
    </script>
@endsection