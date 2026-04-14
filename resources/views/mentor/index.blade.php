@extends('layout.mentor.app')

@section('content')
    <style>
        .like-heart {
            width: 22px;
            height: 22px;
            stroke: #2c3e50;
            /* dark outline */
            fill: none;
            stroke-width: 2;
            cursor: pointer;
            transition: 0.2s ease;
        }

        /*  when liked */
        .like-heart.liked {
            fill: red;
            stroke: red;
        }
    </style>
    @php
        $status = $status ?? 'default';
        $allVideos = $allVideos ?? [];

        // DEFAULT (no search)
        if ($status === 'default') {
            foreach ($athletes as $ath) {
                foreach ($ath->videos as $v) {
                    $allVideos[] = [
                        'id' => $v->id,
                        'video' => $v->video,
                        'title' => $v->title,
                        'about' => $v->about,
                        'likes' => $v->likes->count(),
                        'liked' => $v->likes->where('user_id', auth()->id())->count() > 0,
                        'time' => $v->created_at->diffForHumans(),
                        'name' => $ath->user->name ?? 'N/A',
                        'country' => $ath->nationality->country_name ?? 'N/A',
                        'profile' => $ath->document->profile_photo ?? 'default.png'
                    ];
                }
            }
        }
    @endphp
    <div class="content-wrapper">
        <div class="commmon-crads">

            <div id="videosData" data-videos='@json($allVideos)'></div>
            <div class="row mb-4">
                <div class="col-12 text-center univerisyt-headin">
                    <div class="heaing-alls">
                        <h1>My Dashboard</h1>
                    </div>
                    <div class="layout-reels">


                        <main class="center-feed">
                            <div class="reels-search-bar">
                                <div class="reels-search-inner">
                                    <div class="reels-search-wrap">
                                        <span class="reels-search-icon">
                                            <svg width="17" height="17" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2.2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <circle cx="11" cy="11" r="8" />
                                                <line x1="21" y1="21" x2="16.65" y2="16.65" />
                                            </svg>
                                        </span>
                                        <input type="text" id="searchInput" class="reels-search-input"
                                            placeholder="Search reels by athlete name..." />

                                    </div>
                                </div>
                            </div>

                            @if($status === 'no_athlete')

                                <div class="post-card text-center p-5">
                                    <h3>No athlete found with this name</h3>
                                </div>

                            @elseif($status === 'no_video')

                                <div class="post-card text-center p-5">
                                    <h3>No video found</h3>
                                </div>

                            @else

                                @if(count($allVideos) > 0)
                                    <div class="post-card">
                                        <!-- HEADER -->
                                        <div class="post-header">
                                            <div class="post-user">
                                                <div class="user-avatar">
                                                    <img id="profileImg"
                                                        src="{{ asset('athlete_assets/athlete_documents/' . ($allVideos[0]['profile'] ?? 'default.png')) }}">
                                                </div>
                                                <div>
                                                    <div class="user-name" id="userName">{{ $allVideos[0]['name'] ?? 'N/A' }}</div>
                                                    <div class="user-location" id="userCountry">
                                                        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="#6b7a8f"
                                                            stroke-width="2">
                                                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z" />
                                                            <circle cx="12" cy="10" r="3" />
                                                        </svg>
                                                        {{ $allVideos[0]['country'] ?? 'N/A' }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- VIDEO -->

                                        <div class="post-image-wrap">
                                            <video id="athleteVideo" controls autoplay muted loop width="100%">
                                                <source id="videoSource"
                                                    src="{{ env('BUNNY_BASE_URL') . '/' . ($allVideos[0]['video'] ?? '') }}">
                                            </video>
                                        </div>
                                        <!-- ACTIONS (like) -->

                                        <div class="post-actions">
                                            <div class="action-left">
                                                <button class="action-btn likeBtn" id="likeBtn"
                                                    data-video="{{ $allVideos[0]['id'] ?? '' }}">

                                                    <svg class="like-heart" viewBox="0 0 24 24">
                                                        <path
                                                            d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
                                                    </svg>

                                                </button>

                                            </div>

                                        </div>
                                        <!-- LIKE COUNT -->
                                        <div class="post-likes" id="likeCount">
                                            {{ $allVideos[0]['likes'] ?? 0 }} likes
                                        </div>
                                        <!-- CAPTION -->
                                        <div class="post-caption">
                                            <strong id="videoTitle">{{ $allVideos[0]['title'] ?? '' }}</strong>
                                            <span id="videoAbout">{{ $allVideos[0]['about'] ?? '' }}</span>
                                        </div>


                                        <div class="post-time" id="videoTime">
                                            {{ $allVideos[0]['time'] ?? '' }}
                                        </div>
                                    </div>
                                @endif
                            @endif
                        </main>

                        <aside class="sidebar">
                            <div class="sidebar-label">Suggested For You</div>

                            <div class="grid-top-videos">
                                @if($status !== 'no_athlete' && $status !== 'no_video')
                                    @foreach($allVideos as $index => $video)
                                        <div class="video-card" onclick="loadVideo({{ $index }})">
                                            <div class="thumb-wrap">
                                                <video muted preload="metadata" playsinline>
                                                    <source src="{{ env('BUNNY_BASE_URL') . '/' . $video['video'] }}#t=0.5">
                                                </video>

                                            </div>
                                            <div class="video-info">
                                                <div class="channel-row">
                                                    <div class="channel-avatar">
                                                        <img
                                                            src="{{ asset('athlete_assets/athlete_documents/' . $video['profile']) }}">
                                                    </div>
                                                    <div class="channel-name">{{ $video['name'] }}</div>
                                                </div>

                                                <div class="video-title">{{ $video['title'] }}</div>
                                                <div class="video-meta">{{ $video['time'] }}</div>
                                            </div>
                                        </div>

                                    @endforeach
                                @endif
                            </div>
                        </aside>


                    </div>




                </div>
            </div>
        </div>

    </div>

    @push('scripts')
        <script>
            let videos = @json($allVideos);
            let currentIndex = 0;
            let isActive = false;
            let currentRequest = null;
            // ================= DEBOUNCE FUNCTION =================
            function debounce(func, delay = 400) {
                let timer;
                return function (...args) {
                    clearTimeout(timer);
                    timer = setTimeout(() => func.apply(this, args), delay);
                };
            }

            // ================= LOAD VIDEO =================
            function loadVideo(index) {

                if (index < 0 || index >= videos.length) return;

                currentIndex = index;
                let v = videos[index];

                document.getElementById("videoSource").src =
                    "{{ env('BUNNY_BASE_URL') }}/" + v.video;

                let videoEl = document.getElementById("athleteVideo");
                videoEl.load();

                document.getElementById("userName").innerText = v.name;
                document.getElementById("userCountry").innerText = v.country;
                document.getElementById("profileImg").src =
                    "/athlete_assets/athlete_documents/" + v.profile;

                document.getElementById("videoTitle").innerText = v.title;
                document.getElementById("videoAbout").innerText = v.about;
                document.getElementById("videoTime").innerText = v.time;

                document.getElementById("likeCount").innerText = v.likes + " likes";

                $(".likeBtn").attr("data-video", v.id);

                let heart = $(".like-heart");
                heart.removeClass("liked");

                if (v.liked) {
                    heart.addClass("liked");
                }
            }

            // ================= SEARCH FUNCTION =================
            let lastQuery = "";
            let cache = {}; // optional (for caching)

            function performSearch(value) {
                let query = value.trim();
                lastQuery = query;

                // ✅ EMPTY → DEFAULT
                if (query.length === 0) {

                    if (currentRequest) {
                        currentRequest.abort();
                    }

                    currentRequest = $.ajax({
                        url: "{{ route('mentor.search') }}",
                        type: "GET",
                        data: { search: "" },

                        success: function (res) {

                            if (query !== lastQuery) return;

                            $(".content-wrapper").html(
                                $(res).find(".content-wrapper").html()
                            );

                            reInitialize();
                        },

                        complete: function () {
                            currentRequest = null;
                        }
                    });

                    return;
                }

                // ✅ MIN LENGTH
                if (query.length < 2) return;

                // ✅ CACHE HIT (optional but pro 🔥)
                if (cache[query]) {
                    $(".content-wrapper").html(cache[query]);
                    reInitialize();
                    return;
                }

                // ✅ ABORT PREVIOUS
                if (currentRequest) {
                    currentRequest.abort();
                }

                currentRequest = $.ajax({
                    url: "{{ route('mentor.search') }}",
                    type: "GET",
                    data: { search: query },

                    beforeSend: function () {
                        // 🔄 loader (optional)
                        $(".content-wrapper").addClass("loading");
                    },

                    success: function (res) {

                        // ❗ ignore outdated response
                        if (query !== lastQuery) return;

                        let html = $(res).find(".content-wrapper").html();

                        cache[query] = html; // store in cache

                        $(".content-wrapper").html(html);

                        reInitialize();

                        let input = document.getElementById("searchInput");
                        if (input) {
                            input.value = query;
                        }
                    },

                    complete: function () {
                        currentRequest = null;
                        $(".content-wrapper").removeClass("loading");
                    }
                });
            }


            // ================= SINGLE DEBOUNCE INSTANCE =================
            const debouncedSearch = debounce(function (value) {
                performSearch(value);
            }, 700);

            // ================= INPUT EVENT =================
            $(document).on("input", ".reels-search-input", function () {
                debouncedSearch(this.value);
            });

            // ================= RE-INITIALIZE =================
            function reInitialize() {

                let dataEl = document.getElementById("videosData");

                if (dataEl) {
                    videos = JSON.parse(dataEl.getAttribute("data-videos"));
                } else {
                    videos = [];
                }

                currentIndex = 0;

                if (videos.length > 0) {
                    loadVideo(0);
                }
            }

            // ================= SCROLL =================
            $(document).on("wheel", ".post-card", function (e) {
                e.preventDefault();

                if (e.originalEvent.deltaY > 0) loadVideo(currentIndex + 1);
                else loadVideo(currentIndex - 1);

            });

            // ================= ACTIVATE CARD =================
            $(document).on("click", ".post-card", function () {
                isActive = true;
                $(this).focus();
            });

            $(document).on("click", function (e) {
                if (!$(e.target).closest(".post-card").length) {
                    isActive = false;
                }
            });

            // ================= KEYBOARD CONTROL =================
            $(document).on("keydown", function (e) {

                if (!isActive) return;

                if (e.key === "ArrowDown" || e.key === "ArrowRight") {
                    e.preventDefault();
                    loadVideo(currentIndex + 1);
                }

                if (e.key === "ArrowUp" || e.key === "ArrowLeft") {
                    e.preventDefault();
                    loadVideo(currentIndex - 1);
                }

                if (e.code === "Space") {
                    e.preventDefault();
                    let video = document.getElementById("athleteVideo");

                    if (video.paused) video.play();
                    else video.pause();
                }
            });

            // ================= LIKE =================
            $(document).on("click", ".likeBtn", function () {

                let btn = $(this);
                let videoId = btn.data("video");

                $.ajax({
                    url: "{{ route('mentor.video.like') }}",
                    type: "POST",
                    data: {
                        video_id: videoId,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (res) {

                        $("#likeCount").html(res.count + " likes");

                        videos[currentIndex].likes = res.count;
                        videos[currentIndex].liked = (res.status === "liked");

                        let heart = btn.find(".like-heart");

                        if (res.status === "liked") {
                            heart.addClass("liked");
                        } else {
                            heart.removeClass("liked");
                        }
                    }
                });

            });

            // ================= INIT =================
            $(document).ready(function () {
                loadVideo(0);
            });
        </script>
    @endpush
@endsection