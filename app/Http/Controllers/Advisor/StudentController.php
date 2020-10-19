<?php

namespace App\Http\Controllers\Advisor;

use App\DataTables\StudentDataTable;
use App\Http\Controllers\Controller;
use App\Model\Collect\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    public function index()
    {
        $dataTable = new StudentDataTable("advisor");
        return $dataTable->render('advisor.students.home',['title' => 'Students']);
    }

    public function show($id){
        $student = Student::query()->where('id',$id)->first();
        return view('advisor.students.btn.showPlane',['id'=>$id,'name'=>$student->name,'title'=>'Show plane '.$student->name]);
    }
}
