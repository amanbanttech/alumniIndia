@extends('layout.university.app')

@section('content')


    <style>
.ms-meta-grid {
    margin-bottom: 15px;
}.scholarship-info-card {
    margin-top: 26px;
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
                    <i class="fa fa-user-graduate"></i>
                    <span>Athletes List applied for Scholarship</span>
                </div>


            </div>

            <div class="row justify-content-end">
                <div class="col-md-4">
                    <div class="input-controls">
                        <input type="text" id="customSearch" class="form-control" placeholder="Search Athletes...">
                    </div>
                </div>
            </div>

            @php
                $Scholarship = $seat->scholarship;
            @endphp
            {{-- Scholarship Details Card --}}
            <div class="scholarship-info-card">

                @if($Scholarship)

                    <div class="ms-info-card">

                        {{-- Card Top Accent Bar --}}
                        <div class="ms-card-accent"></div>

                        <div class="ms-card-body">

                            {{-- Title Block --}}
                            <div class="ms-scholarship-title-block">
                                <h5 class="ms-scholarship-name">
                                    <b>Title&nbsp;:</b>&nbsp;&nbsp;<span>{{ $Scholarship->title }}</span>
                                </h5>
                                <p class="ms-scholarship-desc">
                                    <b>Description&nbsp;:</b>&nbsp;&nbsp;<span>{{ $Scholarship->description }}</span>
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
                                        <div class="ms-meta-value">{{ $Scholarship->scholarship_id }}</div>
                                    </div>
                                </div>

                                <div class="ms-meta-box">
                                    <div class="ms-meta-icon" style="background: #f0fdf4; color: #16a34a;">
                                        <i class="bx bx-calendar-check"></i>
                                    </div>
                                    <div>
                                        <div class="ms-meta-label">Start Date</div>
                                        <div class="ms-meta-value">{{ $Scholarship->open_from->format('d-M-Y') }}</div>
                                    </div>
                                </div>

                                <div class="ms-meta-box">
                                    <div class="ms-meta-icon" style="background: #fff7ed; color: #ea580c;">
                                        <i class="bx bx-calendar-x"></i>
                                    </div>
                                    <div>
                                        <div class="ms-meta-label">End Date</div>
                                        <div class="ms-meta-value">{{ $Scholarship->end->format('d-M-Y') }}</div>
                                    </div>
                                </div>

                                <div class="ms-meta-box">
                                    <div class="ms-meta-icon" style="background: #fdf4ff; color: #9333ea;">
                                        <i class="bx bx-time-five"></i>
                                    </div>
                                    <div>
                                        <div class="ms-meta-label">Created At</div>
                                        <div class="ms-meta-value">{{ $Scholarship->created_at->format('d-M-Y') }}</div>
                                    </div>
                                </div>

                            </div>
  <div class="ms-meta-grid">

                                <div class="ms-meta-box">
                                    <div class="ms-meta-icon" style="background: #eff6ff; color: #1d4ed8;">
                                        <i class="bx bx-hash"></i>
                                    </div>
                                    <div>
                                        <div class="ms-meta-label">Sport Name</div>
                                        <div class="ms-meta-value">{{ $seat->sport->sport->name }}</div>
                                    </div>
                                </div>


                                <div class="ms-meta-box">
                                    <div class="ms-meta-icon" style="background: #eff6ff; color: #1d4ed8;">
                                        <i class="bx bx-hash"></i>
                                    </div>
                                    <div>
                                        <div class="ms-meta-label">Seat Allotted</div>
                                        <div class="ms-meta-value">{{ $seat->seat_alloted }}</div>
                                    </div>
                                </div>

                                <div class="ms-meta-box">
                                    <div class="ms-meta-icon" style="background: #eff6ff; color: #1d4ed8;">
                                        <i class="bx bx-hash"></i>
                                    </div>
                                    <div>
                                        <div class="ms-meta-label">Course Attached</div>
                                        <div class="ms-meta-value">{{ $seat->course->name }}</div>
                                    </div>
                                </div>

                                <div class="ms-meta-box">
                                    <div class="ms-meta-icon" style="background: #eff6ff; color: #1d4ed8;">
                                        <i class="bx bx-hash"></i>
                                    </div>
                                    <div>
                                        <div class="ms-meta-label">Scholarship Amount</div>
                                        <div class="ms-meta-value">Rs.{{ number_format($seat->scholarship_amount, 2) }}</div>
                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>

                   
                @else

                    <p class="text-danger">No Scholarship Data Found</p>

                @endif

            </div>





            {{-- Table Card --}}
            <div class="card">
                <div class="table-responsive text-nowrap">
                    <table id="example" class="table">
                        <thead class="table-dark">
                            <tr>
                                <th>Athlete ID</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Sport Plays</th>
                                <th class="">Action</th>
                            </tr>
                        </thead>

                        <tbody class="table-border-bottom-0">

                            @if($applications->count() > 0)

                                @foreach($applications as $athlete)

                                    <tr>
                                        <!-- <td>{{ $athlete->athlete_id }}</td> -->
                                        <td>{{ 'Ath-' . str_pad($athlete->athlete_id, STR_PAD_LEFT) }}</td>
                                        <td>{{ $athlete->name }}</td>
                                        <td>{{ $athlete->address }}</td>
                                        <td>{{ $athlete->sport }}</td>

                                        <td class="">
                                            <a href="{{ route('university.scholarship.viewPreview', ['id' => $athlete->athlete_id]) }}"
                                                class="btn btn-sm btn-view-s"><i class="bx bx-show"></i>View Profile</a>
                                        </td>

                                    </tr>

                                @endforeach

                            @else

                                <tr>
                                    <td colspan="5" class="text-center text-danger py-4">
                                        No Athletes Applied
                                    </td>
                                </tr>

                            @endif

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
    @push('scripts')
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

        <script>
            $(document).ready(function () {

                var table = $('#example').DataTable({
                    paging: false,
                    ordering: false,
                    info: false,
                    dom: 'rt',
                });

                $('#customSearch').on('keyup', function () {
                    table.search($(this).val()).draw();
                });

            });
        </script>
    @endpush
@endsection