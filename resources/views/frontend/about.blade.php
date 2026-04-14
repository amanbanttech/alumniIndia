@extends('layout.frontend.app')
@section('content')
    <section class="scholarship-hero about-us-alumni">
        <div class="hero-image"></div>
        <div class="container-fluid">
            <div class="hero-wrapper">
                <div class="hero-left"><img src="{{ asset('frontend_assets/assets/images/image-ovberlay.png') }}" alt="" class="image-common-overlays">
                    <h1>About Us</h1>
                    <div class="breadcrumb-content">
                        <a href="{{ route('frontend.index') }}">Home</a>
                        <span>»</span>
                        <span class="active">About Us</span>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="story-section">
        <div class="container-fluid">
            <div class="common-widthsections">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-6">
                        <img src="{{ asset('frontend_assets/assets/images/alumni-connect.png') }}" alt="">
                    </div>
                    <div class="col-md-6">

                        <h5 class="section-heading-com">Our Story</h5>
                        <h2 class="h2-common-alls ">Born from a <span>Simple</span> Belief</h2>
                        <p class="section-desc">AlumniIndia was born out of a vision to break down the walls between
                            education
                            and
                            opportunity. We saw students with potential but no platform, athletes with talent but no
                            visibility,
                            and
                            universities with resources but no unified network.</p>
                        <div class="story-milestones">
                            <div class="milestone">
                                <div class="milestone-icon"><i class="fas fa-lightbulb"></i></div>
                                <div>
                                    <h4>The Idea</h4>
                                    <p>Passionate educators and tech enthusiasts identified a critical gap — alumni
                                        were
                                        disconnected
                                        from their
                                        institutions after graduation.</p>
                                </div>
                            </div>
                            <div class="milestone">
                                <div class="milestone-icon"><i class="fas fa-rocket"></i></div>
                                <div>
                                    <h4>The Launch</h4>
                                    <p>AlumniIndia launched as India's first unified platform for alumni, athletes,
                                        students,
                                        and
                                        universities
                                        under one roof.</p>
                                </div>
                            </div>
                            <div class="milestone">
                                <div class="milestone-icon"><i class="fas fa-seedling"></i></div>
                                <div>
                                    <h4>The Growth</h4>
                                    <p>Today we serve 150+ universities and a growing network of mentors dedicated
                                        to
                                        shaping
                                        India's
                                        future.
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="mission-new-about">
        <div class="mission-header">
            <h5 class="section-heading-com text-white">Our Purpose</h5>
            <h2 class="h2-common-alls text-white">Mission, Vision &amp; <span>Promise</h2>
            <p class="section-desc text-white" style="margin:0 auto">Three pillars guide everything we build, every
                feature we
                ship,
                and every connection we foster.</p>
        </div>
        <div class="mv-grid">
            <div class="mv-card animate visible">
                <div class="mv-icon"><i class="fas fa-crosshairs"></i></div>
                <h3>Our Mission</h3>
                <p>To empower every student, athlete, and alumni in India by providing a unified digital platform that
                    creates real connections, real opportunities, and real growth — irrespective of institution or
                    geography.</p>
            </div>
            <div class="mv-card animate visible" style="transition-delay:.1s">
                <div class="mv-icon"><i class="fas fa-eye"></i></div>
                <h3>Our Vision</h3>
                <p>To become India's most trusted alumni-athlete-institution ecosystem — where talent meets opportunity,
                    mentors meet mentees, and universities stay connected with their communities forever.</p>
            </div>
            <div class="mv-card animate visible" style="transition-delay:.2s">
                <div class="mv-icon"><i class="fas fa-handshake"></i></div>
                <h3>Our Promise</h3>
                <p>We promise to always put our communities first — building transparent, inclusive, and impactful
                    technology that genuinely changes lives and makes higher education more accessible across India.</p>
            </div>
        </div>
    </section>






    <section class="communities">
        <div class="container-fluid">
            <div class="common-widthsections">
                <div class="row">
                    <div class="col-md-6">
                        <div class="div-one-about-s">
                            <h5 class="section-heading-com">Our Communities</h5>
                            <h2 class="h2-common-alls ">Four <span>Communities</span>, One Platform</h2>
                            <p class="section-desc">AlumniIndia is built for four distinct groups — each with unique
                                needs,
                                all
                                united
                                by a
                                shared purpose.</p>
                            <div class="comm-tabs">
                                <div class="comm-tab active" onclick="showTab('alumni',this)">
                                    <div class="tab-icon"><i class="fas fa-graduation-cap"></i></div>
                                    <div>
                                        <div class="tab-label">Alumni</div>
                                        <div class="tab-sub">Mentors &amp; Community Builders</div>
                                    </div>
                                    <i class="fas fa-chevron-right tab-arrow"></i>
                                </div>
                                <div class="comm-tab" onclick="showTab('athletes',this)">
                                    <div class="tab-icon"><i class="fas fa-person-running"></i></div>
                                    <div>
                                        <div class="tab-label">Athletes</div>
                                        <div class="tab-sub">Talent Seeking Spotlight</div>
                                    </div>
                                    <i class="fas fa-chevron-right tab-arrow"></i>
                                </div>
                                <div class="comm-tab" onclick="showTab('students',this)">
                                    <div class="tab-icon"><i class="fas fa-book"></i></div>
                                    <div>
                                        <div class="tab-label">Students</div>
                                        <div class="tab-sub">Future Leaders &amp; Scholars</div>
                                    </div>
                                    <i class="fas fa-chevron-right tab-arrow"></i>
                                </div>
                                <div class="comm-tab" onclick="showTab('universities',this)">
                                    <div class="tab-icon"><i class="fas fa-university"></i></div>
                                    <div>
                                        <div class="tab-label">Universities</div>
                                        <div class="tab-sub">Institutions Driving Change</div>
                                    </div>
                                    <i class="fas fa-chevron-right tab-arrow"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div id="tab-alumni" class="comm-content-panel active">
                            <div class="comm-panel-card">
                                <div class="panel-icon-box"><i class="fas fa-graduation-cap"></i></div>
                                <h3>Alumni Network</h3>
                                <p>Alumni are the backbone of every great institution. AlumniIndia gives them a platform
                                    to
                                    mentor,
                                    donate,
                                    engage, and celebrate their academic legacy while giving back to future generations.
                                </p>
                                <div class="comm-features">
                                    <div class="comm-feature">
                                        <div class="cf-check"><i class="fas fa-check"></i></div>Connect with batchmates
                                        &amp;
                                        professors
                                    </div>
                                    <div class="comm-feature">
                                        <div class="cf-check"><i class="fas fa-check"></i></div>Offer mentorship to
                                        current
                                        students
                                    </div>
                                    <div class="comm-feature">
                                        <div class="cf-check"><i class="fas fa-check"></i></div>Participate in donation
                                        campaigns
                                    </div>
                                    <div class="comm-feature">
                                        <div class="cf-check"><i class="fas fa-check"></i></div>Attend exclusive alumni
                                        events
                                    </div>
                                    <div class="comm-feature">
                                        <div class="cf-check"><i class="fas fa-check"></i></div>Build your professional
                                        legacy
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tab-athletes" class="comm-content-panel">
                            <div class="comm-panel-card">
                                <div class="panel-icon-box"><i class="fas fa-person-running"></i></div>
                                <h3>Athlete Platform</h3>
                                <p>Every athlete deserves a stage. We give student-athletes a digital identity, a
                                    highlight
                                    reel,
                                    and a
                                    direct connection to universities, coaches, and scholarships.</p>
                                <div class="comm-features">
                                    <div class="comm-feature">
                                        <div class="cf-check"><i class="fas fa-check"></i></div>Build a digital athlete
                                        profile
                                    </div>
                                    <div class="comm-feature">
                                        <div class="cf-check"><i class="fas fa-check"></i></div>Upload highlight video
                                        clips
                                    </div>
                                    <div class="comm-feature">
                                        <div class="cf-check"><i class="fas fa-check"></i></div>Get discovered by top
                                        universities
                                    </div>
                                    <div class="comm-feature">
                                        <div class="cf-check"><i class="fas fa-check"></i></div>Match with personal
                                        sports
                                        mentors
                                    </div>
                                    <div class="comm-feature">
                                        <div class="cf-check"><i class="fas fa-check"></i></div>Access verified
                                        scholarship
                                        programs
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tab-students" class="comm-content-panel">
                            <div class="comm-panel-card">
                                <div class="panel-icon-box"><i class="fas fa-book"></i></div>
                                <h3>Student Hub</h3>
                                <p>Students today need more than textbooks. AlumniIndia connects them to scholarships,
                                    workshops,
                                    mentors,
                                    and a vibrant campus community all in one seamless experience.</p>
                                <div class="comm-features">
                                    <div class="comm-feature">
                                        <div class="cf-check"><i class="fas fa-check"></i></div>Find the right mentor
                                        for your
                                        goals
                                    </div>
                                    <div class="comm-feature">
                                        <div class="cf-check"><i class="fas fa-check"></i></div>Access scholarships
                                        &amp; events
                                    </div>
                                    <div class="comm-feature">
                                        <div class="cf-check"><i class="fas fa-check"></i></div>Explore universities
                                        across
                                        India
                                    </div>
                                    <div class="comm-feature">
                                        <div class="cf-check"><i class="fas fa-check"></i></div>Join campus clubs &amp;
                                        workshops
                                    </div>
                                    <div class="comm-feature">
                                        <div class="cf-check"><i class="fas fa-check"></i></div>Stay updated with campus
                                        news
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tab-universities" class="comm-content-panel">
                            <div class="comm-panel-card">
                                <div class="panel-icon-box"><i class="fas fa-university"></i></div>
                                <h3>University Portal</h3>
                                <p>Universities get a powerful dashboard to discover talent, launch scholarship
                                    campaigns,
                                    engage
                                    alumni,
                                    and build a thriving institutional community beyond graduation.</p>
                                <div class="comm-features">
                                    <div class="comm-feature">
                                        <div class="cf-check"><i class="fas fa-check"></i></div>Discover and recruit
                                        athletic
                                        talent
                                    </div>
                                    <div class="comm-feature">
                                        <div class="cf-check"><i class="fas fa-check"></i></div>Manage donation
                                        campaigns
                                    </div>
                                    <div class="comm-feature">
                                        <div class="cf-check"><i class="fas fa-check"></i></div>Post scholarships &amp;
                                        events
                                    </div>
                                    <div class="comm-feature">
                                        <div class="cf-check"><i class="fas fa-check"></i></div>Engage alumni
                                        communities
                                    </div>
                                    <div class="comm-feature">
                                        <div class="cf-check"><i class="fas fa-check"></i></div>Track institutional
                                        performance
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="stats-section">
        <div class="stats-container">

            <div class="stat-box">
                <div class="icon-box">
                    <i class="fas fa-globe"></i>
                </div>
                <h3>Inclusivity</h3>
                <p>Every student, athlete, and alumni — regardless of background — deserves equal access to opportunity
                    and
                    community support.</p>
            </div>

            <div class="stat-box">
                <div class="icon-box">
                    <i class="fas fa-shield-halved"></i>
                </div>
                <h3>Trust & Safety</h3>
                <p>We protect your data with best-in-class encryption ensuring a safe and trusted environment for all
                    our
                    communities.</p>
            </div>

            <div class="stat-box">
                <div class="icon-box">
                    <i class="fas fa-bolt"></i>
                </div>
                <h3>Innovation</h3>
                <p>We constantly push the boundaries of what's possible in education technology — shipping features that
                    solve real problems.</p>
            </div>

            <div class="stat-box">
                <div class="icon-box">
                    <i class="fas fa-people-group"></i>
                </div>
                <h3>Community First</h3>
                <p>Every decision starts with one question: does this create value for our community? If not, we go back
                    to
                    the drawing board.</p>
            </div>

            <div class="stat-box">
                <div class="icon-box">
                    <i class="fas fa-seedling"></i>
                </div>
                <h3>Long-Term Growth</h3>
                <p>We invest in the long game — building sustainable connections, not quick wins. Real impact takes time
                    and
                    commitment.</p>
            </div>

        </div>
    </section>


    <section class="choose-us-section choose-bg fix section-padding pt-0">
        <div class="container-fluid">
            <div class="choose-us-wrapper">
                <div class="row g-4 align-items-center">
                    <div class="col-xl-5">
                        <div class="section-title mb-0">
                            <h6 class="yellow-text">
                                Why Choose Us
                            </h6>
                            <h2 class="text-white ">
                                Why Choose Alumni Association Of India
                            </h2>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="choose-us-counter-items">
                            <div class="row g-4">
                                <div class="col-lg-6 col-md-6">
                                    <div class="choose-us-counter-box">
                                        <div class="icon">
                                            <i class="fas fa-people-group"></i>
                                        </div>
                                        <div class="content">
                                            <h2>800K</h2>
                                            <p>Lorem Ipsum</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="choose-us-counter-box style-2">
                                        <div class="icon">
                                            <i class="fas fa-bolt"></i>
                                        </div>
                                        <div class="content">
                                            <h2>80+</h2>
                                            <p>About</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="choose-us-image">
                            <img src="{{ asset('frontend_assets/assets/images/choose-us-about.png') }}" alt="img" class=" img-custom-anim-left">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section id="join">
        <div class="join-inner">
            <div>
                <h5 class="section-heading-com">Be Part of Us</h5>
                <h2 class="h2-common-alls ">Find Your Place in the <span>AlumniIndia</span> Family</h2>
            </div>
            <div class="join-cards">
                <div class="join-card animate ">
                    <div class="jc-icon"><i class="fas fa-graduation-cap"></i></div>
                    <h3>I'm an Alumni</h3>
                    <p>Reconnect with your roots, mentor the next generation, and stay engaged with your alma mater for
                        life.</p>
                </div>
                <div class="join-card animate ">
                    <div class="jc-icon"><i class="fas fa-person-running"></i></div>
                    <h3>I'm an Athlete</h3>
                    <p>Build your profile, upload highlights, and get discovered by top universities and scholarship
                        programs
                        across India.</p>
                </div>
                <div class="join-card animate ">
                    <div class="jc-icon"><i class="fas fa-book-open-reader"></i></div>
                    <h3>I'm a Student</h3>
                    <p>Access mentors, scholarships, workshops, and a supportive campus community tailored to your goals
                        and
                        ambitions.</p>
                </div>
            </div>
            <div class="join-cta-block">
                <div class="cta-icons-row">
                    <div class="cta-ic"><i class="fas fa-graduation-cap"></i></div>
                    <div class="cta-ic"><i class="fas fa-person-running"></i></div>
                    <div class="cta-ic"><i class="fas fa-book"></i></div>
                    <div class="cta-ic"><i class="fas fa-university"></i></div>
                </div>
                <h3>Ready to Join 3,000+ Members?</h3>
                <p>Sign up in under 2 minutes and become part of India's fastest-growing alumni and athlete ecosystem.
                </p>
                <div class="join-cta-btns">
                    <a href="tel:+91-9999999999"><button class="btn-white"><i class="fas fa-user-plus"></i> Connect
                            Now</button></a>
                    <a href="find-university.html"><button class="btn-ghost-white"><i class="fas fa-building-columns"></i>
                            Explore Now </button></a>
                </div>
            </div>
        </div>
    </section>


    <!-------new-tabbing-about-------->
    <script>
        window.addEventListener('scroll', () => {
            const h = document.documentElement;
            document.getElementById('progress-bar').style.width = (h.scrollTop / (h.scrollHeight - h.clientHeight) * 100) + '%';
        });
        const obs = new IntersectionObserver(entries => entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); }), { threshold: 0.12 });
        document.querySelectorAll('.animate').forEach(el => obs.observe(el));
        function showTab(name, el) {
            document.querySelectorAll('.comm-tab').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.comm-content-panel').forEach(p => p.classList.remove('active'));
            el.classList.add('active');
            document.getElementById('tab-' + name).classList.add('active');
        }
    </script>

    <!------tabbing-upcoming-events-->
    <script>
        const tabs = document.querySelectorAll('.event-tab');
        const panels = document.querySelectorAll('.event-panel');
        const dots = document.querySelectorAll('.dot');

        function activate(i) {
            tabs.forEach(t => t.classList.remove('active'));
            panels.forEach(p => p.classList.remove('active'));
            dots.forEach(d => d.classList.remove('active'));
            tabs[i].classList.add('active');
            panels[i].classList.add('active');
            dots[i].classList.add('active');
        }

        tabs.forEach(t => t.addEventListener('click', () => activate(+t.dataset.index)));
        dots.forEach(d => d.addEventListener('click', () => activate(+d.dataset.dot)));
    </script>



    <!----review-sections-->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new Splide('.splide', {
                type: 'loop',
                autoplay: false,
                drag: 'free',
                focus: 'center',
                perPage: 3,
                autoScroll: {
                    speed: 1,
                },
            }).mount(window.splide.Extensions);
        });
    </script>

@endsection