@if (count($listItems) > 0)
    @foreach ($listItems as $item)
        <div class="item c-row c-row-between c-row-middle m-b-5">
            <div>
                <div class="money"> 
                    {{Support::show($item,'id')}} 
                    ({{Str::substr($item->phone,0,3)}}@for ($i = 0; $i < Str::length($item->phone) - 6; $i++)*@endfor{{Str::substr($item->phone,Str::length($item->phone) - 3,4)}})
                </div>
            </div>
            <div>
                <div class="state m-b-5"><span style="color: rgb(153, 153, 153);">{{Support::showDateTime($item->created_at,'d/m/Y')}}</span></div>
            </div>
        </div>
    @endforeach
    <div class="pagination-hidden-box" style="display: none">
        {{$listItems->withQueryString()->links('vendors.pagination')}}
    </div>
@endif
@if (count($listItems) < 20)
    <div class="van-list__finished-text">Không còn nữa</div>
@endif