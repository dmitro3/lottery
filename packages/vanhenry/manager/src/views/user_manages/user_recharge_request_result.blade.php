@php
    use \App\Models\RechargeStatus;
    use \App\Models\RechargeMethod;
@endphp
<p class="big-title">LỆNH NẠP TIỀN (CHỈ ĐƯỢC THAY ĐỔI TRẠNG THÁI 1 LẦN)</p>
@if (count($listItems) > 0)
    <table class="base-table-horizontal">
        <thead>
            <tr>
                <th style="width: 60px;" class="text-center">STT</th>
                <th>Ngày gửi</th>
                <th>Số tiền</th>
                <th>Trạng thái</th>
                <th>Phương thức</th>
                <th>Thông tin thêm</th>
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
                        <p><strong class="text-info">{{\Currency::showMoney($item->amount)}}</strong></p>
                    </td>
                    <td class="text-center">
                        @if ($item->recharged == 0)
                            <select class="item-recharge-request-status" style="width: 100%;height: 32px;" data-item="{{$item->id}}" data-action="esystem/user-manage/change-user-recharge-request?user={{$user->id}}">
                                @foreach ($listRechargeStatus as $itemStatus)
                                    <option value="{{$itemStatus->id}}">{{Support::show($itemStatus,'name')}}</option>
                                @endforeach
                            </select>
                        @else
                            @if ($item->recharge_status_id == RechargeStatus::STATUS_CONFIRMED)
                                <p class="btn btn-success d-block" style="pointer-events: none;">{{Support::show($item->rechargeStatus,'name')}}</p>
                            @endif
                            @if ($item->recharge_status_id == RechargeStatus::STATUS_CANCEL)
                                <p class="btn btn-danger d-block" style="pointer-events: none;">{{Support::show($item->rechargeStatus,'name')}}</p>
                            @endif
                        @endif
                    </td>
                    <td>{{Support::show($item->rechargeMethod,'name')}}</td>
                    <td>
                        @if ($item->recharge_method_id == RechargeMethod::DIRECT_TRANSFER_METHOD)
                            <div class="text-nowrap">
                                <p style="border-bottom: solid 1px #ebebeb;padding-bottom: 5px;margin-bottom: 6px;">Thông tin tài khoản nhận chuyển khoản</p>
                                <p>
                                    <span class="d-inline-block" style="min-width: 90px;">Ngân hàng</span>
                                    <strong>: {{Support::show($item->rechargeRequestDirectTransferBankInfo,'bank_short_name')}}</strong>
                                </p>
                                <p>
                                    <span class="d-inline-block" style="min-width: 90px;">Chủ tài khoản</span>
                                    <strong>: {{Support::show($item->rechargeRequestDirectTransferBankInfo,'account_holder')}}</strong>
                                </p>
                                <p>
                                    <span class="d-inline-block" style="min-width: 90px;">Số tài khoản</span>
                                    <strong>: {{Support::show($item->rechargeRequestDirectTransferBankInfo,'account_number')}}</strong>
                                </p>
                            </div>
                        @endif
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