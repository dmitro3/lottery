@php
    use App\Models\WithdrawalRequest;
@endphp
@if (count($listItems) > 0)
    @foreach ($listItems as $item)
        <div class="item c-row c-row-between m-b-10">
            <div>
                <div class="number c-row">
                    {{Support::show($item,'code')}}
                    <div class="m-l-10 tag-read van-image copy-text-btn" data-clipboard-text="{{Support::show($item,'code')}}" style="width: 18px; height: 15px;">
                        @include('image_icons.copy_icon')
                    </div>
                </div>
                <div >
                    <div class="money m-b-10 m-t-10">
                        <span style="color: {{Support::show($item->withdrawalRequestStatus,'color')}};"> {{number_format($item->amount,0,',','.')}} đ</span>
                    </div>
                </div>
                <div class="time">{{Support::showDateTime($item->created_at,'Y/m/d H:i:s')}}</div>
            </div>
            <div >
                <div class="state m-b-5">
                    <span style="color: {{Support::show($item->withdrawalRequestStatus,'color')}};">{{Support::show($item->withdrawalRequestStatus,'name')}}</span>
                </div>
            </div>
        </div>
    @endforeach
    <div class="pagination-hidden-box" style="display: none">
    {{$listItems->withQueryString()->links('vendors.pagination')}}
    </div>
@endif
@if (count($listItems) < WithdrawalRequest::PAGINATION_NUMBER)
    <div class="van-list__finished-text">Không còn nữa</div>
@endif