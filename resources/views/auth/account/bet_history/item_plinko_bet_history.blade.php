<div class="item p-l-5 p-r-5 p-t-5">
    <div class="c-row c-row-between c-row-middle info">
        @if ($item->mode == 'manual')
            <div class="name c-row" style="border-radius: 5px;">
                <div class="type">Thủ công</div>
            </div>
        @endif
        @if ($item->mode == 'auto')
            <div class="name c-row" style="border-radius: 5px;">
                <div class="type">Tự động</div>
            </div>
        @endif
        <div class="price c-row">
            <div class="OrderNumber c-tr">{{Support::show($item,'game_plinko_record_id')}}</div>
            <div class="m-l-10 tag-read van-image copy-text-btn" data-clipboard-text="{{Support::show($item,'game_plinko_record_id')}}" style="width: 18px; height: 15px;">
                @include('image_icons.copy_icon')
            </div>
        </div>
    </div>
    <div class="c-row c-row-between c-row-middle info">
        <div class="type">{{number_format($item->amount,0,',','.')}} đ</div>
        <div>
            @if ($item->game_win_user_bet_status_id == 1)
                <div class="money null">- - - -</div>
            @else
                @php
                    $amountGet = $item->return_amount - $item->amount; 
                @endphp
                @if ($amountGet < 0)
                    <div class="money">{{number_format($amountGet,0,',','.')}} đ</div>
                @else
                    <div class="money action">+{{number_format($amountGet,0,',','.')}} đ</div>
                @endif
            @endif
        </div>
    </div>
    <div class="c-row c-row-between info c-row-middle">
        <div class="time">{{Support::showDateTime($item->created_at,'Y/m/d H:i:s')}}</div>
    </div>
</div>