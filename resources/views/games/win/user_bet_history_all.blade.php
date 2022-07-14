@php
    use realtimemodule\pushserver\Helpers\PushServerHelper;
@endphp
@extends('index')
@section('css')
    <style>
        .game-list{
            margin-top: 0!important;
        }
        .mian .con-box .list{
            padding: 0!important;
            margin-top: 0!important;
        }
    </style>
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
            <div class="navbar-title">Win Go</div>
            <div class="navbar-right"></div>
        </div>
        <div class="van-tabs van-tabs--line">
            <div class="van-sticky">
                <div id="bet-history-tab" class="van-tabs__wrap van-hairline--top-bottom">
                    <div class="van-tabs__nav van-tabs__nav--line">
                        @foreach ($listGameWinType as $key => $itemGameWinType)
                            <div class="van-tab {{$key == 0 ? 'van-tab--active':''}}" data-action="get-game-gowin-user-bet-history?game_type={{PushServerHelper::generateHash($itemGameWinType->id)}}&type=all">
                                <span class="van-tab__text van-tab__text--ellipsis">{{Support::show($itemGameWinType,'name')}}</span>
                            </div>
                        @endforeach
                        <div class="van-tabs__line" style="width: 48px; transform: translateX(-100%);transition-duration: 0.3s;"></div>
                    </div>
                </div>
            </div>
            <div class="van-tabs__content">
                <div role="tabpanel" class="tab van-tab__pane">
                    <div class="con-box game-list" id="bet-history-result">

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