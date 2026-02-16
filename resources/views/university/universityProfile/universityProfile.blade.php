@extends('layout.university.app')

@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">

            <div class="row">
                <div class="col-xxl">
                    <div class="card mb-4">

                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Edit University Profile </h5>
                        </div>

                        <div class="card-body">
                            @if (Session::has('success'))
                                <div class="alert alert-success">{{ Session::get('success') }}</div>
                            @endif

                            @if (Session::has('error'))
                                <div class="alert alert-danger">{{ Session::get('error') }}</div>
                            @endif

                            <form action="{{ route('university.profile.update',$university->id) }}" method="POST"
                                enctype="multipart/form-data" novalidate>
                                @csrf

                                <!-- Name -->
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">
                                        University Name <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text" name="name" class="form-control" placeholder="Enter Your Name"
                                          value="{{ Auth::user()->name }}" required>                                    </div>
                                    @error('name')
                                        <div class="text-danger offset-sm-2 col-sm-10">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- About University -->
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">
                                        About University <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-10">
                                        <textarea name="about" class="form-control" rows="4"
                                            placeholder="Write about university" >{{ $university->about ?? '' }}</textarea>
                                    </div>
                                    @error('about')
                                        <div class="text-danger offset-sm-2 col-sm-10">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Mobile -->
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">
                                        Mobile <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text" name="phoneNumber" class="form-control"
                                            placeholder="Enter Your Mobile Number"
                                          value="{{ Auth::user()->phoneNumber }}" maxlength="10"
                                          oninput="this.value=this.value.replace(/[^0-9]/g,'')">
                                        @error('phoneNumber')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- Email -->
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">
                                        Email <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="email" name="email" class="form-control" placeholder="Enter Your Email"
                                          value="{{ Auth::user()->email }}" required>                                  
                                    </div>
                                    @error('email')
                                        <div class="text-danger offset-sm-2 col-sm-10">{{ $message }}</div>
                                    @enderror
                                </div>
                                

                                <!-- Address -->
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">
                                        Address <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text" name="address" class="form-control"
                                            value="{{ $university->address ?? '' }}"
                                            placeholder="Enter address">
                                    </div>
                                    @error('address')
                                        <div class="text-danger offset-sm-2 col-sm-10">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- City -->
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">
                                        City <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text" name="city" class="form-control"
                                            value="{{ $university->city ?? '' }}" placeholder="Enter city">
                                    </div>
                                    @error('city')
                                        <div class="text-danger offset-sm-2 col-sm-10">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- State -->

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">
                                        State <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-10">
                                        <select name="state_id" class="form-select">
                                            <option value="">Select State</option>

                                            @foreach ($states as $state)
                                                <option value="{{ $state->id }}" {{ $currentStateId == $state->id ? 'selected' : '' }}>
                                                    {{ $state->name }}
                                                </option>
                                            @endforeach

                                        </select>

                                        @error('state_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>


                                {{-- Emblem Logo --}}
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">EMBLEM Logo</label>
                                    <div class="col-sm-10">
                                        <img id="emblemPreview" src="{{ $university->user->image
                                           ? asset('university_assets/images/' . $university->user->image)
                                           : 'https://via.placeholder.com/120' }}" class="d-block mb-2 rounded" width="120" height="120">


                                        <input type="file" name="emblem_logo" class="form-control"
                                            onchange="previewImage(this,'emblemPreview')">
                                            <small class="text-muted">
                                           Please Upload Webp file type only. Max size 200×200.
                                        </small>
                                            @error('emblem_logo')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>



                                <!-- Submit -->
                                <div class="row justify-content-end">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">
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
        function previewImage(input, previewId) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = e => {
                    document.getElementById(previewId).src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection