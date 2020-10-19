<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class FAQ extends Model
{
    protected $fillable = [
        "question", "answer"
    ];
}
