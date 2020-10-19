<?php

namespace App\Http\Controllers\Advisor;

use App\Http\Controllers\Controller;
use App\Mail\AdvisorWelcome;
use App\Model\Collect\Advisor;
use App\Model\UserCollect;
use Carbon\Carbon;
use App\Mail\AdvisorResetPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class AdvisorAuthController extends Controller
{
    protected function login(){
        return view('advisor.auth.login');
    }

    protected function doLogin(){
        $remember = request('remember') == 'on' ? true : false;
        request()->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        if (advisor()->attempt([
            'email' => request('email'),
            'password' => request('password')
        ], $remember)) {
//            if (Advisor::where('email',request('email'))->first()->email_verified_at != null )
//                // verify
//                return redirect(advisorURL());
//            else
//                // not verify
//                session()->flash('error', "Your account not verify, please check your email and verify your account");
//                return view("advisor.auth.message",['not'=>'not','email'=>request('email')]);
            return redirect(advisorURL());
        } else {
            session()->flash('error', "Email or Password incorrect");
            return redirect(advisorURL('login'));
        }
    }

    protected function logout(){
        advisor()->logout();
        session()->invalidate();
        return redirect('/');
    }

    protected function registerPage(){
        return view('advisor.auth.register');
    }

    /**
     * @throws ValidationException
     */
    protected function registerPost(){
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
//        $token = app('auth.password.broker')->createToken($advisor);
//        DB::table('password_resets')->insert([
//            'email' => $data['email'],
//            'token' => $token,
//            'created_at' => Carbon::now(),
//        ]);
//        Mail::to(request('email'))->send(new AdvisorWelcome([ 'data' => $advisor , 'token' => $token ]));
//        DB::commit();
//        session()-> flash('success','Welcome '.$data['name'].', please check your email to active your account');
//        return view('advisor.auth.message');
        DB::commit();
        session()-> flash('success','Welcome '.$data['name'].', you register successfully. <br> Now you can login');
        return redirect(advisorURL('login'));
    }

    protected function reSendVerify(){
        $token = Hash::make(request("email"));
        DB::table('password_resets')->insert([
            'email' => request("email"),
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);
        Mail::to(request('email'))->send(new AdvisorWelcome(['token' => $token ]));
        DB::commit();
        session()-> flash('success','Verify link sent to your email');
        return view('advisor.auth.message',['not'=>'']);
    }

    protected function verify($token){
        $check_token = DB::table('password_resets')
                ->where('token',$token)
                ->where('created_at','>', Carbon::now()->subHours(2))
            ->first();
        if(!empty($check_token)){
            DB::table('password_resets')->where('email',$check_token->email)->delete();
            DB::table('advisors')->where('email',$check_token->email)->update([
                'email_verified_at'=>Carbon::now(),
            ]);
            session()-> flash('success','Your email verified successfully, you can login now');
            return view('advisor.auth.login');
        }else{
            session()->flash('error','You have some error');
            return redirect(advisorURL('reSendVerify'));
        }
    }



    protected function forgotPassword(){
        return view('advisor.auth.forgot_password',['title'=>'Forgot Password']);
    }

    protected function forgotPasswordPost(){
        request()->validate([
            'email' => 'required',
        ]);
        $advisor = Advisor::where('email',request('email'))->first();
        if(!empty($advisor)){
            $token = app('auth.password.broker')->createToken($advisor);
            DB::table('password_resets')->insert([
                'email' => $advisor->email,
                'token' => $token,
                'created_at' => Carbon::now(),
            ]);
            Mail::to(request('email'))->send(new AdvisorResetPassword([ 'data' => $advisor , 'token' => $token ]));
            session()-> flash('success','Reset link is sent to your email');
            return back();
        }else{
            session()->flash('error',"Email incorrect");
        }
        return back();
    }

    protected function resetPassword(){
        $this->validate(request(),[
            'email' => 'required',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required'
        ],[],[
            'email' => trans('admin.email'),
            'password' => trans('admin.password'),
            'password_confirmation' => trans('admin.password_confirmation')
        ]);
        $check_token = DB::table('password_resets')
            ->where('email',request('email'))
            ->where('token',request('token'))
            ->where('created_at','>', Carbon::now()->subHours(2))
            ->first();
        if (!empty($check_token)){
            if(Advisor::where('email',request('email'))
                ->update(['password'=>bcrypt(request('password'))])){
                DB::table('password_resets')->where('email',request('email'))->delete();
                session()->flash('success','Your password reset successfully');
                return redirect(advisorURL('login'));
            }else{
                session()->flash('error','You have some error');
                return back();
            }
        }else{
            session()->flash('error','You have some error');
            return back();
        }
    }
}
