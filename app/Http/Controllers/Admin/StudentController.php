<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\StudentDataTable;
use App\Http\Controllers\Controller;
use App\Model\Collect\Student;

class StudentController extends Controller
{
    public function index()
    {
        $dataTable = new StudentDataTable("admin");
        return $dataTable->render('admin.students.home',['title' => 'Students']);
    }

    public function show($id){
        $student = Student::query()->where('id',$id)->first();
        return view('admin.students.btn.showPlane',['id'=>$id,'name'=>$student->name,'title'=>'Show plane '.$student->name]);
    }
}
