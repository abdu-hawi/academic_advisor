<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\InterestDataTable;
use App\Http\Controllers\Controller;
use App\Model\Interest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class InterestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $i = Interest::query()->with('f_course')->with('s_course')->get();
        return view('admin.interest.home',['title' => 'Interests', 'interest' => $i]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view("admin.interest.create",["title"=>"New Interest"]);
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
            'name'=>'required|unique:interests',
            'first_course'=>'required|unique:interests',
            'second_course'=>'required|different:first_course|unique:interests',
        ],[],[
            'name'=>'name',
            'first_course'=>'first course',
            'second_course'=>'second course',
        ]);
        Interest::create($data);
        session()->flash('success',"Interest create successfully");
        return redirect(aurl('interests'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        return view('admin.interest.edit',['interest'=>Interest::find($id),'title'=>'Edit Interest']);
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
            'first_course'=>'required|unique:interests,first_course,'.$id,
            'second_course'=>'required|unique:interests,second_course,'.$id,
        ],[],[
            'name'=>'name',
            'first_course'=>'First Course',
            'second_course'=>'Second Course',
        ]);
        Interest::where("id",$id)->update($data);
        session()->flash('success',"Records Update Successfully");
        return redirect(aurl('interests'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy($id)
    {
        Interest::find($id)->delete();
        session()->flash('success',"Record delete successfully");
        return redirect(aurl('interests'));
    }
}
