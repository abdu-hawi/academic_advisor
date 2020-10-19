<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\LinksDataTable;
use App\Http\Controllers\Controller;
use App\Model\Admin\Link;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class LinksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param LinksDataTable $dataTable
     * @return Response
     */
    public function index(LinksDataTable $dataTable){
        return $dataTable->render('admin.links.home',['title' => 'Links']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(){
        return view('admin.links.create',['title' => 'Create New Link']);
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
            'title'=>'required|unique:links',
            'url'=>'required|url|unique:links'
        ],[],[
            'title'=>'Title',
            'url'=>'Link'
        ]);
        if(DB::table('links')->insert($data))
        session()->flash('success',"Link add success");
        return redirect(aurl('links'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit($id){
        $link = Link::where('id','=',$id)->first();
        return view('admin.links.edit',['title' => 'Edit Link', 'link'=>$link]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Application|RedirectResponse|Redirector
     * @throws ValidationException
     */
    public function update(Request $request, $id){
        $data = $this->validate($request,[
            'title'=>'required|unique:links,title,'.$id,
            'url'=>'required|url|unique:links,url,'.$id
        ],[],[
            'title'=>'Title',
            'url'=>'Link'
        ]);
        DB::table('links')->where('id',$id)->update(['title'=>$data['title'],'url'=>$data['url']]);
        session()->flash('success',"Link update successfully");
        return redirect(aurl('links'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy($id){
        DB::table('links')->delete($id);
        session()->flash('success',"Link delete successfully");
        return redirect(aurl('links'));
    }
}
