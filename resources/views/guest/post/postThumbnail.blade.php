<div class="col-md-4">
    <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="{{asset('storage/'.$post->thumbnail)}}" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title">{{$post->title}}</h5>
            <p class="card-text">{{substr($post->content,0,60)}}...</p>
            <a href="{{route('post.show',['post'=>$post])}}" class="btn btn-primary">Read more</a>
            <div class="d-flex justify-content-between m-2">
                <span>Likes: {{$post->likes_count}}</span>
                <span>Views: {{$post->views}}</span>
            </div>
        </div>
        <div class="card-footer text-muted">
            {{$post->tags->implode('name',', ')}}
        </div>
    </div>
</div>

