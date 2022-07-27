@if ($paginator->hasPages())
    <div class="page-nav c-row c-row-center c-tc">
        @php
            $currentPage = $paginator->currentPage();
            $lastPage = $paginator->lastPage();
        @endphp
        @if ($currentPage > 1)
            <a href="{{$paginator->previousPageUrl()}}" class="arr c-row c-row-middle-center action">
                <i class="van-icon van-icon-arrow-left icon action" style="font-size: 20px;"></i>
            </a>
        @else
            <div class="arr c-row c-row-middle-center">
                <i class="van-icon van-icon-arrow-left icon" style="font-size: 20px;"></i>
            </div>
        @endif
        <div class="number">{{$currentPage}}/{{$paginator->lastPage()}}</div>
        @if ($currentPage < $lastPage)
            <a href="{{$paginator->nextPageUrl()}}" class="arr c-row c-row-middle-center action next-page">
                <i class="van-icon van-icon-arrow icon action" style="font-size: 20px;"></i>
            </a>
        @else
            <div class="arr c-row c-row-middle-center">
                <i class="van-icon van-icon-arrow icon" style="font-size: 20px;"></i>
            </div>
        @endif
    </div>
@endif