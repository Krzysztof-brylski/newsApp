<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Logs extends Model
{
    use HasFactory;

    protected $fillable=['action'];

    public function actionMaker(){
        return $this->belongsTo(User::class,'maker_id');
    }

    public function logable(){
        return $this->morphTo(Logs::class);
    }

}
