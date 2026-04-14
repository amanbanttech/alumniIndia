@extends('layout.university.app')

@section('content')
    <style>
        .decsriptions {
            word-wrap: break-word;
            text-wrap: auto;
            min-width: 354px;
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
                    <span>Manage Scholarships</span>
                </div>


            </div>

            <div class="btn-ad-asll"><a href="{{ route('university.scholarship.add') }}" class="btn btn-primary">
                    <i class="bx bx-plus me-1"></i> Add Scholarship
                </a></div>


            {{-- Table Card --}}
            <div class="card">
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                                <th>Scholarship ID</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Open Form</th>
                                <th>End</th>
                                <th>Creation Date</th>
                                <th colspan="2">Action</th>
                            </tr>
                        </thead>

                        <tbody class="table-border-bottom-0">

                            @forelse ($scholarships as $sub)
                                <tr>
                                    <td>{{ $sub->scholarship_id }}</td>
                                    <td>{{ ucfirst($sub->title) }}</td>
                                    <!-- <td class="decsriptions">{{ ucfirst($sub->description) }}</td> -->
                                    <td class="decsriptions" title="{{ $sub->description }}">
                                        {{ \Illuminate\Support\Str::limit(ucfirst($sub->description), 100, '...') }}
                                    </td>
                                    <td>{{ $sub->open_from->format('d-M-Y') }}</td>
                                    <td>{{ $sub->end->format('d-M-Y') }}</td>
                                    <td>{{ $sub->created_at->format('d-M-Y') }}</td>
                                    <td>
                                        <div class="btn-seats">
                                            <a href="{{ route('university.scholarship.edit', $sub->id) }}"
                                                class="btn btn-sm btn-edits"><i class='bx bx-edit-alt'></i>Edit</a>

                                            <a href="{{ route('university.manageseat', $sub->id) }}"
                                                class="btn btn-sm btn-edits btn-setas"> <i class="fa fa-ticket-alt"></i> Manage
                                                Seats</a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-danger py-4">
                                        No Scholarships found
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>

                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection