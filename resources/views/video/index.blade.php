@extends('html')

@section('content')

    <ul>
        @foreach($items as $video)
            <li><a href="{{ route('videos.show', $video['path']) }}">{{ $video['path'] }}</a></li>
        @endforeach

    </ul>

    {{ $items->links() }}
@endsection
