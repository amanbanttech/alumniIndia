@extends('layout.frontend.app')
@section('content')
    <section class="scholarship-hero event-details">
        <div class="hero-image"></div>
        <div class="container-fluid">
            <div class="hero-wrapper">
                <div class="hero-left"><img src="{{ asset('frontend_assets/assets/images/image-ovberlay.png') }}" alt="" class="image-common-overlays">
                    <h1>Event Details</h1>
                    <div class="breadcrumb-content">
                        <a href="{{ route('frontend.index') }}">Home</a>
                        <span>»</span>
                        <span class="active">Event Details</span>
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
                        <h5 class="section-heading-com text-center">Evenst</h5>
                        <h2 class="h2-common-alls text-center mb-5">Event Details</h2>
                    </div>
                    <div class="col-md-12">
                        <div class="row justify-content-center">


                            <div class="col-md-7">


                                <div class="edl-hero">
                                    <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=900&q=80"
                                        alt="Event hero" />
                                    <span class="edl-hero-badge">Featured</span>
                                    <span class="edl-hero-tag">🎓 Education</span>
                                </div>


                                <div class="edl-subsection">
                                    <h2 class="edl-section-title">
                                        About The Event
                                        <span class="edl-accent-line"></span>
                                    </h2>
                                    <p class="edl-body-text">
                                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aliquid similique eius
                                        non aut ratione velit minima quo odit neque est voluptatibus tenetur doloremque,
                                        quos fuga corporis dicta et? Enim doloremque at cum aliquam saepe veritatis eius
                                        harum, fuga, voluptatum expedita atque eaque hic. Odio praesentium, nam omnis ab
                                        tempora voluptatum.
                                    </p>
                                </div>


                                <div class="edl-subsection">
                                    <h3 class="edl-subsection-title">Where The Event?</h3>
                                    <p class="edl-body-text">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt, cumque quis
                                        iste autem reprehenderit corrupti in voluptas doloribus, possimus maxime fuga?
                                        Necessitatibus illum quis enim sit consequuntur inventore accusamus molestiae
                                        repellat magnam minus accusantium incidunt doloremque sapiente, beatae a optio
                                        assumenda saepe dolorum officiis dolore deleniti soluta dignissimos, numquam
                                        earum. Fugit assumenda possimus obcaecati vero soluta sapiente atque
                                        consequuntur itaque deserunt non? Eius, quidem. Provident eos atque dolores eum
                                        voluptatem.
                                    </p>
                                </div>


                                <div class="edl-photo-grid">
                                    <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=600&q=80"
                                        alt="Event gallery 1" />
                                    <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?w=600&q=80"
                                        alt="Event gallery 2" />
                                </div>


                                <div class="edl-subsection">
                                    <h3 class="edl-subsection-title">Who This Event Is For?</h3>
                                    <p class="edl-body-text">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, necessitatibus
                                        voluptatum impedit inventore eius maxime incidunt, neque repudiandae provident
                                        minus tempora est labore? Necessitatibus mollitia quidem error cum aliquam quia
                                        reiciendis qui optio possimus perspiciatis non officia, fugiat, ex dolor cumque
                                        recusandae quaerat aliquid hic alias voluptates, laudantium distinctio
                                        dignissimos quos. Ipsum culpa nam doloribus architecto rerum numquam, dolores
                                        ab.
                                    </p>
                                </div>
                            </div>


                            <div class="col-md-3">

                                <div class="edl-card">
                                    <div class="edl-card-title">Event Information</div>
                                    <p class="edl-card-subtitle">Secure your spot before seats fill up. Limited
                                        availability for in-person
                                        attendance.</p>
                                    <div class="edl-info-rows">
                                        <div class="edl-info-row">
                                            <div class="edl-info-icon">
                                                <svg width="18" height="18" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor" stroke-width="2">
                                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                                                    <line x1="16" y1="2" x2="16" y2="6" />
                                                    <line x1="8" y1="2" x2="8" y2="6" />
                                                    <line x1="3" y1="10" x2="21" y2="10" />
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="edl-info-label">Event Date</div>
                                                <div class="edl-info-value">25 June 2024</div>
                                            </div>
                                        </div>

                                        <div class="edl-info-row">
                                            <div class="edl-info-icon">
                                                <svg width="18" height="18" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor" stroke-width="2">
                                                    <circle cx="12" cy="12" r="10" />
                                                    <polyline points="12 6 12 12 16 14" />
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="edl-info-label">Event Time</div>
                                                <div class="edl-info-value">9:00 AM – 6:00 PM</div>
                                            </div>
                                        </div>

                                        <div class="edl-info-row">
                                            <div class="edl-info-icon">
                                                <svg width="18" height="18" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="edl-info-label">Location</div>
                                                <div class="edl-info-value">Tirupati Heights Kargaina</div>
                                            </div>
                                        </div>



                                    </div>




                                </div>





                                <div class="edl-card">
                                    <div class="edl-card-title">Event Tags</div>
                                    <div class="edl-tags">
                                        <span class="edl-tag">#Technology</span>
                                        <span class="edl-tag">#Innovation</span>
                                        <span class="edl-tag">#AI</span>
                                        <span class="edl-tag">#Networking</span>
                                        <span class="edl-tag">#Education</span>
                                        <span class="edl-tag">#Workshop</span>
                                        <span class="edl-tag">#Startup</span>
                                        <span class="edl-tag">#NewYork</span>
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