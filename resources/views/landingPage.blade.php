@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xl-9">
                <div class="row">
                    @foreach($posts as $post)
                        @include('guest/post/postThumbnail',['post'=>$post])
                    @endforeach
                </div>
            </div>
            <div class="col-xl-3">
                <h3>Live relations</h3>
                <ul>
                    @foreach($lives as $live)
                        <li><a href="{{route('relation.read',['relationMessage'=>$live['id']])}}">{{$live['title']}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

@endsection
