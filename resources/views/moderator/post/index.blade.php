@extends('layouts.app')

@section('content')

    <div class="d-flex p-5 justify-content-center align-items-center px-5 flex-column">
        <h2 class="m-1 p-1 ">Your posts:</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Title</th>
                    <th>Tags...</th>
                    <th>Thumbnail</th>
                    <th>Views</th>
                    <th>Comments Count</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td>{{$post->created_at}}</td>
                        <td>{{$post->title}}</td>
                        <td>{{$post->tags->implode('name',' ')}}</td>
                        <td>{{$post->thumbnail}}</td>
                        <td>{{$post->views}}</td>
                        <td>0</td>
                        <td>

                            <a class="btn btn-info" href="{{route("moderator.post.edit",['post'=>$post->id])}}">Update</a>
                            <a class="btn btn-danger" >Request Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{$posts->links()}}
    </div>
@endsection
