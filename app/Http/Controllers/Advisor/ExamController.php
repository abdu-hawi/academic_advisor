<?php

namespace App\Http\Controllers\Advisor;

use App\DataTables\ExamDataTable;
use App\Http\Controllers\Controller;
use App\Model\Collect\Exam;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ExamController extends Controller
{
    /**
     * @return void
     */
    public function index()
    {
        $dataTable = new ExamDataTable("advisor");
        return $dataTable->render('advisor.exams.home',['title' => 'Events']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('advisor.exams.create',['title'=>'Create Event']);
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
            'name'=>'required',
            'date'=>'required',
        ],[],[
            'name'=>'Event name',
            'date'=>'date',
        ]);
        Exam::create([
            'name'=>$data['name'],
            'date'=>$data['date'],
            'advisor_id'=>advisor()->id()
        ]);
        session()-> flash('success','Record add successfully');
        return redirect(advisorURL('exams'));
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
            'name'=>'required',
            'date'=>'required',
        ],[],[
            'name'=>'Event Name',
            'date'=>'date',
        ]);
        Exam::query()->where('id',$id)->update($data);
        session()-> flash('success','Record update successfully');
        return redirect(advisorURL('exams'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy($id)
    {
        Exam::where('id',$id)->delete();
        session()->flash('success',"Record delete successfully");
        return redirect(advisorURL('exams'));
    }
}
