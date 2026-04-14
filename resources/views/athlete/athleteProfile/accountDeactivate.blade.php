@extends('layout.athlete.app')

@section('content')


    <div class="">
        <div class="commmon-crads">

            <div class="row">
                <div class="col-xxl">

                    <div class="card mb-4">

                        {{-- Header --}}

                        <div class="simple-dashboard-heading">
                            <i class="fas fa-comment-dots"></i>
                            <span>Deactivate My Account</span>
                        </div>
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif


                        <div class="card-new-ads bg-all-cards">

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

                                <form action="{{ route('athlete.deactivate') }}" method="POST">
                                    @csrf

                                    <button type="submit" class="btn btn-primary-adds" onclick="return confirm('Are you sure you want to deactivate your account? This action cannot be undone.')">

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