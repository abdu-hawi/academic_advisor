<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Model\Admin\FAQ;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
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
        return view('student.faq.home',[
            "title"=>'FAQ',
            'faqs'=>FAQ::query()->select(['id','question','answer'])->orderBy('id','desc')->paginate(10)
        ]);
    }

}
