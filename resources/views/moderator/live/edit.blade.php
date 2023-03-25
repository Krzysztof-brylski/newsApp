
@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{route('moderator.relations.update',['message'=>$message])}}" method="post">
        @csrf
        <input type="text" name="relation_title" value="{{$message->relation_title}}" readonly required>
        <input readonly hidden type="number" name="prev_message" value="{{$message->id}}" required>
        <input type="text" name="title" required >
        <textarea name="content">

        </textarea>
        <button type="submit" class="btn btn-success">Create Relation</button>
    </form>
</div>


@endsection
