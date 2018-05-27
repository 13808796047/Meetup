<?php

namespace App\Http\Controllers\Home;

use App\Model\Issue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    /**
     * 首页
     * @return string
     */
    public function index()
    {
        $issues = Issue::orderBy('created_at','desc')->take(5)->get();

        return view ('home.index.index')->with('issues',$issues);
    }

    /**
     * 关于
     * @return string
     */
    public function about()
    {
        return view ('home.index.about');
    }
}
