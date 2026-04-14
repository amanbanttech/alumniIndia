@extends('layout.athlete.app')

@section('content')

    <div class="">
        <div class="commmon-crads">
            

            <div class="row">
                <div class="col-xxl">
                    <div class="card mb-4 ">


                        <div class="simple-dashboard-heading">
                            <i class="fas fa-video"></i>
                            <span>Edit Video</span>
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
                            <form action="{{ route('athlete.edit-video.update', $video->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body ">

                                    <div class="row mb-3">
                                        <label class="col-sm-12 col-form-label">Title <span
                                                style="color: red">*</span></label>
                                        <div class="col-sm-12">
                                            <input type="text" name="title" class="form-control"
                                                placeholder="Enter video title" value="{{ old('title', $video->title) }}">

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
                                                placeholder="Describe the video content...">{{ old('about', $video->about) }}</textarea>

                                            @error('about')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                     {{-- Current Video Preview --}}
                                @if($video->video)
                                    <div class="row mb-3">
                                        <label class="col-sm-12 col-form-label">
                                            Video
                                        </label>
                                        <div class="col-sm-12">
                                            <video id="videoPreview" width="300" controls>
                                                 <source src="{{ config('services.bunny.base_url') }}/{{ $video->video }}" type="video/{{ pathinfo($video->video, PATHINFO_EXTENSION) }}">
                                                Your browser does not support the video tag.
                                            </video>
                                        </div>
                                    </div>
                                @endif
                                    <div class="row mb-3">
                                        <label class="col-sm-12 col-form-label">Upload Video <span
                                                style="color: red">*</span></label>
                                        <div class="col-sm-12">
                                            <input id="videoInput" type="file" name="video" class="form-control" accept="video/mp4,video/webm">
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
                                                <option value="active" 
                                                    {{ $video->visibility == 'active' ? 'selected' : '' }}>
                                                    Active
                                                </option>
                                                <option value="inactive" 
                                                    {{ $video->visibility == 'inactive' ? 'selected' : '' }}>
                                                    Inactive
                                                </option>
                                            </select>
                                                <i class="fa fa-chevron-down select-icon"></i>
                                            </div>

                                            @error('visibility')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                   



                                    <button type="submit" class="btn btn-primary-adds">Update Video</button>

                                </div>


                            </form>

                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
document.getElementById('videoInput').addEventListener('change', function () {

    const file = this.files[0];

    if (file) {
        const allowedTypes = ['video/mp4', 'video/webm'];
        const maxSize = 5 * 1024 * 1024; // 5MB

        //  Validation
        if (!allowedTypes.includes(file.type) || file.size > maxSize) {
            alert("Only MP4 & WEBM formats are allowed with maximum file size is 5MB.");
            this.value = "";
            return;
        }

        // ✅ Preview ONLY if valid
        const url = URL.createObjectURL(file);
        let preview = document.getElementById('videoPreview');

        preview.src = url;
        preview.load();
    }
});
</script>
@endsection