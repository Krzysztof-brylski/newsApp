<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Services\CommentService;
use Illuminate\Http\Request;

class CommentController extends Controller
{



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        $data = $request->validate(['content'=>'string|required']);
        try{
            (new CommentService())->update($data, $comment);
            return Response()->json('commented',201);
        }catch (\Exception $exception){
            return Response()->json(['error'=>$exception->getMessage()],200);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        try{
            (new CommentService())->delete($comment);
            return Response()->json('deleted',200);
        }catch (\Exception $exception){
            return Response()->json(['error'=>$exception->getMessage()],200);
        }

    }
}
