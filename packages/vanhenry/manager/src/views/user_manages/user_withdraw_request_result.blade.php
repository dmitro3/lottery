@php
    use \App\Models\WithdrawalRequestStatus;
@endphp
<p class="big-title">LỆNH RÚT TIỀN (CHỈ ĐƯỢC THAY ĐỔI TRẠNG THÁI 1 LẦN)</p>
@if (count($listItems) > 0)
    <table class="base-table-horizontal">
        <thead>
            <tr>
                <th style="width: 60px;" class="text-center">STT</th>
                <th>Ngày gửi</th>
                <th>Số tiền</th>
                <th>Trạng thái</th>
                <th>Ngân hàng</th>
                <th>Tài khoản</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($listItems as $key => $item)
                <tr>
                    <td style="width: 60px;" class="text-center">
                        <strong>{{$listItems->perPage()*($listItems->currentPage() - 1) + $key + 1}}</strong>
                    </td>
                    <td>
                        <p class="text-nowrap">Mã gd: <strong>{{Support::show($item,'code')}}</strong></p>
                        {{Support::showDateTime($item->created_at,'d/m/Y H:i:s')}}
                    </td>
                    <td class="p-2 text-nowrap">
                        <table style="width: 100%;border: solid 1px #ebebeb">
                            <tbody>
                                <tr>
                                    <td style="width: 85px;">Số tiền</td>
                                    <td><p><strong class="color-gray">{{\Currency::showMoney($item->amount)}}</strong></p></td>
                                </tr>
                                <tr>
                                    <td style="width: 85px;">Phí sàn</td>
                                    <td><p><strong class="color-gray">{{\Currency::showMoney($item->amount*$item->fee_percent/100)}}</strong></p></td>
                                </tr>
                                <tr>
                                    <td style="border-bottom: none!important;width: 85px;" class="bg-small-gray"><strong>Gửi khách</strong></td>
                                    <td style="border-bottom: none!important;" class="bg-small-gray"><p><strong class="text-info fs-16">{{\Currency::showMoney($item->amount_final)}}</strong></p></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td class="text-center">
                        @if ($item->status_changed == 0)
                            <select class="item-withdrawal-request-status" style="width: 100%;height: 32px;" data-item="{{$item->id}}" data-action="esystem/user-manage/change-user-withdraw-request?user={{$user->id}}">
                                @foreach ($listWithdrawalRequestStatus as $itemStatus)
                                    <option value="{{$itemStatus->id}}">{{Support::show($itemStatus,'name')}}</option>
                                @endforeach
                            </select>
                        @else
                            @if ($item->withdrawal_request_status_id == WithdrawalRequestStatus::STATUS_CONFIRMED)
                                <p class="btn btn-success d-block" style="pointer-events: none;">{{Support::show($item->withdrawalRequestStatus,'name')}}</p>
                            @endif
                            @if ($item->withdrawal_request_status_id == WithdrawalRequestStatus::STATUS_CANCEL)
                                <p class="btn btn-danger d-block" style="pointer-events: none;">{{Support::show($item->withdrawalRequestStatus,'name')}}</p>
                            @endif
                        @endif
                    </td>
                    <td>
                        <p>Ngân hàng: <strong>{{Support::show($item,'bank_short_name')}}</strong></p>
                        <p>Chi nhánh: <strong>{{Support::show($item,'account_branch')}}</strong></p>
                    </td>
                    <td>
                        <p>Chủ tk: <strong>{{Support::show($item,'account_holder')}}</strong></p>
                        <p>Số tk: <strong>{{Support::show($item,'account_number')}}</strong></p>
                    </td>
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