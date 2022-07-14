<div class="list m-t-10">
    @if (count($listItems) > 0)
    <div class="wrap">
        <div class="c-tc van-row">
            <div class="van-col van-col--6"> Ván game </div>
            <div class="van-col van-col--6"> Loại bóng </div>
            <div class="van-col van-col--6"> Số lượng </div>
            <div class="van-col van-col--6"> Tiền thắng </div>
        </div>
    </div>
    <div>
        <div class="hb">
            @foreach ($listItems as $item)
            <div class="c-tc item van-row">
                <div class="van-col van-col--6">
                    <div class="c-tc goItem">{{Support::show($item,'game_plinko_record_id')}}</div>
                </div>
                <div class="van-col van-col--6">
                    <div class="c-tc goItem">
                        @php
                        $ball = \App\Games\Plinko\Enums\BallType::getByValue(Support::show($item,'type'))
                        @endphp
                        {{$ball->getBetAmountText()}}
                    </div>
                </div>
                <div class="van-col van-col--6">
                    <div class="c-tc goItem">
                        {{Support::show($item,'qty')}}
                    </div>
                </div>
                <div class="van-col van-col--6">
                    @php
                    $amount = Support::show($item,'amount');
                    $ramount = Support::show($item,'return_amount');
                    $sub = $ramount - $amount;
                    @endphp

                    @if($sub > 0)
                    <div class="c-tc goItem green">
                        {{number_format($sub,0,',','.')}}đ
                    </div>
                    @else
                    <div class="c-tc goItem red">
                        {{number_format($sub,0,',','.')}}đ
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @else
    <div class="p-t-5 p-b-5">
        <div class="van-empty">
            <div class="van-empty__image">
                <img src="theme/frontend/img/empty-image-default.png">
            </div>
            <p class="van-empty__description">Không có dữ liệu</p>
        </div>
    </div>
    @endif
    <div class="list-fooder"></div>
</div>
{{$listItems->withQueryString()->links('games.win.history_results.pagination')}}