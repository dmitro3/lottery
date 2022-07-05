@php
$itemImage = SettingHelper::getSetting($config_key);
$itemImageShow = new \StdClass();
$itemImageShow->img = $itemImage ?? null;
@endphp
@include('image_loader.default.big', ['itemImageShow' => $itemImageShow, 'noLazyLoad' => $noLazyLoad ?? 0, 'attribute' => $attribute ?? ''])
@php
unset($itemImageShow);
@endphp
