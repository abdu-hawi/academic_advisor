<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Model\Collect\Plane;
use App\Model\Collect\Score;
use App\Model\Collect\Student;
use App\Model\Course;
use App\Model\Interest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PlaneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(){
        $id = student()->id();
        $plane = Plane::query()->where('student_id',$id)->with('course')->get();
        //TODO Plan query not good hint 6
        $arrOne = [];$arrTow = [];$arrThree = [];$arrFour = [];$arrFive = [];$arrSix = [];$arrSeven = [];
        for ($i=0;$i<10;$i++){
            switch ($plane[$i]->level){
                case 1:array_push($arrOne,$plane[$i]); break;
                case 2:array_push($arrTow,$plane[$i]); break;
                case 3:array_push($arrThree,$plane[$i]); break;
                case 4:array_push($arrFour,$plane[$i]); break;
                case 5:array_push($arrFive,$plane[$i]); break;
                case 6:array_push($arrSix,$plane[$i]); break;
                case 7:array_push($arrSeven,$plane[$i]); break;
            }
        }
        $courses = [$arrOne,$arrTow,$arrThree];
        if (count($arrFour) > 0) array_push($courses,$arrFour);
        if (count($arrFive) > 0) array_push($courses,$arrFive);
        if (count($arrSix) > 0) array_push($courses,$arrSix);
        if (count($arrSeven) > 0) array_push($courses,$arrSeven);

        return view('student.plane.home',['title'=>'Plan','courses'=>$courses]);
    }

    public function show($id){
        if(request()->has('interest_id')){
            DB::beginTransaction();
            $s = Student::query()->where('id',$id)->first();
            $interest = Interest::query()->where('id',$s->interest_id)->with('f_course')->first();
            $f_course_id = $interest->f_course->id;
            $s_course_id = $interest->s_course->id;
            $newInterest = Interest::query()->where('id',request('interest_id'))->with('f_course')->first();
            $new_f_course_id = $newInterest->f_course->id;
            $new_s_course_id = $newInterest->s_course->id;
            Plane::query()->where('student_id',$id)->where('course_id',$f_course_id)->update([
                'course_id'=>$new_f_course_id
            ]);
            Plane::query()->where('student_id',$id)->where('course_id',$s_course_id)->update([
                'course_id'=>$new_s_course_id
            ]);
            Student::query()->where('id',$id)->update([
                'interest_id'=>request('interest_id')
            ]);
            DB::commit();
        }
        return view('student.plane.edit',[
            'title'=>'Edit plan',
            'courses'=>$this->getPlanToShowForEdit($id),
            'id'=>$id
        ]);
    }

    private function getPlanToShowForEdit($id){
        $plane = Plane::query()->where('student_id',$id)->with('course')->get();
        $arrOne = [];$arrTow = [];$arrThree = [];$arrFour = [];$arrFive = [];
        for ($i=0;$i<10;$i++){
            switch ($plane[$i]->level){
                case 1:array_push($arrOne,$plane[$i]); break;
                case 2:array_push($arrTow,$plane[$i]); break;
                case 3:array_push($arrThree,$plane[$i]); break;
                case 4:array_push($arrFour,$plane[$i]); break;
                case 5:array_push($arrFive,$plane[$i]); break;
            }
        }
        $courses = [$arrOne,$arrTow,$arrThree];
        if (count($arrFour) > 0) array_push($courses,$arrFour);
        if (count($arrFive) > 0) array_push($courses,$arrFive);
        return $courses;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update( $id)
    {
        DB::beginTransaction();
        Plane::where('student_id',$id)->delete();
        $level = 1;
        for ($i=0;$i<count(request('level'));$i++){
            for ($m=0;$m<count(request('level')[$i]);$m++){
                if (isset(request('grade')[$i][$m])){
                    Plane::create([
                        'student_id'=>$id,
                        'level'=>$level,
                        'course_id'=>request('level')[$i][$m],
                        'grade'=>request('grade')[$i][$m],
                    ]);
                }else{
                    Plane::create([
                        'student_id'=>$id,
                        'level'=>$level,
                        'course_id'=>request('level')[$i][$m],
                        'grade',
                    ]);
                }
            }
            $level++;
        }
        DB::commit();
        return redirect(studentURL('plans'));
    }

    protected function plane($id){
        $cnt = count(request('level')) + 1;
        DB::beginTransaction();
        Plane::where('student_id',$id)->delete();
        $gpa = 0;
        for ($i=1;$i<$cnt;$i++){
            for ($m=0;$m<count(request('level')[$i]);$m++){
                if (isset(request('grade')[$i][$m])){
                    Plane::create([
                        'student_id'=>$id,
                        'level'=>$i,
                        'course_id'=>request('level')[$i][$m],
                        'grade'=>request('grade')[$i][$m],
                    ]);
                    $gpa = request('grade')[$i][$m];
                    DB::table("scores")->insert([
                        'course_id'=>request('level')[$i][$m],
                        'score'=>request('grade')[$i][$m]
                    ]);
                }else{
                    Plane::create([
                        'student_id'=>$id,
                        'level'=>$i,
                        'course_id'=>request('level')[$i][$m],
                        'grade',
                    ]);
                }
            }
        }

        Student::query()->where('id',$id)->update([
            'gpa'=>$gpa,
            'has_plane'=>true,
        ]);
        DB::commit();
        //TODO: Change student table isPlane
        session()->forget(['coursesFinish','level_finish','gpa','coursesNotFinish']);
        if (request()->has("createByStudent")){
            //TODO msg from server
        }else{
            session()->flash('success', "This is a long term plan suggested by the system considering your interests and the college rules.
<br>It designed based on your interest, the passed course if there, the shortest graduation path (3 or 4 courses per semester).
You can modify it any time if you want.<br>
<br>
I hope that satisfies you.<br>
Good Luck");
        }

        return redirect(studentURL('plans'));
    }

    protected function edit($id){
        $i = Interest::query()->where('id',\student()->user()->interest_id)->first();
        return view('student.plane.editChoice',['title'=>'Edit plane','id'=>$id,'interest'=>$i->name]);
    }

    protected function plane_edit($id){
        //interest_id
        $interest = Interest::query()->where('id','=',student()->user()->interest_id)->first();
        $course = Course::query()
            ->where('type','Mandatory')
            ->get();
        $interest1 = Course::query()
            ->where('id',$interest->first_course)
            ->first();
        $interest2 = Course::query()
            ->where('id',$interest->second_course)
            ->first();
        $thesis = Course::query()
            ->where('type','Thesis')
            ->first();
        $arr = [];//$interest1,$interest2,$thesis
        foreach ($course as $c){
            array_push($arr,$c);
        }
        array_push($arr,$interest1);
        array_push($arr,$interest2);
        array_push($arr,$thesis);
        $student = student()->user()->num_course;
        $gpaAvg = gpaAvg();
        if ($student == 3)
            return view('student.plane.create',['title'=>'Create Plane',"courses"=>$arr,'id'=>$id, 'avg'=>$gpaAvg]);
        else
            return view('student.plane.create4',['title'=>'Create Plane',"courses"=>$arr,'id'=>$id, 'avg'=>$gpaAvg]);
    }

    protected function planeSeniorEdit($id){
        $coursesFinish = session('coursesFinish');
        $levelFinish = session('level_finish');
        $gpa = session('gpa');
        $coursesNotFinish = session('coursesNotFinish');
        $numCourse = student()->user()->num_course;
        return view('student.plane.createSenior',[
            'title'=>'Create Plane',
            "coursesFinish"=>$coursesFinish,
            "levelFinish"=>$levelFinish,
            "gpa"=>$gpa,
            "coursesNotFinish"=>$coursesNotFinish,
            "numCourse"=>$numCourse,
            'id'=>$id
        ]);
    }
}
