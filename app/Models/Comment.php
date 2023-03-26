<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable=['content'];
    //protected $with=['Author:name'];


    public function Author(){
        return $this->belongsTo(User::class,'author_id');
    }

    public function Commentable(){
        return $this->morphTo(Comment::class);
    }

    public function Logs(){
        return  $this->morphTo(Logs::class,'logable');
    }

}
