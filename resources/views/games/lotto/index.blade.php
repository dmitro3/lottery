@php
use \realtimemodule\pushserver\Helpers\PushServerHelper;
@endphp
@extends('index')
@section('css')
<link href="theme/frontend/plinko/css/style.css" rel="stylesheet">
<script type="text/javascript">
    var connectionGameType = '{{PushServerHelper::generateHash(2)}}';
    var PLINKO_STATUS = <?php echo json_encode(\realtimemodule\pushserver\Enums\Plinko\Status::getConstList()) ?>;
    var PLINKO_CONFIG = <?php echo json_encode(\App\Games\Plinko\Enums\Config::getConstList()) ?>;
</script>
@endsection
@section('content')
<div id="app">
    <div class="mian game">
        @include('games.base_game_bar',['gameName'=>'plinko'])
        <div class="game-betting">
           
        </div>
        <div class="game-list p-b-20">
            @include('games.plinko.game_history')
        </div>
    </div>
</div>

@endsection
@section('js')
<script src="theme/frontend/plinko/js/gui.js" defer></script>
<script src="theme/frontend/plinko/js/lib.js" defer></script>
<script src="theme/frontend/plinko/js/main.bundle.js" defer></script>
<script src="theme/frontend/game/ts/plinko.js" defer></script>
@endsection