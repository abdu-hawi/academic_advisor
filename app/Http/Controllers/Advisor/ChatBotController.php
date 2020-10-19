<?php

namespace App\Http\Controllers\Advisor;

use App\Http\Controllers\Controller;
use App\Model\Collect\ChatterAnswer;
use App\Model\Collect\ChatterQuestion;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ChatBotController extends Controller
{
    protected function index(){
        $answer = ChatterAnswer::query()->with('question')->paginate(10);
        return view('advisor.chatbot.home',['title'=>'Chatbot','answers'=>$answer]);
    }

    protected function create(){
        return view('advisor.chatbot.create');
    }

    /**
     * @throws ValidationException
     */
    protected function store(){
        $this->validate(request(),[
            'answer'=>'required',
            'question'=>'required|array|min:1'
        ]);
        $answer = ChatterAnswer::create([
            'answer'=>strtolower(request('answer'))
        ]);
        foreach (request('question') as $value){
            if ($value != null){
                ChatterQuestion::create([
                    'answer_id'=>$answer->id,
                    'question'=>strtolower($value)
                ]);
            }
        }
        session()->flash('success','Records add successfully');
        return redirect(advisorURL('chatter'));
    }

    public function destroy($id)
    {
        if (ChatterAnswer::find($id)->delete())
            return response("delete");
        else
            return response("no");
    }
}
