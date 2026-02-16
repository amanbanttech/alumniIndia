@extends('layout.university.app')

@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">

            {{-- Header --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="mb-0">Manage Sub-University Admins</h4>
                <a href="{{ route('subUniversity.add') }}" class="btn btn-primary">
                    <i class="bx bx-plus me-1"></i> Add Sub-University Admins
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
                                <th>Sub-University Admins Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody class="table-border-bottom-0">

                            @forelse ($subUniversities as $sub)
                                <tr>
                                    <td>{{ ucfirst($sub->name) }}</td>
                                    <td>{{ $sub->user->phoneNumber }}</td>
                                    <td>{{ $sub->user->email }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('subUniversity.edit', $sub->id) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        No Sub-Universities Admins found
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