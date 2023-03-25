
@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="post" action="{{route('moderator.relations.store')}}">
            @csrf

            <input type="text" name="title" required >
            <textarea name="content">

            </textarea>
            <button type="submit" class="btn btn-success">Create Relation</button>
        </form>
    </div>


@endsection
