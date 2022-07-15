@extends('index')
@section('css')
    <link rel="stylesheet" href="theme/frontend/css/hts-introduce.css">
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
            <div class="navbar-title">Lịch sử giới thiệu</div>
            <div class="navbar-right"></div>
        </div>
        <div class="box">
            <div class="list m-b-10">
                <div role="feed" class="van-list infinite-load-item-module">
                    @if (count($listItems) > 0)
                        @foreach ($listItems as $item)
                            <div class="item c-row c-row-between c-row-middle m-b-5">
                                <div>
                                    <div class="money"> 
                                        {{Support::show($item,'id')}} 
                                        ({{Str::substr($item->phone,0,3)}}@for ($i = 0; $i < Str::length($item->phone) - 6; $i++)*@endfor{{Str::substr($item->phone,Str::length($item->phone) - 3,4)}})
                                    </div>
                                </div>
                                <div>
                                    <div class="state m-b-5"><span style="color: rgb(153, 153, 153);">{{Support::showDateTime($item->created_at,'d/m/Y')}}</span></div>
                                </div>
                            </div>
                        @endforeach
                        <div class="pagination-hidden-box" style="display: none">
                            {{$listItems->withQueryString()->links('vendors.pagination')}}
                        </div>
                        @if (count($listItems) < 20)
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