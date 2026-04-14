@extends('layout.frontend.app')
@section('content')
    <section class="scholarship-hero blog">
        <div class="hero-image"></div>
        <div class="container-fluid">
            <div class="hero-wrapper">
                <div class="hero-left"><img src="{{ asset('frontend_assets/assets/images/image-ovberlay.png') }}" alt="" class="image-common-overlays">
                    <h1>Contact Us</h1>
                    <div class="breadcrumb-content">
                        <a href="{{ route('frontend.index') }}">Home</a>
                        <span>»</span>
                        <span class="active">Contact Us</span>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="contact-area py-120">
        <div class="container-fluid">
            <div class="common-widthsections">
                <div class="contact-content">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="contact-info">
                                <div class="contact-info-icon">
                                    <i class="fas fa-map-location-dot"></i>
                                </div>
                                <div class="contact-info-content">
                                    <h5>Office Address</h5>
                                    <p>Lorem ipsum dolor sit amet consectetur.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="contact-info">
                                <div class="contact-info-icon">
                                    <i class="fas fa-phone-volume"></i>
                                </div>
                                <div class="contact-info-content">
                                    <h5>Call Us</h5>
                                    <p><a href="tel:+91-99999999999">+91-99999999999</a><br><a
                                            href="tel:+91-99999999999">+91-99999999999</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="contact-info">
                                <div class="contact-info-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="contact-info-content">
                                    <h5>Email Us</h5>
                                    <p><a href="mailto:info@alumni.com">info@alumni.com</a><br><a
                                            href="tel:info@alumni2.com">info@alumni2.com</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="contact-info">
                                <div class="contact-info-icon">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="contact-info-content">
                                    <h5>Open Time</h5>
                                    <p>Mon - Sat (10.00AM - 05.30PM)
                                        <br>
                                        Sunday Close
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="contact-wrapper">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="contact-img">
                                <img src="{{ asset('frontend_assets/assets/images/contact.png') }}" alt="">
                            </div>
                        </div>
                        <div class="col-lg-7 align-self-center">
                            <div class="contact-form">
                                <div class="contact-form-header">
                                    <h2>Get In Touch</h2>
                                    <p>Let’s connect and start the conversation. </p>
                                </div>
                                <form method="post" action="" id="contact-form">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="name" placeholder="Your Name"
                                                    required="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="email" class="form-control" name="email"
                                                    placeholder="Your Email" required="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="subject" placeholder="Your Phone"
                                            required="">
                                    </div>
                                    <div class="form-group">
                                        <textarea name="message" cols="30" rows="7" class="form-control"
                                            placeholder="Write Your Message"></textarea>
                                    </div>
                                    <button type="submit" class="theme-btn">Send
                                        Message <i class="far fa-paper-plane"></i></button>
                                    <div class="col-md-12 mt-3">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div>
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3512.1827200689568!2d79.3902150760375!3d28.323071598065393!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39a0014b683cd615%3A0xfefe94d8a934389a!2sTirupati%20Heights%20Colony%20Kargaina%20Bareilly!5e0!3m2!1sen!2sin!4v1773485894505!5m2!1sen!2sin"
            width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>


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






    <!-----second-section-change-animations-->
    <script>
        const sections = document.querySelectorAll('.section-item');
        const images = document.querySelectorAll('.image-item');
        const shapes = document.querySelectorAll('.bg-shape');
        const leftContent = document.querySelector('.left-content');

        function updateActiveSection() {
            // Check if mobile
            if (window.innerWidth <= 768) {
                images.forEach(img => img.classList.add('active'));
                shapes.forEach(shape => shape.classList.add('active'));
                return;
            }

            const scrollPos = window.scrollY;
            const viewportHeight = window.innerHeight;
            const leftContentTop = leftContent.getBoundingClientRect().top + scrollPos;

            sections.forEach((section, index) => {
                const sectionTop = section.offsetTop + leftContentTop;
                const sectionBottom = sectionTop + section.offsetHeight;
                const viewportCenter = scrollPos + viewportHeight / 2;

                if (viewportCenter >= sectionTop && viewportCenter < sectionBottom) {
                    const sectionNum = index + 1;

                    // Activate corresponding image
                    images.forEach(img => {
                        if (img.dataset.section == sectionNum) {
                            img.classList.add('active');
                        } else {
                            img.classList.remove('active');
                        }
                    });

                    // Activate corresponding shape
                    shapes.forEach(shape => {
                        if (shape.dataset.section == sectionNum) {
                            shape.classList.add('active');
                        } else {
                            shape.classList.remove('active');
                        }
                    });
                }
            });
        }

        // Throttle scroll event for better performance
        let ticking = false;
        window.addEventListener('scroll', () => {
            if (!ticking) {
                window.requestAnimationFrame(() => {
                    updateActiveSection();
                    ticking = false;
                });
                ticking = true;
            }
        });

        // Update on resize
        window.addEventListener('resize', updateActiveSection);

        // Initial call
        updateActiveSection();
    </script>

@endsection