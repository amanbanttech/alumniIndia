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
                           <i class="fa fa-ticket-alt"></i>
                            <span>Add Seat</span>
                        </div>

                        {{-- Body --}}
                        <div class="card-body">




                            <form action="{{ route('university.scholarship.seat') }}" method="POST" novalidate>
                                @csrf

                                {{-- Sport Name --}}
                                <input type="hidden" name="scholarship_id" value="{{ $scholarship->id }}">

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label class="col-sm-12 col-form-label">
                                            Sport Name <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-sm-12 select-wrapper">
                                            <select name="sport_id" class="form-control">
                                                <option value="">Select Sport Name</option>

                                                @foreach($sports as $sport)
                                                    @if($sport->sport)
                                                        <option value="{{ $sport->id }}">
                                                            {{ $sport->sport->name }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <i class="fa fa-chevron-down select-icon"></i>
                                            
                                        </div>
                                        @error('sport_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                    </div>
                                </div>

                                {{-- Seat alloted --}}
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label class="col-sm-12 col-form-label">
                                            Seat Alloted <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-sm-12 select-wrapper">
                                            <select name="seat_alloted" class="form-control">
                                                <option value="">Select Seat</option>
                                                @for($i = 1; $i <= 50; $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor

                                            </select>
                                            <i class="fa fa-chevron-down select-icon"></i>
                                            @error('seat_alloted')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                                {{-- Course Attached --}}

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label class="col-sm-12 col-form-label">
                                            Course Attached <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-sm-12 select-wrapper">
                                            <select name="course_id" class="form-control" required>

                                                <option value="">Select Course</option>

                                                @foreach($courses as $course)
                                                    <option value="{{ $course->id }}">
                                                        {{ $course->name }}
                                                    </option>
                                                @endforeach

                                            </select>
                                            <i class="fa fa-chevron-down select-icon"></i>
                                            
                                        </div>
                                        @error('course_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                    </div>
                                </div>

                                {{-- Scholarship amount --}}
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label class="col-sm-12 col-form-label">
                                            Scholarship Amount <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-sm-12">
                                            <input type="text" name="scholarship_amount" class="form-control"
                                                value="{{ old('scholarship_amount') }}"
                                                placeholder="Enter scholarship amount">
                                            @error('scholarship_amount')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                                <!-- Submit -->
                                <div class="row justify-content-end">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-add-univerity">
                                            Add Seat
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




@endsection