@extends('vh::master')
@section('css')
    <link rel="stylesheet" href="admin/css/game_info/wingo.css" type="text/css" media="screen" />
@endsection
@section('content')
@include('vh::static.headertop')
<div class="header-top aclr">
	<div class="breadc pull-left">
		<ul class="aclr pull-left list-link">
			<li class="active"><a href="javascript:void(0)">Thông tin game wingo</a></li>
		</ul>
	</div>
</div>
<div id="maincontent">
    <form action="esystem/game-info/wingo" class="form-list-wingo-type text-center" method="get" accept-charset="utf8">
        @foreach ($listGameWintype as $itemGameWintype)
            <label class="item">
                <input type="radio" class="d-none" name="game_win_type_id">
                <span class="preview-name">{{Support::show($itemGameWintype,'name')}}</span>
            </label>
        @endforeach
    </form>
    <div class="row">
        <div class="col-lg-6 mt-4">
            <p class="big-title">Game hiện tại</p>
        </div>
        <div class="col-lg-6 mt-4">
            <p class="big-title">Lịch sử game</p>
            <table class="base-table-horizontal">
                <tbody>
                    <tr>
                        <td rowspan="2">1</td>
                        <td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                        </td>
                        <td>1</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop
@section('js')
    {{-- <script type="text/javascript" src="admin/js/chart.min.js" defer></script> --}}
@endsection