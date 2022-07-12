<td>
    @if ($dataItem->recharge_method_id == \App\Models\RechargeMethod::DIRECT_TRANSFER_METHOD)
        @if (isset($dataItem->rechargeRequestDirectTransferBankInfo))
            <div class="text-left">
                <p>Thông tin tài khoản nhận chuyển khoản: </p>
                <p>
                    <span class="d-inline-block" style="min-width: 110px;">Ngân hàng</span>
                    <strong>: {{Support::show($dataItem->rechargeRequestDirectTransferBankInfo,'bank_name')}}</strong>
                </p>
                <p>
                    <span class="d-inline-block" style="min-width: 110px;">Tên chủ tài khoản</span>
                    <strong>: {{Support::show($dataItem->rechargeRequestDirectTransferBankInfo,'account_holder')}}</strong>
                </p>
                <p>
                    <span class="d-inline-block" style="min-width: 110px;">Số tài khoản</span>
                    <strong>: {{Support::show($dataItem->rechargeRequestDirectTransferBankInfo,'account_number')}}</strong>
                </p>
            </div>
        @endif
    @endif
</td>