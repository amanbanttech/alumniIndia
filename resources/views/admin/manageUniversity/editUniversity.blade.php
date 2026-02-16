@extends('layout.admin.app')

@section('content')
    <div class="content-wrapper">
               <div class="commmon-crads">

            <div class="row">
                <div class="col-xxl">
                    <div class="card mb-4">

                       
       <div class="simple-dashboard-heading">
     <i class="fa fa-university"></i>
    <span>Edit University</span>
</div>
          
                        {{-- Body --}}
                        <div class="card-body">
                            <div id="formMessage" class="alert d-none"></div>

                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                            <form action="{{ route('admin.university.update', $university->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                {{-- Mobile --}}
                                <div class="row mb-3">
                                    <label class="col-sm-12 col-form-label">Mobile <span class="text-danger">*</span></label>
                                    <div class="col-sm-12">
                                        <input type="text" name="mobile" class="form-control"
                                            value="{{ $university->user->phoneNumber }}"
                                            placeholder="Enter mobile number" maxlength="10"
                                            oninput="this.value=this.value.replace(/[^0-9]/g,'')">
                                        @error('mobile')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- University Name --}}
                                <div class="row mb-3">
                                    <label class="col-sm-12 col-form-label">
                                        University Name <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-12">
                                        <input type="text" name="name" class="form-control"
                                            value="{{ $university->user->name }}"
                                            placeholder="Enter university name">
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- About University --}}
                                <div class="row mb-3">
                                    <label class="col-sm-12 col-form-label">About University <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-12">
                                        <textarea name="about" class="form-control" placeholder="Write about university"
                                            rows="4">{{ $university->about ?? '' }}</textarea>
                                        @error('about')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>


                                {{-- Email --}}
                                <div class="row mb-3">
                                   <div class="col-md-6">
                                     <label class="col-sm-12 col-form-label">
                                        Email <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-12">
                                        <input type="email" name="email" class="form-control"
                                            value="{{ $university->user->email }}"
                                            placeholder="Enter email address">
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                   </div>
                                   <div class="col-md-6">
                                      <label class="col-sm-12 col-form-label">Address <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-12">
                                        <input type="text" name="address" class="form-control"
                                            value="{{ $university->address }}"
                                            placeholder="Enter address">
                                        @error('address')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                   </div>
                                </div>

                                {{-- Address --}}
                                <div class="row mb-3">
                                  
                                </div>

                                {{-- City --}}
                                <div class="row mb-3">
                                   <div class="col-md-6">
                                     <label class="col-sm-12 col-form-label">City <span class="text-danger">*</span></label>
                                    <div class="col-sm-12">
                                        <input type="text" name="city" class="form-control" value="{{ $university->city }}" placeholder="Enter city">
                                        @error('city')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                   </div>

                                   <div class="col-md-6">
                                      <label class="col-sm-12 col-form-label">
                                        State <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-12 select-wrapper">
                                        <select name="state_id" class="form-select">
                                            <option value="">Select State</option>

                                            @foreach ($states as $state)
                                                <option value="{{ $state->id }}" {{ $currentStateId == $state->id ? 'selected' : '' }}>
                                                    {{ $state->name }}
                                                </option>

                                            @endforeach

                                        </select>
                                    <i class="fa fa-chevron-down select-icon"></i>
                                        @error('state_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                   </div>
                                </div>

                              

                                {{-- Emblem Logo --}}
                                <div class="row mb-3">
                                   <div class="col-md-6">
                                     <label class="col-sm-12 col-form-label">Emblem Logo</label>
                                    <div class="col-sm-12">
                                 


                                        <input type="file" name="emblem_logo" class="form-control"
                                            onchange="previewImage(this,'emblemPreview')">
                                            <small class="text-allows">
                                            Allowed formats: WEBP. Max size: 200px X 200px.
                                        </small>       <img id="emblemPreview" src="{{ $university->user->image
        ? asset('university_assets/images/' . $university->user->image)
        : 'https://via.placeholder.com/120' }}" class="d-block mb-2 rounded previews"
                                            width="120" height="120">
                                        @error('emblem_logo')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                   </div>


                                     <div class="col-md-6">
                                    <label class="col-sm-12 col-form-label">Sports Logo</label>
                                    <div class="col-sm-12">
                                       


                                        <input type="file" name="sports_logo" class="form-control"
                                            onchange="previewImage(this,'sportsPreview')">
                                            <small class="text-allows">
                                            Allowed formats: WEBP. Max size: 200px X 200px.
                                        </small> <img id="sportsPreview" src="{{ $university->sports_logo
        ? asset('university_assets/sports_logo/' . $university->sports_logo)
        : 'https://via.placeholder.com/120' }}" class="d-block mb-2 rounded previews"
                                            width="120" height="120">
                                        @error('sports_logo')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                </div>

                                {{-- Sports Logo --}}
                               

                                {{-- Submit --}}
                                <div class="row justify-content-end">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-add-univerity">
                                            Update University
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

    <script>
        function previewImage(input, previewId) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = e => document.getElementById(previewId).src = e.target.result;
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection