@extends('index')
@section('css')
    <link rel="stylesheet" href="theme/frontend/css/wallet.css">
@endsection
@section('content')
<div id="app">
    <div class="mian">
        <div class="navbar">
            <div class="navbar-left">
                <div class="navbar-left">
                    <a href="{{Support::generateBackLink()}}" class="bank c-row c-row-middle-center"><img src="theme/frontend/images/back.c3244ab0.png" class="navbar-back">
                    </a>
                </div>
            </div>
            <div class="navbar-title">Nhật ký đăng nhập</div>
            <div class="navbar-right"></div>
        </div>
        <div class="list">
            <div role="feed" class="van-list infinite-load-item-module">
                @if (count($listItems) > 0)
                    @foreach ($listItems as $item)
                        <div class="item c-row c-row-between">
                            <div class="c-row">
                                <div class="u-m-l-20">
                                    <div class="tit">{{Support::show($item,'user_ip')}}</div>
                                    <div class="time">{{Support::showDateTime($item->created_at,'Y/m/d H:i:s')}}</div>
                                </div>
                            </div>
                            <div class="number red">{{Support::show($item,'device_type')}}</div>
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
@endsection