@extends('layout.frontend.app')
@section('content')





    <section class="scholarship-hero">
        <div class="hero-image"></div>
        <div class="container-fluid">
            <div class="hero-wrapper">
                <div class="hero-left"><img src="{{ asset('frontend_assets/assets/images/image-ovberlay.png') }}" alt="" class="image-common-overlays">
                    <h1>Scholarship & Events</h1>
                    <div class="breadcrumb-content">
                        <a href="{{ route('frontend.index') }}">Home</a>
                        <span>»</span>
                        <span class="active">Scholarship & Events</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="about-scholarships">
        <div class="container-fluid">
            <div class="common-widthsections">
                <div class="row align-items-center">
                    <div class="col-md-5">
                        <h5 class="section-heading-com">Scholarships</h5>
                        <h2 class="h2-common-alls">What is the Athlete <br>Scholarship Program?</h2>
                    </div>
                    <div class="col-md-7">
                        <p class="common-p-use">The Athlete Scholarship Program helps talented athletes from
                            India access higher
                            education
                            opportunities with
                            financial support from universities that recognize sporting excellence.
                            <br>
                            This program is designed to support athletes who want to continue competing in sports while
                            pursuing their academic
                            goals. Universities offer scholarships to athletes who demonstrate strong performance,
                            discipline, and commitment in
                            their respective sports.
                            <br>
                            Through this program, athletes can receive guidance, resources, and opportunities that help
                            them
                            grow both academically
                            and professionally while representing their university in competitive sports.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="scholars-ship-gets">
        <img src="{{ asset('frontend_assets/assets/images/image-bg.png') }}" alt="image-bg" class="bg-scholarships">
        <div class="container-fluid">
            <div class="common-widthsections">
                <div class="row align-items-center">
                    <div class="col-md-6 ">
                        <h5 class="section-heading-com">Key Benefits</h5>
                        <h2 class="h2-common-alls">Scholarship Support & Athlete Benefits</h2>
                        <p class="common-p-use">The scholarship program supports Indian athletes by providing financial
                            assistance, training opportunities, academic
                            support, and access to world-class sports facilities.
                        </p>
                        <ul class="scholarship-list">
                            <li><i class="fas fa-check-circle"></i> Partial or full tuition fee support</li>
                            <li><i class="fas fa-check-circle"></i> Accommodation assistance for student athletes</li>
                            <li><i class="fas fa-check-circle"></i> Access to professional sports facilities</li>
                            <li><i class="fas fa-check-circle"></i> Coaching and athlete development programs</li>
                            <li><i class="fas fa-check-circle"></i> Academic mentoring and career guidance</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <img src="{{ asset('frontend_assets/assets/images/scholar-1-1.png') }}" alt="images" class="image-scholars">
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="academics-section">
        <div class="container-fluid">
            <div class="common-widthsections">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h5 class="section-heading-com">Scholarship</h5>
                        <h2 class="h2-common-alls">We have the best
                            programs <br> for you</h2>
                    </div>
                    <div class="col-md-6">
                        <div class="filters-row">
                            <span class="filter-label">Filter by</span>

                            <div class="select-wrap">
                                <select id="filterUniversity" onchange="applyFilters()">
                                    <option value="">🏛 All Universities</option>
                                    <option value="MIT">MIT</option>
                                    <option value="Oxford">Oxford University</option>
                                    <option value="Harvard">Harvard University</option>
                                    <option value="Stanford">Stanford University</option>
                                </select>
                            </div>

                            <div class="select-wrap">
                                <select id="filterCourse" onchange="applyFilters()">
                                    <option value="">📚 All Courses</option>
                                    <option value="Science">Science</option>
                                    <option value="Media">Media</option>
                                    <option value="Public">Public Affairs</option>
                                    <option value="Engineering">Engineering</option>
                                    <option value="Arts">Arts & Humanities</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="cards-grid common-widthsections" id="cardsGrid">


                <div class="program-card" data-university="MIT" data-course="Media">
                    <div class="card-img">
                        <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=600&q=80"
                            alt="Applied Mathematics">
                        <span class="card-badge">
                            <svg viewBox="0 0 24 24">
                                <path d="M12 2L2 7l10 5 10-5-10-5zm0 7L2 14l10 5 10-5-10-5z" />
                            </svg>
                            Media
                        </span>
                        <span class="card-uni-tag">MIT</span>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title">Bachelor in Applied Mathematics</h3>
                        <p class="card-desc">Every traditional undergraduate student receives scholarships.</p>
                        <div class="card-dates">
                            <div class="date-item">
                                <span class="date-lbl">Open Date</span>
                                <span class="date-val">Jan 15, 2025</span>
                            </div>
                            <div class="date-item">
                                <span class="date-lbl">End Date</span>
                                <span class="date-val">Apr 30, 2025</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="#" class="view-detail-btn">
                            View Details
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>
                    </div>
                </div>


                <div class="program-card" data-university="Oxford" data-course="Science">
                    <div class="card-img">
                        <img src="https://images.unsplash.com/photo-1529390079861-591de354faf5?w=600&q=80"
                            alt="Architecture">
                        <span class="card-badge">
                            <svg viewBox="0 0 24 24">
                                <path d="M12 2L2 7l10 5 10-5-10-5zm0 7L2 14l10 5 10-5-10-5z" />
                            </svg>
                            Science
                        </span>
                        <span class="card-uni-tag">Oxford University</span>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('university.details') }}">
                            <h3 class="card-title">Bachelor in Applied Architecture</h3>
                        </a>
                        <p class="card-desc">Every traditional undergraduate student receives scholarships.</p>
                        <div class="card-dates">
                            <div class="date-item">
                                <span class="date-lbl">Open Date</span>
                                <span class="date-val">Feb 01, 2025</span>
                            </div>
                            <div class="date-item">
                                <span class="date-lbl">End Date</span>
                                <span class="date-val">May 15, 2025</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="#" class="view-detail-btn">
                            View Details
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>

                    </div>
                </div>

                <div class="program-card" data-university="Harvard" data-course="Public">
                    <div class="card-img">
                        <img src="https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=600&q=80"
                            alt="Administration">
                        <span class="card-badge">
                            <svg viewBox="0 0 24 24">
                                <path d="M12 2L2 7l10 5 10-5-10-5zm0 7L2 14l10 5 10-5-10-5z" />
                            </svg>
                            Public
                        </span>
                        <span class="card-uni-tag">Harvard University</span>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('university.details') }}">
                            <h3 class="card-title">Bachelor in Administration & CSE</h3>
                        </a>
                        <p class="card-desc">Every traditional undergraduate student receives scholarships.</p>
                        <div class="card-dates">
                            <div class="date-item">
                                <span class="date-lbl">Open Date</span>
                                <span class="date-val">Mar 10, 2025</span>
                            </div>
                            <div class="date-item">
                                <span class="date-lbl">End Date</span>
                                <span class="date-val">Jun 20, 2025</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="#" class="view-detail-btn">
                            View Details
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>

                    </div>
                </div>


                <div class="program-card" data-university="Stanford" data-course="Engineering">
                    <div class="card-img">
                        <img src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=600&q=80"
                            alt="Engineering">
                        <span class="card-badge">
                            <svg viewBox="0 0 24 24">
                                <path d="M12 2L2 7l10 5 10-5-10-5zm0 7L2 14l10 5 10-5-10-5z" />
                            </svg>
                            Engineering
                        </span>
                        <span class="card-uni-tag">Stanford University</span>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('university.details') }}">
                            <h3 class="card-title">Bachelor in Electrical Engineering</h3>
                        </a>
                        <p class="card-desc">Every traditional undergraduate student receives scholarships.</p>
                        <div class="card-dates">
                            <div class="date-item">
                                <span class="date-lbl">Open Date</span>
                                <span class="date-val">Apr 01, 2025</span>
                            </div>
                            <div class="date-item">
                                <span class="date-lbl">End Date</span>
                                <span class="date-val">Jul 31, 2025</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="#" class="view-detail-btn">
                            View Details
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>

                    </div>
                </div>



            </div>

            <div class="cta-wrap">
                <a href="#" class="explore-btn">
                    <span>Explore All Programs</span>
                    <span class="arrow-circle">
                        <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round"
                            stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12" />
                            <polyline points="12 5 19 12 12 19" />
                        </svg>
                    </span>
                </a>
            </div>

    </section>

    <section class="process-one">
        <div class="container-fluid">
            <div class="common-widthsections">
                <div class="col-md-12 text-center">
                    <h5 class="section-heading-com">Process</h5>
                    <h2 class="h2-common-alls">How Athletes Can Apply</h2>
                </div>
                <ul>

                    <li>
                        <div class="process-one__single">
                            <div class="process-one__shape-1">
                                <img src="{{ asset('frontend_assets/assets/images/process-one-shape-1.png') }}" alt="">
                            </div>
                            <div class="process-one__icon">
                                <span><i class="fas fa-user"></i></span>
                            </div>
                            <div class="process-one__content">
                                <div class="process-one__count-box">
                                    <div class="process-one__count-text">
                                        <p>Step</p>
                                    </div>
                                    <div class="process-one__count"></div>
                                </div>
                                <h3 class="process-one__title">Create Your Athlete Profile</h3>
                            </div>
                        </div>
                    </li>

                    <li>
                        <div class="process-one__single">
                            <div class="process-one__shape-2">
                                <img src="{{ asset('frontend_assets/assets/images/process-one-shape-2.png') }}" alt="">
                            </div>
                            <div class="process-one__content">
                                <div class="process-one__count-box">
                                    <div class="process-one__count-text">
                                        <p>Step</p>
                                    </div>
                                    <div class="process-one__count"></div>
                                </div>
                                <h3 class="process-one__title">Profile Evaluation</h3>
                            </div>
                            <div class="process-one__icon">
                                <span><i class="fas fa-clipboard-check"></i></span>
                            </div>
                        </div>
                    </li>

                    <li>
                        <div class="process-one__single">
                            <div class="process-one__shape-1">
                                <img src="{{ asset('frontend_assets/assets/images/process-one-shape-1.png') }}" alt="">
                            </div>
                            <div class="process-one__icon">
                                <span><i class="fas fa-search-dollar"></i></span>
                            </div>
                            <div class="process-one__content">
                                <div class="process-one__count-box">
                                    <div class="process-one__count-text">
                                        <p>Step</p>
                                    </div>
                                    <div class="process-one__count"></div>
                                </div>
                                <h3 class="process-one__title">Scholarship Matching</h3>
                            </div>
                        </div>
                    </li>

                    <li>
                        <div class="process-one__single">
                            <div class="process-one__shape-2">
                                <img src="{{ asset('frontend_assets/assets/images/process-one-shape-2.png') }}" alt="">
                            </div>
                            <div class="process-one__content">
                                <div class="process-one__count-box">
                                    <div class="process-one__count-text">
                                        <p>Step</p>
                                    </div>
                                    <div class="process-one__count"></div>
                                </div>
                                <h3 class="process-one__title">Application Submission</h3>
                            </div>
                            <div class="process-one__icon">
                                <span><i class="fas fa-paper-plane"></i></span>
                            </div>
                        </div>
                    </li>

                    <li>
                        <div class="process-one__single">
                            <div class="process-one__shape-1">
                                <img src="{{ asset('frontend_assets/assets/images/process-one-shape-1.png') }}" alt="">
                            </div>
                            <div class="process-one__icon">
                                <span><i class="fas fa-comments"></i></span>
                            </div>
                            <div class="process-one__content">
                                <div class="process-one__count-box">
                                    <div class="process-one__count-text">
                                        <p>Step</p>
                                    </div>
                                    <div class="process-one__count"></div>
                                </div>
                                <h3 class="process-one__title">University Interaction</h3>
                            </div>
                        </div>
                    </li>

                    <li>
                        <div class="process-one__single">
                            <div class="process-one__content">
                                <div class="process-one__count-box">
                                    <div class="process-one__count-text">
                                        <p>Step</p>
                                    </div>
                                    <div class="process-one__count"></div>
                                </div>
                                <h3 class="process-one__title">Scholarship Offer</h3>
                            </div>
                            <div class="process-one__icon">
                                <span><i class="fas fa-award"></i></span>
                            </div>
                        </div>
                    </li>

                </ul>
            </div>
    </section>



    <div class="section-upcoming">
        <div class="container-fluid">
            <div class="common-widthsections">
                <div class="col-md-12 text-center mb-5">
                    <h5 class="section-heading-com">events</h5>
                    <h2 class="h2-common-alls">Check Our Upcoming Events</h2>
                </div>

                <div class="events-layout">


                    <div class="events-tabs" id="eventTabs">

                        <div class="event-tab active" data-index="0">
                            <img class="tab-thumb" src="{{ asset('frontend_assets/assets/images/events-1.jfif') }}" alt="Basketball" />
                            <div class="tab-info">
                                <a href="{{ route('frontend.event') }}">
                                    <div class="tab-title">National Indoor Court Male Basketball Game</div>
                                </a>
                                <div class="tab-date">
                                    <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <rect x="3" y="4" width="18" height="18" rx="2" />
                                        <path d="M16 2v4M8 2v4M3 10h18" />
                                    </svg>
                                    12:30 Pm, Thu 25 July 2025
                                </div>
                            </div>
                            <div class="tab-arrow">
                                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5"
                                    viewBox="0 0 24 24">
                                    <path d="M9 18l6-6-6-6" />
                                </svg>
                            </div>
                        </div>

                        <div class="event-tab" data-index="1">
                            <img class="tab-thumb" src="{{ asset('frontend_assets/assets/images/event-2.jfif') }}" alt="Workshop" />
                            <div class="tab-info">
                                <a href="{{ route('frontend.event') }}">
                                    <div class="tab-title">Workshop On Concentration And Mental Wellness</div>
                                </a>
                                <div class="tab-date">
                                    <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <rect x="3" y="4" width="18" height="18" rx="2" />
                                        <path d="M16 2v4M8 2v4M3 10h18" />
                                    </svg>
                                    12:30 Pm, Thu 16 Feb 2025
                                </div>
                            </div>
                            <div class="tab-arrow">
                                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5"
                                    viewBox="0 0 24 24">
                                    <path d="M9 18l6-6-6-6" />
                                </svg>
                            </div>
                        </div>

                        <div class="event-tab" data-index="2">
                            <img class="tab-thumb" src="{{ asset('frontend_assets/assets/images/event-3.jfif') }}" alt="Publishing" />
                            <div class="tab-info">
                                <a href="{{ route('frontend.event') }}">
                                    <div class="tab-title">Print And Publishing Preview Session</div>
                                </a>
                                <div class="tab-date">
                                    <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <rect x="3" y="4" width="18" height="18" rx="2" />
                                        <path d="M16 2v4M8 2v4M3 10h18" />
                                    </svg>
                                    12:30 Pm, Thu 20 Aug 2025
                                </div>
                            </div>
                            <div class="tab-arrow">
                                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5"
                                    viewBox="0 0 24 24">
                                    <path d="M9 18l6-6-6-6" />
                                </svg>
                            </div>
                        </div>

                        <div class="event-tab" data-index="3">
                            <img class="tab-thumb" src="{{ asset('frontend_assets/assets/images/event-4.jfif') }}" alt="Art Exhibit" />
                            <div class="tab-info">
                                <a href="{{ route('frontend.event') }}">
                                    <div class="tab-title">Student Art Exhibit – Chairs By Design Students</div>
                                </a>
                                <div class="tab-date">
                                    <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <rect x="3" y="4" width="18" height="18" rx="2" />
                                        <path d="M16 2v4M8 2v4M3 10h18" />
                                    </svg>
                                    12:30 Pm, Thu 15 Feb 2025
                                </div>
                            </div>
                            <div class="tab-arrow">
                                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5"
                                    viewBox="0 0 24 24">
                                    <path d="M9 18l6-6-6-6" />
                                </svg>
                            </div>
                        </div>
                        <div class="view-all-btn-wrap">
                            <a href="{{ route('frontend.upcomingevents') }}" class="view-all-btn">View All Events</a>
                        </div>
                    </div>


                    <div class="events-display">


                        <div class="event-panel active" data-panel="0">
                            <div class="panel-image-wrap">
                                <img src="{{ asset('frontend_assets/assets/images/events-1.jfif') }}" alt="Basketball Game" />
                                <div class="overlay"></div>
                                <div class="date-badge"><span class="day">25</span><span class="month">July</span></div>
                                <div class="panel-overlay">
                                    <div class="panel-title">National Indoor Court Male Basketball Game</div>
                                </div>
                            </div>
                        </div>

                        <div class="event-panel" data-panel="1">
                            <div class="panel-image-wrap">
                                <img src="{{ asset('frontend_assets/assets/images/event-2.jfif') }}" alt="Workshop" />
                                <div class="overlay"></div>
                                <div class="date-badge"><span class="day">16</span><span class="month">Feb</span></div>
                                <div class="panel-overlay">
                                    <div class="panel-title">Workshop On Concentration And Mental Wellness</div>

                                </div>
                            </div>
                        </div>

                        <div class="event-panel" data-panel="2">
                            <div class="panel-image-wrap">
                                <img src="{{ asset('frontend_assets/assets/images/event-3.jfif') }}" alt="Publishing" />
                                <div class="overlay"></div>
                                <div class="date-badge"><span class="day">20</span><span class="month">Aug</span></div>
                                <div class="panel-overlay">
                                    <div class="panel-title">Print And Publishing Preview Session</div>

                                </div>
                            </div>
                        </div>

                        <div class="event-panel" data-panel="3">
                            <div class="panel-image-wrap">
                                <img src="{{ asset('frontend_assets/assets/images/event-4.jfif') }}" alt="Art Exhibit" />
                                <div class="overlay"></div>
                                <div class="date-badge"><span class="day">15</span><span class="month">Feb</span></div>
                                <div class="panel-overlay">
                                    <div class="panel-title">Student Art Exhibit – Chairs By Design Students</div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <section class="past-events">
        <div class="container-fluid">
            <div class="common-widthsections">
                <div class="pe-section-header">
                    <div>
                        <h5 class="section-heading-com">events</h5>
                        <h2 class="h2-common-alls">Our Past Events</h2>
                    </div>


                    <a href="{{ route('frontend.pastEvents') }}" class="pe-explore-link">
                        Explore All
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>


                <div class="pe-grid-wrapper">


                    <div class="pe-stack-col">

                        <div class="pe-tile-horizontal">
                            <div class="pe-tile-content">
                                <div>
                                    <div class="pe-meta-bar">
                                        <i class="fas fa-user"></i> By Thomas
                                    </div>

                                    <a href="{{ route('frontend.event') }}">
                                        <div class="pe-event-title">
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, reiciendis.
                                        </div>
                                    </a>
                                </div>

                                <a href="{{ route('frontend.event') }}" class="pe-detail-btn">
                                    View Details
                                    <i class="fas fa-arrow-right"></i>
                                </a>

                            </div>

                            <div class="pe-tile-thumbnail">
                                <div class="pe-thumb-fill pe-grad-blue">
                                    <img src="{{ asset('frontend_assets/assets/images/event-2.jfif') }}" alt="events">
                                </div>

                                <div class="pe-status-ribbon">Ended</div>

                                <div class="pe-datestamp">
                                    <div class="pe-date-day">21</div>
                                    <div class="pe-date-mo">June, 25</div>
                                </div>
                            </div>
                        </div>



                        <div class="pe-tile-horizontal">
                            <div class="pe-tile-content">

                                <div>
                                    <div class="pe-meta-bar">
                                        <i class="fas fa-user"></i> By Thomas
                                    </div>

                                    <a href="{{ route('frontend.event') }}">
                                        <div class="pe-event-title">
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda,
                                            explicabo!
                                        </div>
                                    </a>
                                </div>

                                <a href="{{ route('frontend.event') }}" class="pe-detail-btn">
                                    View Details
                                    <i class="fas fa-arrow-right"></i>
                                </a>

                            </div>

                            <div class="pe-tile-thumbnail">
                                <div class="pe-thumb-fill pe-grad-warm">
                                    <img src="{{ asset('frontend_assets/assets/images/events-1.jfif') }}" alt="events">
                                </div>

                                <div class="pe-status-ribbon">Ended</div>

                                <div class="pe-datestamp">
                                    <div class="pe-date-day">21</div>
                                    <div class="pe-date-mo">June, 25</div>
                                </div>

                            </div>
                        </div>

                    </div>



                    <div class="pe-feature-col">

                        <div class="pe-tile-featured">

                            <div class="pe-tile-thumbnail">

                                <div class="pe-thumb-fill pe-grad-slate">
                                    <img src="{{ asset('frontend_assets/assets/images/event-3.jfif') }}" alt="events">
                                </div>

                                <div class="pe-status-ribbon">Ended</div>

                                <div class="pe-datestamp">
                                    <div class="pe-date-day">21</div>
                                    <div class="pe-date-mo">June, 25</div>
                                </div>

                            </div>


                            <div class="pe-tile-content">
                                <div>
                                    <div class="pe-meta-bar">
                                        <i class="fas fa-user"></i> By Thomas
                                    </div>

                                    <a href="{{ route('frontend.event') }}">
                                        <div class="pe-event-title">
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, numquam!
                                        </div>
                                    </a>

                                </div>


                                <a href="{{ route('frontend.event') }}" class="pe-detail-btn">
                                    View Details
                                    <i class="fas fa-arrow-right"></i>
                                </a>

                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>

   

@endsection