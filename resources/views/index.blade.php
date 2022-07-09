<!DOCTYPE html>
<html itemscope="" itemtype="http://schema.org/WebPage" lang="vi" translate="no" data-dpr="1" style="font-size: 48.3px;">
<head>
	<meta name="viewport"
		content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	{!! SEOHelper::HEADER_SEO(@$currentItem ? $currentItem : null) !!}
	@yield('cssl')
	<link rel="stylesheet" href="theme/frontend/css/base.css">
    <link rel="stylesheet" href="theme/frontend/css/app.css">
    <link rel="stylesheet" href="theme/frontend/css/van.css">
	@yield('css')
	<link rel="stylesheet" href="theme/frontend/css/add.css">
	<script type="text/javascript">
        var showNotify = "";
        var messageNotify = "{{ Session::get('messageNotify', '') }}";
        var typeNotify = "{{ Session::get('typeNotify', '') }}";
        var typePopup = "{{ Session::get('type', '') }}";
        var emailSocial = "{{ Session::get('emailSocial', '') }}";
        var auth = "{{ Session::get('auth', '') }}";
        var redirect = "{{ Session::get('redirect', '') }}";
	</script>
	{[CMS_HEADER]}
</head>
<body style="font-size: 12px;">
	<input type="hidden" name="auth_token" value="{{ \realtimemodule\pushserver\Helpers\PushServerHelper::getTokenUserKey() }}">
	@yield('content')
	@include('loading')
	{[CMS_FOOTER]}
	<script src="theme/frontend/js/sweetalert.min.js" defer></script>
	<script src="theme/frontend/js/xhr.js" defer></script>
	<script src="theme/frontend/js/base.js" defer></script>
	@yield('js')
</body>
</html>
