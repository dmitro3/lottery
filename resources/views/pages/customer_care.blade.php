@extends('index')
@section('css')
    <link rel="stylesheet" href="theme/frontend/css/customer_care.css">
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
            <div class="navbar-title">Khách hàng</div>
            <div class="navbar-right"></div>
        </div>
        <div class="banner">
            <img width="100%" height="205px" src="theme/frontend/images/customerservice_title.d5e18bcd.png" class="img">
            <img width="120px" height="40px" src="{Ilogo.imgI}" class="logo">
        </div>
        <div class="list">
            @foreach (\App\Models\CustomerCareMethod::get() as $item)
                <a href="{{$item->link != '' ? $item->link:'javascript:void(0)'}}" class="item c-row c-row-between c-row-middle" target="_blank">
                    <div class="c-row c-row-middle">
                        <img height="35px" width="35px" src="{%IMGV2.item.icon.-1%}" class="img">
                        <div class="name m-l-10">{{Support::show($item,'name')}}</div>
                    </div>
                    <i class="van-icon van-icon-arrow" style="color: rgb(65, 65, 65); font-size: 20px;"></i>
                </a>
            @endforeach
        </div>
    </div>
</div>
@endsection