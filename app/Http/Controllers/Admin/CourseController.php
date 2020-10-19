<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CoursesDataTable;
use App\Http\Controllers\Controller;
use App\Model\Course;
use App\Model\Prerequisite;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param CoursesDataTable $dataTable
     * @return Response
     */
    public function index(CoursesDataTable $dataTable)
    {
        return $dataTable->render('admin.courses.home',['title' => 'Courses']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view("admin.courses.create",["title"=>"Add New Course"]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $data = $this->validate($request,[
            "name"=>"required",
            "code"=>"required|unique:courses|numeric",
            "credit"=>"required|numeric",
            "description"=>"required",
            "type"=>"required|in:Mandatory,Optional,Thesis",
            "prerequisite"=>"sometimes|nullable|numeric",
        ]);
        Course::create($data);
        session()->flash('success',"New course create successfully");
        return redirect(aurl('courses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        return view('admin.courses.edit',['course'=>Course::find($id),'title'=>'Edit Course']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Application|RedirectResponse|Redirector
     * @throws ValidationException
     */
    public function update(Request $request, $id)
    {
        $data = $this->validate($request,[
            "name"=>"required",
            "code"=>"required|numeric|unique:courses,code,".$id,
            "credit"=>"required|numeric",
            "description"=>"required",
            "type"=>"required|in:Mandatory,Optional,Thesis",
            "prerequisite"=>"sometimes|nullable|numeric|different:code",
        ]);
        Course::where('id',$id)->update($data);
        session()->flash('success',"Course update successfully");
        return redirect(aurl('courses'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy($id)
    {
        $c = Course::find($id);
        $check = Course::where('prerequisite',$c->code)->get();
        for($i=0;$i<count($check);$i++){
            Course::find($check[$i]->id)->delete();
        }
        $c->delete();
        session()->flash('success',"Record delete successfully");
        return redirect(aurl('courses'));
    }
}
