@extends('layout.athlete.app')

@section('content')

    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">

            <div class="row">
                <div class="col-xxl">

                    <div class="card mb-4">

                        {{-- Header --}}
                        <div class="card-header">
                            <h5 class="mb-0">Edit Athlete Profile</h5>
                        </div>

                        {{-- Body --}}
                        <div class="card-body">

                            <div id="formMessage" class="alert d-none"></div>

                            <form id="athleteUpdateForm" action="{{ route('athlete.profile.update.ajax') }}" method="POST"
                                enctype="multipart/form-data">

                                @csrf


                                {{-- ================================================= --}}
                                {{-- ================= STEP 1 ======================== --}}
                                {{-- ================================================= --}}

                                <div class="step-tab" id="step1">

                                    <h5 class="mb-3"> Personal Info (Step-1)</h5>
                                    <div>
                                        <h6 class="mb-3">Basic Details</h6>
                                    </div>

                                    {{-- Name --}}
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Full Name *</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="name" class="form-control"
                                                placeholder="Enter your Name" value="{{ $athlete->name ?? $user->name }}">
                                        </div>
                                    </div>


                                    {{-- DOB --}}
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Date of Birth *</label>
                                        <div class="col-sm-10">
                                            <input type="date" name="dob" class="form-control"
                                                placeholder="Enter your Date of Birth"
                                                value="{{ $athlete->date_of_birth }}">
                                        </div>
                                    </div>


                                    {{-- Gender --}}
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Gender *</label>
                                        <div class="col-sm-10">
                                            <select name="gender" class="form-control">

                                                <option value="">Select</option>

                                                <option value="male" {{ $athlete->gender == 'male' ? 'selected' : '' }}>Male
                                                </option>
                                                <option value="female" {{ $athlete->gender == 'female' ? 'selected' : '' }}>
                                                    Female
                                                </option>
                                                <option value="other" {{ $athlete->gender == 'other' ? 'selected' : '' }}>
                                                    Other
                                                </option>
                                                <option value="na" {{ $athlete->gender == 'na' ? 'selected' : '' }}>Prefer Not
                                                </option>

                                            </select>
                                        </div>
                                    </div>


                                    {{-- Nationality --}}
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Nationality *</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="nationality" class="form-control"
                                                placeholder="Enter your Nationality" value="{{ $athlete->nationality }}">
                                        </div>
                                    </div>


                                    {{-- Profile --}}
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Profile Photo</label>

                                        <div class="col-sm-10">

                                            <img id="imgPreview"
                                                src="{{ $user->image ? asset('athlete_assets/images/' . $user->image) : 'https://via.placeholder.com/120' }}"
                                                class="mb-2 rounded" width="120">

                                            <input type="file" name="athlete_profile" class="form-control"
                                                onchange="previewImage(this)">

                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="mb-3">Contact Information</h6>
                                    </div>


                                    {{-- Email --}}
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Email *</label>
                                        <div class="col-sm-10">
                                            <input type="email" name="email" class="form-control"
                                                placeholder="Enter your Email" value="{{ $user->email }}">
                                        </div>
                                    </div>


                                    {{-- Mobile --}}
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Mobile *</label>

                                        <div class="col-sm-10 ">
                                            <div class="d-flex gap-2 mobile-wrapper">

                                                <input type="text" name="mobile" id="mobile" class="form-control"
                                                    maxlength="10" placeholder="Enter your Mobile Number"
                                                    value="{{ $user->phoneNumber }}">

                                                <button type="button" class="btn btn-primary" id="sendOtpBtn">
                                                    <span id="otpBtnText">Send OTP</span>
                                                </button>
                                            </div>
                                            <div class="mobile-error"></div>

                                        </div>
                                    </div>

                                    {{-- OTP --}}
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">OTP</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="otp" placeholder="Enter Your 6 digit otp"
                                                class="form-control" maxlength="6" >
                                        </div>
                                    </div>

                                    {{-- Address --}}
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Address *</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="address" class="form-control"
                                                placeholder="Enter your Address" value="{{ $athlete->address }}">
                                        </div>
                                    </div>


                                    {{-- City --}}
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">City *</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="city" class="form-control"
                                                placeholder="Enter your City" value="{{ $athlete->city }}">
                                        </div>
                                    </div>


                                    {{-- State --}}
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">State *</label>
                                        <div class="col-sm-10">

                                            <select name="state_id" class="form-control">

                                                <option value="">Select</option>

                                                @foreach($states as $s)

                                                    <option value="{{ $s->id }}" {{ $athlete->state_id == $s->id ? 'selected' : '' }}>{{ $s->name }}</option>

                                                @endforeach

                                            </select>

                                        </div>
                                    </div>


                                    {{-- Next --}}
                                    <div class="row justify-content-end">
                                        <div class="col-sm-10 text-end">

                                            <button type="button" onclick="nextStep(this)" class="btn btn-primary">

                                                Next

                                            </button>

                                        </div>
                                    </div>

                                </div>


                                <div class="step-tab d-none" id="step2">

                                    <h5>Academic Info (Step-2)</h5>
                                    <div>
                                        <h6 class="mb-3">High School(10th)</h6>
                                    </div>

                                    {{-- School --}}
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">School Name *</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="school_name" class="form-control"
                                                placeholder="Enter your School Name" value="{{ $athlete->academicDetail->school_name ?? '' }}">
                                        </div>
                                    </div>


                                    {{-- Board --}}
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Board *
                                            <span class="text-muted">(CBSE, ICSE, State Board)</span></label>
                                        <div class="col-sm-10">
                                            <input type="text" name="board" class="form-control"
                                                placeholder="Enter your Board" value="{{ $athlete->academicDetail->board ?? '' }}">
                                        </div>
                                    </div>


                                    {{-- Passing Year --}}
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Year Of Passing *</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="tenth_year" class="form-control"
                                                placeholder="Enter your 10th Year" value="{{ $athlete->academicDetail->tenth_year ?? '' }}">
                                        </div>
                                    </div>
                                    {{-- Percentage --}}
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Percentage / Grade / CGPA *</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="tenth_percentage" class="form-control"
                                                placeholder="Enter your 10th Percentage" value="{{ $athlete->academicDetail->tenth_percentage ?? '' }}">
                                        </div>
                                    </div>

                                    <div>
                                        <h6 class="mb-3">Intermediate(12th / Diploma)</h6>
                                    </div>

                                    {{-- Intermidate / Diploma Name --}}
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">College / School Name *</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="twelfth_school_name" class="form-control"
                                                placeholder="Enter your School Name" value="{{ $athlete->academicDetail->twelfth_school_name ?? '' }}">
                                        </div>
                                    </div>


                                    {{-- Board / University --}}
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Board / University *</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="twelfth_board" class="form-control"
                                                placeholder="Enter your Board" value="{{ $athlete->academicDetail->twelfth_board ?? '' }}">
                                        </div>
                                    </div>

                                    {{-- Stream --}}
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Stream(Science / Commerce / Arts / Vocational) *</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="stream" class="form-control"
                                                placeholder="Enter your Stream" value="{{ $athlete->academicDetail->stream ?? '' }}">
                                        </div>
                                    </div>


                                    {{-- Passing Year --}}
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Year Of Passing *</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="twelfth_year" class="form-control"
                                                placeholder="Enter your 12th Year" value="{{ $athlete->academicDetail->twelfth_year ?? '' }}">
                                        </div>
                                    </div>
                                    {{-- Percentage --}}
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Percentage / Grade / CGPA *</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="twelfth_percentage" class="form-control"
                                                placeholder="Enter your 12th Percentage" value="{{ $athlete->academicDetail->twelfth_percentage ?? '' }}">
                                        </div>
                                    </div>

                                    <div>
                                        <h6 class="mb-3">Graduation (if applicable)</h6>
                                    </div>

                                    {{-- Graducation college --}}
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">College / University Name </label>
                                        <div class="col-sm-10">
                                            <input type="text" name="university_name" class="form-control"
                                                placeholder="Enter your University Name" value="{{ $athlete->academicDetail->university_name ?? '' }}">
                                        </div>
                                    </div>


                                    {{-- University stream --}}
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Degree(B.A / B.Sc / B.Com / B.Tech / etc.) </label>
                                        <div class="col-sm-10">
                                            <input type="text" name="degree" class="form-control"
                                                placeholder="Enter your Degree" value="{{ $athlete->academicDetail->degree ?? '' }}">
                                        </div>
                                    </div>

                                    {{-- Specilization --}}
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Major / Specialization </label>
                                        <div class="col-sm-10">
                                            <input type="text" name="specialization" class="form-control"
                                                placeholder="Enter your Specialization" value="{{ $athlete->academicDetail->specialization ?? '' }}">
                                        </div>
                                    </div>


                                    {{-- Passing Year --}}
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Year Of Passing /Expected Year *</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="university_year" class="form-control"
                                                placeholder="Enter your University Year" value="{{ $athlete->academicDetail->university_year ?? '' }}">
                                        </div>
                                    </div>
                                    {{-- Percentage --}}
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Percentage / Grade / CGPA *</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="university_percentage" class="form-control"
                                                placeholder="Enter your University Percentage" value="{{ $athlete->academicDetail->university_percentage ?? '' }}">
                                        </div>
                                    </div>


                                    <div class="row justify-content-between">

                                        <div class="col-sm-5">
                                            <button type="button" onclick="prevStep()" class="btn btn-primary">
                                                Prev
                                            </button>
                                        </div>

                                        <div class="col-sm-5 text-end">
                                            <button type="button" onclick="finalSubmit(this)" class="btn btn-primary">
                                                Submit
                                            </button>
                                        </div>

                                    </div>

                                </div>


                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection




    <script>

        function clearFormMessage() {
            const box = document.getElementById('formMessage');

            if (box) {
                box.classList.add('d-none');
                box.innerText = '';
            }
        }

        let currentStep = 1;


        /* On Page Load */
        document.addEventListener('DOMContentLoaded', () => {

            showStep(1);

        });


        /* Show Step */
        function showStep(step) {

            document.querySelectorAll('.step-tab')
                .forEach(el => el.classList.add('d-none'));

            const el = document.getElementById('step' + step);

            if (el) {
                el.classList.remove('d-none');
            }
        }


        /* Previous */
        function prevStep() {

            clearFormMessage();

            if (currentStep > 1) {

                currentStep--;

                showStep(currentStep);
            }
        }


        /* Next */
        function nextStep(btn) {

            clearFormMessage();
            clearErrors();

            btn.disabled = true;

            const form = document.getElementById('athleteUpdateForm');
            const data = new FormData(form);

            data.append('step', currentStep);


            fetch(form.action, {

                method: 'POST',

                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN':
                        document.querySelector('[name=_token]').value
                },

                body: data

            })

                .then(async res => {

                    const resp = await res.json();

                    // ❌ Validation Error
                    if (!res.ok) {

                        if (resp.errors) {
                            showErrors(resp.errors);
                        } else {
                            alert('Server Error');
                        }

                        throw 'error';
                    }

                    return resp;
                })

                .then(resp => {

                    if (resp.status) {



                        currentStep++;

                        if (currentStep <= 2) {
                            showStep(currentStep);
                        }
                    }

                })

                .catch(() => { })

                .finally(() => btn.disabled = false);
        }


        /* Final Submit */
        function finalSubmit(btn) {

            clearErrors();
            clearFormMessage();

            btn.disabled = true;

            const form = document.getElementById('athleteUpdateForm');

            const data = new FormData(form);

            data.append('step', 2); // FINAL STEP


            fetch(form.action, {

                method: 'POST',

                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN':
                        document.querySelector('[name=_token]').value
                },

                body: data

            })

                .then(async res => {

                    const resp = await res.json();

                    if (!res.ok) {

                        if (resp.errors) {

                            showErrors(resp.errors);

                        } else {

                            alert('Server Error');
                        }

                        throw 'error';
                    }

                    return resp;
                })

                .then(resp => {

                    if (resp.status) {

                        showMessage('Profile Updated Successfully!', 'success');

                        setTimeout(() => {
                            window.location.href = resp.redirect;
                        }, 1500);
                    }

                })

                .catch(() => { })

                .finally(() => btn.disabled = false);

        }



        /* ================= ERROR HANDLING ================= */


        function clearErrors() {

            document.querySelectorAll('.dynamic-error')
                .forEach(e => e.remove());
        }


        function showErrors(errors) {

            Object.entries(errors).forEach(([key, msg]) => {

                const input = document.querySelector(`[name="${key}"]`);

                if (!input) return;

                // Find parent col
                const parent = input.closest('.col-sm-10');

                if (!parent) return;

                // Remove old error
                parent.querySelectorAll('.dynamic-error').forEach(e => e.remove());

                const div = document.createElement('div');

                div.className = 'text-danger dynamic-error mt-1';

                div.innerText = msg[0];

                // Append at bottom of field
                parent.appendChild(div);

            });
        }




        /* Image Preview */
        function previewImage(input) {

            if (input.files && input.files[0]) {

                const r = new FileReader();

                r.onload = e => {

                    document.getElementById('imgPreview').src = e.target.result;
                };

                r.readAsDataURL(input.files[0]);
            }
        }

    </script>

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

                fetch("{{ route('athlete.sendOtp') }}", {
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

                fetch("{{ route('athlete.verifyOtp') }}", {
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