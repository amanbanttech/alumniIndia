@extends('layout.university.app')

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
    <span>Add Sub-University Admin</span>
</div> 

                    {{-- Body --}}
                    <div class="card-body">


                        

                        <form action="{{ route('subUniversity.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            {{-- University Name --}}
                            <div class="row mb-3">
                              <div class="col-md-12">
                                  <label class="col-sm-12 col-form-label">
                                    Sub-University Admin Name <span class="text-danger">*</span>
                                </label>
                                <div class="col-sm-12">
                                    <input type="text" name="name" class="form-control"
                                        value="{{ old('name') }}" placeholder="Enter sub-university admin name">
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
                                        value="{{ old('email') }}" placeholder="Enter email address">
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                               </div>
                            </div>

                            {{-- Mobile --}}
                            <div class="row mb-3">
                              <div class="col-md-12">
                                  <label class="col-sm-12 col-form-label">
                                    Mobile <span class="text-danger">*</span>
                                </label>
                                <div class="col-sm-12 d-flex gap-2 position-relative">
                                    <input type="text" name="mobile" id="mobile" class="form-control"
                                        value="{{ old('mobile') }}" maxlength="10"
                                        placeholder="Enter mobile number"
                                        oninput="this.value=this.value.replace(/[^0-9]/g,'')">

                                    <button type="button" class="btn btn-sent" id="sendOtpBtn">
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

                            {{-- OTP --}}
                            <div class="row mb-3">
                               <div class="col-md-12">
                                 <label class="col-sm-12 col-form-label">
                                    OTP <span class="text-danger">*</span>
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

                            <!-- Submit -->
                                <div class="row justify-content-end">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-add-univerity">
                                            Add Sub-University Admin
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
