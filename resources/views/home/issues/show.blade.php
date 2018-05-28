@extends('layouts.app')
@section('content')
    <div class="issue-heading">
        <div class="am-container">
            {{$issue->title}}
            @if(Auth::check()&&Auth::user()==$issue->user)
            <a type="button" href="{{route('issues.destroy',$issue->id)}}" data-method="delete"
               data-token="{{csrf_token()}}" data-confirm="确定删除吗?"
               class="am-btn am-btn-danger am-radius am-btn-sm">删除</a>
            <a type="button" href="{{route('issues.edit',$issue->id)}}"
               class="am-btn am-btn-primary am-radius am-btn-sm">修改</a>
                @endif
        </div>
    </div>

    <div class="am-container">
        <ul class="am-comments-list am-comments-list-flip">

            <li class="am-comment">
                <img src="{{$issue->user->avatar()}}" alt="" class="am-comment-avatar" width="100" height="100">
                <div class="am-comment-main">
                    <header class="am-comment-hd">
                        <div class="am-comment-meta">
                            <span class="am-comment-author">{{$issue->user->name}}</span>
                        </div>
                    </header>
                    <div class="am-comment-bd"><p>{{$issue->content}}</p></div>
                </div>
            </li>
            @foreach($comments as $comment)
                <li class="am-comment">
                    <img src="{{$comment->avatar()}}" alt="" class="am-comment-avatar" width="48" height="48">

                    <div class="am-comment-main">
                        <header class="am-comment-hd">
                            <div class="am-comment-meta">
                                <span class="am-comment-author">{{$comment->name}}</span>
                                {{$comment->created_at}}
                            </div>
                        </header>
                        <div class="am-comment-bd"><p>{{$comment->content}}</p></div>
                    </div>
                </li>
            @endforeach
        </ul>
        @if(Auth::check())
        <form class="am-form" method="post" action="{{route('comments.store')}}">
            {{csrf_field()}}
            <input type="hidden" name="issue_id" value="{{$issue->id}}">
            <fieldset>
                <div class="am-form-group">
                    <label>用户名</label>
                    <input type="text" placeholder="输入用户名" name="name">
                </div>

                <div class="am-form-group">
                    <label>邮箱</label>
                    <input type="email" placeholder="输入邮箱" name="email">
                </div>

                <div class="am-form-group">
                    <textarea rows="5" name="content"></textarea>
                </div>

                <p>
                    <button type="submit" class="am-btn am-btn-default">提交</button>
                </p>
            </fieldset>
        </form>
        @else
            <p>
                <a href="{{route('login')}}" class="am-btn am-btn-secondary am-btn-block">
                    <span class="am-icon-user"></span> 登录后发评论
                </a>
            </p>
        @endif
    </div>
@endsection