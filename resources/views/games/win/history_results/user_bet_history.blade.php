@php
    use \App\Models\Games\Win\GameWinUserBetStatus;
@endphp
<div class="list m-t-10">
    @if (count($listItems) > 0)
        <div class="list m-t-10">
            @foreach ($listItems as $item)
                @php
                    $miniGame = \App\Games\GoWin\Factories\MiniGameFactory::getMiniGame($item->mini_game);
                    $miniGame->setValue($item->select_value);
                @endphp
                <div class="hb">
                    <div class="item c-row">
                        <div class="result">
                            {!!$miniGame->getUserBetHistoryHtml()!!}
                        </div>
                        <div class="c-row c-row-between info">
                            <div>
                                <div class="issueName">
                                    {{Support::show($item,'game_win_record_id')}}
                                    @if (isset($item->gameWinUserBetStatus))
                                        <span class="state {{Support::show($item->gameWinUserBetStatus,'color')}}">{{Support::show($item->gameWinUserBetStatus,'name')}}</span>
                                    @endif
                                </div>
                                <div class="tiem">{{Support::showDatetime($item->created_at,'Y/m/d H:i:s')}}</div>
                            </div>
                            <div class="money">
                                @if ($item->game_win_user_bet_status_id != GameWinUserBetStatus::STATUS_WAIT_RESULT)
                                    @if ($item->game_win_user_bet_status_id == GameWinUserBetStatus::STATUS_LOSE)
                                        <span class="fail">
                                            - {{number_format($item->amount, 0, ',', '.')}} đ
                                        </span>
                                    @endif
                                    @if ($item->game_win_user_bet_status_id == GameWinUserBetStatus::STATUS_WIN)
                                        <span class="success">
                                            + {{number_format($item->amount, 0, ',', '.')}} đ
                                        </span>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
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