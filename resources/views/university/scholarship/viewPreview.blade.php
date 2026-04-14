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
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="simple-dashboard-heading">
                    <i class="fa fa-running" aria-hidden="true"></i>
                    <span>Athlete Profile</span>
                </div>
                <!-- </div> -->

            </div>
            <div class="btn-ad-asll"><a href="{{ route('university.scholarship.assignMentor', $athlete->id) }}"
                    class="btn btn-primary">
                    <i class="bx bx-plus me-1"></i> Assign Mentor
                </a>
            </div>



            <div class="igram-layout">

                <div class="igram-feed-col">
                    <div class="igram-post-card">
                        <div class="igram-post-topbar">
                            <div class="igram-post-userinfo">
                                <div class="igram-avatar-halo"><img
                                        src="{{ asset('athlete_assets/athlete_documents/' . $athlete->document->profile_photo) }}"
                                        alt="profile"></div>
                                <div>
                                    <div class="igram-post-username">{{ $athlete->user->name ?? 'N/A' }}</div>
                                    <div class="igram-post-subloc">{{ $athlete->nationality->country_name ?? 'N/A' }}</div>
                                </div>
                            </div>
                        </div>
                        @php
                            $videos = $athlete->videos->map(function ($v) {
                                return [
                                    'id' => $v->id,
                                    'video' => $v->video,
                                    'title' => $v->title,
                                    'about' => $v->about,
                                    'likes' => $v->likes->count(),
                                    'liked' => $v->likes->where('user_id', auth()->id())->count() > 0,
                                    'time' => $v->created_at->diffForHumans()
                                ];
                            });
                        @endphp
                        @if(count($videos) > 0)
                            <div class="igram-video-container" tabindex="0" id="videoCard">
                                <video id="athleteVideo" controls autoplay muted loop playsinline width="100%">
                                    <source id="videoSource" src="{{ env('BUNNY_BASE_URL') . '/' . $videos[0]['video'] }}">
                                </video>
                            </div>
                        @else
                            <div class="alert alert-info">
                                No video uploaded by this athlete.
                            </div>
                        @endif
                        @if(count($videos) > 0)
                            <div class="igram-post-actions-area">
                                <div class="igram-action-btnrow">
                                    <div class="igram-left-actionbtns">
                                        <button class="igram-action-iconbtn likeBtn" id="likeBtn"
                                            data-video="{{ $videos[0]['id'] }}">
                                            <svg viewBox="0 0 24 24" fill="{{ $videos[0]['liked'] ? 'red' : 'none' }}"
                                                stroke="{{ $videos[0]['liked'] ? 'red' : 'currentColor' }}" stroke-width="2">
                                                <path
                                                    d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div class="igram-stats-inforow">
                                    <span id="likeCount">

                                        {{ $videos[0]['likes'] }} likes
                                    </span>
                                </div>
                                <p class="igram-post-caption">
                                    <strong id="videoTitle">{{ $videos[0]['title'] ?? 'N/A' }}</strong>
                                    <span id="videoAbout">{{ $videos[0]['about'] ?? '' }}</span>
                                </p>
                                <p class="igram-post-timestamp" id="videoTime">{{ $videos[0]['time'] }}</p>
                            </div>
                        @endif
                    </div>
                </div>
                @if(!empty($athlete->videos) && count($athlete->videos) > 0)
                    <div class="igram-sidebar-col">
                        <h4 class="other-videos">Other Videos</h4>
                        <div class="div-grid-top-2">
                            <div class="igram-video-grid">
                                @foreach($athlete->videos as $index => $video)
                                    <div class="igram-grid-card {{ $index == 0 ? 'igram-grid-active' : '' }}" onclick="setActive(
                                                                                            this,
                                                                                            {{ $index }}
                                                                                            )">
                                        <div class="igram-grid-thumb">
                                            <video muted preload="metadata" playsinline>
                                                <source src="{{ env('BUNNY_BASE_URL') . '/' . $video->video }}#t=0.5">
                                            </video>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>


            <div class="apd-wrapper">

                <div class="apd-tabs-row">
                    <a class="apd-tab-btn apd-tab-active" href="#personal">Personal</a>
                    <a class="apd-tab-btn" href="#academic">Academic</a>
                    <a class="apd-tab-btn" href="#sports">Sports Matrix</a>
                    <a class="apd-tab-btn" href="#documents">Documents</a>
                </div>
                <section class="apd-section-block" id="personal">
                    <div class="apd-section-heading">
                        <div class="apd-section-num">1</div>
                        <div class="apd-section-title">Personal Information</div>
                        <div class="apd-section-line"></div>
                    </div>
                    <div class="apd-card">
                        <div class="apd-avatar-wrap">
                            <div class="apd-avatar-ring">
                                <div class="apd-avatar-inner"><img
                                        src="{{ asset('athlete_assets/athlete_documents/' . $athlete->document->profile_photo) }}"
                                        alt="profile"></div>
                            </div>
                            <div>
                                <div class="apd-avatar-info-name">{{ $athlete->name ?? 'N/A' }}</div>
                                <div class="apd-avatar-info-sub">Athlete Profile &nbsp;·&nbsp;
                                    {{ $athlete->state->name ?? 'N/A' }}, India
                                </div>
                                <div class="apd-avatar-info-tags">
                                    <span class="apd-tag-pill apd-tag-blue">{{ $athlete->gender ?? 'N/A'}}</span>
                                    <span
                                        class="apd-tag-pill apd-tag-teal">{{ $athlete->nationality->nationality ?? 'N/A' }}</span>
                                    <span class="apd-tag-pill apd-tag-green">Active</span>
                                </div>
                            </div>
                        </div>

                        <div class="apd-subsec-title">Basic Details</div>
                        <div class="apd-grid-3">
                            <div class="apd-field-group">
                                <div class="apd-field-label">Full Name</div>
                                <div class="apd-field-val">{{ $athlete->name ?? 'N/A' }}</div>
                            </div>
                            <div class="apd-field-group">
                                <div class="apd-field-label">Date of Birth</div>
                                <div class="apd-field-val">{{ $athlete->date_of_birth ?? 'N/A' }}</div>
                            </div>
                            <div class="apd-field-group">
                                <div class="apd-field-label">Nationality</div>
                                <div class="apd-field-val">{{ $athlete->nationality->nationality ?? 'N/A' }}</div>
                            </div>
                            <div class="apd-field-group">
                                <div class="apd-field-label">Gender</div>
                                <div class="apd-field-val">{{ $athlete->gender ?? 'N/A'}}</div>
                            </div>
                        </div>

                        <div class="apd-divider"></div>

                        <div class="apd-subsec-title">Contact Information</div>
                        <div class="apd-grid-32">
                            <div class="apd-field-group">
                                <div class="apd-field-label">Email</div>
                                <div class="apd-field-val">{{ $athlete->user->email ?? 'N/A' }}</div>
                            </div>
                            <div class="apd-field-group">
                                <div class="apd-field-label">Phone Number</div>
                                <div class="apd-field-val">{{ $athlete->user->phoneNumber ?? 'N/A' }}</div>
                            </div>
                            <div class="apd-field-group">
                                <div class="apd-field-label">Address</div>
                                <div class="apd-field-val">{{ $athlete->address }},
                                    {{ $athlete->city }},{{ $athlete->state->name }}, {{ $athlete->zip_code ?? 'N/A' }}
                                </div>
                            </div>
                            {{-- <div class="apd-field-group">
                                <div class="apd-field-label">City</div>
                                <div class="apd-field-val"></div>
                            </div>
                            <div class="apd-field-group">
                                <div class="apd-field-label">State</div>
                                <div class="apd-field-val"></div>
                            </div>
                            <div class="apd-field-group">
                                <div class="apd-field-label">Zip Code</div>
                                <div class="apd-field-val"></div>
                            </div> --}}
                        </div>
                    </div>
                </section>

                <section class="apd-section-block" id="academic">
                    <div class="apd-section-heading">
                        <div class="apd-section-num">2</div>
                        <div class="apd-section-title">Academic Information</div>
                        <div class="apd-section-line"></div>
                    </div>
                    <div class="apd-card">
                        <div class="apd-edu-timeline">

                            <div class="apd-edu-item">
                                <div class="apd-edu-dot"></div>
                                <div class="apd-edu-card">
                                    <div class="apd-edu-level">High School · 10th</div>
                                    <div class="apd-edu-school">{{ $athlete->academicDetail->school_name ?? 'N/A'}}
                                    </div>
                                    <div class="apd-edu-meta-row">
                                        <div class="apd-edu-meta-item">
                                            <div class="apd-edu-meta-key">Board</div>
                                            <div class="apd-edu-meta-v">
                                                {{ $athlete->academicDetail->tenthBoard->name ?? 'N/A' }}
                                            </div>
                                        </div>
                                        <div class="apd-edu-meta-item">
                                            <div class="apd-edu-meta-key">Result Type</div>
                                            <div class="apd-edu-meta-v">
                                                {{ $athlete->academicDetail->tenth_result_type ?? 'N/A' }}
                                            </div>
                                        </div>
                                        <div class="apd-edu-meta-item">
                                            <div class="apd-edu-meta-key">Result</div>
                                            <div class="apd-edu-meta-v">
                                                {{ $athlete->academicDetail->tenth_result ?? 'N/A' }}
                                            </div>
                                        </div>
                                        <div class="apd-edu-meta-item">
                                            <div class="apd-edu-meta-key">Year of Passing</div>
                                            <div class="apd-edu-meta-v">
                                                {{ $athlete->academicDetail->tenth_year ?? 'N/A' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="apd-edu-item">
                                <div class="apd-edu-dot"></div>
                                <div class="apd-edu-card">
                                    <div class="apd-edu-level">Intermediate · 12th</div>
                                    <div class="apd-edu-school">{{ $athlete->academicDetail->twelfth_school_name ?? 'N/A' }}
                                    </div>
                                    <div class="apd-edu-meta-row">
                                        <div class="apd-edu-meta-item">
                                            <div class="apd-edu-meta-key">Board</div>
                                            <div class="apd-edu-meta-v">
                                                {{ $athlete->academicDetail->twelfthBoard->name ?? 'N/A' }}
                                            </div>
                                        </div>
                                        <div class="apd-edu-meta-item">
                                            <div class="apd-edu-meta-key">Stream</div>
                                            <div class="apd-edu-meta-v">
                                                {{  $athlete->academicDetail->twelfthStream->stream ?? 'N/A' }}
                                            </div>
                                        </div>
                                        <div class="apd-edu-meta-item">
                                            <div class="apd-edu-meta-key">Year of Passing</div>
                                            <div class="apd-edu-meta-v">
                                                {{ $athlete->academicDetail->twelfth_year ?? 'N/A' }}
                                            </div>
                                        </div>
                                        <div class="apd-edu-meta-item">
                                            <div class="apd-edu-meta-key">Result Type</div>
                                            <div class="apd-edu-meta-v">
                                                {{ $athlete->academicDetail->twelfth_result_type ?? 'N/A' }}
                                            </div>
                                        </div>
                                        <div class="apd-edu-meta-item">
                                            <div class="apd-edu-meta-key">Result</div>
                                            <div class="apd-edu-meta-v">
                                                {{ $athlete->academicDetail->twelfth_result ?? 'N/A' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="apd-edu-item">
                                <div class="apd-edu-dot"></div>
                                <div class="apd-edu-card">
                                    <div class="apd-edu-level">Diploma</div>
                                    <div class="apd-edu-school">
                                        {{ $athlete->academicDetail->diploma_college_name ?? 'N/A'}}
                                    </div>
                                    <div class="apd-edu-meta-row">
                                        <div class="apd-edu-meta-item">
                                            <div class="apd-edu-meta-key">Board</div>
                                            <div class="apd-edu-meta-v">
                                                {{ $athlete->academicDetail->diplomaBoard->board ?? 'N/A' }}
                                            </div>
                                        </div>
                                        <div class="apd-edu-meta-item">
                                            <div class="apd-edu-meta-key">Stream</div>
                                            <div class="apd-edu-meta-v">
                                                {{ $athlete->academicDetail->diplomaStream->stream ?? 'N/A' }}
                                            </div>
                                        </div>
                                        <div class="apd-edu-meta-item">
                                            <div class="apd-edu-meta-key">Year of Passing</div>
                                            <div class="apd-edu-meta-v">
                                                {{ $athlete->academicDetail->diploma_year ?? 'N/A' }}
                                            </div>
                                        </div>
                                        <div class="apd-edu-meta-item">
                                            <div class="apd-edu-meta-key">Result Type</div>
                                            <div class="apd-edu-meta-v">
                                                {{ $athlete->academicDetail->diploma_result_type ?? 'N/A' }}
                                            </div>
                                        </div>
                                        <div class="apd-edu-meta-item">
                                            <div class="apd-edu-meta-key">Result</div>
                                            <div class="apd-edu-meta-v">
                                                {{ $athlete->academicDetail->diploma_result ?? 'N/A' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="apd-edu-item">
                                <div class="apd-edu-dot"></div>
                                <div class="apd-edu-card">
                                    <div class="apd-edu-level">Graduation (If Applicable)</div>
                                    <div class="apd-edu-school">
                                        {{ $athlete->academicDetail->graduation_university ?? 'N/A' }}
                                    </div>
                                    <div class="apd-edu-meta-row">
                                        <div class="apd-edu-meta-item">
                                            <div class="apd-edu-meta-key">Degree</div>
                                            <div class="apd-edu-meta-v">
                                                {{ $athlete->academicDetail->degree->name ?? 'N/A' }}
                                            </div>
                                        </div>
                                        <div class="apd-edu-meta-item">
                                            <div class="apd-edu-meta-key">Major / Specialisation</div>
                                            <div class="apd-edu-meta-v">
                                                {{ $athlete->academicDetail->specialization ?? 'N/A' }}
                                            </div>
                                        </div>
                                        <div class="apd-edu-meta-item">
                                            <div class="apd-edu-meta-key">Year of Passing</div>
                                            <div class="apd-edu-meta-v">
                                                {{ $athlete->academicDetail->graduation_year ?? 'N/A' }}
                                            </div>
                                        </div>
                                        <div class="apd-edu-meta-item">
                                            <div class="apd-edu-meta-key">Result Type</div>
                                            <div class="apd-edu-meta-v">
                                                {{ $athlete->academicDetail->graduation_result_type ?? 'N/A' }}
                                            </div>
                                        </div>
                                        <div class="apd-edu-meta-item">
                                            <div class="apd-edu-meta-key">Result</div>
                                            <div class="apd-edu-meta-v">
                                                {{ $athlete->academicDetail->graduation_result ?? 'N/A' }}
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </section>

                <section class="apd-section-block" id="sports">
                    <div class="apd-section-heading">
                        <div class="apd-section-num">3</div>
                        <div class="apd-section-title">Sports Matrix</div>
                        <div class="apd-section-line"></div>
                    </div>
                    <div class="apd-card">

                        <div class="apd-subsec-title">Primary Support Profile</div>
                        <div class="apd-grid-4">
                            <div class="apd-field-group">
                                <div class="apd-field-label">Primary Sport</div>
                                <div class="apd-field-val">{{ $athlete->sportDetail->sport->name ?? 'N/A' }}</div>
                            </div>
                            <div class="apd-field-group">
                                <div class="apd-field-label">Current Club / Academy</div>
                                <div class="apd-field-val apd-field-empty">
                                    {{ $athlete->sportDetail->academy ?? 'N/A' }}
                                </div>
                            </div>
                            <div class="apd-field-group">
                                <div class="apd-field-label">Coach Name</div>
                                <div class="apd-field-val apd-field-empty">
                                    {{ $athlete->sportDetail->coach_name ?? 'N/A' }}
                                </div>
                            </div>
                            <div class="apd-field-group">
                                <div class="apd-field-label">Coach Contact</div>
                                <div class="apd-field-val apd-field-empty">
                                    {{ $athlete->sportDetail->coach_contact ?? 'N/A' }}
                                </div>
                            </div>
                            <div class="apd-field-group">
                                <div class="apd-field-label">Years of Training / Experience</div>
                                <div class="apd-field-val">{{ $athlete->sportDetail->training_experience ?? 'N/A' }}
                                </div>
                            </div>
                        </div>

                        <div class="apd-divider"></div>

                        <div class="apd-subsec-title">Physical Metrics</div>
                        <div class="apd-grid-4 grid-universitys">
                            <div class="apd-metric-tile">
                                <div class="apd-metric-val">{{ $athlete->sportDetail->height ?? 'N/A' }}<span
                                        class="apd-metric-unit">cm</span></div>
                                <div class="apd-metric-lbl">Height</div>
                            </div>
                            <div class="apd-metric-tile">
                                <div class="apd-metric-val">{{ $athlete->sportDetail->weight ?? 'N/A'}}<span
                                        class="apd-metric-unit">kg</span></div>
                                <div class="apd-metric-lbl">Weight</div>
                            </div>
                            <div class="apd-metric-tile">
                                <div class="apd-metric-val">{{ $athlete->sportDetail->wingspan ?? 'N/A' }}<span
                                        class="apd-metric-unit">cm</span></div>
                                <div class="apd-metric-lbl">Wingspan</div>
                            </div>
                            <div class="apd-metric-tile">
                                <div class="apd-metric-val">{{ $athlete->sportDetail->chest ?? 'N/A' }}<span
                                        class="apd-metric-unit">cm</span></div>
                                <div class="apd-metric-lbl">Chest</div>
                            </div>
                            <div class="apd-metric-tile">
                                <div class="apd-metric-val">{{ $athlete->sportDetail->waist ?? 'N/A' }}<span
                                        class="apd-metric-unit">cm</span></div>
                                <div class="apd-metric-lbl">Waist</div>
                            </div>
                            <div class="apd-metric-tile">
                                <div class="apd-metric-val">{{ $athlete->sportDetail->body_fat ?? 'N/A' }}</div>
                                <div class="apd-metric-lbl">Body Fat %</div>
                            </div>
                            <div class="apd-metric-tile">
                                <div class="apd-metric-val">{{ $athlete->sportDetail->fitness_level ?? 'N/A' }}
                                </div>
                                <div class="apd-metric-lbl">Fitness Level</div>
                            </div>
                        </div>

                        <div class="apd-divider"></div>

                        <div class="apd-subsec-title">Competition &amp; Ranking</div>
                        <div class="apd-grid-2">
                            <div>
                                <table class="apd-rank-table">
                                    <thead>
                                        <tr>
                                            <th>Level</th>
                                            <th>Ranking</th>
                                            <th>Age Category</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>State</td>
                                            <td class="apd-rank-highlight">
                                                {{ $athlete->sportDetail->state_ranking ?? 'N/A' }}
                                            </td>
                                            <td>{{ $athlete->sportDetail->state_age_category ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td>District</td>
                                            <td class="apd-rank-highlight">
                                                {{ $athlete->sportDetail->district_ranking ?? 'N/A' }}
                                            </td>
                                            <td>{{ $athlete->sportDetail->district_age_category ?? 'N/A'}}</td>
                                        </tr>
                                        <tr>
                                            <td>National</td>
                                            <td class="apd-rank-highlight">
                                                {{ $athlete->sportDetail->national_ranking ?? 'N/A' }}
                                            </td>
                                            <td>{{ $athlete->sportDetail->national_age_category ?? 'N/A' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div>
                                <div class="apd-field-group" style="margin-bottom:16px;">
                                    <div class="apd-field-label">Best Performance / Record</div>
                                    <div class="apd-field-val apd-field-empty">
                                        {{ $athlete->sportDetail->best_performance ?? 'N/A' }}
                                    </div>
                                </div>
                                <div class="apd-field-group">
                                    <div class="apd-field-label">International Participation</div>
                                    <div class="apd-field-val"><span class="apd-status-chip apd-status-green"><span
                                                class="apd-status-dot-g"></span>{{ $athlete->sportDetail->international_participation ?? 'N/A' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div style="margin-top:24px;">
                            <div class="apd-medal-row">
                                <div class="apd-medal-badge">
                                    <div class="apd-medal-icon">🥇</div>
                                    <div>
                                        <div class="apd-medal-num">{{ $athlete->sportDetail->gold_medal ?? 'N/A' }}
                                        </div>
                                        <div class="apd-medal-type">Gold Medals</div>
                                    </div>
                                </div>
                                <div class="apd-medal-badge">
                                    <div class="apd-medal-icon">🥈</div>
                                    <div>
                                        <div class="apd-medal-num">
                                            {{ $athlete->sportDetail->silver_medal ?? 'N/A' }}
                                        </div>
                                        <div class="apd-medal-type">Silver Medals</div>
                                    </div>
                                </div>
                                <div class="apd-medal-badge">
                                    <div class="apd-medal-icon">🥉</div>
                                    <div>
                                        <div class="apd-medal-num">
                                            {{ $athlete->sportDetail->bronze_medal ?? 'N/A' }}
                                        </div>
                                        <div class="apd-medal-type">Bronze Medals</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="apd-divider"></div>

                        <div class="apd-subsec-title">Injury / Medical Status</div>
                        <div class="apd-grid-32">

                            <div class="apd-field-group" style="margin-bottom:16px;">
                                <div class="apd-field-label">Previous Injuries</div>
                                <div class="apd-field-val"><span
                                        class="apd-injury-badge">{{ $athlete->sportDetail->previous_injury ?? 'N/A' }}</span>
                                </div>
                            </div>
                            <div class="apd-field-group">
                                <div class="apd-field-label">Recovery Status</div>
                                <div class="apd-field-val"><span class="apd-status-chip apd-status-blue"><span
                                            class="apd-status-dot-b"></span>{{ $athlete->sportDetail->recovery_status ?? 'N/A' }}</span>
                                </div>
                            </div>
                            <div class="apd-field-group">
                                <div class="apd-field-label">Injury Details</div>
                                <div class="apd-field-val apd-field-empty" style="min-height:70px;">
                                    {{ $athlete->sportDetail->injury_details ?? 'N/A' }}
                                </div>
                            </div>


                        </div>
                    </div>
                </section>

                <section class="apd-section-block" id="documents">
                    <div class="apd-section-heading">
                        <div class="apd-section-num">4</div>
                        <div class="apd-section-title">Documents &amp; References</div>
                        <div class="apd-section-line"></div>
                    </div>
                    <div class="apd-card">


                        <div class="apd-subsec-title">Academic Certificates</div>

                        <div class="apd-docs-grid">
                            @if(!empty($athlete->academicDetail->tenth_marksheet))
                                <div class="apd-doc-thumb">
                                    <div class="apd-doc-img-wrap">
                                        <div class="apd-doc-placeholder">
                                            <a href="{{ asset('athlete_assets/10_marksheet/' . $athlete->academicDetail->tenth_marksheet)}}"
                                                target="_blank">
                                                <img src="{{ asset('athlete_assets/10_marksheet/' . $athlete->academicDetail->tenth_marksheet)}}"
                                                    alt=""></a>
                                        </div>
                                    </div>
                                    <div class="apd-doc-meta">
                                        <div class="apd-doc-name">High School · 10th</div>
                                        <!-- <div class="apd-doc-status"><span class="apd-doc-status-dot"></span>Uploaded</div> -->
                                    </div>
                                </div>
                            @endif
                            @if(!empty($athlete->academicDetail->twelfth_marksheet))
                                <div class="apd-doc-thumb">
                                    <div class="apd-doc-img-wrap">
                                        <div class="apd-doc-placeholder">
                                            <a href="{{ asset('athlete_assets/12_marksheet/' . $athlete->academicDetail->twelfth_marksheet)}}"
                                                target="_blank">
                                                <img src="{{ asset('athlete_assets/12_marksheet/' . $athlete->academicDetail->twelfth_marksheet) }}"
                                                    alt=""></a>
                                        </div>
                                    </div>
                                    <div class="apd-doc-meta">
                                        <div class="apd-doc-name">Intermediate · 12th</div>
                                        <!-- <div class="apd-doc-status"><span class="apd-doc-status-dot"></span>Uploaded</div> -->
                                    </div>
                                </div>
                            @endif
                            @if(!empty($athlete->academicDetail->diploma_marksheet))
                                <div class="apd-doc-thumb">
                                    <div class="apd-doc-img-wrap">
                                        <div class="apd-doc-placeholder">
                                            <a href="{{ asset('athlete_assets/diploma_marksheet/' . $athlete->academicDetail->diploma_marksheet)}}"
                                                target="_blank">
                                                <img src="{{ asset('athlete_assets/diploma_marksheet/' . $athlete->academicDetail->diploma_marksheet) }}"
                                                    alt=""></a>
                                        </div>
                                    </div>
                                    <div class="apd-doc-meta">
                                        <div class="apd-doc-name">Diploma</div>

                                        <!-- <div class="apd-doc-status"><span class="apd-doc-status-dot"></span>Uploaded</div> -->
                                    </div>
                                </div>
                            @endif
                            @if(!empty($athlete->academicDetail->graduation_marksheet))
                                <div class="apd-doc-thumb">
                                    <div class="apd-doc-img-wrap">
                                        <div class="apd-doc-placeholder">
                                            <a href="{{ asset('athlete_assets/graduation_marksheet/' . $athlete->academicDetail->graduation_marksheet)}}"
                                                target="_blank">
                                                <img src="{{ asset('athlete_assets/graduation_marksheet/' . $athlete->academicDetail->graduation_marksheet) }}"
                                                    alt=""></a>
                                        </div>
                                    </div>
                                    <div class="apd-doc-meta">
                                        <div class="apd-doc-name">Graduation (If Applicable)</div>

                                        <!-- <div class="apd-doc-status"><span class="apd-doc-status-dot"></span>Uploaded</div> -->
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="apd-divider"></div>

                        <div class="apd-subsec-title">Mandatory Documents</div>
                        <div class="apd-docs-grid">
                            @if(!empty($athlete->document->profile_photo))
                                <div class="apd-doc-thumb">
                                    <div class="apd-doc-img-wrap">
                                        <div class="apd-doc-placeholder">
                                            <a href="{{ asset('athlete_assets/athlete_documents/' . $athlete->document->profile_photo) }}"
                                                target="_blank">
                                                <img src="{{ asset('athlete_assets/athlete_documents/' . $athlete->document->profile_photo) }}"
                                                    alt=""></a>
                                        </div>
                                    </div>
                                    <div class="apd-doc-meta">
                                        <div class="apd-doc-name">Profile Photo</div>

                                        <!-- <div class="apd-doc-status"><span class="apd-doc-status-dot"></span>Uploaded</div> -->
                                    </div>
                                </div>
                            @endif
                            @if(!empty($athlete->document->government_proof))
                                <div class="apd-doc-thumb">
                                    <div class="apd-doc-img-wrap">
                                        <div class="apd-doc-placeholder">
                                            <a href="{{ asset('athlete_assets/athlete_documents/' . $athlete->document->government_proof) }}"
                                                target="_blank">
                                                <img src="{{ asset('athlete_assets/athlete_documents/' . $athlete->document->government_proof) }}"
                                                    alt=""></a>
                                        </div>
                                    </div>
                                    <div class="apd-doc-meta">
                                        <div class="apd-doc-name">Government ID Proof</div>

                                        <!-- <div class="apd-doc-status"><span class="apd-doc-status-dot"></span>Uploaded</div> -->
                                    </div>
                                </div>
                            @endif
                            @if(!empty($athlete->document->dob_proof))
                                <div class="apd-doc-thumb">
                                    <div class="apd-doc-img-wrap">
                                        <div class="apd-doc-placeholder">
                                            <a href="{{ asset('athlete_assets/athlete_documents/' . $athlete->document->dob_proof) }}"
                                                target="_blank">
                                                <img src="{{ asset('athlete_assets/athlete_documents/' . $athlete->document->dob_proof) }}"
                                                    alt=""></a>
                                        </div>
                                    </div>
                                    <div class="apd-doc-meta">
                                        <div class="apd-doc-name">Birth Certificate</div>

                                        <!-- <div class="apd-doc-status"><span class="apd-doc-status-dot"></span>Uploaded</div> -->
                                    </div>
                                </div>
                            @endif
                            @if(!empty($athlete->document->address_proof))
                                <div class="apd-doc-thumb">
                                    <div class="apd-doc-img-wrap">
                                        <div class="apd-doc-placeholder">
                                            <a href="{{ asset('athlete_assets/athlete_documents/' . $athlete->document->address_proof) }}"
                                                target="_blank">
                                                <img src="{{ asset('athlete_assets/athlete_documents/' . $athlete->document->address_proof) }}"
                                                    alt=""></a>
                                        </div>
                                    </div>
                                    <div class="apd-doc-meta">
                                        <div class="apd-doc-name">Address Proof</div>

                                        <!-- <div class="apd-doc-status"><span class="apd-doc-status-dot"></span>Uploaded</div> -->
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="apd-divider"></div>

                        <div class="apd-subsec-title">Sports-Related Documents</div>
                        <div class="apd-docs-grid">
                            @if(!empty($athlete->document->sport_achievement))
                                <div class="apd-doc-thumb">
                                    <div class="apd-doc-img-wrap">
                                        <div class="apd-doc-placeholder">
                                            <a href="{{ asset('athlete_assets/athlete_documents/' . $athlete->document->sport_achievement) }}"
                                                target="_blank">
                                                <img src="{{ asset('athlete_assets/athlete_documents/' . $athlete->document->sport_achievement) }}"
                                                    alt=""></a>
                                        </div>
                                    </div>
                                    <div class="apd-doc-meta">
                                        <div class="apd-doc-name">Performance Certificate</div>

                                        <!-- <div class="apd-doc-status"><span class="apd-doc-status-dot"></span>Uploaded</div> -->
                                    </div>
                                </div>
                            @endif
                            @if(!empty($athlete->document->coach_recommendation))
                                <div class="apd-doc-thumb">
                                    <div class="apd-doc-img-wrap">
                                        <div class="apd-doc-placeholder">
                                            <a href="{{ asset('athlete_assets/athlete_documents/' . $athlete->document->coach_recommendation) }}"
                                                target="_blank">
                                                <img src="{{ asset('athlete_assets/athlete_documents/' . $athlete->document->coach_recommendation) }}"
                                                    alt=""></a>
                                        </div>
                                    </div>
                                    <div class="apd-doc-meta">
                                        <div class="apd-doc-name">Coach Recommendation</div>

                                        <!-- <div class="apd-doc-status"><span class="apd-doc-status-dot"></span>Uploaded</div> -->
                                    </div>
                                </div>
                            @endif
                            @if(!empty($athlete->document->medical_fitness))
                                <div class="apd-doc-thumb">
                                    <div class="apd-doc-img-wrap">
                                        <div class="apd-doc-placeholder">
                                            <a href="{{ asset('athlete_assets/athlete_documents/' . $athlete->document->medical_fitness) }}"
                                                target="_blank">

                                                <img src="{{ asset('athlete_assets/athlete_documents/' . $athlete->document->medical_fitness) }}"
                                                    alt=""></a>
                                        </div>
                                    </div>
                                    <div class="apd-doc-meta">
                                        <div class="apd-doc-name">Medical Fitness Certificate</div>

                                        <!-- <div class="apd-doc-status"><span class="apd-doc-status-dot"></span>Uploaded</div> -->
                                    </div>
                                </div>
                            @endif
                            @if(!empty($athlete->document->player_contract))
                                <div class="apd-doc-thumb">
                                    <div class="apd-doc-img-wrap">
                                        <div class="apd-doc-placeholder">
                                            <a href="{{ asset('athlete_assets/athlete_documents/' . $athlete->document->player_contract) }}"
                                                target="_blank">
                                                <img src="{{ asset('athlete_assets/athlete_documents/' . $athlete->document->player_contract) }}"
                                                    alt=""></a>
                                        </div>
                                    </div>
                                    <div class="apd-doc-meta">
                                        <div class="apd-doc-name">Player Contract</div>

                                        <!-- <div class="apd-doc-status"><span class="apd-doc-status-dot"></span>Uploaded</div> -->
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="apd-divider"></div>

                        <div class="apd-subsec-title">References</div>
                        <div class="apd-grid-2">
                            <div class="apd-ref-card grid-3s">
                                <div class="academic-detailss">
                                    <div class="apd-ref-icon">👤</div>
                                    <div class="apd-ref-body">
                                        <div class="apd-ref-name">{{ $athlete->document->reference_name1 ?? 'N/A' }}
                                        </div>
                                        <div class="apd-ref-role">{{ $athlete->document->reference_role1 ?? 'N/A' }}
                                        </div>
                                    </div>
                                </div>
                                <div class="apd-ref-detail">
                                    <span><i class="fa fa-university"></i><b>Organisation Name :</b>
                                        {{ $athlete->document->reference_academy1 ?? 'N/A' }}
                                    </span>
                                    <span> <i class="fas fa-user-friends"></i><b>Relation :</b>
                                        {{ $athlete->document->reference_relationship1 ?? 'N/A' }}</span>
                                    <span>
                                        <i class="fa fa-envelope"></i><b>Email :</b>
                                        {{ $athlete->document->reference_email1 ?? 'N/A' }}
                                    </span>
                                    <span>
                                        <i class="fa fa-phone-volume"></i><b>Phone :</b>
                                        {{ $athlete->document->reference_number1 ?? 'N/A' }}
                                    </span>
                                </div>
                            </div>

                            <div class="apd-ref-card grid-3s">
                                <div class="academic-detailss">
                                    <div class="apd-ref-icon">👤</div>
                                    <div class="apd-ref-body">
                                        <div class="apd-ref-name">{{ $athlete->document->reference_name2 ?? 'N/A' }}
                                        </div>
                                        <div class="apd-ref-role">{{ $athlete->document->reference_role2 ?? 'N/A' }}
                                        </div>
                                    </div>
                                </div>
                                <div class="apd-ref-detail">
                                    <span><i class="fa fa-university"></i><b>Organisation Name :</b>
                                        {{ $athlete->document->reference_academy2 ?? 'N/A' }}
                                    </span>
                                    <span> <i class="fas fa-user-friends"></i><b>Relation
                                            :</b>{{ $athlete->document->reference_relationship2 ?? 'N/A' }}</span>
                                    <span>
                                        <i class="fa fa-envelope"></i><b>Email :</b>
                                        {{ $athlete->document->reference_email2 ?? 'N/A' }}
                                    </span>
                                    <span>
                                        <i class="fa fa-phone-volume"></i><b>Phone :</b>
                                        {{ $athlete->document->reference_number2 ?? 'N/A' }}
                                    </span>
                                </div>
                            </div>

                        </div>

                    </div>
                </section>


            </div>

        </div>
    </div>
    <script>

        let videos = @json($videos);
        let currentIndex = 0;

        let video = document.getElementById("athleteVideo");
        let source = document.getElementById("videoSource");

        let videoTitle = document.getElementById("videoTitle");
        let videoAbout = document.getElementById("videoAbout");
        let videoTime = document.getElementById("videoTime");

        let videoCard = document.getElementById("videoCard");

        let scrolling = false;
        let videoActive = false;


        /* ---------------- LOAD VIDEO ---------------- */

        function loadVideo(index) {

            if (index < 0 || index >= videos.length) return;

            currentIndex = index;

            let videoData = videos[index];

            source.src = "{{ env('BUNNY_BASE_URL') }}/" + videoData.video;

            videoTitle.innerText = videoData.title ?? "N/A";
            videoAbout.innerText = videoData.about ?? "";
            videoTime.innerText = videoData.time ?? "";

            $(".likeBtn").attr("data-video", videoData.id);

            $("#likeCount").html((videoData.likes ?? 0) + " likes");

            // heart reset
            $(".likeBtn svg").css({
                fill: "none",
                stroke: "currentColor"
            });

            //  if already liked
            if (videoData.liked) {
                $(".likeBtn svg").css({
                    fill: "red",
                    stroke: "red"
                });
            }

            video.load();
            video.play();
        }


        /* ---------------- ACTIVATE CARD ---------------- */

        videoCard.addEventListener("click", function () {

            videoActive = true;
            videoCard.focus();

        });


        /* ---------------- DEACTIVATE CARD ---------------- */

        document.addEventListener("click", function (e) {

            if (!videoCard.contains(e.target)) {
                videoActive = false;
            }

        });


        /* ---------------- MOUSE SCROLL ---------------- */

        videoCard.addEventListener("wheel", function (e) {

            if (!videoActive) return;

            e.preventDefault();

            if (scrolling) return;

            scrolling = true;

            if (e.deltaY > 0) {
                loadVideo(currentIndex + 1);
            } else {
                loadVideo(currentIndex - 1);
            }

            setTimeout(() => {
                scrolling = false;
            }, 700);

        }, { passive: false });


        /* ---------------- KEYBOARD CONTROL ---------------- */

        window.addEventListener("keydown", function (e) {

            if (!videoActive) return;

            if (e.key === "PageDown" || e.key === "ArrowDown") {
                e.preventDefault();
                loadVideo(currentIndex + 1);
            }

            if (e.key === "PageUp" || e.key === "ArrowUp") {
                e.preventDefault();
                loadVideo(currentIndex - 1);
            }

        });

        document.addEventListener("DOMContentLoaded", function () {
            if (videos.length > 0) {
                loadVideo(0);
            }
        });

        function setActive(element, index) {

            loadVideo(index); // 🔥 ONLY THIS

            document.querySelectorAll('.igram-grid-card')
                .forEach(card => card.classList.remove('igram-grid-active'));

            element.classList.add('igram-grid-active');
        }
    </script>

    @push('scripts')
        <script>
            $(document).on("click", ".likeBtn", function () {

                let btn = $(this);
                let videoId = btn.data("video");

                $.ajax({
                    url: "{{ route('university.dashboard.like') }}",
                    type: "POST",
                    data: {
                        video_id: videoId,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (res) {

                        $("#likeCount").html(`${res.count} likes`);

                        //  important fix
                        videos[currentIndex].likes = res.count;
                        videos[currentIndex].liked = (res.status === "liked");

                        if (res.status === "liked") {
                            btn.find("svg").css({
                                fill: "red",
                                stroke: "red"
                            });
                        } else {
                            btn.find("svg").css({
                                fill: "none",
                                stroke: "currentColor"
                            });
                        }
                    }
                });

            });
        </script>
    @endpush


@endsection