@extends('index')
@section('css')
    <link rel="stylesheet" href="theme/frontend/css/promotion.css">
    <link rel="stylesheet" href="theme/frontend/css/app_promotion-1.css">
@endsection
@section('content')
<div id="app">
    <div class="mian">
        <div class="navbar">
            <div class="navbar-left"></div>
            <div class="navbar-title">Hướng dẫn</div>
            <div class="navbar-right">
                <a href="tai-khoan/marketing/lich-su-gioi-thieu{{Support::renderBackLinkParamater('tai-khoan/marketing/huong-dan')}}" class="c-row">
                    <i class="van-icon van-icon-notes-o" style="font-size: 25px;color: #ffffff"></i>
                </a>
            </div>
        </div>
        <div class="promotion">
            @include('auth.marketing.action_tab',['activeTab'=>'huong-dan'])
            <div class="box">
                @include('auth.marketing.guide_content')
            </div>
        </div>
        @include('static_blocks.shortcut_box',['activeTab' => 'marketing'])
    </div>
</div>
@endsection