@extends('vh::master')

@section('content')
@php
    $adminUser = \Auth::guard('h_users')->user();
@endphp
@if (isset($adminUser) && $adminUser->group == 1)
    @section('css')
    <link rel="stylesheet" href="admin/css/daterangepicker.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="admin/css/statistical/dashboard_statical.css" type="text/css" media="screen" />
    @stop
    @include('vh::pages.based')
    @if (isset($gaViewKey) && $gaViewKey !='')
        @include('vh::statistical_google_analytics')
    @endif
    @section('js')
        <script type="text/javascript" src="admin/js/chart.min.js" defer></script>
        <script type="text/javascript" src="admin/js/moment.min.js" defer></script>
        <script type="text/javascript" src="admin/js/daterangepicker.js" defer></script>
        <script type="text/javascript" src="admin/js/statistical/SimpleStaticalBox.js" defer></script>
        <script type="text/javascript" src="admin/js/statistical/dashboard_statical.js"></script>
    @stop
@else
    <p style="font-size: 20px;">Chào mừng <strong>{{Support::show($adminUser,'name')}}</strong> quay trở lại.</p>
@endif
@stop