<?php

namespace App\Http\Controllers\Advisor;

use App\Http\Controllers\Controller;
use App\Model\Admin\FAQ;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class FAQController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('advisor.faq.home',[
            "title"=>'FAQ',
            'faqs'=>FAQ::query()->select(['id','question','answer'])->orderBy('id','desc')->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('advisor.faq.create',["title"=>'New FAQ']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $data = $this->validate($request,[
            'answer'=>'required',
            'question'=>'required'
        ],[],[
            'answer'=>'Answer',
            'question'=>'Question',
        ]);

        FAQ::create($data);
        session()->flash('success',"New FAQ create successfully");
        return redirect(advisorURL('faq'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     * @throws ValidationException
     */
    public function update(Request $request, $id)
    {
        if ($request->ajax()){
            $data = $this->validate($request,[
                'answer'=>'required',
                'question'=>'required'
            ],[],[
                'answer'=>'Answer',
                'question'=>'Question',
            ]);

            FAQ::where('id',$id)->update($data);
            return response('update');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        if (FAQ::find($id)->delete())
            return response("delete");
        else
            return response("no");
    }
}
