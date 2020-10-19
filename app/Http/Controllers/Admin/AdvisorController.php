<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\AdvisorsDataTable;
use App\Http\Controllers\Controller;
use App\Model\Collect\Advisor;
use App\Model\UserCollect;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AdvisorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param AdvisorsDataTable $dataTable
     * @return Response
     */
    public function index(AdvisorsDataTable $dataTable)
    {
        return $dataTable->render('admin.advisor.home',['title' => 'Advisors']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */
    public function create()
    {
        return view("admin.advisor.create",['title'=>'Create new Advisor']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function store(Request $request)
    {
        $data = $this->validate(request(),[
            'name'=>'required',
            'email'=>'required|unique:advisors',
            'password'=>'required|confirmed|min:6',
            'phone'=>'required|numeric',
            'room_no'=>'required|numeric',
            'office_from'=>'required',
            'office_to'=>'required',
        ],[],[
            'name'=>'Name',
            'email'=>'Email',
            'password'=>'Password',
            'phone'=>'Phone number',
            'room_no'=>'Room number',
            'office_from'=>'Office open from',
            'office_to'=>'Office open to',
        ]);
        DB::beginTransaction();
        $collect = UserCollect::create([
            'type'=>'advisor'
        ]);
        $advisor = Advisor::create([
            'id'=>$collect->id,
            'name'=>$data['name'],
            'email'=>$data['email'],
            'password'=>Hash::make($data['password']),
            'phone'=>$data['phone'],
            'room_no'=>$data['room_no'],
            'office_from'=>$data['office_from'],
            'office_to'=>$data['office_to'],
        ]);
        DB::commit();
        session()-> flash('success','Record add successfully');
        return redirect(aurl('advisors'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
