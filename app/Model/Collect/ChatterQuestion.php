<?php

namespace App\Model\Collect;

use Illuminate\Database\Eloquent\Model;

class ChatterQuestion extends Model
{
    protected $fillable = [
        'answer_id',
        'question',
    ];

    public function answer(){
        return $this->hasOne(ChatterAnswer::class,'id','answer_id');
    }
}
