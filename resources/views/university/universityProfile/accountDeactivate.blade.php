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
                            <span>Deactivate My Account</span>
                        </div>
                        <div class="card-body">


                            <!-- Warning Box -->
                            <div style="border:1px dashed orange; padding:15px; background:#fff8e6; margin-bottom:20px;">
                                <strong>Warning:</strong> Once you deactivate your account, you will no longer be able to
                                log in.
                                To reactivate your account, you will need to contact the system administrator.
                            </div>

                            <!-- Confirmation Box -->
                            <div style="background:#f5f5f5; padding:30px; text-align:center; border-radius:5px;">

                                <h5 class="mb-4">
                                    Are you sure you want to proceed with deactivating your account?
                                </h5>

                                <form action="{{ route('university.deactivate') }}" method="POST">
                                    @csrf

                                    <button type="submit" class="btn btn-add-univerity" onclick="return confirm('Are you sure you want to deactivate your account? This action cannot be undone.')">
                                        Yes, Deactivate My Account
                                    </button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


@endsection