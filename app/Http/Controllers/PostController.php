<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Models\Tag;
use App\Services\PostService;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * Display a listing of resource.
     */
    public function index()
    {
        return View('moderator/post/index',array(
            'posts'=>Post::paginate(15),
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
        $data=$request->all();
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
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('moderator/post/show',array(
            'post'=>$post->with('Tags:id'),
            'tags'=>Tag::all(),
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('moderator/post/edit',array(
            'post'=>$post
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
            ])->with(['error'=>false]);
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
}
