<?php

namespace App\Http\Controllers\Advisor;

use App\Http\Controllers\Controller;
use App\Model\Collect\Advisor;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ProfileController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('advisor.profile.home',['title'=>'Profile','user'=>advisor()->user()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        return view('advisor.profile.edit',['title'=>'Edit Profile','advisor'=>Advisor::where('id',$id)->first()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return Application|Factory|View
     * @throws ValidationException
     */
    public function update(Request $request, $id)
    {
        $data = $this->validate(request(),[
            'name'=>'required',
            'email'=>'required|unique:advisors,email,'.$id,
            'password'=>'sometimes|nullable|confirmed|min:6',
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
        if (!is_null(request('password'))){
            $data['password'] = Hash::make(request('password'));
            Advisor::where('id',$id)->update($data);
        }else {
            $advisor = Advisor::where('id', $id)->first();
            $data['password'] = $advisor->password;
            $advisor->update($data);
        }
        session()-> flash('success','Your profile update successfully');
        return redirect(advisorURL('profile'));
    }
}
