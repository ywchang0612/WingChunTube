@extends('html')

@section('content')
    <div class="mb-4 mt-4 px-4">
        <form>
            <input
                class="border-gray-200 focus:border-gray-500 appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white"
                type="text"
                name="search"
                placeholder="搜尋"
                value="{{ request('search') }}"
            >
        </form>
    </div>
    <div class="mb-4">
        @foreach($items as $video)
            <div class="hover:bg-indigo-500 hover:text-white py-2 px-4">
                    <a href="videos/{{ base64_encode($video['path']) }}">{{ $video['path'] }}</a>
            </div>
        @endforeach
    </div>
    {{ $items->links() }}
@endsection
