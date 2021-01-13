@extends('html')

@section('content')
    <div>
        <Player class="w-full h-screen" url="{{ $url }}" mime-type="{{ $mimeType }}"></Player>
    </div>

@endsection

@prepend('script')
    <script src="{{ asset('js/app.js') }}"></script>
@endprepend

@push('script')
    <script>
        new Vue({
            'el': '#app',
        })
    </script>
@endpush

