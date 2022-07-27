<div class="lotto-history-list-item">
    @foreach ($listItems as $item)
        @php
            $staticAmount = $item->buildAdminHistoryData();
        @endphp
        <div class="item">
            <div class="header-item d-flex flex-wrap align-items-center justify-content-between">
                <div class="d-flex flex-wrap align-items-center">
                    <span>Phiên:</span>
                    <strong class="ms-1 fs-14">{{Support::show($item,'id')}}</strong>
                    <span class="ms-5">
                        <span>Tổng giá trị: </span>
                        <strong style="font-size: 18px" class="text-info">{{number_format($staticAmount['total_bet'] ?? 0,0,',','.')}} đ</strong>
                    </span>
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
            <div class="lotto-item-history-content lotto-item-history-hidden-content" style="display: none">
                @foreach ($gameLottoCategory as $itemGameLottoCategory)
                    @php
                        $gameLottoTypes = $itemGameLottoCategory->gameLottoTypes;
                    @endphp
                    @if (count($gameLottoTypes) > 0)
                        <div class="item-group-wrapper">
                            <div class="group-title">
                                {{Support::show($itemGameLottoCategory,'name')}}
                            </div>
                            <div class="list-item">
                                <div class="item-more-detail d-flex">
                                    <div class="title-box">Loại cược</div>
                                    <div class="inner-item d-flex title">
                                        @foreach ($gameLottoTypes as $itemGameLottoTypes)
                                            <div class="item-content" style="width: {{100/count($gameLottoTypes)}}%"><strong>{{Support::show($itemGameLottoTypes,'name')}}</strong></div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="item-more-detail d-flex">
                                    <div class="title-box">Tổng đặt</div>
                                    <div class="inner-item d-flex">
                                        @foreach ($gameLottoTypes as $itemGameLottoTypes)
                                            <div class="item-content" style="width: {{100/count($gameLottoTypes)}}%">
                                                <strong>{{number_format($staticAmount[$itemGameLottoTypes->id] ?? 0,0,',','.')}} đ</strong>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    @endforeach
</div>
<div class="pagination">
    <span class="total">Tổng số bản ghi: <strong>{{ $listItems->total() }}</strong></span>
    {{ $listItems->withQueryString()->links('vh::vendor.pagination.pagination') }}
</div>