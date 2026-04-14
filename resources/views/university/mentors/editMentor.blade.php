@extends('layout.university.app')

@section('content')
    <div class="content-wrapper">
        <div class="commmon-crads">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="row">
                <div class="col-xxl">
                    <div class="card mb-4">


                        <div class="simple-dashboard-heading">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <span>Edit Mentor</span>
                        </div>

                        {{-- Body --}}
                        <div class="card-body">
                            <div id="formMessage" class="alert d-none"></div>



                            <form action="{{ route('university.mentor.update', $mentor->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="otp_verified" id="otp_verified" value="0">

                                {{-- University Name --}}
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label class="col-sm-12 col-form-label">
                                            Mentor Name <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-sm-12">
                                            <input type="text" name="name" class="form-control"
                                                value="{{ $mentor->user->name }}" placeholder="Enter your mentor name">
                                            @error('name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                {{-- Email --}}
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label class="col-sm-12 col-form-label">
                                            Email <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-sm-12">
                                            <input type="text" name="email" class="form-control"
                                                value="{{ $mentor->user->email }}" placeholder="Enter your email">
                                            @error('email')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                {{-- Mobile --}}
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label class="col-sm-12 col-form-label">Mobile <span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-12 d-flex gap-2 position-relative">
                                            <input type="text" name="mobile" id="mobile" class="form-control"
                                                value="{{ $mentor->user->phoneNumber }}"
                                                placeholder="Enter your mobile number" maxlength="10"
                                                oninput="this.value=this.value.replace(/[^0-9]/g,'')">
                                                <input type="hidden" id="original_mobile"
                                                value="{{ $mentor->user->phoneNumber }}">

                                            <button type="button" class="btn btn-sent" id="sendOtpBtn">
                                                <span id="otpBtnText">Send OTP</span>
                                            </button>
                                            
                                        </div>
                                        @error('mobile')
    <div class="text-danger">{{ $message }}</div>
@enderror

@if (!$errors->has('mobile') && $errors->has('otp_verified'))
    <div class="text-danger">
        {{ $errors->first('otp_verified') }}
    </div>
@endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                               <div class="col-md-12">
                                 <label class="col-sm-12 col-form-label">
                                    OTP </span>
                                </label>
                                <div class="col-sm-12">
                                    <input type="text" name="otp" class="form-control"
                                        value="{{ old('otp') }}" maxlength="6"
                                        placeholder="Enter 6-digit OTP"
                                        oninput="this.value=this.value.replace(/[^0-9]/g,'')">
                                    @error('otp')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                               </div>
                            </div>

                                {{-- Sport Dropdown --}}
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label class="col-sm-12 col-form-label">
                                            Sports Category <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-sm-12 select-wrapper">
                                            <select name="sport_id" class="form-control">
                                                <option value="">-- Select Sport Category --</option>
                                                @foreach ($sports as $sport)
                                                    <option value="{{ $sport->id }}" {{ old('sport_id', $mentor->sport_id) == $sport->id ? 'selected' : '' }}>
                                                        {{ ucfirst($sport->sport->name) }}
                                                    </option>

                                                @endforeach
                                            </select>
                                            <i class="fa fa-chevron-down select-icon"></i>

                                            
                                        </div>
                                        @error('sport_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                    </div>
                                </div>

                                {{-- Submit --}}
                                <div class="row justify-content-end">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-add-univerity">
                                            Update Mentor
                                        </button>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {

            const phone = document.getElementById("mobile");
            const otpInput = document.querySelector('input[name="otp"]');
            const sendOtpBtn = document.getElementById("sendOtpBtn");
            const otpBtnText = document.getElementById("otpBtnText");
            const otpVerifiedInput = document.getElementById("otp_verified");
            const originalMobile = document.getElementById("original_mobile").value;

            let isProcessing = false;
            let resendTimer = null;
            let secondsLeft = 60;

            /* ================= DEFAULT CHECK (ON LOAD) ================= */

            if (phone.value === originalMobile) {
                otpVerifiedInput.value = "1";
                otpInput.readOnly = true;
                otpBtnText.innerText = "Verified ✓";
                sendOtpBtn.disabled = false;
            }

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

                box.classList.add(type === 'success' ? 'alert-success' : 'alert-danger');

                box.innerText = message;
            }

            /* ================= MOBILE CHANGE ================= */

            phone.addEventListener("input", function () {

                let current = phone.value.trim();

                if (current === originalMobile) {

                    // Same number → auto verified
                    otpVerifiedInput.value = "1";

                    otpInput.value = "";
                    otpInput.readOnly = true;

                    sendOtpBtn.disabled = false;
                    otpBtnText.innerText = "Verified ✓";

                } else {

                    // New number → OTP needed
                    otpVerifiedInput.value = "0";

                    otpInput.value = "";
                    otpInput.readOnly = false;

                    sendOtpBtn.disabled = false;
                    otpBtnText.innerText = "Send OTP";
                }
            });


            /* ================= SEND OTP ================= */

            sendOtpBtn.addEventListener("click", function () {

                let mobile = phone.value.trim();

                // Already verified number
                if (mobile === originalMobile) {
                    showMessage("You are already verified with this number. Use a different one.", "success");
                    return;
                }

                if (isProcessing) return;

                if (mobile.length !== 10) {
                    showMessage("Enter valid 10-digit mobile number");
                    phone.focus();
                    return;
                }

                isProcessing = true;

                sendOtpBtn.disabled = true;
                otpBtnText.innerText = "Sending...";

                fetch("{{ route('subUniversity.sendOtp') }}", {
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

                            // 👇 ADD THIS BACK
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
                    })

                    .finally(() => {
                        isProcessing = false;
                    });
            });


            /* ================= VERIFY OTP ================= */

            otpInput.addEventListener("keyup", function () {

                if (otpInput.value.length !== 6 || isProcessing) return;

                let mobile = phone.value.trim();

                isProcessing = true;

                fetch("{{ route('subUniversity.verifyOtp') }}", {
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

                            otpVerifiedInput.value = "1";

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
@endsection