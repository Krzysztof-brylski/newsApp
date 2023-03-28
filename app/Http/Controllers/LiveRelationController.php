<?php

namespace App\Http\Controllers;

use App\Events\SendLiveRelationMessage;
use App\Http\Requests\CreateRelationRequest;
use App\Http\Requests\UpdateRelationRequest;
use App\Http\Resources\LiveMessageResource;
use App\Models\LiveRelationMessage;
use App\Services\LiveRelationService;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Cache;

class LiveRelationController extends Controller
{

    /**
     * @return AnonymousResourceCollection
     */
    public function index(LiveRelationMessage $message): AnonymousResourceCollection
    {
        if(!Cache::has("messages_{$message->prev_message}")){
            Cache::put("messages_{$message->prev_message}",
                LiveRelationMessage::where('prev_message',$message->prev_message)->get(),(60*60*24));
        }

        return LiveMessageResource::collection(
            Cache::get("messages_{$message->prev_message}")
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

    public function list(){
        $lives = Cache::get('live_relations');
        return view('moderator/live/index',['relations'=>$lives]);
    }
}
