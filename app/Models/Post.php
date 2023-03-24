<?php

namespace App\Models;

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

    //protected $with=['Author:name','Tags:name','Comments'];
    public function Author(){
        return $this->belongsTo(User::class);
    }

    public function Tags(){
        return $this->belongsToMany(Tag::class,'posts_tags');
    }
    public function Comments(){
        return $this->morphMany(Comment::class,'commentable');
    }




}
