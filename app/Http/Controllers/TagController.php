<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Models\Tag;
use App\Services\TagService;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return View('moderator/post/index',array(
            'posts'=>Tag::paginate(15),
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('moderator/tag/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateTagRequest $request)
    {
        $data=$request->validated();
        try{
            (new TagService())->createTag($data);
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
    public function show(Tag $tag)
    {
        return view('moderator/tag/show',array(
            'tag'=>$tag
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        return view('moderator/tag/edit',array(
            'tag'=>$tag
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTagRequest $request, Tag $tag)
    {
        $data=$request->validated();
        try{
            (new TagService())->updateTag($data,$tag);
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
    public function destroy(Tag $tag)
    {
        try{
            (new TagService())->deleteTag($tag);
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
