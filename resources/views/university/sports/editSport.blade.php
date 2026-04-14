@extends('layout.university.app')

@section('content')
    <div class="content-wrapper">
        <div class="commmon-crads">
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
                            <i class="fas fa-futbol"></i>
                            <span>Edit Sports</span>
                        </div>

                        {{-- Body --}}
                        <div class="card-body">
                            <div id="formMessage" class="alert d-none"></div>



                            <form action="{{ route('university.sport.update', $sport->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                {{-- Sport Name --}}
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label class="col-sm-12 col-form-label">
                                            Sport Name <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-sm-12 select-wrapper">
                                            <select name="sport_id" class="form-control">
                                                <option value="">Select Sport</option>

                                                @foreach($generalsports as $s)
                                                    <option value="{{ $s->id }}" {{ old('sport_id', $sport->sport_id) == $s->id ? 'selected' : '' }}>
                                                        {{ $s->name }}
                                                    </option>


                                                @endforeach

                                            </select><i class="fa fa-chevron-down select-icon"></i>
                                           
                                        </div>
                                         @error('sport_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                    </div>
                                </div>

                                {{-- Sport Category --}}
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label class="col-sm-12 col-form-label">
                                            Select Sport Category <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-sm-12 select-wrapper">
                                            <select name="category" class="form-control">
                                                <option value="">Select Category</option>
                                                <option value="indoor" {{ $sport->category == 'indoor' ? 'selected' : '' }}>
                                                    Indoor Game
                                                </option>
                                                <option value="outdoor" {{ $sport->category == 'outdoor' ? 'selected' : '' }}>
                                                    Outdoor Game
                                                </option>
                                            </select> <i class="fa fa-chevron-down select-icon"></i>
                                            
                                        </div>
                                        @error('category')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                    </div>
                                </div>

                                <!-- Submit -->
                                <div class="row justify-content-end">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn  btn-add-univerity">
                                            Update Sport
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