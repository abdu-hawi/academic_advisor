<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Model\Collect\Advisor;
use App\Model\Collect\Message;
use App\Model\Collect\Student;

class AdvisorController extends Controller{

    protected function index(){
        if (student()->user()->advisor_id != null){
            return view('student.advisor.home',[
                'title'=>'Advisor',
                'user'=>Advisor::where('id',student()->user()->advisor_id)->first(),
            ]);
        }else{
            $ad = Advisor::query()->orderBy('number_of_student','asc')->first();
            Student::where('id',student()->user()->id)->update([
                'advisor_id'=>$ad->id
            ]);
            if (student()->user()->advisor_id == null) {
                $s = Student::where('id',student()->user()->id)->first();
                return view('student.advisor.home',[
                    'title'=>'Advisor',
                    'user'=>Advisor::where('id',$s->advisor_id)->first(),
                ]);
            }
            return view('student.advisor.home',[
                'title'=>'Advisor',
                'user'=>Advisor::where('id',student()->user()->advisor_id)->first(),
            ]);
        }

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
