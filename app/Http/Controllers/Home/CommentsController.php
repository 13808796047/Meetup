<?php

namespace App\Http\Controllers\Home;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentsController extends Controller
{
    public function store(Request $request)
    {
        $comment = Comment::create($request->all());
        return view('home.shared._comment', compact('comment'));
    }
}
