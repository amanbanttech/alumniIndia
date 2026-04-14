@extends('layout.athlete.app')

@section('content')

    <div class="">
        <div class="commmon-crads">


            <div class="row">
                <div class="col-xxl">
                    <div class="card mb-4 ">


                        <div class="simple-dashboard-heading">
                            <i class="fas fa-video"></i>
                            <span>Add Video</span>
                        </div>

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        @if ($errors->has('membership'))
                            <div class="alert alert-danger">
                                {{ $errors->first('membership') }}
                            </div>
                        @endif

                        <div class="card-new-ads bg-all-cards">
                            <form action="{{ route('athlete.add-video.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card-body ">

                                    <div class="row mb-3">
                                        <label class="col-sm-12 col-form-label">Title <span
                                                style="color: red">*</span></label>
                                        <div class="col-sm-12">
                                            <input type="text" name="title" class="form-control"
                                                placeholder="Enter video title" value="">

                                            @error('title')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- State --}}
                                    <div class="row mb-3">
                                        <label class="col-sm-12 col-form-label">About Video <span
                                                style="color: red">*</span></label>
                                        <div class="col-sm-12">
                                            <textarea name="about" class="form-control"
                                                placeholder="Describe the video content..."></textarea>

                                            @error('about')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- State --}}
                                    <div class="row mb-3">
                                        <label class="col-sm-12 col-form-label">Upload Video <span
                                                style="color: red">*</span></label>
                                        <div class="col-sm-12">
                                            <input type="file" name="video" class="form-control"
                                                accept="video/mp4,video/webm">
                                            <span class="text-muted">Allowed formats: MP4, WEBM. Maximum size: 5MB</span>
                                        </div>
                                        @error('video')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-sm-12 col-form-label">Status <span
                                                style="color: red">*</span></label>
                                        <div class="col-sm-12">
                                            <div class=" select-wrapper">
                                                <select name="visibility" class="form-control">
                                                    <option value="active" selected>Active</option>
                                                    <option value="inactive">Inactive</option>
                                                </select>
                                                <i class="fa fa-chevron-down select-icon"></i>
                                            </div>

                                            @error('visibility')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>





                                    <button type="submit" class="btn btn-primary-adds">Add Video</button>

                                </div>


                            </form>

                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.querySelector('input[name="video"]').addEventListener('change', function () {
            const file = this.files[0];

            if (file) {
                const allowedTypes = ['video/mp4', 'video/webm'];
                const maxSize = 5 * 1024 * 1024; // 5MB

                //  agar format galat hai OR size zyada hai
                if (!allowedTypes.includes(file.type) || file.size > maxSize) {
                    alert("Only MP4 & WEBM formats are allowed with maximum file size is 5MB.");
                    this.value = "";
                }
            }
        });
    </script>

@endsection