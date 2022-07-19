<div class="plinko-history-list-item">
    @foreach ($listItems as $item)
        @php
            $staticAmount = $item->buildAdminHistoryData();
        @endphp
        <div class="item">
            <div class="header-item d-flex flex-wrap align-items-center justify-content-between">
                <div class="d-flex flex-wrap align-items-center">
                    <span>Phiên:</span>
                    <strong class="ms-1 fs-14">{{Support::show($item,'id')}}</strong>
                    <span class="ms-5">{{now()->createFromTimestamp($item->start_time)->format('d/m/Y H:i:s')}}</span>
                    <span class="mx-3">
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                    </span>
                    <span>{{now()->createFromTimestamp($item->end_time)->format('d/m/Y H:i:s')}}</span>
                </div>
                <div class="d-flex flex-wrap align-items-center">
                    <button type="button" class="btn btn-info btn-show-hidden-content" style="padding: 2px 12px;">Chi tiết</button>
                </div>
            </div>
            <div class="plinko-item-history-hidden-content" style="display: none">
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
    @endforeach
</div>
<div class="pagination">
    <span class="total">Tổng số bản ghi: <strong>{{ $listItems->total() }}</strong></span>
    {{ $listItems->withQueryString()->links('vh::vendor.pagination.pagination') }}
</div>