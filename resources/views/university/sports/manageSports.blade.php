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
                    <i class="fas fa-futbol"></i>
                    <span>Manage Sports</span>
                </div>

            </div>

            <div class="btn-ad-asll">
                <a href="{{ route('university.sport.add') }}" class="btn btn-primary">
                    <i class="bx bx-plus me-1"></i> Add Sport
                </a>
            </div>


            {{-- Table Card --}}
            <div class="card">

                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                                <th>Sport Name</th>
                                <th>Category</th>
                                <th class="">Action</th>
                            </tr>
                        </thead>

                        <tbody class="table-border-bottom-0">

                            @forelse ($university->sports as $sport)
                                <tr>
                                    <td>{{ ucfirst($sport->sport->name ?? '-') }}</td>
                                    <td>{{ ucfirst($sport->category ?? '-') }}</td>

                                    <td class="">
                                        <a href="{{ route('university.sport.edit', $sport->id) }}"
                                            class="btn btn-sm btn-edits"><i class="bx bx-edit-alt"></i>Edit</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-danger py-4">
                                        No Sport found
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