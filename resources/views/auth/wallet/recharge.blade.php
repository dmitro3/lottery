@extends('index')
@section('css')
    <link rel="stylesheet" href="theme/frontend/css/recharge.css">
@endsection
@section('content')
<div id="app">
    <div class="mian">
        <div class="navbar">
            <div class="navbar-left">
                <a href="{{Support::generateBackLink()}}" class="bank c-row c-row-middle-center">
                    <img src="theme/frontend/images/back.c3244ab0.png" class="navbar-back">
                </a>
            </div>
            <div class="navbar-title"> NẠP TIỀN </div>
            <div class="navbar-right"></div>
        </div>
        <div class="selectBox">
            <div class="colorBox"></div>
            <div class="txtBox c-row c-row-middle">
                <div class="txt p-r-5"> Tổng tiền : </div>
                <div class="c-row c-row-middle">
                    <div class="money">
                        <div class="user-money-preview"> {{number_format($user->getAmount(),0,',','.')}} đ</div>
                    </div>
                    <div class="van-image img m-l-10 profile-reload-user-money-btn" style="width: 18px; height: 18px;" onclick="BASE_GUI.reloadUserMoney(this)">
                        <img src="theme/frontend/images/tải xuống.png" class="van-image__img">
                    </div>
                </div>
                <div class="icon"></div>
            </div>
            <div class="pay-box m-t-10">
                <div class="title c-row c-row-middle">
                    <div class="van-image" style="width: 20px; height: 20px;">
                        <img src="theme/frontend/images/tải xuống (1).png" class="van-image__img">
                    </div>
                    <span class="m-l-10"> Phương thức thanh toán </span>
                </div>
                @if (count($listRechargeMethod) > 0)
                    <div class="list c-row c-flex-warp m-t-10">
                        @foreach ($listRechargeMethod as $key => $item)
                            <div  class="item item-recharge-method {{$key == 0 ? 'action':''}}" data-idx="{{$item->id}}" data-disable="{%IMGV2.item.icon_disable.-1%}" data-active="{%IMGV2.item.icon_active.-1%}">
                                @if ($key == 0)
                                    <img width="20px" height="20px" src="{%IMGV2.item.icon_active.-1%}"  class="img">
                                @else
                                    <img width="20px" height="20px" src="{%IMGV2.item.icon_disable.-1%}"  class="img">
                                @endif
                                <div class="name">Chuyển khoản nhanh</div>
                                @if ($key == 0)
                                    <div class="icon">
                                        <i class="van-icon van-icon-success" style="color: rgb(255, 255, 255); font-size: 14px;"></i>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="m-t-10">Tạm thời chưa có phương thức thanh toán nào.</p>
                @endif
            </div>
            <div class="pay-box" id="pay-box-content-result"></div>
        </div>
    </div>
</div>
@endsection
@section('jsl')
    <script src="theme/frontend/js/ValidateForm.js" defer></script>
@endsection
@section('js')
    <script src="theme/frontend/js/recharge.js" defer></script>
@endsection