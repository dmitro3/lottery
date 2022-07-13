<?php 
    use \App\Models\WithdrawalRequest;
    use \App\Models\WithdrawalRequestStatus;
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
    $realItem = WithdrawalRequest::with('withdrawalRequestStatus')->find(FCHelper::ep($dataItem,'id'));
@endphp
@if ($dataItem->status_changed == 1)
    <div class="form-group">
        <p class="form-title">{{FCHelper::er($table,'note')}} <span class="count"></span></p>
        <p style="width: 100%" class="btn py-1 btn-{{$realItem->withdrawal_request_status_id == WithdrawalRequestStatus::STATUS_CONFIRMED ? 'success':''}}{{$realItem->withdrawal_request_status_id == WithdrawalRequestStatus::STATUS_CANCEL ? 'danger':''}}">{{Support::show($realItem->withdrawalRequestStatus,'name')}}</p>
    </div>
@else
    @if(View::exists('tv::ctedit.select.'.$source) && ($default_code === null || !isset($default_code['no_edit']) || (isset($default_code['no_edit']) && !$default_code['no_edit'])))
        @include('tv::ctedit.select.'.$source,array('arrData'=>$arrData,'arrConfig' => $arrConfig))
    @endif
@endif
