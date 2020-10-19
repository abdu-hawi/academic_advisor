<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Model\Collect\Exam;
use App\Model\Course;
use App\Model\Interest;

class ExamController extends Controller{
/*
    protected function index(){
        $interest_id = student()->user()->interest_id;
        $i = Interest::where('id',$interest_id)->with('f_course')->first();
        $arrCourse = [];
        $first = $i->f_course->id;
        $second = $i->s_course->id;
        array_push($arrCourse,$first);
        array_push($arrCourse,$second);
        $courses = Course::query()->where('type','Mandatory')->select('id')->get();
        foreach ($courses as $course){
            array_push($arrCourse,$course->id);
        }
        // all course id in $arrCourse
        $arrExam = [];
        $exams = Exam::query()->get();
        foreach ($exams as $exam){
            array_push($arrExam,$exam->course_id);
        }
        // all Exam id in $arrExam
        $intersects = array_intersect($arrCourse,$arrExam);
        $arrInter = [];
        foreach ($intersects as $intersect){
            array_push($arrInter,$intersect);
        }
        $arrStudentExam = [];
        for ($i=0;$i<count($arrInter);$i++){
            array_push($arrStudentExam,Exam::query()->where('course_id',$arrInter[$i])->with('course')->first());
        }
        return view('student.exam.home',['title'=>'Exam','c'=>$arrStudentExam]);
    }
*/
    protected function index(){
        $advisor_id = student()->user()->advisor_id;
        $event = Exam::query()->where('advisor_id',$advisor_id)->get();
        return view('student.exam.home',['title'=>'Event','event'=>$event]);
    }
}
