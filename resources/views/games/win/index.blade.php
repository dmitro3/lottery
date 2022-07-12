@php
use \realtimemodule\pushserver\Helpers\PushServerHelper;
@endphp
@extends('index')
@section('css')
    <script type="text/javascript">
        var connectionGameType = '{{PushServerHelper::generateHash(1)}}';
    </script>
@endsection
@section('content')
<div id="app">
    <div class="mian game">
        @include('games.base_game_bar')
        <div class="game-betting">
            <div class="tab">
                <div class="box c-row">
                    @foreach ($listGameWinType as $key => $itemGameWinType)
                    <div class="item c-tc{{$key == 0 ? ' action':''}}" data-id="{{PushServerHelper::generateHash($itemGameWinType->id)}}" src-active="theme/frontend/img/icon_clock_active.png" src-disable="theme/frontend/img/icon_clock.png">
                        <div class="circular c-row c-row-middle-center c-tc"><span class="li">?</span></div>
                        <div class="img c-row c-row-center p-b-10">
                            <div class="van-image" style="width: 30px; height: 30px;">
                                <img src="{{$key == 0 ? 'theme/frontend/img/icon_clock_active.png':'theme/frontend/img/icon_clock.png'}}" class="van-image__img">
                            </div>
                            <i class="triangle"></i>
                        </div>
                        <div class="txt c-tc">{{Support::show($itemGameWinType,'name')}}</div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="content">
                <div class="time-box c-row c-row-between m-b-10" id="game-gowin-time-box"></div>
                <div class="box">
                    <div class="mark-box c-row c-row-middle-center" style="display: none;"></div>
                    <div class="con-box">
                        <div class="color-box c-row c-row-between">
                            <button type="button" class="btn green" data-color="green">Xanh</button>
                            <button type="button" class="btn violet" data-color="violet">Tím</button>
                            <button type="button" class="btn red" data-color="red">Đỏ</button>
                        </div>
                    </div>
                    <div class="number-box action m-t-10 c-row c-row-between c-flex-warp">
                        @for ($i = 0; $i < 10; $i++) <button type="button" class="item c-row c-row-middle-center m-b-10">
                            <div class="number c-row c-row-middle-center"><span class="txt">{{$i}}</span></div>
                            </button>
                            @endfor
                    </div>
                    <div class="c-row c-row-between random-box">
                        <button class="random" id="random-number-bet-btn" type="button">ngẫu<br>&nbsp;nhiên&nbsp;</button>
                        <div class="c-row">
                            @foreach ($listGameWinMultiple as $key => $itemGameWinMultiple)
                            <div class="item{{$key == 0 ? ' active default':''}}" data-multiple="{{$itemGameWinMultiple->multiple}}">{{$itemGameWinMultiple->name}}</div>
                            @endforeach
                        </div>
                    </div>
                    <div class="btn-box c-row">
                        <button class="item yellow" data-size="big"> Lớn </button>
                        <button class="item green" data-size="small"> Nhỏ </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="game-list p-b-20">
            @include('games.win.game_history')
        </div>
        @include('games.win.popup_bet')
        <div class="van-overlay" id="pre-sale-rules-popup-overlay" style="z-index: 2034;display: none;"></div>
        <div class="van-popup van-popup--center" id="pre-sale-rules-popup" style="width: 80%; border-radius: 10px; max-width: 340px; z-index: 2035;display: none;">
            <div class="rule-box">
                <div class="title c-row c-row-middle-center">Quy tắc bán trước</div>
                <div class="info">
                    <div class="comment">{[pre_sell_rule_content]}</div>
                    <div class="rule-btn c-row m-t-20 c-row-center">
                        <button class="btn-close-popup btn van-button van-button--default van-button--normal van-button--block van-button--round" style="color: rgb(255, 255, 255); background: rgb(242, 65, 59); border-color: rgb(242, 65, 59);">
                            <div class="van-button__content">
                                <span class="van-button__text">
                                    <span>Tôi biết</span>
                                </span>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div>
    <audio id="voice1">
        <source src="theme/frontend/audios/di1.da40b233.mp3" type="audio/mpeg">
    </audio>
    <audio id="voice2">
        <source src="theme/frontend/audios/di2.317de251.mp3" type="audio/mpeg">
    </audio>
</div>
@endsection
@section('js')
<script src="theme/frontend/js/win.js" defer></script>
@endsection