@extends('layout.university.app')

@section('content')
<style>
.commmon-crads input, .commmon-crads select, .commmon-crads textarea {
    min-height:34px;
}
</style>
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
                            <i class="fa fa-graduation-cap"></i>
                            <span>University Courses</span>
                        </div>
                        {{-- Body --}}
                        <div class="card-body">

                            <form action="{{ route('university.course.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                {{-- Sport Dropdown --}}
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label class="col-sm-12 col-form-label">
                                            Course Name <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-sm-12 select-wrapper">
                                            <select name="course_id[]" class="form-control select2" multiple>

                                                @foreach($courses as $course)

                                                    <option value="{{ $course->id }}" {{ in_array($course->id, $selectedCourses ?? []) ? 'selected' : '' }}>
                                                        {{ $course->name }}
                                                    </option>

                                                @endforeach

                                            </select>

                                            @error('course_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                                <!-- Submit -->
                                <div class="row justify-content-end">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-add-univerity">
                                            Update Courses
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

@push('scripts')
    <script>
        $(document).ready(function () {
            $('.select2').select2({
                placeholder: "Select Courses",
                allowClear: true,
                width: '100%'
                
            });
        });
    </script>
@endpush