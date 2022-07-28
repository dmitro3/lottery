@extends('vh::master')
@section('css')
    <link rel="preload" href="theme/frontend/js/hackertimer.js" as="script">
    <script src="theme/frontend/js/hackertimer.js"></script>
    <link rel="stylesheet" href="admin/css/game_info/lottobm.css" type="text/css" media="screen" />
@endsection
@section('content')
@include('vh::static.headertop')
<div class="header-top aclr">
	<div class="breadc pull-left">
		<ul class="aclr pull-left list-link">
			<li class="active">
                <a href="javascript:void(0)">Thông tin game lotto Miền Bắc</a>
            </li>
		</ul>
	</div>
</div>
<div id="maincontent">
    <div class="row d-flex flex-wrap justify-content-center">
        <div class="col-xs-12 col-lg-8 mx-auto mt-4">
            <p class="big-title">Game hiện tại</p>
            <div class="lottomb-current-item-wrapper in-loading-item" style="min-height: 100px;">
                <div class="current-game-countdown-timebox"></div>
                <div class="lottomb-current-item-result"></div>
            </div>
        </div>
        <div class="col-xs-12 col-lg-8 mx-auto mt-4">
            <p class="big-title">Game gần đây</p>
            <div class="lottomb-history-list-item-result in-loading-item" style="min-height: 100px;"></div>
        </div>
    </div>
</div>
@stop
@section('js')
    <script type="text/javascript" src="admin/js/game_info/lottomb.js" defer></script>
@endsection