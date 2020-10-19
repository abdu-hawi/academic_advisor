<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Mail\StudentWelcome;
use App\Model\Collect\Plane;
use App\Model\Collect\Student;
use App\Model\Course;
use App\Model\Interest;
use App\Model\UserCollect;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class StudentAuthController extends Controller
{
    protected function login(){
        return view('student.auth.login');
    }

    protected function registerPage(){
        return view('student.auth.register');
    }

    /**
     * @throws ValidationException
     */
    protected function registerPost(){
        $data = $this->validate(request(),[
            'name'=>'required',
            'email'=>'required|unique:students',
            'password'=>'required|confirmed|min:6',
            'phone'=>'required|numeric',
            'interest_id'=>'required|numeric',
            'num_course'=>'required|in:3,4',
        ],[],[
            'name'=>'Name',
            'email'=>'Email',
            'password'=>'Password',
            'phone'=>'Phone number',
            'interest_id'=>'Interest',
            'num_course'=>'Number course you want learn',
        ]);
        DB::beginTransaction();
        $collect = UserCollect::create([
            'type'=>'student'
        ]);
        $student = Student::create([
            'id'=>$collect->id,
            'name'=>$data['name'],
            'email'=>$data['email'],
            'password'=>Hash::make($data['password']),
            'phone'=>$data['phone'],
            'interest_id'=>$data['interest_id'],
            'num_course'=>$data['num_course'],
        ]);

        DB::commit();
        session()-> flash('success','Welcome '.$data['name'].', you register successfully. <br> Now you can login');
        return redirect(studentURL('login'));
//        $token = app('auth.password.broker')->createToken($student);
//        DB::table('password_resets')->insert([
//            'email' => $data['email'],
//            'token' => $token,
//            'created_at' => Carbon::now(),
//        ]);
//        Mail::to(request('email'))->send(new StudentWelcome([ 'data' => $student , 'token' => $token ]));
//        DB::commit();
//        session()-> flash('success','Welcome '.$data['name'].', please check your email to active your account');
//        return view('student.auth.message',['not'=>'']);
//        return redirect(studentURL('register/'.$collect->id));
    }

    protected function verify($token){
        $check_token = DB::table('password_resets')
            ->where('token',$token)
            ->where('created_at','>', Carbon::now()->subHours(2))
            ->first();
        if(!empty($check_token)){
            DB::table('password_resets')->where('email',$check_token->email)->delete();
            DB::table('students')->where('email',$check_token->email)->update([
                'email_verified_at'=>Carbon::now(),
            ]);
            session()-> flash('success','Your email verified successfully, you can login now');
            return view('student.auth.login');
        }else{
            session()->flash('error','You have some error');
            return redirect(studentURL('reSendVerify'));
        }
    }

    protected function doLogin(){
        $remember = request('rememberMe') == 'on' ? true : false;
        request()->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        if (student()->attempt([
            'email' => request('email'),
            'password' => request('password')
        ], $remember)) {
            $student = Student::where('email',request('email'))->first();
            if ($student->has_plane)
                return redirect(studentURL());
            else
                return redirect(studentURL('register/'.$student->id));

        } else {
            session()->flash('error', "Email or Password incorrect");
            return redirect(studentURL('login'));
        }
    }

    protected function registerContinueGet($id){
        return view('student.auth.continue_register',['id'=>$id]);
    }

    /**
     * @param $id
     * @return Application|Factory|RedirectResponse|View
     * @throws ValidationException
     */
    protected function registerContinuePost($id){
        $student = Student::where('id',$id)->first();
        if (request('type') == "new_student"){
            $num = $student->num_course;
            $interest = $student->interest_id;
            if ($num == 3){
                $level = $this->newNum3($num,$interest);
                return view('student.init_level.new_3',['level'=>$level,'title'=>'Generate Plan', 'id'=>$id]);
            }else{
                $level = $this->newNum4($num,$interest);
                return view('student.init_level.new_4',['level'=>$level,'title'=>'Generate Plan', 'id'=>$id]);
            }
        }else{
            $this->validate(request(),[
                'gpa'=>'required|between:0.01,5',
                'level_finish'=>'required|between:1,6',
                'interest_id'=>'required|numeric',
                'course_finish'=>'required',
            ],[],[
                'gpa'=>'GPA',
                'level_finish'=>'Level Finish',
                'interest_id'=>'Interest',
                'course_finish'=>'Course Finish',
            ]);
            // use to check if user choice any courses out of his interest
            $arr = [601,602,603,604,605,606,694,699];
            $interest = Interest::where('id',request('interest_id'))->get();
            array_push($arr,$interest[0]->f_course->code);
            array_push($arr,$interest[0]->s_course->code);
            $finish = explode(",",request('course_finish'));
            foreach ($finish as $f){
                if ($f != "") {
                    $f = Course::where('id', $f)->first();
                    $f = $f->code;
                    if (!array_search($f, $arr) && $f != 601) {
                        session()->flash('error', "You choice some course not in your interest");
                        return back();
                    }
                }
            }
            // End **use to check if user choice any courses out of his interest**
            $courses = $this->senior($finish);
            $gpaAvg = gpaAvg();
            return view('student.init_level.senior',[
                'title'=>'Generate Plane', 'id'=>$id,
                'coursesFinish'=>$courses[0],
                'coursesNotFinish'=>$courses[1],
                'gpa'=>request('gpa'),
                'level_finish'=>request('level_finish'),
                'num_course'=>student()->user()->num_course,
                'gpaAvg' => $gpaAvg
            ]);
        }
    }

    private function senior($courses_finish){
        $CoursesFinish = [];
        $CoursesFinishCode = [];
        $arr = [601,602,603,604,606,605,694];
        $interest = Interest::where('id',request('interest_id'))->get();
        array_push($arr,$interest[0]->f_course->code);
        array_push($arr,$interest[0]->s_course->code);
        array_push($arr,699);
        foreach ($courses_finish as $f){
            if ($f != "") {
                $f = Course::where('id', $f)->first();
                $c = $f->code;
                array_push($CoursesFinishCode, $c);
                array_push($CoursesFinish, $f);
            }
        }
        $courseCodeNotFinish=array_diff($arr,$CoursesFinishCode);
//        dd($courseCodeNotFinish);
        array_splice($courseCodeNotFinish,999,1);
        $numCourse = student()->user()->num_course;
        $numLevel = ceil(count($courseCodeNotFinish)/$numCourse);

        $level1=[];
        $level2=[];
        $level3=[];
        $level4=[];
        $levelParent = [$level1,$level2,$level3,$level4];
        for ($m=0;$m<$numLevel;$m++){
            $iCode = $interest[0]->f_course->code;
            if (count($courseCodeNotFinish) <= $numCourse){
                $cnt = count($courseCodeNotFinish);
                for ($i=0;$i<$cnt;$i++){
                    if (array_search(606,$courseCodeNotFinish)){
                        $f = Course::where('code',606)->first();
                        array_push($levelParent[$m],$f);
                        array_splice($courseCodeNotFinish,array_search(606,$courseCodeNotFinish),1);
                    }elseif (array_search($iCode,$courseCodeNotFinish)){
                        $f = Course::where('code',$iCode)->first();
                        array_push($levelParent[$m],$f);
                        array_splice($courseCodeNotFinish,array_search($iCode,$courseCodeNotFinish),1);
                    }else{
                        $code = $courseCodeNotFinish[0];
                        $f = Course::where('code',$code)->first();
                        array_push($levelParent[$m],$f);
                        array_splice($courseCodeNotFinish,0,1);
                    }
                }
            }else{
                for ($i=0;$i<$numCourse;$i++){
                    if (array_search(606,$courseCodeNotFinish)){
                        $f = Course::where('code',606)->first();
                        array_push($levelParent[$m],$f);
                        array_splice($courseCodeNotFinish,array_search(606,$courseCodeNotFinish),1);
                    }elseif (array_search($iCode,$courseCodeNotFinish)){
                        $f = Course::where('code',$iCode)->first();
                        array_push($levelParent[$m],$f);
                        array_splice($courseCodeNotFinish,array_search($iCode,$courseCodeNotFinish),1);
                    }else{
                        $code = $courseCodeNotFinish[0];
                        $f = Course::where('code',$code)->first();
                        array_push($levelParent[$m],$f);
                        array_splice($courseCodeNotFinish,0,1);
                    }
                }
            }
        }

        $coursesNotFinish = [];
        for ($i=0;$i<count($levelParent);$i++){
             for ($d=0;$d<count($levelParent[$i]);$d++){
                 array_push($coursesNotFinish,$levelParent[$i][$d]);
             }
        }
//        dd($coursesNotFinish);
        return [$CoursesFinish,$coursesNotFinish];
    }

    private function newNum3($num,$interest){
        $level1 = Course::where('type','Mandatory')->limit($num)->get();
        $level2_1 = Course::where('type','Mandatory')
            ->where('id','!=',$level1[0]->id)
            ->where('id','!=',$level1[1]->id)
            ->where('id','!=',$level1[2]->id)
            ->limit($num-1)->get();
        $select2_2 = Interest::where('id',$interest)->with('f_course')->first();
        $level2_2 = $select2_2->f_course;
        $level2 = [$level2_1,$level2_2];
        $level3_1 = Course::where('type','Mandatory')
            ->where('id','!=',$level1[0]->id)
            ->where('id','!=',$level1[1]->id)
            ->where('id','!=',$level1[2]->id)
            ->where('id','!=',$level2_1[0]->id)
            ->where('id','!=',$level2_1[1]->id)
            ->limit($num-1)->get();
        $select3_2 = Interest::where('id',$interest)->with('s_course')->first();
        $level3_2 = $select3_2->s_course;
        $level3 = [$level3_1,$level3_2];
        $level4 = Course::where('type','Thesis')->first();
//        dd($select2_2->s_course->code);
        return [$level1,$level2,$level3,$level4];
    }

    private function newNum4($num,$interest){
        $level1 = Course::where('type','Mandatory')->limit($num)->get();
        $level2_1 = Course::where('type','Mandatory')
            ->where('id','!=',$level1[0]->id)
            ->where('id','!=',$level1[1]->id)
            ->where('id','!=',$level1[2]->id)
            ->where('id','!=',$level1[3]->id)
            ->limit($num-1)->get(); // 3 main
        $select2_2 = Interest::where('id',$interest)->with('f_course')->first();
        $level2_2 = $select2_2->f_course;
        $level2 = [$level2_1,$level2_2];
        $select3_2 = Interest::where('id',$interest)->with('s_course')->first();
        $level3_2 = $select3_2->s_course;
        $level3 = Course::where('type','Thesis')->first();
        $level3 = [$level3_2,$level3];
//        dd($select2_2->s_course->code);
        return [$level1,$level2,$level3];
    }

    protected function logout(){
        student()->logout();
        session()->invalidate();
        return redirect(studentURL('login'));
    }
}
