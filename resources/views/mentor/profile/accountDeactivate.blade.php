@extends('layout.mentor.app')

@section('content')


    <div class="content-wrapper">
        <div class="commmon-crads">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="row mb-4">
                <div class="col-12 text-center univerisyt-headin">
                    <div class="heaing-alls">
                        <h1>Deactivate My Account</h1>
                    </div>

                    <div class="card-new-ads bg-all-cards">
                        <div class="card-body ">
                            <div class="scholarship-info-card">


                                <div class="ms-info-card">

                                    {{-- Card Top Accent Bar --}}
                                    <div class="ms-card-accent"></div>

                                    <div class="ms-card-body">
                                        <!-- Warning Box -->
                                        <div
                                            style="border:1px dashed orange; padding:15px; background:#fff8e6; margin-bottom:20px;">
                                            <strong>Warning:</strong> Once you deactivate your account, you will no longer
                                            be able to
                                            log in.
                                            To reactivate your account, you will need to contact the system administrator.
                                        </div>

                                        <!-- Confirmation Box -->
                                        <div
                                            style="background:#f5f5f5; padding:30px; text-align:center; border-radius:5px;">

                                            <h5 class="mb-4">
                                                Are you sure you want to proceed with deactivating your account?
                                            </h5>

                                            <form action="{{ route('mentor.deactivate') }}" method="POST">
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
            </div>
        </div>

    </div>

@endsection