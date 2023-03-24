<?php

namespace App\Models;

use App\Services\CommentService;
use App\Services\LikeService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'content',
        'thumbnail'
    ];

    protected $with=['Author:name','Tags:name','Comments'];
    protected $withCount=['Likes'];

    //for future model observer this action
    public function like(User $user):bool
    {
        return (new LikeService())->like($user,$this);
    }
    public function comment(User $user, string $content){
        (new CommentService())->comment($content,$user,$this);
    }

    public function Author(){
        return $this->belongsTo(User::class);
    }

    public function Tags(){
        return $this->belongsToMany(Tag::class,'posts_tags');
    }
    public function Comments(){
        return $this->morphMany(Comment::class,'commentable');
    }

    public function Likes(){
        return $this->morphMany(Likes::class,'likeable');
    }



}
