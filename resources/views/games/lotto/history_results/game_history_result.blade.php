@php
    use \App\Models\Games\Lotto\GameLottoPlayUserBet;
@endphp
<div class="list m-t-10">
    @if (count($listItems) > 0)
    <div class="wrap">
        <div class="c-tc van-row">
            <div class="van-col van-col--6"> Ván game </div>
            <div class="van-col van-col--6"> Loại Game </div>
            <div class="van-col van-col--6"> Tiền cược </div>
            <div class="van-col van-col--6"> Tiền thắng </div>
        </div>
    </div>
    <div>
        <div class="hb">
            @foreach ($listItems as $item)
            <div class="c-tc item van-row">
                <div class="van-col van-col--6">
                    <div class="c-tc goItem" style="    word-break: break-all;">{{Support::show($item,'game_lotto_play_record_id')}}</div>
                </div>
                <div class="van-col van-col--6">
                    <div class="c-tc goItem">
                        
                        {{$item->gameLottoType->name}}
                    </div>
                </div>
                @php
                $amount = Support::show($item,'amount');
                $ramount = Support::show($item,'return_amount');
                $clazz = Support::show($item,'game_lotto_play_user_bet_status_id') == GameLottoPlayUserBet::STATUS_WIN?'green':'red';
                @endphp
                <div class="van-col van-col--6">
                    <div class="c-tc goItem">
                        {{number_format($amount,0,',','.')}}đ
                    </div>
                </div>
                <div class="van-col van-col--6">
                   

                    <div class="c-tc goItem {{$clazz}}">
                        {{number_format($ramount,0,',','.')}}đ
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