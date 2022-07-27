@if ($paginator->hasPages())
    <div class="page-nav c-row c-row-center c-tc">
        @php
            $paginator->withQueryString();
            $currentPage = $paginator->currentPage();
            $lastPage = $paginator->lastPage();
        @endphp
        <div class="paginate-box-link-btn arr c-row c-row-middle-center {{$currentPage > 1 ? 'action':''}}" data-href="{{$currentPage > 1 ? $paginator->previousPageUrl():''}}">
            <i class="van-icon van-icon-arrow-left icon {{$currentPage > 1 ? 'action':''}}" style="font-size: 20px;"></i>
        </div>
        <div class="number">{{$currentPage}}/{{$paginator->lastPage()}}</div>
        <div class="paginate-box-link-btn arr c-row c-row-middle-center {{$currentPage < $lastPage ? 'action':''}}" data-href="{{$currentPage < $lastPage ? $paginator->nextPageUrl():''}}">
            <i class="van-icon van-icon-arrow icon {{$currentPage < $lastPage ? 'action':''}}" style="font-size: 20px;"></i>
        </div>
    </div>
@endif