@extends('layout.athlete.app')

@section('content')
    <style>
        .preview-images {
            width: 120px;
            height: 120px;
            object-fit: contain;
        }
    </style>

    <div class="content-wrapper">
        <div class="commmon-crads">

            <div class="row">
                <div class="col-xxl">
                    <div class="card mb-4 ">

                        <div class="simple-dashboard-heading">
                            <i class="fa fa-running" aria-hidden="true"></i>
                            <span>Update Athlete Profile</span>
                        </div>

                        <div id="formMessage" class="alert d-none"></div>
                        <div class="card-new-ads">


                            <form id="athleteUpdateForm" action="{{ route('athlete.profile.update.ajax') }}" method="POST"
                                enctype="multipart/form-data">

                                @csrf

                                {{-- PAGE 1 --}}
                                <div class="card-body form-step active " id="step1">

                                    <div class="figma-form">
                                        <h2 class=" main-heding-top ">Personal Information</h2>

                                        <!-- Personal information -->
                                        <div class="main-top-scetion">
                                            <h4 class="figma-heading"><span class="section-icon">
                                                    <i class="fa-solid fa-user"></i>
                                                </span>

                                                Basic details
                                            </h4>
                                            <div class="row">

                                                {{-- Athlete Name --}}
                                                <div class="col-md-12 mb-3">
                                                    <label>Full Name <span style="color: red">*</span></label>
                                                    <input type="text" name="name" class="form-control"
                                                        placeholder="Enter your full name"
                                                        value="{{ $athlete->name ?? $user->name }}">
                                                </div>
                                                {{-- D.O.B --}}
                                                <div class="col-md-6 mb-3">
                                                    <label>Date of Birth <span style="color: red">*</span></label>
                                                    <input type="date" name="dob" class="form-control" placeholder=""
                                                        max="{{ date('Y-m-d') }}"
                                                        value="{{ $athlete->date_of_birth ?? '' }}">
                                                </div>

                                                {{-- Nationality --}}
                                                <div class="col-md-6 mb-3">
                                                    <label>Nationality <span style="color: red">*</span></label>
                                                    <div class="custom-select-wrapper">
                                                        <div class=" select-wrapper">
                                                            <div>
                                                                <select name="nationality_id"
                                                                    class="form-control figma-selec">
                                                                    <option value="">Select Nationality</option>
                                                                    @foreach($nationalities as $nationality)
                                                                        <option value="{{ $nationality->id }}" {{ old('nationality_id', $athlete->nationality_id ?? '') == $nationality->id ? 'selected' : '' }}>
                                                                            {{ $nationality->nationality }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                <i class="fa fa-chevron-down select-icon"></i>
                                                            </div>
                                                            <div class="field-error" data-error="nationality_id"></div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            {{-- Gender --}}


                                            <div class="col-md-12 mb-3">
                                                <label class="d-block mb-2">Gender <span style="color: red">*</span></label>

                                                <div class="gender-group">
                                                    <label class="gender-option">
                                                        <input type="radio" name="gender" value="male" {{
        ($athlete->gender ?? 'male') == 'male' ? 'checked' : '' }}>
                                                        <span class="custom-radio"></span>
                                                        Male
                                                    </label>

                                                    <label class="gender-option">
                                                        <input type="radio" name="gender" value="female" {{
        ($athlete->gender ?? 'male') == 'female' ? 'checked' : ''
                                                                                                                                                                                                                                                                                    }}>
                                                        <span class="custom-radio"></span>
                                                        Female
                                                    </label>

                                                    <label class="gender-option">
                                                        <input type="radio" name="gender" value="other" {{
        ($athlete->gender ?? 'male') == 'other' ? 'checked' : '' }}>
                                                        <span class="custom-radio"></span>
                                                        Others
                                                    </label>

                                                    <label class="gender-option">
                                                        <input type="radio" name="gender" value="na" {{
        ($athlete->gender ?? 'male') == 'na' ? 'checked' : '' }}>
                                                        <span class="custom-radio"></span>
                                                        Prefer not to say
                                                    </label>
                                                </div>
                                            </div>

                                            {{-- profile photo --}}
                                            <div class="col-md-12 mb-3">
                                                <label class="">Profile Photo</label>
                                                <label class="upload-box">
                                                    <input type="file" name="athlete_profile" accept="image/*" hidden
                                                        class="preview-input" data-preview="imgPreview">
                                                    <div class="upload-content">
                                                        <div class="upload-icon">
                                                            <i class="fa-solid fa-cloud-arrow-up"></i>
                                                        </div>
                                                        <div class="upload-text">
                                                            <strong>Upload Profile Photo</strong><br>
                                                            <span>Only JPG, JPEG, PNG, WEBP formats are allowed. Maximum
                                                                image size: 200 × 200 pixels.</span>
                                                        </div>
                                                    </div>
                                                </label>
                                                <img id="imgPreview" src="{{ $user->image
        ? asset('athlete_assets/images/' . $user->image)
        : 'https://via.placeholder.com/120' }}" class="mb-2 rounded preview-images {{ $user->image ? '' : 'd-none' }} "
                                                    width="120" height="120">
                                            </div>

                                        </div>
                                        {{-- Contact Information --}}
                                        <div class="main-top-scetion">
                                            <h4 class="figma-heading"><span class="section-icon">
                                                    <i class="fa-solid fa-address-book"></i>
                                                </span>

                                                Contact Information
                                            </h4>

                                            <div class="row">
                                                {{-- Email --}}
                                                <div class="col-md-6 mb-3">
                                                    <label>Email <span style="color: red">*</span></label>
                                                    <input type="text" name="email" class="form-control"
                                                        placeholder="Enter your email" value="{{ $user->email ?? '' }}"
                                                        readonly>
                                                </div>

                                                {{-- Phone Number --}}
                                                <div class="col-md-6 mb-3">
                                                    <label>Phone Number <span style="color: red">*</span></label>
                                                    <div class="otp-input-wrapper">
                                                        <input type="text" name="mobile" id="mobile" class="form-control"
                                                            maxlength="10" placeholder="Enter your phone number"
                                                            value="{{ $user->phoneNumber ?? '' }}" readonly>

                                                    </div>

                                                    </button>
                                                </div>

                                                {{-- Athlete Address --}}
                                                <div class="col-md-6 mb-3">
                                                    <label>Current Address <span style="color: red">*</span></label>
                                                    <input type="text" name="address" class="form-control"
                                                        placeholder="Enter your current address"
                                                        value="{{ $athlete->address ?? '' }}">
                                                </div>
                                                {{-- City --}}

                                                <div class="col-md-6 mb-3">
                                                    <label>City <span style="color: red">*</span></label>
                                                    <input type="text" name="city" class="form-control"
                                                        placeholder="Enter your city" value="{{ $athlete->city ?? '' }}">
                                                </div>
                                                {{-- State --}}
                                                <div class="col-md-6 mb-3">
                                                    <label>State <span style="color: red">*</span></label>

                                                    <div class=" select-wrapper"> <select name="state_id"
                                                            class="form-control">

                                                            <option value="">Select your state</option>

                                                            @foreach($states as $s)

                                                                                                                <option value="{{ $s->id }}" {{ $athlete->state_id == $s->id
                                                                ? 'selected' : '' }}>{{ $s->name }}</option>

                                                            @endforeach

                                                        </select><i class="fa fa-chevron-down select-icon"></i></div>
                                                </div>
                                                {{-- Zip Code --}}

                                                <div class="col-md-6 mb-3">
                                                    <label>Zip Code <span style="color: red">*</span></label>
                                                    <input type="text" name="zip_code" class="form-control"
                                                        placeholder="Enter your zipcode"
                                                        value="{{ $athlete->zip_code ?? '' }}" maxlength="8">
                                                </div>
                                                <div class="d-flex justify-content-end mt-3">
                                                    <button type="button" onclick="nextStep(this)"
                                                        class="btn btn-primary-adds" id="nextBtn1">
                                                        Next <i class="fa-solid fa-angles-right"></i>
                                                    </button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-new-ads">
                                    <div class="card-body form-step" id="step2">
                                        <div class="figma-form">
                                            <h2 class=" main-heding-top">Academic Information</h2>

                                            <!-- High School -->
                                            <div class="main-top-scetion">
                                                <h4 class="figma-heading"><span class="section-icon">
                                                        <i class="fa-solid fa-book-open"></i>
                                                    </span>

                                                    High School (10th)
                                                </h4>

                                                <div class="row">
                                                    <div class="col-md-12 mb-3">
                                                        <label>School Name <span style="color: red">*</span></label>
                                                        <input type="text" name="school_name" class="form-control"
                                                            placeholder="Enter school name"
                                                            value="{{ $athlete->academicDetail->school_name ?? '' }}">
                                                        <div class="field-error" data-error="school_name"></div>
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label>Board <span style="color: red">*</span></label>
                                                        <div class="custom-select-wrapper">
                                                            <div class=" select-wrapper">
                                                                <div>
                                                                    <select name="tenth_board_id"
                                                                        class="form-control figma-select">
                                                                        <option value="">Select board</option>
                                                                        @foreach($boards as $board)
                                                                                                                                        <option value="{{ $board->id }}" {{ ($athlete->
                                                                            academicDetail->tenth_board_id ?? '') == $board->id ? 'selected'
                                                                            : '' }}>
                                                                                                                                            {{ $board->name }}
                                                                                                                                        </option>
                                                                        @endforeach
                                                                    </select>
                                                                    <i class="fa fa-chevron-down select-icon"></i>
                                                                </div>
                                                                <div class="field-error" data-error="tenth_board_id"></div>
                                                            </div>
                                                        </div>
                                                    </div>



                                                    <div class="col-md-6 mb-3">
                                                        <label>Result Type <span style="color: red">*</span></label>
                                                        <div class="custom-select-wrapper">
                                                            <div class=" select-wrapper"> <select
                                                                    class="form-control figma-select"
                                                                    name="tenth_result_type"
                                                                    onchange="changeResultType(this, 'tenth')">
                                                                    <option value="">Select</option>
                                                                    <option value="percentage" {{ $athlete->
        academicDetail->tenth_result_type == 'percentage' ? 'selected' :
        '' }}>Percentage</option>
                                                                    <option value="cgpa" {{ $athlete->academicDetail->tenth_result_type
        == 'cgpa' ? 'selected' : '' }}>CGPA</option>
                                                                    <option value="grade" {{ $athlete->academicDetail->tenth_result_type
        == 'grade' ? 'selected' : '' }}>Grade</option>
                                                                </select>
                                                                <i class="fa fa-chevron-down select-icon"></i>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-6 mb-3">
                                                        <label>Result <span style="color: red">*</span></label>
                                                        <input type="text" name="tenth_result" class="form-control"
                                                            id="tenth_result" placeholder=" Select result type first"
                                                            value="{{ $athlete->academicDetail->tenth_result ?? '' }}">
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label>Year of Passing <span style="color: red">*</span></label>
                                                        <input type="text" name="tenth_year" class="form-control"
                                                            placeholder="Year of passing " maxlength="4"
                                                            value="{{ $athlete->academicDetail->tenth_year ?? '' }}">
                                                    </div>

                                                    <div class="col-md-12 mb-4">
                                                        <label class="figma-label">Certificate Upload <span
                                                                style="color: red">*</span></label>

                                                        <label class="upload-box">

                                                            <input type="file" class="preview-input"
                                                                data-preview="tenthPreview" name="tenth_marksheet"
                                                                accept=".jpg,.jpeg,.png,.webp,.doc,.docx" hidden>
                                                            <div class="upload-content">
                                                                <div class="upload-icon">
                                                                    <i class="fa-solid fa-cloud-arrow-up"></i>
                                                                </div>
                                                                <div class="upload-text">
                                                                    <strong>Upload High School Certificate</strong><br>
                                                                    <span>Only JPG, JPEG, PNG, WEBP, DOC, DOCX formats are
                                                                        allowed.
                                                                        Maximum
                                                                        image size: 200 × 200 pixels.</span>
                                                                </div>
                                                            </div>
                                                        </label>


                                                        @php
                                                            $file = $athlete->academicDetail?->tenth_marksheet;
                                                            $ext = $file ? strtolower(trim(pathinfo($file, PATHINFO_EXTENSION))) : null;
                                                            $filePath = $file ? asset('athlete_assets/10_marksheet/' . $file) : null;

                                                            $isImage = in_array($ext, ['jpg', 'jpeg', 'png', 'webp']);
                                                        @endphp

                                                        @if($file)

                                                            @if($isImage)
                                                                {{-- IMAGE --}}
                                                                <img id="tenthPreview" src="{{ $filePath }}"
                                                                    class="mb-2 rounded preview-images" width="120" height="120">

                                                            @else
                                                                {{-- DOCUMENT --}}
                                                                <div id="tenthPreview"
                                                                    class="mb-2 rounded preview-images d-flex flex-column align-items-center justify-content-center text-center"
                                                                    style="width: 120px;
    height: 120px;
    border: 2px solid #004592;
    background: #ffffff;
    margin: 17px 0 0;">

                                                                    <i class="fa fa-file-word"
                                                                        style="font-size:28px; color:#007bff;"></i>

                                                                    <span
                                                                        style="font-size:11px; margin-top:6px; padding:0 5px; word-break:break-word;">
                                                                        {{ basename($file) }}
                                                                    </span>

                                                                </div>
                                                            @endif

                                                        @endif



                                                    </div>



                                                </div>
                                            </div>

                                            <!-- Intermediate -->
                                            <div class="main-top-scetion">
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
                                                            <div class=" select-wrapper"> <select name="twelfth_board_id"
                                                                    id="boardSelect" class="form-control figma-select">
                                                                    <option value="">Select board</option>

                                                                    {{-- 12th Boards --}}
                                                                    @foreach($boards as $board)
                                                                                                                                <option value="{{ $board->id }}" {{ ($athlete->
                                                                        academicDetail->twelfth_board_id ?? '') == $board->id ?
                                                                        'selected' : '' }}>
                                                                                                                                    {{ $board->name }}
                                                                                                                                </option>
                                                                    @endforeach

                                                                </select>
                                                                <i class="fa fa-chevron-down select-icon"></i>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-6 mb-3">
                                                        <label>Stream </label>
                                                        <div class="custom-select-wrapper">
                                                            <div class=" select-wrapper"> <select name="twelfth_stream_id"
                                                                    id="streamSelect" class="form-control figma-select">

                                                                    <option value="">Select stream</option>

                                                                    {{-- 12th Streams --}}
                                                                    @foreach($twelfthStreams as $s)
                                                                                                                                <option value="{{ $s->id }}" {{ ($athlete->
                                                                        academicDetail->twelfth_stream_id ?? '') == $s->id ? 'selected'
                                                                        : '' }}>
                                                                                                                                    {{ $s->stream }}
                                                                                                                                </option>
                                                                    @endforeach


                                                                </select>


                                                                <i class="fa fa-chevron-down select-icon"></i>
                                                            </div>
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
                                                            <div class=" select-wrapper"> <select
                                                                    class="form-control figma-select"
                                                                    name="twelfth_result_type"
                                                                    onchange="changeResultType(this, 'twelfth')">
                                                                    <option value="">Select</option>
                                                                    <option value="percentage" {{ $athlete->
        academicDetail->twelfth_result_type == 'percentage' ? 'selected'
        : '' }}>Percentage</option>
                                                                    <option value="cgpa" {{ $athlete->
        academicDetail->twelfth_result_type == 'cgpa' ? 'selected' : ''
                                                                                                                                                                                                                                                                                    }}>CGPA</option>
                                                                    <option value="grade" {{ $athlete->
        academicDetail->twelfth_result_type == 'grade' ? 'selected' : ''
                                                                                                                                                                                                                                                                                    }}>Grade</option>
                                                                </select>
                                                                <i class="fa fa-chevron-down select-icon"></i>
                                                            </div>
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
                                                            <input type="file" class="preview-input"
                                                                data-preview="twelfthPreview" name="twelfth_marksheet"
                                                                accept=".jpg,.jpeg,.png,.webp,.pdf,.doc,.docx" hidden>
                                                            <div class="upload-content">
                                                                <div class="upload-icon">
                                                                    <i class="fa-solid fa-cloud-arrow-up"></i>
                                                                </div>
                                                                <div class="upload-text">
                                                                    <strong>Upload Intermediate Certificate</strong><br>
                                                                    <span>Only JPG, JPEG, PNG, WEBP, DOC, DOCX formats are
                                                                        allowed.
                                                                        Maximum
                                                                        image size: 200 × 200 pixels.</span>
                                                                </div>
                                                            </div>
                                                        </label>
                                                        @php
                                                            $file = $athlete->academicDetail?->twelfth_marksheet;
                                                            $ext = $file ? strtolower(trim(pathinfo($file, PATHINFO_EXTENSION))) : null;
                                                            $filePath = $file ? asset('athlete_assets/12_marksheet/' . $file) : null;

                                                            $isImage = in_array($ext, ['jpg', 'jpeg', 'png', 'webp']);
                                                        @endphp

                                                        @if($file)

                                                            @if($isImage)
                                                                {{-- IMAGE --}}
                                                                <img id="twelfthPreview" src="{{ $filePath }}"
                                                                    class="mb-2 rounded preview-images" width="120" height="120">

                                                            @else
                                                                {{-- DOCUMENT --}}
                                                                <div id="twelfthPreview"
                                                                    class="mb-2 rounded preview-images d-flex flex-column align-items-center justify-content-center text-center"
                                                                    style="width: 120px;
    height: 120px;
    border: 2px solid #004592;
    background: #ffffff;
    margin: 17px 0 0;">

                                                                    <i class="fa fa-file-word"
                                                                        style="font-size:28px; color:#007bff;"></i>

                                                                    <span
                                                                        style="font-size:11px; margin-top:6px; padding:0 5px; word-break:break-word;">
                                                                        {{ basename($file) }}
                                                                    </span>

                                                                </div>
                                                            @endif

                                                        @endif


                                                    </div>


                                                </div>
                                            </div>
                                            <!-- Diploma -->

                                            <div class="main-top-scetion">
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
                                                            <div class=" select-wrapper"> <select name="diploma_board_id"
                                                                    id="boardSelect" class="form-control figma-select">
                                                                    <option value="">Select board</option>

                                                                    @foreach($diplomaBoards as $d)
                                                                                                                                <option value="{{ $d->id }}" {{ ($athlete->
                                                                        academicDetail->diploma_board_id ?? '') == $d->id ? 'selected' :
                                                                        '' }}>
                                                                                                                                    {{ $d->board }}
                                                                                                                                </option>
                                                                    @endforeach

                                                                </select>

                                                                <i class="fa fa-chevron-down select-icon"></i>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-6 mb-3">
                                                        <label>Stream </label>
                                                        <div class="custom-select-wrapper">
                                                            <div class=" select-wrapper"> <select name="diploma_stream_id"
                                                                    id="streamSelect" class="form-control figma-select">

                                                                    <option value="">Select stream</option>


                                                                    @foreach($diplomaStreams as $s)
                                                                                                                                <option value="{{ $s->id }}" {{ ($athlete->
                                                                        academicDetail->diploma_stream_id ?? '') == $s->id ? 'selected'
                                                                        : '' }}>
                                                                                                                                    {{ $s->stream }}
                                                                                                                                </option>
                                                                    @endforeach


                                                                </select>


                                                                <i class="fa fa-chevron-down select-icon"></i>
                                                            </div>
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
                                                            <div class=" select-wrapper"> <select
                                                                    class="form-control figma-select"
                                                                    name="diploma_result_type"
                                                                    onchange="changeResultType(this, 'diploma')">
                                                                    <option value="">Select</option>
                                                                    <option value="percentage" {{ $athlete->
        academicDetail->diploma_result_type == 'percentage' ? 'selected'
        : '' }}>Percentage</option>
                                                                    <option value="cgpa" {{ $athlete->
        academicDetail->diploma_result_type == 'cgpa' ? 'selected' : ''
                                                                                                                                                                                                                                                                                    }}>CGPA</option>
                                                                    <option value="grade" {{ $athlete->
        academicDetail->diploma_result_type == 'grade' ? 'selected' : ''
                                                                                                                                                                                                                                                                                    }}>Grade</option>
                                                                </select>
                                                                <i class="fa fa-chevron-down select-icon"></i>
                                                            </div>
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
                                                            <input type="file" class="preview-input"
                                                                data-preview="diplomaPreview" name="diploma_marksheet"
                                                                accept=".jpg,.jpeg,.png,.webp,.pdf,.doc,.docx" hidden>
                                                            <div class="upload-content">
                                                                <div class="upload-icon">
                                                                    <i class="fa-solid fa-cloud-arrow-up"></i>
                                                                </div>
                                                                <div class="upload-text">
                                                                    <strong>Upload Diploma Certificate</strong><br>
                                                                    <span>Only JPG, JPEG, PNG, WEBP, DOC, DOCX formats are
                                                                        allowed.
                                                                        Maximum
                                                                        image size: 200 × 200 pixels.</span>
                                                                </div>
                                                            </div>
                                                        </label>
                                                        @php
                                                            $file = $athlete->academicDetail?->diploma_marksheet;
                                                            $ext = $file ? strtolower(trim(pathinfo($file, PATHINFO_EXTENSION))) : null;
                                                            $filePath = $file ? asset('athlete_assets/diploma_marksheet/' . $file) : null;

                                                            $isImage = in_array($ext, ['jpg', 'jpeg', 'png', 'webp']);
                                                        @endphp

                                                        @if($file)

                                                            @if($isImage)
                                                                {{-- IMAGE --}}
                                                                <img id="diplomaPreview" src="{{ $filePath }}"
                                                                    class="mb-2 rounded preview-images" width="120" height="120">

                                                            @else
                                                                {{-- DOCUMENT --}}
                                                                <div id="diplomaPreview"
                                                                    class="mb-2 rounded preview-images d-flex flex-column align-items-center justify-content-center text-center"
                                                                    style="width: 120px;
    height: 120px;
    border: 2px solid #004592;
    background: #ffffff;
    margin: 17px 0 0;">

                                                                    <i class="fa fa-file-word"
                                                                        style="font-size:28px; color:#007bff;"></i>

                                                                    <span
                                                                        style="font-size:11px; margin-top:6px; padding:0 5px; word-break:break-word;">
                                                                        {{ basename($file) }}
                                                                    </span>

                                                                </div>
                                                            @endif

                                                        @endif


                                                    </div>


                                                </div>
                                            </div>

                                            <!-- Graduation -->
                                            <div class="main-top-scetion">
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
                                                            <div class=" select-wrapper"> <select name="degree_id"
                                                                    class="form-control figma-select">
                                                                    <option value="">Select</option>
                                                                    @foreach($degrees as $degree)
                                                                                                                                <option value="{{ $degree->id }}" {{ ($athlete->
                                                                        academicDetail->degree_id ?? '') == $degree->id ? 'selected' :
                                                                        '' }}>
                                                                                                                                    {{ $degree->name }}
                                                                                                                                </option>
                                                                    @endforeach
                                                                </select>
                                                                <i class="fa fa-chevron-down select-icon"></i>
                                                            </div>
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
                                                            <div class=" select-wrapper"> <select
                                                                    class="form-control figma-select"
                                                                    name="graduation_result_type"
                                                                    onchange="changeResultType(this, 'graduation')">
                                                                    <option value="">Select</option>
                                                                    <option value="percentage" {{ $athlete->
        academicDetail->graduation_result_type == 'percentage' ?
        'selected' : '' }}>Percentage</option>
                                                                    <option value="cgpa" {{ $athlete->
        academicDetail->graduation_result_type == 'cgpa' ? 'selected' :
        '' }}>CGPA</option>
                                                                    <option value="grade" {{ $athlete->
        academicDetail->graduation_result_type == 'grade' ? 'selected' :
        '' }}>Grade</option>
                                                                </select>
                                                                <i class="fa fa-chevron-down select-icon"></i>
                                                            </div>
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
                                                            <input type="file" class="preview-input"
                                                                data-preview="graduationPreview" name="graduation_marksheet"
                                                                accept=".jpg,.jpeg,.png,.webp,.pdf,.doc,.docx" hidden>
                                                            <div class="upload-content">
                                                                <div class="upload-icon">
                                                                    <i class="fa-solid fa-cloud-arrow-up"></i>
                                                                </div>
                                                                <div class="upload-text">
                                                                    <strong>Upload Graduation Certificate</strong><br>
                                                                    <span>Only JPG, JPEG, PNG, WEBP, DOC, DOCX formats are
                                                                        allowed.
                                                                        Maximum
                                                                        image size: 200 × 200 pixels.</span>
                                                                </div>
                                                            </div>
                                                        </label>
                                                        @php
                                                            $file = $athlete->academicDetail?->graduation_marksheet;
                                                            $ext = $file ? strtolower(trim(pathinfo($file, PATHINFO_EXTENSION))) : null;
                                                            $filePath = $file ? asset('athlete_assets/graduation_marksheet/' . $file) : null;

                                                            $isImage = in_array($ext, ['jpg', 'jpeg', 'png', 'webp']);
                                                        @endphp

                                                        @if($file)

                                                            @if($isImage)
                                                                {{-- IMAGE --}}
                                                                <img id="graduationPreview" src="{{ $filePath }}"
                                                                    class="mb-2 rounded preview-images" width="120" height="120">

                                                            @else
                                                                {{-- DOCUMENT --}}
                                                                <div id="graduationPreview"
                                                                    class="mb-2 rounded preview-images d-flex flex-column align-items-center justify-content-center text-center"
                                                                    style="width: 120px;
    height: 120px;
    border: 2px solid #004592;
    background: #ffffff;
    margin: 17px 0 0;">

                                                                    <i class="fa fa-file-word"
                                                                        style="font-size:28px; color:#007bff;"></i>

                                                                    <span
                                                                        style="font-size:11px; margin-top:6px; padding:0 5px; word-break:break-word;">
                                                                        {{ basename($file) }}
                                                                    </span>

                                                                </div>
                                                            @endif

                                                        @endif

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-between">
                                                <button type="button" onclick="prevStep()" class="btn btn-primary-adds"
                                                    id="prevBtn1"><i class="fa-solid fa-angles-left"></i>
                                                    Prev</button>
                                                <button type="button" onclick="nextStep(this)" class="btn btn-primary-adds"
                                                    id="nextBtn2">Next <i class="fa-solid fa-angles-right"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-new-ads">
                                    <div class="card-body form-step" id="step3">
                                        <div class="figma-form">
                                            <h2 class=" main-heding-top">Sports Matrix</h2>

                                            <!-- Primary Support -->
                                            <div class="main-top-scetion">
                                                <h4 class="figma-heading"><span class="section-icon">
                                                        <i class="fa-solid fa-book-open"></i>
                                                    </span>

                                                    Primary Sport Profile
                                                </h4>

                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label>Primary Sport <span style="color: red">*</span></label>
                                                        <div class="custom-select-wrapper">
                                                            <div class=" select-wrapper"> <select name="primary_sport_id"
                                                                    class="form-control figma-select">
                                                                    <option value="">Select</option>

                                                                    @foreach($sports as $sport)
                                                                                                                                <option value="{{ $sport->id }}" {{ ($athlete->
                                                                        sportDetail->primary_sport_id ?? '') == $sport->id ? 'selected'
                                                                        : '' }}>
                                                                                                                                    {{ $sport->name }}
                                                                                                                                </option>
                                                                    @endforeach

                                                                </select>

                                                                <i class="fa fa-chevron-down select-icon"></i>
                                                            </div>
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
                                                        <input type="text" name="coach_contact" class="form-control"
                                                            maxlength="10" placeholder="Enter coach contact number"
                                                            value="{{ $athlete->sportDetail->coach_contact ?? '' }}">
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <label>Year of Training / Experience <span
                                                                style="color: red">*</span></label>
                                                        <input type="text" name="training_experience" class="form-control"
                                                            placeholder="Enter year of training / experience"
                                                            value="{{ $athlete->sportDetail->training_experience ?? '' }}">
                                                    </div>


                                                </div>
                                            </div>

                                            <!-- Physical Metrics-->
                                            <div class="main-top-scetion">
                                                <h4 class="figma-heading"><span class="section-icon">
                                                        <i class="fa-solid fa-graduation-cap"></i>
                                                    </span>

                                                    Physical Metrics
                                                </h4>

                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label>Height <span style="text-transform: none;">(cm)</span> <span
                                                                style="color: red">*</span></label>
                                                        <input type="text" name="height" class="form-control"
                                                            placeholder="Enter height" maxlength="5"
                                                            value="{{ $athlete->sportDetail->height ?? '' }}">
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label>Weight <span style="text-transform: none;">(kg)</span> <span
                                                                style="color: red">*</span></label>
                                                        <input type="text" name="weight" class="form-control"
                                                            placeholder="Enter weight" maxlength="5"
                                                            value="{{ $athlete->sportDetail->weight ?? '' }}">
                                                    </div>

                                                    <div class="col-md-6 mb-3 ">
                                                        <label>Wingspan <span style="text-transform: none;">(cm)</span>
                                                            <span style="color: red">*</span></label>
                                                        <input type="text" name="wingspan" class="form-control"
                                                            placeholder="Enter wingspan" maxlength="5"
                                                            value="{{ $athlete->sportDetail->wingspan ?? '' }}">
                                                    </div>

                                                    <div class="col-md-6 mb-3 ">
                                                        <label>Chest Measurement <span
                                                                style="text-transform: none;">(cm)</span> <span
                                                                style="color: red">*</span></label>
                                                        <input type="text" name="chest" class="form-control"
                                                            placeholder="Enter chest measurement" maxlength="5"
                                                            value="{{ $athlete->sportDetail->chest ?? '' }}">
                                                    </div>

                                                    <div class="col-md-6 mb-3 ">
                                                        <label>Waist Measurement <span
                                                                style="text-transform: none;">(cm)</span> <span
                                                                style="color: red">*</span></label>
                                                        <input type="text" name="waist" class="form-control"
                                                            placeholder="Enter waist measurement" maxlength="5"
                                                            value="{{ $athlete->sportDetail->waist ?? '' }}">
                                                    </div>

                                                    <div class="col-md-6 mb-3 ">
                                                        <label>Body Fat % <span
                                                                style="text-transform: none;">(optional)</span></label>
                                                        <input type="text" class="form-control" name="body_fat"
                                                            placeholder="Enter body fat" maxlength="5"
                                                            value="{{ $athlete->sportDetail->body_fat ?? '' }}">
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <label>Fitness Level <span style="color: red">*</span></label>
                                                        <div class="custom-select-wrapper">
                                                            <div class=" select-wrapper"> <select name="fitness_level"
                                                                    class="form-control figma-select">
                                                                    <option value="">Select</option>

                                                                    <option value="Beginner" {{ old('fitness_level', $athlete->
        sportDetail->fitness_level ?? '') == 'Beginner' ? 'selected' :
        '' }}>
                                                                        Beginner
                                                                    </option>

                                                                    <option value="Intermediate" {{ old('fitness_level', $athlete->
        sportDetail->fitness_level ?? '') == 'Intermediate' ? 'selected'
        : '' }}>
                                                                        Intermediate
                                                                    </option>

                                                                    <option value="Elite" {{ old('fitness_level', $athlete->
        sportDetail->fitness_level ?? '') == 'Elite' ? 'selected' : ''
                                                                                                                                                                                                                                                                                    }}>
                                                                        Elite
                                                                    </option>
                                                                </select>
                                                                <i class="fa fa-chevron-down select-icon"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- competion and ranking -->
                                            <div class="main-top-scetion">
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
                                                            <div class=" select-wrapper"> <select name="state_age_category"
                                                                    class="form-control figma-select">
                                                                    <option value="">Select</option>
                                                                    <option value="U14" {{ old('state_age_category', $athlete->
        sportDetail->state_age_category ?? '') == 'U14' ? 'selected' :
        '' }}>U14</option>
                                                                    <option value="U16" {{ old('state_age_category', $athlete->
        sportDetail->state_age_category ?? '') == 'U16' ? 'selected' :
        '' }}>U16</option>
                                                                    <option value="U19" {{ old('state_age_category', $athlete->
        sportDetail->state_age_category ?? '') == 'U19' ? 'selected' :
        '' }}>U19</option>
                                                                    <option value="senior" {{ old('state_age_category', $athlete->
        sportDetail->state_age_category ?? '') == 'senior' ? 'selected'
        : '' }}>senior</option>
                                                                </select>
                                                                <i class="fa fa-chevron-down select-icon"></i>
                                                            </div>
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
                                                            <div class=" select-wrapper"> <select
                                                                    name="district_age_category"
                                                                    class="form-control figma-select">
                                                                    <option value="">Select</option>
                                                                    <option value="U14" {{ old('district_age_category', $athlete->
        sportDetail->district_age_category ?? '') == 'U14' ? 'selected'
        : '' }}>U14</option>
                                                                    <option value="U16" {{ old('district_age_category', $athlete->
        sportDetail->district_age_category ?? '') == 'U16' ? 'selected'
        : '' }}>U16</option>
                                                                    <option value="U19" {{ old('district_age_category', $athlete->
        sportDetail->district_age_category ?? '') == 'U19' ? 'selected'
        : '' }}>U19</option>
                                                                    <option value="senior" {{ old('district_age_category', $athlete->
        sportDetail->district_age_category ?? '') == 'senior' ?
        'selected' : '' }}>senior</option>
                                                                </select>
                                                                <i class="fa fa-chevron-down select-icon"></i>
                                                            </div>
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
                                                            <div class=" select-wrapper"> <select
                                                                    name="national_age_category"
                                                                    class="form-control figma-select">
                                                                    <option value="">Select</option>
                                                                    <option value="U14" {{ old('national_age_category', $athlete->
        sportDetail->national_age_category ?? '') == 'U14' ? 'selected'
        : '' }}>U14</option>
                                                                    <option value="U16" {{ old('national_age_category', $athlete->
        sportDetail->national_age_category ?? '') == 'U16' ? 'selected'
        : '' }}>U16</option>
                                                                    <option value="U19" {{ old('national_age_category', $athlete->
        sportDetail->national_age_category ?? '') == 'U19' ? 'selected'
        : '' }}>U19</option>
                                                                    <option value="senior" {{ old('national_age_category', $athlete->
        sportDetail->national_age_category ?? '') == 'senior' ?
        'selected' : '' }}>senior</option>
                                                                </select>
                                                                <i class="fa fa-chevron-down select-icon"></i>
                                                            </div>
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
                                                            <div class=" select-wrapper"> <select
                                                                    name="international_participation"
                                                                    class="form-control figma-select">
                                                                    <option value="Yes" {{ old('international_participation', $athlete->
        sportDetail->international_participation ?? 'No') == 'Yes' ?
        'selected' : '' }}>Yes</option>
                                                                    <option value="No" {{ old('international_participation', $athlete->
        sportDetail->international_participation ?? 'NO') == 'No' ?
        'selected' : '' }}>No</option>
                                                                </select>
                                                                <i class="fa fa-chevron-down select-icon"></i>
                                                            </div>
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
                                                    <div class="col-md-12 mb-3">
                                                        <label>Bronze Medal</label>
                                                        <input type="text" name="bronze_medal" class="form-control"
                                                            placeholder="Enter no. of bronze medal"
                                                            value="{{ $athlete->sportDetail->bronze_medal ?? '' }}">
                                                    </div>
                                                </div>








                                            </div>
                                        </div>

                                        <!-- Injury / Medical Status -->
                                        <div class="main-top-scetion">
                                            <h4 class="figma-heading"><span class="section-icon">
                                                    <i class="fa-solid fa-ranking-star"></i>
                                                </span>

                                                Injury / Medical Status
                                            </h4>

                                            <div class="col-md-12 mb-3">
                                                <label>Previous Injuries <span style="color: red">*</span></label>
                                                <div class="custom-select-wrapper">
                                                    <div class=" select-wrapper"> <select name="previous_injury"
                                                            id="previous_injury" class="form-control figma-select">
                                                            <option value="Yes" {{ old('previous_injury', $athlete->
        sportDetail->previous_injury ?? 'No') == 'Yes' ? 'selected' : '' }}>
                                                                Yes
                                                            </option>
                                                            <option value="No" {{ old('previous_injury', $athlete->
        sportDetail->previous_injury ?? 'No') == 'No' ? 'selected' : '' }}>No
                                                            </option>


                                                        </select>
                                                        <i class="fa fa-chevron-down select-icon"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="injurySection" style="display:none;">
                                                <div class="row">
                                                    <div class="col-md-12 mb-3">
                                                        <label>Injury Details <span style="color: red">*</span></label>
                                                        <textarea id="injury_details" name="injury_details"
                                                            class="form-control"
                                                            placeholder="Describe your injury, treatment, and recovery...">{{ $athlete->sportDetail->injury_details ?? '' }}</textarea>
                                                    </div>

                                                    <div class="col-md-12 mb-3">
                                                        <label>Recovery Status <span style="color: red">*</span></label>
                                                        <input id="recovery_status" type="text" name="recovery_status"
                                                            class="form-control" placeholder="Enter recovery status"
                                                            value="{{ $athlete->sportDetail->recovery_status ?? '' }}">
                                                    </div>

                                                </div>


                                                <div class="col-md-12 mb-4">
                                                    <label class="figma-label">Medical Clearance Upload </label>

                                                    <label class="upload-box">
                                                        <input type="file" class="preview-input"
                                                            data-preview="medicalPreview" name="medical_certificate"
                                                            accept=".jpg,.jpeg,.png,.webp,.pdf,.doc,.docx" hidden>
                                                        <div class="upload-content">
                                                            <div class="upload-icon">
                                                                <i class="fa-solid fa-cloud-arrow-up"></i>
                                                            </div>
                                                            <div class="upload-text">
                                                                <strong>Upload Medical Clearance</strong><br>
                                                                <span>Only JPG, JPEG, PNG, WEBP, DOC, DOCX formats are
                                                                    allowed. Maximum
                                                                    image
                                                                    size: 200 × 200 pixels.</span>
                                                            </div>
                                                        </div>
                                                    </label>
                                                    @php
                                                        $file = $athlete->sportDetail?->medical_certificate;
                                                        $ext = $file ? strtolower(trim(pathinfo($file, PATHINFO_EXTENSION))) : null;
                                                        $filePath = $file ? asset('athlete_assets/medical_certificate/' . $file) : null;

                                                        $isImage = in_array($ext, ['jpg', 'jpeg', 'png', 'webp']);
                                                    @endphp

                                                    @if($file)

                                                        @if($isImage)
                                                            {{-- IMAGE --}}
                                                            <img id="medicalPreview" src="{{ $filePath }}"
                                                                class="mb-2 rounded preview-images" width="120" height="120">

                                                        @else
                                                            {{-- DOCUMENT --}}
                                                            <div id="medicalPreview"
                                                                class="mb-2 rounded preview-images d-flex flex-column align-items-center justify-content-center text-center"
                                                                style="width: 120px;
    height: 120px;
    border: 2px solid #004592;
    background: #ffffff;
    margin: 17px 0 0;">

                                                                <i class="fa fa-file-word"
                                                                    style="font-size:28px; color:#007bff;"></i>

                                                                <span
                                                                    style="font-size:11px; margin-top:6px; padding:0 5px; word-break:break-word;">
                                                                    {{ basename($file) }}
                                                                </span>

                                                            </div>
                                                        @endif

                                                    @endif

                                                </div>
                                            </div>



                                        </div>

                                        <!-- Verification -->
                                        <div class="main-top-scetion">
                                            <h4 class="figma-heading"><span class="section-icon">
                                                    <i class="fa-solid fa-ranking-star"></i>
                                                </span>

                                                Verification
                                            </h4>


                                            <div class="row">
                                                <div class="col-md-6 mb-4">
                                                    <label class="figma-label">Sport ID / Association ID Upload</label>

                                                    <label class="upload-box">
                                                        <input type="file" class="preview-input" name="sport_card"
                                                            data-preview="sportPreview"
                                                            accept=".jpg,.jpeg,.png,.webp,.pdf,.doc,.docx" hidden>
                                                        <div class="upload-content">
                                                            <div class="upload-icon">
                                                                <i class="fa-solid fa-cloud-arrow-up"></i>
                                                            </div>
                                                            <div class="upload-text">
                                                                <strong>Upload Sport ID / Association ID</strong><br>
                                                                <span>Only JPG, JPEG, PNG, WEBP, DOC, DOCX formats are
                                                                    allowed. Maximum
                                                                    image
                                                                    size: 200 × 200 pixels.</span>
                                                            </div>
                                                        </div>
                                                    </label>
                                                    @php
                                                        $file = $athlete->sportDetail?->sport_card;
                                                        $ext = $file ? strtolower(trim(pathinfo($file, PATHINFO_EXTENSION))) : null;
                                                        $filePath = $file ? asset('athlete_assets/sport_card/' . $file) : null;

                                                        $isImage = in_array($ext, ['jpg', 'jpeg', 'png', 'webp']);
                                                    @endphp

                                                    @if($file)

                                                        @if($isImage)
                                                            {{-- IMAGE --}}
                                                            <img id="sportPreview" src="{{ $filePath }}"
                                                                class="mb-2 rounded preview-images" width="120" height="120">

                                                        @else
                                                            {{-- DOCUMENT --}}
                                                            <div id="sportPreview"
                                                                class="mb-2 rounded preview-images d-flex flex-column align-items-center justify-content-center text-center"
                                                                style="width: 120px;
    height: 120px;
    border: 2px solid #004592;
    background: #ffffff;
    margin: 17px 0 0;">

                                                                <i class="fa fa-file-word"
                                                                    style="font-size:28px; color:#007bff;"></i>

                                                                <span
                                                                    style="font-size:11px; margin-top:6px; padding:0 5px; word-break:break-word;">
                                                                    {{ basename($file) }}
                                                                </span>

                                                            </div>
                                                        @endif

                                                    @endif


                                                </div>

                                                <div class="col-md-6 mb-4">
                                                    <label class="figma-label">Coach Certification Upload</label>

                                                    <label class="upload-box">
                                                        <input type="file" class="preview-input" name="coach_certificate"
                                                            data-preview="coachPreview"
                                                            accept=".jpg,.jpeg,.png,.webp,.pdf,.doc,.docx" hidden>
                                                        <div class="upload-content">
                                                            <div class="upload-icon">
                                                                <i class="fa-solid fa-cloud-arrow-up"></i>
                                                            </div>
                                                            <div class="upload-text">
                                                                <strong>Upload Coach Certification</strong><br>
                                                                <span>Only JPG, JPEG, PNG, WEBP, DOC, DOCX formats are
                                                                    allowed. Maximum
                                                                    image
                                                                    size: 200 × 200 pixels.</span>
                                                            </div>
                                                        </div>
                                                    </label>
                                                    @php
                                                        $file = $athlete->sportDetail?->coach_certificate;
                                                        $ext = $file ? strtolower(trim(pathinfo($file, PATHINFO_EXTENSION))) : null;
                                                        $filePath = $file ? asset('athlete_assets/coach_certificate/' . $file) : null;

                                                        $isImage = in_array($ext, ['jpg', 'jpeg', 'png', 'webp']);
                                                    @endphp

                                                    @if($file)

                                                        @if($isImage)
                                                            {{-- IMAGE --}}
                                                            <img id="coachPreview" src="{{ $filePath }}"
                                                                class="mb-2 rounded preview-images" width="120" height="120">

                                                        @else
                                                            {{-- DOCUMENT --}}
                                                            <div id="coachPreview"
                                                                class="mb-2 rounded preview-images d-flex flex-column align-items-center justify-content-center text-center"
                                                                style="width: 120px;
    height: 120px;
    border: 2px solid #004592;
    background: #ffffff;
    margin: 17px 0 0;">

                                                                <i class="fa fa-file-word"
                                                                    style="font-size:28px; color:#007bff;"></i>

                                                                <span
                                                                    style="font-size:11px; margin-top:6px; padding:0 5px; word-break:break-word;">
                                                                    {{ basename($file) }}
                                                                </span>

                                                            </div>
                                                        @endif

                                                    @endif

                                                </div>

                                            </div>


                                        </div>

                                        <div class="d-flex justify-content-between">
                                            <button type="button" onclick="prevStep()" class="btn btn-primary-adds"
                                                id="btnprev3"><i class="fa-solid fa-angles-left"></i>
                                                Prev</button>
                                            <button type="button" onclick="nextStep(this)" class="btn btn-primary-adds"
                                                id="btnnext3">Next
                                                <i class="fa-solid fa-angles-right"></i></button>
                                        </div>

                                    </div>
                                </div>


                                <div class="card-new-ads">
                                    <div class="card-body form-step" id="step4">
                                        <div class="figma-form">
                                            <h2 class="main-heding-top">Documents & References</h2>

                                            <!-- Primary Support -->
                                            <div class="main-top-scetion">
                                                <h4 class="figma-heading"><span class="section-icon">
                                                        <i class="fa-solid fa-file"></i>
                                                    </span>

                                                    Mandatory Documents
                                                </h4>

                                                <div class="row">
                                                    <div class="col-md-6 mb-4">
                                                        <label class="figma-label">Profile Photo (passort-size) <span
                                                                style="color: red">*</span></label>

                                                        <label class="upload-box">
                                                            <input type="file" name="profile_photo"
                                                                data-preview="profilePreview" class="preview-input"
                                                                accept="image/*" hidden>
                                                            <div class="upload-content">
                                                                <div class="upload-icon">
                                                                    <i class="fa-solid fa-cloud-arrow-up"></i>
                                                                </div>
                                                                <div class="upload-text">
                                                                    <strong>Upload Profile Photo</strong><br>
                                                                    <span>Only JPG, JPEG, PNG, WEBP formats are allowed.
                                                                        Maximum
                                                                        image size: 200 × 200 pixels.</span>
                                                                </div>
                                                            </div>
                                                        </label><img id="profilePreview" src="{{ $athlete->document?->profile_photo
        ? asset('athlete_assets/athlete_documents/' . $athlete->document?->profile_photo)
        : 'https://via.placeholder.com/120' }}" class="mb-2 rounded preview-images {{ $athlete->document?->profile_photo ? '' : 'd-none' }}"
                                                            width="120" height="120">

                                                    </div>

                                                    <div class="col-md-6 mb-4">
                                                        <label class="figma-label">
                                                            Goverment ID Proof (Aadhaar / Passport / PAN / etc.)
                                                            <span style="color: red">*</span>
                                                        </label>

                                                        <label class="upload-box">
                                                            <input type="file" class="preview-input"
                                                                data-preview="govPreview" name="government_proof"
                                                                accept=".jpg,.jpeg,.png,.webp,.pdf,.doc,.docx" hidden>

                                                            <div class="upload-content">
                                                                <div class="upload-icon">
                                                                    <i class="fa-solid fa-cloud-arrow-up"></i>
                                                                </div>
                                                                <div class="upload-text">
                                                                    <strong>Upload Goverment ID Proof</strong><br>
                                                                    <span>Only JPG, JPEG, PNG, WEBP, DOC, DOCX formats are
                                                                        allowed.
                                                                        Maximum
                                                                        image size: 200 × 200 pixels.</span>
                                                                </div>
                                                            </div>
                                                        </label>

                                                        @php
                                                            $file = $athlete->document?->government_proof;
                                                            $ext = $file ? strtolower(trim(pathinfo($file, PATHINFO_EXTENSION))) : null;
                                                            $filePath = $file ? asset('athlete_assets/athlete_documents/' . $file) : null;

                                                            $isImage = in_array($ext, ['jpg', 'jpeg', 'png', 'webp']);
                                                        @endphp

                                                        @if($file)

                                                            @if($isImage)
                                                                {{-- IMAGE --}}
                                                                <img id="govPreview" src="{{ $filePath }}"
                                                                    class="mb-2 rounded preview-images" width="120" height="120">

                                                            @else
                                                                {{-- DOCUMENT --}}
                                                                <div id="govPreview"
                                                                    class="mb-2 rounded preview-images d-flex flex-column align-items-center justify-content-center text-center"
                                                                    style="width: 120px;
    height: 120px;
    border: 2px solid #004592;
    background: #ffffff;
    margin: 17px 0 0;">

                                                                    <i class="fa fa-file-word"
                                                                        style="font-size:28px; color:#007bff;"></i>

                                                                    <span
                                                                        style="font-size:11px; margin-top:6px; padding:0 5px; word-break:break-word;">
                                                                        {{ basename($file) }}
                                                                    </span>

                                                                </div>
                                                            @endif

                                                        @endif
                                                    </div>

                                                    <div class="col-md-6 mb-4">
                                                        <label class="figma-label">Date of Birth Proof (Birth Certificate /
                                                            SSC
                                                            Certificate) <span style="color: red">*</span></label>

                                                        <label class="upload-box">
                                                            <input type="file" class="preview-input"
                                                                data-preview="dobPreview" name="dob_proof"
                                                                accept=".jpg,.jpeg,.png,.webp,.pdf,.doc,.docx" hidden>
                                                            <div class="upload-content">
                                                                <div class="upload-icon">
                                                                    <i class="fa-solid fa-cloud-arrow-up"></i>
                                                                </div>
                                                                <div class="upload-text">
                                                                    <strong>Upload Date of Birth Certificate</strong><br>
                                                                    <span>Only JPG, JPEG, PNG, WEBP, DOC, DOCX formats are
                                                                        allowed.
                                                                        Maximum
                                                                        image size: 200 × 200 pixels.</span>
                                                                </div>
                                                            </div>
                                                        </label>

                                                        @php
                                                            $file = $athlete->document?->dob_proof;
                                                            $ext = $file ? strtolower(trim(pathinfo($file, PATHINFO_EXTENSION))) : null;
                                                            $filePath = $file ? asset('athlete_assets/athlete_documents/' . $file) : null;

                                                            $isImage = in_array($ext, ['jpg', 'jpeg', 'png', 'webp']);
                                                        @endphp

                                                        @if($file)

                                                            @if($isImage)
                                                                {{-- IMAGE --}}
                                                                <img id="dobPreview" src="{{ $filePath }}"
                                                                    class="mb-2 rounded preview-images" width="120" height="120">

                                                            @else
                                                                {{-- DOCUMENT --}}
                                                                <div id="dobPreview"
                                                                    class="mb-2 rounded preview-images d-flex flex-column align-items-center justify-content-center text-center"
                                                                    style="width: 120px;
    height: 120px;
    border: 2px solid #004592;
    background: #ffffff;
    margin: 17px 0 0;">

                                                                    <i class="fa fa-file-word"
                                                                        style="font-size:28px; color:#007bff;"></i>

                                                                    <span
                                                                        style="font-size:11px; margin-top:6px; padding:0 5px; word-break:break-word;">
                                                                        {{ basename($file) }}
                                                                    </span>

                                                                </div>
                                                            @endif

                                                        @endif

                                                    </div>
                                                    <div class="col-md-6 mb-4">
                                                        <label class="figma-label">Address Proof (Aadhar / Utility Bill /
                                                            etc.) <span style="color: red">*</span></label>

                                                        <label class="upload-box">

                                                            <input type="file" class="preview-input"
                                                                data-preview="addressPreview" name="address_proof"
                                                                accept=".jpg,.jpeg,.png,.webp,.pdf,.doc,.docx" hidden>
                                                            <div class="upload-content">
                                                                <div class="upload-icon">
                                                                    <i class="fa-solid fa-cloud-arrow-up"></i>
                                                                </div>
                                                                <div class="upload-text">
                                                                    <strong>Upload Address Proof </strong><br>
                                                                    <span>Only JPG, JPEG, PNG, WEBP, DOC, DOCX formats are
                                                                        allowed.
                                                                        Maximum
                                                                        image size: 200 × 200 pixels.</span>
                                                                </div>
                                                            </div>
                                                        </label>
                                                        @php
                                                            $file = $athlete->document?->address_proof;
                                                            $ext = $file ? strtolower(trim(pathinfo($file, PATHINFO_EXTENSION))) : null;
                                                            $filePath = $file ? asset('athlete_assets/athlete_documents/' . $file) : null;

                                                            $isImage = in_array($ext, ['jpg', 'jpeg', 'png', 'webp']);
                                                        @endphp

                                                        @if($file)

                                                            @if($isImage)
                                                                {{-- IMAGE --}}
                                                                <img id="addressPreview" src="{{ $filePath }}"
                                                                    class="mb-2 rounded preview-images" width="120" height="120">

                                                            @else
                                                                {{-- DOCUMENT --}}
                                                                <div id="addressPreview"
                                                                    class="mb-2 rounded preview-images d-flex flex-column align-items-center justify-content-center text-center"
                                                                    style="width: 120px;
    height: 120px;
    border: 2px solid #004592;
    background: #ffffff;
    margin: 17px 0 0;">

                                                                    <i class="fa fa-file-word"
                                                                        style="font-size:28px; color:#007bff;"></i>

                                                                    <span
                                                                        style="font-size:11px; margin-top:6px; padding:0 5px; word-break:break-word;">
                                                                        {{ basename($file) }}
                                                                    </span>

                                                                </div>
                                                            @endif

                                                        @endif


                                                    </div>

                                                </div>
                                            </div>

                                            <!--sports related documents -->
                                            <div class="main-top-scetion">
                                                <h4 class="figma-heading"><span class="section-icon">
                                                        <i class="fa-solid fa-file"></i>
                                                    </span>

                                                    Sports-Related Documents
                                                </h4>

                                                <div class="row">
                                                    <div class="col-md-6 mb-4">
                                                        <label class="figma-label">Latest Performance Certificate / Sport
                                                            Achievement Certificates</label>

                                                        <label class="upload-box">
                                                            <input type="file" class="preview-input"
                                                                data-preview="sportAchivePreview" name="sport_achievement"
                                                                accept=".jpg,.jpeg,.png,.webp,.pdf,.doc,.docx" hidden>
                                                            <div class="upload-content">
                                                                <div class="upload-icon">
                                                                    <i class="fa-solid fa-cloud-arrow-up"></i>
                                                                </div>
                                                                <div class="upload-text">
                                                                    <strong>Upload Latest Performance </strong><br>
                                                                    <span>Only JPG, JPEG, PNG, WEBP, DOC, DOCX formats are
                                                                        allowed.
                                                                        Maximum
                                                                        image size: 200 × 200 pixels.</span>
                                                                </div>
                                                            </div>
                                                        </label>

                                                        @php
                                                            $file = $athlete->document?->sport_achievement;
                                                            $ext = $file ? strtolower(trim(pathinfo($file, PATHINFO_EXTENSION))) : null;
                                                            $filePath = $file ? asset('athlete_assets/athlete_documents/' . $file) : null;

                                                            $isImage = in_array($ext, ['jpg', 'jpeg', 'png', 'webp']);
                                                        @endphp

                                                        @if($file)

                                                            @if($isImage)
                                                                {{-- IMAGE --}}
                                                                <img id="sportAchivePreview" src="{{ $filePath }}"
                                                                    class="mb-2 rounded preview-images" width="120" height="120">

                                                            @else
                                                                {{-- DOCUMENT --}}
                                                                <div id="sportAchivePreview"
                                                                    class="mb-2 rounded preview-images d-flex flex-column align-items-center justify-content-center text-center"
                                                                    style="width: 120px;
    height: 120px;
    border: 2px solid #004592;
    background: #ffffff;
    margin: 17px 0 0;">

                                                                    <i class="fa fa-file-word"
                                                                        style="font-size:28px; color:#007bff;"></i>

                                                                    <span
                                                                        style="font-size:11px; margin-top:6px; padding:0 5px; word-break:break-word;">
                                                                        {{ basename($file) }}
                                                                    </span>

                                                                </div>
                                                            @endif

                                                        @endif



                                                    </div>

                                                    <div class="col-md-6 mb-4">
                                                        <label class="figma-label">Coach Recommendation Letter</label>

                                                        <label class="upload-box">
                                                            <input type="file" class="preview-input"
                                                                data-preview="coachRecomendationPreview"
                                                                name="coach_recommendation"
                                                                accept=".jpg,.jpeg,.png,.webp,.pdf,.doc,.docx" hidden>
                                                            <div class="upload-content">
                                                                <div class="upload-icon">
                                                                    <i class="fa-solid fa-cloud-arrow-up"></i>
                                                                </div>
                                                                <div class="upload-text">
                                                                    <strong>Upload Coach Recommendation Letter </strong><br>
                                                                    <span>Only JPG, JPEG, PNG, WEBP, DOC, DOCX formats are
                                                                        allowed.
                                                                        Maximum
                                                                        image size: 200 × 200 pixels.</span>
                                                                </div>
                                                            </div>
                                                        </label>
                                                        @php
                                                            $file = $athlete->document?->coach_recommendation;
                                                            $ext = $file ? strtolower(trim(pathinfo($file, PATHINFO_EXTENSION))) : null;
                                                            $filePath = $file ? asset('athlete_assets/athlete_documents/' . $file) : null;

                                                            $isImage = in_array($ext, ['jpg', 'jpeg', 'png', 'webp']);
                                                        @endphp

                                                        @if($file)

                                                            @if($isImage)
                                                                {{-- IMAGE --}}
                                                                <img id="coachRecomendationPreview" src="{{ $filePath }}"
                                                                    class="mb-2 rounded preview-images" width="120" height="120">

                                                            @else
                                                                {{-- DOCUMENT --}}
                                                                <div id="coachRecomendationPreview"
                                                                    class="mb-2 rounded preview-images d-flex flex-column align-items-center justify-content-center text-center"
                                                                    style="width: 120px;
    height: 120px;
    border: 2px solid #004592;
    background: #ffffff;
    margin: 17px 0 0;">

                                                                    <i class="fa fa-file-word"
                                                                        style="font-size:28px; color:#007bff;"></i>

                                                                    <span
                                                                        style="font-size:11px; margin-top:6px; padding:0 5px; word-break:break-word;">
                                                                        {{ basename($file) }}
                                                                    </span>

                                                                </div>
                                                            @endif

                                                        @endif


                                                    </div>

                                                    <div class="col-md-6 mb-4">
                                                        <label class="figma-label">Medical Fitness Certificate <span
                                                                style="color: red">*</span></label>

                                                        <label class="upload-box">
                                                            <input type="file" class="preview-input"
                                                                data-preview="medicalFitnessPreview" name="medical_fitness"
                                                                accept=".jpg,.jpeg,.png,.webp,.pdf,.doc,.docx" hidden>
                                                            <div class="upload-content">
                                                                <div class="upload-icon">
                                                                    <i class="fa-solid fa-cloud-arrow-up"></i>
                                                                </div>
                                                                <div class="upload-text">
                                                                    <strong>Upload Medical Fitness</strong><br>
                                                                    <span>Only JPG, JPEG, PNG, WEBP, DOC, DOCX formats are
                                                                        allowed.
                                                                        Maximum
                                                                        image size: 200 × 200 pixels.</span>
                                                                </div>
                                                            </div>
                                                        </label>
                                                        @php
                                                            $file = $athlete->document?->medical_fitness;
                                                            $ext = $file ? strtolower(trim(pathinfo($file, PATHINFO_EXTENSION))) : null;
                                                            $filePath = $file ? asset('athlete_assets/athlete_documents/' . $file) : null;

                                                            $isImage = in_array($ext, ['jpg', 'jpeg', 'png', 'webp']);
                                                        @endphp

                                                        @if($file)

                                                            @if($isImage)
                                                                {{-- IMAGE --}}
                                                                <img id="medicalFitnessPreview" src="{{ $filePath }}"
                                                                    class="mb-2 rounded preview-images" width="120" height="120">

                                                            @else
                                                                {{-- DOCUMENT --}}
                                                                <div id="medicalFitnessPreview"
                                                                    class="mb-2 rounded preview-images d-flex flex-column align-items-center justify-content-center text-center"
                                                                    style="width: 120px;
    height: 120px;
    border: 2px solid #004592;
    background: #ffffff;
    margin: 17px 0 0;">

                                                                    <i class="fa fa-file-word"
                                                                        style="font-size:28px; color:#007bff;"></i>

                                                                    <span
                                                                        style="font-size:11px; margin-top:6px; padding:0 5px; word-break:break-word;">
                                                                        {{ basename($file) }}
                                                                    </span>

                                                                </div>
                                                            @endif

                                                        @endif


                                                    </div>

                                                    <div class="col-md-6 mb-4">
                                                        <label class="figma-label">Player Contract (if part of club /
                                                            academy)</label>

                                                        <label class="upload-box">
                                                            <input type="file" class="preview-input"
                                                                data-preview="playerContractPreview" name="player_contract"
                                                                accept=".jpg,.jpeg,.png,.webp,.pdf,.doc,.docx" hidden>
                                                            <div class="upload-content">
                                                                <div class="upload-icon">
                                                                    <i class="fa-solid fa-cloud-arrow-up"></i>
                                                                </div>
                                                                <div class="upload-text">
                                                                    <strong>Upload Player Contract</strong><br>
                                                                    <span>Only JPG, JPEG, PNG, WEBP, DOC, DOCX formats are
                                                                        allowed.
                                                                        Maximum
                                                                        image size: 200 × 200 pixels.</span>
                                                                </div>
                                                            </div>
                                                        </label>
                                                        @php
                                                            $file = $athlete->document?->player_contract;
                                                            $ext = $file ? strtolower(trim(pathinfo($file, PATHINFO_EXTENSION))) : null;
                                                            $filePath = $file ? asset('athlete_assets/athlete_documents/' . $file) : null;

                                                            $isImage = in_array($ext, ['jpg', 'jpeg', 'png', 'webp']);
                                                        @endphp

                                                        @if($file)

                                                            @if($isImage)
                                                                {{-- IMAGE --}}
                                                                <img id="playerContractPreview" src="{{ $filePath }}"
                                                                    class="mb-2 rounded preview-images" width="120" height="120">

                                                            @else
                                                                {{-- DOCUMENT --}}
                                                                <div id="playerContractPreview"
                                                                    class="mb-2 rounded preview-images d-flex flex-column align-items-center justify-content-center text-center"
                                                                    style="width: 120px;
    height: 120px;
    border: 2px solid #004592;
    background: #ffffff;
    margin: 17px 0 0;">

                                                                    <i class="fa fa-file-word"
                                                                        style="font-size:28px; color:#007bff;"></i>

                                                                    <span
                                                                        style="font-size:11px; margin-top:6px; padding:0 5px; word-break:break-word;">
                                                                        {{ basename($file) }}
                                                                    </span>

                                                                </div>
                                                            @endif

                                                        @endif


                                                    </div>


                                                </div>
                                            </div>


                                            {{-- Reference --}}
                                            <div class="main-top-scetion">
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
                                                            <div class=" select-wrapper"> <select name="reference_role1"
                                                                    class="form-control figma-select">
                                                                    <option value="">Select</option>
                                                                    <option value="Coach" {{ old('reference_role1', $athlete->
        document->reference_role1 ?? '') == 'Coach' ? 'selected' : '' }}>Coach
                                                                    </option>
                                                                    <option value="Trainer" {{ old('reference_role1', $athlete->
        document->reference_role1 ?? '') == 'Trainer' ? 'selected' : ''
                                                                                                                                                                                                                                                                                }}>Trainer</option>
                                                                    <option value="Teacher" {{ old('reference_role1', $athlete->
        document->reference_role1 ?? '') == 'Teacher' ? 'selected' : ''
                                                                                                                                                                                                                                                                                }}>Teacher</option>
                                                                    <option value="Sport Official" {{ old('reference_role1', $athlete->
        document->reference_role1 ?? '') == 'Sport Official' ? 'selected' :
        '' }}>Sport Official
                                                                    </option>
                                                                </select>
                                                                <i class="fa fa-chevron-down select-icon"></i>
                                                            </div>
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
                                                        <input type="text" name="reference_relationship1"
                                                            class="form-control"
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


                                                {{-- Reference 2 --}} <div class="main-top-scetion">
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
                                                                <div class=" select-wrapper"><select name="reference_role2"
                                                                        class="form-control figma-select">
                                                                        <option value="">Select</option>
                                                                        <option value="Coach" {{ old('reference_role2', $athlete->
        document->reference_role2 ?? '') == 'Coach' ? 'selected' : ''
                                                                                                                                                                                                                                                                                    }}>Coach</option>
                                                                        <option value="Trainer" {{ old('reference_role2', $athlete->
        document->reference_role2 ?? '') == 'Trainer' ? 'selected' : ''
                                                                                                                                                                                                                                                                                    }}>Trainer
                                                                        </option>
                                                                        <option value="Teacher" {{ old('reference_role2', $athlete->
        document->reference_role2 ?? '') == 'Teacher' ? 'selected' : ''
                                                                                                                                                                                                                                                                                    }}>Teacher
                                                                        </option>
                                                                        <option value="Sport Official" {{ old('reference_role2', $athlete->
        document->reference_role2 ?? '') == 'Sport official' ?
        'selected' : '' }}>Sport Official
                                                                        </option>
                                                                    </select>
                                                                    <i class="fa fa-chevron-down select-icon"></i>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Organization / Academy / Instituation </label>
                                                            <input type="text" name="reference_academy2"
                                                                class="form-control"
                                                                placeholder="Enter organization / academy / instituation"
                                                                value="{{ $athlete->document->reference_academy2 ?? '' }}">
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Relationship with Athlete </label>
                                                            <input type="text" name="reference_relationship2"
                                                                class="form-control"
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
                                                    <div class="d-flex justify-content-between">
                                                        <button type="button" onclick="prevStep()"
                                                            class="btn btn-primary-adds" id="btnprev4"><i
                                                                class="fa-solid fa-angles-left"></i>
                                                            Prev</button>
                                                        <button type="button" onclick="finalSubmit(this)"
                                                            class="btn btn-primary-adds" id="btnnext4">Update Profile <i
                                                                class="fa-solid fa-angles-right"></i></button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>


                    </div>
                </div>

            </div>
        </div>
    </div>



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
            document.querySelectorAll('.field-error')
                .forEach(e => e.remove());
        }


        function showErrors(errors) {

            let firstTarget = null;

            Object.entries(errors).forEach(([key, msg], index) => {

                const input = document.querySelector(`[name="${key}"]`);
                if (!input) return;

                const wrapper = input.closest('.col-md-6, .col-md-12, .mb-3, .mb-4')
                    || input.parentElement;

                const oldError = wrapper.querySelector('.field-error');
                if (oldError) oldError.remove();

                const errorDiv = document.createElement('div');
                errorDiv.className = 'field-error mt-1 text-danger';
                errorDiv.innerText = msg[0];

                wrapper.appendChild(errorDiv);

                if (index === 0) {

                    // ✅ Special handling for file input
                    if (input.type === "file") {

                        const uploadBox = wrapper.querySelector('.upload-box');
                        firstTarget = uploadBox;

                    } else {

                        firstTarget = input;
                    }
                }
            });

            if (firstTarget) {

                firstTarget.scrollIntoView({
                    behavior: "smooth",
                    block: "center"
                });

                if (firstTarget.focus) {
                    firstTarget.focus();
                }
            }
        }





        /* ================= IMAGE PREVIEW ================= */

        document.querySelectorAll('.preview-input').forEach(input => {

            input.addEventListener('change', function () {

                const file = this.files[0];
                if (!file) return;

                const previewId = this.getAttribute("data-preview");
                let preview = previewId ? document.getElementById(previewId) : null;

                if (!preview) return;

                // ✅ ALLOWED TYPES (NO PDF)
                const allowedTypes = [
                    "image/jpeg",
                    "image/png",
                    "image/webp",
                    "application/msword",
                    "application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                ];

                if (!allowedTypes.includes(file.type)) {
                    alert("Only image and document (DOC/DOCX) files are allowed.");
                    this.value = "";
                    return;
                }

                // 🟢 IMAGE CASE
                if (file.type.startsWith('image/')) {

                    const reader = new FileReader();

                    reader.onload = (e) => {

                        const img = new Image();
                        img.src = e.target.result;

                        img.onload = () => {

                            if (img.width > 200 || img.height > 200) {
                                alert("Image size must be maximum 200×200.");
                                input.value = "";
                                return;
                            }

                            
                            if (preview.tagName !== "IMG") {
                                preview.outerHTML = `
                                                <img id="${previewId}" 
                                                     class="mb-2 rounded preview-images"
                                                     width="120" height="120">
                                            `;
                                preview = document.getElementById(previewId);
                            }

                            preview.src = e.target.result;
                            preview.classList.remove('d-none');
                        };
                    };

                    reader.readAsDataURL(file);
                }

                // 🔵 DOCUMENT CASE (DOC/DOCX only)
                else {

                    preview.outerHTML = `
                <div id="${previewId}" 
                     class="mb-2 rounded preview-images d-flex flex-column align-items-center justify-content-center"
                     style="width: 120px;
    height: 120px;
    border: 2px solid #004592;
    background: #ffffff;
    margin: 17px 0 0;">

                    <i class="fa fa-file-word" style="font-size:28px; color:#007bff;"></i>

                    <span style="font-size:11px; text-align:center; margin-top:6px; padding:0 5px; word-break:break-word;">
                        ${file.name}
                    </span>

                </div>
            `;
                }

            });

        });



        /* ================= STEPPER ================= */

        document.addEventListener('DOMContentLoaded', function () {

            showStep(1);
            // initOtpSystem();

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
                input.placeholder = "Enter percentage (1-100)";
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
                input.placeholder = "Enter grade (A/B/C)";
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
            const injuryDetails = document.getElementById('injury_details');
            const recoveryStatus = document.getElementById('recovery_status');
            const medicalPreview = document.getElementById('medicalPreview');
            const medicalInput = document.querySelector('[name="medical_certificate"]');

            function toggleInjurySection() {

                if (!injurySelect || !injurySection) return;

                if (injurySelect.value === 'Yes') {

                    injurySection.style.display = 'block';

                } else {

                    injurySection.style.display = 'none';

                    // clear fields
                    if (injuryDetails) injuryDetails.value = '';
                    if (recoveryStatus) recoveryStatus.value = '';

                    // clear file
                    if (medicalInput) medicalInput.value = '';

                    // hide preview
                    if (medicalPreview) medicalPreview.classList.add('d-none');
                }
            }

            // dropdown change
            injurySelect.addEventListener('change', toggleInjurySection);

            // page load state
            toggleInjurySection();

        });
    </script>


    <script>
        function focusActiveStep() {
            const el = document.querySelector(
                '.form-step.active input, .form-step.active select, .form-step.active textarea'
            );
            if (el) el.focus();
        }

        document.addEventListener('DOMContentLoaded', focusActiveStep);
    </script>

@endsection