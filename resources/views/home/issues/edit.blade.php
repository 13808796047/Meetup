@extends('layouts.app')
@section('content')
    <div class="am-container">
        <div class="header">
            <div class="am-g">
                <h1>修改活动</h1>
            </div>
            <hr>
        </div>

        <form class="am-form" action="{{route('issues.update',$issue->id)}}" method="post">
            {{csrf_field()}}
            {{method_field('PUT')}}
            <input type="hidden" name="user_id" value="{{Auth::id()}}">
            <fieldset>
                <div class="am-form-group">
                    <label>标题</label>
                    <input type="text" placeholder="输入活动标题" name="title" value="{{$issue->title}}">
                </div>

                <div class="am-form-group">
                    <label>内容</label>
                    <textarea rows="5" name="content">{{$issue->content}}</textarea>
                </div>

                <button type="submit" class="am-btn am-btn-default">提交</button>
            </fieldset>
        </form>
    </div>
@endsection