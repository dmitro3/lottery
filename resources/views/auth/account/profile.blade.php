@extends('index')
@section('css')
    <link rel="stylesheet" href="theme/frontend/css/personal_page.css">
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
            <div class="navbar-title">Trang cá nhân </div>
            <div class="navbar-right"></div>
        </div>
        <div class="profile">
            <div class="item c-row c-row-between c-row-middle-center">
                <div class="lab">Hình đại diện</div>
                <div class="img"><img width="40px" height="40px" src="theme/frontend/images/avatar.cfa8dd9d.svg" class="userImg"></div>
            </div>
            <div class="item c-row c-row-between">
                <div class="lab">ID</div>
                <div class="txt">{{Support::show($user,'id')}}</div>
            </div>
            <div class="item c-row c-row-between btn-show-van-popup" data-target="#change-profile-popup">
                <div class="lab">Tên người dùng</div>
                <div class="txt c-row c-row-middle-center">
                    {{Support::show($user,'name')}} 
                    <i class="m-l-10 van-icon van-icon-arrow" style="color: rgb(149, 149, 149); font-size: 16px;"></i>
                </div>
            </div>
            <div class="item c-row c-row-between">
                <div class="lab">Điện thoại</div>
                <div class="txt">{{Support::show($user,'phone')}}</div>
            </div>
        </div>
        <div class="van-overlay" id="change-profile-popup-overlay" style="z-index: 2001;display: none"></div>
        <div class="van-popup van-popup--center" style="width: 80%;border-radius: 15px;max-width: 340px;z-index: 2002;display: none" id="change-profile-popup">
            <form class="popup-box form-validate" action="tai-khoan/trang-ca-nhan" autocomplete="off" absolute method="post" accept-charset="utf8" data-success="ACCOUNT_GUI.changeProfileDone">
                <div class="title"></div>
                <div class="con">
                    <div class="lab">Thay đổi tên người dùng</div>
                    <div>
                        @csrf
                        <input type="text" name="name" maxlength="16" placeholder="Tên người dùng" class="input">
                    </div>
                </div>
                <div class="food c-row c-row-middle-center">
                    <div class="item btn-close-popup">Hủy</div>
                    <button type="submit" class="btn-confirm-change-profile item sure">Xác nhận</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('jsl')
    <script src="theme/frontend/js/ValidateForm.js" defer></script>
@endsection
@section('js')
    <script src="theme/frontend/js/auth.js" defer></script>
@endsection