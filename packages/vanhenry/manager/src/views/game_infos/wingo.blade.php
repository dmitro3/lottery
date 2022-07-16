@extends('vh::master')
@section('css')
    <link rel="preload" href="theme/frontend/js/hackertimer.js" as="script">
    <script src="theme/frontend/js/hackertimer.js"></script>
    <link rel="stylesheet" href="admin/css/game_info/wingo.css" type="text/css" media="screen" />
@endsection
@section('content')
@include('vh::static.headertop')
<div class="header-top aclr">
	<div class="breadc pull-left">
		<ul class="aclr pull-left list-link">
			<li class="active">
                <a href="javascript:void(0)">Thông tin game wingo</a>
            </li>
		</ul>
	</div>
</div>
<div id="maincontent">
    <form action="esystem/game-info/wingo" class="form-list-wingo-type text-center" method="get" accept-charset="utf8">
        @foreach ($listGameWintype as $key => $itemGameWintype)
            <label class="item">
                <input type="radio" class="d-none" name="game_win_type_id" value="{{Support::show($itemGameWintype,'id')}}"{{$key == 0 ? ' checked':''}}>
                <span class="preview-name">{{Support::show($itemGameWintype,'name')}}</span>
            </label>
        @endforeach
    </form>
    <div class="row d-flex flex-wrap justify-content-center">
        <div class="col-xs-12 col-lg-8 mx-auto mt-4">
            <p class="big-title">Game hiện tại</p>
            <div class="wingo-current-item-wrapper">
                <div class="current-game-countdown-timebox"></div>
                <div class="wingo-current-item-result"></div>
            </div>
        </div>
        <div class="col-xs-12 col-lg-8 mx-auto mt-4">
            <p class="big-title">Game gần đây</p>
            <div class="wingo-history-list-item-result"></div>
        </div>
    </div>
</div>
@stop
@section('js')
    <script type="text/javascript" src="admin/js/game_info/wingo.js" defer></script>
@endsection