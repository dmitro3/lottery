<div class="list m-t-10">
    @if (count($listItems) > 0)
        <div class="wrap">
            <div class="c-tc van-row">
                <div class="van-col van-col--6"> Kỳ xổ </div>
                <div class="van-col van-col--6"> Loại bóng </div>
                <div class="van-col van-col--6"> Ăn </div>
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
                                {{$rate = Support::show($item,'bag_value') + 0}}
                            </div>
                        </div>
                        <div class="van-col van-col--6">
                            <div class="c-tc goItem">
                                {{number_format($rate * $ball->getBetAmount(),0,',','.')}}đ
                            </div>
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