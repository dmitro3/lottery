@extends('index')
@section('cssl')
<link rel="stylesheet" href="theme/frontend/css/swiper.min.css">
@endsection
@section('css')
<link rel="stylesheet" href="theme/frontend/css/home.css">
@endsection
@section('content')
<div id="app">
    <div class="home mian game">
        @include('static_blocks.logo')
        <div class="banner">
            <div class="swiper-container slider-home-main-banner">
                <div class="swiper-wrapper">
                    @foreach ($listSlider as $item)
                    <div class="swiper-slide">
                        <a href="{{$item->link != '' ? $item->link:'javascript:void(0)'}}">
                            <img src="{%IMGV2.item.img.-1%}" class="img">
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="slider-pagination">
                <div class="pagination-banner-home"></div>
            </div>
        </div>
        <div class="notice">
            <div class="notice-box c-row c-row-between">
                <div role="alert" class="van-notice-bar" style="font-size: 15px;"><i class="van-icon van-icon-volume-o van-notice-bar__left-icon">
                    </i>
                    <div role="marquee" class="van-notice-bar__wrap">
                        <div class="van-notice-bar__content">{[global_notifice]}</div>
                    </div>
                </div>
                <div class="txt">
                    <span class="sp">
                        <img src="theme/frontend/images/notice-right.5fdac404.svg" class="img">Thông báo mới nhất
                    </span>
                </div>
            </div>
        </div>
        @include('static_blocks.game_list')
        <div class="bonus-box">
            <div class="img van-image" style="width: 100%; height: 170px;"><img src="theme/frontend/images/coin-bonus.7945166d.png" class="van-image__img"></div>
            <div class="bonus-bg" style="">
                <div class="inner">
                    <span> 6788714619.00 ₫</span>
                </div>
            </div>
        </div>
        <div class="running-time">
            <p class="running-title c-tc"> Thời gian chạy trang web </p>
            <div class="c-row c-row-between" id="home-time-box" start="2010-01-01" style="padding: 0px 33px 30px;">
                <div class="flip-num day">
                    <div class="top"></div>
                    <div class="bottom">Ngày </div>
                    <div class="bottom-card">
                        <div class="back">
                            <p class="number"></p>
                        </div>
                        <div class="front c-tc"> Ngày </div>
                    </div>
                </div>
                <div class="flip-num hour">
                    <div class="top"></div>
                    <div class="bottom">Giờ</div>
                    <div class="bottom-card">
                        <div class="back">
                            <p class="c-tc number"></p>
                        </div>
                        <div class="front c-tc"> Giờ </div>
                    </div>
                </div>
                <div class="flip-num minute">
                    <div class="top"></div>
                    <div class="bottom c-tc"> Phút </div>
                    <div class="bottom-card">
                        <div class="back">
                            <p class="c-tc number"></p>
                        </div>
                        <div class="front c-tc"> Phút </div>
                    </div>
                </div>
                <div class="flip-num second">
                    <div class="top"></div>
                    <div class="bottom c-tc"> Giây</div>
                    <div class="bottom-card">
                        <div class="back c-tc">
                            <p class="c-tc number"></p>
                        </div>
                        <div class="front c-tc">Giây</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="web-info c-row c-row-between">
            <div class="item c-tc">
                <div class="c-row c-row-cetner">
                    <div class="img van-image" style="width: 40px; height: 40px;"><img src="data:image/png;base64,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" class="van-image__img"></div>
                </div>
                <div class="num">{{(int)(time()/14000) + rand(0,100)}}</div>
                <div class="txt"> Số lượng người dùng </div>
            </div>
            <div class="item c-tc">
                <div class="c-row c-row-cetner">
                    <div class="img van-image" style="width: 40px; height: 40px;"><img src="data:image/png;base64,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" class="van-image__img"></div>
                </div>
                <div class="num">{{(int)(time()*4)}}</div>
                <div class="txt"> Số lần đặt cược </div>
            </div>
            <div class="item c-tc">
                <div class="c-row c-row-cetner">
                    <div class="img van-image" style="width: 40px; height: 40px;"><img src="data:image/png;base64,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" class="van-image__img"></div>
                </div>
                <div class="num">{{10000 + rand(-1000,2000)}}</div>
                <div class="txt"> Số người trực tuyến </div>
            </div>
        </div>
        <div class="rank-box">
            <div class="rank-tit"> BẢNG XẾP HẠNG RÚT TIỀN </div>
            <div class="RankList">
                <div style="width: 100%;height: 100%;" class="swiper-container slider-home-top-with-drawl">
                    <div class="swiper-wrapper" style="flex-direction: column;">
                        @foreach ($listTopWitdraw as $item)
                        <div class="swiper-slide">
                            <div class="c-row c-row-between item">
                                <img src="theme/frontend/images/avatar.cfa8dd9d.svg" class="img">
                                <div class="info c-row c-row-between">
                                    <div class="m-l-10 name">{{$item['name']}}</div>
                                    <div class="price">
                                        <span>{{number_format($item['money'],0,',','.')}} đ</span>
                                    </div>
                                    <div class="time">{{$item['time']}}</div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @include('static_blocks.how')
        @include('static_blocks.shortcut_box',['activeTab' => 'home'])
    </div>
</div>
@endsection
@section('jsl')
<script src="theme/frontend/js/swiper.min.js" defer></script>
@endsection