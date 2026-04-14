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
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <span>Assign Mentor</span>
                        </div>
                        {{-- Body --}}
                        <div class="card-body">




                            <form action="{{ route('university.scholarship.storeAssignedMentor') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="athlete_id" value="{{ $athlete->id }}">
                                {{-- Sport Dropdown --}}
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label class="col-sm-12 col-form-label">
                                            Select Mentor <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-sm-12 select-wrapper">
                                            <select name="mentor_id" class="form-control">
                                                <option value="">-- Select Mentor --</option>

                                                @foreach($mentors as $mentor)
                                                    <option value="{{ $mentor->id }}" @if(isset($assignedMentor) && $assignedMentor->mentor_id == $mentor->id) selected @endif>
                                                        {{ $mentor->user->name }}
                                                    </option>
                                                @endforeach
                                            </select><i class="fa fa-chevron-down select-icon"></i>


                                        </div>
                                        @error('sport_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>


                                <!-- Submit -->
                                <div class="row justify-content-end">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-add-univerity">
                                            Assign Mentor
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