@php
    use App\Models\WalletTransactionType;
@endphp
@extends('index')
@section('css')
    <link rel="stylesheet" href="theme/frontend/css/pikaday.css">
    <link rel="stylesheet" href="theme/frontend/css/promotion.css">
    <link rel="stylesheet" href="theme/frontend/css/app_promotion-1.css">
    <link rel="stylesheet" href="theme/frontend/css/myteam.css">
@endsection
@section('content')
<div id="app">
    <div class="mian">
        <div class="navbar">
            <div class="navbar-left"></div>
            <div class="navbar-title">Đội của tôi</div>
            <div class="navbar-right">
                <a href="tai-khoan/marketing/lich-su-gioi-thieu{{Support::renderBackLinkParamater('tai-khoan/marketing/doi-cua-toi')}}" class="c-row">
                    <i class="van-icon van-icon-notes-o" style="font-size: 25px;color: #ffffff"></i>
                </a>
            </div>
        </div>
        <div class="promotion">
            @include('auth.marketing.action_tab',['activeTab'=>'doi-cua-toi'])
            <div class="box">
                <div class="tit c-row c-row-between">Đội của tôi ({{$listItems->total()}} người)</div>
                <form action="tai-khoan/marketing/doi-cua-toi" id="form-fillter-myteam" method="get" accept-charset="utf8">
                    <div class="c-row c-row-between p-l-15 p-r-15 m-t-5">
                        <div class="p-r-10">
                            <input name="uid" type="text" placeholder="UID" oninput="value=value.replace(/\D/g,'')" class="ipt" value="{{request()->uid ?? ''}}">
                        </div>
                        <div class="p-r-10">
                            <div class="fd-select-box" style="padding: 0!important;border: none!important;">
                                <select class="select-level-marketing" name="child_level">
                                    <option value="">Tất cả</option>
                                    @foreach ($listCommissionLevelConfig as $item)
                                        <option value="{{Support::show($item,'id')}}" {{isset(request()->child_level) && request()->child_level == $item->level ? 'selected':''}}>F{{Support::show($item,'level')}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn c-tc" style="border: none;">Tìm kiếm</button>
                    </div>
                </form>
                <div class="table">
                    <div class="hd van-row">
                        <div class="c-tc van-col van-col--4">UID</div>
                        <div class="c-tc van-ellipsis van-col van-col--6">Tên</div>
                        <div class="c-tc van-ellipsis van-col van-col--8">Tổng cược</div>
                        <div class="c-tc van-ellipsis van-col van-col--6">Chi tiết</div>
                    </div>
                    <div class="list">
                        <div role="feed" class="van-list infinite-load-item-module" data-init="MARKETING_GUI.initClickShowItemMyteamInfo" data-success="MARKETING_GUI.initClickShowItemMyteamInfo">
                            @if (count($listItems) > 0)
                                @foreach ($listItems as $item)
                                    @php
                                        $itemUser = $item->user;
                                        $itemUserWallet = $itemUser->wallet;
                                        $totalBet = $itemUserWallet->walletHistory()
                                                                    ->whereIn('type',WalletTransactionType::getArrTypeTakeCommissionAble())
                                                                    ->sum('amount');
                                        $totalPersonalRecharge = $itemUserWallet->walletHistory()
                                                                    ->where('type',WalletTransactionType::RECHARGE_MONEY)
                                                                    ->sum('amount');
                                    @endphp
                                    <div class="item item-myteam-info">
                                        <div class="bd van-row">
                                            <div class="c-tc van-col van-col--4">
                                                {{Support::show($item,'user_id')}}
                                            </div>
                                            <div class="c-tc van-ellipsis van-col van-col--6">
                                                {{Support::show($item->user,'name')}}
                                            </div>
                                            <div class="c-tc red van-col van-col--8" style="white-space: nowrap;">
                                                <strong>{{number_format((int)abs($totalBet),0,',','.')}} đ</strong>
                                            </div>
                                            <div class="van-col van-col--6 c-tc btn-show-bdshow">Chi tiết</div>
                                        </div>
                                        <div class="bdshow" style="display: none">
                                            <div>Tổng cược: <strong>{{number_format((int)abs($totalBet),0,',','.')}} đ</strong></div>
                                            <div>Nạp tiền: <strong>{{number_format((int)$totalPersonalRecharge,0,',','.')}} đ</strong></div>
                                            <div>Thời gian đăng ký: {{Support::showDateTime($itemUser->created_at,'Y/m/d H:i:s')}}</div>
                                            <div>Thành viên cấp dưới trực tiếp: {{count($item->directChild)}}</div>
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
        @include('static_blocks.shortcut_box',['activeTab' => 'marketing'])
    </div>
</div>
@endsection
@section('jsl')
    <script src="theme/frontend/js/moment.min.js" defer></script>
    <script src="theme/frontend/js/pikaday.js" defer></script>
@endsection
@section('js')
    <script src="theme/frontend/js/marketing.js" defer></script>
@endsection