@extends('layout.athlete.app')

@section('content')


    <style>
        .input-controls {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 15px;
        }

        .input-controls input {
            height: 44px;
            margin-bottom: 0;
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

                        <div class="simple-dashboard-heading">
                            <i class="fas fa-video"></i>
                            <span>Manage Videos</span>
                        </div>

                        <div>
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                        </div>


                        <div class="input-controls">
                            <input type="text" id="searchInput" class="form-control" placeholder="Search Videos..."
                                autocomplete="off" style="width:320px;">
                            <div class="btn-ad-asll"><a href="{{ route('athlete.add-video') }}" class="btn btn-primary2">
                                    <i class="bx bx-plus me-1"></i> Add Video
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
                                                    <th>Video</th>
                                                    <th>Title</th>
                                                    <th>About Video</th>
                                                    <th>Status</th>
                                                    <th>Posted At</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="videoTable">
                                                @forelse($videos as $video)

                                                    <tr>
                                                        <td id="videoContainer{{$video->id}}"
                                                            style="position: relative; width:130px; height:80px;">

                                                            {{-- Processing Screen --}}
                                                            @if($video->status == 'processing' && $video->progress < 100)

                                                                <div
                                                                    style="
                                                                                                                                                                    width:120px;
                                                                                                                                                                    height:80px;
                                                                                                                                                                    background:#000;
                                                                                                                                                                    color:#fff;
                                                                                                                                                                    display:flex;
                                                                                                                                                                    flex-direction:column;
                                                                                                                                                                    align-items:center;
                                                                                                                                                                    justify-content:center;
                                                                                                                                                                    font-size:12px;
                                                                                                                                                                ">

                                                                    <div class="spinner-border spinner-border-sm text-light mb-1">
                                                                    </div>

                                                                    <div class="progress w-75" style="height:6px;">
                                                                        <div id="progressBar{{$video->id}}"
                                                                            class="progress-bar progress-bar-striped progress-bar-animated"
                                                                            role="progressbar" style="width:{{$video->progress}}%">
                                                                        </div>
                                                                    </div>

                                                                    <span
                                                                        id="progressText{{$video->id}}">{{$video->progress}}%</span>

                                                                </div>

                                                                {{-- Show Video (Active or Inactive both) --}}
                                                            @else

                                                                
                                                                <video width="120" height="80" controls>

                                                                    <source
                                                                        src="{{ config('services.bunny.base_url') }}/{{ $video->video }}?v={{ time() }}"
                                                                        type="video/{{ pathinfo($video->video, PATHINFO_EXTENSION) }}">
                                                                </video>
                                                            @endif

                                                        </td>


                                                        <td>{{ ucfirst($video->title) }}</td>

                                                        <td>{{ ucfirst($video->about) }}</td>
                                                        <td>
                                                            @if($video->visibility == 'active')
                                                                <span class="badge yess">Active</span>
                                                            @else
                                                                <span class="badge noo">Inactive</span>
                                                            @endif
                                                        </td>

                                                        <td>{{ $video->created_at->format('d-M-Y') }}</td>


                                                        <td class="dib-both-btns">
                                                            <div>
                                                                <a href="{{ route('athlete.edit-video', $video->id) }}"
                                                                    class="btn btn-edit-two">
                                                                    <i class="fas fa-pen"></i> Edit
                                                                </a>
                                                            </div>
                                                            <div>
                                                                <form action="{{ route('athlete.manage-videos.delete') }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="video_id"
                                                                        value="{{ $video->id }}">

                                                                    <button class="btn delete-btn" onclick="return confirmDelete()">
                                                                        <i class="fas fa-times-circle"></i> Delete
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </td>

                                                    </tr>

                                                @empty

                                                    <tr>
                                                        <td colspan="5" class="text-center text-danger">No Videos Found</td>
                                                    </tr>

                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                    <div id="paginationLinks" class="d-flex justify-content-end mt-3">
                                        {{ $videos->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
function confirmDelete() {
    return confirm("Are you sure you want to delete this video?");
}
</script>

    <script>

        function checkProgress(videoId) {

            let interval = setInterval(function () {

                fetch('/athlete/video-progress/' + videoId)
                    .then(res => res.json())
                    .then(data => {

                        let bar = document.getElementById('progressBar' + videoId);
                        let text = document.getElementById('progressText' + videoId);

                        if (bar) {
                            bar.style.width = data.progress + "%";
                        }

                        if (text) {
                            text.innerText = data.progress + "%";
                        }

                        if (data.progress >= 100) {

                            clearInterval(interval);

                            let container = document.getElementById('videoContainer' + videoId);
                            let ext = data.video.split('.').pop();

                            container.innerHTML = `
                <video width="120" height="80" controls>
                    <source src="{{ config('services.bunny.base_url') }}/{{ $video->video }}?v=${Date.now()}" type="video/${ext}">
                </video>
            `;
                        }


                    });

            }, 2000);
        }


    </script>
    @isset($videos)
        <script>

            @foreach($videos as $video)

                @if($video->status == 'processing')
                    checkProgress({{$video->id}});
                @endif

            @endforeach

        </script>
    @endisset
    <script>

        let timer;

        document.getElementById("searchInput").addEventListener("keyup", function () {

            clearTimeout(timer);

            let value = this.value;

            timer = setTimeout(function () {

                fetch("{{ route('athlete.manage-videos') }}?search=" + encodeURIComponent(value), {
                    headers: {
                        "X-Requested-With": "XMLHttpRequest"
                    }
                })
                    .then(res => res.text())
                    .then(html => {

                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, "text/html");

                        const newTable = doc.querySelector("#videoTable");
                        const newPagination = doc.querySelector("#paginationLinks");

                        if (newTable) {
                            document.querySelector("#videoTable").innerHTML = newTable.innerHTML;
                        }

                        if (newPagination) {
                            document.querySelector("#paginationLinks").innerHTML = newPagination.innerHTML;
                        }

                    });

            }, 400);

        });

    </script>

@endsection