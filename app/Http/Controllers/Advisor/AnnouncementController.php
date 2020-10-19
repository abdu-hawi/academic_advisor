<?php

namespace App\Http\Controllers\Advisor;


use App\Http\Controllers\Controller;
use App\Model\Collect\Announcement;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(){
        $a = Announcement::query()->where('advisor_id',advisor()->user()->id)->with('student')->paginate(25);
        return view('advisor.announcement.home',['title'=>'Announcement','a'=>$a]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(){
        return view('advisor.announcement.create',['title'=>'Send Announcement']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     * @throws ValidationException
     */
    public function store(Request $request){
        $data = $this->validate($request,[
            'student_id'=>'required|array|min:1',
            'message'=>'required',
        ],[],[
            'student_id'=>'you must select student',
            'message'=>'message',
        ]);
        $ad = advisor()->user()->id;
        foreach (request('student_id') as $s){
            Announcement::create([
                'student_id'=>$s,
                'advisor_id'=>$ad,
                'message'=>request('message')
            ]);
        }
        session()->flash('success','Announcement sent to student');
        return redirect(advisorURL('announcements'));
    }
}
