<?php

namespace App\Model\Collect;

use Illuminate\Database\Eloquent\Model;

class ChatterAnswer extends Model
{
    protected $fillable = ['answer'];

    public function question(){
        return $this->hasMany(ChatterQuestion::class,'answer_id','id');
    }
}
