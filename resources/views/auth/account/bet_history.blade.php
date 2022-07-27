@extends('index')
@section('css')
    <link rel="stylesheet" href="theme/frontend/css/bet_history.css">
@endsection
@section('content')
<div id="app">
    <div class="mian">
        <div class="navbar">
            <div class="navbar-left">
                <div class="navbar-left">
                    <a href="{{Support::generateBackLink()}}" class="bank c-row c-row-middle-center">
                        <img src="theme/frontend/images/back.c3244ab0.png" class="navbar-back">
                    </a>
                </div>
            </div>
            <div class="navbar-title">Lịch sử đặt cược</div>
            <div class="navbar-right"></div>
        </div>
        <div class="van-tabs van-tabs--line">
            <div class="van-sticky">
                <div id="bet-history-tab" class="van-tabs__wrap van-tabs__wrap--scrollable van-hairline--top-bottom">
                    <div class="van-tabs__nav van-tabs__nav--line">
                        <div class="van-tab van-tab--active" data-action="tai-khoan/wingo-bet-history">
                            <span class="van-tab__text van-tab__text--ellipsis">Wingo</span>
                        </div>
                        <div class="van-tab" data-action="tai-khoan/plinko-bet-history">
                            <span class="van-tab__text van-tab__text--ellipsis">Plinko</span>
                        </div>
                        <div class="van-tab" data-action="tai-khoan/lotto-bet-history">
                            <span class="van-tab__text van-tab__text--ellipsis">Lotto</span>
                        </div>
                        <div class="van-tabs__line" style="width: 48px; transform: translateX(-100%);transition-duration: 0.3s;"></div>
                    </div>
                </div>
            </div>
            <div class="van-tabs__content">
                <div role="tabpanel" class="tab van-tab__pane">
                    <div class="con-box">
                        <div class="list" id="bet-history-result"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script src="theme/frontend/js/auth.js" defer></script>
@endsection