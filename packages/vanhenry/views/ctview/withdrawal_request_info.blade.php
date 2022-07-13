@php
    use \App\Models\WithdrawalRequest;
    $realItem = WithdrawalRequest::find($dataItem->id);
@endphp
<td>
    <div class="text-left">
        <p style="padding-bottom: 3px;margin-bottom: 5px;border-bottom: solid 1px #e1e1e1;"><strong>Thông tin tài khoản nhận tiền rút: </strong></p>
        <div class="d-flex" style="font-size: 14px;">
            <div class="w-50 pe-3" style="border-right: solid 1px #e1e1e1;">
                <p class="mb-1">
                    <span class="d-inline-block" style="min-width: 100px;">Emai</span>
                    <strong>: {{Support::show($realItem,'email')}}</strong>
                </p>
                <p class="mb-1">
                    <span class="d-inline-block" style="min-width: 100px;">Số điện thoại</span>
                    <strong>: {{Support::show($realItem,'phone')}}</strong>
                </p>
                <p>
                    <span class="d-inline-block" style="min-width: 100px;">Tỉnh/Thành phố</span>
                    <strong>: {{Support::show($realItem,'province')}}</strong>
                </p>
            </div>
            <div class="w-50 ps-3">
                <p class="mb-1">
                    <span class="d-inline-block" style="min-width: 100px;">Ngân hàng</span>
                    <strong>: {{Support::show($realItem,'bank_short_name')}}</strong>
                </p>
                <p class="mb-1">
                    <span class="d-inline-block" style="min-width: 100px;">Chủ tài khoản</span>
                    <strong>: {{Support::show($realItem,'account_holder')}}</strong>
                </p>
                <p>
                    <span class="d-inline-block" style="min-width: 100px;">Chi nhánh</span>
                    <strong>: {{Support::show($realItem,'account_number')}}</strong>
                </p>
            </div>
        </div>
    </div>
</td>