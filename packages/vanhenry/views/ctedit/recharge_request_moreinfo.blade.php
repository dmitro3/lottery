<?php 
    $name = FCHelper::er($table,'name');
    $default_code = FCHelper::er($table,'default_code');
    $default_code = json_decode($default_code,true);
    $default_code = @$default_code?$default_code:array();
    $value ="";
    if($actionType=='edit'){
	    $value = FCHelper::er($dataItem,$name);
	}
    $rechargeRequest = \App\Models\RechargeRequest::with('rechargeRequestDirectTransferBankInfo')->find($dataItem->id);
?>
@if ($rechargeRequest->recharge_method_id == \App\Models\RechargeMethod::DIRECT_TRANSFER_METHOD)
    @if ($actionType=='edit' && isset($rechargeRequest->rechargeRequestDirectTransferBankInfo))
        <div class="form-group">
            <p class="form-title">{{FCHelper::ep($table,'note')}} <span class="count"></span></p>
            <div class="text-left" style="border: solid 1px #ebebeb;border-radius: 8px;padding: 6px 10px;">
                <p style="border-bottom: solid 1px #ebebeb;padding-bottom: 5px;margin-bottom: 6px;">Thông tin tài khoản nhận chuyển khoản: </p>
                <p>
                    <span class="d-inline-block" style="min-width: 110px;">Ngân hàng</span>
                    <strong>: {{Support::show($rechargeRequest->rechargeRequestDirectTransferBankInfo,'bank_name')}}</strong>
                </p>
                <p>
                    <span class="d-inline-block" style="min-width: 110px;">Tên chủ tài khoản</span>
                    <strong>: {{Support::show($rechargeRequest->rechargeRequestDirectTransferBankInfo,'account_holder')}}</strong>
                </p>
                <p>
                    <span class="d-inline-block" style="min-width: 110px;">Số tài khoản</span>
                    <strong>: {{Support::show($rechargeRequest->rechargeRequestDirectTransferBankInfo,'account_number')}}</strong>
                </p>
            </div>
        </div>
    @endif
@endif