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
                    <div class="am-comment-bd"><p>{!! markdown($issue->content) !!}</p></div>
                </div>
            </li>
            @foreach($comments as $comment)
                @include('home.shared._comment')
            @endforeach
        </ul>
        @if(Auth::check())
            {!! Form::open(['route' => 'comments.store', 'class' => 'am-form']) !!}
            {!! Form::hidden('issue_id', $issue->id) !!}
            {!! Form::hidden('user_id', Auth::id()) !!}
            <fieldset>
                <div class="am-form-group">
                    {{ Form::textarea('content', null,  ['rows' => '5', 'placeholder' => '填写评论内容，支持markdown。']) }}
                </div>

                <p>
                    {{ Form::submit('提交', ['class' => 'am-btn am-btn-default', 'id'=>'store-comment']) }}
                </p>
            </fieldset>
            {!! Form::close() !!}
        @else
            <p>
                <a href="{{route('login')}}" class="am-btn am-btn-secondary am-btn-block">
                    <span class="am-icon-user"></span> 登录后发评论
                </a>
            </p>
        @endif
    </div>
@endsection
@section('scripts')
    <script>
        $(function () {
            $("#store-comment").click(function () {
                $.post("/comments", $("form").serialize(), function (data) {

                    $(".am-comments-list").append(data);
                    $("textarea").val('');
                    // $('pre > code').each(function () {
                    //     this
                    // });
                })

                return false;
            })
        })
    </script>
@endsection