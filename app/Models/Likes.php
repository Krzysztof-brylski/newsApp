<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    use HasFactory;

    protected $fillable=[];


    public function Author(){
        return $this->belongsTo(User::class,'author_id');
    }

    public function likeable(){
        return $this->morphTo(Likes::class);
    }

    public function Logs(){
        return  $this->morphTo(Logs::class,'logable');
    }

}
