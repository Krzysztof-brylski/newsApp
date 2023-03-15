@extends('layouts.app')

@section('content')
    <div class="d-flex p-5 justify-content-center align-items-center">
        <form id="updatePost" name="updatePost"  method="POST" action="{{route('moderator.post.update',['post'=>$post])}}" enctype="multipart/form-data" class="w-100 p-4 d-flex flex-column justify-content-center align-items-center">
            @csrf
            @method('put')
            <div class="row mb-8 m-3 w-75" >
                <label for="Title" class="col-md-4 col-form-label text-md-end">Title:</label>

                <div class="col-md-6">
                    <input id="Title" type="text" class="form-control @error('Title') is-invalid @enderror" name="title"  autocomplete="title"  value="{{$post->title}}">
                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row  mb-8 m-3  h-50 w-75" >
                <label for="content" class="col-md-4 col-form-label text-md-end">Content:</label>

                <div class="col-md-6 h-100">
                    <textarea id="content" class="form-control @error('email') is-invalid @enderror"  name="content" maxlength="512">
                        {{$post->content}}
                    </textarea>
                    @error('content')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>
            </div>

            <div class="row  mb-8 m-3 w-75" >
                <label for="thumbnail" class="col-md-4 col-form-label text-md-end">Thumbnail:</label></br>

                <div class="col-md-6 h-100">
                    <input type="file"  name="thumbnail" id="thumbnail">
                    @error('thumbnail')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>
            </div>

            <div class="w-75">
                <h5 class="col-md-4 col-form-label text-md-end">Tags:</h5>
                <div class="row justify-content-center align-items-center">
                    @foreach($tags as $tag)
                        <div class="col-md-3 d-flex justify-content-center">
                            <label for="{{$tag->name}}" class="col-md-4 px-2 col-form-label text-md-end">{{$tag->name}}</label>
                            <input type="checkbox" id="{{$tag->name}}" name="tags[]" value="{{$tag->id}}" @if($post->Tags->contains($tag)) checked @endif  >
                        </div>
                    @endforeach

                    @error('tags')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>


            </div>
            <button type="submit" class="btn btn-success">Update Post</button>
        </form>
    </div>



@endsection
