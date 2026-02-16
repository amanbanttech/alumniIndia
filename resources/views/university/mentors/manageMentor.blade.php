@extends('layout.university.app')

@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">

            {{-- Header --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="mb-0">Manage Mentors</h4>
                <a href="{{ route('university.mentor.add') }}" class="btn btn-primary">
                    <i class="bx bx-plus me-1"></i> Add Mentor
                </a>
            </div>
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

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

                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody class="table-border-bottom-0">

                            @forelse ($mentors as $mentor)
                                <tr>
                                    <td>{{ ucfirst($mentor->user->name ?? '-') }}</td>
                                    <td>{{ $mentor->user->phoneNumber ?? '-' }}</td>
                                    <td>{{ $mentor->user->email ?? '-' }}</td>
                                    <td>{{ $mentor->sport->name ?? '-' }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('university.mentor.edit', $mentor->id) }}"
                                            class="btn btn-sm btn-warning">Edit</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
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