@extends('layout.admin.app')

@section('content')
    <div class="content-wrapper">
        <div class="commmon-crads">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            @if(request('success'))
                <div class="alert alert-success">
                    {{ request('success') }}
                </div>
            @endif

            {{-- Header --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="simple-dashboard-heading">
                    <i class="fa fa-university"></i>
                    <span>Manage Universities</span>
                </div>
            </div>
            <div class="btn-ad-asll">
                <a href="{{ route('admin.university.add') }}" class="btn btn-primary">
                    <i class="bx bx-plus me-1"></i> Add University
                </a>
            </div>


            {{-- Table Card --}}
            <div class="card">

                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                                <th>University Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody class="table-border-bottom-0">

                            @forelse ($universities as $university)
                                <tr>
                                    <td>{{ ucfirst($university->user->name ?? '-') }}</td>
                                    <td>{{ $university->user->phoneNumber ?? '-' }}</td>
                                    <td>{{ $university->user->email ?? '-' }}</td>
                                    <td>{{ ucfirst($university->address ?? '-') }},{{ ucfirst($university->city ?? '-') }},{{ $university->state->name ?? '-' }}
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.university.view', $university->id) }}"
                                            class="btn btn-sm btn-view">View</a>
                                        <a href="{{ route('admin.university.edit', $university->id) }}"
                                            class="btn btn-sm  btn-edits">Edit</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-danger py-4">
                                        No universities found
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