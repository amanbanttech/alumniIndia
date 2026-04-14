@extends('layout.admin.app')

@section('content')

    {{-- Summernote CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">

    <div class="content-wrapper">
        <div class="commmon-crads">

            @if (Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif

            @if (Session::has('error'))
                <div class="alert alert-danger">{{ Session::get('error') }}</div>
            @endif

            <div class="row">
                <div class="col-xxl">
                    <div class="card mb-4">

                        <div class="simple-dashboard-heading">
                            <i class="fa fa-user"></i>
                            <span>Edit Privacy Policy</span>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('admin.privacy-policy.update') }}" method="POST">
                                @csrf

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label class="col-form-label">
                                            Privacy Policy <span class="text-danger">*</span>
                                        </label>

                                        <textarea name="text" id="summernote" class="form-control " cols="15"
                                            rows="15">{{$privacyPolicy->text}}</textarea>


                                        @error('text')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Submit -->
                                <div class="row">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-add-univerity">
                                            Update
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    

    {{-- Init Summernote --}}
    <script>
        $(document).ready(function () {
            $('#summernote').summernote();
        });
    </script>

@endsection