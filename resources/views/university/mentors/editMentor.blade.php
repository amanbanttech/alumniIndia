@extends('layout.university.app')

@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">

            <div class="row">
                <div class="col-xxl">
                    <div class="card mb-4">

                        {{-- Header --}}
                        <div class="card-header">
                            <h5 class="mb-0">Edit Mentor</h5>
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

                            <form action="{{ route('university.mentor.update', $mentor->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                {{-- University Name --}}
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">
                                        Mentor Name <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text" name="name" class="form-control"
                                            value="{{ $mentor->user->name }}" placeholder="Enter your mentor name">
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Email --}}
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">
                                        Email <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="email" name="email" class="form-control"
                                            value="{{ $mentor->user->email }}" placeholder="Enter your email">
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Mobile --}}
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Mobile <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" name="mobile" class="form-control"
                                            value="{{ $mentor->user->phoneNumber }}"
                                            placeholder="Enter your mobile number" maxlength="10"
                                            oninput="this.value=this.value.replace(/[^0-9]/g,'')">
                                        @error('mobile')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Sport Dropdown --}}
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">
                                        Sports Category <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-10">
                                        <select name="sport_id" class="form-control">
                                            <option value="">-- Select Sport Category --</option>
                                            @foreach ($sports as $sport)
                                                <option value="{{ $sport->id }}" {{ $mentor->sport_id == $sport->id ? 'selected' : '' }}>
                                                    {{ ucfirst($sport->name) }}
                                                </option>
                                            @endforeach
                                        </select>


                                        @error('sport_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Submit --}}
                                <div class="row justify-content-end">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">
                                            Update Mentor
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