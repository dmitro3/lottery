@if (count($listItems) > 0)
    <div class="table-list-user scrollstyle">
        <table class="table table-bordered table-hover all-table-statiscal">
            <thead>
                <tr>
                    <th style="text-align:center">STT</th>
                    <th>Tên</th>
                    <th>Số điện thoại</th>
                    <th>Tổng tiền</th>
                    <th style="text-align:center">Hồ sơ</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($listItems as $key => $item)
                    @php
                        $itemUser = $item->user;
                    @endphp
                    <tr>
                        <td style="text-align:center"><strong>{{($listItems->currentPage() - 1)*10 + $key + 1}}</strong></td>
                        <td style="padding:1px 6px">
                            <div class="img-user">
                                <img src="theme/frontend/images/avatar.cfa8dd9d.svg" class="img-fluid">
                            </div>
                            {{Support::show($itemUser,'name')}}
                        </td>
                        <td>{{Support::show($itemUser,'phone')}}</td>
                        <td>
                            <strong>{{Currency::showMoney($item->total_amount)}}</strong>
                        </td>
                        <td style="text-align:center">
                            <a href="esystem/user-manage/user-info?id={{$itemUser->id}}" class="btn btn-info">
                                <i class="fa fa-user" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="pagination px-3 pb-1">
        <span class="total">Tổng số bản ghi: <strong>{{$listItems->total()}}</strong></span>
        {{ $listItems->withQueryString()->links('vh::vendor.pagination.pagination') }}
    </div>
@else
    <p class="p-4 text-center" style="font-size: 18px;">Tạm thời chưa có ai nạp tiền.</p>
@endif

