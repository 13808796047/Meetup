<?php

namespace App\Http\Controllers\Home;

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
        return view ('home.index.index');
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
