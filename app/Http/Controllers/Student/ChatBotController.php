<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Model\Collect\ChatterAnswer;
use App\Model\Collect\ChatterQuestion;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ChatBotController extends Controller
{
    public function chatter()
    {
        $ex = explode(" ",request('question'));
//        if (count($ex)<3) return "PLEASE WRITE MORE DESCRIPTION TO UNDERSTAND YOU";
        $arr = [];
        foreach ($ex as $e){
            array_push($arr,ChatterQuestion::where('question', 'like', '%'.strtolower($e).'%')->with('answer')->get());
        }
        $cntCompareResult =[];
        foreach ($arr[0] as $a){
            // 1-
            $explode = explode(' ',$a->question);
            // 2
            $compareInputWithExplode = array_intersect($ex,$explode);
            //3 , 4
            array_push($cntCompareResult,count($compareInputWithExplode));
        }
        if (count($cntCompareResult) < 1) return "I'M NOT SURE IF I UNDERSTAND WHAT YOU ARE TALKING ABOUT";
        // 5
        $key = array_search(max($cntCompareResult),$cntCompareResult);
//        dd($arr[0][$key]);
        return $arr[0][0]->answer->answer;// الصفر الاولى ثابته والثانية للعناصر العائدة
    }
}
