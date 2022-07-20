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
                <a href="javascript:void(0)">Thông tin chi tiết người dùng</a>
            </li>
		</ul>
	</div>
</div>
<div id="maincontent">
    <div class="row">
        <div class="col-xs-12 col-lg-4 mt-4">
            <input type="hidden" value="{{$user->id}}" id="current_user">
            <p class="big-title">Thông tin cá nhân</p>
            <div class="base-info-box">
                <div class="item-user-info">
                    <span class="item-title"><strong>Số điện thoại</strong></span>
                    <span class="item-value">: {{Support::show($user,'phone')}}</span>
                </div>
                <div class="item-user-info">
                    <span class="item-title"><strong>Tên</strong></span>
                    <span class="item-value">: {{Support::show($user,'name')}}</span>
                </div>
                <div class="item-user-info">
                    <span class="item-title"><strong>Loại tài khoản</strong></span>
                    <span class="item-value">: 
                        @if ($user->is_marketing_account)
                            <span class="btn btn-primary" style="pointer-events: none;">Tài khoản Marketing</span>
                        @else
                            <span class="btn btn-default" style="pointer-events: none;">Tài khoản thường</span>
                        @endif
                    </span>
                </div>
                <div class="item-user-info">
                    <span class="item-title"><strong>Mã giới thiệu</strong></span>
                    <span class="item-value">: {{Support::show($user,'referral_code')}}</span>
                </div>
                <div class="item-user-info">
                    <span class="item-title"><strong>Người giới thiệu</strong></span>
                    @if (isset($user->userIntroduce))
                        <span class="item-value">: {{Support::show($user->userIntroduce,'name')}} - {{Support::show($user->userIntroduce,'phone')}}</span>
                    @else
                        <span class="item-value">: Không có</span>
                    @endif
                </div>
                <div class="item-user-info">
                    <span class="item-title"><strong>Đại lý hiện tại</strong></span>
                    <span class="item-value">: {{Support::show($user->hUser,'name')}}</span>
                </div>
                @php
                    $userLastLogin = $user->loginLog()->orderBy('id','desc')->first();
                @endphp
                @if (isset($userLastLogin))
                    <div class="item-user-info">
                        <span class="item-title"><strong>Đăng nhập cuối</strong></span>
                        <span class="item-value">: {{Support::showDateTime($userLastLogin->created_at,'d/m/Y H:i:s')}}</span>
                    </div>
                @endif
                <div class="item-user-info">
                    <span class="item-title"><strong>Trạng thái</strong></span>
                    <span class="item-value">: 
                        @if ($user->act == 0)
                            <span class="btn btn-danger" style="pointer-events: none;">Đang bị khóa</span>
                        @else
                            <span class="btn btn-success" style="pointer-events: none;">Đang hoạt động</span>
                        @endif
                    </span>
                </div>
            </div>
            <div class="list-action">
                <button type="button" class="btn btn-info mt-3 me-3" data-toggle="modal" data-target="#modelEditUserInfo"><i class="fa fa-pencil-square-o me-2" aria-hidden="true"></i> Sửa thông tin</button>
                @if ($user->act == 1)
                    <button type="button" data-action="esystem/user-manage/user-change-status?user={{$user->id}}" data-text="Bạn có muốn khóa tài khoản này ?" class="btn btn-danger btn-lock-account-user mt-3"><i class="fa fa-lock me-2" aria-hidden="true"></i> Khóa tài khoản</button>
                @else
                    <button type="button" data-action="esystem/user-manage/user-change-status?user={{$user->id}}" data-text="Bạn có muốn mở khóa tài khoản này ?" class="btn btn-success btn-lock-account-user mt-3"><i class="fa fa-unlock-alt me-2" aria-hidden="true"></i> Mở khóa tài khoản</button>
                @endif
            </div>
            <p class="big-title mt-5">THÔNG TIN TIẾP THỊ</p>
            <div class="base-info-box">
                <div class="item-user-info">
                    <span class="item-title"><strong>Cấp bậc</strong></span>
                    <span class="item-value">: <strong>{{Support::show($user,'level')}}</strong></span>
                </div>
                <div class="item-user-info">
                    <span class="item-title"><strong>Tổng F1</strong></span>
                    <span class="item-value">: <strong>{{$dataStatical['total_f1'] ?? ''}}</strong></span>
                </div>
                <div class="item-user-info">
                    <span class="item-title"><strong>Tổng cấp dưới</strong></span>
                    <span class="item-value">: <strong>{{$dataStatical['total_child'] ?? ''}}</strong></span>
                </div>
                <div class="item-user-info">
                    <span class="item-title"><strong>Tổng F1 hôm nay</strong></span>
                    <span class="item-value">: <strong>{{$dataStatical['total_f1_today'] ?? ''}}</strong></span>
                </div>
                <div class="item-user-info">
                    <span class="item-title"><strong>Tổng thành viên <br> cấp dưới hôm nay</strong></span>
                    <span class="item-value">: <strong>{{$dataStatical['total_child_today'] ?? ''}}</strong></span>
                </div>
                <div class="item-user-info">
                    <span class="item-title"><strong>Tổng hoa hồng <br> tuần này</strong></span>
                    <span class="item-value">: <strong>{{isset($dataStatical['total_commission_week']) ? Currency::showMoney($dataStatical['total_commission_week']):''}}</strong></span>
                </div>
                <div class="item-user-info">
                    <span class="item-title"><strong>Tổng hoa hồng</strong></span>
                    <span class="item-value">: <strong>{{isset($dataStatical['total_commission_week']) ? Currency::showMoney($dataStatical['total_commission']):''}}</strong></span>
                </div>
            </div>
            <p class="big-title mt-5"><strong>Thông tin tài khoản ngân hàng</strong></p>
            @php
                $userBank = $user->userBank()
                                ->with('bank')
                                ->whereHas('bank')
                                ->first();
            @endphp
            <div class="base-info-box">
                @if (isset($userBank))
                    <div class="item-user-info">
                        <span class="item-title"><strong>Ngân hàng</strong></span>
                        <span class="item-value">: {{Support::show($userBank->bank,'name')}}</span>
                    </div>
                    <div class="item-user-info">
                        <span class="item-title"><strong>Chủ tài khoản</strong></span>
                        <span class="item-value">: {{Support::show($userBank,'account_holder')}}</span>
                    </div>
                    <div class="item-user-info">
                        <span class="item-title"><strong>Số tài khoản</strong></span>
                        <span class="item-value">: {{Support::show($userBank,'account_number')}}</span>
                    </div>
                    <div class="item-user-info">
                        <span class="item-title"><strong>Chi nhánh</strong></span>
                        <span class="item-value">: {{Support::show($userBank,'account_branch')}}</span>
                    </div>
                    <div class="item-user-info">
                        <span class="item-title"><strong>Số điện thoại</strong></span>
                        <span class="item-value">: {{Support::show($userBank,'phone')}}</span>
                    </div>
                    <div class="item-user-info">
                        <span class="item-title"><strong>Email</strong></span>
                        <span class="item-value">: {{Support::show($userBank,'email')}}</span>
                    </div>
                    <div class="item-user-info">
                        <span class="item-title"><strong>Tỉnh/Thành phố</strong></span>
                        <span class="item-value">: {{Support::show($userBank,'province')}}</span>
                    </div>
                @else
                    <p class="mb-2">Khách hàng chưa liên kết tài khoản ngân hàng nào</p>
                @endif
            </div>
            @if (isset($userBank))
                <div class="list-action">
                    <button type="button" class="btn btn-info mt-3 me-3" data-toggle="modal" data-target="#modelEditUserBankInfo"><i class="fa fa-pencil-square-o me-2" aria-hidden="true"></i> Sửa thông tin ngân hàng</button>
                </div>
            @endif
            <p class="big-title mt-5">THÔNG TIN VÍ</p>
            <div class="base-info-box">
                <div class="item-user-info">
                    <span class="item-title"><strong>Số dư</strong></span>
                    <span class="item-value">: <strong class="fs-18" id="user_amount"></strong></span>
                </div>
                <div class="action-box">
                    <button class="btn btn-success mt-3 me-4" data-toggle="modal" data-target="#modelPlusUserMoney"><i class="fa fa-plus me-2" aria-hidden="true"></i> Cộng tiền</button>
                    <button class="btn btn-danger mt-3" data-toggle="modal" data-target="#modelMinusUserMoney"><i class="fa fa-minus me-2" aria-hidden="true"></i> Trừ tiền</button>
                </div>
            </div>
            <p class="big-title mt-5">CHI TIẾT THU CHI (NẠP/RÚT)</p>
            <div class="base-info-box">
                <div class="item-user-info d-flex justify-content-between">
                    <span class="item-title"><strong>Tổng thu</strong></span>
                    <span class="item-value"><strong class="fs-18" id="total_collect"></strong></span>
                </div>
                <div class="item-user-info d-flex justify-content-between">
                    <span class="item-title"><strong>Tổng chi</strong></span>
                    <span class="item-value"><strong class="fs-18" id="total_spend"></strong></span>
                </div>
                <div class="item-user-info d-flex justify-content-between">
                    <span class="item-title"><strong>Lợi nhuận</strong></span>
                    <span class="item-value"><strong class="fs-18" id="profit_final"></strong></span>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-lg-8 mt-4">
            <div class="module-paginate-ajax" style="min-height: 150px" data-action="{{url('esystem/user-manage/load-user-recharge-request?user=').$user->id}}" data-currenturl="{{url('esystem/user-manage/load-user-recharge-request?user=').$user->id}}"></div>
            <div class="module-paginate-ajax mt-5" style="min-height: 150px" data-action="{{url('esystem/user-manage/load-user-withdraw-request?user=').$user->id}}" data-currenturl="{{url('esystem/user-manage/load-user-withdraw-request?user=').$user->id}}"></div>
        </div>
    </div>
</div>
@include('vh::user_manages.user_model')
@stop
@section('js')
    <script type="text/javascript" src="admin/js/user_manages/user_info.js" defer></script>
@endsection