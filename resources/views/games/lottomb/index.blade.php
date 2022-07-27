@php
use \realtimemodule\pushserver\Helpers\PushServerHelper;
@endphp
@extends('index')
@section('css')
<link href="theme/frontend/lotto/css/style.css" rel="stylesheet">
<script type="text/javascript">
    var connectionGameType = '{{PushServerHelper::generateHash(\realtimemodule\pushserver\PushServerProvider::TYPE_GAME_LOTTO_MB)}}';
    var LOTTO_TYPES = <?php echo json_encode($types) ?>;
    var LOTTO_STATUS = <?php echo json_encode(\realtimemodule\pushserver\Enums\Lotto\Status::getConstList()) ?>;
    var LOTTO_CONFIG = <?php echo json_encode(\App\Games\LottoMb\Enums\Config::getConstList()) ?>;
    var SOCKET_URL = 'ws://localhost:8081/';
</script>
@endsection
@section('content')
<div id="app">
    <div class="mian game">
        @include('games.base_game_bar',['gameName'=>'lotto'])
        <div class="game-betting lottomb">
            <div class="content">
                <div class="time-box c-row c-row-between m-b-10" id="game-lotto-time-box">
                    <div class="info" style="display: flex;align-items:center">
                        <div class="number">2022071411425</div>
                    </div>
                    <div class="out">
                        <div class="txt"> Thời gian còn lại để mua </div>
                        <div class="number c-row c-row-middle c-flew-end">

                        </div>
                    </div>
                </div>

                <section class="result_plot_threads">
                    <div class="mark-box c-row c-row-middle-center" style="display: none;"></div>
                    @include('games.lotto.result_table')
                    <div class="container">
                        <div class="box box_choose">
                            <div class="game_types navv">
                                @foreach($categories as $k=> $category)
                                <label for="type-{{$category->id}}" class="item_type_game nav-item" id="lb-type-{{$category->id}}" data-target="#game-type-{{$category->id}}">
                                    <input type="radio" id="type-{{$category->id}}" {{$k==0?'checked':''}} value="{{$category->id}}" name="category">
                                    <span class="name">{{Support::show($category,'name')}}</span>
                                </label>
                                @endforeach
                            </div>
                            <div class="tab_panel">
                                <div class="panel" data-state="show" id="game-type-1">

                                </div>
                                <div class="panel" data-state="hide" id="game-type-2">

                                </div>
                                <div class="panel" data-state="hide" id="game-type-3">

                                </div>
                                <div class="panel" data-state="hide" id="game-type-4">

                                </div>
                                <div class="panel" data-state="hide" id="game-type-5">

                                </div>
                                <div class="panel" data-state="hide" id="game-type-6">

                                </div>
                            </div>
                        </div>
                        <div class="box box_booking">
                            <p class="title_lg" id="current-game">Đánh đề</p>
                            <div class="box_mini">
                                <div class="types">
                                    <span class="domain xs">Miền Bắc</span> / <span class="lotto xs">Đánh lô</span> / <span class="type xs">Lô 2 số</span>
                                </div>
                                <div class="ls_lotto_choosen" id="ls_lotto_choosen"></div>
                                <div class="ls_lotto" id="ls_lotto">
                                    <span class="no-result">Chưa chọn số</span>
                                </div>
                            </div>
                            <p class="xs lb_total">Tổng tiền đánh (K)</p>
                            <input type="number" value="1" class="ip" name="bet">
                            <div class="plot_total">
                                <p class="block_total min">Cược tối thiểu<span class="total">198</span>
                                </p>
                                <p class="block_total money">Tiền đánh / 1 con<span class="total">198</span>
                                </p>
                                <p class="block_total money_win">Tiền thắng / 1 con<span class="total">198</span>
                                </p>
                            </div>
                            <button type="button" id="lotto_bet" class="btn_all book">ĐẶT CƯỢC</button>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <div class="game-list p-b-20">
            @include('games.plinko.game_history')
        </div>
    </div>
</div>

@endsection
@section('js')
<script src="theme/frontend/game/ts/lib.js" defer></script>
<script src="theme/frontend/game/ts/lottomb.js" defer></script>
@endsection