<?php

namespace App\Model\Collect;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable=[
        'from',
        'to',
        'message',
        'isRead',
    ];
}
