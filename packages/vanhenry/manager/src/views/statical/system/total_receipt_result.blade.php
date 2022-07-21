@if (count($listItems) > 0)
    <div class="table-list-user scrollstyle">
        <table class="table table-bordered table-hover all-table-statiscal">
            <thead>
                <tr>
                    <th style="text-align:center">STT</th>
                    <th>Khách hàng</th>
                    <th>Số điện thoại</th>
                    <th>Số tiền</th>
                    <th>Ghi chú</th>
                    <th>Thời gian</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($listItems as $key => $item)
                    @php
                        $itemWallet = $item->wallet ?? null;
                        $itemUser = isset($itemWallet) ? $itemWallet->user ?? null:null;
                    @endphp
                    <tr>
                        <td style="text-align:center"><strong>{{($listItems->currentPage() - 1)*10 + $key + 1}}</strong></td>
                        <td>
                            {{Support::show($itemUser,'name')}}
                        </td>
                        <td>{{Support::show($itemUser,'phone')}}</td>
                        <td>
                            <strong class="text-info" style="font-size: 16px;">{{Currency::showMoney($item->amount)}}</strong>
                        </td>
                        <td>{{Support::show($item,'reason')}}</td>
                        <td>{{Support::showDateTime($item->created_at,'d/m/Y H:i:s')}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="pagination px-3 pb-1">
        <span class="total">Tổng số bản ghi: <strong>{{$listItems->total()}}</strong></span>
        {{ $listItems->withQueryString()->links('vh::vendor.pagination.pagination') }}
    </div>
@else
    <p class="p-4 text-center" style="font-size: 18px;">Không có lịch sử</p>
@endif