<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="../assets/"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>AlumniIndia - Athlete Register</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('athlete_assets/assets/img/favicon/favicon.png') }}" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('athlete_assets/assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('athlete_assets/assets/vendor/css/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('athlete_assets/assets/vendor/css/theme-default.css') }}" />
    <link rel="stylesheet" href="{{ asset('athlete_assets/assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet"
        href="{{ asset('athlete_assets/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="{{ asset('athlete_assets/assets/vendor/css/pages/page-auth.css') }}" />

    <!-- Helpers -->
    <script src="{{ asset('athlete_assets/assets/vendor/js/helpers.js') }}"></script>

    <!-- Config -->
    <script src="{{ asset('athlete_assets/assets/js/config.js') }}"></script>
</head>

<body>
    <div class="main-bosy-scetion">
        <div class="container-xxl">
            <div class="container-p-y">
                <div class="container-scetion-all">
                    <div class="row align-center">
                        <div class="col-md-6">
                            <div class="main-login-inners">
                                <div class="app-brand justify-content-center">
                                    <a href="index.html">
                                        <img src="{{ asset('admin_assets/images/logo-black.png') }}" alt="logo">
                                    </a>

                                </div>
                                @if (session('success'))
                                    <div class="alert alert-success mb-3">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger mb-3">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                <div id="formMessage" class="alert d-none mb-3"></div>
                                <h1>Welcome!!</h1>
                                <p>Please enter your mobile number to receive an OTP and continue with your athlete
                                    registration on AlumniIndia.</p>
                                <form action="{{ route('athlete.register.store') }}" method="POST"
                                    enctype="multipart/form-data" class="mb-3">
                                    @csrf

                                    {{-- Sub-University Name --}}
                                    <div class="mb-3">
                                        <label class="form-label">
                                            Full Name <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                                            placeholder="Enter your full name">
                                        @error('name')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Email --}}
                                    <div class="mb-3">
                                        <label class="form-label">
                                            Email <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="email" class="form-control" value="{{ old('email') }}"
                                            placeholder="Enter your email address">
                                        @error('email')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Mobile + OTP Button --}}
                                    <div class="mb-3">
                                        <label class="form-label">
                                            Mobile <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <input type="text" name="mobile" id="mobile" class="form-control"
                                                value="{{ old('mobile') }}" maxlength="10"
                                                placeholder="Enter mobile number"
                                                oninput="this.value=this.value.replace(/[^0-9]/g,'')">

                                            <button type="button" class="btn btn-primary" id="sendOtpBtn">
                                                <span id="otpBtnText">Send OTP</span>
                                            </button>
                                        </div>
                                        @error('mobile')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- OTP --}}
                                    <div class="mb-3">
                                        <label class="form-label">
                                            OTP <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="otp" class="form-control" value="{{ old('otp') }}"
                                            maxlength="6" placeholder="Enter 6-digit OTP"
                                            oninput="this.value=this.value.replace(/[^0-9]/g,'')">
                                        @error('otp')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Submit --}}
                                    <div class="mb-3">
                                        <button type="submit" class="btn  btn-updates">
                                            Register
                                        </button>
                                    </div>
                                </form>
                                
                                <div class="text-center mt-3 register-here">
                                    <span>Already have an account? </span>
                                    <a href="{{ route('athlete.login.view') }}" class="register-link">
                                        Login here.
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <img src="{{ asset('athlete_assets/images/register.png') }}" class="img-fluid login"
                                alt="Login">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Core JS -->
    <script src="{{ asset('athlete_assets/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('athlete_assets/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('athlete_assets/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('athlete_assets/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('athlete_assets/assets/vendor/js/menu.js') }}"></script>
    <!-- Main JS -->
    <script src="{{ asset('athlete_assets/assets/js/main.js') }}"></script>

    <!-- <script async defer src="https://buttons.github.io/buttons.js"></script> -->

    <script>
        document.addEventListener("DOMContentLoaded", function () {

            const phone = document.getElementById("mobile");
            const otpInput = document.querySelector('input[name="otp"]');
            const sendOtpBtn = document.getElementById("sendOtpBtn");
            const otpBtnText = document.getElementById("otpBtnText");

            let isProcessing = false;
            let resendTimer = null;
            let secondsLeft = 60;

            function startResendTimer() {
                sendOtpBtn.disabled = true;
                secondsLeft = 60;
                otpBtnText.innerText = `Resend OTP (${secondsLeft}s)`;

                resendTimer = setInterval(() => {
                    secondsLeft--;
                    otpBtnText.innerText = `Resend OTP (${secondsLeft}s)`;

                    if (secondsLeft <= 0) {
                        clearInterval(resendTimer);
                        resendTimer = null;
                        sendOtpBtn.disabled = false;
                        otpBtnText.innerText = "Resend OTP";
                    }
                }, 1000);
            }

            function showMessage(message, type = 'danger') {
                const box = document.getElementById('formMessage');

                box.classList.remove('d-none', 'alert-success', 'alert-danger');
                box.classList.add('alert');

                if (type === 'success') {
                    box.classList.add('alert-success');
                    // box.style.backgroundColor = '#28a745';
                } else {
                    box.classList.add('alert-danger');
                    // box.style.backgroundColor = '#dc3545';
                }

                // box.style.color = '#fff';
                box.innerText = message;
            }


            // ================= SEND / RESEND OTP =================
            sendOtpBtn.addEventListener("click", function () {

                if (isProcessing) return;

                let mobile = phone.value.trim();

                if (mobile.length !== 10) {
                    showMessage("Enter valid 10-digit mobile number");
                    phone.focus();
                    return;
                }

                isProcessing = true;
                sendOtpBtn.disabled = true;
                otpBtnText.innerText = "Sending...";

                fetch("{{ route('athlete.send.register.otp') }}", {
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
                            let msg = data.message;

                            // DEV ONLY: show OTP
                            if (data.otp) {
                                msg += " (OTP: " + data.otp + ")";
                            }

                            showMessage(msg, 'success');
                            otpInput.readOnly = false;
                            otpInput.focus();
                            startResendTimer();
                        } else {
                            showMessage(data.message || "OTP send failed");
                            sendOtpBtn.disabled = false;
                            otpBtnText.innerText = "Send OTP";
                        }
                    })
                    .catch(() => {
                        showMessage("Error sending OTP");
                        sendOtpBtn.disabled = false;
                        otpBtnText.innerText = "Send OTP";
                    })
                    .finally(() => {
                        isProcessing = false;
                    });
            });

            // ================= VERIFY OTP =================
            otpInput.addEventListener("keyup", function () {

                if (otpInput.value.length !== 6 || isProcessing) return;

                let mobile = phone.value.trim();
                isProcessing = true;

                fetch("{{ route('athlete.verify.register.otp') }}", {
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
                            showMessage(data.message, 'success');
                            phone.readOnly = true;
                            otpInput.readOnly = true;
                            sendOtpBtn.disabled = true;
                            otpBtnText.innerText = "Verified ✓";

                            if (resendTimer) clearInterval(resendTimer);
                        } else {
                            showMessage(data.message || "Invalid OTP");
                            otpInput.value = "";
                            otpInput.focus();
                        }
                    })
                    .catch(() => {
                        showMessage("Error verifying OTP");
                    })
                    .finally(() => {
                        isProcessing = false;
                    });
            });

        });
    </script>



</body>

</html>