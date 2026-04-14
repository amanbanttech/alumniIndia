@extends('layout.athlete.app')

@section('content')

<div class="">
    <div class="commmon-crads">

        <div class="row">
            <div class="col-xxl">

                <div class="card mb-4">

                    {{-- Header --}}

                    <div class="simple-dashboard-heading">
                        <i class="fas fa-award"></i>
                        <span>Scholarship Details</span>
                    </div>
                    @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif



                    @php
                    $mainScholarship = $scholarships->first() ?? null;
                    @endphp


                    <div class="card-new-ads bg-all-cards">
                        <div class="card-body ">
                            <div class="scholarship-info-card">

                                @if($mainScholarship)

                                <div class="ms-info-card">

                                    {{-- Card Top Accent Bar --}}
                                    <div class="ms-card-accent"></div>

                                    <div class="ms-card-body">

                                        {{-- Title Block --}}
                                        <div class="ms-scholarship-title-block">
                                            <h5 class="ms-scholarship-name">
                                                <b>Title&nbsp;:</b>&nbsp;&nbsp;<span>{{ $mainScholarship->title
                                                    }}</span>
                                            </h5>
                                            <p class="ms-scholarship-desc">
                                                <b>Description&nbsp;:</b>&nbsp;&nbsp;<span>{{
                                                    $mainScholarship->description }}</span>
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
                                                    <div class="ms-meta-value">{{ $mainScholarship->scholarship_id }}
                                                    </div>
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
                                                    <div class="ms-meta-value">{{
                                                        $mainScholarship->created_at->format('d-M-Y') }}</div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                                @else

                                <p class="text-danger">No Scholarship Data Found</p>

                                @endif

                            </div>
                            <div class="div-table-sections">
                                <div class="table-responsive">

                                    <table class="table table-bordered text-center align-middle">
                                        <thead>
                                            <tr>
                                                <th>Sport Name</th>
                                                <th>Seats Allotted</th>
                                                <th>Course Attached</th>
                                                <th>Scholarship Amount</th>
                                                <th class="">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">

                                            @if($scholarships->count())

                                            @php $hasSeats = false; @endphp

                                            @foreach($scholarships as $scholarship)

                                            @foreach($scholarship->seats as $seat)

                                            @php $hasSeats = true; @endphp

                                            <tr>
                                                <td>{{ $seat->sport->sport->name ?? '-' }}</td>

                                                <td>{{ $seat->seat_alloted }}</td>

                                                <td>{{ $seat->course->name ?? '-' }}</td>

                                                <td>Rs.{{ number_format($seat->scholarship_amount, 2) }}</td>

                                                <td>

                                                    @if(in_array($seat->id,$appliedSeats))

                                                    <button class="btn btn-sm btn-success" disabled>
                                                        Applied
                                                    </button>

                                                    @else

                                                    <button
                                                        onclick="applyScholarship({{ $seat->id }},{{ $scholarship->id }})"
                                                        class="btn btn-sm btn-edits">
                                                        <i class='bx bx-edit-alt'></i> Apply Now
                                                    </button>

                                                    @endif

                                                </td>
                                            </tr>

                                            @endforeach

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
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    function applyScholarship(seat_id, scholarship_id) {

        if (confirm("Do you want to apply for this scholarship?")) {

            fetch("{{ route('athlete.store-application') }}", {

                method: "POST",

                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },

                body: JSON.stringify({
                    seat_id: seat_id,
                    scholarship_id: scholarship_id
                })

            })
                .then(res => res.json())
                .then(data => {

                    if (data.success) {
                        alert("Applied Successfully");
                        location.reload();
                    }

                });

        }

    }

</script>
@endsection