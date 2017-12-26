<!-- cdnjs -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/video.js/6.3.3/video-js.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/video.js/6.3.3/video.js"></script>
@extends('layouts.app')
@section('title', 'Index')
@section('content')
    <div class="col-md-8">
        <video
                id="my-player"
                class="video-js"
                controls
                preload="auto"
                poster=""
                data-setup='{}'>
            <source src="{{asset('video/Arrow.S04E23.mp4')}}" type="video/mp4"></source>
        </video>
    </div>

@endsection
