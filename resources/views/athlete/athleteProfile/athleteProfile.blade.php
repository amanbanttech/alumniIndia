@extends('layout.athlete.app')

@section('content')
    <div class="stepper">
        <div id="step-1" class="step active" data-step="1">01</div>
        <div class="line"></div>
        <div id="step-2" class="step" data-step="2">02</div>
        <div class="line"></div>
        <div id="step-3" class="step" data-step="3">03</div>
        <div class="line"></div>
        <div id="step-4" class="step" data-step="4">04</div>
    </div>

    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">

            <div class="row">
                <div class="col-xxl">
                    <div class="card mb-4">

                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Update Athlete Profile </h5>
                        </div>
                        <div id="formMessage" class="alert d-none"></div>

                        <form id="athleteUpdateForm" action="{{ route('athlete.profile.update.ajax') }}" method="POST"
                            enctype="multipart/form-data">

                            @csrf

                            {{-- PAGE 1 --}}
                            <div class="card-body form-step active " id="step1">

                                <div class="figma-form">
                                    <h2 class=" mb-3 ">Personal Information</h2>

                                    <!-- Personal information -->
                                    <div class="border rounded p-3 mb-4">
                                        <h4 class="figma-heading"><span class="section-icon">
                                                <i class="fa-solid fa-user"></i>
                                            </span>

                                            Basic details
                                        </h4>
                                        <div class="row">

                                            {{-- Athlete Name --}}
                                            <div class="col-md-6 mb-3">
                                                <label>Full Name *</label>
                                                <input type="text" name="name" class="form-control"
                                                    placeholder="Enter your full name"
                                                    value="{{ $athlete->name ?? $user->name }}">
                                            </div>
                                            {{-- D.O.B --}}
                                            <div class="col-md-6 mb-3">
                                                <label>Date of Birth *</label>
                                                <input type="date" name="dob" class="form-control" placeholder=""
                                                    max="{{ date('Y-m-d') }}" value="{{ $athlete->date_of_birth ?? '' }}">
                                            </div>

                                            {{-- Nationality --}}
                                            <div class="col-md-6 mb-3">
                                                <label>Nationality *</label>
                                                <input type="text" name="nationality" class="form-control"
                                                    placeholder="Enter your nationality"
                                                    value="{{ $athlete->nationality ?? '' }}">
                                            </div>

                                            {{-- Gender --}}

                                            <div class="mb-3">
                                                <label class="d-block mb-2">Gender *</label>

                                                <div class="gender-group">
                                                    <label class="gender-option">
                                                        <input type="radio" name="gender" value="male" {{ ($athlete->gender ?? 'male') == 'male' ? 'checked' : '' }}>
                                                        <span class="custom-radio"></span>
                                                        Male
                                                    </label>

                                                    <label class="gender-option">
                                                        <input type="radio" name="gender" value="female" {{ ($athlete->gender ?? 'male') == 'female' ? 'checked' : '' }}>
                                                        <span class="custom-radio"></span>
                                                        Female
                                                    </label>

                                                    <label class="gender-option">
                                                        <input type="radio" name="gender" value="other" {{ ($athlete->gender ?? 'male') == 'other' ? 'checked' : '' }}>
                                                        <span class="custom-radio"></span>
                                                        Others
                                                    </label>

                                                    <label class="gender-option">
                                                        <input type="radio" name="gender" value="na" {{ ($athlete->gender ?? 'male') == 'na' ? 'checked' : '' }}>
                                                        <span class="custom-radio"></span>
                                                        Prefer not to say
                                                    </label>
                                                </div>
                                            </div>

                                            {{-- profile photo --}}
                                            <div class="col-md-12 mb-4">
                                                <label class="figma-label">Profile Photo</label>

                                                <label class="upload-box">
                                                    <img id="imgPreview" src="{{ $user->image
        ? asset('athlete_assets/images/' . $user->image)
        : 'https://via.placeholder.com/120' }}" class="mb-2 rounded d-block" width="120">
                                                    <input type="file" name="athlete_profile" accept="image/*" hidden
                                                        onchange="previewImage(this)">
                                                    <div class="upload-content">
                                                        <div class="upload-icon">
                                                            <i class="fa-solid fa-cloud-arrow-up"></i>
                                                        </div>
                                                        <div class="upload-text">
                                                            <strong>Upload Profile Photo</strong>
                                                            <span>Allowed formats: JPG, JPEG, PNG, WEBP. max size: 200px X
                                                                200px.</span>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                            {{-- Contact Information --}}
                                            <div class="border rounded p-3 mb-4">
                                                <h4 class="figma-heading"><span class="section-icon">
                                                        <i class="fa-solid fa-address-book"></i>
                                                    </span>

                                                    Contact Information
                                                </h4>

                                                <div class="row">
                                                    {{-- Email --}}
                                                    <div class="col-md-6 mb-3">
                                                        <label>Email *</label>
                                                        <input type="text" name="email" class="form-control"
                                                            placeholder="Enter your email" value="{{ $user->email ?? '' }}"
                                                            readonly>
                                                    </div>

                                                    {{-- Phone Number --}}
                                                    <div class="col-md-6 mb-3">
                                                        <label>Phone Number *</label>
                                                        <div class="otp-input-wrapper">
                                                            <input type="text" name="mobile" id="mobile"
                                                                class="form-control" maxlength="10"
                                                                placeholder="Enter your phone number"
                                                                value="{{ $user->phoneNumber ?? '' }}" readonly>

                                                        </div>

                                                        </button>
                                                    </div>

                                                    {{-- Athlete Address --}}
                                                    <div class="col-md-6 mb-3">
                                                        <label>Current Address *</label>
                                                        <input type="text" name="address" class="form-control"
                                                            placeholder="Enter your current address"
                                                            value="{{ $athlete->address ?? '' }}">
                                                    </div>
                                                    {{-- City --}}

                                                    <div class="col-md-6 mb-3">
                                                        <label>City *</label>
                                                        <input type="text" name="city" class="form-control"
                                                            placeholder="Enter your city"
                                                            value="{{ $athlete->city ?? '' }}">
                                                    </div>
                                                    {{-- State --}}
                                                    <div class="col-md-6 mb-3">
                                                        <label>State *</label>
                                                        <select name="state_id" class="form-control">

                                                            <option value="">Select your State</option>

                                                            @foreach($states as $s)

                                                                <option value="{{ $s->id }}" {{ $athlete->state_id == $s->id ? 'selected' : '' }}>{{ $s->name }}</option>

                                                            @endforeach

                                                        </select>
                                                    </div>
                                                    {{-- Zip Code --}}

                                                    <div class="col-md-6 mb-3">
                                                        <label>Zip Code *</label>
                                                        <input type="text" name="zip_code" class="form-control"
                                                            placeholder="Enter your zipcode"
                                                            value="{{ $athlete->zip_code ?? '' }}" maxlength="8">
                                                    </div>
                                                    <div class="d-flex justify-content-end mt-3">
                                                        <button type="button" onclick="nextStep(this)"
                                                            class="btn btn-primary" id="nextBtn1">
                                                            Next <i class="fa-solid fa-angles-right"></i>
                                                        </button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            {{-- PAGE 2 --}}
                            <div class="card-body form-step" id="step2">
                                <div class="figma-form">
                                    <h2 class=" mb-3 ">Academic Information</h2>

                                    <!-- High School -->
                                    <div class="border rounded p-3 mb-4">
                                        <h4 class="figma-heading"><span class="section-icon">
                                                <i class="fa-solid fa-book-open"></i>
                                            </span>

                                            High School (10th)
                                        </h4>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label>School Name *</label>
                                                <input type="text" name="school_name" class="form-control"
                                                    placeholder="Enter school name"
                                                    value="{{ $athlete->academicDetail->school_name ?? '' }}">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Board *</label>
                                                <div class="custom-select-wrapper">
                                                    <select name="tenth_board_id" class="form-control figma-select">
                                                        <option value="">Select 10th Board</option>
                                                        @foreach($boards as $board)
                                                            <option value="{{ $board->id }}" {{ ($athlete->academicDetail->tenth_board_id ?? '') == $board->id ? 'selected' : '' }}>
                                                                {{ $board->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <span class="select-arrow">
                                                        <i class="fa-solid fa-chevron-down"></i>
                                                    </span>
                                                </div>
                                            </div>



                                            <div class="col-md-6 mb-3">
                                                <label>Result Type *</label>
                                                <div class="custom-select-wrapper">
                                                    <select class="form-control figma-select" name="tenth_result_type"
                                                        onchange="changeResultType(this, 'tenth')">
                                                        <option value="">Select</option>
                                                        <option value="percentage" {{ $athlete->academicDetail->tenth_result_type == 'percentage' ? 'selected' : '' }}>Percentage</option>
                                                        <option value="cgpa" {{ $athlete->academicDetail->tenth_result_type == 'cgpa' ? 'selected' : '' }}>CGPA</option>
                                                        <option value="grade" {{ $athlete->academicDetail->tenth_result_type == 'grade' ? 'selected' : '' }}>Grade</option>
                                                    </select>
                                                    <span class="select-arrow">
                                                        <i class="fa-solid fa-chevron-down"></i>
                                                    </span>
                                                </div>
                                            </div>


                                            <div class="col-md-6 mb-3">
                                                <label>Result *</label>
                                                <input type="text" name="tenth_result" class="form-control"
                                                    id="tenth_result" placeholder=" Select result type first"
                                                    value="{{ $athlete->academicDetail->tenth_result ?? '' }}">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Year of Passing *</label>
                                                <input type="text" name="tenth_year" class="form-control"
                                                    placeholder="Year of passing " maxlength="4"
                                                    value="{{ $athlete->academicDetail->tenth_year ?? '' }}">
                                            </div>

                                            <div class="col-md-12 mb-4">
                                                <label class="figma-label">Certificate Upload *</label>

                                                <label class="upload-box">
                                                    <img class="preview-img" id="tenthPreview" src="{{ $athlete->academicDetail->tenth_marksheet
        ? asset('athlete_assets/10_marksheet/' . $athlete->academicDetail->tenth_marksheet)
        : 'https://via.placeholder.com/120' }}" class="mb-2 rounded d-block" width="120">
                                                    <input type="file" class="preview-input" data-preview="tenthPreview" name="tenth_marksheet" accept="image/*" hidden
                                                        >
                                                    <div class="upload-content">
                                                        <div class="upload-icon">
                                                            <i class="fa-solid fa-cloud-arrow-up"></i>
                                                        </div>
                                                        <div class="upload-text">
                                                            <strong>Upload Certificate</strong>
                                                            <span>Allowed formats: JPG, JPEG, PNG, WEBP. max size: 200px X
                                                                200px.</span>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>



                                        </div>
                                    </div>

                                    <!-- Intermediate -->
                                    <div class="border rounded p-3 mb-4">
                                        <h4 class="figma-heading"><span class="section-icon">
                                                <i class="fa-solid fa-graduation-cap"></i>
                                            </span>

                                            Intermediate (12th)
                                        </h4>



                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label>School Name </label>
                                                <input type="text" name="twelfth_school_name" class="form-control"
                                                    placeholder="Enter school name"
                                                    value="{{ $athlete->academicDetail->twelfth_school_name ?? '' }}">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Board </label>
                                                <div class="custom-select-wrapper">
                                                    <select name="twelfth_board_id" id="boardSelect"
                                                        class="form-control figma-select">
                                                        <option value="">Select Board</option>

                                                        {{-- 12th Boards --}}
                                                        @foreach($boards as $board)
                                                            <option value="{{ $board->id }}" {{ ($athlete->academicDetail->twelfth_board_id ?? '') == $board->id ? 'selected' : '' }}>
                                                                {{ $board->name }}
                                                            </option>
                                                        @endforeach

                                                    </select>

                                                    <span class="select-arrow">
                                                        <i class="fa-solid fa-chevron-down"></i>
                                                    </span>
                                                </div>
                                            </div>


                                            <div class="col-md-6 mb-3">
                                                <label>Stream </label>
                                                <div class="custom-select-wrapper">
                                                    <select name="twelfth_stream_id" id="streamSelect"
                                                        class="form-control figma-select">

                                                        <option value="">Select Stream</option>

                                                        {{-- 12th Streams --}}
                                                        @foreach($twelfthStreams as $s)
                                                            <option value="{{ $s->id }}" {{ ($athlete->academicDetail->twelfth_stream_id ?? '') == $s->id ? 'selected' : '' }}>
                                                                {{ $s->stream }}
                                                            </option>
                                                        @endforeach


                                                    </select>


                                                    <span class="select-arrow">
                                                        <i class="fa-solid fa-chevron-down"></i>
                                                    </span>
                                                </div>
                                            </div>



                                            <div class="col-md-6 mb-3">
                                                <label>Year of Passing </label>
                                                <input type="text" name="twelfth_year" class="form-control"
                                                    placeholder="Year of passing" maxlength="4"
                                                    value="{{ $athlete->academicDetail->twelfth_year ?? '' }}">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Result Type </label>
                                                <div class="custom-select-wrapper">
                                                    <select class="form-control figma-select" name="twelfth_result_type"
                                                        onchange="changeResultType(this, 'twelfth')">
                                                        <option value="">Select</option>
                                                        <option value="percentage" {{ $athlete->academicDetail->twelfth_result_type == 'percentage' ? 'selected' : '' }}>Percentage</option>
                                                        <option value="cgpa" {{ $athlete->academicDetail->twelfth_result_type == 'cgpa' ? 'selected' : '' }}>CGPA</option>
                                                        <option value="grade" {{ $athlete->academicDetail->twelfth_result_type == 'grade' ? 'selected' : '' }}>Grade</option>
                                                    </select>
                                                    <span class="select-arrow">
                                                        <i class="fa-solid fa-chevron-down"></i>
                                                    </span>
                                                </div>
                                            </div>


                                            <div class="col-md-6 mb-3">
                                                <label>Result </label>
                                                <input type="text" name="twelfth_result" class="form-control"
                                                    id="twelfth_result" placeholder=" Select result type first"
                                                    value="{{ $athlete->academicDetail->twelfth_result ?? '' }}">
                                            </div>

                                            <div class="col-md-12 mb-4">
                                                <label class="figma-label">Certificate Upload</label>

                                                <label class="upload-box">
                                                    <img class="preview-img" id="twelfthPreview" src="{{ $athlete->academicDetail->twelfth_marksheet
        ? asset('athlete_assets/12_marksheet/' . $athlete->academicDetail->twelfth_marksheet)
        : 'https://via.placeholder.com/120' }}" class="mb-2 rounded d-block" width="120">
                                                    <input type="file" class="preview-input" data-preview="twelfthPreview"  name="twelfth_marksheet" accept="image/*" hidden
                                                        >
                                                    <div class="upload-content">
                                                        <div class="upload-icon">
                                                            <i class="fa-solid fa-cloud-arrow-up"></i>
                                                        </div>
                                                        <div class="upload-text">
                                                            <strong>Upload Certificate</strong>
                                                            <span>Allowed formats: JPG, JPEG, PNG, WEBP. max size: 200px X
                                                                200px.</span>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>


                                        </div>
                                    </div>
                                    <!-- Diploma -->

                                    <div class="border rounded p-3 mb-4">
                                        <h4 class="figma-heading"><span class="section-icon">
                                                <i class="fa-solid fa-graduation-cap"></i>
                                            </span>

                                            Diploma
                                        </h4>



                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label>College Name </label>
                                                <input type="text" name="diploma_college_name" class="form-control"
                                                    placeholder="Enter college name"
                                                    value="{{ $athlete->academicDetail->diploma_college_name ?? '' }}">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Board </label>
                                                <div class="custom-select-wrapper">
                                                    <select name="diploma_board_id" id="boardSelect"
                                                        class="form-control figma-select">
                                                        <option value="">Select Board</option>

                                                        @foreach($diplomaBoards as $d)
                                                            <option value="{{ $d->id }}" {{ ($athlete->academicDetail->diploma_board_id ?? '') == $d->id ? 'selected' : '' }}>
                                                                {{ $d->board }}
                                                            </option>
                                                        @endforeach

                                                    </select>

                                                    <span class="select-arrow">
                                                        <i class="fa-solid fa-chevron-down"></i>
                                                    </span>
                                                </div>
                                            </div>


                                            <div class="col-md-6 mb-3">
                                                <label>Stream </label>
                                                <div class="custom-select-wrapper">
                                                    <select name="diploma_stream_id" id="streamSelect"
                                                        class="form-control figma-select">

                                                        <option value="">Select Stream</option>


                                                        @foreach($diplomaStreams as $s)
                                                            <option value="{{ $s->id }}" {{ ($athlete->academicDetail->diploma_stream_id ?? '') == $s->id ? 'selected' : '' }}>
                                                                {{ $s->stream }}
                                                            </option>
                                                        @endforeach


                                                    </select>


                                                    <span class="select-arrow">
                                                        <i class="fa-solid fa-chevron-down"></i>
                                                    </span>
                                                </div>
                                            </div>



                                            <div class="col-md-6 mb-3">
                                                <label>Year of Passing </label>
                                                <input type="text" name="diploma_year" class="form-control"
                                                    placeholder="Year of passing" maxlength="4"
                                                    value="{{ $athlete->academicDetail->diploma_year ?? '' }}">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Result Type </label>
                                                <div class="custom-select-wrapper">
                                                    <select class="form-control figma-select" name="diploma_result_type"
                                                        onchange="changeResultType(this, 'diploma')">
                                                        <option value="">Select</option>
                                                        <option value="percentage" {{ $athlete->academicDetail->diploma_result_type == 'percentage' ? 'selected' : '' }}>Percentage</option>
                                                        <option value="cgpa" {{ $athlete->academicDetail->diploma_result_type == 'cgpa' ? 'selected' : '' }}>CGPA</option>
                                                        <option value="grade" {{ $athlete->academicDetail->diploma_result_type == 'grade' ? 'selected' : '' }}>Grade</option>
                                                    </select>
                                                    <span class="select-arrow">
                                                        <i class="fa-solid fa-chevron-down"></i>
                                                    </span>
                                                </div>
                                            </div>


                                            <div class="col-md-6 mb-3">
                                                <label>Result </label>
                                                <input type="text" name="diploma_result" class="form-control"
                                                    id="diploma_result" placeholder=" Select result type first"
                                                    value="{{ $athlete->academicDetail->diploma_result ?? '' }}">
                                            </div>

                                            <div class="col-md-12 mb-4">
                                                <label class="figma-label">Certificate Upload</label>

                                                <label class="upload-box">
                                                    <img class="preview-img" id="diplomaPreview" src="{{ $athlete->academicDetail->diploma_marksheet
        ? asset('athlete_assets/diploma_marksheet/' . $athlete->academicDetail->diploma_marksheet)
        : 'https://via.placeholder.com/120' }}" class="mb-2 rounded d-block" width="120">
                                                    <input type="file" class="preview-input" data-preview="diplomaPreview" name="diploma_marksheet" accept="image/*" hidden
                                                        >
                                                    <div class="upload-content">
                                                        <div class="upload-icon">
                                                            <i class="fa-solid fa-cloud-arrow-up"></i>
                                                        </div>
                                                        <div class="upload-text">
                                                            <strong>Upload Certificate</strong>
                                                            <span>Allowed formats: JPG, JPEG, PNG, WEBP. max size: 200px X
                                                                200px.</span>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>


                                        </div>
                                    </div>

                                    <!-- Graduation -->
                                    <div class="border rounded p-3 mb-4">
                                        <h4 class="figma-heading"><span class="section-icon">
                                                <i class="fa-solid fa-award"></i>
                                            </span>

                                            Graduation (if applicable)
                                        </h4>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label>College / University Name</label>
                                                <input type="text" name="graduation_university" class="form-control"
                                                    placeholder="Enter college/university name"
                                                    value="{{ $athlete->academicDetail->graduation_university ?? '' }}">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Degree</label>
                                                <div class="custom-select-wrapper">
                                                    <select name="degree_id" class="form-control figma-select">
                                                        <option value="">Select</option>
                                                        @foreach($degrees as $degree)
                                                            <option value="{{ $degree->id }}" {{ ($athlete->academicDetail->degree_id ?? '') == $degree->id ? 'selected' : '' }}>
                                                                {{ $degree->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <span class="select-arrow">
                                                        <i class="fa-solid fa-chevron-down"></i>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Major / Specialization</label>
                                                <input type="text" name="specialization" class="form-control"
                                                    placeholder="Enter major / specialization"
                                                    value="{{ $athlete->academicDetail->specialization ?? '' }}">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Year of Passing / Expected year</label>
                                                <input type="text" name="graduation_year" class="form-control"
                                                    placeholder="year of passing/expected" maxlength="4"
                                                    value="{{ $athlete->academicDetail->graduation_year ?? '' }}">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Result Type </label>
                                                <div class="custom-select-wrapper">
                                                    <select class="form-control figma-select" name="graduation_result_type"
                                                        onchange="changeResultType(this, 'graduation')">
                                                        <option value="">Select</option>
                                                        <option value="percentage" {{ $athlete->academicDetail->graduation_result_type == 'percentage' ? 'selected' : '' }}>Percentage</option>
                                                        <option value="cgpa" {{ $athlete->academicDetail->graduation_result_type == 'cgpa' ? 'selected' : '' }}>CGPA</option>
                                                        <option value="grade" {{ $athlete->academicDetail->graduation_result_type == 'grade' ? 'selected' : '' }}>Grade</option>
                                                    </select>
                                                    <span class="select-arrow">
                                                        <i class="fa-solid fa-chevron-down"></i>
                                                    </span>
                                                </div>
                                            </div>


                                            <div class="col-md-6 mb-3">
                                                <label>Result </label>
                                                <input type="text" name="graduation_result" class="form-control"
                                                    id="graduation_result" placeholder=" Select result type first"
                                                    value="{{ $athlete->academicDetail->graduation_result ?? '' }}">
                                            </div>


                                            <div class="col-md-12 mb-4">
                                                <label class="figma-label">Certificate Upload</label>

                                                <label class="upload-box">
                                                    <img class="preview-img" id="graduationPreview" src="{{ $athlete->academicDetail->graduation_marksheet
        ? asset('athlete_assets/graduation_marksheet/' . $athlete->academicDetail->graduation_marksheet)
        : 'https://via.placeholder.com/120' }}" class="mb-2 rounded d-block" width="120">
                                                    <input type="file" class="preview-input" data-preview="graduationPreview" name="graduation_marksheet" accept="image/*" hidden
                                                        >
                                                    <div class="upload-content">
                                                        <div class="upload-icon">
                                                            <i class="fa-solid fa-cloud-arrow-up"></i>
                                                        </div>
                                                        <div class="upload-text">
                                                            <strong>Upload Certificate</strong>
                                                            <span>Allowed formats: JPG, JPEG, PNG, WEBP. max size: 200px X
                                                                200px.</span>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between mb-4">
                                        <button type="button" onclick="prevStep()" class="btn btn-secondary-3"
                                            id="prevBtn1"><i class="fa-solid fa-angles-left"></i>
                                            Prev</button>
                                        <button type="button" onclick="nextStep(this)" class="btn btn-primary-3"
                                            id="nextBtn2">Next <i class="fa-solid fa-angles-right"></i></button>
                                    </div>
                                </div>
                            </div>
                            {{-- PAGE 3 --}}
                            <div class="card-body form-step" id="step3">
                                <div class="figma-form">
                                    <h2 class=" mb-3 ">Sports Matrix</h2>

                                    <!-- Primary Support -->
                                    <div class="border rounded p-3 mb-4">
                                        <h4 class="figma-heading"><span class="section-icon">
                                                <i class="fa-solid fa-book-open"></i>
                                            </span>

                                            Primary Support Profile
                                        </h4>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label>Primary Sport *</label>
                                                <div class="custom-select-wrapper">
                                                    <select name="primary_sport_id" class="form-control figma-select">
                                                        <option value="">Select</option>

                                                        @foreach($sports as $sport)
                                                            <option value="{{ $sport->id }}" {{ ($athlete->sportDetail->primary_sport_id ?? '') == $sport->id ? 'selected' : '' }}>
                                                                {{ $sport->name }}
                                                            </option>
                                                        @endforeach

                                                    </select>

                                                    <span class="select-arrow">
                                                        <i class="fa-solid fa-chevron-down"></i>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Current Club / Academy</label>
                                                <input type="text" name="academy" class="form-control"
                                                    placeholder="Enter club / academy"
                                                    value="{{ $athlete->sportDetail->academy ?? '' }}">
                                            </div>


                                            <div class="col-md-6 mb-3">
                                                <label>Coach Name</label>
                                                <input type="text" name="coach_name" class="form-control"
                                                    placeholder="Enter coach name"
                                                    value="{{ $athlete->sportDetail->coach_name ?? '' }}">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Coach Contact</label>
                                                <input type="text" name="coach_contact" class="form-control" maxlength="10"
                                                    placeholder="Enter coach contact number"
                                                    value="{{ $athlete->sportDetail->coach_contact ?? '' }}">
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label>Year of Training / Experience *</label>
                                                <input type="text" name="training_experience" class="form-control"
                                                    placeholder="Enter year of training / experience"
                                                    value="{{ $athlete->sportDetail->training_experience ?? '' }}">
                                            </div>


                                        </div>
                                    </div>

                                    <!-- Physical Metrics-->
                                    <div class="border rounded p-3 mb-4">
                                        <h4 class="figma-heading"><span class="section-icon">
                                                <i class="fa-solid fa-graduation-cap"></i>
                                            </span>

                                            Physical Metrics
                                        </h4>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label>Height (cm) *</label>
                                                <input type="text" name="height" class="form-control"
                                                    placeholder="Enter height" maxlength="5"
                                                    value="{{ $athlete->sportDetail->height ?? '' }}">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Weight (kg) *</label>
                                                <input type="text" name="weight" class="form-control"
                                                    placeholder="Enter weight" maxlength="5"
                                                    value="{{ $athlete->sportDetail->weight ?? '' }}">
                                            </div>

                                            <div class="col-md-6 mb-3 ">
                                                <label>Wingspan (cm) *</label>
                                                <input type="text" name="wingspan" class="form-control"
                                                    placeholder="Enter wingspan" maxlength="5"
                                                    value="{{ $athlete->sportDetail->wingspan ?? '' }}">
                                            </div>

                                            <div class="col-md-6 mb-3 ">
                                                <label>Chest Measurement (cm) *</label>
                                                <input type="text" name="chest" class="form-control"
                                                    placeholder="Enter chest measurement" maxlength="5"
                                                    value="{{ $athlete->sportDetail->chest ?? '' }}">
                                            </div>

                                            <div class="col-md-6 mb-3 ">
                                                <label>Waist Measurement (cm) *</label>
                                                <input type="text" name="waist" class="form-control"
                                                    placeholder="Enter waist measurement" maxlength="5"
                                                    value="{{ $athlete->sportDetail->waist ?? '' }}">
                                            </div>

                                            <div class="col-md-6 mb-3 ">
                                                <label>Body Fat % (optional) </label>
                                                <input type="text" class="form-control" name="body_fat"
                                                    placeholder="Enter body fat" maxlength="5"
                                                    value="{{ $athlete->sportDetail->body_fat ?? '' }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Fitness Level *</label>
                                                <div class="custom-select-wrapper">
                                                    <select name="fitness_level" class="form-control figma-select">
                                                        <option value="">Select</option>

                                                        <option value="Beginner" {{ old('fitness_level', $athlete->sportDetail->fitness_level ?? '') == 'Beginner' ? 'selected' : '' }}>
                                                            Beginner
                                                        </option>

                                                        <option value="Intermediate" {{ old('fitness_level', $athlete->sportDetail->fitness_level ?? '') == 'Intermediate' ? 'selected' : '' }}>
                                                            Intermediate
                                                        </option>

                                                        <option value="Elite" {{ old('fitness_level', $athlete->sportDetail->fitness_level ?? '') == 'Elite' ? 'selected' : '' }}>
                                                            Elite
                                                        </option>
                                                    </select>
                                                    <span class="select-arrow">
                                                        <i class="fa-solid fa-chevron-down"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- competion and ranking -->
                                    <div class="border rounded p-3 mb-4">
                                        <h4 class="figma-heading"><span class="section-icon">
                                                <i class="fa-solid fa-ranking-star"></i>
                                            </span>

                                            Competition & Ranking
                                        </h4>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label>Current State Ranking</label>
                                                <input type="text" name="state_ranking" class="form-control"
                                                    placeholder="Enter state ranking"
                                                    value="{{ $athlete->sportDetail->state_ranking ?? '' }}">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>State Age Category</label>
                                                <div class="custom-select-wrapper">
                                                    <select name="state_age_category" class="form-control figma-select">
                                                        <option value="">Select</option>
                                                        <option value="U14" {{ old('state_age_category', $athlete->sportDetail->state_age_category ?? '') == 'U14' ? 'selected' : '' }}>U14</option>
                                                        <option value="U16" {{ old('state_age_category', $athlete->sportDetail->state_age_category ?? '') == 'U16' ? 'selected' : '' }}>U16</option>
                                                        <option value="U19" {{ old('state_age_category', $athlete->sportDetail->state_age_category ?? '') == 'U19' ? 'selected' : '' }}>U19</option>
                                                        <option value="senior" {{ old('state_age_category', $athlete->sportDetail->state_age_category ?? '') == 'senior' ? 'selected' : '' }}>senior</option>
                                                    </select>
                                                    <span class="select-arrow">
                                                        <i class="fa-solid fa-chevron-down"></i>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Current District Ranking</label>
                                                <input type="text" name="district_ranking" class="form-control"
                                                    placeholder="Enter district ranking"
                                                    value="{{ $athlete->sportDetail->district_ranking ?? '' }}">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>District Age Category</label>
                                                <div class="custom-select-wrapper">
                                                    <select name="district_age_category" class="form-control figma-select">
                                                        <option value="">Select</option>
                                                        <option value="U14" {{ old('district_age_category', $athlete->sportDetail->district_age_category ?? '') == 'U14' ? 'selected' : '' }}>U14</option>
                                                        <option value="U16" {{ old('district_age_category', $athlete->sportDetail->district_age_category ?? '') == 'U16' ? 'selected' : '' }}>U16</option>
                                                        <option value="U19" {{ old('district_age_category', $athlete->sportDetail->district_age_category ?? '') == 'U19' ? 'selected' : '' }}>U19</option>
                                                        <option value="senior" {{ old('district_age_category', $athlete->sportDetail->district_age_category ?? '') == 'senior' ? 'selected' : '' }}>senior</option>
                                                    </select>
                                                    <span class="select-arrow">
                                                        <i class="fa-solid fa-chevron-down"></i>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Current National Ranking</label>
                                                <input type="text" name="national_ranking" class="form-control"
                                                    placeholder="Enter national ranking"
                                                    value="{{ $athlete->sportDetail->national_ranking ?? '' }}">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>National Age Category</label>
                                                <div class="custom-select-wrapper">
                                                    <select name="national_age_category" class="form-control figma-select">
                                                        <option value="">Select</option>
                                                        <option value="U14" {{ old('national_age_category', $athlete->sportDetail->national_age_category ?? '') == 'U14' ? 'selected' : '' }}>U14</option>
                                                        <option value="U16" {{ old('national_age_category', $athlete->sportDetail->national_age_category ?? '') == 'U16' ? 'selected' : '' }}>U16</option>
                                                        <option value="U19" {{ old('national_age_category', $athlete->sportDetail->national_age_category ?? '') == 'U19' ? 'selected' : '' }}>U19</option>
                                                        <option value="senior" {{ old('national_age_category', $athlete->sportDetail->national_age_category ?? '') == 'senior' ? 'selected' : '' }}>senior</option>
                                                    </select>
                                                    <span class="select-arrow">
                                                        <i class="fa-solid fa-chevron-down"></i>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Best Performance Record</label>
                                                <input type="text" name="best_performance" class="form-control"
                                                    placeholder="Enter your best record"
                                                    value="{{ $athlete->sportDetail->best_performance ?? '' }}">
                                            </div>



                                            <div class="col-md-6 mb-3">
                                                <label>International Participation</label>
                                                <div class="custom-select-wrapper">
                                                    <select name="international_participation"
                                                        class="form-control figma-select">
                                                        <option value="Yes" {{ old('international_participation', $athlete->sportDetail->international_participation ?? 'No') == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                        <option value="No" {{ old('international_participation', $athlete->sportDetail->international_participation ?? 'NO') == 'No' ? 'selected' : '' }}>No</option>


                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Gold Medal</label>
                                                <input type="text" name="gold_medal" class="form-control"
                                                    placeholder="Enter no. of gold medal"
                                                    value="{{ $athlete->sportDetail->gold_medal ?? '' }}">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Silver Medal</label>
                                                <input type="text" name="silver_medal" class="form-control"
                                                    placeholder="Enter no. of silver medal"
                                                    value="{{ $athlete->sportDetail->silver_medal ?? '' }}">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Bronze Medal</label>
                                                <input type="text" name="bronze_medal" class="form-control"
                                                    placeholder="Enter no. of bronze medal"
                                                    value="{{ $athlete->sportDetail->bronze_medal ?? '' }}">
                                            </div>


                                        </div>
                                    </div>

                                    <!-- Injury / Medical Status -->
                                    <div class="border rounded p-3 mb-4">
                                        <h4 class="figma-heading"><span class="section-icon">
                                                <i class="fa-solid fa-ranking-star"></i>
                                            </span>

                                            Injury / Medical Status
                                        </h4>

                                        <div class="col-md-12 mb-3">
                                            <label>Previous Injuries *</label>
                                            <div class="custom-select-wrapper">
                                                <select name="previous_injury" id="previous_injury"
                                                    class="form-control figma-select">
                                                    <option value="Yes" {{ old('previous_injury', $athlete->sportDetail->previous_injury ?? 'No') == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                    <option value="No" {{ old('previous_injury', $athlete->sportDetail->previous_injury ?? 'No') == 'No' ? 'selected' : '' }}>No</option>


                                                </select>
                                                <span class="select-arrow">
                                                    <i class="fa-solid fa-chevron-down"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div id="injurySection" style="display:none;">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label>Injury Details *</label>
                                                    <textarea name="injury_details" class="form-control"
                                                        placeholder="Describe your injury, treatment, and recovery...">{{ $athlete->sportDetail->injury_details ?? '' }}</textarea>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label>Recovery Status *</label>
                                                    <input type="text" name="recovery_status" class="form-control"
                                                        placeholder="Enter recovery status"
                                                        value="{{ $athlete->sportDetail->recovery_status ?? '' }}">
                                                </div>

                                            </div>


                                            <div class="col-md-12 mb-4">
                                                <label class="figma-label">Medical Clearance Upload </label>

                                                <label class="upload-box">
                                                    <img class="preview-img" id="medicalPreview" src="{{ $athlete->sportDetail?->medical_certificate
        ? asset('athlete_assets/medical_certificate/' . $athlete->sportDetail?->medical_certificate)
        : 'https://via.placeholder.com/120' }}" class="mb-2 rounded d-block" width="120">
                                                    <input type="file" class="preview-input" data-preview="medicalPreview" name="medical_certificate" accept="image/*" hidden
                                                        >
                                                    <div class="upload-content">
                                                        <div class="upload-icon">
                                                            <i class="fa-solid fa-cloud-arrow-up"></i>
                                                        </div>
                                                        <div class="upload-text">
                                                            <strong>Upload Certificate</strong>
                                                            <span>Allowed formats: JPG, JPEG, PNG, WEBP. max size: 200px X
                                                                200px.</span>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>



                                    </div>

                                    <!-- Verification -->
                                    <div class="border rounded p-3 mb-4">
                                        <h4 class="figma-heading"><span class="section-icon">
                                                <i class="fa-solid fa-ranking-star"></i>
                                            </span>

                                            Verification
                                        </h4>


                                        <div class="col-md-12 mb-4">
                                            <label class="figma-label">Sport ID / Association ID Upload</label>

                                            <label class="upload-box">
                                                <img class="preview-img" id="sportPreview" src="{{ $athlete->sportDetail?->sport_card
        ? asset('athlete_assets/sport_card/' . $athlete->sportDetail?->sport_card)
        : 'https://via.placeholder.com/120' }}" class="mb-2 rounded d-block" width="120">
                                                <input type="file" class="preview-input" name="sport_card" data-preview="sportPreview" accept="image/*" hidden
                                                    >
                                                <div class="upload-content">
                                                    <div class="upload-icon">
                                                        <i class="fa-solid fa-cloud-arrow-up"></i>
                                                    </div>
                                                    <div class="upload-text">
                                                        <strong>Upload Certificate</strong>
                                                        <span>Allowed formats: JPG, JPEG, PNG, WEBP. max size: 200px X
                                                            200px.</span>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>

                                        <div class="col-md-12 mb-4">
                                            <label class="figma-label">Coach Certification Upload</label>

                                            <label class="upload-box">
                                                <img class="preview-img" id="coachPreview" src="{{ $athlete->sportDetail?->coach_certificate
        ? asset('athlete_assets/coach_certificate/' . $athlete->sportDetail?->coach_certificate)
        : 'https://via.placeholder.com/120' }}" class="mb-2 rounded d-block" width="120">
                                                <input type="file" class="preview-input" name="coach_certificate" data-preview="coachPreview" accept="image/*" hidden>
                                                <div class="upload-content">
                                                    <div class="upload-icon">
                                                        <i class="fa-solid fa-cloud-arrow-up"></i>
                                                    </div>
                                                    <div class="upload-text">
                                                        <strong>Upload Certificate</strong>
                                                        <span>Allowed formats: JPG, JPEG, PNG, WEBP. max size: 200px X
                                                            200px.</span>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>



                                    </div>

                                    <div class="d-flex justify-content-between mb-4 ">
                                        <button type="button" onclick="prevStep()" class="btn btn-secondary-3"
                                            id="btnprev3"><i class="fa-solid fa-angles-left"></i>
                                            Prev</button>
                                        <button type="button" onclick="nextStep(this)" class="btn btn-primary-3"
                                            id="btnnext3">Next <i class="fa-solid fa-angles-right"></i></button>
                                    </div>

                                </div>



                            </div>

                            {{-- PAGE 4 --}}
                            <div class="card-body form-step" id="step4">
                                <div class="figma-form">
                                    <h2 class=" mb-3 ">Documents & References</h2>

                                    <!-- Primary Support -->
                                    <div class="border rounded p-3 mb-4">
                                        <h4 class="figma-heading"><span class="section-icon">
                                                <i class="fa-solid fa-file"></i>
                                            </span>

                                            Mandatory Documents
                                        </h4>

                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <label class="figma-label">Profile Photo(passort-size) *</label>

                                                <label class="upload-box">
                                                    <img class="preview-img" id="profilePreview" src="{{ $athlete->document?->profile_photo
        ? asset('athlete_assets/athlete_documents/' . $athlete->document?->profile_photo)
        : 'https://via.placeholder.com/120' }}" class="mb-2 rounded d-block" width="120">
                                                    <input type="file" name="profile_photo" data-preview="profilePreview"
                                                        class="preview-input" accept="image/*" hidden>
                                                    <div class="upload-content">
                                                        <div class="upload-icon">
                                                            <i class="fa-solid fa-cloud-arrow-up"></i>
                                                        </div>
                                                        <div class="upload-text">
                                                            <strong>Upload Certificate</strong>
                                                            <span>Allowed formats: JPG, JPEG, PNG, WEBP. max size: 200px X
                                                                200px.</span>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>

                                            <div class="col-md-12 mb-4">
                                                <label class="figma-label">Goverment ID Proof(Aadhaar / Passport / PAN /
                                                    etc.) *</label>

                                                <label class="upload-box">
                                                    <img class="preview-img" id="govPreview" src="{{ $athlete->document?->government_proof
        ? asset('athlete_assets/athlete_documents/' . $athlete->document?->government_proof)
        : 'https://via.placeholder.com/120' }}" class="mb-2 rounded d-block" width="120">
                                                    <input type="file" class="preview-input" data-preview="govPreview"
                                                        name="government_proof" accept="image/*" hidden>
                                                    <div class="upload-content">
                                                        <div class="upload-icon">
                                                            <i class="fa-solid fa-cloud-arrow-up"></i>
                                                        </div>
                                                        <div class="upload-text">
                                                            <strong>Upload Certificate</strong>
                                                            <span>Allowed formats: JPG, JPEG, PNG, WEBP. max size: 200px X
                                                                200px.</span>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                            <div class="col-md-12 mb-4">
                                                <label class="figma-label">Date of Birth Proof(Birth Certificate / SSC
                                                    Certificate) *</label>

                                                <label class="upload-box">
                                                    <img class="preview-img" id="dobPreview" src="{{ $athlete->document?->dob_proof
        ? asset('athlete_assets/athlete_documents/' . $athlete->document?->dob_proof)
        : 'https://via.placeholder.com/120' }}" class="mb-2 rounded d-block" width="120">
                                                    <input type="file" class="preview-input" data-preview="dobPreview"
                                                        name="dob_proof" accept="image/*" hidden>
                                                    <div class="upload-content">
                                                        <div class="upload-icon">
                                                            <i class="fa-solid fa-cloud-arrow-up"></i>
                                                        </div>
                                                        <div class="upload-text">
                                                            <strong>Upload Certificate</strong>
                                                            <span>Allowed formats: JPG, JPEG, PNG, WEBP. max size: 200px X
                                                                200px.</span>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                            <div class="col-md-12 mb-4">
                                                <label class="figma-label">Address Proof(Aadhar / Utility Bill /
                                                    etc.) *</label>

                                                <label class="upload-box">
                                                    <img class="preview-img" id="addressPreview" src="{{ $athlete->document?->address_proof
        ? asset('athlete_assets/athlete_documents/' . $athlete->document?->address_proof)
        : 'https://via.placeholder.com/120' }}" class="mb-2 rounded d-block" width="120">
                                                    <input type="file" class="preview-input" data-preview="addressPreview"
                                                        name="address_proof" accept="image/*" hidden>
                                                    <div class="upload-content">
                                                        <div class="upload-icon">
                                                            <i class="fa-solid fa-cloud-arrow-up"></i>
                                                        </div>
                                                        <div class="upload-text">
                                                            <strong>Upload Certificate</strong>
                                                            <span>Allowed formats: JPG, JPEG, PNG, WEBP. max size: 200px X
                                                                200px.</span>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>

                                        </div>
                                    </div>

                                    <!--sports related documents -->
                                    <div class="border rounded p-3 mb-4">
                                        <h4 class="figma-heading"><span class="section-icon">
                                                <i class="fa-solid fa-file"></i>
                                            </span>

                                            Sports-Related Documents
                                        </h4>

                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <label class="figma-label">Latest Performance Certificate / Sport
                                                    Achievement Certificates</label>

                                                <label class="upload-box">
                                                    <img class="preview-img" id="sportAchivePreview" src="{{ $athlete->document?->sport_achievement
        ? asset('athlete_assets/athlete_documents/' . $athlete->document?->sport_achievement)
        : 'https://via.placeholder.com/120' }}" class="mb-2 rounded d-block" width="120">
                                                    <input type="file" class="preview-input"
                                                        data-preview="sportAchivePreview" name="sport_achievement"
                                                        accept="image/*" hidden>
                                                    <div class="upload-content">
                                                        <div class="upload-icon">
                                                            <i class="fa-solid fa-cloud-arrow-up"></i>
                                                        </div>
                                                        <div class="upload-text">
                                                            <strong>Upload Certificate</strong>
                                                            <span>Allowed formats: JPG, JPEG, PNG, WEBP. max size: 200px X
                                                                200px.</span>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>

                                            <div class="col-md-12 mb-4">
                                                <label class="figma-label">Coach Recommendation Letter</label>

                                                <label class="upload-box">
                                                    <img class="preview-img" id="coachRecomendationPreview" src="{{ $athlete->document?->coach_recommendation
        ? asset('athlete_assets/athlete_documents/' . $athlete->document?->coach_recommendation)
        : 'https://via.placeholder.com/120' }}" class="mb-2 rounded d-block" width="120">
                                                    <input type="file" class="preview-input"
                                                        data-preview="coachRecomendationPreview" name="coach_recommendation"
                                                        accept="image/*" hidden>
                                                    <div class="upload-content">
                                                        <div class="upload-icon">
                                                            <i class="fa-solid fa-cloud-arrow-up"></i>
                                                        </div>
                                                        <div class="upload-text">
                                                            <strong>Upload Certificate</strong>
                                                            <span>Allowed formats: JPG, JPEG, PNG, WEBP. max size: 200px X
                                                                200px.</span>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>

                                            <div class="col-md-12 mb-4">
                                                <label class="figma-label">Medical Fitness Certificate *</label>

                                                <label class="upload-box">
                                                    <img class="preview-img" id="medicalFitnessPreview" src="{{ $athlete->document?->medical_fitness
        ? asset('athlete_assets/athlete_documents/' . $athlete->document?->medical_fitness)
        : 'https://via.placeholder.com/120' }}" class="mb-2 rounded d-block" width="120">
                                                    <input type="file" class="preview-input"
                                                        data-preview="medicalFitnessPreview" name="medical_fitness"
                                                        accept="image/*" hidden>
                                                    <div class="upload-content">
                                                        <div class="upload-icon">
                                                            <i class="fa-solid fa-cloud-arrow-up"></i>
                                                        </div>
                                                        <div class="upload-text">
                                                            <strong>Upload Certificate</strong>
                                                            <span>Allowed formats: JPG, JPEG, PNG, WEBP. max size: 200px X
                                                                200px.</span>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>

                                            <div class="col-md-12 mb-4">
                                                <label class="figma-label">Player Contract (if part of club /
                                                    academy)</label>

                                                <label class="upload-box">
                                                    <img class="preview-img" id="playerContractPreview" src="{{ $athlete->document?->player_contract
        ? asset('athlete_assets/athlete_documents/' . $athlete->document?->player_contract)
        : 'https://via.placeholder.com/120' }}" class="mb-2 rounded d-block" width="120">
                                                    <input type="file" class="preview-input"
                                                        data-preview="playerContractPreview" name="player_contract"
                                                        accept="image/*" hidden>
                                                    <div class="upload-content">
                                                        <div class="upload-icon">
                                                            <i class="fa-solid fa-cloud-arrow-up"></i>
                                                        </div>
                                                        <div class="upload-text">
                                                            <strong>Upload Certificate</strong>
                                                            <span>Allowed formats: JPG, JPEG, PNG, WEBP. max size: 200px X
                                                                200px.</span>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>


                                        </div>
                                    </div>


                                    {{-- Reference 1 --}}
                                    <div class="border rounded p-3 mb-4">
                                        <h4 class="figma-heading"><span class="section-icon">
                                                <i class="fa-solid fa-asterisk"></i>
                                            </span>

                                            Reference 1
                                        </h4>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label>Name </label>
                                                <input type="text" name="reference_name1" class="form-control"
                                                    placeholder="Enter name"
                                                    value="{{ $athlete->document->reference_name1 ?? '' }}">
                                            </div>



                                            <div class="col-md-6 mb-3">
                                                <label>Designation / Role </label>
                                                <div class="custom-select-wrapper">
                                                    <select name="reference_role1" class="form-control figma-select">
                                                        <option value="">Select</option>
                                                        <option value="Coach" {{ old('reference_role1', $athlete->document->reference_role1 ?? '') == 'Coach' ? 'selected' : '' }}>U14</option>
                                                        <option value="Trainer" {{ old('reference_role1', $athlete->document->reference_role1 ?? '') == 'Trainer' ? 'selected' : '' }}>U16</option>
                                                        <option value="Teacher" {{ old('reference_role1', $athlete->document->reference_role1 ?? '') == 'Teacher' ? 'selected' : '' }}>U19</option>
                                                        <option value="Sport Official" {{ old('reference_role1', $athlete->document->reference_role1 ?? '') == 'Sport Official' ? 'selected' : '' }}>senior</option>
                                                    </select>
                                                    <span class="select-arrow">
                                                        <i class="fa-solid fa-chevron-down"></i>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Organization / Academy / Instituation </label>
                                                <input type="text" name="reference_academy1" class="form-control"
                                                    placeholder="Enter organization / academy / instituation"
                                                    value="{{ $athlete->document->reference_academy1 ?? '' }}">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Relationship with Athlete </label>
                                                <input type="text" name="reference_relationship1" class="form-control"
                                                    placeholder="Enter relationship with athlete"
                                                    value="{{ $athlete->document->reference_relationship1 ?? '' }}">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Contact Number </label>
                                                <input type="text" name="reference_number1" class="form-control"
                                                    placeholder="Enter contact number" maxlength="10"
                                                    value="{{ $athlete->document->reference_number1 ?? '' }}">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Email Address </label>
                                                <input type="text" name="reference_email1" class="form-control"
                                                    placeholder="Enter email address"
                                                    value="{{ $athlete->document->reference_email1 ?? '' }}">
                                            </div>



                                        </div>


                                        {{-- Reference 2 --}} <div class="border rounded p-3 mb-4">
                                            <h4 class="figma-heading"><span class="section-icon">
                                                    <i class="fa-solid fa-asterisk"></i>
                                                </span>

                                                Reference 2
                                            </h4>

                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label>Name </label>
                                                    <input type="text" name="reference_name2" class="form-control"
                                                        placeholder="Enter name"
                                                        value="{{ $athlete->document->reference_name2 ?? '' }}">
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label>Designation / Role </label>
                                                    <div class="custom-select-wrapper">
                                                        <select name="reference_role2" class="form-control figma-select">
                                                            <option value="">Select</option>
                                                            <option value="Coach" {{ old('reference_role2', $athlete->document->reference_role2 ?? '') == 'Coach' ? 'selected' : '' }}>U14</option>
                                                            <option value="Trainer" {{ old('reference_role2', $athlete->document->reference_role2 ?? '') == 'Trainer' ? 'selected' : '' }}>U16</option>
                                                            <option value="Teacher" {{ old('reference_role2', $athlete->document->reference_role2 ?? '') == 'Teacher' ? 'selected' : '' }}>U19</option>
                                                            <option value="Sport Official" {{ old('reference_role2', $athlete->document->reference_role2 ?? '') == 'Sport official' ? 'selected' : '' }}>senior</option>
                                                        </select>
                                                        <span class="select-arrow">
                                                            <i class="fa-solid fa-chevron-down"></i>
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label>Organization / Academy / Instituation </label>
                                                    <input type="text" name="reference_academy2" class="form-control"
                                                        placeholder="Enter organization / academy / instituation"
                                                        value="{{ $athlete->document->reference_academy2 ?? '' }}">
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label>Relationship with Athlete </label>
                                                    <input type="text" name="reference_relationship2" class="form-control"
                                                        placeholder="Enter relationship with athlete"
                                                        value="{{ $athlete->document->reference_relationship2 ?? '' }}">
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label>Contact Number </label>
                                                    <input type="text" name="reference_number2" class="form-control"
                                                        placeholder="Enter contact number" maxlength="10"
                                                        value="{{ $athlete->document->reference_number2 ?? '' }}">
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label>Email Address </label>
                                                    <input type="text" name="reference_email2" class="form-control"
                                                        placeholder="Enter email address"
                                                        value="{{ $athlete->document->reference_email2 ?? '' }}">
                                                </div>



                                            </div>

                                            {{-- button --}}
                                            <div class="d-flex justify-content-between mb-4">
                                                <button type="button" onclick="prevStep()" class="btn btn-secondary"
                                                    id="btnprev4"><i class="fa-solid fa-angles-left"></i>
                                                    Prev</button>
                                                <button type="button" onclick="finalSubmit(this)" class="btn btn-primary"
                                                    id="btnnext4">Submit <i class="fa-solid fa-angles-right"></i></button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                        </form>
                    </div>


                    {{-- JS Tabbing --}}




                    {{-- stepper --}}
                    <script>

                        /* ================= GLOBAL ================= */

                        let currentStep = 1;


                        function clearFormMessage() {

                            const box = document.getElementById('formMessage');

                            if (box) {

                                box.classList.add('d-none');
                                box.innerText = '';
                            }
                        }

                        function focusFirstInput(step) {

                            setTimeout(() => {

                                const stepDiv = document.getElementById('step' + step);

                                if (!stepDiv) return;

                                const firstInput = stepDiv.querySelector(
                                    'input:not([type="hidden"]), select, textarea'
                                );

                                if (firstInput) {

                                    firstInput.focus();

                                    firstInput.scrollIntoView({
                                        behavior: 'smooth',
                                        block: 'center'
                                    });
                                }

                            }, 300); // little delay for animation
                        }


                        function showMessage(msg, type = 'danger') {

                            const box = document.getElementById('formMessage');

                            if (!box) return;

                            box.classList.remove('d-none', 'alert-success', 'alert-danger');

                            box.classList.add(
                                type === 'success' ? 'alert-success' : 'alert-danger'
                            );

                            box.innerText = msg;
                        }



                        /* ================= ERROR HANDLING ================= */

                        function clearErrors() {

                            document.querySelectorAll('.dynamic-error')
                                .forEach(e => e.remove());
                        }


                        function showErrors(errors) {

                            let firstTarget = null;

                            Object.entries(errors).forEach(([key, msg], index) => {

                                const input = document.querySelector(`[name="${key}"]`);
                                if (!input) return;

                                let target = input;

                                // If file input → highlight upload box
                                if (input.type === 'file') {
                                    target = input.closest('.upload-box');
                                    target?.classList.add('upload-error');
                                }

                                if (index === 0) {
                                    firstTarget = target;
                                }

                                const div = document.createElement('div');
                                div.className = 'text-danger dynamic-error mt-1';
                                div.innerText = msg[0];

                                target.after(div);

                            });

                            // Scroll to first error
                            if (firstTarget) {
                                firstTarget.scrollIntoView({
                                    behavior: "smooth",
                                    block: "center"
                                });
                            }
                        }





                        /* ================= IMAGE PREVIEW ================= */

                        function previewImage(input) {

                            if (input.files && input.files[0]) {

                                const reader = new FileReader();

                                reader.onload = e => {

                                    document.getElementById('imgPreview').src = e.target.result;
                                };

                                reader.readAsDataURL(input.files[0]);
                            }
                        }
 

                        

                        document.addEventListener('DOMContentLoaded', function () {

                            document.querySelectorAll('.preview-input').forEach(input => {

                                input.addEventListener('change', function () {

                                    if (this.files && this.files[0]) {

                                        const reader = new FileReader();
                                        const previewId = this.getAttribute('data-preview');
                                        const previewImg = document.getElementById(previewId);

                                        reader.onload = function (e) {
                                            if (previewImg) {
                                                previewImg.src = e.target.result;
                                            }
                                        };

                                        reader.readAsDataURL(this.files[0]);
                                    }

                                });

                            });

                        });

                        /* ================= STEPPER ================= */

                        document.addEventListener('DOMContentLoaded', function () {

                            showStep(1);
                            initOtpSystem();

                        });


                        function showStep(step) {

                            // Hide all steps
                            document.querySelectorAll('.form-step')
                                .forEach(el => el.classList.remove('active'));

                            // Show current
                            const el = document.getElementById('step' + step);

                            if (el) {

                                el.classList.add('active');
                            }


                            // Update top stepper
                            document.querySelectorAll('.step')
                                .forEach(s => s.classList.remove('active'));

                            document
                                .querySelector(`.step[data-step="${step}"]`)
                                ?.classList.add('active');


                            currentStep = step;

                            window.scrollTo({
                                top: 0,
                                behavior: 'smooth'
                            });

                            focusFirstInput(step);
                        }



                        function prevStep() {
                            clearErrors();
                            clearFormMessage();

                            if (currentStep > 1) {

                                currentStep--;

                                showStep(currentStep);
                            }

                        }



                        /* ================= NEXT STEP (AJAX) ================= */

                        function nextStep(btn) {

                            clearErrors();
                            clearFormMessage();

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

                                    if (!res.ok) {

                                        if (resp.errors) {

                                            showErrors(resp.errors);

                                        } else {

                                            showMessage('Server Error');
                                        }

                                        throw 'error';
                                    }

                                    return resp;
                                })

                                .then(resp => {

                                    if (resp.status) {

                                        currentStep++;

                                        if (currentStep <= 4) {

                                            showStep(currentStep);
                                        }
                                    }

                                })

                                .catch(() => { })

                                .finally(() => btn.disabled = false);
                        }



                        /* ================= FINAL SUBMIT ================= */

                        function finalSubmit(btn) {

                            clearErrors();
                            clearFormMessage();

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

                                    if (!res.ok) {

                                        if (resp.errors) {

                                            showErrors(resp.errors);

                                        } else {

                                            showMessage('Server Error');
                                        }

                                        throw 'error';
                                    }

                                    return resp;
                                })

                                .then(resp => {

                                    if (resp.status) {

                                        // showMessage('Profile Updated Successfully!', 'success');

                                        setTimeout(() => {

                                            window.location.href = resp.redirect;

                                        }, 1500);
                                    }

                                })

                                .catch(() => { })

                                .finally(() => btn.disabled = false);
                        }

                    </script>

                    <script>

                        function changeResultType(select, prefix) {
                            const input = document.getElementById(prefix + '_result');

                            input.value = '';
                            input.removeAttribute('pattern');
                            input.removeAttribute('title');

                            const type = select.value;

                            if (type === 'percentage') {
                                // 1-100 or 89.45
                                input.placeholder = "Enter Percentage (1-100)";
                                input.pattern = "^100(\\.0{1,2})?$|^([1-9]?[0-9])(\\.\\d{1,2})?$";
                                input.title = "Enter valid percentage (1-100)";

                            }
                            else if (type === 'cgpa') {
                                // 1-10 or 8.5
                                input.placeholder = "Enter CGPA (1-10)";
                                input.pattern = "^10(\\.0{1,2})?$|^[0-9](\\.\\d{1,2})?$";
                                input.title = "Enter valid CGPA (1-10)";

                            }
                            else if (type === 'grade') {
                                // A,B,C
                                input.placeholder = "Enter Grade (A/B/C)";
                                input.pattern = "^[A-Fa-f]$";
                                input.title = "Enter grade A to F";
                            }
                            else {
                                input.placeholder = "Select result type first";
                            }
                        }

                    </script>


                    <script>
                        document.addEventListener('DOMContentLoaded', function () {

                            const injurySelect = document.getElementById('previous_injury');
                            const injurySection = document.getElementById('injurySection');

                            function toggleInjurySection() {

                                if (!injurySelect || !injurySection) return;

                                if (injurySelect.value === 'Yes') {
                                    injurySection.style.display = 'block';
                                } else {
                                    injurySection.style.display = 'none';
                                }
                            }

                            // On change
                            injurySelect.addEventListener('change', toggleInjurySection);

                            // On load (edit case)
                            toggleInjurySection();
                        });
                    </script>




@endsection