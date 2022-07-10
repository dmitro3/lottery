@extends('index')
@section('css')
    <link rel="stylesheet" href="theme/frontend/css/personal_page.css">
@endsection
@section('content')
<div id="app">
    <div class="mian">
        <div class="navbar">
            <div class="navbar-left">
                <a href="{{ url()->previous() ?? '/' }}" class="bank c-row c-row-middle-center"><img src="theme/frontend/images/back.c3244ab0.png" class="navbar-back">
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
            <div class="item c-row c-row-between">
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
        <div class="van-overlay" style="z-index: 2001;display: none"></div>
        <div class="van-popup van-popup--center" style="width: 80%;border-radius: 15px;max-width: 340px;z-index: 2002;">
            <div class="popup-box">
                <div class="title"></div>
                <div class="con">
                    <div class="lab">Thay đổi tên người dùng</div>
                    <div>
                        <input type="text" name="name" maxlength="16" placeholder="Tên người dùng" class="input">
                    </div>
                </div>
                <div class="food c-row c-row-middle-center">
                    <div class="item">Hủy</div>
                    <div class="item sure">Xác nhận</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection