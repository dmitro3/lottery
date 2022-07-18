@if (count($listItems) > 0)
    <table class="base-table-horizontal">
        <thead>
            <tr>
                <th style="width: 60px;" class="text-center">STT</th>
                <th>Số tiền</th>
                <th>Trạng thái</th>
                <th>Ngân hàng</th>
                <th>Tài khoản</th>
                <th>Ghi chú</th>
                <th>Ngày gửi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($listItems as $key => $item)
                <tr>
                    <td style="width: 60px;" class="text-center">
                        <strong>{{$listItems->perPage()*($listItems->currentPage() - 1) + $key + 1}}</strong>
                    </td>
                    <td><strong class="fs-16">{{\Currency::showMoney($item->amount)}}</strong></td>
                    <td>
                        @if ($item->status_changed == 0)
                            <select class="item-withdrawal-request-status" style="width: 100%;height: 32px;" data-item="{{$item->id}}" data-action="esystem/shop-manage/change-shop-witdraw-status">
                                @foreach ($listItemsStatus as $itemStatus)
                                    <option value="{{$itemStatus->id}}">{{Support::show($itemStatus,'name')}}</option>
                                @endforeach
                            </select>
                        @else
                            <p><span class="disable-select-value">{{Support::show($item->shopWithdrawalRequestStatus,'name')}}</span></p>
                        @endif
                    </td>
                    <td>
                        <p>Tên ngân hàng: <strong>{{Support::show($item,'bank_name')}}</strong></p>
                        <p>Chi nhánh: <strong>{{Support::show($item,'bank_branch')}}</strong></p>
                    </td>
                    <td>
                        <p>Chủ tài khoản: <strong>{{Support::show($item,'card_holder')}}</strong></p>
                        <p>Số tài khoản: <strong>{{Support::show($item,'bank_account_number')}}</strong></p>
                    </td>
                    <td>{{Support::show($item,'note')}}</td>
                    <td>{{Support::showDateTime($item->created_at,'d/m/Y H:i:s')}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pagination">
        <span class="total">Tổng số bản ghi: <strong>{{$listItems->total()}}</strong></span>
        {{ $listItems->withQueryString()->links('vh::vendor.pagination.pagination') }}
    </div>
@else
    <p class="text-center p-2">Tạm thời chưa có yêu cầu nào.</p>
@endif