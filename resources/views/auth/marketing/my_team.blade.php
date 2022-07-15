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
                <div class="tit c-row c-row-between">Đội trực tiếp 1 người</div>
                <form action="tai-khoan/marketing/doi-cua-toi" id="form-fillter-myteam" method="get" accept-charset="utf8">
                    <div class="date m-t-5 c-row c-row-middle-center">
                        <span class="action c-row c-row-middle-center"> 
                            <label for="date-marketing-picker">
                                <input name="time" type="text" id="date-marketing-picker" style="width: 1px;height: 1px;opacity: 0;">
                                <span id="date-marketing-picker-preview">Ngày 13 Tháng 7 Năm 2022</span>
                                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABcAAAAXCAYAAAGXLeQ2AAAAAXNSR0IArs4c6QAAAERlWElmTU0AKgAAAAgAAYdpAAQAAAABAAAAGgAAAAAAA6ABAAMAAAABAAEAAKACAAQAAAABAAAAF6ADAAQAAAABAAAAFwAAAACm59GpAAABvElEQVRIDbWUO0sDQRSF4yM+UFIKChbaiaidnVj5I0xjKYi/xD8gooWFIDbpg03ETm0s/Ac+QBREUHzH8607cfZm1lkIXjjszLlnzty5s7ul0m/UejRuChPCKzyT9ugStdtOp4xdcwrf68mtoPTpJduGNct0p8S4STTzylrxhWzuCnBPP5+Mm24Pm/mCqArOJvasUhSiMaFIXCPKLSzgkFtrQPtDhQ7HwfyzZK6Ey5sVIEOLRSc8BhihbcV2a5QdtHg6xMvWl80HZ29s3xBYVE+fjH04vgHZEJaFWOwjvhIOY0rll9CwTZGo25YtapXfa8ZTzsn/UOCOBEoLhnUOihxpxfNK2DImnZgyym6i54mQV0YZ54pg3ULzinMZ1YJpwZW1lZoUuixpH4VVgeCluxBuKPtSGBQ2hA+BGBDIzTCJBDr0TksbDoRnITmivfh+8UMkCwQ69H7gl/y86Ne/Bea28k43SyqnX38FvVwTeEPy4k6JTSHz20EcM+eCb4UXxDlxLz75cdt8EfM9u6joPGY+IqMdIdaWFWme7KYxc1qyLgzbhd78QeM2Y/J8oWfCnHAsvAudBh/RgnD+DV40a9gtbFjqAAAAAElFTkSuQmCC" class="img m-l-5">
                            </label>
                        </span>
                    </div>
                    <div class="c-row c-row-between p-l-15 p-r-15 m-t-5">
                        <div class="p-r-10">
                            <input type="text" placeholder="UID" oninput="value=value.replace(/\D/g,'')" class="ipt">
                        </div>
                        <div class="p-r-10">
                            <div class="fd-select-box" style="padding: 0!important;border: none!important;">
                                <select class="select-level-marketing">
                                    <option value="">111</option>
                                    <option value="">111</option>
                                    <option value="">111</option>
                                    <option value="">111</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn c-tc" style="border: none;">Tìm kiếm</button>
                    </div>
                </form>
                <div class="c-row number c-flex-warp">
                    <div class="item">Tổng số tiền đặt cược:0</div>
                    <div class="item">Tổng số tiền hoa hồng:0</div>
                </div>
                <div class="table">
                    <div class="hd van-row">
                        <div class="c-tc van-col van-col--4">UID</div>
                        <div class="c-tc van-ellipsis van-col van-col--8">Tên</div>
                        <div class="c-tc van-ellipsis van-col van-col--6">Doanh thu</div>
                        <div class="c-tc van-ellipsis van-col van-col--6">Chi tiết</div>
                    </div>
                    <div class="list">
                        
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