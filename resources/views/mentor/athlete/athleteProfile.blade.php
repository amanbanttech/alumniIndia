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
                        <h1>Athlete Profile</h1>
                    </div>

                    <div class="card-new-ads bg-all-cards">
                        <div class="card-body ">
                            <div class="scholarship-info-card">


                                <div class="ms-info-card">

                                    {{-- Card Top Accent Bar --}}
                                    <div class="ms-card-accent"></div>

                                    <div class="ms-card-body">

                                        {{-- Title Block --}}
                                        <div class="ms-scholarship-title-block">



                                            <div class="mentor-card">

                                                <div class="mentor-info">
                                                    <div class="row">

                                                        <div class="mentor-name col-md-3">
                                                            <b>Athlete
                                                                ID&nbsp;:</b>&nbsp;&nbsp;<span>{{$athlete->athlete_id ?? 'N/A' }}</span>
                                                        </div>
                                                        <div class="mentor-name col-md-3">
                                                            <b>Name&nbsp;:</b>&nbsp;&nbsp;<span>{{ $athlete->name ?? 'N/A' }}</span>
                                                        </div>
                                                        <div class="mentor-name col-md-6">
                                                            <b>Address&nbsp;:</b>&nbsp;&nbsp;<span>{{$athlete->address ?? 'N/A' }},{{ $athlete->city ?? 'N/A' }},{{ $athlete->state->name ?? 'N/A' }}</span>
                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="mentor-name col-md-3">
                                                            <b>Sport
                                                                Play&nbsp;:</b>&nbsp;&nbsp;<span>{{ $athlete->sportDetail->sport->name ?? 'N/A' }}</span>
                                                        </div>

                                                    </div>


                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Table Card --}}
                            <div class="card">

                                <div class="table-responsive text-nowrap">
                                    <table class="table">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>Feedback</th>
                                                <th>Posted At</th>

                                            </tr>
                                        </thead>

                                        <tbody class="table-border-bottom-0">

                                            @forelse ($feedbacks as $feedback)
                                                <tr>
                                                    <td>{{ ucfirst($feedback->feedback ?? '-') }}</td>
                                                    <td>{{ $feedback->created_at->format('Y-m-d') }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center text-danger py-4">
                                                        No Feedback found
                                                    </td>
                                                </tr>
                                            @endforelse

                                        </tbody>

                                    </table>
                                </div>
                            </div>

                            <div class="d-flex mt-3 mentor-log">

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

@endsection