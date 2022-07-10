@extends('index')
@section('content')
<div id="app">
    <div class="mian">
        <div class="navbar">
            <div class="navbar-left">
                <a href="{{ url()->previous() ?? '/' }}" class="bank c-row c-row-middle-center">
                    <img src="theme/frontend/img/back.c3244ab0.png" class="navbar-back">
                </a>
            </div>
            <div class="navbar-title">{{Support::show($page,'name')}}</div>
            <div class="navbar-right"></div>
        </div>
        <div>
            <div class="content" style="padding: 16px;">
                {!!$page->content!!}
            </div>
        </div>
    </div>
</div>
@endsection