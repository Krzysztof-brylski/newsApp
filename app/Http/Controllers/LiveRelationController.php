<?php

namespace App\Http\Controllers;

use App\Events\SendLiveRelationMessage;
use App\Http\Requests\CreateRelationRequest;
use App\Http\Requests\UpdateRelationRequest;
use App\Http\Resources\LiveMessageResource;
use App\Models\LiveRelationMessage;
use App\Services\LiveRelationService;
use http\Env\Response;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class LiveRelationController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index(LiveRelationMessage $message): AnonymousResourceCollection
    {
        $messages= LiveRelationMessage::where('prev_message',$message->prev_message)->orderBy('id','asc');
        return LiveMessageResource::collection(
            $messages->with(['LiveRelations'])->get()
        );
    }

    /**
     * @param CreateRelationRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateRelationRequest $request){
        $data=$request->validated();

        (new LiveRelationService())->createRelation($data);
        return back()->with([
            'message'=>'relation created'
        ])->with(['error'=>false]);
    }

    /**
     * @param UpdateRelationRequest $request
     * @param LiveRelationMessage $message
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRelationRequest $request,LiveRelationMessage $message){
        $data=$request->validated();
        (new LiveRelationService())->postMessage($data,$message);

        return back()->with([
            'message'=>'relation post added'
        ])->with(['error'=>false]);
    }

    /**
     *@return View
     */
    public function create(){
        return view('moderator/live/create');
    }

    /**
     * @param LiveRelationMessage $message
     * @return View
     */
    public function edit(LiveRelationMessage $message){
        return view('moderator/live/edit',['message'=>$message]);
    }
}
