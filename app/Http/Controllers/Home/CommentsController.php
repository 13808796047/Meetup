<?php

namespace App\Http\Controllers\Home;

use App\Model\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentsController extends Controller
{
    public function store(Request $request)
    {
        Comment::create($request->all());
        return back();
    }
}
