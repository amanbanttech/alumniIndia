@extends('layout.university.app')

@section('content')
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
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <span>Manage Mentors</span>
                </div>

            </div>
            <div class="btn-ad-asll"> <a href="{{ route('university.mentor.add') }}" class="btn btn-primary">
                    <i class="bx bx-plus me-1"></i> Add Mentor
                </a></div>


            {{-- Table Card --}}
            <div class="card">

                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                                <th>Mentor Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Sport play</th>

                                <th class="">Action</th>
                            </tr>
                        </thead>

                        <tbody class="table-border-bottom-0">

                            @forelse ($mentors as $mentor)
                                <tr>
                                    <td>{{ ucfirst($mentor->user->name ?? '-') }}</td>
                                    <td>{{ $mentor->user->phoneNumber ?? '-' }}</td>
                                    <td>{{ $mentor->user->email ?? '-' }}</td>
                                    <td>{{ $mentor->sport->sport->name ?? '-' }}</td>
                                    <td class="">
                                        <a href="{{ route('university.mentor.edit', $mentor->id) }}"
                                            class="btn btn-sm btn-edits"><i class="bx bx-edit-alt"></i>Edit</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-danger py-4">
                                        No Mentors found
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