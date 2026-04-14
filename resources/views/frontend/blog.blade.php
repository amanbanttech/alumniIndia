@extends('layout.frontend.app')
@section('content')





    <section class="scholarship-hero blog">
        <div class="hero-image"></div>
        <div class="container-fluid">
            <div class="hero-wrapper">
                <div class="hero-left"><img src="{{ asset('frontend_assets/assets/images/image-ovberlay.png') }}" alt="" class="image-common-overlays">
                    <h1>Blog</h1>
                    <div class="breadcrumb-content">
                        <a href="{{ route('frontend.index') }}">Home</a>
                        <span>»</span>
                        <span class="active">Blog</span>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="blog-section">
        <div class="container-fluid">
            <div class="common-widthsections">
                <h5 class="section-heading-com">blog</h5>
                <h2 class="h2-common-alls mb-5 text-center">All blogs</h2>
                <div class="row g-4">
                    <div class="col-lg-3 col-md-4">
                        <div class="sidebar-box">
                            <div class="sidebar-title">Search</div>
                            <div class="title-underline"><span></span></div>
                            <div class="search-input-wrap">
                                <input type="text" placeholder="Search Here..." />
                                <i class="fas fa-search search-icon"></i>
                            </div>
                        </div>


                        <div class="sidebar-box">
                            <div class="sidebar-title">Category</div>
                            <div class="title-underline"><span></span><span></span></div>
                            <ul class="category-list">
                                <li>
                                    <a href=""><span class="cat-left"><i class="fas fa-arrow-right"></i>
                                            Donations</span>
                                        <span class="cat-count">(10)</span></a>
                                </li>
                                <li>
                                    <a href=""><span class="cat-left"><i class="fas fa-arrow-right"></i>
                                            Improve Your Skills</span>
                                        <span class="cat-count">(10)</span></a>
                                </li>
                                <li>
                                    <a href=""><span class="cat-left"><i class="fas fa-arrow-right"></i>
                                            Donations</span>
                                        <span class="cat-count">(10)</span></a>
                                </li>
                                <li>
                                    <a href=""><span class="cat-left"><i class="fas fa-arrow-right"></i>
                                            Improve Your Skills</span>
                                        <span class="cat-count">(10)</span></a>
                                </li>
                                <li>
                                    <a href=""><span class="cat-left"><i class="fas fa-arrow-right"></i>
                                            Donations</span>
                                        <span class="cat-count">(10)</span></a>
                                </li>
                                <li>
                                    <a href=""><span class="cat-left"><i class="fas fa-arrow-right"></i>
                                            Improve Your Skills</span>
                                        <span class="cat-count">(10)</span></a>
                                </li>
                            </ul>
                        </div>

                    </div>

                    <div class="col-lg-9 col-md-8">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-6 mt-2">
                                <div class="card-blogs">
                                    <div class="card-img-wrap">
                                        <img src="https://images.unsplash.com/photo-1515378791036-0648a3ef77b2?w=600&q=80"
                                            alt="Study Space" />
                                        <div class="card-badge-wrap">
                                            <span class="badge-cat">Donations</span>
                                        </div>
                                    </div>
                                    <div class="card-meta">
                                        <span><i class="fas fa-user-circle"></i> By Admin</span>
                                        <span><i class="fas fa-calendar"></i> 25, Aug 2026</span>
                                    </div>
                                    <div class="card-body">
                                        <h5>Creating a Productive Study Space for Online Learning.</h5>
                                        <p>Discover thoughtful articles filled with ideas, experiences, and insights
                                            that
                                            matter
                                            to your journey.</p>
                                        <a href="#" class="learn-more-blog">View more <i
                                                class="fas fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-sm-6 mt-2">
                                <div class="card-blogs">
                                    <div class="card-img-wrap">
                                        <img src="https://images.unsplash.com/photo-1501504905252-473c47e087f8?w=600&q=80"
                                            alt="Skills" />
                                        <div class="card-badge-wrap">
                                            <span class="badge-cat">Donations</span>
                                        </div>
                                    </div>
                                    <div class="card-meta">
                                        <span><i class="fas fa-user-circle"></i> By Admin</span>
                                        <span><i class="fas fa-calendar"></i> 25, Aug 2026</span>
                                    </div>
                                    <div class="card-body">
                                        <h5>Top Skills Every Modern Professional Should Develop in 2024.</h5>
                                        <p>Stay curious, keep learning, and explore stories that make a real difference
                                            in
                                            your
                                            career path.</p>
                                        <a href="#" class="learn-more-blog">View more <i
                                                class="fas fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-sm-6 mt-2">
                                <div class="card-blogs">
                                    <div class="card-img-wrap">
                                        <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=600&q=80"
                                            alt="Courses" />
                                        <div class="card-badge-wrap">
                                            <span class="badge-cat">Donations</span>
                                        </div>
                                    </div>
                                    <div class="card-meta">
                                        <span><i class="fas fa-user-circle"></i> By Admin</span>
                                        <span><i class="fas fa-calendar"></i> 25, Aug 2026</span>
                                    </div>
                                    <div class="card-body">
                                        <h5>How Online Courses Are Transforming the Future of Education.</h5>
                                        <p>Our blog is designed to inform, inspire, and support your journey with
                                            valuable
                                            knowledge.</p>
                                        <a href="#" class="learn-more-blog">View more <i
                                                class="fas fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-sm-6 mt-2">
                                <div class="card-blogs">
                                    <div class="card-img-wrap">
                                        <img src="https://images.unsplash.com/photo-1488190211105-8b0e65b80b4e?w=600&q=80"
                                            alt="Knowledge" />
                                        <div class="card-badge-wrap">
                                            <span class="badge-cat">Donations</span>
                                        </div>
                                    </div>
                                    <div class="card-meta">
                                        <span><i class="fas fa-user-circle"></i> By Admin</span>
                                        <span><i class="fas fa-calendar"></i> 25, Aug 2026</span>
                                    </div>
                                    <div class="card-body">
                                        <h5>Building Basic Knowledge That Stays with You for a Lifetime.</h5>
                                        <p>Real-life perspectives that help you build a strong foundation for continuous
                                            learning.</p>
                                        <a href="#" class="learn-more-blog">View more <i
                                                class="fas fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-sm-6 mt-2">
                                <div class="card-blogs">
                                    <div class="card-img-wrap">
                                        <img src="https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=600&q=80"
                                            alt="Professional" />
                                        <div class="card-badge-wrap">
                                            <span class="badge-cat">Donations</span>

                                        </div>
                                    </div>
                                    <div class="card-meta">
                                        <span><i class="fas fa-user-circle"></i> By Admin</span>
                                        <span><i class="fas fa-calendar"></i> 25, Aug 2026</span>
                                    </div>
                                    <div class="card-body">
                                        <h5>Professional Growth Strategies to Level Up Your Career Fast.</h5>
                                        <p>Insights and experience-backed stories to propel your professional journey
                                            forward.
                                        </p>
                                        <a href="#" class="learn-more-blog">View more <i
                                                class="fas fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6 mt-2">
                                <div class="card-blogs">
                                    <div class="card-img-wrap">
                                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=600&q=80"
                                            alt="Complete" />
                                        <div class="card-badge-wrap">
                                            <span class="badge-cat">Donations</span>
                                        </div>
                                    </div>
                                    <div class="card-meta">
                                        <span><i class="fas fa-user-circle"></i> By Admin</span>
                                        <span><i class="fas fa-calendar"></i> 25, Aug 2026</span>
                                    </div>
                                    <div class="card-body">
                                        <h5>Complete Course Guides That Help You Master Any Subject Quickly.</h5>
                                        <p>Everything you need in one place — structured, clear, and built for
                                            real-world
                                            success.</p>
                                        <a href="#" class="learn-more-blog">View more <i
                                                class="fas fa-arrow-right"></i></a>
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