@extends('layout.admin.app')

@section('content')
    <div class="content-wrapper">
        <div class="commmon-crads">

            <div class="row">
                <div class="col-xxl">
                    <div class="card mb-4">


                        <div class="simple-dashboard-heading">
                            <i class="fa fa-university"></i>
                            <span>Edit University</span>
                        </div>

                        {{-- Body --}}
                        <div class="card-body">
                            <div id="formMessage" class="alert d-none"></div>

                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                            <form action="{{ route('admin.university.update', $university->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="otp_verified" id="otp_verified" value="0">


                                {{-- Mobile --}}
                                <div class="row mb-3">
                                    <label class="col-sm-12 col-form-label">Mobile <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-12 d-flex gap-2">
                                        <input type="text" name="mobile" id="mobile" class="form-control"
                                            value="{{ $university->user->phoneNumber }}" placeholder="Enter mobile number"
                                            maxlength="10" oninput="this.value=this.value.replace(/[^0-9]/g,'')">
                                            <input type="hidden" id="original_mobile"
                                                value="{{ $university->user->phoneNumber }}">

                                            <button type="button" class="btn btn-otp" id="sendOtpBtn">
                                            <span id="otpBtnText">Send OTP</span>
                                        </button>
                                
                                    </div>        @error('mobile')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        @if (!$errors->has('mobile') && $errors->has('otp_verified'))
                                            <div class="text-danger">
                                                {{ $errors->first('otp_verified') }}
                                            </div>
                                        @endif

                                </div>

                                <div class="row mb-3">
                                     <div class="col-md-12">
                                     <label class="col-sm-12 col-form-label">
                                        Enter OTP <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-12">
                                        <input type="text" name="otp" id="otp" class="form-control" value="{{ old('otp') }}"
                                            maxlength="6" placeholder="Enter 6-digit OTP"
                                            oninput="this.value=this.value.replace(/[^0-9]/g,'')">
                                        @error('otp')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                  </div>
                                </div>

                                {{-- University Name --}}
                                <div class="row mb-3">
                                    <label class="col-sm-12 col-form-label">
                                        University Name <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-12">
                                        <input type="text" name="name" class="form-control"
                                            value="{{ $university->user->name }}" placeholder="Enter university name">
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- About University --}}
                                <div class="row mb-3">
                                    <label class="col-sm-12 col-form-label">About University <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-12">
                                        <textarea name="about" class="form-control" placeholder="Write about university"
                                            rows="4">{{ $university->about ?? '' }}</textarea>
                                        @error('about')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>


                                {{-- Email --}}
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="col-sm-12 col-form-label">
                                            Email <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-sm-12">
                                            <input type="email" name="email" class="form-control"
                                                value="{{ $university->user->email }}" placeholder="Enter email address">
                                            @error('email')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="col-sm-12 col-form-label">Address <span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-12">
                                            <input type="text" name="address" class="form-control"
                                                value="{{ $university->address }}" placeholder="Enter address">
                                            @error('address')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                {{-- Address --}}
                                <div class="row mb-3">

                                </div>

                                {{-- City --}}
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="col-sm-12 col-form-label">City <span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-12">
                                            <input type="text" name="city" class="form-control"
                                                value="{{ $university->city }}" placeholder="Enter city">
                                            @error('city')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="col-sm-12 col-form-label">
                                            State <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-sm-12 select-wrapper">
                                            <select name="state_id" class="form-select">
                                                <option value="">Select state</option>

                                                @foreach ($states as $state)
                                                    <option value="{{ $state->id }}" {{ $currentStateId == $state->id ? 'selected' : '' }}>
                                                        {{ $state->name }}
                                                    </option>

                                                @endforeach

                                            </select>
                                            <i class="fa fa-chevron-down select-icon"></i>
                                            
                                        </div>
                                        @error('state_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                    </div>
                                </div>



                                {{-- Emblem Logo --}}
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="col-sm-12 col-form-label">Emblem Logo</label>

                                        <div class="col-sm-12">

                                        <div>
                                            


                                            <input type="file" name="emblem_logo" class="form-control" accept="image/*"
                                                onchange="previewImage(this,'emblemPreview')">
                                            <small class="text-allows">
                                                Only WEBP format is allowed. Maximum image size: 200 X 200 pixels.
                                            </small>
                                        </div>


                                             <img id="emblemPreview" src="{{ $university->user->image
        ? asset('university_assets/images/' . $university->user->image)
        : 'https://via.placeholder.com/120' }}" class=" mb-2 rounded previews {{ $university->user->image ? '' : 'd-none' }}" width="120" height="120">
                                            @error('emblem_logo')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <label class="col-sm-12 col-form-label">Sports Logo</label>
                                        <div class="col-sm-12">



                                        <div>
                                             <input type="file" name="sports_logo" class="form-control" accept="image/*"
                                                onchange="previewImage(this,'sportsPreview')">
                                            <small class="text-allows">
                                                Only WEBP format is allowed. Maximum image size: 200 X 200 pixels.
                                            </small>
                                        </div>
                                            <img id="sportsPreview" src="{{ $university->sports_logo
        ? asset('university_assets/sports_logo/' . $university->sports_logo)
        : 'https://via.placeholder.com/120' }}" class=" mb-2 rounded previews {{ $university->sports_logo ? '' : 'd-none' }}" width="120" height="120">
                                            @error('sports_logo')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                {{-- Sports Logo --}}


                                {{-- Submit --}}
                                <div class="row justify-content-end">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-add-univerity">
                                            Update University
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
function previewImage(input, previewId) {

    const file = input.files[0];
    const preview = document.getElementById(previewId);

    // Agar file hi nahi hai
    if (!file) {
        preview.src = "";
        preview.classList.add("d-none");
        return;
    }



    const reader = new FileReader();

    reader.onload = function (e) {

        const img = new Image();

        img.onload = function () {

            // Max size check
            if (img.width > 200 || img.height > 200) {

                alert("Image size must be maximum 200 × 200 pixels.");

                input.value = "";

                // preview.src = "";
                // preview.classList.add("d-none");

                return;
            }

            // ✅ Show only this preview
            preview.src = e.target.result;
            preview.classList.remove("d-none");
        };

        img.src = e.target.result;
    };

    reader.readAsDataURL(file);
}
</script>

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

                fetch("{{ route('admin.university.sendOtp') }}", {
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

                fetch("{{ route('admin.university.verifyOtp') }}", {
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