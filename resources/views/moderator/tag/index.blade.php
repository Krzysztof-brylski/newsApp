@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center w-100">
            <h2 class="m-1 p-1 ">Live relations:</h2>
            <a class="btn btn-success h-25" href="{{route('moderator.tag.create')}}">Create new tag</a>
        </div>
        <h2 class="m-1 p-1 ">Your posts:</h2>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Posts count</th>
                <th>Actions</th>
            </tr>
            </thead>
            @foreach($tags as $tag)
                <tr>
                    <td>{{$tag->id}}</td>
                    <td>{{$tag->name}}</td>
                    <td>{{$tag->posts_count}}</td>
                    <td class="d-flex">
                        <a class="btn btn-info mx-2" href="{{route('moderator.tag.edit',['tag'=>$tag->id])}}">Update tag</a>
                        <form method="POST" action="{{route('moderator.tag.destroy',['tag'=>$tag->id])}}">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Delete tag</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            <tbody>
            </tbody>
        </table>
    </div>
@endsection
