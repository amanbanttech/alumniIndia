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
                        <h1>My Athletes</h1>
                    </div>

                    

                    {{-- Table Card --}}
                    <div class="card">

                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Athlete ID</th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Sport play</th>

                                        <th class="">Action</th>
                                    </tr>
                                </thead>

                                <tbody class="table-border-bottom-0">

                                    @forelse ($assignments as $assignment)
                                        <tr>
                                            <td>{{ $assignment->athlete->athlete_id }}</td>
                                            <td>{{ ucfirst($assignment->athlete->name ?? '-') }}</td>
                                            <td>{{ ucfirst($assignment->athlete->address ?? '-') }},{{ ucfirst($assignment->athlete->city ?? '-') }},{{ ucfirst($assignment->athlete->state->name ?? '-') }}</td>
                                            <td>{{ ucfirst($assignment->athlete->sportDetail->sport->name ?? '-') }}</td>
                                            <td class="">
                                                <a href="{{ route('mentor.athlete.profile', $assignment->athlete->id) }}" class="btn btn-sm btn-edits"><i class="bx bx-edit-alt"></i>view
                                                    Profile</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-danger py-4">
                                                No Athletes found
                                            </td>
                                        </tr>
                                    @endforelse

                                </tbody>

                            </table>
                        </div>
                    </div>


                </div>
            </div>
        </div>

    </div>

@endsection