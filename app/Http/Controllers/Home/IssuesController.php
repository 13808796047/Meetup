<?php

namespace App\Http\Controllers\Home;

use App\Models\Issue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Http\Requests\StoreIssue, App\Http\Requests\UpdateIssue;
class IssuesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $issues = Issue::with('user','comments')->orderBy('created_at', 'desc')->paginate(5);
        return view('home.issues.index')->with('issues', $issues);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::check()){
            return redirect('/')->with('alert','没有执行此操作的权限,请先登录!');
        }
        return view('home.issues.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIssue $request)
    {

        Issue::create($request->all());
        return redirect('/')->with('notice','Issue 新增成功');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Issue $issue)
    {


        $comments = $issue->comments()->with('user')->get();
        return view('home.issues.show',compact('issue','comments','content'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Issue $issue )
    {


        return view('home.issues.edit')->with('issue', $issue);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateIssue $request, Issue $issue)
    {

        $issue->update($request->all());
        return redirect(route('issues.show', $issue->id))->with('notice', 'Issue 修改成功~');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Issue $issue)
    {
        Issue::delete();
        return redirect('/')->with('alert', 'Issue 删除成功~');;
    }
}
