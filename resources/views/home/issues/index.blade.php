@extends('layouts.app')
@section('content')
    <div class="detail">
        <div class="am-g am-container">
            <div class="am-u-lg-12">
                <h1 class="detail-h1">所有的活动都在下面了...</h1>
            </div>
        </div>
    </div>
    <div class="am-container">
        <div data-am-widget="list_news" class="am-list-news am-list-news-default">
            <!--列表标题-->
            <div class="am-list-news-bd">
                <ul class="am-list">
                    @include('home.shared._issue_list')
                </ul>

                {{$issues->links()}}
            </div>
        </div>
    </div>
@endsection