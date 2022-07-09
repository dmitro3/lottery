@extends('index')
@section('css')
    <link rel="stylesheet" href="theme/frontend/css/home.css">
@endsection
@section('content')
<div id="app">
    <div class="home mian game">
        @include('static_blocks.logo')
        <div class="banner">
            <img src="theme/frontend/images/Banner_20210322123251jun9.jpg" class="img">
        </div>
        <div class="notice">
            <div class="notice-box c-row c-row-between">
                <div role="alert" class="van-notice-bar" style="font-size: 15px;"><i
                        class="van-icon van-icon-volume-o van-notice-bar__left-icon">
                    </i>
                    <div role="marquee" class="van-notice-bar__wrap">
                        <div class="van-notice-bar__content">Chào mừng bạn đến với chúng tôi. Chúc bạn có những giờ chơi vui vẻ và may mắn.</div>
                    </div>
                </div>
                <div class="txt">
                    <span class="sp">
                        <img src="theme/frontend/images/notice-right.5fdac404.svg" class="img">Thông báo mới nhất
                    </span>
                </div>
            </div>
        </div>
        <div class="home-com">
            <div class="van-tabs van-tabs--line home-tab action">
                {{-- <div class="van-tabs__wrap van-hairline--top-bottom">
                    <div role="tablist" class="van-tabs__nav van-tabs__nav--line">
                        <div role="tab" aria-selected="true" class="van-tab van-tab--active"><span
                                class="van-tab__text van-tab__text--ellipsis">
                                <div><img src="theme/frontend/images/CP.f775f9f6.png" class="img"></div>
                            </span></div>
                        <div role="tab" class="van-tab"><span class="van-tab__text van-tab__text--ellipsis">
                                <div><img src="theme/frontend/images/DZ.85b5faf9.png" class="img"></div>
                            </span></div>
                        <div role="tab" class="van-tab"><span class="van-tab__text van-tab__text--ellipsis">
                                <div><img src="theme/frontend/images/DC.bca66864.png" class="img"></div>
                            </span></div>
                        <div role="tab" class="van-tab"><span class="van-tab__text van-tab__text--ellipsis">
                                <div><img src="theme/frontend/images/TY.d0792b10.png" class="img"></div>
                            </span></div>
                        <div class="van-tabs__line">
                        </div>
                    </div>
                </div> --}}
                <div class="van-tabs__content">
                    <div role="tabpanel" class="c-row-between van-tab__pane">
                        <div class="gameList m-t-20">
                            <a href="win" class="item m-b-20">
                                <div class="info i3">
                                    <div class="name"> WIN GO </div>
                                    <div class="des"> Đoán màu xanh lá cây/tím/đỏ để giành chiến thắng </div><img
                                        width="120px" height="85px"
                                        src="theme/frontend/images/logo-wingo.37b04b53.png" class="img m-r-5">
                                </div>
                                <div class="userList">
                                    <div class="gomeList">
                                        <div class="list">
                                            <div class="swpier van-swipe">
                                                <div class="van-swipe__track van-swipe__track--vertical">
                                                    <div class="van-swipe-item">
                                                        <div class="swiper-item">
                                                            <div class="c-row c-row-between c-row-middle item"><img
                                                                    src="https://api.lightspacecdn.com/img/avatar.cfa8dd9d.svg"
                                                                    class="img">
                                                                <div class="info c-row c-row-between">
                                                                    <div class="m-l-10 name"> MemberNNG3AGVN</div>
                                                                    <div class="c-row c-row-middle-center"><span
                                                                            class="u-p-r-10">Có</span>
                                                                        <span class="price"> 17640.00 ₫</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="van-swipe-item">
                                                        <div class="swiper-item">
                                                            <div class="c-row c-row-between c-row-middle item"><img
                                                                    src="https://api.lightspacecdn.com/img/avatar.cfa8dd9d.svg"
                                                                    class="img">
                                                                <div class="info c-row c-row-between">
                                                                    <div class="m-l-10 name"> MỹHuyền</div>
                                                                    <div class="c-row c-row-middle-center"><span
                                                                            class="u-p-r-10">Có</span>
                                                                        <span class="price"> 1960.00 ₫</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="van-swipe-item">
                                                        <div class="swiper-item">
                                                            <div class="c-row c-row-between c-row-middle item"><img
                                                                    src="https://api.lightspacecdn.com/img/avatar.cfa8dd9d.svg"
                                                                    class="img">
                                                                <div class="info c-row c-row-between">
                                                                    <div class="m-l-10 name"> MemberNNGPDSRM</div>
                                                                    <div class="c-row c-row-middle-center"><span
                                                                            class="u-p-r-10">Có</span>
                                                                        <span class="price"> 1960.00 ₫</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="van-swipe-item">
                                                        <div class="swiper-item">
                                                            <div class="c-row c-row-between c-row-middle item"><img
                                                                    src="https://api.lightspacecdn.com/img/avatar.cfa8dd9d.svg"
                                                                    class="img">
                                                                <div class="info c-row c-row-between">
                                                                    <div class="m-l-10 name"> MemberNNGIKJOZ</div>
                                                                    <div class="c-row c-row-middle-center"><span
                                                                            class="u-p-r-10">Có</span>
                                                                        <span class="price"> 98000.00 ₫</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="van-swipe-item">
                                                        <div class="swiper-item">
                                                            <div class="c-row c-row-between c-row-middle item"><img
                                                                    src="https://api.lightspacecdn.com/img/avatar.cfa8dd9d.svg"
                                                                    class="img">
                                                                <div class="info c-row c-row-between">
                                                                    <div class="m-l-10 name"> MemberNNGNTJXQ</div>
                                                                    <div class="c-row c-row-middle-center"><span
                                                                            class="u-p-r-10">Có</span>
                                                                        <span class="price"> 73500.00 ₫</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bonus-box">
            <div class="img van-image" style="width: 100%; height: 170px;"><img
                    src="theme/frontend/images/coin-bonus.7945166d.png" class="van-image__img"></div>
            <div class="bonus-bg" style="">
                <div class="inner">
                    <span> 6788714619.00 ₫</span>
                </div>
            </div>
        </div>
        <div class="running-time">
            <p class="running-title c-tc"> Thời gian chạy trang web </p>
            <div class="c-row c-row-between" style="padding: 0px 33px 30px;">
                <div class="flip-num">
                    <div class="top">3338</div>
                    <div class="bottom">Ngày </div>
                    <div class="bottom-card">
                        <div class="back">
                            <p>3338</p>
                        </div>
                        <div class="front c-tc"> Ngày </div>
                    </div>
                </div>
                <div class="flip-num">
                    <div class="top">13</div>
                    <div class="bottom">Giờ</div>
                    <div class="bottom-card">
                        <div class="back">
                            <p class="c-tc">14</p>
                        </div>
                        <div class="front c-tc"> Giờ </div>
                    </div>
                </div>
                <div class="flip-num">
                    <div class="top">15</div>
                    <div class="bottom c-tc"> Phút </div>
                    <div class="bottom-card flipX">
                        <div class="back">
                            <p class="c-tc">16</p>
                        </div>
                        <div class="front c-tc"> Phút </div>
                    </div>
                </div>
                <div class="flip-num">
                    <div class="top">59</div>
                    <div class="bottom c-tc"> Giây</div>
                    <div class="bottom-card flipX">
                        <div class="back c-tc">
                            <p class="c-tc">00</p>
                        </div>
                        <div class="front c-tc">Giây</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="web-info c-row c-row-between">
            <div class="item c-tc">
                <div class="c-row c-row-cetner">
                    <div class="img van-image" style="width: 40px; height: 40px;"><img
                            src="data:image/png;base64,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"
                            class="van-image__img"></div>
                </div>
                <div class="num">120314</div>
                <div class="txt"> Số lượng người dùng </div>
            </div>
            <div class="item c-tc">
                <div class="c-row c-row-cetner">
                    <div class="img van-image" style="width: 40px; height: 40px;"><img
                            src="data:image/png;base64,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"
                            class="van-image__img"></div>
                </div>
                <div class="num">6788714619</div>
                <div class="txt"> Số lần đặt cược </div>
            </div>
            <div class="item c-tc">
                <div class="c-row c-row-cetner">
                    <div class="img van-image" style="width: 40px; height: 40px;"><img
                            src="data:image/png;base64,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"
                            class="van-image__img"></div>
                </div>
                <div class="num">9914</div>
                <div class="txt"> Số người trực tuyến </div>
            </div>
        </div>
        <div class="rank-box">
            <div class="rank-tit"> BẢNG XẾP HẠNG RÚT TIỀN </div>
            <div class="RankList">
                <div class="van-swipe">
                    <div class="van-swipe__track van-swipe__track--vertical">
                        <div class="item van-swipe-item">
                            <div class="swiper-item">
                                <div class="c-row c-row-between item"><img
                                        src="https://api.lightspacecdn.com/img/avatar.cfa8dd9d.svg" class="img">
                                    <div class="info c-row c-row-between">
                                        <div class="m-l-10 name">MemberNNGU5HM0</div>
                                        <div class="price">
                                            <span> 622023.00 ₫</span>
                                        </div>
                                        <div class="time">09:29</div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-item">
                                <div class="c-row c-row-between item"><img
                                        src="https://api.lightspacecdn.com/img/avatar.cfa8dd9d.svg" class="img">
                                    <div class="info c-row c-row-between">
                                        <div class="m-l-10 name">MemberNNGBCODW</div>
                                        <div class="price">
                                            <span> 1500000.00 ₫</span>
                                        </div>
                                        <div class="time">09:29</div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-item">
                                <div class="c-row c-row-between item"><img
                                        src="https://api.lightspacecdn.com/img/avatar.cfa8dd9d.svg" class="img">
                                    <div class="info c-row c-row-between">
                                        <div class="m-l-10 name">NguyễnDuy</div>
                                        <div class="price">
                                            <span> 100000.00 ₫</span>
                                        </div>
                                        <div class="time">09:29</div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-item">
                                <div class="c-row c-row-between item"><img
                                        src="https://api.lightspacecdn.com/img/avatar.cfa8dd9d.svg" class="img">
                                    <div class="info c-row c-row-between">
                                        <div class="m-l-10 name">MemberNNG7LIX8</div>
                                        <div class="price">
                                            <span> 300000.00 ₫</span>
                                        </div>
                                        <div class="time">09:29</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="home-how">
            <div class="info">
                <div class="tit"> Làm thế nào để mua ? </div>
                <div class="tab c-row c-flex-warp c-row-between">
                    <div class="item c-row c-row-between action c-row-middle">
                        <div>
                            <div class="step"> Bước đầu </div>
                            <div color="#e45d61" class="name"> Chọn một trò chơi </div>
                        </div>
                        <div>
                            <div class="van-image" style="width: 35px; height: 35px;"><img
                                    src="theme/frontend/images/work_first_hui.f200c215.png" class="van-image__img">
                            </div>
                        </div>
                    </div>
                    <div class="item c-row c-row-between c-row-middle">
                        <div>
                            <div class="step"> Bước hai </div>
                            <div color="#000" class="name"> Chọn con số may mắn của bạn </div>
                        </div>
                        <div>
                            <div class="van-image" style="width: 35px; height: 35px;"><img
                                    src="data:image/png;base64,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"
                                    class="van-image__img"></div>
                        </div>
                    </div>
                    <div class="item c-row c-row-between c-row-middle">
                        <div>
                            <div class="step"> Bước ba </div>
                            <div color="#000" class="name"> Đặt cược </div>
                        </div>
                        <div>
                            <div class="van-image" style="width: 35px; height: 35px;"><img
                                    src="data:image/png;base64,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"
                                    class="van-image__img"></div>
                        </div>
                    </div>
                    <div class="item c-row c-row-between c-row-middle">
                        <div>
                            <div class="step"> Bước bốn </div>
                            <div color="#000" class="name"> Nhận tiền thưởng </div>
                        </div>
                        <div>
                            <div class="van-image" style="width: 35px; height: 35px;"><img
                                    src="data:image/png;base64,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"
                                    class="van-image__img"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('static_blocks.shortcut_box')
    </div>
</div>
@endsection