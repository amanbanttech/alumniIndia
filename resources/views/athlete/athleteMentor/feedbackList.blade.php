@extends('layout.athlete.app')

@section('content')

    <style>
        .input-controls {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 15px;
        }

     table.dataTable tbody td {
    word-break: break-all!important;
}

        @media (max-width:768px) {
            .input-controls {
                display: flex;
                align-items: flex-start;
                justify-content: flex-start;
                gap: 0;
                flex-direction: column;
            }

            .commmon-crads .btn-primary2 {
                margin: 10px;
                margin-left: 0;
            }
        }
    </style>
    <div class="">
        <div class="commmon-crads">

            <div class="row">
                <div class="col-xxl">

                    <div class="card mb-4">

                        {{-- Header --}}

                        <div class="simple-dashboard-heading">
                            <i class="fas fa-comment-dots"></i>
                            <span>Feedback List</span>
                        </div>
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif


                        <div class="input-controls">
                            
                            <div class="btn-ad-asll"><a href="{{ route('athlete.feedback-add') }}" class="btn btn-primary2">
                                    <i class="bx bx-plus me-1"></i> Add Feedback
                                </a>
                            </div>
                        </div>


                        <div class="card-new-ads bg-all-cards">
                            <div class="card-body ">
                                <div class="div-table-sections">
                                    <div class="table-responsive">

                                        <table id="example" class="table table-bordered text-center align-middle">
                                            <thead>
                                                <tr>
                                                    <th>Feedback</th>
                                                    <th>Posted At</th>

                                                </tr>
                                            </thead>
                                            <tbody class="table-border-bottom-0" >
                                                @foreach($feedbacks as $feedback)

                                                    <tr>
                                                        <td>{{ $feedback->feedback }}</td>
                                                        <td>{{ $feedback->created_at->format('d M Y') }}</td>
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
                        emptyTable: "No Feedback Found"
                    }
                });

            });
        </script>
    @endpush
@endsection