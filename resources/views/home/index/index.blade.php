@extends('layouts.app')
@section('content')
    <div class="get">
        <div class="am-g">
            <div class="am-u-lg-12">
                <h1 class="get-title">It's Party Time!<br>Drink Up!</h1>

                <p>到时聚聚、聊聊程序</p>

                <p>
                    <a href="issues_create.html" class="am-btn am-btn-default am-btn-secondary">发布新活动</a>
                </p>
            </div>
        </div>
    </div>

    <div class="detail">
        <div class="am-g am-container">
            <div class="am-u-lg-12">
                <h1 class="detail-h1">最新的活动</h1>
            </div>
        </div>
    </div>

    <div class="am-container">
        <div data-am-widget="list_news" class="am-list-news am-list-news-default">
            <!--列表标题-->
            <div class="am-list-news-bd">
                <ul class="am-list">

                    <li class="am-g am-list-item-desced am-list-item-thumbed am-list-item-thumb-left">
                        <div class="am-u-sm-2 am-u-md-1 am-list-thumb">
                            <a href="issues_show.html">
                                <img src="/assets/img/avatar1.png" alt=""/>
                            </a>
                        </div>

                        <div class="am-u-sm-7 am-u-md-9 am-list-main">
                            <h3 class="am-list-item-hd">
                                <a href="issues_show.html" class="">Laravel Meetup</a>
                            </h3>

                            <div class="am-list-item-text">
                                <span class="am-badge am-badge-secondary am-radius">read</span>
                                <span class="meta-data">Aaron</span>
                                3 days ago
                            </div>
                        </div>
                        <div class="am-u-sm-3 am-u-md-2 issue-comment-count">
                            <span class="am-icon-comments"></span>
                            <a href="issues_show.html">2</a>
                        </div>
                    </li>

                    <li class="am-g am-list-item-desced am-list-item-thumbed am-list-item-thumb-left">
                        <div class="am-u-sm-2 am-u-md-1 am-list-thumb">
                            <a href="issues_show.html">
                                <img src="/assets/img/avatar1.png" alt=""/>
                            </a>
                        </div>

                        <div class="am-u-sm-7 am-u-md-9 am-list-main">
                            <h3 class="am-list-item-hd">
                                <a href="issues_show.html">Aaron is by your side!</a>
                            </h3>

                            <div class="am-list-item-text">
                                <span class="am-badge am-badge-secondary am-radius">read</span>
                                <span class="meta-data">Aaron</span>
                                7 days ago
                            </div>
                        </div>
                        <div class="am-u-sm-3 am-u-md-2 issue-comment-count">
                            <span class="am-icon-comments"></span>
                            <a href="issues_show.html">0</a>
                        </div>
                    </li>

                </ul>
            </div>
        </div>
    </div>
@endsection