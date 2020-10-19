<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    protected $fillable = [
        'name',
        'first_course',
        'second_course',
    ];

    public function f_course(){
        return $this->hasOne(Course::class,'id','first_course');
    }

    public function s_course(){
        return $this->hasOne(Course::class,'id','second_course');
    }
}
