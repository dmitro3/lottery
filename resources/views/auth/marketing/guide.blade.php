@extends('index')
@section('css')
    <link rel="stylesheet" href="theme/frontend/css/promotion.css">
    <link rel="stylesheet" href="theme/frontend/css/app_promotion-1.css">
@endsection
@section('content')
<div id="app">
    <div class="mian">
        <div class="navbar">
            <div class="navbar-left"></div>
            <div class="navbar-title">Hướng dẫn</div>
            <div class="navbar-right">
                <a href="tai-khoan/marketing/lich-su-gioi-thieu{{Support::renderBackLinkParamater('tai-khoan/marketing/huong-dan')}}" class="c-row">
                    <i class="van-icon van-icon-notes-o" style="font-size: 25px;color: #ffffff"></i>
                </a>
            </div>
        </div>
        <div class="promotion">
            @include('auth.marketing.action_tab',['activeTab'=>'huong-dan'])
            <div class="box">
                <div class="tit c-row c-row-between">BẢNG CẤP BẬC ĐẠI LÝ</div>
                <div class="table">
                    <div class="box" style="width: 480px;">
                        <div class="hd van-row">
                            <div class="c-tc van-ellipsis van-col van-col--6">Cấp đại lý</div>
                            <div class="c-tc van-ellipsis van-col van-col--10">Khối lượng cược F1 tuần trước</div>
                            <div class="c-tc van-ellipsis van-col van-col--8">Cấp con được hưởng</div>
                        </div>
                        <div class="bd van-row">
                            <div class="c-tc van-col van-col--6">Cấp 0</div>
                            <div class="c-tc van-col van-col--12">0</div>
                            <div class="c-tc van-col van-col--6">Không có</div>
                        </div>
                        @foreach ($listCommissionLevelConfig as $itemCommissionLevelConfig)
                            <div class="bd van-row">
                                <div class="c-tc van-ellipsis van-col van-col--6">Cấp {{Support::show($itemCommissionLevelConfig,'level')}}</div>
                                <div class="c-tc van-col van-col--12"> {{number_format($itemCommissionLevelConfig->total_direct_child_bet_condition,0,',','.')}} đ</div>
                                <div class="c-tc van-col van-col--6">
                                    @if ($itemCommissionLevelConfig->level == 1)
                                        F1
                                    @else
                                        F1 ➝ F{{$itemCommissionLevelConfig->level}}
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="tit c-row c-row-between m-t-15">Cách tính hoa hồng</div>
                <div class="table">
                    <div class="hd van-row">
                        <div class="c-tc van-ellipsis van-col van-col--6">
                            Cấp Con
                        </div>
                        <div class="c-tc van-ellipsis van-col van-col--18">
                            Tỷ lệ hoàn trả / Khối lượng cược
                        </div>
                    </div>
                    @foreach ($listCommissionLevelConfig as $itemCommissionLevelConfig)
                        <div class="bd van-row">
                            <div class="c-tc van-ellipsis van-col van-col--6">F{{Support::show($itemCommissionLevelConfig,'level')}}</div>
                            <div class="c-tc van-col van-col--18"> {{$itemCommissionLevelConfig->level_percen}}%</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @include('static_blocks.shortcut_box',['activeTab' => 'marketing'])
    </div>
</div>
@endsection