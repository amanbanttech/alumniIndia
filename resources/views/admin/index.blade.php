@extends('layout.admin.app')

@section('content')
<div class="content-wrapper">
   <div class="commmon-crads">
        <!-- PAGE TITLE -->
        <div class="row mb-4">
           <div class="col-12 text-center">
          <div class="simple-dashboard-heading">
    <i class="fas fa-chart-bar"></i>
    <span>Admin Dashboard – Key Metrics</span>
</div>
            </div>
        </div>
  <div class="div-all-boxes">
       <div class="row">

            <!-- TOTAL ATHLETES -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 border-d">
                    <div class="card-header">
          <span class="icon-box athletes"><i class="fas fa-users"></i></span>
          Total Athletes
        </div>
                    <div class="card-body ">
                        <p> Total Athletes  <strong>{{ $totalAthletes }}</strong></p>
                        <p> Active Athletes  <strong>5</strong></p>
                        <p> Pending Approval  <strong>5</strong></p>
                    </div>
                </div>
            </div>

            <!-- TOTAL STUDENTS -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 ">
                    <div class="card-header">
          <span class="icon-box students"><i class="fas fa-graduation-cap"></i></span>
          Total Students
        </div>
                    <div class="card-body ">
                        <p> Active Students  <strong>100</strong></p>
                        <p> New Registrations (Last 30 Days)  <strong>5</strong></p>
                    </div>
                </div>
            </div>

            <!-- TOTAL ALUMNI -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 ">
                     <div class="card-header">
          <span class="icon-box alumni"><i class="fas fa-user-check"></i></span>
          Total Alumni
        </div>
                    <div class="card-body ">
                        <p>Total Alumni  <strong>55</strong></p>
                    </div>
                </div>
            </div>

            <!-- TOTAL SCHOLARSHIPS -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 ">
                    <div class="card-header">
          <span class="icon-box scholarships"><i class="fas fa-award"></i></span>
          Total Scholarships
        </div>
                    <div class="card-body ">
                        <p> Scholarships Offered <strong>60</strong></p>
                        <p> Scholarships Awarded <strong>10</strong></p>
                        <p> Applications Pending <strong>50</strong></p>
                    </div>
                </div>
            </div>

            <!-- TOTAL MENTORS -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 ">
                     <div class="card-header">
          <span class="icon-box mentors"><i class="fas fa-user-tie"></i></span>
         Total Mentors
        </div>
                    <div class="card-body ">
                        <p> Total Coaches <strong>{{ $totalMentors }}</strong></p>
                        <p> Active Coaches <strong>80</strong></p>
                    </div>
                </div>
            </div>

            <!-- TOTAL DONATIONS -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 ">
                    <div class="card-header">
          <span class="icon-box donations"><i class="fas fa-heart"></i></span>
         Total Donations
        </div>
                    <div class="card-body ">
                        <p>Total Donation Amount  <strong>₹ 2,000</strong></p>
                        <p> No. of Donors <strong>10</strong></p>
                    </div>
                </div>
            </div>

        </div>

</div>
    </div>
</div>
@endsection
