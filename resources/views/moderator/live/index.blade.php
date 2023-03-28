@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center w-100">
            <h2 class="m-1 p-1 ">Live relations:</h2>
            <a class="btn btn-success h-25" href="{{route('moderator.relations.create')}}">Create new relation</a>
        </div>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($relations as $relation)
                <tr>
                    <td>{{$relation['id']}}</td>
                    <td>{{$relation['title']}}</td>
                    <td>
                        <a class="btn btn-success" href="{{route('moderator.relations.update',['message'=>$relation['id']])}}">Post new live message</a>
                        <a class="btn btn-info"  href="{{route('relation.read',['relationMessage'=>$relation['id']])}}">Watch live relation</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
