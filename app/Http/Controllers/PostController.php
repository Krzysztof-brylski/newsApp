<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
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
        return view('moderator/post/create');
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
                'success'=>'resource created'
            ]);

        }catch (\Exception $exception){

            return back()->with([
                'error'=>$exception->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('moderator/post/show',array(
            'post'=>$post
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
                'success'=>'resource updated'
            ]);
        }catch (\Exception $exception){
            return back()->with([
                'error'=>$exception->getMessage()
            ]);
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
                'success'=>'resource deleted'
            ]);
        }catch (\Exception $exception){
            return back()->with([
                'error'=>$exception->getMessage()
            ]);
        }
    }
}
