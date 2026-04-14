@extends('layout.frontend.app')
@section('content')


    <section class="scholarship-hero blog">
        <div class="hero-image"></div>
        <div class="container-fluid">
            <div class="hero-wrapper">
                <div class="hero-left"><img src="{{ asset('frontend_assets/assets/images/image-ovberlay.png') }}" alt="" class="image-common-overlays">
                    <h1>Privacy Policy</h1>
                    <div class="breadcrumb-content">
                        <a href="{{ route('frontend.index') }}">Home</a>
                        <span>»</span>
                        <span class="active">Privacy Policy</span>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="privacy-policy">
        <div class="container-fluid">
            <div class="common-widthsections">
                <div class="row">
                    <div class="col-md-12">
                        <div class="page-wrap">
                            <aside class="sidebar">
                                <div class="sidebar-label">Contents</div>
                                <nav>
                                    <a class="nav-item" href="#collect">
                                        <div class="nav-num">01</div> Information We Collect
                                    </a>
                                    <a class="nav-item" href="#use">
                                        <div class="nav-num">02</div> How We Use It
                                    </a>
                                    <a class="nav-item" href="#sharing">
                                        <div class="nav-num">03</div> Sharing & Disclosure
                                    </a>
                                    <a class="nav-item" href="#cookies">
                                        <div class="nav-num">04</div> Cookies & Tracking
                                    </a>
                                    <a class="nav-item" href="#security">
                                        <div class="nav-num">05</div> Security Measures
                                    </a>
                                    <a class="nav-item" href="#rights">
                                        <div class="nav-num">06</div> Your Rights
                                    </a>
                                    <a class="nav-item" href="#retention">
                                        <div class="nav-num">07</div> Data Retention
                                    </a>
                                    <a class="nav-item" href="#changes">
                                        <div class="nav-num">08</div> Policy Changes
                                    </a>
                                </nav>
                            </aside>
                            <div class="main">
                                <div class="intro-card" id="commitment">
                                    <p>At <strong>AlumniIndia</strong>, we are committed to protecting the privacy and
                                        personal information
                                        of
                                        our alumni, students, and partner institutions. Our platform is designed to help
                                        alumni stay
                                        connected,
                                        support students, participate in events, and strengthen lifelong relationships
                                        with their
                                        universities.
                                    </p>
                                    <p style="margin-top:12px;">We respect your privacy and ensure that all personal
                                        data shared with us is
                                        handled <strong>responsibly, securely, and transparently</strong>. This policy
                                        explains what
                                        information
                                        we collect, how we use it, and the rights you have regarding your personal data.
                                    </p>
                                </div>

                                <div class="policy-section" id="collect">
                                    <div class="section-header">
                                        <div class="section-icon">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="#1560BD" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                                                <circle cx="9" cy="7" r="4" />
                                                <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                                                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="section-num">Section 01</div>
                                            <h2 class="section-title2">Information We Collect</h2>
                                        </div>
                                    </div>
                                    <div class="section-body">
                                        <p>When you register or interact with the Alumni platform, we may collect the
                                            following information:
                                        </p>
                                        <ul class="policy-list">
                                            <li>Basic personal information such as name, email address, graduation year,
                                                university, and
                                                profession.</li>
                                            <li>Profile details including skills, achievements, interests, and
                                                professional background.</li>
                                            <li>Information shared when you register for alumni events, mentorship
                                                programs, or scholarship
                                                opportunities.</li>
                                            <li>Communication data when you connect with other alumni or participate in
                                                discussions.</li>
                                            <li>Technical information such as device type, IP address, and browsing
                                                activity to improve
                                                platform
                                                performance.</li>
                                        </ul>

                                    </div>
                                </div>
                                <div class="section-divider"></div>


                                <div class="policy-section" id="use">
                                    <div class="section-header">
                                        <div class="section-icon">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="#1560BD" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <circle cx="12" cy="12" r="3" />
                                                <path d="M19.07 4.93a10 10 0 0 1 0 14.14" />
                                                <path d="M4.93 4.93a10 10 0 0 0 0 14.14" />
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="section-num">Section 02</div>
                                            <h2 class="section-title2">How We Use Your Information</h2>
                                        </div>
                                    </div>
                                    <div class="section-body">
                                        <p>We use your information to provide a better alumni experience and improve our
                                            services. This
                                            includes:</p>
                                        <ul class="policy-list">
                                            <li>Managing and maintaining your Alumni Network profile</li>
                                            <li>Helping alumni connect with peers, mentors, and universities</li>
                                            <li>Sending event invitations, newsletters, and alumni updates</li>
                                            <li>Facilitating mentorship, scholarship, and career opportunities</li>
                                            <li>Managing donations, fundraising campaigns, and alumni contributions</li>
                                            <li>Improving the functionality and user experience of the platform</li>
                                        </ul>

                                    </div>
                                </div>
                                <div class="section-divider"></div>


                                <div class="policy-section" id="sharing">
                                    <div class="section-header">
                                        <div class="section-icon">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="#1560BD" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <circle cx="18" cy="5" r="3" />
                                                <circle cx="6" cy="12" r="3" />
                                                <circle cx="18" cy="19" r="3" />
                                                <line x1="8.59" y1="13.51" x2="15.42" y2="17.49" />
                                                <line x1="15.41" y1="6.51" x2="8.59" y2="10.49" />
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="section-num">Section 03</div>
                                            <h2 class="section-title2">Sharing & Disclosure</h2>
                                        </div>
                                    </div>
                                    <div class="section-body">
                                        <p>We respect your privacy and <strong style="color:var(--navy)">do not sell or
                                                trade your personal
                                                information.</strong></p>
                                        <p>Your information may be shared only in the following situations:</p>
                                        <ul class="policy-list">
                                            <li>With trusted service providers that help us operate the platform (cloud
                                                hosting, email
                                                services,
                                                payment systems, event tools).</li>
                                            <li>With other alumni members according to your privacy and profile
                                                visibility settings.</li>
                                            <li>When required by law, legal authorities, or regulatory requirements.
                                            </li>
                                            <li>To maintain the safety and security of our community and platform.</li>
                                        </ul>

                                    </div>
                                </div>
                                <div class="section-divider"></div>


                                <div class="policy-section" id="cookies">
                                    <div class="section-header">
                                        <div class="section-icon">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="#1560BD" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <circle cx="12" cy="12" r="10" />
                                                <path d="M8 14s1.5 2 4 2 4-2 4-2" />
                                                <line x1="9" y1="9" x2="9.01" y2="9" />
                                                <line x1="15" y1="9" x2="15.01" y2="9" />
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="section-num">Section 04</div>
                                            <h2 class="section-title2">Cookies & Tracking</h2>
                                        </div>
                                    </div>
                                    <div class="section-body">
                                        <p>Our website uses cookies to ensure smooth functionality and improve your
                                            experience. Cookies help
                                            us
                                            to:</p>
                                        <ul class="policy-list">
                                            <li>Keep you securely logged in</li>
                                            <li>Understand how users navigate the alumni platform</li>
                                            <li>Improve website performance and user experience</li>
                                        </ul>

                                    </div>
                                </div>
                                <div class="section-divider"></div>


                                <div class="policy-section" id="security">
                                    <div class="section-header">
                                        <div class="section-icon">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="#1560BD" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
                                                <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="section-num">Section 05</div>
                                            <h2 class="section-title2">Security Measures</h2>
                                        </div>
                                    </div>
                                    <div class="section-body">
                                        <p>Protecting your information is a top priority. We use industry-standard
                                            security practices
                                            including:
                                        </p>
                                        <ul class="policy-list">
                                            <li>Secure encrypted connections (HTTPS / TLS)</li>
                                            <li>Encrypted data storage</li>
                                            <li>Restricted access controls for administrators</li>
                                            <li>Regular security monitoring and audits</li>
                                        </ul>
                                        <p>These measures help safeguard alumni data against unauthorized access,
                                            misuse, or loss.</p>
                                    </div>
                                </div>
                                <div class="section-divider"></div>

                                <div class="policy-section" id="rights">
                                    <div class="section-header">
                                        <div class="section-icon">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="#1560BD" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                                                <circle cx="12" cy="7" r="4" />
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="section-num">Section 06</div>
                                            <h2 class="section-title2">Your Rights</h2>
                                        </div>
                                    </div>
                                    <div class="section-body">
                                        <p>As a member of the Alumni Network, you have full control over your personal
                                            information.</p>
                                        <div class="rights-grid">
                                            <div class="right-card">
                                                <div class="right-card-icon"><svg viewBox="0 0 24 24">
                                                        <path
                                                            d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z" />
                                                    </svg></div>
                                                <h4>Access</h4>
                                                <p>Request a copy of your personal data</p>
                                            </div>
                                            <div class="right-card">
                                                <div class="right-card-icon"><svg viewBox="0 0 24 24">
                                                        <path
                                                            d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a1 1 0 0 0 0-1.41l-2.34-2.34a1 1 0 0 0-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z" />
                                                    </svg></div>
                                                <h4>Update / Rectify</h4>
                                                <p>Correct inaccurate information</p>
                                            </div>
                                            <div class="right-card">
                                                <div class="right-card-icon"><svg viewBox="0 0 24 24">
                                                        <path
                                                            d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z" />
                                                    </svg></div>
                                                <h4>Delete</h4>
                                                <p>Request account & data deletion</p>
                                            </div>
                                            <div class="right-card">
                                                <div class="right-card-icon"><svg viewBox="0 0 24 24">
                                                        <path
                                                            d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4z" />
                                                    </svg></div>
                                                <h4>Restrict Processing</h4>
                                                <p>Limit how your info is used</p>
                                            </div>
                                            <div class="right-card">
                                                <div class="right-card-icon"><svg viewBox="0 0 24 24">
                                                        <path
                                                            d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z" />
                                                    </svg></div>
                                                <h4>Object</h4>
                                                <p>Opt out of certain communications</p>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="section-divider"></div>


                                <div class="policy-section" id="retention">
                                    <div class="section-header">
                                        <div class="section-icon">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="#1560BD" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <circle cx="12" cy="12" r="10" />
                                                <polyline points="12 6 12 12 16 14" />
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="section-num">Section 07</div>
                                            <h2 class="section-title2">Data Retention</h2>
                                        </div>
                                    </div>
                                    <div class="section-body">
                                        <p>We retain your alumni profile information as long as your account remains
                                            active on the platform.
                                        </p>
                                        <p>If you choose to close your account:</p>
                                        <ul class="policy-list">
                                            <li>Your personal information will be deleted or anonymised within a
                                                reasonable period.</li>
                                            <li>Some information may be retained if required for legal or regulatory
                                                compliance.</li>
                                            <li>Anonymous statistical data may be used for research, reporting, and
                                                improving alumni
                                                services.
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="section-divider"></div>


                                <div class="policy-section" id="changes">
                                    <div class="section-header">
                                        <div class="section-icon">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="#1560BD" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                                <polyline points="14 2 14 8 20 8" />
                                                <line x1="16" y1="13" x2="8" y2="13" />
                                                <line x1="16" y1="17" x2="8" y2="17" />
                                                <polyline points="10 9 9 9 8 9" />
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="section-num">Section 08</div>
                                            <h2 class="section-title2">Changes to This Policy</h2>
                                        </div>
                                    </div>
                                    <div class="section-body">
                                        <p>We may update this Privacy Policy from time to time to reflect platform
                                            improvements or changes
                                            in
                                            legal requirements.</p>
                                        <p>If significant changes are made, we will notify users through:</p>
                                        <ul class="policy-list">
                                            <li>Email notifications</li>
                                            <li>Platform announcements</li>
                                        </ul>
                                        <p>Your continued use of the Alumni Network platform indicates acceptance of the
                                            updated policy.</p>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>


    <!----privacy-policy-->
    <script>
        const sections = document.querySelectorAll('[id]');
        const navLinks = document.querySelectorAll('.nav-item');
        window.addEventListener('scroll', () => {
            let current = '';
            sections.forEach(s => {
                if (window.scrollY >= s.offsetTop - 100) current = s.id;
            });
            navLinks.forEach(l => {
                l.classList.remove('active');
                if (l.getAttribute('href') === '#' + current) l.classList.add('active');
            });
        });
    </script>

@endsection