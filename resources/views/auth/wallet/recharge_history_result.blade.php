@if (count($listItems) > 0)
    @foreach ($listItems as $item)
        <div class="item c-row c-row-between m-b-10">
            <div>
                <div class="number c-row">20220708151025083784532</div>
                <div >
                    <div class="money m-b-10 m-t-10">
                        <span > 50265.00 ₫</span>
                    </div>
                </div>
                <div class="time">2022-07-08 15:10:25</div>
            </div>
            <div >
                <div class="state m-b-5">
                    <span style="color: #6abe57;;">Đã hủy</span>
                </div>
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