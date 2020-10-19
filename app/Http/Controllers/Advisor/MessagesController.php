<?php

namespace App\Http\Controllers\Advisor;

use App\Http\Controllers\Controller;
use App\Model\Collect\Message;
use App\Model\Collect\Student;

class MessagesController extends Controller{

    protected function index(){
        $student = Student::query()->where('advisor_id',advisor()->user()->id)->get();
        return view('advisor.message.home',['title'=>'Messages','students'=>$student]);
    }

    protected function msg_unread(){
        return Message::query()->where('to',advisor()->user()->id)->where('isRead','=',0)->get();
    }

    protected function isRead($id){
        Message::query()->where('from',$id)->update(['isRead'=>1]);
    }

    protected function getAllMsgStudent($id){
        $advisor = advisor()->user()->id;
        return Message::where(function ($query) use($id,$advisor){
            $query->where('from',$id)->where('to',$advisor);
        })->orWhere(function ($query) use($id,$advisor){
            $query->where('from',$advisor)->where('to',$id);
        })->get();
    }

    protected function store($id){
        $advisor = advisor()->user()->id;

        $msg = new Message();
        $msg->from = $advisor;
        $msg->to = $id;
        $msg->message = request('message');
        $msg->isRead = 0;
        $msg->save();

        return $msg;
    }

    protected function getMsg($msgID){
        $advisor = advisor()->user()->id;
        return Message::query()->where('to',$advisor)->where('id','>',$msgID)->get();
    }

}
