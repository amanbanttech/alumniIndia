@extends('layout.athlete.app')

@section('content')

    <div class="">
        <div class="commmon-crads">

            <div class="row">
                <div class="col-xxl">

                    <div class="card mb-4">

                        {{-- Header --}}

                        <div class="simple-dashboard-heading">
                            <i class="fas fa-user-tie"></i>
                            <span>My Mentor</span>
                        </div>
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif


                        <div class="card-new-ads bg-all-cards">
                            <div class="card-body ">
                                <div class="scholarship-info-card">


                                    <div class="ms-info-card">

                                        {{-- Card Top Accent Bar --}}
                                        <div class="ms-card-accent"></div>

                                        <div class="ms-card-body">

                                            {{-- Title Block --}}
                                            <div class="ms-scholarship-title-block">

                                                <div class="congrats-banner">
                                                    <div class="congrats-banner-icon">
                                                        <i class="fas fa-star"></i>
                                                    </div>
                                                    <div class="congrats-banner-text">
                                                        <h4>Congratulations!</h4>
                                                        <p>You have been assigned a professional Coach/Mentor based on your
                                                            sport profile.<br>
                                                            Your current Coach/Mentor details are displayed below.</p>
                                                    </div>
                                                </div>

                                                <div class="mentor-card">
                                                    <div class="mentor-avatar-wrap">
                                                        <div class="mentor-avatar-big">
                                                            <i class="fas fa-user-tie"></i>
                                                        </div>
                                                        <div class="online-badge"></div>
                                                    </div>
                                                    <div class="mentor-info">
                                                        <div class="mentor-name"><b>Name&nbsp;:</b>&nbsp;&nbsp;<span>{{ $mentorData->mentor->user->name
        ?? 'N/A' }}</div>
                                                        <div class="mentor-name">
                                                            <b>University&nbsp;:</b>&nbsp;&nbsp;<span>{{
        $mentorData->mentor->university->user->name ?? 'N/A' }}
                                                        </div>

                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex mt-3 mentor-log">
                                    <div class="btn-ad-asll"><a href="{{ route('athlete.feedback-list') }}"
                                            class="btn btn-primary2">
                                            <i class="bx bx-plus me-1"></i> Give Feedback
                                        </a>
                                    </div>

                                    <div class="btn-ad-asll add-new-discuss"><a href="#" class="btn btn-primary2">
                                            Discussion Board
                                        </a>
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