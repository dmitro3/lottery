<div class="list m-t-10">
    @if (count($listItems) > 0)
        <div class="wrap">
            <div class="c-tc van-row">
                <div class="van-col van-col--8"> Kỳ xổ </div>
                <div class="van-col van-col--16"> Số lượng </div>
            </div>
        </div>
        <div>
            @foreach ($listItems as $key => $item)
                <div class="hb">
                    <div class="p-l-5 p-l-5 p-t-20 p-b-20 van-row">
                        <div class="van-col van-col--8">
                            <div class="c-tc">{{Support::show($item,'id')}}</div>
                        </div>
                        <div class="van-col van-col--16">
                            <div class="c-row c-row-between">
                                <div></div>
                                <div class="c-row qiu">
                                    @if ($key < (count($listItems) - 1))
                                        <canvas start="{{Support::show($item,'win_number')}}" end="{{Support::show($listItems[$key + 1],'win_number')}}" class="line-canvas"></canvas>
                                    @endif
                                    @for ($i = 0; $i <= 9; $i++)
                                        <div class="li {{$item->win_number == $i ? 'action'.$i:''}}">
                                            <div>{{$i}}</div>
                                        </div>
                                    @endfor
                                    <div class="m-l-5">
                                        <div class="li action{{$item->win_number < 5 ? 'S':'B'}}">{{$item->win_number < 5 ? 'S':'B'}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="p-t-5 p-b-5">
            <div class="van-empty">
                <div class="van-empty__image">
                    <img src="theme/frontend/img/empty-image-default.png">
                </div>
                <p class="van-empty__description">Không có dữ liệu</p>
            </div>
        </div>
    @endif
    <div class="list-fooder"></div>
</div>
@if (count($listItems) > 0)
    <div class="page-nav c-row c-row-center c-tc">
        @php
            $listItems->withQueryString();
            $currentPage = $listItems->currentPage();
            $lastPage = $listItems->lastPage();
        @endphp
        <div class="paginate-box-link-btn arr c-row c-row-middle-center {{$currentPage > 1 ? 'action':''}}" data-href="{{$currentPage > 1 ? $listItems->previousPageUrl():''}}">
            <i class="van-icon van-icon-arrow-left icon {{$currentPage > 1 ? 'action':''}}" style="font-size: 20px;"></i>
        </div>
        <div class="number">{{$currentPage}}/{{$listItems->total()}}</div>
        <div class="paginate-box-link-btn arr c-row c-row-middle-center {{$currentPage < $lastPage ? 'action':''}}" data-href="{{$currentPage < $lastPage ? $listItems->nextPageUrl():''}}">
            <i class="van-icon van-icon-arrow icon {{$currentPage < $lastPage ? 'action':''}}" style="font-size: 20px;"></i>
        </div>
    </div>
@endif