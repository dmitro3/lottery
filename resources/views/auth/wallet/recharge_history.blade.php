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
            <div class="navbar-title">Lịch sử nạp tiền</div>
            <div class="navbar-right"></div>
        </div>
        <div class="box">
            <div class="list m-b-20">
                <div role="feed" class="van-list infinite-load-item-module">
                    @if (count($listItems) > 0)
                        @foreach ($listItems as $item)
                            <div class="item c-row c-row-between m-b-10">
                                <div>
                                    <div class="number c-row">20220708151025083784532</div>
                                    <div >
                                        <div class="money m-b-10 m-t-10">
                                            <span > 50265.00 ₫</span>
                                        </div>
                                    </div>
                                    <div class="time">2022-07-08 15:10:25</div>
                                </div>
                                <div >
                                    <div class="state m-b-5">
                                        <span style="color: #f2413b;">Đã hủy</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="pagination-hidden-box" style="display: none">
                            {{$listItems->withQueryString()->links('vendors.pagination')}}
                        </div>
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