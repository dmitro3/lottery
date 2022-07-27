@php
    use App\Models\Games\Lotto\GameLottoPlayUserBet;
@endphp
@if (isset($type) && $type == 'normal')
    <div class="van-list infinite-load-item-module" data-init="BASE_GUI.initCopyTextbtn" data-success="BASE_GUI.initCopyTextbtn">
        @if (count($listItems) > 0)
            @foreach ($listItems as $item)
                @include('auth.account.bet_history.item_lotto_bet_history')
            @endforeach
            <div class="pagination-hidden-box" style="display: none">
                {{$listItems->withQueryString()->links('vendors.pagination')}}
            </div>
            @if (count($listItems) < 20)
                <div class="van-list__finished-text">Không còn nữa</div>
            @endif
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
    </div>
@endif
@if (isset($type) && $type == 'load_item')
    @if (count($listItems) > 0)
        @foreach ($listItems as $item)
            @include('auth.account.bet_history.item_lotto_bet_history')
        @endforeach
        <div class="pagination-hidden-box" style="display: none">
            {{$listItems->withQueryString()->links('vendors.pagination')}}
        </div>
    @endif
    @if (count($listItems) < 20)
        <div class="van-list__finished-text">Không còn nữa</div>
    @endif
@endif