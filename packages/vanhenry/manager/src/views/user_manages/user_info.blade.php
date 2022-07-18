@extends('vh::master')
@section('css')
    <link rel="stylesheet" href="admin/css/user_manages/user_info.css" type="text/css" media="screen" />
@endsection
@section('content')
@include('vh::static.headertop')
<div class="header-top aclr">
	<div class="breadc pull-left">
		<ul class="aclr pull-left list-link">
			<li class="active">
                <a href="javascript:void(0)">Thông tin game plinko</a>
            </li>
		</ul>
	</div>
</div>
<div id="maincontent">
    <div class="row">
        <div class="col-xs-12 col-lg-8 mt-4">
            <p class="big-title">LỆNH NẠP TIỀN (CHỈ ĐƯỢC THAY ĐỔI TRẠNG THÁI 1 LẦN)</p>
            <div class="base-info-box">
                <div class="list-shop-withdraw-request module-paginate-ajax" data-action="{{url('esystem/user-manage/load-user-withdraw-request?user=').$user->id}}" data-currenturl="{{url('esystem/user-manage/load-user-withdraw-request?user=').$user->id}}"></div>
            </div>
        </div>
    </div>
</div>
@stop
@section('js')
    <script type="text/javascript" src="admin/js/user_manages/user_info.js" defer></script>
@endsection