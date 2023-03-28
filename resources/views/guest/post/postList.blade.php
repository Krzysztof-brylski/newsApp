@extends('layouts.app')
@section('content')
<div class="container">
    @if(is_null($tag))
        <h2>Results for all posts:</h2>
    @else
        <h2>Results for {{$tag}} category:</h2>
    @endif
    <div class="row my-4">
        @foreach($posts as $post)
            @include('guest/post/postThumbnail',['post'=>$post])
        @endforeach

    </div>
    {{$posts->links()}}
</div>
@endsection
