@php
$dataColor = [
    1 => '#33A0FF',
    2 => '#3FDA9E',
    3 => '#FFCE6A',
    4 => '#FF9494',
    5 => '#66B8FF'
];
@endphp
@forelse($productHot as $key => $product)
    <div class="product-item">
        @php
            $item = $product['info'];
        @endphp
        <div class="product-rank" style="background:{{$dataColor[$key + 1]}}">
            {{$key + 1}}
        </div>
        <div class="product-info">
            <a href="{-item.slug-}" class="product-image">
                <img src="{%IMGV2.item.img.390x0%}" alt="{%AIMGV2.item.img.alt%}" title="{%AIMGV2.item.img.title%}">
            </a>
            <div class="product-name">
                <a href="{-item.slug-}" class="title-item-product">
                    {-item.name-}
                </a>
                <p>{-item.code-}</p>
            </div>
        </div>
        <p class="count">{{$product['count']}}</p>
    </div>
@empty
    <div class="no-result">
        Không có sản phẩm nào!
    </div>
@endforelse
