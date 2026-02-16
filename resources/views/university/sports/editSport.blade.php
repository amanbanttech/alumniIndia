@extends('layout.university.app')

@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">

            <div class="row">
                <div class="col-xxl">
                    <div class="card mb-4">

                        {{-- Header --}}
                        <div class="card-header">
                            <h5 class="mb-0">Edit Sport</h5>
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

                            <form action="{{ route('university.sport.update', $sport->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                {{-- Sport Name --}}
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">
                                        Sport Name <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-10">
                                        <select name="name" class="form-control">
                                            <option value="">Select Sport</option>

                                            @foreach($generalsports as $s)
                                                <option value="{{ $s->name }}" {{ old('name', $sport->name) == $s->name ? 'selected' : '' }}>
                                                    {{ $s->name }}
                                                </option>
                                            @endforeach

                                        </select>
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Sport Category --}}
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">
                                        Select Sport Category <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-10">
                                        <select name="category" class="form-control">
                                            <option value="">Select Category</option>
                                            <option value="indoor" {{ $sport->category == 'indoor' ? 'selected' : '' }}>
                                                Indoor Game
                                            </option>
                                            <option value="outdoor" {{ $sport->category == 'outdoor' ? 'selected' : '' }}>
                                                Outdoor Game
                                            </option>
                                        </select>
                                        @error('category')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Submit -->
                                <div class="row justify-content-end">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">
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