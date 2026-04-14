@extends('layout.admin.app')

@section('content')
    <div class="content-wrapper">
         <div class="commmon-crads">
            <div id="formMessage" class="alert d-none"></div>


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
     <i class="fa fa-university"></i>
    <span>Add University</span>
</div>
                        {{-- Body --}}
                        <div class="card-body">
                            

                            <form action="{{ route('admin.university.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf


                                {{-- Mobile --}}
                                <div class="row mb-3">
                                  <div class="col-md-12">
                                      <label class="col-sm-12 col-form-label">
                                        Mobile <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-12 d-flex gap-2">
                                        <input type="text" id="mobile" name="mobile" class="form-control"
                                            value="{{ old('mobile') }}" maxlength="10" placeholder="Enter mobile number"
                                            oninput="this.value=this.value.replace(/[^0-9]/g,'')">

                                        <button type="button" class="btn btn-otp" id="sendOtpBtn">
                                            <span id="otpBtnText">Send OTP</span>
                                        </button>

                                    </div>
                                    <div class="col-sm-12">
                                        @error('mobile')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                  </div>

                                 
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
                                  <div class="col-md-12">
                                      <label class="col-sm-12 col-form-label">
                                        University Name <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-12">
                                        <input type="text" name="name" id="name" class="form-control"
                                            value="{{ old('name') }}" placeholder="Enter university name">
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                  </div>
                                
                                </div>


                                <div class="row mb-3">
                                      <div class="col-md-12">
                                        <label class="col-sm-12 col-form-label">
                                        About University <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-12">
                                        <textarea name="about" id="about" class="form-control" rows="4"
                                            placeholder="Write about university">{{ old('about') }}</textarea>
                                        @error('about')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                  </div>
                                </div>

                                {{-- Email --}}
                                <div class="row mb-3">
                                  <div class="col-md-6">
                                      <label class="col-sm-12 col-form-label">
                                        Email <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-12">
                                        <input type="text" id="email" name="email" class="form-control"
                                            value="{{ old('email')}}" placeholder="Enter email address">
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                      <label class="col-sm-12 col-form-label">Address <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-12">
                                        <input type="text" id="address" name="address" class="form-control"
                                            value="{{ old('address') }}" placeholder="Enter address">
                                        @error('address')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                  </div>
                                </div>
                                {{-- City --}}
                                <div class="row mb-3">
                                   <div class="col-md-6">
                                     <label class="col-sm-12 col-form-label">City <span class="text-danger">*</span></label>
                                    <div class="col-sm-12">
                                        <input type="text" id="city" name="city" class="form-control"
                                            value="{{ old('city') }}" placeholder="Enter city">
                                        @error('city')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                   </div>
                                   <div class="col-md-6">
                                     <label class="col-sm-12 col-form-label">State <span class="text-danger">*</span></label>
                                    <div class="col-sm-12 select-wrapper">
                                        <select name="state_id" id="state_id" class="form-select">
                                            <option value="">Select state</option>
                                            @foreach ($states as $state)
                                                <option value="{{ $state->id }}" {{ old('state_id') == $state->id ? 'selected' : '' }}>{{ $state->name }}</option>
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
                                         <input type="file" name="emblem_logo" class="form-control" accept="image/webp,image/jpeg,image/png,image/jpg"
                                            onchange="previewImage(this,'emblemPreview')">
                                        <small class="text-allows">
                                            Only WEBP format is allowed. Maximum image size: 200 X 200 pixels.
                                        </small>
                                       </div>
                                      <img id="emblemPreview" 
                                            class="d-none mb-2 rounded previews" width="120" height="120">
                                        @error('emblem_logo')
                                            <div class="text-danger ">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="col-sm-12 col-form-label">Sports Logo</label>
                                    <div class="col-sm-12">
                                       <div>
                                         <input type="file" name="sports_logo" class="form-control" accept="image/webp,image/jpeg,image/png,image/jpg"
                                            onchange="previewImage(this,'sportsPreview')">
                                        <small class="text-allows">
                                            Only WEBP format is allowed. Maximum image size: 200 X 200 pixels.
                                        </small> 
                                       </div>
                                       <img id="sportsPreview" 
                                            class="d-none mb-2 rounded previews" width="120" height="120">
                                        @error('sports_logo')
                                            <div class="text-danger ">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>
                                </div>

                                {{-- Submit --}}
                                <div class="row justify-content-end">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-add-univerity" id="submitBtn">
                                            <span id="btnText">Add University</span>
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

                return;
            }

            // Show only this preview
            preview.src = e.target.result;
            preview.classList.remove("d-none");
        };

        img.src = e.target.result;
    };

    reader.readAsDataURL(file);
}
</script>

    <script>
        function clearError() {

            // Top alert clear
            const box = document.getElementById('formMessage');
            if (box) {
                box.classList.add('d-none');
                box.classList.remove('alert-success', 'alert-danger');
                box.innerText = '';
            }
        }
    </script>


    <script>
        document.addEventListener("DOMContentLoaded", function () {
            clearError();
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
                box.classList.add(type === 'success' ? 'alert-success' : 'alert-danger');
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

                fetch("{{ route('admin.university.sendOtp') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({ mobile })
                })
                    .then(async res => {
                        const data = await res.json();
                        return data;
                    })

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
                    .then(async res => {
                        const data = await res.json();
                        return data;
                    })

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

<script>
   document.querySelector("form").addEventListener("submit", function (e) {
    e.preventDefault();

    let form = this;
    let formData = new FormData(form);

    let btn = document.getElementById("submitBtn");
    let btnText = document.getElementById("btnText");

    // 🔥 START PROCESSING
    btn.disabled = true;
    btnText.innerText = "Processing...";

    fetch(form.action, {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.status) {
            window.location.href = data.redirect + '?success=' + encodeURIComponent(data.message);
        }
    })
    .catch(err => {
        console.log(err);

        // ❌ ERROR → RESET BUTTON
        btn.disabled = false;
        btnText.innerText = "Add University";
    });
});
</script>

@endsection