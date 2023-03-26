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

        return view('guest/post',[
            'post'=>$post
        ]);
    }


}
