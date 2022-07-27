<div class="plinko-history-list-item">
    @php
        $staticAmount = $currentGame->buildAdminHistoryData();
    @endphp
    <div class="item mt-0">
        <div class="header-item d-flex flex-wrap align-items-center justify-content-between">
            <div class="d-flex flex-wrap align-items-center">
                <span>Phiên:</span>
                <strong class="ms-1 fs-14">{{Support::show($currentGame,'id')}}</strong>
                <span class="ms-5">
                    <span>Tổng giá trị: </span>
                    <strong style="font-size: 18px" class="text-info">{{number_format($staticAmount['total_bet'] ?? 0,0,',','.')}} đ</strong>
                </span>
                <span class="ms-5">{{now()->createFromTimestamp($currentGame->start_time)->format('d/m/Y H:i:s')}}</span>
                <span class="mx-3">
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                </span>
                <span>{{now()->createFromTimestamp($currentGame->end_time)->format('d/m/Y H:i:s')}}</span>
            </div>
        </div>
        <div class="plinko-item-history-content">
            <div class="item-more-detail d-flex size">
                <div class="title-box">Chế độ</div>
                <div class="inner-item d-flex">
                    <div class="item-content color-big"><strong>Thủ công</strong></div>
                    <div class="item-content color-small"><strong>Tự động</strong></div>
                </div>
            </div>
            <div class="item-more-detail d-flex size">
                <div class="title-box">Tổng đặt</div>
                <div class="inner-item d-flex">
                    <div class="item-content">
                        <strong>{{number_format($staticAmount['manual'] ?? 0,0,',','.')}} đ</strong>
                    </div>
                    <div class="item-content">
                        <strong>{{number_format($staticAmount['auto'] ?? 0,0,',','.')}} đ</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>