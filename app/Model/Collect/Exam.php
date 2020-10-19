<?php

namespace App\Model\Collect;

use App\Model\Course;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable=[
        'name',
        'advisor_id',
        'date',
    ];

    public function course(){
        return $this->hasOne(Course::class,'id','course_id');
    }
}
