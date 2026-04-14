@extends('layout.frontend.app')
@section('content')




    <div class="univerisyt-details">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="div-univeristy-detials">
                        <div>
                            <h1>Shape the Future Through Knowledge</h1>
                            <div class="hero-actions">
                                <a href="#" class="btn-primary">Explore Programs</a>
                            </div>
                        </div>
                        <div class="hero-stats-panel">
                            <div class="hero-stat-grid">
                                <div class="hero-stat">
                                    <div class="hero-stat-num">42<sup>k</sup></div>
                                    <div class="hero-stat-label">Students</div>
                                </div>
                                <div class="hero-stat">
                                    <div class="hero-stat-num">180<sup>+</sup></div>
                                    <div class="hero-stat-label">Programs</div>
                                </div>
                                <div class="hero-stat-divider" style="grid-column:1/-1"></div>
                                <div class="hero-stat">
                                    <div class="hero-stat-num">96<sup>%</sup></div>
                                    <div class="hero-stat-label">Graduate Rate</div>
                                </div>
                                <div class="hero-stat">
                                    <div class="hero-stat-num">120<sup>+</sup></div>
                                    <div class="hero-stat-label">Countries</div>
                                </div>
                            </div>
                            <div class="hero-rank">
                                <div class="rank-icon">🏆</div>
                                <div class="rank-text">
                                    <strong>#8 National University Ranking</strong>
                                    <span>US News & World Report, 2026</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="new-univeristy-details">
        <div class="container-fluid">
            <div class="common-widthsections">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h5 class="section-heading-com">Our Story</h5>
                        <h2 class="h2-common-alls mb-3">A Legacy of Innovation & Discovery</h2>
                        <p>Founded in 1892, Ashford University has grown from a small liberal arts college into one of
                            the nation's premier
                            research institutions. We believe that great universities do more than teach—they transform
                            communities and advance
                            civilization.
                            <br>
                            Our campus spans 520 acres, housing 18 schools and colleges, state-of-the-art research
                            facilities, and a vibrant
                            residential community where ideas flourish beyond the classroom.
                        </p>
                    </div>
                    <div class="col-md-6">
                        <img src="{{ asset('frontend_assets/assets/images/university-details.jpg') }}" alt="story">
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="inside-univet">
        <img src="{{ asset('frontend_assets/assets/images/alumni-left-university.png') }}" alt="" class="univeri-2">
        <img src="{{ asset('frontend_assets/assets/images/university-right.png') }}" alt="" class="univeri-3">
        <div class="container-fluid">
            <div class="common-widthsections">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="section-heading-com text-white">Universities</h5>
                        <h2 class="h2-common-alls mb-5 text-center" style="color: white;">Inside University Alumni
                            Networky</h2>
                        <div class="layout">


                            <div class="left">


                                <div class="admission-card">
                                    <div class="logo">🏆</div>

                                    <div class="avatars">
                                        <img src="https://i.pravatar.cc/40?img=5">
                                        <img src="https://i.pravatar.cc/40?img=6">
                                        <img src="https://i.pravatar.cc/40?img=7">
                                        <img src="https://i.pravatar.cc/40?img=8">
                                    </div>

                                    <p><strong>12,500+</strong> Active Alumni</p>
                                    <button>Join Alumni Network</button>
                                </div>


                                <div class="notice">
                                    <h3>Alumni Updates</h3>

                                    <div class="notice-item">
                                        <h4>Global Alumni Meet 2026 Announced</h4>
                                        <p>📅 January 15, 2026</p>
                                        <span>EVENT/ALUMNI/2026/01</span>
                                    </div>

                                    <div class="notice-item">
                                        <h4>Mentorship Program Registrations Open</h4>
                                        <p>📅 January 10, 2026</p>
                                        <span>ALUMNI/MENTOR/2026/02</span>
                                    </div>

                                    <div class="notice-item">
                                        <h4>Top Alumni Achievements Released</h4>
                                        <p>📅 January 05, 2026</p>
                                        <span>NEWS/ALUMNI/2026/03</span>
                                    </div>

                                </div>

                            </div>


                            <div class="right">

                                <div class="card">
                                    <img src="{{ asset('frontend_assets/assets/images/one-uno.jpg') }}" />
                                    <div class="overlay">Faculty of Education</div>
                                </div>

                                <div class="card">
                                    <img src="{{ asset('frontend_assets/assets/images/two-uno.jpg') }}" />
                                    <div class="overlay">Faculty of Law</div>
                                </div>

                                <div class="card">
                                    <img src="{{ asset('frontend_assets/assets/images/three-uno.jpg') }}" />
                                    <div class="overlay">Faculty of Social Sciences</div>
                                </div>

                                <div class="card">
                                    <img src="{{ asset('frontend_assets/assets/images/four-uno.jpg') }}" />
                                    <div class="overlay">Faculty of Engineering</div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="programs-section">
        <div class="container-fluid">
            <div class="common-widthsections">
                <div class="row justify-content-center">
                    <div class="col-lg-10 col-md-12 col-12">
                        <h5 class="section-heading-com">Academic Offerings</h5>
                        <h2 class="h2-common-alls mb-5 text-center">Programs Built for Tomorrow</h2>

                        <div class="programs-grid">


                            <div class="program-card">
                                <div class="program-icon">
                                    <i class="fas fa-flask"></i>
                                </div>
                                <div class="program-name">Sciences & Engineering</div>
                                <p class="program-desc">
                                    Cutting-edge labs and faculty mentorship across physics, chemistry, biology, and all
                                    major engineering disciplines.
                                </p>
                                <div class="program-meta">
                                    <span class="program-tag">42 Programs</span>
                                    <span class="program-tag">PhD Available</span>
                                </div>
                            </div>


                            <div class="program-card">
                                <div class="program-icon">
                                    <i class="fas fa-briefcase"></i>
                                </div>
                                <div class="program-name">Business & Economics</div>
                                <p class="program-desc">
                                    Top-ranked MBA and undergraduate programs with deep ties to Wall Street, Silicon
                                    Valley,
                                    and global markets.
                                </p>
                                <div class="program-meta">
                                    <span class="program-tag">28 Programs</span>
                                    <span class="program-tag">MBA Online</span>
                                </div>
                            </div>


                            <div class="program-card">
                                <div class="program-icon">
                                    <i class="fas fa-scale-balanced"></i>
                                </div>
                                <div class="program-name">Law & Public Policy</div>
                                <p class="program-desc">
                                    A prestigious law school shaping legal minds and public policy leaders across
                                    constitutional, corporate, and international law.
                                </p>
                                <div class="program-meta">
                                    <span class="program-tag">15 Programs</span>
                                    <span class="program-tag">Bar Prep</span>
                                </div>
                            </div>


                            <div class="program-card">
                                <div class="program-icon">
                                    <i class="fas fa-palette"></i>
                                </div>
                                <div class="program-name">Arts & Humanities</div>
                                <p class="program-desc">
                                    Philosophy, literature, fine arts, and media studies—exploring the human experience
                                    through creativity and critical thought.
                                </p>
                                <div class="program-meta">
                                    <span class="program-tag">36 Programs</span>
                                    <span class="program-tag">Studio Arts</span>
                                </div>
                            </div>


                            <div class="program-card">
                                <div class="program-icon">
                                    <i class="fas fa-heart-pulse"></i>
                                </div>
                                <div class="program-name">Medicine & Health</div>
                                <p class="program-desc">
                                    World-class medical school and health sciences programs affiliated with Ashford
                                    University Hospital and research centers.
                                </p>
                                <div class="program-meta">
                                    <span class="program-tag">22 Programs</span>
                                    <span class="program-tag">Residency</span>
                                </div>
                            </div>


                            <div class="program-card">
                                <div class="program-icon">
                                    <i class="fas fa-code"></i>
                                </div>
                                <div class="program-name">Computer Science & AI</div>
                                <p class="program-desc">
                                    Industry-leading CS programs covering machine learning, cybersecurity, software
                                    systems,
                                    and emerging technologies.
                                </p>
                                <div class="program-meta">
                                    <span class="program-tag">19 Programs</span>
                                    <span class="program-tag">AI Specialization</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="univet-cta-section">
        <div class="univet-overlay"></div>

        <div class="univet-container">
            <div class="univet-content">
                <span class="univet-tag">
                    <i class="fas fa-graduation-cap"></i> Interested?
                </span>

                <h2 class="univet-title">
                    Want to learn more about <br> University?
                </h2>

                <p class="univet-desc">
                    Discover our programs, research excellence, and the opportunities
                    that make Univet University a destination for ambitious learners.
                </p>

                <a href="#" class="univet-btn">
                    Connect Now
                </a>
            </div>
        </div>
    </section>


    <div class="page-wrapper">

        <div class="container-fluid">
            <div class="common-widthsections">
                <div class="row">
                    <div class="col-md-12">

                        <div class="tuition-grid">


                            <div class="left-col">
                                <div>
                                    <h5 class="section-heading-com">TUITION FEE
                                    </h5>
                                    <h2 class="h2-common-alls mb-3">University Fee Structure</h2>


                                    <p class="tuition-desc">Explore the detailed tuition structure designed to support
                                        students across
                                        undergraduate, postgraduate, and online programs.</p>
                                    <a href="#" class="btn-detailed">
                                        View Fee Details
                                    </a>
                                </div>

                                <div class="student-photo-wrap">
                                    <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=700&q=80"
                                        alt="Student sitting on grass with laptop" />
                                </div>
                            </div>


                            <div class="fee-card fee-card-white card-undergraduate">
                                <div class="card-title">Undergraduate Programs</div>

                                <div class="fee-block">
                                    <div class="fee-section-title">Faculty of Arts & Humanities</div>
                                    <div class="fee-item">Tuition Fee (Per Semester): $1,200</div>
                                    <div class="fee-item">Admission Fee (One-Time): $300</div>
                                </div>

                                <div class="fee-block">
                                    <div class="fee-section-title">Faculty of Commerce & Management</div>
                                    <div class="fee-item">Technology Fee: $250 per Semester</div>
                                    <div class="fee-item">Student Activity Fee: $100 per Semester</div>
                                </div>
                            </div>


                            <div class="fee-card fee-card-dark card-graduate">
                                <div class="card-title">Postgraduate Programs</div>

                                <div class="fee-block">
                                    <div class="fee-section-title">School of Science & Research</div>
                                    <div class="fee-item">Tuition Fee (Per Semester): $1,500</div>
                                    <div class="fee-item">Research & Lab Fee: $400</div>
                                </div>

                                <div class="fee-block">
                                    <div class="fee-section-title">Business School (MBA)</div>
                                    <div class="fee-item">Tuition Fee: $2,000 per Semester</div>
                                    <div class="fee-item">Industry Exposure Fee: $350</div>
                                </div>
                            </div>


                            <div class="fee-card fee-card-teal card-online">
                                <div class="card-title text-white">Online & Distance Learning</div>

                                <div class="fee-block">
                                    <div class="fee-section-title">Certification Programs</div>
                                    <div class="fee-item">Course Fee: $200 - $500</div>
                                    <div class="fee-item">Access Duration: 6 Months</div>
                                </div>

                                <div class="fee-block">
                                    <div class="fee-section-title">Degree Programs</div>
                                    <div class="fee-item">Tuition Fee: $800 per Semester</div>
                                    <div class="fee-item">Digital Resources Fee: $100</div>
                                </div>
                            </div>


                            <div class="fee-card fee-card-white card-programwise">
                                <div class="card-title">Program-Wise Fees</div>

                                <div class="fee-block">
                                    <div class="fee-section-title">Engineering Programs</div>
                                    <div class="fee-item">Tuition Fee: $1,800 per Semester</div>
                                    <div class="fee-item">Lab & Workshop Fee: $500</div>
                                </div>

                                <div class="fee-block">
                                    <div class="fee-section-title">Medical & Healthcare</div>
                                    <div class="fee-item">Tuition Fee: $2,500 per Semester</div>
                                    <div class="fee-item">Clinical Training Fee: $700</div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


 

@endsection