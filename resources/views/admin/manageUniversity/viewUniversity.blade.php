@extends('layout.admin.app')

@section('content')
    <div class="content-wrapper">
         <div class="commmon-crads">

            <div class="row">
                <div class="col-xxl">
                    <div class="card mb-4">
                      
   <div class="simple-dashboard-heading">
     <i class="fa fa-university"></i>
    <span>University View</span>
</div>
                        <div class="content">

                            <!-- Main Info Card -->
                            <div class="info-card">
                                <h2 class="info-title">
                                    {{ $university->user->name ?? 'N/A' }}
                                </h2>
                                <p class="info-description">
                                    {{ $university->about ?? 'N/A' }}
                                </p>
                            </div>

                            <!-- Contact Information -->
                            <div class="stats-container">
                                <div class="info-section">
                                    <div class="info-section-title">Contact Information</div>

                                    <div class="info-row">
                                        <span class="info-label">Mobile</span>
                                        <span class="info-value">
                                            {{ $university->user->phoneNumber ?? 'N/A' }}
                                        </span>
                                    </div>

                                    <div class="info-row">
                                        <span class="info-label">Email</span>
                                        <span class="info-value">
                                            {{ $university->user->email ?? 'N/A' }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Location Information -->
                                <div class="info-section">
                                    <div class="info-section-title">Location Details</div>

                                    <div class="info-row">
                                        <span class="info-label">Address</span>
                                        <span class="info-value">
                                            {{ $university->address ?? 'N/A' }}
                                        </span>
                                    </div>

                                    <div class="info-row">
                                        <span class="info-label">City</span>
                                        <span class="info-value">
                                            {{ $university->city ?? 'N/A' }}
                                        </span>
                                    </div>

                                    <div class="info-row">
                                        <span class="info-label">State</span>
                                        <span class="info-value">
                                            {{ $university->state->name ?? 'N/A' }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Status
                            <div class="status-section">
                                <span class="status-label">Status</span>
                                <span class="status-badge">
                                    {{ $university->status == 1 ? 'Active' : 'Inactive' }}
                                </span>
                            </div> -->

                            <!-- Logos -->
                            <div class="logos-grid">
                                <div class="logo-box">
                                    <div class="logo-title">Emblem Logo</div>
                                    <img src="{{ $university->user->image ? asset('university_assets/images/' . $university->user->image) : '' }}"
                                        alt="Emblem Logo" class="logo-image">
                                </div>

                                <div class="logo-box">
                                    <div class="logo-title">Sports Logo</div>
                                    <img src="{{ $university->sports_logo ? asset('university_assets/sports_logo/' . $university->sports_logo) : '' }}"
                                        alt="Sports Logo" class="logo-image">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection