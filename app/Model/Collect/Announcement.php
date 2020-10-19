<?php

namespace App\Model\Collect;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable=[
        'advisor_id',
        'student_id',
        'message',
        'isRead',
    ];

    public function student(){
        return $this->hasOne(Student::class,'id','student_id');
    }
}
