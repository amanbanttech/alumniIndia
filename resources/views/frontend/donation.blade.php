@extends('layout.frontend.app')
@section('content')

    <section class="scholarship-hero donation">
        <div class="hero-image"></div>
        <div class="container-fluid">
            <div class="hero-wrapper">
                <div class="hero-left"><img src="{{ asset('frontend_assets/assets/images/image-ovberlay.png') }}" alt=""
                        class="image-common-overlays">
                    <h1>Donation Campaigns</h1>
                    <div class="breadcrumb-content">
                        <a href="{{ route('frontend.index') }}">Home</a>
                        <span>»</span>
                        <span class="active">Donation Campaigns</span>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section>
        <div class="container-fluid">
            <div class="common-widthsections">
                <div class="about-section">
                    <div class="left-col">
                        <span class="label-pill">what we do</span>
                        <h2 class="headline">
                            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eaque, vel!
                        </h2>
                        <p class="sub-text">
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dicta, minus? Amet eum, iure
                            doloremque nemo repellendus nam praesentium ipsum, sapiente fugiat sed alias omnis nisi,
                            molestiae suscipit qui possimus laborum ipsam fuga deserunt! Nesciunt enim ab ex quod iste.
                            Inventore?
                        </p>

                        <div class="feature-cards">
                            <div class="feature-card">
                                <div class="icon-wrap">
                                    <svg viewBox="0 0 24 24">
                                        <path d="M22 10l-10-6L2 10l10 6 10-6z" />
                                        <path d="M6 12v5c0 2.21 2.686 4 6 4s6-1.79 6-4v-5" />
                                        <line x1="22" y1="10" x2="22" y2="16" />
                                    </svg>
                                </div>
                                <div class="feature-text">
                                    <h4>Empowering Students to Succeed</h4>
                                    <p>We provide scholarships and mentorship to help students build a stronger, more
                                        resilient
                                        future — together with supporters like you.</p>
                                </div>
                            </div>

                            <div class="feature-card">
                                <div class="icon-wrap">
                                    <svg viewBox="0 0 24 24">
                                        <path
                                            d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
                                    </svg>
                                </div>
                                <div class="feature-text">
                                    <h4>Putting Students First in Everything</h4>
                                    <p>Guided by compassion and the belief that every act of generosity can change the
                                        arc of a
                                        student's life.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="middle-col">
                        <div class="main-img-wrap">
                            <img src="{{ asset('frontend_assets/assets/images/donations-top.jfif') }}" alt="University students celebrating graduation" />
                        </div>
                    </div>

                    <div class="right-col">
                        <div class="mission-box">
                            <div class="mission-label">Our Mission</div>
                            <p>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Aperiam deserunt fuga vol natus
                                magni in nihil adipisci consequuntur, dolore iure sunt illum. Nesciunt?
                            </p>
                        </div>

                        <div class="thumb-img-wrap">
                            <img src="{{ asset('frontend_assets/assets/images/donation-image.jpg') }}" alt="Students receiving support and mentorship" />
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>



    <section class="banner-feature overflow-hidden">
        <div class="container-fluid">
            <div class="common-widthsections">
                <div class="row g-5">
                    <div class="col-lg-4">
                        <div class="card-list">
                            <div class="card-icon">
                                <img src="{{ asset('frontend_assets/assets/images/love-f.png') }}" alt="feature">
                            </div>
                            <div class="card-txt">
                                <h3 class="display-6">Building hope through giving.</h3>
                                <p>Every donation creates lasting impact. Together, we empower children to learn.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card-list">
                            <div class="card-icon">
                                <img src="{{ asset('frontend_assets/assets/images/donate-f.png') }}" alt="feature">
                            </div>
                            <div class="card-txt">
                                <h3 class="display-6">Your support changes futures.</h3>
                                <p>Contributions open doors to education. Safe classrooms and futures start with you.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card-list">
                            <div class="card-icon">
                                <img src="{{ asset('frontend_assets/assets/images/feat3.png') }}" alt="feature">
                            </div>
                            <div class="card-txt">
                                <h3 class="display-6">Protecting every child’s dream.</h3>
                                <p>From school meals to safe spaces, your help shields kids and nurtures potential.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="donation-categories">
        <div class="container-fluid">
            <div class="common-widthsections">
                <h5 class="section-heading-com">Donation</h5>
                <h2 class="h2-common-alls mb-5">Causes you can raise funds for</h2>
                <div class="category-grid">

                    <div class="category-card">
                        <div class="icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <h4>Education</h4>
                        <span></span>
                    </div>

                    <div class="category-card">
                        <div class="icon">
                            <i class="fas fa-heartbeat"></i>
                        </div>
                        <h4>Medical Support</h4>
                        <span></span>
                    </div>

                    <div class="category-card">
                        <div class="icon">
                            <i class="fas fa-child"></i>
                        </div>
                        <h4>Children Welfare</h4>
                        <span></span>
                    </div>

                    <div class="category-card">
                        <div class="icon">
                            <i class="fas fa-hands-helping"></i>
                        </div>
                        <h4>Community Help</h4>
                        <span></span>
                    </div>

                    <div class="category-card">
                        <div class="icon">
                            <i class="fas fa-paw"></i>
                        </div>
                        <h4>Animal Care</h4>
                        <span></span>
                    </div>

                    <div class="category-card">
                        <div class="icon">
                            <i class="fas fa-hand-holding-heart"></i>
                        </div>
                        <h4>Emergency Relief</h4>
                        <span></span>
                    </div>
                    <div class="category-card">
                        <div class="icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <h4>Education</h4>
                        <span></span>
                    </div>

                    <div class="category-card">
                        <div class="icon">
                            <i class="fas fa-heartbeat"></i>
                        </div>
                        <h4>Medical Support</h4>
                        <span></span>
                    </div>

                    <div class="category-card">
                        <div class="icon">
                            <i class="fas fa-child"></i>
                        </div>
                        <h4>Children Welfare</h4>
                        <span></span>
                    </div>

                    <div class="category-card">
                        <div class="icon">
                            <i class="fas fa-hands-helping"></i>
                        </div>
                        <h4>Community Help</h4>
                        <span></span>
                    </div>

                    <div class="category-card">
                        <div class="icon">
                            <i class="fas fa-paw"></i>
                        </div>
                        <h4>Animal Care</h4>
                        <span></span>
                    </div>

                    <div class="category-card">
                        <div class="icon">
                            <i class="fas fa-hand-holding-heart"></i>
                        </div>
                        <h4>Emergency Relief</h4>
                        <span></span>
                    </div>
                    <div class="category-card">
                        <div class="icon">
                            <i class="fas fa-paw"></i>
                        </div>
                        <h4>Animal Care</h4>
                        <span></span>
                    </div>

                    <div class="category-card">
                        <div class="icon">
                            <i class="fas fa-hand-holding-heart"></i>
                        </div>
                        <h4>Emergency Relief</h4>
                        <span></span>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="dc-section">
        <div class="container-fluid">
            <div class="common-widthsections">
                <h5 class="section-heading-com">donation</h5>
                <h2 class="h2-common-alls mb-5">Trending Campaigns</h2>

                <div class="dc-slider-wrap">

                    <div class="dc-slider-track" id="dcTrack">

                        <div class="dc-card">
                            <img src="https://images.unsplash.com/photo-1509099836639-18ba1795216d?w=600&q=80" alt="">
                            <div class="dc-card-body">
                                <p class="dc-prog-label">Donation</p>
                                <div class="dc-prog-wrap">
                                    <div class="dc-prog-tooltip" style="left:75%">75%</div>
                                    <div class="dc-prog-bar">
                                        <div class="dc-prog-fill" style="width:75%"></div>
                                    </div>
                                </div>
                                <div class="dc-prog-amounts"><span>Raised <strong>Rs. 10,000</strong></span><span>Goal
                                        Rs. 50,0000</span>
                                </div>
                                <p class="dc-card-title">Helping the Homeless During Hopeless Times</p>
                                <div class="dc-card-footer">
                                    <a href="#" class="dc-btn-donate">Donate Now <i class="fas fa-arrow-right"></i></a>
                                </div><img src="{{ asset('frontend_assets/assets/images/love-w.png') }}" alt="love icon" class="icon-love-btm">
                            </div>
                        </div>

                        <div class="dc-card">
                            <img src="https://images.unsplash.com/photo-1532629345422-7515f3d16bb6?w=600&q=80" alt="">
                            <div class="dc-card-body">
                                <p class="dc-prog-label">Donation</p>
                                <div class="dc-prog-wrap">
                                    <div class="dc-prog-tooltip" style="left:85%">85%</div>
                                    <div class="dc-prog-bar">
                                        <div class="dc-prog-fill" style="width:85%"></div>
                                    </div>
                                </div>
                                <div class="dc-prog-amounts"><span>Raised <strong>Rs. 10,000</strong></span><span>Goal
                                        Rs. 50,0000</span>
                                </div>
                                <p class="dc-card-title">Helping the Homeless During Hopeless Times</p>
                                <div class="dc-card-footer">
                                    <a href="#" class="dc-btn-donate">Donate Now <i class="fas fa-arrow-right"></i></a>

                                </div><img src="{{ asset('frontend_assets/assets/images/love-w.png') }}" alt="love icon" class="icon-love-btm">
                            </div>
                        </div>

                        <div class="dc-card">
                            <img src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?w=600&q=80" alt="">
                            <div class="dc-card-body">
                                <p class="dc-prog-label">Donation</p>
                                <div class="dc-prog-wrap">
                                    <div class="dc-prog-tooltip" style="left:45%">45%</div>
                                    <div class="dc-prog-bar">
                                        <div class="dc-prog-fill" style="width:45%"></div>
                                    </div>
                                </div>
                                <div class="dc-prog-amounts"><span>Raised <strong>Rs. 10,000</strong></span><span>Goal
                                        Rs. 50,0000</span>
                                </div>
                                <p class="dc-card-title">Fighting Hunger with Food Distribution Drives</p>
                                <div class="dc-card-footer">
                                    <a href="#" class="dc-btn-donate">Donate Now <i class="fas fa-arrow-right"></i></a>

                                </div><img src="{{ asset('frontend_assets/assets/images/love-w.png') }}" alt="love icon" class="icon-love-btm">
                            </div>
                        </div>

                        <div class="dc-card">
                            <img src="https://images.unsplash.com/photo-1509099836639-18ba1795216d?w=600&q=80" alt="">
                            <div class="dc-card-body">
                                <p class="dc-prog-label">Donation</p>
                                <div class="dc-prog-wrap">
                                    <div class="dc-prog-tooltip" style="left:90%">90%</div>
                                    <div class="dc-prog-bar">
                                        <div class="dc-prog-fill" style="width:90%"></div>
                                    </div>
                                </div>
                                <div class="dc-prog-amounts"><span>Raised <strong>Rs. 10,000</strong></span><span>Goal
                                        Rs. 50,0000</span>
                                </div>
                                <p class="dc-card-title">Helping the Homeless During Hopeless Times</p>
                                <div class="dc-card-footer">
                                    <a href="#" class="dc-btn-donate">Donate Now <i class="fas fa-arrow-right"></i></a>

                                </div><img src="{{ asset('frontend_assets/assets/images/love-w.png') }}" alt="love icon" class="icon-love-btm">
                            </div>
                        </div>

                        <div class="dc-card">
                            <img src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?w=600&q=80" alt="">
                            <div class="dc-card-body">
                                <p class="dc-prog-label">Donation</p>
                                <div class="dc-prog-wrap">
                                    <div class="dc-prog-tooltip" style="left:60%">60%</div>
                                    <div class="dc-prog-bar">
                                        <div class="dc-prog-fill" style="width:60%"></div>
                                    </div>
                                </div>
                                <div class="dc-prog-amounts"><span>Raised <strong>Rs. 10,000</strong></span><span>Goal
                                        Rs. 50,0000</span>
                                </div>
                                <p class="dc-card-title">Clean Water Access for Rural Communities</p>
                                <div class="dc-card-footer">
                                    <a href="#" class="dc-btn-donate">Donate Now <i class="fas fa-arrow-right"></i></a>

                                </div><img src="{{ asset('frontend_assets/assets/images/love-w.png') }}" alt="love icon" class="icon-love-btm">
                            </div>
                        </div>

                        <div class="dc-card">
                            <img src="https://images.unsplash.com/photo-1532629345422-7515f3d16bb6?w=600&q=80" alt="">
                            <div class="dc-card-body">
                                <p class="dc-prog-label">Donation</p>
                                <div class="dc-prog-wrap">
                                    <div class="dc-prog-tooltip" style="left:55%">55%</div>
                                    <div class="dc-prog-bar">
                                        <div class="dc-prog-fill" style="width:55%"></div>
                                    </div>
                                </div>
                                <div class="dc-prog-amounts"><span>Raised <strong>Rs. 10,000</strong></span><span>Goal
                                        Rs. 50,0000</span>
                                </div>
                                <p class="dc-card-title">Education Support for Underprivileged Children</p>
                                <div class="dc-card-footer">
                                    <a href="#" class="dc-btn-donate">Donate Now <i class="fas fa-arrow-right"></i></a>

                                </div><img src="{{ asset('frontend_assets/assets/images/love-w.png') }}" alt="love icon" class="icon-love-btm">
                            </div>
                        </div>

                    </div>

                </div>



            </div><br>
            <div class="btn-view-all-donations">
                <a href="" class="donation-all-views">Explore All<i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
    </section>

    <section class="fundraiser-section">
        <div class="container-fluid">
            <div class="common-widthsections">
                <h5 class="section-heading-com">simple steps</h5>
                <h2 class="h2-common-alls mb-5 text-center">Donation Campaign in three simple steps</h2>

                <div class="fundraiser-layout">
                    <div class="fundraiser-steps-list">

                        <div class="fundraiser-step-item">
                            <div class="fundraiser-step-icon-wrap">
                                <span class="fundraiser-step-badge">1</span>
                                <i class="fas fa-rocket"></i>
                            </div>

                            <div class="fundraiser-step-text">
                                <div class="fundraiser-step-title">Create your alumni campaign</div>

                                <p class="fundraiser-step-desc">
                                    Start a donation campaign in just a few minutes. Share your initiative to support
                                    scholarships, student athletes, research projects, or campus development.
                                </p>
                            </div>
                        </div>

                        <div class="fundraiser-step-item">
                            <div class="fundraiser-step-icon-wrap">
                                <span class="fundraiser-step-badge">2</span>
                                <i class="fas fa-share-nodes"></i>
                            </div>

                            <div class="fundraiser-step-text">
                                <div class="fundraiser-step-title">Share with the alumni network</div>

                                <p class="fundraiser-step-desc">
                                    Spread your campaign across the alumni community, classmates, and supporters.
                                    Every share helps bring your campaign closer to its goal.
                                </p>
                            </div>
                        </div>

                        <div class="fundraiser-step-item">
                            <div class="fundraiser-step-icon-wrap">
                                <span class="fundraiser-step-badge">3</span>
                                <i class="fas fa-hand-holding-dollar"></i>
                            </div>

                            <div class="fundraiser-step-text">
                                <div class="fundraiser-step-title">Receive and manage donations</div>

                                <p class="fundraiser-step-desc">
                                    Track donations in real time and manage contributions easily through the Alumni
                                    Connect dashboard.
                                </p>
                            </div>
                        </div>

                    </div>
                    <div class="fundraiser-phone-wrap">
                        <img src="{{ asset('frontend_assets/assets/images/alumni-groups.png') }}" alt="alumni-india">
                    </div>
                </div>
            </div>
        </div>

    </section>

    <section class="supports-section">
        <div class="container-fluid">
            <div class="common-widthsections">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-5">
                        <div class="text-center">
                            <img src="{{ asset('frontend_assets/assets/images/alumni-support.png') }}" alt="alumni-india">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h5 class="section-heading-com">support</h5>
                        <h2 class="h2-common-alls mb-3 ">Support Meaningful Alumni <br> Donation Campaigns</h2>
                        <p>Join the Alumni Connect community in supporting initiatives that make a real difference.
                            From student scholarships and athlete development to campus improvements and research
                            programs, your contribution helps empower the next generation and strengthen the
                            university community. Every donation, big or small, creates opportunities for students
                            and builds a lasting legacy for future alumni.</p>
                    </div>
                </div>
            </div>

        </div>

    </section>



    <section class="donation-donate-by">
        <div class="container-fluid">
            <div class="common-widthsections">
                <div class="div-fl-twos">
                    <div>
                        <h5 class="section-heading-com">Donation</h5>
                        <h2 class="h2-common-alls">Latest Donation Campaigns</h2>
                    </div>
                    <div class="btn-view-all-donations">
                        <a href="" class="donation-all-views">Explore All<i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="cards-grid">
                    <div class="featured-card">
                        <div class="featured-img-wrap">
                            <img src="{{ asset('frontend_assets/assets/images/alumnis.jpg') }}" alt="Tessa" />
                            <div class="featured-donation-badge">❤️ 15.6K donations</div>
                        </div>
                        <div class="featured-body">
                            <h2>Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet!</h2>
                            <div class="progress-track">
                                <div class="progress-fill" style="width:50%"></div>
                            </div>
                            <div class="pct-row">
                                <span class="pct-bar-label">50% funded</span>
                                <span class="pct-note">Rs. 25,000 remaining</span>
                            </div>
                            <div class="money-row">
                                <div>
                                    <div class="raised-amount">Rs. 50,000 raised</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="side-grid">

                        <div class="small-card">
                            <div class="small-img-wrap">
                                <img src="https://images.unsplash.com/photo-1529156069898-49953e39b3ac?w=600&q=80"
                                    alt="Hamish" />
                                <div class="img-overlay"></div>
                                <div class="small-tag"><span class="tag tag-medical">Medical</span></div>
                                <div class="small-donation-badge">❤️ 1.3K donations</div>
                            </div>
                            <div class="featured-body">
                                <h3>Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet!</h3>
                                <div class="progress-track">
                                    <div class="progress-fill" style="width:50%"></div>
                                </div>
                                <div class="pct-row">
                                    <span class="pct-bar-label">50% funded</span>
                                    <span class="pct-note">Rs. 25,000 remaining</span>
                                </div>
                                <div class="money-row">
                                    <div>
                                        <div class="raised-amount">Rs. 50,000 raised</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="small-card">
                            <div class="small-img-wrap">
                                <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=600&q=80"
                                    alt="Gigi" />
                                <div class="img-overlay"></div>
                                <div class="small-tag"><span class="tag tag-urgent">Urgent</span></div>
                                <div class="small-donation-badge">❤️ 17.5K donations</div>
                            </div>
                            <div class="featured-body">
                                <h3>Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet!</h3>
                                <div class="progress-track">
                                    <div class="progress-fill" style="width:50%"></div>
                                </div>
                                <div class="pct-row">
                                    <span class="pct-bar-label">50% funded</span>
                                    <span class="pct-note">Rs. 25,000 remaining</span>
                                </div>
                                <div class="money-row">
                                    <div>
                                        <div class="raised-amount">Rs. 50,000 raised</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="small-card">
                            <div class="small-img-wrap">
                                <img src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=600&q=80"
                                    alt="Rudy" />
                                <div class="img-overlay"></div>
                                <div class="small-tag"><span class="tag tag-emergency">Emergency</span></div>
                                <div class="small-donation-badge">❤️ 8.4K donations</div>
                            </div>
                            <div class="featured-body">
                                <h3>Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet!</h3>
                                <div class="progress-track">
                                    <div class="progress-fill" style="width:50%"></div>
                                </div>
                                <div class="pct-row">
                                    <span class="pct-bar-label">50% funded</span>
                                    <span class="pct-note">Rs. 25,000 remaining</span>
                                </div>
                                <div class="money-row">
                                    <div>
                                        <div class="raised-amount">Rs. 50,000 raised</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="small-card">
                            <div class="small-img-wrap">
                                <img src="https://images.unsplash.com/photo-1511285560929-80b456fea0bc?w=600&q=80"
                                    alt="Ryan" />
                                <div class="small-donation-badge">❤️ 832 donations</div>
                            </div>
                            <div class="featured-body">
                                <h3>Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet!</h3>
                                <div class="progress-track">
                                    <div class="progress-fill" style="width:50%"></div>
                                </div>
                                <div class="pct-row">
                                    <span class="pct-bar-label">50% funded</span>
                                    <span class="pct-note">Rs. 25,000 remaining</span>
                                </div>
                                <div class="money-row">
                                    <div>
                                        <div class="raised-amount">Rs. 50,000 raised</div>
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