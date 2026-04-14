<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni Association Of India INC</title>
    <link rel="short-cut icon" href="{{ asset('frontend_assets/assets/images/favicon.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300;400;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend_assets/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/assets/css/style2.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/assets/css/responsive.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!----only-sticky-mobile-->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.8/slick.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.8/slick-theme.min.css'>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.8/slick.min.js'></script>
</head>

<body>
    @include('layout.frontend.header')

    @yield('content')

    @include('layout.frontend.footer')
    <!----faqs-->

    <script>
        function toggleFaq(button) {
            const answer = button.nextElementSibling;
            const icon = button.querySelector('.faq-icon i');
            const allQuestions = document.querySelectorAll('.faq-question');
            const allAnswers = document.querySelectorAll('.faq-answer');

            // Close all other FAQs
            allQuestions.forEach(q => {
                if (q !== button) {
                    q.classList.remove('active');
                    q.querySelector('.faq-icon i').className = 'fas fa-arrow-right';
                }
            });

            allAnswers.forEach(a => {
                if (a !== answer) {
                    a.classList.remove('show');
                }
            });

            // Toggle current FAQ
            button.classList.toggle('active');
            answer.classList.toggle('show');

            if (button.classList.contains('active')) {
                icon.className = 'fas fa-arrow-right';
            } else {
                icon.className = 'fas fa-arrow-right';
            }
        }
    </script>




    <!----mobile-animations-->

    <script>
        const items = document.querySelectorAll(".list-item");
        const screens = document.querySelectorAll(".screen");
        const segments = document.querySelectorAll(".scroll-segment");
        const mobileSection = document.querySelector('.content-mobile-animated');
        const scrollbarContainer = document.querySelector('.scrollbar-container');

        function updateMobileScroll() {
            if (!mobileSection) return;

            // Get section boundaries
            const sectionTop = mobileSection.offsetTop;
            const sectionHeight = mobileSection.offsetHeight;
            const sectionBottom = sectionTop + sectionHeight;

            // Current scroll position (middle of viewport)
            const scrollPos = window.scrollY + (window.innerHeight / 2);

            // Check if we're within the section
            if (scrollPos < sectionTop || scrollPos > sectionBottom) {
                // Hide scrollbar when outside section
                if (scrollbarContainer) {
                    scrollbarContainer.style.opacity = '0';
                    scrollbarContainer.style.visibility = 'hidden';
                }
                return;
            } else {
                // Show scrollbar when inside section
                if (scrollbarContainer) {
                    scrollbarContainer.style.opacity = '1';
                    scrollbarContainer.style.visibility = 'visible';
                }
            }

            // Calculate progress within the section (0 to 1)
            const sectionProgress = (scrollPos - sectionTop) / sectionHeight;

            // Calculate current step (0 to 3 for 4 items)
            let step = Math.floor(sectionProgress * items.length);

            // Clamp the step value
            if (step < 0) step = 0;
            if (step >= items.length) step = items.length - 1;

            // Update left list items
            items.forEach((item, index) => {
                if (index === step) {
                    item.classList.add("active");
                } else {
                    item.classList.remove("active");
                }
            });

            // Update screens
            screens.forEach((screen, index) => {
                if (index === step) {
                    screen.classList.add("active");
                } else {
                    screen.classList.remove("active");
                }
            });

            // Update scroll segments
            segments.forEach((seg, index) => {
                if (index === step) {
                    seg.classList.add("active");
                } else {
                    seg.classList.remove("active");
                }
            });
        }

        // Throttle scroll event for better performance
        let tickingMobile = false;
        window.addEventListener("scroll", function () {
            if (!tickingMobile) {
                window.requestAnimationFrame(function () {
                    updateMobileScroll();
                    tickingMobile = false;
                });
                tickingMobile = true;
            }
        });

        // Initial call
        updateMobileScroll();
    </script>




    <!----game-cards-hover-->
    <script>
        document.querySelectorAll('.game-cards').forEach(card => {
            card.addEventListener('focus', () => card.scrollIntoView({ behavior: 'smooth', inline: 'center' }));
        });
    </script>

    <script>
        const cards = document.querySelectorAll(".game-cards");

        cards.forEach(card => {
            card.addEventListener("mouseenter", () => {
                cards.forEach(c => c.classList.remove("active-card"));
                card.classList.add("active-card");
            });
        });
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
        $(document).ready(function () {
            $('.carousel').slick({
                slidesToShow: 1,
                dots: true,
                autoplay: true,
                centerMode: false,
            });
        });
    </script>

    <!----header-menu-->

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            function toggleMobileMenu() {
                const nav = document.getElementById('mainNav');

                nav.classList.toggle('active');

                // ✅ BODY SCROLL LOCK
                if (nav.classList.contains('active')) {
                    document.body.classList.add('no-scroll');
                } else {
                    document.body.classList.remove('no-scroll');
                }
            }

            window.toggleMobileMenu = toggleMobileMenu;

            function toggleDropdown(e) {
                e.preventDefault();
                e.stopPropagation();

                const parentLi = e.currentTarget.parentElement;

                document.querySelectorAll('#mainNav > li').forEach(li => {
                    if (li !== parentLi) li.classList.remove('active');
                });

                parentLi.classList.toggle('active');
            }

            document.querySelectorAll('#mainNav > li > a').forEach(link => {
                const dropdown = link.nextElementSibling;

                if (dropdown && (dropdown.classList.contains('mega-menu') || dropdown.classList.contains('dropdown'))) {
                    link.addEventListener('click', toggleDropdown);
                }
            });

            // Outside click close
            document.addEventListener('click', function (e) {
                const nav = document.getElementById('mainNav');
                const toggle = document.querySelector('.mobile-toggle');

                if (window.innerWidth <= 768 &&
                    !nav.contains(e.target) &&
                    !toggle.contains(e.target)) {

                    nav.classList.remove('active');
                    document.body.classList.remove('no-scroll'); // ✅ unlock scroll

                    nav.querySelectorAll('li').forEach(li => li.classList.remove('active'));
                }
            });

        });
    </script>


    <!----popup-model-->
    <script>
        (function () {
            /* ── Elements ── */
            const overlay = document.getElementById('ea-overlay');
            const openBtn = document.getElementById('ea-open-modal');
            const closeBtn = document.getElementById('ea-close-modal');
            const sendOtpBtn = document.getElementById('ea-send-otp-btn');
            const verifyBtn = document.getElementById('ea-verify-btn');
            const resendBtn = document.getElementById('ea-resend-btn');
            const timerEl = document.getElementById('ea-timer');
            const timerWrap = document.getElementById('ea-resend-timer-wrap');
            const phoneDisplay = document.getElementById('ea-phone-display');
            const otpBoxes = Array.from(document.querySelectorAll('.ea-otp__box'));

            /* ── Step helpers ── */
            function setStep(n) {
                [1, 2, 3].forEach(i => {
                    const el = document.getElementById('ea-step-' + i);
                    el.classList.remove('ea-step--active', 'ea-step--done');
                    if (i < n) el.classList.add('ea-step--done'); if (i === n) el.classList.add('ea-step--active');
                });
            } function
                showPanel(id) {
                ['ea-panel-form', 'ea-panel-otp', 'ea-panel-success'].forEach(p => {
                    const el = document.getElementById(p);
                    el.classList.remove('ea-panel--active');
                });
                document.getElementById(id).classList.add('ea-panel--active');
            }

            /* ── Open / Close ── */
            openBtn.addEventListener('click', () => {
                overlay.classList.add('ea-overlay--open');
                document.body.style.overflow = 'hidden';
                setTimeout(() => document.getElementById('ea-name').focus(), 350);
            });
            function closeModal() {
                overlay.classList.remove('ea-overlay--open');
                document.body.style.overflow = '';
            }
            closeBtn.addEventListener('click', closeModal);
            overlay.addEventListener('click', e => { if (e.target === overlay) closeModal(); });
            document.addEventListener('keydown', e => { if (e.key === 'Escape') closeModal(); });

            /* ── Send OTP ── */
            sendOtpBtn.addEventListener('click', () => {
                const name = document.getElementById('ea-name').value.trim();
                const phone = document.getElementById('ea-phone').value.trim();
                const role = document.getElementById('ea-role').value;
                if (!name || !phone || !role) {
                    alert('Please fill in all fields.');
                    return;
                }
                if (!/^\d{10}$/.test(phone)) {
                    alert('Please enter a valid 10-digit mobile number.');
                    return;
                }

                // Mask phone for display: +91 XXXXXXX + last 3 digits
                const masked = '+91 XXXXXXX' + phone.slice(-3);
                phoneDisplay.textContent = masked;

                setStep(2);
                showPanel('ea-panel-otp');
                startTimer();
                otpBoxes[0].focus();
            });

            /* ── OTP Box UX ── */
            otpBoxes.forEach((box, idx) => {
                box.addEventListener('input', e => {
                    const val = e.target.value.replace(/\D/g, '');
                    e.target.value = val ? val[0] : '';
                    if (val) {
                        box.classList.add('ea-otp__box--filled');
                        if (idx < otpBoxes.length - 1) otpBoxes[idx + 1].focus();
                    } else {
                        box.classList.remove('ea-otp__box--filled');
                    }
                }); box.addEventListener('keydown', e => {
                    if (e.key === 'Backspace' && !box.value && idx > 0) {
                        otpBoxes[idx - 1].value = '';
                        otpBoxes[idx - 1].classList.remove('ea-otp__box--filled');
                        otpBoxes[idx - 1].focus();
                    }
                });
                box.addEventListener('paste', e => {
                    e.preventDefault();
                    const text = (e.clipboardData || window.clipboardData).getData('text').replace(/\D/g, '').slice(0, 6);
                    text.split('').forEach((ch, i) => {
                        if (otpBoxes[i]) {
                            otpBoxes[i].value = ch;
                            otpBoxes[i].classList.add('ea-otp__box--filled');
                        }
                    });
                    if (text.length < 6) otpBoxes[text.length].focus();
                });
            }); /* ── Timer ── */ let timerInterval; function
                startTimer() {
                let t = 30; timerEl.textContent = t; timerWrap.style.display = 'inline';
                resendBtn.style.display = 'none'; clearInterval(timerInterval); timerInterval = setInterval(() => {
                    t--;
                    timerEl.textContent = t;
                    if (t <= 0) {
                        clearInterval(timerInterval); timerWrap.style.display = 'none';
                        resendBtn.style.display = 'inline';
                    }
                }, 1000);
            } resendBtn.addEventListener('click', () => {
                otpBoxes.forEach(b => { b.value = ''; b.classList.remove('ea-otp__box--filled'); });
                otpBoxes[0].focus();
                startTimer();
            });

            /* ── Verify ── */
            verifyBtn.addEventListener('click', () => {
                const code = otpBoxes.map(b => b.value).join('');
                if (code.length < 6) { alert('Please enter the complete 6-digit OTP.'); return; } setStep(3);
                showPanel('ea-panel-success'); clearInterval(timerInterval);
            });
        })(); 
    </script>


    <!---mega-menu-->
    <script>
        document.addEventListener("DOMContentLoaded", function () {

            const megaCards = document.querySelectorAll(".mega-card");

            megaCards.forEach(card => {

                card.addEventListener("click", function (e) {

                    // Agar link pe click ho to normal redirect hone do
                    if (e.target.closest("a")) return;

                    // Accordion (ek hi open rahe)
                    megaCards.forEach(c => {
                        if (c !== card) c.classList.remove("active");
                    });

                    // Toggle current
                    card.classList.toggle("active");
                });

            });

        });
    </script>
    <script src="{{ asset('frontend_assets/assets/js/bootstrap.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js">
    </script>

    <script
        src="https://cdn.jsdelivr.net/npm/@splidejs/splide-extension-auto-scroll@0.5.3/dist/js/splide-extension-auto-scroll.min.js">
        </script>
</body>

</html>