<?php

namespace App\Model;

use App\Model\Collect\Score;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'name',
        'code',
        'credit',
        'description',
        'type',
        'prerequisite',
    ];

    public function courses(){
        return $this->belongsToMany(Score::class);
    }

//    public function prerequisite(){
//        return $this->hasOne(Course::class,'course_id', 'id');
//    }
}
