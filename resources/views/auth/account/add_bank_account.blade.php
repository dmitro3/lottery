@extends('index')
@section('css')
    <link rel="stylesheet" href="theme/frontend/css/add_bank.css">
@endsection
@section('content')
<div id="app">
    <div class="mian">
        <div class="navbar">
            <div class="navbar-left">
                <a href="{{Support::generateBackLink()}}" class="bank c-row c-row-middle-center">
                    <img src="theme/frontend/images/back.c3244ab0.png" class="navbar-back" />
                </a>
            </div>
            <div class="navbar-title">Thêm thẻ ngân hàng</div>
            <div class="navbar-right"></div>
        </div>
        <form class="banks form-validate" action="tai-khoan/send-add-bank-account" autocomplete="off" absolute method="post" accept-charset="utf8" data-success="ACCOUNT_GUI.createUserBankDone">
            @csrf
            <input type="hidden" name="back_link" value="{{Support::generateBackLink()}}">
            <div class="box">
                <div class="c-row m-b-10 c-row-middle">
                    <div class="van-image" style="width: 40px; height: 40px;">
                        <img src="theme/frontend/images/pay_icon_debitcard_red.9a14c5bf.png" class="van-image__img" />
                    </div>
                    <div class="p-l-15">Thêm thẻ ngân hàng</div>
                </div>
                <div class="item">
                    <div class="lab">Chọn ngân hàng</div>
                    <div class="input">
                        <select name="bank_id" class="ipt" rules="required" m-required="Vui lòng chọn ngân hàng">
                            <option value="">Chọn ngân hàng</option>
                            @foreach ($listBanks as $itemBank)
                                <option value="{{Support::show($itemBank,'id')}}">{{Support::show($itemBank,'short_name')}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="item">
                    <div class="lab">Tên chủ tài khoản</div>
                    <div class="input">
                        <input type="text" name="account_holder" placeholder="Cần thiết điền" oninput="value=value.replace(/[^a-zA-Z\s+$]/g,'').toUpperCase()" class="ipt" rules="required" m-required="Vui lòng nhập Tên chủ tài khoản"/>
                    </div>
                </div>
                <div class="item">
                    <div class="lab">Số tài khoản</div>
                    <div class="input">
                        <input type="number" name="account_number" placeholder="Cần thiết điền" class="ipt" rules="required" m-required="Vui lòng nhập Số tài khoản"/>
                    </div>
                </div>
                <div class="item">
                    <div class="lab">Email</div>
                    <div class="input">
                        <input type="text" name="email" placeholder="Cần thiết điền" class="ipt" rules="required||email" m-required="Vui lòng nhập Email"/>
                    </div>
                </div>
                <div class="item">
                    <div class="lab">Số điện thoại</div>
                    <div class="input">
                        <input type="text" name="phone" placeholder="Cần thiết điền" class="ipt" rules="required||phone" m-required="Vui lòng nhập Số điện thoại"/>
                    </div>
                </div>
                <div class="item">
                    <div class="lab">Tỉnh/Thành phố</div>
                    <div class="input">
                        <input type="text" name="province" placeholder="Tỉnh" class="ipt"/>
                    </div>
                </div>
                <div class="item">
                    <div class="lab">Chi nhánh</div>
                    <div class="input">
                        <input type="text" name="account_branch" placeholder="Chi nhánh" class="ipt"/>
                    </div>
                </div>
            </div>
            <div class="c-row c-row-center m-t-20 bank-btn">
                <button type="submit" class="btn van-button van-button--default van-button--normal van-button--block van-button--round" style="color: rgb(255, 255, 255); background: rgb(92, 186, 71); border-color: rgb(92, 186, 71);">
                    <div class="van-button__content"><span class="van-button__text"> Thêm thẻ ngân hàng </span></div>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
@section('jsl')
    <script src="theme/frontend/js/ValidateForm.js" defer></script>
@endsection
@section('js')
    <script src="theme/frontend/js/auth.js" defer></script>
@endsection