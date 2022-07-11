<div class="list m-t-10">
    @if (count($listItems) > 0)
        <div class="wrap">
            <div class="c-tc van-row">
                <div class="van-col van-col--8"> Kỳ xổ </div>
                <div class="van-col van-col--5"> Số lượng </div>
                <div class="van-col van-col--5"> Lớn Nhỏ </div>
                <div class="van-col van-col--6"> Màu sắc </div>
            </div>
        </div>
        <div>
            <div class="hb">
                @foreach ($listItems as $item)
                    @php
                        $miniGameColor = new App\Games\GoWin\MiniGames\Color;
                        $miniGameNumber = new App\Games\GoWin\MiniGames\Number;
                        $miniGameSize = new App\Games\GoWin\MiniGames\Size;
                    @endphp
                    <div class="c-tc item van-row">
                        <div class="van-col van-col--8">
                            <div class="c-tc goItem">{{Support::show($item,'id')}}</div>
                        </div>
                        <div class="van-col van-col--5">
                            <div class="c-tc goItem">
                                {!!$miniGameNumber->getHistoryHtml($item->win_number)!!}
                            </div>
                        </div>
                        <div class="van-col van-col--5">
                            <div class="c-tc goItem">
                                {!!$miniGameSize->getHistoryHtml($item->win_number)!!}
                            </div>
                        </div>
                        <div class="van-col van-col--6">
                            <div class="goItem c-row c-tc c-row-center">
                                <div class="c-tc c-row box c-row-center c-row-middle">
                                    {!!$miniGameColor->getHistoryHtml($item->win_number)!!}
                                </div>
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