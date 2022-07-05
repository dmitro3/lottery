<link rel="stylesheet" href="admin/css/daterangepicker.css">
<script src="{'admin/js/moment.min.js'}" defer></script>
<script src="{'admin/js/daterangepicker.js'}" defer></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
    .order-wating-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 16px;
    }

    .col-lg-5-2:not(:last-child) {
        border-right: 1px solid #ebebeb;
    }

    .sumary-item {
        display: flex;
        align-items: center;
        padding: 16px;
        border-right: 1px solid #ebebeb;
    }

    .col-lg-3:last-child .sumary-item {
        border-right: none
    }

    .summary-group {
        margin-left: 12px;
    }

    .sumary .col-lg-3:not(:last-child) .sumary-item {
        border-left: 1px solid #ebebeb;
    }

    .summary {
        border: 1px solid #ebebeb;
        box-shadow: 0 13px 27px -5px hsl(240deg 30% 28% / 25%),
            0 8px 16px -8px hsl(0deg 0% 0% / 30%),
            0 -6px 16px -6px hsl(0deg 0% 0% / 3%);
    }

    .sumary-svg {
        color: #fff;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        border-radius: 50%;
        justify-content: center;
    }

    .sumary-svg .icon {
        fill: currentColor;
        width: 1em;
        height: 1em;
        display: inline-block;
        font-size: 1.5rem;
        transition: fill 200ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
        flex-shrink: 0;
        user-select: none;
    }

    .mb-5 {
        margin-bottom: 3rem;
    }

    .summary-head {
        display: flex;
        padding: 2px 16px;
        border-bottom: 1px solid #ebebeb;
    }

    .summary-count {
        font-size: 18px;
        font-weight: bold;
    }

    .fw-bold {
        font-weight: bold
    }

    .item-chart {
        padding: 16px;
        border: 1px solid #ebebeb;
        box-shadow: 0 13px 27px -5px hsl(240deg 30% 28% / 25%),
            0 8px 16px -8px hsl(0deg 0% 0% / 30%),
            0 -6px 16px -6px hsl(0deg 0% 0% / 3%);
    }

    .row.g-5>div[class^="col"] {
        margin-bottom: 16px;
        padding: 0 15px;
    }

    .row.no-gutter {
        display: flex;
        margin: 0
    }

    .col-lg-5-2 {
        flex: 0 0 20%;
        max-width: 20%
    }

    .row.no-gutter>div[class^="col"] {
        padding: 0;
    }

    .product-item {
        display: flex;
        flex-wrap: wrap;
        align-items: center
    }

    .product-info {
        display: flex;
        flex-wrap: wrap;
        flex: 1;
    }

    .product-info .product-image img {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .product-name {
        flex: 1;
    }

    .product-info .product-image {
        width: 57px;
        display: block;
        position: relative;
        padding-bottom: 57px;
        overflow: hidden;
        margin-right: 15px;
    }

    h5.title {
        font-weight: bold;
    }

    .product-item .count {
        color: #005ba9;
        font-weight: bold;
        padding: 4px 12px;
    }

    .product-rank {
        margin-right: 12px;
        width: 32px;
        height: 32px;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        background: red;
        border-radius: 100%
    }
    .order-total-count{
        font-weight: bold
    }
    .d-flex {
        display: flex;
        flex-wrap: wrap;
    }

    .justify-content-between {
        justify-content: space-between;
    }

    .title-item-product {
        color: #535353;
        font-weight: bold;
        font-size: 13px;
    }
    .order-wating-title,
    .summary-title{
        color: #535353
    }

</style>
<h1 class="list-link">Báo cáo thống kê</h1>
<section class="overview-statistic" style="margin-top:32px">
    <div class="row g-5">
        <div class="col-12">
            <div class="summary mb-5">
                <div class="summary-head">
                    <h5 class="title">Kết quả kinh doanh trong ngày</h5>
                </div>
                @php
                    $nowCreatedat = new \Datetime();
                    $paramCreatedAt = [];
                    $paramCreatedAt['type-created_at'] = 'DATETIME';
                    $paramCreatedAt['from-created_at'] = $nowCreatedat->format('Y-m-d') . ' 00:00:00';
                    $paramCreatedAt['search-created_at'] = $nowCreatedat->format('Y-m-d') . ' 00:00:00';
                    $paramCreatedAt['to-created_at'] = $nowCreatedat->modify('+1 days')->format('Y-m-d') . ' 23:59:59';
                    $buildDataCreatedAt = http_build_query($paramCreatedAt);
                    $urlCreatedAt = url('esystem/search/orders') . '?' . $buildDataCreatedAt;

                    $nowUpdatedAt = new \Datetime();
                    $paramUpdatedAt = [];
                    $paramUpdatedAt['type-updated_at'] = 'DATETIME';
                    $paramUpdatedAt['from-updated_at'] = $nowUpdatedAt->format('Y-m-d') . ' 00:00:00';
                    $paramUpdatedAt['search-updated_at'] = $nowUpdatedAt->format('Y-m-d') . ' 00:00:00';
                    $paramUpdatedAt['to-updated_at'] = $nowUpdatedAt->modify('+1 days')->format('Y-m-d') . ' 23:59:59';
                    $buildDataUpdatedAt = http_build_query($paramUpdatedAt);
                    $urlUpdatedAt = url('esystem/search/orders') . '?' . $buildDataUpdatedAt;
                @endphp
                <div class="row no-gutter">
                    <div class="col-lg-3">
                        <a class="sumary-item" target="_blank" href="{{ $urlCreatedAt }}">
                            @include('vh::pages.statistic_icon.total')
                            <div class="summary-group">
                                <p class="summary-title">Doanh thu</p>
                                <p class="summary-count" style="color:#0088FF">{{ number_format($dataSumary['revenue'], 0, ',', '.') }}</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3">
                        <a class="sumary-item" target="_blank" href="{{ $urlCreatedAt }}&search-status=none&type-status=SELECT&status=4">
                            @include('vh::pages.statistic_icon.total')
                            <div class="summary-group">
                                <p class="summary-title">Đơn hàng thành công</p>
                                <p class="summary-count" style="color:#0088FF">{{ $dataSumary['success'] }}</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3">
                        <a class="sumary-item" target="_blank" href="{{ $urlCreatedAt }}&search-status=none&type-status=SELECT&status=1">
                            @include('vh::pages.statistic_icon.order')
                            <div class="summary-group">
                                <p class="summary-title">Đơn hàng mới</p>
                                <p class="summary-count" style="color:#0FD186">{{ $dataSumary['new'] }}</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3">
                        <a class="sumary-item" target="_blank" href="{{ $urlUpdatedAt }}&search-status=none&type-status=SELECT&status=9">
                            @include('vh::pages.statistic_icon.refund')
                            <div class="summary-group">
                                <p class="summary-title">Đơn trả hàng</p>
                                <p class="summary-count" style="color:#FFAE06">{{ $dataSumary['refund'] }}</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3">
                        <a class="sumary-item" target="_blank" href="{{ $urlUpdatedAt }}&search-status=none&type-status=SELECT&status=7">
                            @include('vh::pages.statistic_icon.cancel')
                            <div class="summary-group">
                                <p class="summary-title">Đơn hủy</p>
                                <p class="summary-count" style="color:#FF4D4D">{{ $dataSumary['cancel'] }}</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="order-wating summary">
                <div class="summary-head">
                    <h5 class="title">Đơn hàng chờ xử lý</h5>
                </div>
                <div class="row no-gutter">
                    <div class="col-lg-5-2">
                        <a class="order-wating-item" target="_blank" href="{{ url('esystem/search/orders') . '?&search-status=none&type-status=SELECT&status=1' }}">
                            @include('vh::pages.statistic_icon.pending')
                            <p class="order-wating-title">Chờ duyệt</p>
                            <p class="order-total-count">{{ $dataOrderWait['new'] }}</p>
                        </a>
                    </div>
                    <div class="col-lg-5-2">
                        <a class="order-wating-item" target="_blank" href="{{ url('esystem/search/orders') . '?search-payment_status=none&type-payment_status=SELECT&payment_status=0' }}">
                            @include('vh::pages.statistic_icon.waiting_payment')
                            <p class="order-wating-title">Chờ thanh toán</p>
                            <p class="order-total-count">{{ $dataOrderWait['no-payment'] }}</p>
                        </a>
                    </div>
                    <div class="col-lg-5-2">
                        <a class="order-wating-item" target="_blank" href="{{ url('esystem/search/orders') . '?&search-status=none&type-status=SELECT&status=3' }}">
                            @include('vh::pages.statistic_icon.waiting_good')
                            <p class="order-wating-title">Chờ lấy hàng</p>
                            <p class="order-total-count">{{ $dataOrderWait['wating'] }}</p>
                        </a>
                    </div>
                    <div class="col-lg-5-2">
                        <a class="order-wating-item" target="_blank" href="{{ url('esystem/search/orders') . '?&search-status=none&type-status=SELECT&status=4' }}">
                            @include('vh::pages.statistic_icon.delivering')
                            <p class="order-wating-title">Đang giao hàng</p>
                            <p class="order-total-count">{{ $dataOrderWait['delivering'] }}</p>
                        </a>
                    </div>
                    <div class="col-lg-5-2">
                        <a class="order-wating-item" target="_blank" href="{{ url('esystem/search/orders') . '?&search-status=none&type-status=SELECT&status=8' }}">
                            @include('vh::pages.statistic_icon.cancle_devely')
                            <p class="order-wating-title">Hủy giao - chờ trả hàng</p>
                            <p class="order-total-count">{{ $dataOrderWait['waiting-return'] }}</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="countOrderDay item-chart">
                <div class="d-flex justify-content-between">
                    <h5 class="title">Số đơn trong ngày</h5>
                    <form action="esystem/statistic/getCountDay" method="GET" class="d-flex" data-success="STATISTIC_CALLBACK.getCountByDay">
                        @csrf
                        <input type="text" class="form-control me-2 filter-date" data-type="day" name="day" value="{{ date('d/m/Y', strtotime(now())) . ' - ' . date('d/m/Y', strtotime('+1 day')) }}">
                    </form>
                </div>
                <canvas class="main" width="400" height="100"></canvas>
                <p class="dataCount" data-statistic="{{ $data['countDay'] }}"></p>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="countProduct item-chart">
                <div class="d-flex justify-content-between">
                    <h5 class="title">Sản phẩm bán chạy</h5>
                    <form action="esystem/statistic/getProductHot" method="GET" class="d-flex" data-success="STATISTIC_CALLBACK.getCountProduct">
                        @csrf
                        <input type="text" class="form-control me-2 filter-date" data-type="day" name="day" value="{{ date('d/m/Y', strtotime('-1 month')) . ' - ' . date('d/m/Y', strtotime('+1 day')) }}">
                    </form>
                </div>
                <div class="show-count-product">
                    @include('vh::pages.static.ajax.product_item')
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="totalMonth item-chart">
                <div class="d-flex justify-content-between">
                    <h5 class="title">Tổng doanh thu trong tháng</h5>
                    <form action="esystem/statistic/getTotalMonth" method="GET" class="d-flex" data-success="STATISTIC_CALLBACK.getTotalMonth">
                        @csrf
                        <input type="text" class="form-control me-2 filter-date" data-type="month" name="day" value="{{ date('d/m/Y', strtotime('-1 month')) . ' - ' . date('d/m/Y', strtotime('+1 day')) }}">
                    </form>
                </div>
                <canvas class="main" width="400" height="100"></canvas>
                <p class="dataCount" data-statistic="{{ $data['totalMonth'] }}"></p>
            </div>
        </div>
    </div>
</section>
<script src="{{ asset('admin/js/statistic.js') }}" defer></script>
