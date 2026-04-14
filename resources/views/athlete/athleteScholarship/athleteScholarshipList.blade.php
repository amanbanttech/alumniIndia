@extends('layout.athlete.app')

@section('content')


<style>.commmon-crads .table th {
    min-width: 143px;
}

td.decs {
    min-width: 269px;
}</style>

    <div class="">
        <div class="commmon-crads">

            <div class="row">
                <div class="col-xxl">

                    <div class="card mb-4">

                        {{-- Header --}}

                        <div class="simple-dashboard-heading">
                            <i class="fas fa-award"></i>
                            <span>Current Scholarships</span>
                        </div>
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <div class="row justify-content-end">
                            <div class="col-md-4">
                                <div class="input-controls">
                                    <input type="text" id="customSearch" class="form-control"
                                        placeholder="Search Scholarships...">
                                </div>
                            </div>
                        </div>

                        @php
                            $membership = Auth::user()->athlete->membership;
                        @endphp
                     <div class="card-new-ads bg-all-cards">
                            <div class="card-body ">
                                <div class="div-table-sections">
                                    <div class="table-responsive">
                                        @php
                                            $columnCount = $membership == 'elite' ? 8 : 7;
                                        @endphp
                                        <table id="example" class="table table-bordered text-center align-middle">
                                            <thead>
                                                <tr>
                                                    <th>Scholarship-ID</th>
                                                    <th>Title</th>
                                                    <th>Description</th>
                                                    <th>University</th>
                                                    <th>Open From</th>
                                                    <th>End</th>
                                                    <th>Creation Date</th>
                                                    @if($membership == 'elite')
                                                        <th>Action</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody class="table-border-bottom-0">

                                               @foreach ($scholarships as $sub)
<tr>
    <td>{{ $sub->scholarship_id }}</td>
    <td>{{ ucfirst($sub->title) }}</td>
    <td class="decs">{{ ucfirst($sub->description) }}</td>
    <td>{{ ucfirst($sub->university->user->name ?? 'N/A') }}</td>
    <td>{{ $sub->open_from->format('d-M-Y') }}</td>
    <td>{{ $sub->end->format('d-M-Y') }}</td>
    <td>{{ $sub->created_at->format('d-M-Y') }}</td>

    @if($membership == 'elite')
    <td>
        <a href="{{ route('athlete.apply-scholarships', $sub->id) }}"
            class="btn apply-now-butons">
            <i class="bx bx-bolt-circle"></i> Apply Now
        </a>
    </td>
    @endif
</tr>
@endforeach

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

    @push('scripts')
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

        <script>
            $(document).ready(function () {

                var table = $('#example').DataTable({
                    paging: false,
                    ordering: false,
                    info: false,
                    dom: 'rt',
                    language: {
        emptyTable: "No Scholarships Found"
    }
                });

                $('#customSearch').on('keyup', function () {
                    table.search($(this).val()).draw();
                });

            });
        </script>
    @endpush
@endsection