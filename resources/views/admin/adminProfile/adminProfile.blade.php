@extends('layout.admin.app')

@section('content')
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
    <span>Edit Profile</span>
</div>
                        <div class="card-body">
                           

                            <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data"
                                novalidate>
                                @csrf

                                <!-- Email -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                         <label class="col-sm-12 col-form-label">Name <span class="text-danger">*</span></label>
                                    <div class="col-sm-12">
                                        <input type="text" name="name" class="form-control" placeholder="Enter your name" value="{{ Auth::user()->name }}"
                                            required>
                                    </div>
                                    @error('name')
                                        <div class="text-danger  col-sm-12">{{ $message }}</div>
                                    @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="col-sm-12 col-form-label">Email <span class="text-danger">*</span></label>
                                    <div class="col-sm-12">
                                        <input type="email" name="email"
                                            class="form-control"
                                            placeholder="Enter your email"
                                            value="{{ Auth::user()->email }}" required>
                                    </div>
                                    @error('email')
                                        <div class="text-danger  col-sm-12">{{ $message }}</div>
                                    @enderror
                                    </div>
                                </div>

                                <!-- Image -->
                                <div class="row mb-3">
                                   

                                    <div class="col-sm-12">
                                        
                                      <label class="col-sm-12 col-form-label">
                                        Image 
                                        <span style="font-size:14px">(200 × 200)</span>
                                    </label>
                                        <input type="file" name="image" class="form-control">
                                        <small class="text-allows">
                                            Allowed formats: JPG, JPEG, PNG, WEBP. max size: 200px X 200px.
                                        </small><img id="imgPreview" src="{{ asset('admin_assets/images/' . Auth::user()->image) }}"
                                            class="d-block rounded mb-3 previews" width="150" height="150">
                                    </div>

                                    @error('image')
                                        <div class="text-danger  col-sm-12">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Submit -->
                                <div class="row justify-content-end">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-add-univerity">
                                            Update Profile
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

    {{-- Image Preview --}}
    <script>
        const input = document.querySelector('input[name="image"]');
        const preview = document.getElementById('imgPreview');

        input.addEventListener('change', function () {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = e => preview.src = e.target.result;
                reader.readAsDataURL(this.files[0]);
            }
        });
    </script>
@endsection