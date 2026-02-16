<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="../assets/"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Alumni Connect - University Login</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('athlete_assets/assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />

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
    <!-- Content -->

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a href="index.html" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">
                                    <svg width="25" viewBox="0 0 25 42" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <defs>
                                            <path
                                                d="M13.7918663,0.358365126 L3.39788168,7.44174259 C0.566865006,9.69408886 -0.379795268,12.4788597 0.557900856,15.7960551 C0.68998853,16.2305145 1.09562888,17.7872135 3.12357076,19.2293357 C3.8146334,19.7207684 5.32369333,20.3834223 7.65075054,21.2172976 L7.59773219,21.2525164 L2.63468769,24.5493413 C0.445452254,26.3002124 0.0884951797,28.5083815 1.56381646,31.1738486 C2.83770406,32.8170431 5.20850219,33.2640127 7.09180128,32.5391577 C8.347334,32.0559211 11.4559176,30.0011079 16.4175519,26.3747182 C18.0338572,24.4997857 18.6973423,22.4544883 18.4080071,20.2388261 C17.963753,17.5346866 16.1776345,15.5799961 13.0496516,14.3747546 L10.9194936,13.4715819 L18.6192054,7.984237 L13.7918663,0.358365126 Z"
                                                id="path-1"></path>
                                            <path
                                                d="M5.47320593,6.00457225 C4.05321814,8.216144 4.36334763,10.0722806 6.40359441,11.5729822 C8.61520715,12.571656 10.0999176,13.2171421 10.8577257,13.5094407 L15.5088241,14.433041 L18.6192054,7.984237 C15.5364148,3.11535317 13.9273018,0.573395879 13.7918663,0.358365126 C13.5790555,0.511491653 10.8061687,2.3935607 5.47320593,6.00457225 Z"
                                                id="path-3"></path>
                                            <path
                                                d="M7.50063644,21.2294429 L12.3234468,23.3159332 C14.1688022,24.7579751 14.397098,26.4880487 13.008334,28.506154 C11.6195701,30.5242593 10.3099883,31.790241 9.07958868,32.3040991 C5.78142938,33.4346997 4.13234973,34 4.13234973,34 C4.13234973,34 2.75489982,33.0538207 2.37032616e-14,31.1614621 C-0.55822714,27.8186216 -0.55822714,26.0572515 -4.05231404e-15,25.8773518 C0.83734071,25.6075023 2.77988457,22.8248993 3.3049379,22.52991 C3.65497346,22.3332504 5.05353963,21.8997614 7.50063644,21.2294429 Z"
                                                id="path-4"></path>
                                            <path
                                                d="M20.6,7.13333333 L25.6,13.8 C26.2627417,14.6836556 26.0836556,15.9372583 25.2,16.6 C24.8538077,16.8596443 24.4327404,17 24,17 L14,17 C12.8954305,17 12,16.1045695 12,15 C12,14.5672596 12.1403557,14.1461923 12.4,13.8 L17.4,7.13333333 C18.0627417,6.24967773 19.3163444,6.07059163 20.2,6.73333333 C20.3516113,6.84704183 20.4862915,6.981722 20.6,7.13333333 Z"
                                                id="path-5"></path>
                                        </defs>
                                        <g id="g-app-brand" stroke="none" stroke-width="1" fill="none"
                                            fill-rule="evenodd">
                                            <g id="Brand-Logo" transform="translate(-27.000000, -15.000000)">
                                                <g id="Icon" transform="translate(27.000000, 15.000000)">
                                                    <g id="Mask" transform="translate(0.000000, 8.000000)">
                                                        <mask id="mask-2" fill="white">
                                                            <use xlink:href="#path-1"></use>
                                                        </mask>
                                                        <use fill="#696cff" xlink:href="#path-1"></use>
                                                        <g id="Path-3" mask="url(#mask-2)">
                                                            <use fill="#696cff" xlink:href="#path-3"></use>
                                                            <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-3">
                                                            </use>
                                                        </g>
                                                        <g id="Path-4" mask="url(#mask-2)">
                                                            <use fill="#696cff" xlink:href="#path-4"></use>
                                                            <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-4">
                                                            </use>
                                                        </g>
                                                    </g>
                                                    <g id="Triangle"
                                                        transform="translate(19.000000, 11.000000) rotate(-300.000000) translate(-19.000000, -11.000000) ">
                                                        <use fill="#696cff" xlink:href="#path-5"></use>
                                                        <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-5">
                                                        </use>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </span>
                                <span class="app-brand-text demo text-body fw-bolder">Alumni Connect</span>
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-2">Welcome to Alumni Connect!</h4>
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

                        <p class="mb-4">Please Log-in to your account and start the adventure</p>


                        <form action="{{ route('athlete.register.store') }}" method="POST" enctype="multipart/form-data"
                            class="mb-3">
                            @csrf

                            {{-- Sub-University Name --}}
                            <div class="mb-3">
                                <label class="form-label">
                                    Full Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                                    placeholder="Enter Your full name">
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
                                    placeholder="Enter Your email address">
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
                                        value="{{ old('mobile') }}" maxlength="10" placeholder="Enter Mobile Number"
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
                                <button type="submit" class="btn btn-primary d-grid w-100">
                                    Register
                                </button>
                            </div>
                        </form>


                    </div>
                </div>
                <!-- /Register -->
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
                    box.style.backgroundColor = '#28a745';
                } else {
                    box.classList.add('alert-danger');
                    box.style.backgroundColor = '#dc3545';
                }

                box.style.color = '#fff';
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