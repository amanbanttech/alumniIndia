@extends('layout.frontend.app')
@section('content')



    <div class="find-university">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Find Your Perfect
                        University</h1>
                    <p>Explore thousands of universities worldwide and find the one that's right for you</p>
                    <div class="search-box">
                        <span><i class='fas fa-search'></i></span>
                        <input type="text" id="searchInput"
                            placeholder="Search universities, programs, or locations…" />
                        <button class="search-btn" onclick="doSearch()">Search</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="filters-bar-university">
        <div class="container-fluid">
            <div class="common-widthsections">
                <div class="row">
                    <div class="col-md-12">
                        <div class="university-search-univerisyt">
                            <div>
                                <span class="filter-label-university">Filter:</span>
                                <select id="countryFilter" onchange="renderCards()">
                                    <option value="">All countries</option>
                                    <option>United States</option>
                                    <option>United Kingdom</option>
                                    <option>India</option>
                                    <option>Germany</option>
                                    <option>Canada</option>
                                    <option>Australia</option>
                                </select>
                                <select id="typeFilter" onchange="renderCards()">
                                    <option value="">All types</option>
                                    <option>Public</option>
                                    <option>Private</option>
                                    <option>Research</option>
                                </select>
                                <select id="sortFilter" onchange="renderCards()">
                                    <option value="rank">Sort: Top ranked</option>
                                    <option value="rating">Sort: Highest rated</option>
                                    <option value="name">Sort: A–Z</option>
                                </select>
                            </div>
                            <span class="results-counts" id="countLabel">Showing 12 universities</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <section>
        <div class="container-fluid">
            <div class="common-widthsections">
                <div class="row">
                    <div class="col-md-12">
                        <div class="layout-university">

                            <aside class="sidebar">

                                <div class="sb-card">
                                    <div class="sb-head">
                                        <div class="sb-title">
                                            <div class="sb-icon"><i class="fas fa-globe-americas"></i></div>
                                            Location
                                        </div>
                                        <a href="#" class="sb-link"><i class="fas fa-times-circle"></i> Clear</a>
                                    </div>
                                    <div class="sb-body">

                                        <div class="facet" onclick="toggleCheck(this)">
                                            <div class="facet-left">
                                                <div class="fcheck checked"><i class="fas fa-check"></i></div>
                                                <span class="flabel">United States</span>
                                            </div>
                                            <span class="fbadge">4</span>
                                        </div>

                                        <div class="facet" onclick="toggleCheck(this)">
                                            <div class="facet-left">
                                                <div class="fcheck checked"><i class="fas fa-check"></i></div>
                                                <span class="flabel">United Kingdom</span>
                                            </div>
                                            <span class="fbadge">3</span>
                                        </div>

                                        <div class="facet" onclick="toggleCheck(this)">
                                            <div class="facet-left">
                                                <div class="fcheck"><i class="fas fa-check"></i></div>
                                                <span class="flabel">India</span>
                                            </div>
                                            <span class="fbadge">1</span>
                                        </div>

                                        <div class="facet" onclick="toggleCheck(this)">
                                            <div class="facet-left">
                                                <div class="fcheck"><i class="fas fa-check"></i></div>
                                                <span class="flabel">Germany</span>
                                            </div>
                                            <span class="fbadge">1</span>
                                        </div>

                                        <div class="facet" onclick="toggleCheck(this)">
                                            <div class="facet-left">
                                                <div class="fcheck"><i class="fas fa-check"></i></div>
                                                <span class="flabel">Canada</span>
                                            </div>
                                            <span class="fbadge">2</span>
                                        </div>

                                        <div class="facet" onclick="toggleCheck(this)">
                                            <div class="facet-left">
                                                <div class="fcheck"><i class="fas fa-check"></i></div>
                                                <span class="flabel">Australia</span>
                                            </div>
                                            <span class="fbadge">1</span>
                                        </div>

                                    </div>
                                </div>


                                <div class="sb-card">
                                    <div class="sb-head">
                                        <div class="sb-title">
                                            <div class="sb-icon"><i class="fas fa-book-open"></i></div>
                                            Programs &amp; Courses
                                        </div>
                                        <a href="#" class="sb-link"><i class="fas fa-list"></i> All</a>
                                    </div>
                                    <div class="sb-body">
                                        <div class="prog-category">
                                            <input type="checkbox" id="cat-eng" class="cat-toggle" />
                                            <label class="prog-cat-head" for="cat-eng">
                                                <div class="prog-cat-left">
                                                    <div class="prog-cat-icon"><i class="fas fa-cogs"></i></div>
                                                    <span class="prog-cat-label">Engineering</span>
                                                </div>
                                                <div class="prog-cat-right">
                                                    <span class="prog-cat-count">6</span>
                                                    <i class="fas fa-chevron-down prog-cat-arrow"></i>
                                                </div>
                                            </label>
                                            <div class="prog-cat-body">
                                                <a href="#" class="sub-chip"><i class="fas fa-microchip"></i> Computer
                                                    Engineering</a>
                                                <a href="#" class="sub-chip"><i class="fas fa-bolt"></i> Electrical
                                                    Engineering</a>
                                                <a href="#" class="sub-chip"><i class="fas fa-hard-hat"></i> Civil
                                                    Engineering</a>
                                                <a href="#" class="sub-chip"><i class="fas fa-industry"></i> Mechanical
                                                    Engineering</a>
                                                <a href="#" class="sub-chip"><i class="fas fa-flask"></i> Chemical
                                                    Engineering</a>
                                                <a href="#" class="sub-chip"><i class="fas fa-satellite-dish"></i>
                                                    Aerospace Engineering</a>
                                            </div>
                                        </div>

                                        <div class="prog-category">
                                            <input type="checkbox" id="cat-med" class="cat-toggle" />
                                            <label class="prog-cat-head" for="cat-med">
                                                <div class="prog-cat-left">
                                                    <div class="prog-cat-icon"><i class="fas fa-heartbeat"></i></div>
                                                    <span class="prog-cat-label">Medicine &amp; Health</span>
                                                </div>
                                                <div class="prog-cat-right">
                                                    <span class="prog-cat-count">5</span>
                                                    <i class="fas fa-chevron-down prog-cat-arrow"></i>
                                                </div>
                                            </label>
                                            <div class="prog-cat-body">
                                                <a href="#" class="sub-chip"><i class="fas fa-stethoscope"></i> MBBS /
                                                    MD</a>
                                                <a href="#" class="sub-chip"><i class="fas fa-tooth"></i> Dentistry</a>
                                                <a href="#" class="sub-chip"><i class="fas fa-pills"></i> Pharmacy</a>
                                                <a href="#" class="sub-chip"><i class="fas fa-notes-medical"></i>
                                                    Nursing</a>
                                                <a href="#" class="sub-chip"><i class="fas fa-dna"></i> Biomedical
                                                    Science</a>
                                            </div>
                                        </div>

                                        <div class="prog-category">
                                            <input type="checkbox" id="cat-biz" class="cat-toggle" />
                                            <label class="prog-cat-head" for="cat-biz">
                                                <div class="prog-cat-left">
                                                    <div class="prog-cat-icon"><i class="fas fa-briefcase"></i></div>
                                                    <span class="prog-cat-label">Business</span>
                                                </div>
                                                <div class="prog-cat-right">
                                                    <span class="prog-cat-count">5</span>
                                                    <i class="fas fa-chevron-down prog-cat-arrow"></i>
                                                </div>
                                            </label>
                                            <div class="prog-cat-body">
                                                <a href="#" class="sub-chip"><i class="fas fa-chart-line"></i> MBA</a>
                                                <a href="#" class="sub-chip"><i class="fas fa-file-invoice-dollar"></i>
                                                    Accounting &amp; Finance</a>
                                                <a href="#" class="sub-chip"><i class="fas fa-bullhorn"></i>
                                                    Marketing</a>
                                                <a href="#" class="sub-chip"><i class="fas fa-handshake"></i> Human
                                                    Resources</a>
                                                <a href="#" class="sub-chip"><i class="fas fa-globe"></i> International
                                                    Business</a>
                                            </div>
                                        </div>

                                        <div class="prog-category">
                                            <input type="checkbox" id="cat-law" class="cat-toggle" />
                                            <label class="prog-cat-head" for="cat-law">
                                                <div class="prog-cat-left">
                                                    <div class="prog-cat-icon"><i class="fas fa-gavel"></i></div>
                                                    <span class="prog-cat-label">Law</span>
                                                </div>
                                                <div class="prog-cat-right">
                                                    <span class="prog-cat-count">4</span>
                                                    <i class="fas fa-chevron-down prog-cat-arrow"></i>
                                                </div>
                                            </label>
                                            <div class="prog-cat-body">
                                                <a href="#" class="sub-chip"><i class="fas fa-balance-scale"></i>
                                                    Corporate Law</a>
                                                <a href="#" class="sub-chip"><i class="fas fa-user-shield"></i> Criminal
                                                    Law</a>
                                                <a href="#" class="sub-chip"><i class="fas fa-landmark"></i>
                                                    Constitutional Law</a>
                                                <a href="#" class="sub-chip"><i class="fas fa-globe-europe"></i>
                                                    International Law</a>
                                            </div>
                                        </div>

                                        <div class="prog-category">
                                            <input type="checkbox" id="cat-cs" class="cat-toggle" />
                                            <label class="prog-cat-head" for="cat-cs">
                                                <div class="prog-cat-left">
                                                    <div class="prog-cat-icon"><i class="fas fa-laptop-code"></i></div>
                                                    <span class="prog-cat-label">Computer Science</span>
                                                </div>
                                                <div class="prog-cat-right">
                                                    <span class="prog-cat-count">6</span>
                                                    <i class="fas fa-chevron-down prog-cat-arrow"></i>
                                                </div>
                                            </label>
                                            <div class="prog-cat-body">
                                                <a href="#" class="sub-chip"><i class="fas fa-robot"></i> Artificial
                                                    Intelligence</a>
                                                <a href="#" class="sub-chip"><i class="fas fa-shield-alt"></i> Cyber
                                                    Security</a>
                                                <a href="#" class="sub-chip"><i class="fas fa-database"></i> Data
                                                    Science</a>
                                                <a href="#" class="sub-chip"><i class="fas fa-cloud"></i> Cloud
                                                    Computing</a>
                                                <a href="#" class="sub-chip"><i class="fas fa-code"></i> Software
                                                    Engineering</a>
                                                <a href="#" class="sub-chip"><i class="fas fa-network-wired"></i>
                                                    Networking</a>
                                            </div>
                                        </div>

                                        <div class="prog-category">
                                            <input type="checkbox" id="cat-arts" class="cat-toggle" />
                                            <label class="prog-cat-head" for="cat-arts">
                                                <div class="prog-cat-left">
                                                    <div class="prog-cat-icon"><i class="fas fa-palette"></i></div>
                                                    <span class="prog-cat-label">Arts &amp; Design</span>
                                                </div>
                                                <div class="prog-cat-right">
                                                    <span class="prog-cat-count">4</span>
                                                    <i class="fas fa-chevron-down prog-cat-arrow"></i>
                                                </div>
                                            </label>
                                            <div class="prog-cat-body">
                                                <a href="#" class="sub-chip"><i class="fas fa-paint-brush"></i> Fine
                                                    Arts</a>
                                                <a href="#" class="sub-chip"><i class="fas fa-pencil-ruler"></i> Graphic
                                                    Design</a>
                                                <a href="#" class="sub-chip"><i class="fas fa-film"></i> Media &amp;
                                                    Film</a>
                                                <a href="#" class="sub-chip"><i class="fas fa-music"></i> Music</a>
                                            </div>
                                        </div>

                                        <div class="prog-category">
                                            <input type="checkbox" id="cat-arch" class="cat-toggle" />
                                            <label class="prog-cat-head" for="cat-arch">
                                                <div class="prog-cat-left">
                                                    <div class="prog-cat-icon"><i class="fas fa-drafting-compass"></i>
                                                    </div>
                                                    <span class="prog-cat-label">Architecture</span>
                                                </div>
                                                <div class="prog-cat-right">
                                                    <span class="prog-cat-count">3</span>
                                                    <i class="fas fa-chevron-down prog-cat-arrow"></i>
                                                </div>
                                            </label>
                                            <div class="prog-cat-body">
                                                <a href="#" class="sub-chip"><i class="fas fa-building"></i> Urban
                                                    Design</a>
                                                <a href="#" class="sub-chip"><i class="fas fa-home"></i> Interior
                                                    Design</a>
                                                <a href="#" class="sub-chip"><i class="fas fa-city"></i> Landscape
                                                    Architecture</a>
                                            </div>
                                        </div>

                                        <div class="prog-category">
                                            <input type="checkbox" id="cat-sci" class="cat-toggle" />
                                            <label class="prog-cat-head" for="cat-sci">
                                                <div class="prog-cat-left">
                                                    <div class="prog-cat-icon"><i class="fas fa-atom"></i></div>
                                                    <span class="prog-cat-label">Science</span>
                                                </div>
                                                <div class="prog-cat-right">
                                                    <span class="prog-cat-count">5</span>
                                                    <i class="fas fa-chevron-down prog-cat-arrow"></i>
                                                </div>
                                            </label>
                                            <div class="prog-cat-body">
                                                <a href="#" class="sub-chip"><i class="fas fa-atom"></i> Physics</a>
                                                <a href="#" class="sub-chip"><i class="fas fa-vials"></i> Chemistry</a>
                                                <a href="#" class="sub-chip"><i class="fas fa-dna"></i> Biology</a>
                                                <a href="#" class="sub-chip"><i class="fas fa-star"></i> Astronomy</a>
                                                <a href="#" class="sub-chip"><i class="fas fa-leaf"></i> Environmental
                                                    Science</a>
                                            </div>
                                        </div>

                                        <div class="prog-category">
                                            <input type="checkbox" id="cat-soc" class="cat-toggle" />
                                            <label class="prog-cat-head" for="cat-soc">
                                                <div class="prog-cat-left">
                                                    <div class="prog-cat-icon"><i class="fas fa-users"></i></div>
                                                    <span class="prog-cat-label">Social Sciences</span>
                                                </div>
                                                <div class="prog-cat-right">
                                                    <span class="prog-cat-count">4</span>
                                                    <i class="fas fa-chevron-down prog-cat-arrow"></i>
                                                </div>
                                            </label>
                                            <div class="prog-cat-body">
                                                <a href="#" class="sub-chip"><i class="fas fa-brain"></i> Psychology</a>
                                                <a href="#" class="sub-chip"><i class="fas fa-chart-bar"></i>
                                                    Economics</a>
                                                <a href="#" class="sub-chip"><i class="fas fa-globe-asia"></i> Political
                                                    Science</a>
                                                <a href="#" class="sub-chip"><i class="fas fa-people-arrows"></i>
                                                    Sociology</a>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </aside>

                            <div>
                                <div class="card-grid">


                                    <div class="uni-card">
                                        <div class="card-banner c-banner-1">
                                            <img src="{{ asset('frontend_assets/assets/images/donation-image.jpg') }}" alt="">
                                        </div>
                                        <div class="card-body">
                                            <div class="card-identity">
                                                <div class="uni-ava"><i class="fas fa-flask"></i></div>
                                                <div class="card-chips">
                                                    <span class="chip chip-blue"><i class="fas fa-lock"></i>
                                                        Engineering</span>

                                                    <!-- <span class="chip chip-orange"><i class="fas fa-cogs"></i>
                                                        Engineering</span> -->
                                                </div>
                                            </div>
                                            <a href="{{ route('university.details') }}">
                                                <div class="uni-name">Massachusetts Institute of Technology</div>
                                            </a>
                                            <div class="uni-loc"><i class="fas fa-map-marker-alt"></i> Cambridge, USA
                                            </div>
                                            <div class="card-stars">
                                                <div class="stars">
                                                    <i class="fas fa-star s-full"></i><i class="fas fa-star s-full"></i>
                                                    <i class="fas fa-star s-full"></i><i class="fas fa-star s-full"></i>
                                                    <i class="fas fa-star s-full"></i>
                                                </div>
                                                <span class="rnum">4.9</span><span class="rcnt">/ 5.0</span>
                                            </div>
                                            <div class="card-line"></div>

                                            <div class="card-foot">
                                                <a href="{{ route('university.details') }}" class="btn-main"><i
                                                        class="fas fa-compass"></i> Explore
                                                    University</a>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="uni-card">
                                        <div class="card-banner c-banner-1">
                                            <img src="{{ asset('frontend_assets/assets/images/donation-image.jpg') }}" alt="">
                                        </div>
                                        <div class="card-body">
                                            <div class="card-identity">
                                                <div class="uni-ava"><i class="fas fa-scroll"></i></div>
                                                <div class="card-chips">
                                                    <span class="chip chip-blue"><i class="fas fa-lock"></i>
                                                        Engineering</span>

                                                    <!-- <span class="chip chip-orange"><i class="fas fa-cogs"></i>
                                                                                                        Engineering</span> -->
                                                </div>
                                            </div>
                                            <a href="#">
                                                <div class="uni-name">University of Oxford</div>
                                            </a>
                                            <div class="uni-loc"><i class="fas fa-map-marker-alt"></i> Oxford, UK</div>
                                            <div class="card-stars">
                                                <div class="stars">
                                                    <i class="fas fa-star s-full"></i><i class="fas fa-star s-full"></i>
                                                    <i class="fas fa-star s-full"></i><i class="fas fa-star s-full"></i>
                                                    <i class="fas fa-star s-full"></i>
                                                </div>
                                                <span class="rnum">4.9</span><span class="rcnt">/ 5.0</span>
                                            </div>
                                            <div class="card-line"></div>

                                            <div class="card-foot">
                                                <a href="{{ route('university.details') }}" class="btn-main"><i
                                                        class="fas fa-compass"></i> Explore
                                                    University</a>

                                            </div>
                                        </div>
                                    </div>


                                    <div class="uni-card">
                                        <div class="card-banner c-banner-1">
                                            <img src="{{ asset('frontend_assets/assets/images/donation-image.jpg') }}" alt="">
                                        </div>
                                        <div class="card-body">
                                            <div class="card-identity">
                                                <div class="uni-ava"><i class="fas fa-landmark"></i></div>
                                                <div class="card-chips">
                                                    <span class="chip chip-blue"><i class="fas fa-lock"></i>
                                                        Engineering</span>

                                                    <!-- <span class="chip chip-orange"><i class="fas fa-cogs"></i>
                                                                                                        Engineering</span> -->
                                                </div>
                                            </div>
                                            <a href="{{ route('university.details') }}">
                                                <div class="uni-name">Harvard University</div>
                                            </a>
                                            <div class="uni-loc"><i class="fas fa-map-marker-alt"></i> Cambridge, USA
                                            </div>
                                            <div class="card-stars">
                                                <div class="stars">
                                                    <i class="fas fa-star s-full"></i><i class="fas fa-star s-full"></i>
                                                    <i class="fas fa-star s-full"></i><i class="fas fa-star s-full"></i>
                                                    <i class="far fa-star s-empty"></i>
                                                </div>
                                                <span class="rnum">4.8</span><span class="rcnt">/ 5.0</span>
                                            </div>
                                            <div class="card-line"></div>

                                            <div class="card-foot">
                                                <a href="{{ route('university.details') }}" class="btn-main"><i
                                                        class="fas fa-compass"></i> Explore
                                                    University</a>

                                            </div>
                                        </div>
                                    </div>


                                    <div class="uni-card">
                                        <div class="card-banner c-banner-1">
                                            <img src="{{ asset('frontend_assets/assets/images/donation-image.jpg') }}" alt="">
                                        </div>
                                        <div class="card-body">
                                            <div class="card-identity">
                                                <div class="uni-ava"><i class="fas fa-tree"></i></div>
                                                <div class="card-chips">
                                                    <span class="chip chip-blue"><i class="fas fa-lock"></i>
                                                        Engineering</span>

                                                    <!-- <span class="chip chip-orange"><i class="fas fa-cogs"></i>
                                                                                                        Engineering</span> -->
                                                </div>
                                            </div>
                                            <a href="{{ route('university.details') }}">
                                                <div class="uni-name">Stanford University</div>
                                            </a>
                                            <div class="uni-loc"><i class="fas fa-map-marker-alt"></i> Stanford, USA
                                            </div>
                                            <div class="card-stars">
                                                <div class="stars">
                                                    <i class="fas fa-star s-full"></i><i class="fas fa-star s-full"></i>
                                                    <i class="fas fa-star s-full"></i><i class="fas fa-star s-full"></i>
                                                    <i class="far fa-star s-empty"></i>
                                                </div>
                                                <span class="rnum">4.8</span><span class="rcnt">/ 5.0</span>
                                            </div>
                                            <div class="card-line"></div>

                                            <div class="card-foot">
                                                <a href="{{ route('university.details') }}" class="btn-main"><i
                                                        class="fas fa-compass"></i> Explore
                                                    University</a>

                                            </div>
                                        </div>
                                    </div>


                                    <div class="uni-card">
                                        <div class="card-banner c-banner-1">
                                            <img src="{{ asset('frontend_assets/assets/images/donation-image.jpg') }}" alt="">
                                        </div>
                                        <div class="card-body">
                                            <div class="card-identity">
                                                <div class="uni-ava"><i class="fas fa-cog"></i></div>
                                                <div class="card-chips">
                                                    <span class="chip chip-blue"><i class="fas fa-lock"></i>
                                                        Engineering</span>

                                                    <!-- <span class="chip chip-orange"><i class="fas fa-cogs"></i>
                                                                                                        Engineering</span> -->
                                                </div>
                                            </div>
                                            <a href="{{ route('university.details') }}">
                                                <div class="uni-name">ETH Zurich</div>
                                            </a>
                                            <div class="uni-loc"><i class="fas fa-map-marker-alt"></i> Zurich, Germany
                                            </div>
                                            <div class="card-stars">
                                                <div class="stars">
                                                    <i class="fas fa-star s-full"></i><i class="fas fa-star s-full"></i>
                                                    <i class="fas fa-star s-full"></i><i class="fas fa-star s-full"></i>
                                                    <i class="far fa-star s-empty"></i>
                                                </div>
                                                <span class="rnum">4.7</span><span class="rcnt">/ 5.0</span>
                                            </div>
                                            <div class="card-line"></div>

                                            <div class="card-foot">
                                                <a href="{{ route('university.details') }}" class="btn-main"><i
                                                        class="fas fa-compass"></i> Explore
                                                    University</a>

                                            </div>
                                        </div>
                                    </div>


                                    <div class="uni-card">
                                        <div class="card-banner c-banner-1">
                                            <img src="{{ asset('frontend_assets/assets/images/donation-image.jpg') }}" alt="">
                                        </div>
                                        <div class="card-body">
                                            <div class="card-identity">
                                                <div class="uni-ava"><i class="fas fa-chess-rook"></i></div>
                                                <div class="card-chips">
                                                    <span class="chip chip-blue"><i class="fas fa-lock"></i>
                                                        Engineering</span>

                                                    <!-- <span class="chip chip-orange"><i class="fas fa-cogs"></i>
                                                                                                        Engineering</span> -->
                                                </div>
                                            </div>
                                            <a href="#">
                                                <div class="uni-name">University of Cambridge</div>
                                            </a>
                                            <div class="uni-loc"><i class="fas fa-map-marker-alt"></i> Cambridge, UK
                                            </div>
                                            <div class="card-stars">
                                                <div class="stars">
                                                    <i class="fas fa-star s-full"></i><i class="fas fa-star s-full"></i>
                                                    <i class="fas fa-star s-full"></i><i class="fas fa-star s-full"></i>
                                                    <i class="far fa-star s-empty"></i>
                                                </div>
                                                <span class="rnum">4.8</span><span class="rcnt">/ 5.0</span>
                                            </div>
                                            <div class="card-line"></div>

                                            <div class="card-foot">
                                                <a href="{{ route('university.details') }}" class="btn-main"><i
                                                        class="fas fa-compass"></i> Explore
                                                    University</a>

                                            </div>
                                        </div>
                                    </div>


                                    <div class="uni-card">
                                        <div class="card-banner c-banner-1">
                                            <img src="{{ asset('frontend_assets/assets/images/donation-image.jpg') }}" alt="">
                                        </div>
                                        <div class="card-body">
                                            <div class="card-identity">
                                                <div class="uni-ava"><i class="fas fa-microchip"></i></div>
                                                <div class="card-chips">
                                                    <span class="chip chip-blue"><i class="fas fa-lock"></i>
                                                        Engineering</span>

                                                    <!-- <span class="chip chip-orange"><i class="fas fa-cogs"></i>
                                                                                                        Engineering</span> -->
                                                </div>
                                            </div>
                                            <a href="#">
                                                <div class="uni-name">IIT Bombay</div>
                                            </a>
                                            <div class="uni-loc"><i class="fas fa-map-marker-alt"></i> Mumbai, India
                                            </div>
                                            <div class="card-stars">
                                                <div class="stars">
                                                    <i class="fas fa-star s-full"></i><i class="fas fa-star s-full"></i>
                                                    <i class="fas fa-star s-full"></i><i class="fas fa-star s-full"></i>
                                                    <i class="far fa-star s-empty"></i>
                                                </div>
                                                <span class="rnum">4.7</span><span class="rcnt">/ 5.0</span>
                                            </div>
                                            <div class="card-line"></div>

                                            <div class="card-foot">
                                                <a href="{{ route('university.details') }}" class="btn-main"><i
                                                        class="fas fa-compass"></i> Explore
                                                    University</a>

                                            </div>
                                        </div>
                                    </div>


                                    <div class="uni-card">
                                        <div class="card-banner c-banner-1">
                                            <img src="{{ asset('frontend_assets/assets/images/donation-image.jpg') }}" alt="">
                                        </div>
                                        <div class="card-body">
                                            <div class="card-identity">
                                                <div class="uni-ava"><i class="fas fa-leaf"></i></div>
                                                <div class="card-chips">
                                                    <span class="chip chip-blue"><i class="fas fa-lock"></i>
                                                        Engineering</span>

                                                    <!-- <span class="chip chip-orange"><i class="fas fa-cogs"></i>
                                                                                                        Engineering</span> -->
                                                </div>
                                            </div>
                                            <a href="#">
                                                <div class="uni-name">University of Toronto</div>
                                            </a>
                                            <div class="uni-loc"><i class="fas fa-map-marker-alt"></i> Toronto, Canada
                                            </div>
                                            <div class="card-stars">
                                                <div class="stars">
                                                    <i class="fas fa-star s-full"></i><i class="fas fa-star s-full"></i>
                                                    <i class="fas fa-star s-full"></i><i class="fas fa-star s-full"></i>
                                                    <i class="far fa-star s-empty"></i>
                                                </div>
                                                <span class="rnum">4.6</span><span class="rcnt">/ 5.0</span>
                                            </div>
                                            <div class="card-line"></div>

                                            <div class="card-foot">
                                                <a href="{{ route('university.details') }}" class="btn-main"><i
                                                        class="fas fa-compass"></i> Explore
                                                    University</a>

                                            </div>
                                        </div>
                                    </div>


                                    <div class="uni-card">
                                        <div class="card-banner c-banner-1">
                                            <img src="{{ asset('frontend_assets/assets/images/donation-image.jpg') }}" alt="">
                                        </div>
                                        <div class="card-body">
                                            <div class="card-identity">
                                                <div class="uni-ava"><i class="fas fa-satellite-dish"></i></div>
                                                <div class="card-chips">
                                                    <span class="chip chip-blue"><i class="fas fa-lock"></i>
                                                        Engineering</span>

                                                    <!-- <span class="chip chip-orange"><i class="fas fa-cogs"></i>
                                                                                                        Engineering</span> -->
                                                </div>
                                            </div>
                                            <a href="#">
                                                <div class="uni-name">Imperial College London</div>
                                            </a>
                                            <div class="uni-loc"><i class="fas fa-map-marker-alt"></i> London, UK</div>
                                            <div class="card-stars">
                                                <div class="stars">
                                                    <i class="fas fa-star s-full"></i><i class="fas fa-star s-full"></i>
                                                    <i class="fas fa-star s-full"></i><i class="fas fa-star s-full"></i>
                                                    <i class="far fa-star s-empty"></i>
                                                </div>
                                                <span class="rnum">4.6</span><span class="rcnt">/ 5.0</span>
                                            </div>
                                            <div class="card-line"></div>

                                            <div class="card-foot">
                                                <a href="{{ route('university.details') }}" class="btn-main"><i
                                                        class="fas fa-compass"></i> Explore
                                                    University</a>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

   

@endsection