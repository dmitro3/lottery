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
                            <p class="num">{{number_format((int)$userCommissionStatisticsCurrentDayRecord->total_amount,0,',','.')}} đ</p>
                        </div>
                        <div class="right">
                            <p class="txt">Cấp dưới trực tiếp:<span class="num">{{$dataStatical['total_f1'] ?? 0}}</span></p>
                            <p class="txt">Tổng thành viên:<span class="num">{{$dataStatical['total_child'] ?? 0}}</span></p>
                            <p class="txt">F1 mới hôm nay: <span class="num">{{$dataStatical['total_f1_today'] ?? 0}}</span></p>
                            <p class="txt">Tổng F mới trong ngày: <span class="num">{{$dataStatical['total_child_today'] ?? 0}}</span></p>
                            <p class="txt">Tổng hoa hồng trong tuần:<span class="num">{{isset($dataStatical['total_commission_week']) ? number_format((int)$dataStatical['total_commission_week'],0,',','.'):''}} đ</span></p>
                            <p class="txt">Tổng hoa hồng:<span class="num">{{isset($dataStatical['total_commission']) ? number_format((int)$dataStatical['total_commission'],0,',','.'):''}} đ</span></p>
                        </div>
                    </div>
                    <div class="info-img c-row c-row-between">
                        <div class="img">
                            <div id="qrcode" data-link="{{url()->to('dang-ky')}}?r_code={{Support::show($user,'referral_code')}}"></div>
                            <div class="c-tc">Nhấn và giữ để lưu mã QR</div>
                        </div>
                        <div class="btn-list c-row c-row-middle-center">
                            <div class="btn-box">
                                <div class="btn m-b-10 c-row c-row-middle-center tag-read copy-text-btn" data-clipboard-text="{{Support::show($user,'referral_code')}}">Sao chép Mã giới thiệu</div>
                                <div data-clipboard-text="{{url()->to('dang-ky')}}?r_code={{Support::show($user,'referral_code')}}" class="btn m-b-10 c-row c-row-middle-center tag-read copy-text-btn">Sao chép đường dẫn</div>
                            </div>
                        </div>
                    </div>
                </div>
                @include('auth.marketing.guide_content')
            </div>
        </div>
        @include('static_blocks.shortcut_box',['activeTab' => 'marketing'])
    </div>
</div>
@endsection
@section('jsl')
    <script src="theme/frontend/js/qrcode.min.js" defer></script>
@endsection
@section('js')
    <script src="theme/frontend/js/marketing.js" defer></script>
@endsection