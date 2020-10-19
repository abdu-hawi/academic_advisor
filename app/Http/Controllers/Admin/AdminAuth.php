<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Admin\Admin;
use Illuminate\Http\Request;
use App\Mail\AdminResetPassword;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AdminAuth extends Controller
{
    protected function login(){
        return view('admin.auth.login');
    }

    protected function doLogin(){
        if (request('rememberme') == 1) $remember = true;
        else $remember = false;
        request()->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        if(admin()->attempt(['email'=>request('email'),'password'=>request('password')],$remember)){
            return redirect(aurl());
        }else{
            session()->flash('error',"Email or password incorrect");
            return redirect(aurl('login'));
        }
    }

    protected function logout(){
        admin()->logout();
        return redirect(aurl('login'));
    }

    protected function forgotPassword(){
        return view('admin.auth.forgot_password');
    }

    protected function forgotPasswordPost(){
        request()->validate([
            'email' => 'required',
        ]);
        $admin = Admin::where('email',request('email'))->first();
        if(!empty($admin)){
            $token = app('auth.password.broker')->createToken($admin);
            $data = DB::table('password_resets')->insert([
                'email' => $admin->email,
                'token' => $token,
                'created_at' => Carbon::now(),
            ]);
            //Mail::to($admin->email)->send(new AdminResetPassword([ 'data' => $admin , 'token' => $token ]));
            Mail::to(request('email'))->send(new AdminResetPassword([ 'data' => $admin , 'token' => $token ]));
            session()-> flash('success','Reset link is sent to your email');
            return back();
        }else{
            session()->flash('error',"Email incorrect");
        }
        return back();
    }

    protected function resetPassword($token){
        $check_token = DB::table('password_resets')->where('token',$token)->where('created_at','>', Carbon::now()->subHours(2))->first();
        if(!empty($check_token)){
            return view('admin.auth.reset_password',['data'=>$check_token]);
        }else{
            session()->flash('error','You have some error');
            return redirect(aurl('forgotPassword'));
        }
    }

    protected function resetNewPassword($token){
        $this->validate(request(),[
            'email' => 'required',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required'
        ],[],[
            'email' => 'Email',
            'password' => 'Password',
            'password_confirmation' => 'Password confirmation'
        ]);
        $check_token = DB::table('password_resets')
            ->where('email',request('email'))
            ->where('token',$token)
            ->where('created_at','>', Carbon::now()->subHours(2))
            ->first();
        if (!empty($check_token)){
            if(Admin::where('email',request('email'))->update(['password'=>bcrypt(request('password'))])){
                DB::table('password_resets')->where('email',request('email'))->delete();
                session()->flash('success','Your password is reset, please login');
                return redirect(aurl('login'));
            }else{
                session()->flash('error','You have some error, please try again');
                return back();
            }
        }else{
            session()->flash('error','You have some error, please try again');
            return back();
        }
    }

}
