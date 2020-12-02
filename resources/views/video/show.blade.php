@extends('html')

@section('content')
    <!-- Begin page content -->
    <main id="app" role="main" class="flex-shrink-0">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <video
                            id="my-video"
                            class="video-js vjs-big-play-centered"
                            controls
                            preload="auto"
                            data-setup='{}'
                    >
                        <source src="{{ $url }}" type="{{ $mimeType }}" />

                        <p class="vjs-no-js">
                            To view this video please enable JavaScript, and consider upgrading to a
                            web browser that
                            <a href="https://videojs.com/html5-video-support/" target="_blank"
                            >supports HTML5 video</a
                            >
                        </p>
                    </video>
                </div>
            </div>
        </div>
    </main>


    <script src="{{ asset('js/app.js') }}"></script>
@endsection
