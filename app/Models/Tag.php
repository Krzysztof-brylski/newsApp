<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
    ];

    public function Posts(){
        return $this->belongsToMany(Post::class,'posts_tags');
    }

    public function Logs(){
        return  $this->morphTo(Logs::class,'logable');
    }
}
