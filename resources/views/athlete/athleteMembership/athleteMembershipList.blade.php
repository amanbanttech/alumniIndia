@extends('layout.athlete.app')

@section('content')

    <div class="">
        <div class="commmon-crads">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="row">
                <div class="col-xxl">
                    <div class="card mb-4 ">

                        <div class="simple-dashboard-heading">
                           <i class="fas fa-id-card"></i>
                            <span>Manage Membership</span>
                        </div>

                        <div class="card-new-ads bg-all-cards">
                            <div class="card-body ">

                              <div class="div-table-sections">
                                  <p class="currnt-members">
                                    Your Current Membership:
                                    @if(Auth::user()->athlete->membership == 'elite')
                                        <span class="badge bg-success">Elite</span>
                                    @else
                                        <span class="badge bg-secondary">Free</span>
                                    @endif
                                </p>

                                <div class="table-responsive">
                                    <table class="table table-bordered text-center align-middle">

                                        <thead>
                                            <tr>
                                                <th>Features Available</th>
                                                <th>Free Membership</th>
                                                <th>
                                                    Elite Membership <small>(One time cost: Rs. 500/-)</small>
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td class="text-start">Post Videos</td>
                                                <td > <span class="up-to">Upto 10</span></td>
                                                  <td > <span class="no-limit">No Limit</span></td>
                                            </tr>

                                            <tr>
                                                <td class="text-start">View Scholarships</td>
                                                 <td > <span class="yess">Yes</span></td>
                                                 <td > <span class="yess">Yes</span></td>
                                            </tr>

                                            <tr>
                                                <td class="text-start">Apply Scholarships</td>
                                            <td > <span class="noo">No</span></td>
                                                 <td > <span class="yess">Yes</span></td>
                                            </tr>

                                            <tr>
                                                <td class="text-start">Mentor Assigned</td>
                                            <td > <span class="noo">No</span></td>
                                                <td > <span class="yess">Yes</span></td>
                                            </tr>

                                            @if(Auth::user()->athlete->membership == 'free')
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td>
                                                        <a href="#"
                                                            class="btn btn-buy-nows">
                                                            Buy Now
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endif
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

@endsection