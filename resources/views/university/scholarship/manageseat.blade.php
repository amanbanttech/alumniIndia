@extends('layout.university.app')

@section('content')


    <style>
.new-btn-gip {
    gap: 10px;
}
    </style>
    <div class="content-wrapper">
        <div class="commmon-crads">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif


            {{-- Header --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="simple-dashboard-heading">
                    <i class="fa fa-ticket-alt"></i>
                    <span>Manage Seats</span>
                </div>


            </div>
            @php
                $mainScholarship = $scholarships;
            @endphp

            {{-- Scholarship Details Card --}}
            <div class="scholarship-info-card">

                @if($mainScholarship)

                    <div class="ms-info-card">

                        {{-- Card Top Accent Bar --}}
                        <div class="ms-card-accent"></div>

                        <div class="ms-card-body">

                            {{-- Title Block --}}
                            <div class="ms-scholarship-title-block">
                                <h5 class="ms-scholarship-name">
                                    <b>Title&nbsp;:</b>&nbsp;&nbsp;<span>{{ ucfirst($mainScholarship->title) }}</span>
                                </h5>
                                <p class="ms-scholarship-desc">
                                    <b>Description&nbsp;:</b>&nbsp;&nbsp;<span>{{ ucfirst($mainScholarship->description) }}</span>
                                </p>
                            </div>

                            <div class="ms-divider"></div>

                            {{-- Meta Info Grid --}}
                            <div class="ms-meta-grid">

                                <div class="ms-meta-box">
                                    <div class="ms-meta-icon" style="background: #eff6ff; color: #1d4ed8;">
                                        <i class="bx bx-hash"></i>
                                    </div>
                                    <div>
                                        <div class="ms-meta-label">Scholarship ID</div>
                                        <div class="ms-meta-value">{{ $mainScholarship->scholarship_id }}</div>
                                    </div>
                                </div>

                                <div class="ms-meta-box">
                                    <div class="ms-meta-icon" style="background: #f0fdf4; color: #16a34a;">
                                        <i class="bx bx-calendar-check"></i>
                                    </div>
                                    <div>
                                        <div class="ms-meta-label">Start Date</div>
                                        <div class="ms-meta-value">{{ $mainScholarship->open_from->format('d-M-Y') }}</div>
                                    </div>
                                </div>

                                <div class="ms-meta-box">
                                    <div class="ms-meta-icon" style="background: #fff7ed; color: #ea580c;">
                                        <i class="bx bx-calendar-x"></i>
                                    </div>
                                    <div>
                                        <div class="ms-meta-label">End Date</div>
                                        <div class="ms-meta-value">{{ $mainScholarship->end->format('d-M-Y') }}</div>
                                    </div>
                                </div>

                                <div class="ms-meta-box">
                                    <div class="ms-meta-icon" style="background: #fdf4ff; color: #9333ea;">
                                        <i class="bx bx-time-five"></i>
                                    </div>
                                    <div>
                                        <div class="ms-meta-label">Created At</div>
                                        <div class="ms-meta-value">{{ $mainScholarship->created_at->format('d-M-Y') }}</div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                @else

                    <p class="text-danger">No Scholarship Data Found</p>

                @endif

            </div>


            <div class="btn-ad-asll"><a href="{{ route('university.addseat', $scholarships->id) }}" class="btn btn-primary">
                    <i class="bx bx-plus me-1"></i> Add More Seats
                </a>
            </div>


            {{-- Table Card --}}
            <div class="card">
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                                <th>Sport Name</th>
                                <th>Seats Allotted</th>
                                <th>Course Attached</th>
                                <th>Scholarship Amount</th>
                                <th class="">Action</th>
                            </tr>
                        </thead>

                        <tbody class="table-border-bottom-0">

                            @if($scholarships)

                                @php $hasSeats = false; @endphp


                                @foreach($scholarships->seats as $seat)

                                    @php $hasSeats = true; @endphp

                                    <tr>
                                        <td>{{ $seat->sport->sport->name ?? 'N/A' }}</td>

                                        <td>{{ $seat->seat_alloted }}</td>

                                        <td>{{ $seat->course->name ?? 'N/A' }}</td>

                                        <td>Rs. {{ number_format($seat->scholarship_amount, 2) }}</td>

                                        <td class="new-btn-gip">
                                            <a href="{{ route('university.scholarship.editseat', $seat->id) }}"
                                                class="btn btn-sm btn-edits"><i class='bx bx-edit-alt'></i>Edit</a>
                                            <a href="{{ route('university.applied.scholarships', $seat->id) }}"
                                                class="btn btn-sm btn-view-s"><i class="bx bx-show"></i> View</a>
                                        </td>
                                    </tr>


                                @endforeach


                                @if(!$hasSeats)
                                    <tr>
                                        <td colspan="5" class="text-center text-danger py-4">
                                            No Seats Found
                                        </td>
                                    </tr>
                                @endif

                            @else

                                <tr>
                                    <td colspan="5" class="text-center text-danger py-4">
                                        No Scholarships Found
                                    </td>
                                </tr>

                            @endif

                        </tbody>


                    </table>
                </div>
            </div>

        </div>





    </div>
@endsection