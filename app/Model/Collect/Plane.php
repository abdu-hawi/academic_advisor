<?php

namespace App\Model\Collect;

use App\Model\Course;
use Illuminate\Database\Eloquent\Model;

class Plane extends Model
{
    protected $fillable = [
        'student_id',
        'level',
        'course_id',
        'grade',
    ];

    public function course(){
        return $this->hasOne(Course::class,'id','course_id');
    }
}
