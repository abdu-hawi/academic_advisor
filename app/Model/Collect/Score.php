<?php

namespace App\Model\Collect;

use App\Model\Course;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $fillable = ["course_id","score"];
}
