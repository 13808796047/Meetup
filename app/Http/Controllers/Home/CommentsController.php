<?php

namespace App\Http\Controllers\Home;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentsController extends Controller
{
    public function store(Request $request)
    {
        Comment::create($request->all());
        return back()->with('notice', 'Comment 新增成功~');
    }
}
