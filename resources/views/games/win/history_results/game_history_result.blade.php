@if (count($listItems) > 0)
    <div class="list m-t-10">
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
                                <span>Nhỏ</span>
                            </div>
                        </div>
                        <div class="van-col van-col--6">
                            <div class="goItem c-row c-tc c-row-center">
                                <div class="c-tc c-row box c-row-center c-row-middle">
                                    {!!$miniGameColor->getHistoryHtml($item->win_number)!!}
                                    <span class="li red"></span>
                                    <span class="li violet"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="list-fooder"></div>
    </div>
    <div class="page-nav c-row c-row-center c-tc">
        <div class="arr c-row c-row-middle-center">
            <i class="van-icon van-icon-arrow-left icon" style="font-size: 20px;"></i>
        </div>
        <div class="number">1/644</div>
        <div class="arr c-row c-row-middle-center action">
            <i class="van-icon van-icon-arrow icon action" style="font-size: 20px;"></i>
        </div>
    </div>
@else
    <p>Tạm thời chưa có bản ghi nào.</p>
@endif