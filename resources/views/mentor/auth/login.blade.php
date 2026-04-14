<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="../assets/"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>AlumniIndia - Mentor Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('frontend_assets/assets/img/favicon/favicon.png') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('mentor_assets/assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('mentor_assets/assets/vendor/css/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('mentor_assets/assets/vendor/css/theme-default.css') }}" />
    <link rel="stylesheet" href="{{ asset('mentor_assets/assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet"
        href="{{ asset('mentor_assets/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="{{ asset('mentor_assets/assets/vendor/css/pages/page-auth.css') }}" />

    <!-- Helpers -->
    <script src="{{ asset('mentor_assets/assets/vendor/js/helpers.js') }}"></script>

    <!-- Config -->
    <script src="{{ asset('mentor_assets/assets/js/config.js') }}"></script>
</head>

<body>
    <div class="auth-wrapper">
        <div class="auth-left">
            <div class="app-brand app-brands-new justify-content-center ">
                {{-- <a href="index.html" class="app-brand-link gap-2">
                    <img src="{{ asset('mentor_assets/images/logo-white.png') }}" alt="logo">
                </a> --}}
                <h3>Welcome Back</h3>
                <h1>Alumni Association <br> of India</h1>
                <div class="divider-left"></div>
                <p>Connect, mentor, and grow with a network of outstanding alumni across the nation.</p>
            </div>
            {{-- <img src="{{ asset('mentor_assets/images/mentor-logins.png') }}" alt="Mentor Illustration"> --}}
        </div>
        <div class="auth-right">
            <a href="index.html" class="only-mobiles">
                <img src="{{ asset('mentor_assets/images/logo-black.png') }}" alt="logo">
            </a>
            <div class="login-left-new">
                <h4>Mentor Log In</h4>
                <p>Sign In to Your Mentor Dashboard</p>
                <div class="underline-bar"></div>
                <form id="otpLoginForm" class="mb-3">
                    @csrf
                    @if (session('status'))
                        <div class="alert alert-success">{{ session('status') }}</div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div id="otpMessage" class="alert d-none"></div>


                    {{-- Mobile --}}
                    <div class="mb-3">

                        {{-- <div class="input-group">
                            <input type="text" id="mobile" class="form-control"
                                placeholder="Enter 10-digit mobile number" maxlength="10"
                                oninput="this.value=this.value.replace(/[^0-9]/g,'')">

                            <button type="button" class="btn btn-outline-primary" id="sendOtpBtn">
                                <span id="otpBtnText">Send OTP</span>
                            </button>


                        </div> --}}
                        <label class="form-label">Mobile <span class="text-danger">*</span></label>
                        <div class="mobile-input-wrapper">
                            <div class="input-group custom-mobile-group">

                                <span class="input-icon">
                                    <i class="fas fa-phone-alt"></i>
                                </span>

                                <input type="text" id="mobile" class="form-control"
                                    placeholder="Enter 10-digit mobile number" maxlength="10"
                                    oninput="this.value=this.value.replace(/[^0-9]/g,'')">

                                <button type="button" class="btn send-otp-btn" id="sendOtpBtn">
                                    <span id="otpBtnText">Send OTP</span>
                                </button>

                            </div>
                        </div>

                    </div>

                    {{-- OTP --}}
                    <div class="mb-3">
                        <label class="form-label">Enter OTP <span class="text-danger">*</span></label>




                        <div class="mobile-input-wrapper">
                            <div class="input-group custom-mobile-group">

                                <span class="input-icon">
                                    <i class="fas fa-lock"></i>
                                </span>

                                <input type="text" id="otp" class="form-control" placeholder="Enter 6-digit OTP"
                                    maxlength="6" oninput="this.value=this.value.replace(/[^0-9]/g,'')">

                            </div>
                        </div>

                    </div>

                    {{-- Message --}}

                    {{-- Submit --}}
                    <div class="mb-3">
                        <button type="submit" id="loginBtn" class="btn btn-submit">
                            Log In
                        </button>
                    </div>
                </form>
                <div class="text-center">
                    <a href="{{ route('frontend.index') }}" class="back-login btn-login-2">
                        <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                        Go to Home Page
                    </a>
                </div>
            </div>
        </div>
    </div>




    <!-- Core JS -->
    <script src="{{ asset('mentor_assets/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('mentor_assets/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('mentor_assets/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('mentor_assets/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('mentor_assets/assets/vendor/js/menu.js') }}"></script>
    <!-- Main JS -->
    <script src="{{ asset('mentor_assets/assets/js/main.js') }}"></script>

    <!-- <script async defer src="https://buttons.github.io/buttons.js"></script> -->

    <script>
        document.addEventListener("DOMContentLoaded", function () {

            let phone = document.getElementById("mobile");
            let otpInput = document.getElementById("otp");
            let sendOtpBtn = document.getElementById("sendOtpBtn");
            let otpResult = document.getElementById("otpMessage");
            let loginBtn = document.getElementById("loginBtn");
            let otpBtnText = document.getElementById("otpBtnText");
            let loginForm = document.getElementById("otpLoginForm");

            let resendTimer = null;
            let otpVerified = false;
            let verifiedPhone = null;
            let isProcessing = false;
            let otpExpiryTimer = null;

            // ================= COMMON HELPERS =================
            function clearMessage() {
                otpResult.textContent = '';
                otpResult.className = 'alert d-none';
            }

            function showErrorMessage(message) {
                otpResult.className = 'alert alert-danger';
                otpResult.textContent = message;
                otpResult.classList.remove('d-none');
            }

            function showSuccessMessage(message) {
                otpResult.className = 'alert alert-success';
                otpResult.textContent = message;
                otpResult.classList.remove('d-none');
            }

            // ================= RESEND TIMER =================
            function startResendTimer() {
                if (resendTimer) clearInterval(resendTimer);

                let seconds = 60;
                sendOtpBtn.disabled = true;
                otpBtnText.innerText = `Resend OTP (${seconds}s)`;

                resendTimer = setInterval(() => {
                    seconds--;
                    otpBtnText.innerText = `Resend OTP (${seconds}s)`;

                    if (seconds <= 0) {
                        clearInterval(resendTimer);
                        resendTimer = null;

                        if (!otpVerified) {
                            sendOtpBtn.disabled = false;
                            otpBtnText.innerText = "Resend OTP";
                        }
                    }
                }, 1000);
            }

            // ================= OTP EXPIRY (5 MIN) =================
            function startOtpExpiryTimer() {
                if (otpExpiryTimer) clearTimeout(otpExpiryTimer);

                otpExpiryTimer = setTimeout(() => {
                    if (!otpVerified) {
                        showErrorMessage("OTP expired. Please request a new OTP.");
                        otpInput.value = "";

                        if (!resendTimer) {
                            sendOtpBtn.disabled = false;
                            otpBtnText.innerText = "Resend OTP";
                        }
                    }
                }, 300000); // 5 minutes
            }

            // ================= SEND OTP =================
            sendOtpBtn.onclick = function () {
                if (isProcessing) return;

                let mobile = phone.value.trim();

                clearMessage();

                if (!mobile) {
                    showErrorMessage("Please enter a valid mobile number.");
                    phone.focus();
                    return;
                }

                if (mobile.length !== 10) {
                    showErrorMessage("Enter valid 10-digit mobile number");
                    phone.focus();
                    return;
                }

                if (otpVerified && mobile !== verifiedPhone) {
                    otpVerified = false;
                    verifiedPhone = null;
                    otpInput.value = "";
                    otpInput.readOnly = false;
                }

                isProcessing = true;
                sendOtpBtn.disabled = true;
                otpBtnText.innerText = "Sending...";

                fetch("{{ route('mentor.send.login.otp') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({ mobile })
                })
                    .then(res => res.json())
                    .then(data => {

                        if (data.status) {
                            showSuccessMessage(data.message + (data.otp ? " (OTP: " + data.otp + ")" : ""));
                            otpInput.readOnly = false;
                            otpInput.focus();

                            startResendTimer();
                            startOtpExpiryTimer();
                        } else {
                            showErrorMessage(data.message || "Failed to send OTP");
                            sendOtpBtn.disabled = false;
                            otpBtnText.innerText = "Send OTP";
                        }
                    })
                    .catch(() => {
                        showErrorMessage("Error sending OTP. Please try again.");
                        sendOtpBtn.disabled = false;
                        otpBtnText.innerText = "Send OTP";
                    })
                    .finally(() => {
                        isProcessing = false;
                    });
            };

            // ================= VERIFY OTP =================
            otpInput.addEventListener("keyup", function () {
                if (otpInput.value.length !== 6 || isProcessing) return;

                let mobile = phone.value.trim();
                isProcessing = true;

                fetch("{{ route('mentor.verify.login.otp') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        mobile: mobile,
                        otp: otpInput.value
                    })
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.status) {
                            showSuccessMessage(data.message || "OTP verification completed successfully");

                            otpVerified = true;
                            verifiedPhone = mobile;

                            otpInput.readOnly = true;
                            phone.readOnly = true;

                            clearInterval(resendTimer);
                            resendTimer = null;

                            sendOtpBtn.disabled = true;
                            otpBtnText.innerText = "Verified ✓";

                            if (otpExpiryTimer) clearTimeout(otpExpiryTimer);
                        } else {
                            showErrorMessage(data.message || "Invalid OTP");
                            otpInput.focus();
                        }
                    })
                    .catch(() => {
                        showErrorMessage("Error verifying OTP");
                    })
                    .finally(() => {
                        isProcessing = false;
                    });
            });

            // ================= LOGIN =================
            // ================= LOGIN =================
            loginForm.addEventListener("submit", function (e) {
                e.preventDefault();
                clearMessage();

                let mobile = phone.value.trim();

                // CONDITION 1: Mobile empty
                if (!mobile) {
                    showErrorMessage("Please enter a valid mobile number.");
                    phone.focus();
                    return;
                }

                // CONDITION 2: Invalid mobile
                if (mobile.length !== 10) {
                    showErrorMessage("Enter valid 10-digit mobile number.");
                    phone.focus();
                    return;
                }

                // CONDITION 3: OTP not entered
                if (!otpInput.value) {
                    showErrorMessage("Please verify your mobile number using the OTP to proceed.");
                    otpInput.focus();
                    return;
                }

                // CONDITION 4: OTP not verified
                if (!otpVerified) {
                    showErrorMessage("OTP not verified. Please verify your mobile number first.");
                    return;
                }



                // Continue login...
                loginBtn.disabled = true;
                let originalText = loginBtn.textContent;
                loginBtn.textContent = "Processing...";

                fetch("{{ route('mentor.login') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({ mobile: phone.value })
                })
                    .then(res => res.json())
                    .then(data => {
                        loginBtn.textContent = originalText;

                        if (data.status) {
                            window.location.href = data.redirect;
                        } else {
                            loginBtn.disabled = false;
                            showErrorMessage(data.message || "Login failed");
                        }
                    })
                    .catch(() => {
                        loginBtn.textContent = originalText;
                        loginBtn.disabled = false;
                        showErrorMessage("Login failed. Please try again.");
                    });
            });

        });
    </script>



</body>

</html>