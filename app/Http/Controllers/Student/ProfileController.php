<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Model\Collect\Advisor;
use App\Model\Collect\Student;
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
        return view('student.profile.home',['title'=>'Profile','user'=>student()->user()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        return view('student.profile.edit',['title'=>'Edit Profile','student'=>Student::where('id',$id)->first()]);
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
            'email'=>'required|unique:students,email,'.$id,
            'password'=>'sometimes|nullable|confirmed|min:6',
            'phone'=>'required|numeric',
            'num_course'=>'required|numeric',
        ],[],[
            'name'=>'Name',
            'email'=>'Email',
            'password'=>'Password',
            'phone'=>'Phone number',
            'num_course'=>'Number course you want learn',
        ]);
        if (!is_null(request('password'))){
            $data['password'] = Hash::make(request('password'));
            Student::where('id',$id)->update($data);
        }else {
            $advisor = Student::where('id', $id)->first();
            $data['password'] = $advisor->password;
            $advisor->update($data);
        }
        session()-> flash('success','Your profile update successfully');
        return redirect(studentURL('profile'));
    }
}
