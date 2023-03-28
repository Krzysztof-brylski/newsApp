@extends('layouts.app')
@section('content')
    <div class="container d-flex justify-content-center">
        <div class="card w-50">
            <div class="card-header">
                <h2>Create new tag</h2>
            </div>
            <div class="card-body">
                <form method="post" action="{{route('moderator.tag.store')}}">
                    @csrf
                    <input class="form-control my-2" type="text" name="name" placeholder="Tag name..." required value="{{$tag->name}}">
                    <button type="submit" class="btn btn-success">Create Tag</button>
                </form>
            </div>
        </div>

    </div>

@endsection
