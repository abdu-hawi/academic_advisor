<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $fillable = [
        'title', 'url',
    ];
}
