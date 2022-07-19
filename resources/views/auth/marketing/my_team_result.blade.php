@php
    use App\Models\WalletTransactionType;
@endphp
@if (count($listItems) > 0)
    @foreach ($listItems as $item)
        @php
            $itemUser = $item->user;
            $itemUserWallet = $itemUser->wallet;
            $totalBet = $itemUserWallet->walletHistory()
                                        ->whereIn('type',WalletTransactionType::getArrTypeTakeCommissionAble())
                                        ->sum('amount');
            $totalPersonalRecharge = $itemUserWallet->walletHistory()
                                        ->where('type',WalletTransactionType::RECHARGE_MONEY)
                                        ->sum('amount');
        @endphp
        <div class="item item-myteam-info">
            <div class="bd van-row">
                <div class="c-tc van-col van-col--4">
                    {{Support::show($item,'user_id')}}
                </div>
                <div class="c-tc van-ellipsis van-col van-col--6">
                    {{Support::show($item->user,'name')}}
                </div>
                <div class="c-tc red van-col van-col--8" style="white-space: nowrap;">
                    <strong>{{number_format((int)abs($totalBet),0,',','.')}} đ</strong>
                </div>
                <div class="van-col van-col--6 c-tc btn-show-bdshow">Chi tiết</div>
            </div>
            <div class="bdshow" style="display: none">
                <div>Tổng cược: <strong>{{number_format((int)abs($totalBet),0,',','.')}} đ</strong></div>
                <div>Nạp tiền: <strong>{{number_format((int)$totalPersonalRecharge,0,',','.')}} đ</strong></div>
                <div>Thời gian đăng ký: {{Support::showDateTime($itemUser->created_at,'Y/m/d H:i:s')}}</div>
                <div>Thành viên cấp dưới trực tiếp: {{count($item->directChild)}}</div>
            </div>
        </div>
    @endforeach
    <div class="pagination-hidden-box" style="display: none">
        {{$listItems->withQueryString()->links('vendors.pagination')}}
    </div>
@endif
@if (count($listItems) < 20)
    <div class="van-list__finished-text">Không còn nữa</div>
@endif