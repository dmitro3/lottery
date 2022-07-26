@php
    use \App\Models\RechargeMethod;
    use \App\Models\RechargeStatus;
    use \App\Models\RechargeRequest;
    $realItem = RechargeRequest::with('rechargeStatus')->find($dataItem->id)
@endphp
<td data-title="{{$show->note}}">
    @if ($realItem->recharge_method_id == RechargeMethod::DIRECT_TRANSFER_METHOD)
        @if ($realItem->recharged == 1)
            <p style="min-width: 110px;pointer-events: none;" class="btn py-1 btn-{{$realItem->recharge_status_id == RechargeStatus::STATUS_CONFIRMED ? 'success':''}}{{$realItem->recharge_status_id == RechargeStatus::STATUS_CANCEL ? 'danger':''}}">{{Support::show($realItem->rechargeStatus,'name')}}</p>
        @else
            <?php 
                $defaultData = FCHelper::ep($show,"default_data"); 
                $arrKey = json_decode($defaultData,true);
                $arrData = FCHelper::er($arrKey,'data');
                $arrConfig = FCHelper::er($arrKey,'config');
                $table = FCHelper::ep($arrData,'table');
                $where = FCHelper::ep($arrData,'where');
                $select = FCHelper::ep($arrData,'select');
                $field_base = FCHelper::ep($arrData,'field_base');
                $default = FCHelper::ep($arrData,'default');
                $simpleDefault = array();
                foreach ($default as $_key => $_value) {
                    array_push($simpleDefault, $_key);
                }
                $select = vanhenry\helpers\helpers\StringHelper::isNull($select)?"id,name":$select;
                $select = explode(',', $select);
                $fullSelect = array();
                $select = array_merge($select,$fullSelect);
                $isMultiselect = FCHelper::ep($arrConfig,'multiselect');
                $arrTmp = Cache::remember('_vh_admin_view_select_'.$tableData->get($table,'')."_".$show->name, 10, function() use($select,$where,$table,$transTable) {
                    if ($transTable != null) {
                        $langChoose = FCHelper::langChooseOfTable($table);
                        $q = DB::table($table)->select($select)->join($transTable->table_map, 'id', '=', 'map_id')->where('language_code', $langChoose);
                    }
                    else{
                        $q = DB::table($table)->select($select);
                    }
                    if($where !=null && count($where)>0){
                        $q = $q->where(array($where));
                    }
                    return $q->get();
                }); 
            ?>
            <?php 
                $currentID = FCHelper::ep($dataItem,$show->name);
            ?>
            <?php $multi = explode(',', $currentID); $arrMerge = array_intersect($multi,$simpleDefault); ?>
            @if($show->editable == 1 && !$isMultiselect)
                <select dt-reload="1" dt-prop="{{$show->is_prop ?? 0}}" dt-prop-id="{{$show->id}}" name="{{$show->name}}" class="select2 editable" table="{{$show->parent_name}}" style="width: 150px">
                    @foreach($arrTmp as $key => $value)
                        <option value="{{$value->id}}" {{$value->id == $currentID?"selected":""}}>{{ $value->name}}</option>
                    @endforeach
                </select>
            @else
                @if(count($arrMerge)>0)
                    @foreach($arrMerge as $m)
                        <p class="select static-select" dt-value="{{$m}}">{{FCHelper::ep($default[$m],'value',1)}}</p>
                    @endforeach
                @endif
                @foreach($arrTmp as $key => $value)
                    @if($isMultiselect)
                        @if(in_array($value->id,$multi))
                            <p class="select static-select" dt-value="{{$value->id}}">{{ FCHelper::ep($value,$select[1]) }}</p>
                        @endif
                    @else
                        @if($value->id == $currentID)
                            <p class="select static-select" dt-value="{{$value->id}}">{{ FCHelper::ep($value,$select[1]) }}</p>
                        @elseif(in_array($currentID,$default))
                            <p class="select static-select" dt-value="{{$currentID}}">{{FCHelper::ep($default,'value',1)}}</p>
                        @endif
                    @endif
                @endforeach
            @endif
        @endif
        @if ($realItem->is_marketing == 1)
            <p class="mt-2" style="color:#a94442">(* Yêu cầu từ tài khoản Marketing)</p>
        @endif
    @else
        <p style="min-width: 110px;pointer-events: none;" class="btn py-1 btn-default btn-{{$realItem->recharge_status_id == RechargeStatus::STATUS_CONFIRMED ? 'success':''}}{{$realItem->recharge_status_id == RechargeStatus::STATUS_CANCEL ? 'danger':''}}">{{Support::show($realItem->rechargeStatus,'name')}}</p>
    @endif
</td>