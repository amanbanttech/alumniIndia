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
                            <i class="fa fa-eye"></i>
                            <span>Update Password</span>
                        </div>
                        <div class="card-body">
                            
                            <form action="{{ route('admin.password.update') }}" method="POST" novalidate>
                                @csrf

                                <!-- Current Password -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="col-sm-12 col-form-label">
                                            Current Password <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-sm-12 position-relative">
                                            <input type="password" name="old_password" class="form-control"
                                                placeholder="Enter current password" required>
                                            <i class="fa fa-eye toggle-password"></i>
                                        </div>
                                        @error('old_password')
                                            <div class="text-danger  col-sm-12">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="col-sm-12 col-form-label">
                                            New Password <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-sm-12 position-relative">
                                            <input type="password" name="password" class="form-control"
                                                placeholder="Enter new password" required>
                                            <i class="fa fa-eye toggle-password"></i>
                                        </div>
                                        @error('password')
                                            <div class="text-danger  col-sm-12">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>


                                <!-- Confirm Password -->
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label class="col-sm-12 col-form-label">
                                            Confirm Password <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-sm-12 position-relative">
                                            <input type="password" name="password_confirmation" class="form-control"
                                                placeholder="Enter confirm password" required>
                                            <i class="fa fa-eye toggle-password"></i>
                                        </div>
                                        @error('password_confirmation')
                                            <div class="text-danger  col-sm-12">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Submit -->
                                <div class="row justify-content-end">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-add-univerity">
                                            Update Password
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
        document.querySelectorAll('.toggle-password').forEach(function (icon) {
            icon.addEventListener('click', function () {

                let input = this.previousElementSibling;

                if (input.type === "password") {
                    input.type = "text";
                    this.classList.remove('fa-eye');
                    this.classList.add('fa-eye-slash');
                } else {
                    input.type = "password";
                    this.classList.remove('fa-eye-slash');
                    this.classList.add('fa-eye');
                }

            });
        });
    </script>

@endsection