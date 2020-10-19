<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Model\Collect\Message;

class MessagesController extends Controller{

    protected function index(){
        $s = student()->user();
        $tx = $s->id;
        $rx = $s->advisor_id;
        return Message::where(function ($query) use($tx,$rx){
            $query->where('from',$tx)->where('to',$rx);
        })->orWhere(function ($query) use($tx,$rx){
            $query->where('from',$rx)->where('to',$tx);
        })->get();

    }

    protected function getMsg($msgID){
        $s = student()->user();
        $tx = $s->id;
        $rx = $s->advisor_id;
        return Message::query()->where(function ($query) use($tx,$rx){
            $query->where('from',$rx)->where('to',$tx);
        })->where('id','>',$msgID)->get();
    }

    protected function isRead(){
        Message::query()->where('to',student()->user()->id)->update(['isRead'=>true]);
    }

    protected function store(){
        $s = student()->user();
        $tx = $s->id;
        $rx = $s->advisor_id;

        $msg = new Message();
        $msg->from = $tx;
        $msg->to = $rx;
        $msg->message = request('message');
        $msg->isRead = 0;
        $msg->save();

        return $msg;
    }

}
