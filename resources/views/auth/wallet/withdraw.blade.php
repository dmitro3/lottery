@extends('index')
@section('css')
    <link rel="stylesheet" href="theme/frontend/css/wallet.css">
    <link rel="stylesheet" href="theme/frontend/css/withdraw.css">
@endsection
@section('content')
<div id="app">
    <div class="mian">
        <div class="c-row navbar">
            <div class="navbar-left">
                <a href="{{Support::generateBackLink()}}" class="c-row c-row-middle-center">
                    <img src="theme/frontend/images/back.c3244ab0.png" class="navbar-back">
                </a>
            </div>
            <div class="navbar-title"> RÚT TIỀN</div>
            <div class="navbar-right"></div>
        </div>
        <div class="selectBox p-b-20">
            <div class="colorBox"></div>
            <div class="txtBox">
                <div class="c-row">
                    <div class="txt"> Số tiền </div>
                    <div class="c-row c-row-middle">
                        <div class="money">
                            <div class="user-money-preview">{{number_format((int)$user->getAmount(),0,',','.')}} đ</div>
                        </div>
                        <div class="van-image img m-l-15 profile-reload-user-money-btn" style="width: 26px; height: 26px;" onclick="BASE_GUI.reloadUserMoney(this)">
                            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACIAAAAiCAYAAAFNQDtUAAAAAXNSR0IArs4c6QAAAERlWElmTU0AKgAAAAgAAYdpAAQAAAABAAAAGgAAAAAAA6ABAAMAAAABAAEAAKACAAQAAAABAAAAIqADAAQAAAABAAAAIgAAAAACeqFUAAAFEElEQVRYCbWYa2ibVRjH86aRpUSxkc2pqCA6wXvZ+sXpJl7q3FCcrAjGbeCnMi8xxfW2L36qbdLSlrJO0C/OjSkqU9HZVikyLxMvc471k58UhFmrqLQmhTaJv/+7nMObW5OG5cDJ85zn8n+e85zL+77x+XJtYGBgwfBFtL+/P1skdAWFmng8fou1lBLcu7yCXQheK3LFLWqtLIP/hB0YRqCFUX2FAnmCGXOdEonEo8a7FJWzP51Of1RKmScbGhpaC9pTzGFfnoKBScHxKhCechznhmw2e2tvb+/fVidrUO6wAg+CD8V7XoWXd5MFbpdX6OUJt8c7Ls0TIlNa4/ONjo6u9xMibyZe41Qq9btvcHAwZObsVYKc1Nh6IzgO2hOu0HHSPT09gTwDDdQw/ADDx8Uzi58gP9LXI9sO9dMlbwLgX/FqNkoulQWqfNkFVflfAm0F9GQgENi8vLx8ygXJAWwE4Ex512KNrQHMGyB/U2xSnURAAeY3SFrlj2IFrIaGhkiAuc0sLS3J1Nangp9Vk8VUJpO5z6020r+UFtPabC0qMNguMotmVimYF91UHWWW/mR3d7fd5QQJg3uUvoM+xyJcaeLkgRjhyMhI0+LiYpzxQ/RrAJyhHwT0sLHx0jwQjvBVnPfzMsApDZmkz9I3UTtzX71FFhFktlkQpvIihqM4TzBPpVzUOB93srnOKoDZ8jJyQXQl6cZBuQXlV0XeBQLqM49I2+M49GZ3dXIAz1cDILzc0QiSeYTe4mcaR6QAYFx0Fa3F2Oqi2E1aTxtBtZRsThtb9z4gi2NGsBpK8O+w1/65CI2aHKgVRhenrkXVpG9sbGxdLUDs6vOsbJ+7xMlksuR2rgRMAk44HD7ggjDQ/bmqRhk+xSHT3t6edEGo8p/swlS1KADcS+BWLrOr5SOQNpZ4HUBrAPqvEhCP72cB+BL7WGdn5x+ytwdQAyL8isH1GJyA7mFD2ecrzm3cYu+6To6zk8AfilfLA5GAJbubk/oFrLsRJfO0omtAuiIQj4NlOeXNLGUPGbaRYYNVrMBgq4v7Yy7yONP+dgVTV1U2EUqwk6Cv09fKEmDY7Am/33+Y0kx7y+UNwtqEsXkQm2eQ27sN/1+Q7+7q6vraa2/4okT0/gXISM4gCcB+1uFV41ALzW2KISbSqAmBEQHzbZ06Ym0LhUInbSI6jryqnMNIuy5F9q3lsq8lGfmwxFtYYp2VIH2OOCrzhYrLgF16G+QcQummyPYRyevRFIMKTUFbvfj+8fHxSxGckQF0sp5JKLCKQIyHYVUZ2/zz8/OvkMQlMmCt9lpNnZnGxsa9imnC+IPBYB+D/SRzUzQanTOKetNYLDbL0b6RZF6m317veFXjO2zUn6nGBrL6nLV7oGrPi2DInaNXoHvoY3p4bhAm9H5286pfLORbSyOWPpyUhDbwpPvYM0BcLkc56xvNuF6UJFqI9WYO/wgrMZGXiBRcOKdZrufqmESUJL4XPpV4h0eFe1Id1ukHZJsQHuM2PYTRNMu0BtkCsu1kW/FVVqCVGpPbis0nYIdkC/YOVcL42SveCERJ7iVIgu5WDCc5dOOoR0DVTS/uVDhB8G3Gicm+wKfFQTM2tGQiRsksLoc/BFDEyERJTJ8cM/Tf6PrsEI4+eK7FVv8J5C059u9zX+3T3YGuZFsxkUKP4eHhK/g+fAy53tGa6dcRpInxMvwsvF63zsJ/RuDpjo6Ofwoxyo3/B6WpYSCCoW6IAAAAAElFTkSuQmCC" class="van-image__img">
                        </div>
                    </div>
                </div>
                <div class="icon"></div>
            </div>
            <div class="tab m-t-10">
                <div class="box">
                    <ul class="c-row c-flex-warp">
                        <li class="item action">
                            <div class="icon c-row c-row-middle-center">
                                <i class="size van-icon van-icon-pending-payment"></i>
                            </div>
                            <div class="c-tc">BankCard</div>
                            <div class="icons">
                                <i class="van-icon van-icon-success" style="color: rgb(255, 255, 255); font-size: 14px;"></i>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <form class="form-validate" action="tai-khoan/send-withdraw-request" autocomplete="off" absolute method="post" accept-charset="utf8" data-success="WITHDRAW_GUI.sendWithdrawDone">
                @csrf
                <div class="number-box c-row">
                    <div class="symbol c-row c-row-middle">₫</div>
                    <div class="input c-row c-row-middle van-cell van-field">
                        <div class="van-cell__value van-cell__value--alone van-field__value">
                            <div class="van-field__body">
                                <input type="number" placeholder="Vui lòng nhập số tiền rút" name="amount" class="van-field__control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="conBox m-t-5">
                    <div class="des">Phương thức thanh toán</div>
                    <div class="box m-b-10">
                        <div>
                            <div class="list">
                                @if (isset($userBank))
                                    <div class="item c-row c-row-between c-row-middle-center">
                                        <div class="name">
                                            <div class="van-ellipsis">
                                                <p class="van-ellipsis">{{Support::show($userBank->bank,'short_name')}}</p>
                                                <p class="van-ellipsis">{{Support::show($userBank,'account_holder')}}</p>
                                                <p class="van-ellipsis">{{Support::show($userBank,'account_number')}}</p>
                                            </div>
                                        </div>
                                        <div class="icon action c-row c-row-middle-center">
                                            <i class="van-icon van-icon-success" style="color: rgb(251, 78, 78); font-size: 16px;"></i>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="c-row c-row-center">
                                <a href="tai-khoan/them-tai-khoan-ngan-hang{{Support::renderBackLinkParamater(trim(str_replace(url()->to('/'), '',request()->fullUrl()),'/'))}}" class="add c-row c-row-middle-center m-t-10 m-b-10">
                                    <span class="plus c-row c-row-middle-center">
                                        <i class="van-icon van-icon-plus" style="color: rgb(245, 98, 93); font-size: 14px;"></i>
                                    </span>
                                    Thêm vào BankCard 
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="requiredBox m-t-20">
                    <div class="box c-row c-row-between c-row-middle p-l-10">
                        <img height="13px" width="25px" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACgAAAAUCAYAAAGIQU8tAAAAAXNSR0IArs4c6QAAAERlWElmTU0AKgAAAAgAAYdpAAQAAAABAAAAGgAAAAAAA6ABAAMAAAABAAEAAKACAAQAAAABAAAAKKADAAQAAAABAAAAFAAAAAAeNzMrAAAEHUlEQVRIDa2WX4hUVRzHz7lz143VhnRzIciKhp25az70UKKioJTYS3+ohyiih0whohI1DP+9iOCfIFSUEIoohB4Seuilh31JiHzwrZo7M6tusi5jsbhZkbI79/j5nZ1zPXvn7h9kD+ye35/v7+/5nXNHKVatWt0ru1s6juM9URQdrcXx70apU6LQ8q8ex/uNMSsRvhENDFiZGhoaWiVKt6akcLh5zwlVXK0a/I04Qb1ef9LSohDirzh+0NEOlO5DcbwpZSDw1BLeN0g9jo6O9pDpUd+gg6bopsvc95IFalGmtaIl9N8k/EkGODYtF1ES4VfZG43GGtldlLAQhquE0UGw3STJ2YrrpKC8lTaSkH/S9uWezpKVKAq11rYTWV0uTyrdEpl9ZRZAgEB09Wr1g6xuJl7XarVPKWGX3yAfTObf4vh1XzYnLVlgeDkLZJ7eEt3w8PAjTteuxjbYl7lhCEUo2clQAB6DXeaAhUJhS39/f9pnkXMoO5H94jB213pPuVy+YvW+ohHHL9H95wKlLpej6KSvmy9to9PHDfTxpw4jrU9yEz/qkM8mGBkZ6ZW+8HfJx9G/L0ROsHd9+Zw0Rv9wILfzgMgviNM83UwyOZQlSuvn8wAM9QZxOO31yAO2ZZVK5aw9ZW7C1VlwShlzZlZ9W9mo1RbZyyr9yjPg2Vjhl8xb85nPiw2253xZQLkHyeAdmv9w1unkxMQ1ss/tbxbr+JCxOETzdzI2PJ3xzzj4nKv2DEE+FFC5UlnswPPZmWGlaP7SdqbrcPy1OGNAL8oNYiXO0ZJicV9QKLzoeNm7u7vfLyi1ycmmXSsR8uosT5LkAE63kekDDpjZL+FkX//AwI8Z+YKzaYKcyXqqHSTCIolCpXfYvoEYLBhzY1KpIvyzGLxN4isEY5fWX3IMWx270LtNkLM9Tsd2i3MEF3ln1pMgOc28mMiPE2OOCQLsOEf1OI/arZkt7k8TNKrVLS45Ip3gU7ZmruQkFEUcl8+g0HT0oWRy8juhF3qFRusXiOD8nnDEfHY69hvdP4/9a3jY7N/n+djPheFTsy3kSjU9YAV69lfMA1vSmCdkp+uGRI9QcHpLGZfNdHe11QfBV9DXhc4ubcwrFPiUyLE5jY9x/I319PScQ2e6eGduoFuKMCHSRt7cC1kneTx232P/stVpfZjLst/HycvJnO4QGeOwtuPD2wbLa0pxbwrLLJfcx9jyJDWxrLf3MZgGwQL5jkrC/AR4VQDZ1Ww2F/Pb7BQYYk8lR9W7s8ll7e6Xtx+nvr6+f3FQ5qmJqOQHApdMq3WemerwO37z5pSMuZXj4LLsoMj8G2/MFQGjb3V1df3R4eyewOJg/ysWi3Ka6SJG/iLJkEd7o2q1nk60fpRZ+J/ZuEagwVKpVM+3WnjpXclrEAsBIakhAAAAAElFTkSuQmCC">
                        <input type="password" autocomplete="off" name="password" placeholder="Mật khẩu" class="pw-input input">
                    </div>
                </div>
                <div class="c-row c-row-center m-t-30 p-b-30 withdrawal-btn">
                    <button type="submit" class="btn van-button van-button--default van-button--normal van-button--block van-button--round" style="color: rgb(255, 255, 255); background: rgb(242, 65, 59); border-color: rgb(242, 65, 59);">
                        <div class="van-button__content">
                            <span class="van-button__text"> RÚT TIỀN </span>
                        </div>
                    </button>
                </div>
            </form>
            <div class="bankBox m-b-15 m-t-5">
                <div class="box">
                    <div class="item c-row c-row-middle">
                        <div class="m-r-10 van-image" style="width: 30px; height: 30px;">
                            <img src="data:image/png;base64,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" class="van-image__img">
                        </div>
                        <div>1. Lệ phí {[fee_withdraw]}%</div>
                    </div>
                    <div class="item c-row c-row-middle">
                        <div class="m-r-10 van-image" style="width: 30px; height: 30px;">
                            <img src="data:image/png;base64,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" class="van-image__img">
                        </div>
                        <div>2. Phạm vi số tiền rút <br> {{number_format(SettingHelper::getSetting('min_withdraw_money',50000),0,',','.')}} đ - {{number_format(SettingHelper::getSetting('max_withdraw_money',1000000000),0,',','.')}} đ</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('jsl')
    <script src="theme/frontend/js/ValidateForm.js" defer></script>
@endsection
@section('js')
    <script src="theme/frontend/js/withdraw.js" defer></script>
@endsection