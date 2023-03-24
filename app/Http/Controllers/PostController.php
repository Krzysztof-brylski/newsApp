<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Models\Tag;
use App\Services\CommentService;
use App\Services\PostService;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PostController extends Controller
{
    //todo register observer for sending email notification to newsletter subscribers, and push action to logs
    /**
     * Display a listing of created by currently logged in moderator.
     */
    public function index()
    {
        return View('moderator/post/index',array(
            'posts'=>Auth::user()->Posts()->with(['Tags:name'])->withCount('Comments')->paginate(10),
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('moderator/post/create',array(
            'tags'=>Tag::all(),
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatePostRequest $request)
    {
        $data=$request->validated();
        try{
            (new PostService())->createPost($data,Auth::user());
            return back()->with([
                'message'=>'resource created'
            ])->with(['error'=>false]);

        }catch (\Exception $exception){

            return back()->with([
                'message'=>$exception->getMessage()
            ])->with(['error'=>true]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('moderator/post/update',array(
            'post'=>$post,
            'tags'=>Tag::all()
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data=$request->validated();

        try{
            (new PostService())->updatePost($data,$post);
            return back()->with([
                'message'=>'resource updated'
            ])->with(['error'=>false]);
        }catch (\Exception $exception){
            return back()->with([
                'message'=>$exception->getMessage()
            ])->with(['error'=>true]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        try{
            (new PostService())->deletePost($post);
            return back()->with([
                'message'=>'resource deleted'
            ]);
        }catch (\Exception $exception){
            return back()->with([
                'message'=>$exception->getMessage()
            ])->with(['error'=>true]);
        }
    }

    public function comment(Post $post,Request $request){
        $data= $request->validate(['content'=>'string|required']);

        $post->comment(Auth::user(),$data['content']);
        return back()->with([
            'message'=>"commented!"
        ])->with(['error'=>false]);

    }

    public function like(Post $post){
        if(!$post->like(Auth::user())){
            return back()->with([
                'message'=>"Like canceled!"
            ])->with(['error'=>false]);
        }

        return back()->with([
            'message'=>"Liked <3"
        ])->with(['error'=>false]);
    }
}
