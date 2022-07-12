@php
use \realtimemodule\pushserver\Helpers\PushServerHelper;
@endphp
@extends('index')
@section('css')
<link href="theme/frontend/plinko/css/style.css" rel="stylesheet">
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
                <div class="box-plinko c-row">
                    <div>
                        <div id="game" class="relative">
                            <div id="warning-inactive" class="d-none">
                                <p>
                                    Chào mừng bạn quay trở lại game, game sẽ được tải lại khi
                                    đến ván chơi mới!
                                </p>
                            </div>
                        </div>
                        <div id="game-control">
                            <div class="box_game">
                                <div class="risk_box box">
                                    <div class="box_name">Mức cược</div>
                                    <div class="risk_level">
                                        <label for="high" class="label_choose risk">
                                            <input type="radio" id="high" value="2" name="risk" checked />
                                            <span class="name">
                                                <img src="theme/frontend/plinko/images/high.webp" alt="High" />
                                                100k VNĐ
                                            </span>
                                        </label>
                                        <label for="normal" class="label_choose risk">
                                            <input type="radio" id="normal" value="1" name="risk" />
                                            <span class="name">
                                                <img src="theme/frontend/plinko/images/mid.webp" alt="Normal" />
                                                10k VNĐ
                                            </span>
                                        </label>
                                        <label for="low" class="label_choose risk">
                                            <input type="radio" id="low" value="0" name="risk" />
                                            <span class="name">
                                                <img src="theme/frontend/plinko/images/low.webp" alt="Low" />
                                                1k VNĐ
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                <div class="game_play">
                                    <button class="play">
                                        <img src="theme/frontend/plinko/images/play1.png" alt="Play" class="btn-play" />
                                        <img src="theme/frontend/plinko/images/play1_click.png" alt="Play" class="btn-play-hover" />
                                        <span class="text">Chơi</span>
                                    </button>
                                    <button id="test">Test result game</button>
                                </div>
                                <div class="bet_box box">
                                    <div class="box_name">Chế độ chơi</div>
                                    <div class="bet_modes">
                                        <label for="manual" class="label_choose mode">
                                            <input type="radio" id="manual" value="manual" checked name="mode" />
                                            <span class="name">
                                                <img src="theme/frontend/plinko/images/manual.webp" alt="Manual" />
                                                Thủ công
                                            </span>
                                        </label>
                                        <label for="auto" class="label_choose mode">
                                            <input type="radio" id="auto" value="auto" name="mode" />
                                            <span class="name">
                                                <img src="theme/frontend/plinko/images/auto.webp" alt="Auto" />Tự động
                                            </span>
                                        </label>
                                        <div class="qty_box relative">
                                            <div class="bet_name">Số lượng bi</div>
                                            <div class="qty_bet">
                                                <button class="minus btn_bet" id="mbball">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" fill="none">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8 24C8 22.8954 8.89543 22 10 22H38C39.1046 22 40 22.8954 40 24C40 25.1046 39.1046 26 38 26H10C8.89543 26 8 25.1046 8 24Z" fill="white" />
                                                    </svg>
                                                </button>
                                                <input id="ball" type="number" value="1" name="qty" min="1" max="10" />
                                                <button id="pbball" class="plus btn_bet">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" fill="none">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M24 8C25.1046 8 26 8.89543 26 10V22H38C39.1046 22 40 22.8954 40 24C40 25.1046 39.1046 26 38 26H26V38C26 39.1046 25.1046 40 24 40C22.8954 40 22 39.1046 22 38V26H10C8.89543 26 8 25.1046 8 24C8 22.8954 8.89543 22 10 22H22V10C22 8.89543 22.8954 8 24 8Z" fill="white" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="result">
                            <table>
                                <thead>
                                    <th>Time</th>
                                    <th>Bet</th>
                                    <th>Payout</th>
                                    <th>Profit</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>00:29:00</td>
                                        <td>1.00 FUN</td>
                                        <td>1.1x</td>
                                        <td>+1 FUN</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')
<script src="theme/frontend/plinko/js/gui.js" defer></script>
<script src="theme/frontend/plinko/js/lib.js" defer></script>
<script src="theme/frontend/plinko/js/main.bundle.js" defer></script>
<script src="theme/frontend/plinko/js/plinko.js" defer></script>
@endsection