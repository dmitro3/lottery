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
            <div class="navbar-title"> QUẢNG BÁ ĐẠI LÝ </div>
            <div class="navbar-right">
                <a href="tai-khoan/marketing/lich-su-gioi-thieu{{Support::renderBackLinkParamater('tai-khoan/marketing')}}" class="c-row">
                    <i class="van-icon van-icon-notes-o" style="font-size: 25px;color: #ffffff"></i>
                </a>
            </div>
        </div>
        <div class="promotion">
            @include('auth.marketing.action_tab',['activeTab'=>'main'])
            <div class="box">
                <div class="tit">Hướng dẫn</div>
                <div class="info">
                    <div class="info-data c-row c-row-between m-b-20">
                        <div class="left">
                            <h5 class="all">Hoa hồng ngày hôm nay</h5>
                            <p class="num">0</p>
                        </div>
                        <div class="right">
                            <p class="txt">Cấp dưới trực tiếp:<span
                                    class="num">1</span></p>
                            <p class="txt">Tổng thành viên:<span
                                    class="num">1</span></p>
                            <p class="txt">F1 mới hôm nay: <span
                                    class="num">1</span></p>
                            <p class="txt">Tổng F mới trong ngày: <span
                                    class="num">1</span></p>
                            <p class="txt">Tổng hoa hồng trong tuần:<span
                                    class="num">0</span></p>
                            <p class="txt">Tổng hoa hồng:<span
                                    class="num">0</span></p>
                        </div>
                    </div>
                    <div class="info-img c-row c-row-between">
                        <div class="img">
                            <div id="qrcode"
                                title="https://92lottery.net/#/register?r_code=sF3Yn529620"><canvas width="145"
                                    height="145" style="display: none;"></canvas><img alt="Scan me!"
                                    src="data:image/png;base64,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"
                                    style="display: block;"></div>
                            <div class="c-tc">Nhấn và giữ để lưu mã QR</div>
                        </div>
                        <div class="btn-list c-row c-row-middle-center">
                            <div class="btn-box">
                                <div class="btn m-b-10 c-row c-row-middle-center tag-read"
                                    data-clipboard-text="sF3Yn529620">Sao chép Mã giới thiệu</div>
                                <div
                                    data-clipboard-text="https://92lottery.net/#/register?r_code=sF3Yn529620"
                                    class="btn m-b-10 c-row c-row-middle-center tag-read">Sao chép đường dẫn</div>
                            </div>
                        </div>
                    </div>
                </div>
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
@section('js')
    <script src="theme/frontend/js/marketing.js" defer></script>
@endsection