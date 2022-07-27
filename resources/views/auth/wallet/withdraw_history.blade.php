@php
    use App\Models\WithdrawalRequest;
@endphp
@extends('index')
@section('css')
    <link rel="stylesheet" href="theme/frontend/css/history_recharge.css">
@endsection
@section('content')
<div id="app">
    <div class="mian">
        <div  class="navbar">
            <div class="navbar-left">
                <a href="{{Support::generateBackLink()}}" class="bank c-row c-row-middle-center">
                    <img src="theme/frontend/images/back.c3244ab0.png" class="navbar-back">
                </a>
            </div>
            <div class="navbar-title">Lịch sử rút tiền</div>
            <div class="navbar-right"></div>
        </div>
        <div class="box">
            <div class="list m-b-20">
                <div role="feed" class="van-list infinite-load-item-module" data-init="BASE_GUI.initCopyTextbtn" data-success="BASE_GUI.initCopyTextbtn">
                    @if (count($listItems) > 0)
                        @foreach ($listItems as $item)
                            <div class="item c-row c-row-between m-b-10">
                                <div>
                                    <div class="number c-row">
                                        {{Support::show($item,'code')}}
                                        <div class="m-l-10 tag-read van-image copy-text-btn" data-clipboard-text="{{Support::show($item,'code')}}" style="width: 18px; height: 15px;">
                                            @include('image_icons.copy_icon')
                                        </div>
                                    </div>
                                    <div >
                                        <div class="money m-b-10 m-t-10">
                                            <span style="color: {{Support::show($item->withdrawalRequestStatus,'color')}};"> {{number_format($item->amount,0,',','.')}} đ</span>
                                        </div>
                                    </div>
                                    <div class="time">{{Support::showDateTime($item->created_at,'Y/m/d H:i:s')}}</div>
                                </div>
                                <div >
                                    <div class="state m-b-5">
                                        <span style="color: {{Support::show($item->withdrawalRequestStatus,'color')}};">{{Support::show($item->withdrawalRequestStatus,'name')}}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="pagination-hidden-box" style="display: none">
                            {{$listItems->withQueryString()->links('vendors.pagination')}}
                        </div>
                        @if (count($listItems) < WithdrawalRequest::PAGINATION_NUMBER)
                            <div class="van-list__finished-text">Không còn nữa</div>
                        @endif
                    @else
                        <div class="p-t-5 p-b-5">
                            <div class="van-empty">
                                <div class="van-empty__image">
                                    <img src="theme/frontend/img/empty-image-default.png">
                                </div>
                                <p class="van-empty__description">Không có dữ liệu</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection