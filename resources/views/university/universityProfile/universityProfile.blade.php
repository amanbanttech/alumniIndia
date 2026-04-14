@extends('layout.university.app')

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
                         

                            <form action="{{ route('university.profile.update',$university->id) }}" method="POST"
                                enctype="multipart/form-data" novalidate>
                                @csrf

                                <!-- Name -->
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label class="col-sm-12 col-form-label">
                                        University Name <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-12">
                                        <input type="text" name="name" class="form-control" placeholder="Enter university name"
                                          value="{{ Auth::user()->name }}" required>                                    </div>
                                    @error('name')
                                        <div class="text-danger col-sm-12">{{ $message }}</div>
                                    @enderror
                                    </div>
                                </div>

                                <!-- About University -->
                                <div class="row mb-3">
                                   <div class="col-md-12">
                                     <label class="col-sm-12 col-form-label">
                                        About University <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-12">
                                        <textarea name="about" class="form-control" rows="4"
                                            placeholder="Write about university" >{{ $university->about ?? '' }}</textarea>
                                    </div>
                                    @error('about')
                                        <div class="text-danger col-sm-12">{{ $message }}</div>
                                    @enderror
                                   </div>
                                </div>

                                <!-- Mobile -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="col-sm-12 col-form-label">
                                        Mobile <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-12">
                                        <input type="text" name="phoneNumber" class="form-control"
                                            placeholder="Enter your mobile number"
                                          value="{{ Auth::user()->phoneNumber }}" maxlength="10"
                                          oninput="this.value=this.value.replace(/[^0-9]/g,'')" readonly>
                                        @error('phoneNumber')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                          <label class="col-sm-12 col-form-label">
                                        Email <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-12">
                                        <input type="text" name="email" class="form-control" placeholder="Enter your email"
                                          value="{{ Auth::user()->email }}" required>                                  
                                    </div>
                                    @error('email')
                                        <div class="text-danger offset-sm-2 col-sm-12">{{ $message }}</div>
                                    @enderror
                                    </div>
                                </div>
                                

                                <!-- Address -->
                                <div class="row mb-3">
                                  <div class="col-md-6">
                                      <label class="col-sm-12 col-form-label">
                                        Address <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-12">
                                        <input type="text" name="address" class="form-control"
                                            value="{{ $university->address ?? '' }}"
                                            placeholder="Enter address">
                                    </div>
                                    @error('address')
                                        <div class="text-danger offset-sm-2 col-sm-12">{{ $message }}</div>
                                    @enderror
                                  </div>
                                  <div class="col-md-6">
                                     <label class="col-sm-12 col-form-label">
                                        City <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-12">
                                        <input type="text" name="city" class="form-control"
                                            value="{{ $university->city ?? '' }}" placeholder="Enter city">
                                    </div>
                                    @error('city')
                                        <div class="text-danger offset-sm-2 col-sm-12">{{ $message }}</div>
                                    @enderror
                                  </div>
                                </div>

                             

                                <div class="row mb-3">
                                    <label class="col-sm-12 col-form-label">
                                        State <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-12 select-wrapper">
                                        <select name="state_id" class="form-select">
                                            <option value="">Select State</option>

                                            @foreach ($states as $state)
                                                <option value="{{ $state->id }}"
    {{ old('state_id', $currentStateId) == $state->id ? 'selected' : '' }}>
    {{ $state->name }}
</option>
                                            @endforeach

                                        </select>
                                     <i class="fa fa-chevron-down select-icon"></i>
                                        
                                    </div>
                                    @error('state_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                </div>


                                {{-- Emblem Logo --}}
                             <div class="row mb-3">
                                   <div class="col-md-6">
                                     <label class="col-sm-12 col-form-label">Emblem Logo</label>
                                    <div class="col-sm-12">
                                        <div>
                                            <input type="file" name="emblem_logo" class="form-control" accept="image/webp"
                                            onchange="previewImage(this,'emblemPreview')">
                                                 <small class="text-allows">
                                           Only WEBP format is allowed. Maximum image size: 200 X 200 pixels.
                                        </small>
                                        </div>
                                        <img id="emblemPreview" src="{{ $university->user->image
                                           ? asset('university_assets/images/' . $university->user->image)
                                           : '' }}" class="mb-2 rounded previews {{ $university->user->image ? '' : 'd-none' }}" width="120" height="120">

                                            @error('emblem_logo')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                   </div>


                                              <div class="col-md-6">
                                        <label class="col-sm-12 col-form-label">Sports Logo</label>
                                        <div class="col-sm-12">
                                            <div>
                                                <input type="file" name="sports_logo" class="form-control" accept="image/webp"
                                                onchange="previewImage(this,'sportsPreview')">
                                            <small class="text-allows">
                                                Only WEBP format is allowed. Maximum image size: 200 X 200 pixels.
                                            </small></div> <img id="sportsPreview" src="{{ $university->sports_logo
        ? asset('university_assets/sports_logo/' . $university->sports_logo)
        : 'https://via.placeholder.com/120' }}" class="mb-2 rounded previews {{ $university->sports_logo ? '' : 'd-none' }}" width="120" height="120">
                                            @error('sports_logo')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                </div>



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
function previewImage(input, previewId) {

    const file = input.files[0];
    const preview = document.getElementById(previewId);

    // Agar file hi nahi hai
    if (!file) {
        preview.src = "";
        preview.classList.add("d-none");
        return;
    }

    // ❗ Only WEBP allowed
    if (file.type !== "image/webp") {

        alert("Please upload the logo in WEBP format only.");

        // Sirf isi input ko reset karo
        input.value = "";

        // Sirf isi preview ko hide karo
        // preview.src = "";
        // preview.classList.add("d-none");

        return;
    }

    const reader = new FileReader();

    reader.onload = function (e) {

        const img = new Image();

        img.onload = function () {

            // Max size check
            if (img.width > 200 || img.height > 200) {

                alert("Image size must be maximum 200px × 200px.");

                input.value = "";

                // preview.src = "";
                // preview.classList.add("d-none");

                return;
            }

            // ✅ Show only this preview
            preview.src = e.target.result;
            preview.classList.remove("d-none");
        };

        img.src = e.target.result;
    };

    reader.readAsDataURL(file);
}
</script>
@endsection