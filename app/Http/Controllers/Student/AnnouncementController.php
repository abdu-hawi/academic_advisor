<?php

namespace App\Http\Controllers\Student;


use App\Http\Controllers\Controller;
use App\Model\Collect\Announcement;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|string
     */
    public function index(){
        if (request()->ajax()){
            return Announcement::query()->where('student_id',student()->user()->id)
                ->where('isRead',0)->paginate(10);
        }
        $a = Announcement::query()->where('student_id',student()->user()->id)->paginate(25);
        return view('student.announcement.home',['title'=>'Notifications','a'=>$a]);
    }

    public function show($id){
        $a = Announcement::where('id',$id)->first();
        return view('student.announcement.show',['title'=>'Show notification','a'=>$a]);
    }



}
