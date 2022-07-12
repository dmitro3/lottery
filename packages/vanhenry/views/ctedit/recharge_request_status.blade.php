<?php 
    use \App\Models\RechargeMethod;
    use \App\Models\RechargeStatus;
    use \App\Models\RechargeRequest;
    $name = FCHelper::er($table,'name');
    $default_data = FCHelper::er($table,'default_data');
    $default_data = json_decode($default_data,true);
    $default_code = FCHelper::er($table,'default_code');
    $default_code = json_decode($default_code,true);
    $arrData = FCHelper::er($default_data,'data');
    $arrConfig = FCHelper::er($default_data,'config');
    $source = FCHelper::er($arrConfig,'source');
?>
@php
    $realItem = RechargeRequest::with('rechargeStatus')->find(FCHelper::ep($dataItem,'id'));
@endphp
@if ($realItem->recharge_method_id == RechargeMethod::DIRECT_TRANSFER_METHOD)
    @if ($dataItem->recharged == 1)
        <div class="form-group">
            <p class="form-title">{{FCHelper::er($table,'note')}} <span class="count"></span></p>
            <p style="width: 100%" class="btn py-1 btn-{{$realItem->recharge_status_id == RechargeStatus::STATUS_CONFIRMED ? 'success':''}}{{$realItem->recharge_status_id == RechargeStatus::STATUS_CANCEL ? 'danger':''}}">{{Support::show($realItem->rechargeStatus,'name')}}</p>
        </div>
        @else
        @if(View::exists('tv::ctedit.select.'.$source) && ($default_code === null || !isset($default_code['no_edit']) || (isset($default_code['no_edit']) && !$default_code['no_edit'])))
            @include('tv::ctedit.select.'.$source,array('arrData'=>$arrData,'arrConfig' => $arrConfig))
        @endif
    @endif
@endif
