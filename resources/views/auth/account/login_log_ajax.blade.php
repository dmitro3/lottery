@php
    use App\Models\UserLoginLog;
@endphp
@if (count($listItems) > 0)
    @foreach ($listItems as $item)
        <div class="item c-row c-row-between">
            <div class="c-row">
                <div class="u-m-l-20">
                    <div class="tit">{{Support::show($item,'user_ip')}}</div>
                    <div class="time">{{Support::showDateTime($item->created_at,'Y/m/d H:i:s')}}</div>
                </div>
            </div>
            <div class="number red">{{Support::show($item,'device_type')}}</div>
        </div>
    @endforeach
    <div class="pagination-hidden-box" style="display: none">
        {{$listItems->withQueryString()->links('vendors.pagination')}}
    </div>
@endif
@if (count($listItems) < UserLoginLog::PAGINATION_NUMBER)
    <div class="van-list__finished-text">Không còn nữa</div>
@endif