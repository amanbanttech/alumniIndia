@extends('layout.frontend.app')
@section('content')




    <section class="scholarship-hero upcoming-events">
        <div class="hero-image"></div>
        <div class="container-fluid">
            <div class="hero-wrapper">
                <div class="hero-left"><img src="{{ asset('frontend_assets/assets/images/image-ovberlay.png') }}" alt="" class="image-common-overlays">
                    <h1>Upcoming Event</h1>
                    <div class="breadcrumb-content">
                        <a href="{{ route('frontend.index') }}">Home</a>
                        <span>»</span>
                        <span class="active">Upcoming Event</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="past-evenst">
        <div class="container-fluid">
            <div class="common-widthsections">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-12">
                        <h5 class="section-heading-com text-center">Events</h5>
                        <h2 class="h2-common-alls text-center mb-5">Upcoming Events</h2>
                    </div>
                    <div class="col-md-10">

                        <div class="row g-4">

                            <div class="col-12 col-md-6 col-lg-4  mb-4">
                                <div class="evc-card">
                                    <div class="evc-card-location">
                                        <span class="evc-location-dot">
                                            <svg width="10" height="10" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" stroke-width="2.5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </span>
                                        Tirupati Heights Kargaina
                                    </div>
                                    <div class="evc-card-img-wrap">
                                        <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=600&q=80"
                                            alt="High School Program" />
                                        <!-- <span class="evc-img-badge">Education</span> -->
                                    </div>
                                    <div class="evc-card-body">
                                        <div class="evc-meta-row">
                                            <div class="evc-meta-item">
                                                <svg width="14" height="14" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor" stroke-width="2">
                                                    <rect x="3" y="4" width="18" height="18" rx="2" />
                                                    <line x1="16" y1="2" x2="16" y2="6" />
                                                    <line x1="8" y1="2" x2="8" y2="6" />
                                                    <line x1="3" y1="10" x2="21" y2="10" />
                                                </svg>
                                                16 June, 2024
                                            </div>
                                            <span class="evc-meta-divider"></span>
                                            <div class="evc-meta-item">
                                                <svg width="14" height="14" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor" stroke-width="2">
                                                    <circle cx="12" cy="12" r="10" />
                                                    <polyline points="12 6 12 12 16 14" />
                                                </svg>
                                                10.00AM – 04.00PM
                                            </div>
                                        </div>
                                        <div class="evc-card-title">High School Program 2024</div>
                                        <p class="evc-card-desc">There are many variations of passages the majority have
                                            some injected humour
                                            into the event.</p>
                                        <div class="evc-card-footer">
                                            <a href="{{ route('frontend.event') }}" class="evc-join-btn">
                                                View more
                                                <svg width="15" height="15" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor" stroke-width="2.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M14 5l7 7-7 7M3 12h18" />
                                                </svg>
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-12 col-md-6 col-lg-4 mb-4">
                                <div class="evc-card">
                                    <div class="evc-card-location">
                                        <span class="evc-location-dot">
                                            <svg width="10" height="10" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" stroke-width="2.5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </span>
                                        Tirupati Heights Kargaina
                                    </div>
                                    <div class="evc-card-img-wrap">
                                        <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?w=600&q=80"
                                            alt="Tech Summit" />
                                        <!-- <span class="evc-img-badge evc-badge-gold">Workshop</span> -->
                                    </div>
                                    <div class="evc-card-body">
                                        <div class="evc-meta-row">
                                            <div class="evc-meta-item">
                                                <svg width="14" height="14" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor" stroke-width="2">
                                                    <rect x="3" y="4" width="18" height="18" rx="2" />
                                                    <line x1="16" y1="2" x2="16" y2="6" />
                                                    <line x1="8" y1="2" x2="8" y2="6" />
                                                    <line x1="3" y1="10" x2="21" y2="10" />
                                                </svg>
                                                16 June, 2024
                                            </div>
                                            <span class="evc-meta-divider"></span>
                                            <div class="evc-meta-item">
                                                <svg width="14" height="14" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor" stroke-width="2">
                                                    <circle cx="12" cy="12" r="10" />
                                                    <polyline points="12 6 12 12 16 14" />
                                                </svg>
                                                10.00AM – 04.00PM
                                            </div>
                                        </div>
                                        <div class="evc-card-title">High School Program 2024</div>
                                        <p class="evc-card-desc">There are many variations of passages the majority have
                                            some injected humour
                                            into the event.</p>
                                        <div class="evc-card-footer">
                                            <a href="{{ route('frontend.event') }}" class="evc-join-btn">
                                                View more
                                                <svg width="15" height="15" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor" stroke-width="2.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M14 5l7 7-7 7M3 12h18" />
                                                </svg>
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-12 col-md-6 col-lg-4 mb-4">
                                <div class="evc-card">
                                    <div class="evc-card-location">
                                        <span class="evc-location-dot">
                                            <svg width="10" height="10" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" stroke-width="2.5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </span>
                                        Tirupati Heights Kargaina
                                    </div>
                                    <div class="evc-card-img-wrap">
                                        <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=600&q=80"
                                            alt="Innovation Conference" />
                                        <!-- <span class="evc-img-badge">Networking</span> -->
                                    </div>
                                    <div class="evc-card-body">
                                        <div class="evc-meta-row">
                                            <div class="evc-meta-item">
                                                <svg width="14" height="14" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor" stroke-width="2">
                                                    <rect x="3" y="4" width="18" height="18" rx="2" />
                                                    <line x1="16" y1="2" x2="16" y2="6" />
                                                    <line x1="8" y1="2" x2="8" y2="6" />
                                                    <line x1="3" y1="10" x2="21" y2="10" />
                                                </svg>
                                                16 June, 2024
                                            </div>
                                            <span class="evc-meta-divider"></span>
                                            <div class="evc-meta-item">
                                                <svg width="14" height="14" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor" stroke-width="2">
                                                    <circle cx="12" cy="12" r="10" />
                                                    <polyline points="12 6 12 12 16 14" />
                                                </svg>
                                                10.00AM – 04.00PM
                                            </div>
                                        </div>
                                        <div class="evc-card-title">High School Program 2024</div>
                                        <p class="evc-card-desc">There are many variations of passages the majority have
                                            some injected humour
                                            into the event.</p>
                                        <div class="evc-card-footer">
                                            <a href="{{ route('frontend.event') }}" class="evc-join-btn">
                                                View more
                                                <svg width="15" height="15" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor" stroke-width="2.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M14 5l7 7-7 7M3 12h18" />
                                                </svg>
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-12 col-md-6 col-lg-4 mb-4">
                                <div class="evc-card">
                                    <div class="evc-card-location">
                                        <span class="evc-location-dot">
                                            <svg width="10" height="10" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" stroke-width="2.5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </span>
                                        Tirupati Heights Kargaina
                                    </div>
                                    <div class="evc-card-img-wrap">
                                        <img src="https://images.unsplash.com/photo-1517048676732-d65bc937f952?w=600&q=80"
                                            alt="Leadership Summit" />
                                        <!-- <span class="evc-img-badge">Leadership</span> -->
                                    </div>
                                    <div class="evc-card-body">
                                        <div class="evc-meta-row">
                                            <div class="evc-meta-item">
                                                <svg width="14" height="14" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor" stroke-width="2">
                                                    <rect x="3" y="4" width="18" height="18" rx="2" />
                                                    <line x1="16" y1="2" x2="16" y2="6" />
                                                    <line x1="8" y1="2" x2="8" y2="6" />
                                                    <line x1="3" y1="10" x2="21" y2="10" />
                                                </svg>
                                                20 June, 2024
                                            </div>
                                            <span class="evc-meta-divider"></span>
                                            <div class="evc-meta-item">
                                                <svg width="14" height="14" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor" stroke-width="2">
                                                    <circle cx="12" cy="12" r="10" />
                                                    <polyline points="12 6 12 12 16 14" />
                                                </svg>
                                                09.00AM – 05.00PM
                                            </div>
                                        </div>
                                        <div class="evc-card-title">Youth Leadership Summit 2024</div>
                                        <p class="evc-card-desc">Empowering the next generation with the skills and
                                            mindset to lead with purpose
                                            and vision.</p>
                                        <div class="evc-card-footer">
                                            <a href="{{ route('frontend.event') }}" class="evc-join-btn">
                                                View more
                                                <svg width="15" height="15" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor" stroke-width="2.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M14 5l7 7-7 7M3 12h18" />
                                                </svg>
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-12 col-md-6 col-lg-4 mb-4">
                                <div class="evc-card">
                                    <div class="evc-card-location">
                                        <span class="evc-location-dot">
                                            <svg width="10" height="10" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" stroke-width="2.5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </span>
                                        Tirupati Heights Kargaina
                                    </div>
                                    <div class="evc-card-img-wrap">
                                        <img src="https://images.unsplash.com/photo-1559136555-9303baea8ebd?w=600&q=80"
                                            alt="AI Conference" />
                                        <!-- <span class="evc-img-badge evc-badge-gold">Technology</span> -->
                                    </div>
                                    <div class="evc-card-body">
                                        <div class="evc-meta-row">
                                            <div class="evc-meta-item">
                                                <svg width="14" height="14" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor" stroke-width="2">
                                                    <rect x="3" y="4" width="18" height="18" rx="2" />
                                                    <line x1="16" y1="2" x2="16" y2="6" />
                                                    <line x1="8" y1="2" x2="8" y2="6" />
                                                    <line x1="3" y1="10" x2="21" y2="10" />
                                                </svg>
                                                25 June, 2024
                                            </div>
                                            <span class="evc-meta-divider"></span>
                                            <div class="evc-meta-item">
                                                <svg width="14" height="14" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor" stroke-width="2">
                                                    <circle cx="12" cy="12" r="10" />
                                                    <polyline points="12 6 12 12 16 14" />
                                                </svg>
                                                10.00AM – 06.00PM
                                            </div>
                                        </div>
                                        <div class="evc-card-title">Future of AI Conference 2024</div>
                                        <p class="evc-card-desc">Dive deep into the world of artificial intelligence
                                            with leading researchers,
                                            builders, and visionaries.</p>
                                        <div class="evc-card-footer">
                                            <a href="{{ route('frontend.event') }}" class="evc-join-btn">
                                                View more
                                                <svg width="15" height="15" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor" stroke-width="2.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M14 5l7 7-7 7M3 12h18" />
                                                </svg>
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-12 col-md-6 col-lg-4 mb-4">
                                <div class="evc-card">
                                    <div class="evc-card-location">
                                        <span class="evc-location-dot">
                                            <svg width="10" height="10" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" stroke-width="2.5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </span>
                                        Tirupati Heights Kargaina
                                    </div>
                                    <div class="evc-card-img-wrap">
                                        <img src="https://images.unsplash.com/photo-1491438590914-bc09fcaaf77a?w=600&q=80"
                                            alt="Creative Workshop" />
                                        <!-- <span class="evc-img-badge">Workshop</span> -->
                                    </div>
                                    <div class="evc-card-body">
                                        <div class="evc-meta-row">
                                            <div class="evc-meta-item">
                                                <svg width="14" height="14" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor" stroke-width="2">
                                                    <rect x="3" y="4" width="18" height="18" rx="2" />
                                                    <line x1="16" y1="2" x2="16" y2="6" />
                                                    <line x1="8" y1="2" x2="8" y2="6" />
                                                    <line x1="3" y1="10" x2="21" y2="10" />
                                                </svg>
                                                28 June, 2024
                                            </div>
                                            <span class="evc-meta-divider"></span>
                                            <div class="evc-meta-item">
                                                <svg width="14" height="14" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor" stroke-width="2">
                                                    <circle cx="12" cy="12" r="10" />
                                                    <polyline points="12 6 12 12 16 14" />
                                                </svg>
                                                11.00AM – 03.00PM
                                            </div>
                                        </div>
                                        <div class="evc-card-title">Creative Design Workshop 2024</div>
                                        <p class="evc-card-desc">Hands-on sessions covering UI/UX, branding,
                                            illustration, and modern design
                                            thinking methods.</p>
                                        <div class="evc-card-footer">
                                            <a href="{{ route('frontend.event') }}" class="evc-join-btn">
                                                View more
                                                <svg width="15" height="15" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor" stroke-width="2.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M14 5l7 7-7 7M3 12h18" />
                                                </svg>
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>


  

@endsection