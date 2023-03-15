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
                'message'=>'resource created'
            ])->with(['error'=>false]);
        }catch (\Exception $exception){
            return back()->with([
                'message'=>$exception->getMessage()
            ])->with(['true'=>false]);
        }

    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        return view('moderator/tag/update',array(
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
    public function destroy(Tag $tag)
    {
        try{
            (new TagService())->deleteTag($tag);
            return back()->with([
                'message'=>'resource deleted'
            ])->with(['error'=>false]);
        }catch (\Exception $exception){
            return back()->with([
                'message'=>$exception->getMessage()
            ])->with(['error'=>true]);
        }
    }
}
