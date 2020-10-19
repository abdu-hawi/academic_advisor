<?php

namespace App\Http\Controllers\Advisor;

use App\Http\Controllers\Controller;
use App\Model\Collect\Plane;
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
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @param $name
     * @return Application|Factory|View
     */
    public function edit($id,$name)
    {
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
        return view('advisor.plan.edit',['title'=>'Edit plan','courses'=>$courses,'id'=>$id,'name'=>$name]);
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
                    $gpa = request('grade')[$i][$m];
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
        return redirect(advisorURL('students'));
    }

}
