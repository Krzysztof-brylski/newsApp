<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $lives = Cache::get('live_relations');
        $posts = Post::orderBy('likes_count','desc')->limit(12)->get();
        return view('landingPage',[
            'lives'=>$lives,
            'posts'=>$posts
        ]);
    }

    public function watchPost(Post $post){
        $post->increment('views');

        return view('guest/post/post',[
            'post'=>$post
        ]);
    }

    public function postList(Tag $tag){

        if(!$tag->exists){
            return view('guest/post/postList',[
                'posts'=>$posts=Post::paginate(10),
                'tag'=>null
            ]);
        }
        $posts = $tag->Posts()->orderBy('created_at','desc')->paginate(10);
        return view('guest/post/postList',[
            'posts'=>$posts,
            'tag'=>$tag->name,

        ]);
    }


}
