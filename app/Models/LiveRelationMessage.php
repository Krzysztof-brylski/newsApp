<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiveRelationMessage extends Model
{
    use HasFactory;

    protected $fillable=[
        'title',
        'relation_title',
        'content',
        'prev_message',
    ];

    public function LiveRelations(){
        return $this->belongsTo(LiveRelationMessage::class,'prev_message');
    }

    public function LiveRelation(){
        return $this->hasOne(LiveRelationMessage::class,'prev_message');
    }


}
