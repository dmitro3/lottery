<?php 
    $name = FCHelper::er($table,'name');
    $default_code = FCHelper::er($table,'default_code');
    $default_code = json_decode($default_code,true);
    $default_code = @$default_code?$default_code:array();
    $value ="";
    if($actionType=='edit'){
	    $value = FCHelper::er($dataItem,$name);
	}
    $realItem = \App\Models\WithdrawalRequest::find($dataItem->id);
?>
@if ($actionType=='edit')
    <div class="form-group">
        <p class="form-title">{{FCHelper::ep($table,'note')}} <span class="count"></span></p>
        <div class="text-left" style="font-size: 15px;border: solid 1px #ebebeb;border-radius: 8px;padding: 6px 10px;display: inline-block;background: #f9f9f9;">
            <div class="d-flex">
                <div class="w-50 pe-4" style="border-right: solid 1px #e1e1e1;">
                    <p class="mb-1">
                        <span class="d-inline-block" style="min-width: 120px;">Emai</span>
                        <strong>: {{Support::show($realItem,'email')}}</strong>
                    </p>
                    <p class="mb-1">
                        <span class="d-inline-block" style="min-width: 120px;">Số điện thoại</span>
                        <strong>: {{Support::show($realItem,'phone')}}</strong>
                    </p>
                    <p>
                        <span class="d-inline-block" style="min-width: 120px;">Tỉnh/Thành phố</span>
                        <strong>: {{Support::show($realItem,'province')}}</strong>
                    </p>
                </div>
                <div class="w-50 ps-4">
                    <p class="mb-1">
                        <span class="d-inline-block" style="min-width: 120px;">Ngân hàng</span>
                        <strong>: {{Support::show($realItem,'bank_short_name')}}</strong>
                    </p>
                    <p class="mb-1">
                        <span class="d-inline-block" style="min-width: 120px;">Chủ tài khoản</span>
                        <strong>: {{Support::show($realItem,'account_holder')}}</strong>
                    </p>
                    <p>
                        <span class="d-inline-block" style="min-width: 120px;">Chi nhánh</span>
                        <strong>: {{Support::show($realItem,'account_number')}}</strong>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endif