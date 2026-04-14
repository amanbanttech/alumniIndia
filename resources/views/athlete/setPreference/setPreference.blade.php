@extends('layout.athlete.app')

@section('content')

    <div class="">
        <div class="commmon-crads">

            <div class="row">
                <div class="col-xxl">
                    <div class="card mb-4 ">


                        <div class="simple-dashboard-heading">
                            <i class="fa fa-university" aria-hidden="true"></i>
                            <span>Set Universities Preferences</span>
                        </div>

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif


                        <div class="card-new-ads bg-all-cards">
                            <form action="{{ route('athlete.set-university-preference.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card-body ">

                                    <div class="row mb-3">
                                        <label class="col-sm-12 col-form-label">Select First University <span
                                                style="color: red">*</span></label>
                                        <div class="col-sm-12">
                                            <div class=" select-wrapper">
                                                <select name="first_university" id="first" class="form-control">

                                                    <option value="">Select university</option>

                                                    @foreach($universities as $uni)
                                                        <option value="{{ $uni->id }}" {{ $preference && $preference->firstPreference == $uni->id ? 'selected' : '' }}>
                                                            {{ $uni->user->name }}
                                                        </option>
                                                    @endforeach

                                                </select>
                                                <i class="fa fa-chevron-down select-icon"></i>
                                            </div>
                                            <div id="error-first" class="text-danger"></div>

                                            @error('first_university')
                                                <div class="text-danger" id="laravel-error-first">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- State --}}
                                    <div class="row mb-3">
                                        <label class="col-sm-12 col-form-label">Select Second University <span
                                                style="color: red">*</span></label>
                                        <div class="col-sm-12">
                                            <div class=" select-wrapper">
                                                <select name="second_university" id="second" class="form-control">

                                                    <option value="">Select university</option>

                                                    @foreach($universities as $uni)
                                                        <option value="{{ $uni->id }}" {{ $preference && $preference->secondPreference == $uni->id ? 'selected' : '' }}>
                                                            {{ $uni->user->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <i class="fa fa-chevron-down select-icon"></i>
                                            </div>
                                            <div id="error-second" class="text-danger"></div>

                                            @error('second_university')
                                                <div class="text-danger" id="laravel-error-second">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- State --}}
                                    <div class="row mb-3">
                                        <label class="col-sm-12 col-form-label">Select Third University <span
                                                style="color: red">*</span></label>
                                        <div class="col-sm-12">
                                            <div class=" select-wrapper">
                                                <select name="third_university" id="third" class="form-control">

                                                    <option value="">Select university</option>

                                                    @foreach($universities as $uni)
                                                        <option value="{{ $uni->id }}" {{ $preference && $preference->thirdPreference == $uni->id ? 'selected' : '' }}>
                                                            {{ $uni->user->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <i class="fa fa-chevron-down select-icon"></i>
                                            </div>
                                            <div id="error-third" class="text-danger"></div>

                                            @error('third_university')
                                                <div class="text-danger" id="laravel-error-third">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary-adds">Save Preferences</button>


                                </div>


                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>

        const selects = ['first', 'second', 'third'];

        selects.forEach(id => {
            document.getElementById(id).addEventListener('change', function () {
                checkUnique(id);
            });
        });

        function checkUnique(changed) {

            let first = document.getElementById('first').value;
            let second = document.getElementById('second').value;
            let third = document.getElementById('third').value;

            let btn = document.querySelector('button[type="submit"]');

            // clear errors
            document.getElementById('error-first').innerText = '';
            document.getElementById('error-second').innerText = '';
            document.getElementById('error-third').innerText = '';

            let hasError = false;

            // ----- PURANA LOGIC (unchanged) -----

            if (changed === 'first') {
                if (first && first === second) {
                    document.getElementById('error-first').innerText =
                        'The same university cannot be selected more than once.';
                    hasError = true;
                }
                if (first && first === third) {
                    document.getElementById('error-first').innerText =
                        'The same university cannot be selected more than once.';
                    hasError = true;
                }
            }

            if (changed === 'second') {
                if (second && second === first) {
                    document.getElementById('error-second').innerText =
                        'The same university cannot be selected more than once.';
                    hasError = true;
                }
                if (second && second === third) {
                    document.getElementById('error-second').innerText =
                        'This university is already selected below.';
                    hasError = true;
                }
            }

            if (changed === 'third') {
                if (third && third === first) {
                    document.getElementById('error-third').innerText =
                        'The same university cannot be selected more than once.';
                    hasError = true;
                }
                if (third && third === second) {
                    document.getElementById('error-third').innerText =
                        'The same university cannot be selected more than once.';
                    hasError = true;
                }
            }

            // ----- NEW LOGIC ADD -----
            // ensure second & third both show errors if duplicate

            if (first && second && first === second) {
                document.getElementById('error-second').innerText =
                    'The same university cannot be selected more than once.';
                hasError = true;
            }

            // if (first && third && first === third) {
            //     document.getElementById('error-third').innerText =
            //         'This university is already selected above.';
            //     hasError = true;
            // }

            if (second && third && second === third) {
                document.getElementById('error-third').innerText =
                    'The same university cannot be selected more than once.';
                hasError = true;
            }

            btn.disabled = hasError;
        }

    </script>
@endsection