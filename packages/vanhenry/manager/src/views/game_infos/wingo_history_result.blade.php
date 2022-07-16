<div class="wingo-history-list-item">
    @foreach ($listItems as $item)
        @php
            $staticAmount = $item->buildAdminHistoryData();
        @endphp
        <div class="item">
            <div class="header-item d-flex flex-wrap align-items-center justify-content-between">
                <div class="d-flex flex-wrap align-items-center">
                    <span>Phiên:</span>
                    <strong class="ms-1 fs-14">{{Support::show($item,'id')}}</strong>
                    <span class="ms-5">Số thắng:</span>
                    <strong class="ms-1 fs-14">{{Support::show($item,'win_number')}}</strong>
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
            <div class="wingo-item-history-hidden-content" style="display: none">
                <div class="item-more-detail d-flex color">
                    <div class="title-box">Màu sắc</div>
                    <div class="inner-item d-flex">
                        <div class="item-content color-green"><strong>Xanh</strong></div>
                        <div class="item-content color-violet"><strong>Tím</strong></div>
                        <div class="item-content color-red"><strong>Đỏ</strong></div>
                    </div>
                </div>
                <div class="item-more-detail d-flex color">
                    <div class="title-box">Tổng đặt</div>
                    <div class="inner-item d-flex">
                        <div class="item-content">
                            <strong>{{number_format($staticAmount['green'] ?? 0,0,',','.')}} đ</strong>
                        </div>
                        <div class="item-content">
                            <strong>{{number_format($staticAmount['violet'] ?? 0,0,',','.')}} đ</strong>
                        </div>
                        <div class="item-content">
                            <strong>{{number_format($staticAmount['red'] ?? 0,0,',','.')}} đ</strong>
                        </div>
                    </div>
                </div>

                <div class="item-more-detail d-flex number">
                    <div class="title-box">Số</div>
                    <div class="inner-item d-flex">
                        @for ($k = 0; $k <= 9; $k++)
                            <div class="item-content color-{{$k}}">
                                <strong>{{$k}}</strong>
                            </div>
                        @endfor
                    </div>
                </div>
                <div class="item-more-detail d-flex number">
                    <div class="title-box">Tổng đặt</div>
                    <div class="inner-item d-flex">
                        @for ($k = 0; $k <= 9; $k++)
                            <div class="item-content">
                                <strong>{{number_format($staticAmount[$k] ?? 0*10000000,0,',','.')}} đ</strong>
                            </div>
                        @endfor
                    </div>
                </div>
                <div class="item-more-detail d-flex size">
                    <div class="title-box">Lớn nhỏ</div>
                    <div class="inner-item d-flex">
                        <div class="item-content color-big"><strong>Lớn</strong></div>
                        <div class="item-content color-small"><strong>Nhỏ</strong></div>
                    </div>
                </div>
                <div class="item-more-detail d-flex size">
                    <div class="title-box">Tổng đặt</div>
                    <div class="inner-item d-flex">
                        <div class="item-content">
                            <strong>{{number_format($staticAmount['big'] ?? 0,0,',','.')}} đ</strong>
                        </div>
                        <div class="item-content">
                            <strong>{{number_format($staticAmount['small'] ?? 0,0,',','.')}} đ</strong>
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