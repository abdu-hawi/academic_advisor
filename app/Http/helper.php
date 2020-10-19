<?php

use App\Model\Collect\Score;
use Illuminate\Support\Facades\Request;

if(!function_exists('aurl')){
    function aurl($url=null){
        return url('admin/'.$url);
    }
}

if(!function_exists('admin')){
    function admin(){
        return auth()->guard('admin');
    }
}

if (!function_exists("gpaAvg")){
    function gpaAvg(){
        $avg = [];
        for ($i=14;$i<=29;$i++){
            $score = Score::query()->where('course_id',$i)->avg('score');
            switch ($i){
                case 14:
                    $avg[601] = round($score,2);
                    break;
                case 15:
                    $avg[602] = round($score,2);
                    break;
                case 16:
                    $avg[603] = round($score,2);
                    break;
                case 17:
                    $avg[604] = round($score,2);
                    break;
                case 18:
                    $avg[605] = round($score,2);
                    break;
                case 19:
                    $avg[606] = round($score,2);
                    break;
                case 20:
                    $avg[694] = round($score,2);
                    break;
                case 21:
                    $avg[620] = round($score,2);
                    break;
                case 22:
                    $avg[621] = round($score,2);
                    break;
                case 23:
                    $avg[630] = round($score,2);
                    break;
                case 24:
                    $avg[631] = round($score,2);
                    break;
                case 25:
                    $avg[640] = round($score,2);
                    break;
                case 26:
                    $avg[641] = round($score,2);
                    break;
                case 27:
                    $avg[696] = round($score,2);
                    break;
                case 28:
                    $avg[697] = round($score,2);
                    break;
                case 29:
                    $avg[699] = round($score,2);
                    break;

            }
        }
        return $avg;
    }
}

if(!function_exists('active_menu')){
    function active_menu($link){
        if (preg_match('/'.$link.'/i',Request::segment(2))){
            return ['active' , 'menu-open' , 'display: block;'];
        }else{
            return ['','',''];
        }
    }
}

if(!function_exists('advisorURL')){
    function advisorURL($url=null){
        return url('advisor/'.$url);
    }
}

if(!function_exists('advisor')){
    function advisor(){
        return auth()->guard('advisor');
    }
}

if(!function_exists('studentURL')){
    function studentURL($url=null){
        return url('student/'.$url);
    }
}

if(!function_exists('student')){
    function student(){
        return auth()->guard('student');
    }
}
