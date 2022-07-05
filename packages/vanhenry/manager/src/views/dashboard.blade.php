@extends('vh::master')
@section('content')
{{-- @include('vh::pages.statistics') --}}
<hr>
{{-- @include('vh::pages.based') --}}
@if (isset($gaViewKey) && $gaViewKey !='')
    @include('vh::statistical_google_analytics')
@endif
@stop