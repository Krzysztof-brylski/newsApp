@extends('layouts.app')
@section('content')
    <div class="container">

        <div class="d-flex flex-column my-2">
            <div class="d-flex justify-content-between">
                <div class="d-flex flex-column">
                    <h1 class="my-0">{{ucfirst($post->title)}}</h1>
                    <p style="font-weight: bold;color: gray; margin-bottom: 8px;">
                        {{$post->tags->implode('name',' ')}}
                    </p>
                </div>
                <div>
                    <form action="{{route('post.like',['post'=>$post])}}" method="post">
                        @csrf
                        <button class="btn btn-success">Like <3</button>
                    </form>

                </div>
            </div>
            <hr style="border: 1px black solid;margin-top:5px;">
        </div>
        <div class="my-2">
            <img width="100%" height="75%" src="{{asset("storage/".$post->thumbnail)}})"/>
        </div>
        <div class="my-2">
            <p style="font-weight: 550; font-size: 17px;">{{$post->content}}</p>
        </div>
        <div>
            <div class="d-flex">
                <div class="d-flex">
                    <span style="font-weight: bold;">Author: </span>
                    <h4 class="mx-2">{{$post->author->name}}</h4>
                </div>
                <div  class="d-flex mx-3">
                    <span style="font-weight: bold;"> Likes: </span>
                    <h4 class="mx-2">{{$post->likes_count}}</h4>
                </div>
            </div>

            <div>
                <span style="font-weight: bold;"> Publication date: </span>
                <h4>{{$post->created_at->format('Y-m-d H:i')}}</h4>
            </div>
        </div>
        <div>
            <h3 class="my-4">Comments:</h3>

                <form action="{{route('post.comment',['post'=>$post])}}" method="post"  >
                    @csrf
                    <div class="d-flex">
                        <form action="{{route('post.comment',['post'=>$post])}}" method="post" class="justify-content-center d-flex">
                            <input type="text" name="content" class="form-control w-75 mx-2" required placeholder="Write comment...">
                            <button type="submit" class="btn btn-primary" @guest disabled @endguest>Send</button>
                        </form>
                    </div>
                </form>

            <div>
                @foreach($post->comments as $comment)
                    <div class="d-flex flex-column my-5">
                        <div class="my-1">
                            <h4 class="my-0">{{ucfirst($comment->author->name)}}</h4>
{{--                            <h6>{{$comment->created_at->format("Y-m-d H:i")}}</h6>--}}
                        </div>
                        <div class="mx-2">
                            {{$comment->content}}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
