@extends('index')
@section('css')
    <link rel="stylesheet" href="theme/frontend/css/guide.css">
@endsection
@section('content')
<div id="app">
    <div class="mian page">
        <div class="navbar">
            <div class="navbar-left"></div>
            <div class="navbar-title">TÔI </div>
            <div class="navbar-right">
                <a href="cham-soc-khach-hang{{Support::renderBackLinkParamater('tai-khoan')}}" class="c-row">
                    <img src="theme/frontend/images/audio.40994602.png" class="audio">
                </a>
            </div>
        </div>
        <div class="menu-box">
            <div class="info p-t-30 p-l-30 p-b-30 p-r-20">
                <div class="c-row c-row-between c-row-middle state-box c-pr">
                    <div class="c-row c-row-middle">
                        <div class="user-img">
                            <img src="theme/frontend/images/avatar.cfa8dd9d.svg" class="img">
                        </div>
                        <div class="p-l-10 infoName">
                            <div class="name mb3 c-row c-row-middle">{{Support::show($user,'name')}}</div>
                            <div class="id tag-read mb3">ID: {{Support::show($user,'id')}}</div>
                            <div class="number mb3"> Điện thoại: {{Support::show($user,'phone')}} </div>
                        </div>
                    </div>
                    <a href="tai-khoan/trang-ca-nhan{{Support::renderBackLinkParamater('tai-khoan')}}" class="profile">
                        <i class="van-icon van-icon-arrow" style="color: rgb(255, 255, 255); font-size: 20px;"></i>
                    </a>
                </div>
            </div>
            <div class="total-box">
                <div class="infoItem">
                    <div class="c-row c-row-middle"><img  width="45px"
                            height="45px" src="theme/frontend/images/icon_wallet.86908b64.png" class="walletImg">
                        <div class="p-l-15">
                            <div class="des u-m-b-15"> Số tiền </div>
                            <div class="c-row c-row-middle c-row-center p-t-5">
                                <div class="money">
                                    <div >
                                        <span  class="txt user-money-preview"> {{number_format($user->getAmount(),0,',','.')}} đ</span>
                                    </div>
                                </div>
                                <div class="profile-reload-user-money-btn" onclick="BASE_GUI.reloadUserMoney(this)">
                                    <img  width="20px" height="20px" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACIAAAAiCAYAAAFNQDtUAAAAAXNSR0IArs4c6QAAAERlWElmTU0AKgAAAAgAAYdpAAQAAAABAAAAGgAAAAAAA6ABAAMAAAABAAEAAKACAAQAAAABAAAAIqADAAQAAAABAAAAIgAAAAACeqFUAAAFEElEQVRYCbWYa2ibVRjH86aRpUSxkc2pqCA6wXvZ+sXpJl7q3FCcrAjGbeCnMi8xxfW2L36qbdLSlrJO0C/OjSkqU9HZVikyLxMvc471k58UhFmrqLQmhTaJv/+7nMObW5OG5cDJ85zn8n+e85zL+77x+XJtYGBgwfBFtL+/P1skdAWFmng8fou1lBLcu7yCXQheK3LFLWqtLIP/hB0YRqCFUX2FAnmCGXOdEonEo8a7FJWzP51Of1RKmScbGhpaC9pTzGFfnoKBScHxKhCechznhmw2e2tvb+/fVidrUO6wAg+CD8V7XoWXd5MFbpdX6OUJt8c7Ls0TIlNa4/ONjo6u9xMibyZe41Qq9btvcHAwZObsVYKc1Nh6IzgO2hOu0HHSPT09gTwDDdQw/ADDx8Uzi58gP9LXI9sO9dMlbwLgX/FqNkoulQWqfNkFVflfAm0F9GQgENi8vLx8ygXJAWwE4Ex512KNrQHMGyB/U2xSnURAAeY3SFrlj2IFrIaGhkiAuc0sLS3J1Nangp9Vk8VUJpO5z6020r+UFtPabC0qMNguMotmVimYF91UHWWW/mR3d7fd5QQJg3uUvoM+xyJcaeLkgRjhyMhI0+LiYpzxQ/RrAJyhHwT0sLHx0jwQjvBVnPfzMsApDZmkz9I3UTtzX71FFhFktlkQpvIihqM4TzBPpVzUOB93srnOKoDZ8jJyQXQl6cZBuQXlV0XeBQLqM49I2+M49GZ3dXIAz1cDILzc0QiSeYTe4mcaR6QAYFx0Fa3F2Oqi2E1aTxtBtZRsThtb9z4gi2NGsBpK8O+w1/65CI2aHKgVRhenrkXVpG9sbGxdLUDs6vOsbJ+7xMlksuR2rgRMAk44HD7ggjDQ/bmqRhk+xSHT3t6edEGo8p/swlS1KADcS+BWLrOr5SOQNpZ4HUBrAPqvEhCP72cB+BL7WGdn5x+ytwdQAyL8isH1GJyA7mFD2ecrzm3cYu+6To6zk8AfilfLA5GAJbubk/oFrLsRJfO0omtAuiIQj4NlOeXNLGUPGbaRYYNVrMBgq4v7Yy7yONP+dgVTV1U2EUqwk6Cv09fKEmDY7Am/33+Y0kx7y+UNwtqEsXkQm2eQ27sN/1+Q7+7q6vraa2/4okT0/gXISM4gCcB+1uFV41ALzW2KISbSqAmBEQHzbZ06Ym0LhUInbSI6jryqnMNIuy5F9q3lsq8lGfmwxFtYYp2VIH2OOCrzhYrLgF16G+QcQummyPYRyevRFIMKTUFbvfj+8fHxSxGckQF0sp5JKLCKQIyHYVUZ2/zz8/OvkMQlMmCt9lpNnZnGxsa9imnC+IPBYB+D/SRzUzQanTOKetNYLDbL0b6RZF6m317veFXjO2zUn6nGBrL6nLV7oGrPi2DInaNXoHvoY3p4bhAm9H5286pfLORbSyOWPpyUhDbwpPvYM0BcLkc56xvNuF6UJFqI9WYO/wgrMZGXiBRcOKdZrufqmESUJL4XPpV4h0eFe1Id1ukHZJsQHuM2PYTRNMu0BtkCsu1kW/FVVqCVGpPbis0nYIdkC/YOVcL42SveCERJ7iVIgu5WDCc5dOOoR0DVTS/uVDhB8G3Gicm+wKfFQTM2tGQiRsksLoc/BFDEyERJTJ8cM/Tf6PrsEI4+eK7FVv8J5C059u9zX+3T3YGuZFsxkUKP4eHhK/g+fAy53tGa6dcRpInxMvwsvF63zsJ/RuDpjo6Ofwoxyo3/B6WpYSCCoW6IAAAAAElFTkSuQmCC" class="img m-l-10">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="c-row c-row-between m-t-10 infoBtn">
                        <a href="tai-khoan/rut-tien{{Support::renderBackLinkParamater('tai-khoan')}}" class="item c-row c-row-center">
                            <div class="li"> RÚT TIỀN </div>
                        </a>
                        <a href="tai-khoan/nap-tien{{Support::renderBackLinkParamater('tai-khoan')}}" class="item c-row c-row-center">
                            <div class="li"> NẠP TIỀN </div>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="nav-muen c-row p-r-15 p-l-15">
                <div class="item c-tc">
                    <img  width="45px" height="45px" src="data:image/png;base64,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" class="img">
                    <div class="name"> LỊCH SỬ CƯỢC </div>
                </div>
                <div class="item c-tc">
                    <img  width="45px" height="45px" src="data:image/png;base64,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" class="img">
                    <div class="name"> LỊCH SỬ GIAO DỊCH </div>
                </div>
                <a href="tai-khoan/nhat-ky-dang-nhap{{Support::renderBackLinkParamater('tai-khoan')}}" class="item c-tc">
                    <img  width="45px" height="45px" src="data:image/png;base64,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" class="img">
                    <div class="name"> NHẬT KÝ ĐĂNG NHẬP </div>
                </a>
            </div>
            <div class="list">
                <div class="item c-row c-row-between">
                    <div class="c-row c-row-middle">
                        <img  width="24px" height="24px" src="data:image/png;base64,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" class="img">
                        <span  class="name">BẢO MẬT AN TOÀN</span>
                    </div>
                    <div class="c-row c-row-middle">
                        <i class="van-icon van-icon-arrow" style="color: rgb(84, 94, 104); font-size: 20px;"></i>
                    </div>
                </div>
                <div class="item c-row c-row-between">
                    <div class="c-row c-row-middle">
                        <img  width="24px" height="24px" src="data:image/png;base64,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" class="img">
                        <span  class="name">LÌ XÌ</span>
                    </div>
                    <div class="c-row c-row-middle">
                        <i class="van-icon van-icon-arrow" style="color: rgb(84, 94, 104); font-size: 20px;"></i>
                    </div>
                </div>
                <div class="item c-row c-row-between">
                    <div class="c-row c-row-middle">
                        <img width="24px" height="24px" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACgAAAAoCAYAAAH7+Yj7AAAAAXNSR0IArs4c6QAAAERlWElmTU0AKgAAAAgAAYdpAAQAAAABAAAAGgAAAAAAA6ABAAMAAAABAAEAAKACAAQAAAABAAAAKKADAAQAAAABAAAAKAAAAAB65masAAAH2UlEQVRYCeVYa2xcRxWeuXs3duzdzaMJEEMqKioeFUWqACWN19GuX20ERAnQSBUkQtA/DapIAFVIiChKhFpVEBK1gj/wo1ZfStIWRS0hfqyDvZtUSuBHkAKlCGjTOIY8CnvXju29u9PvjPeM596966wrfhRxJXvOnHPmzDczZ845s0I0+rzu9IWb/ZvvIHkx26kCenWMgDQ8BKYu1ikEGAF7Xk96ty0loSOqYmvYrlFS+/c73JFMsLZ05LcTq92B0jX/uJIimcrlO42OPTFgPs+DWKHYnd6uabV1a5KZYSXuawxe6cZvbUUp5IjdT40WZBAjTaHUS6xECkw33ZoRxb6uTlmp5uJS3l2WokNV1GidRax0kE3TDuDvDepPb8l8RD3wQIxlQvX3t1PH6+6sMNPLdu7QvGz6iuZhjwZYyK2XTT/FNLcOVrmNO6Z1Yi8amolSd3on09QWv5RZY/cDNPD8iBmlnp4PMk2tfbxCbcusnO7t3GgrEA2s8wsBbfaxJigroVyicWajyVyhm2j6AorzrIX/6gvpVd6MOCyU2Ii/Diifhxv+KjEy/syCVpCqM1g7pM0Jt+02OTg4FVRf6NH6cTsPJFfEV8lfn/43S4zBeZdQI8lcvpWFN+/PfLQ8W/67cOQAjvtYtaqOwshy21Vor/yKOGvzhF5ad+csG+IWKOam+vo6uE8t7b7X07XP5qktW1LY8LLhwXten+lJf9wwIohStmtvzdhdEWJzzPMnpcRE2RGE5C9RyjP3Ze6cmysfCiwrStHmBRzJFjRBe91dD+MC5epUyShdubCgmE2/QjK1P6NXZMvJWeEZh5lnTpkZdH+9axM+4s5kojX5CXnyZJFl3BIipao/l1IegVfsYf7/Rlu3ZBt2qafr66qqvgVn/hwu6QT+Xku2ij3y1fw7tp5NRxqEXxYQsDZhH0+JmHg8sco9P3vD74Dn9oL/M6XEMuE66dTQeME2RnTAIIUd7z/ld8DclxwtHAwrc59ibcmfvo7+GA6ln/nUGoN8um5rfH3bydNvsxLcYgihqpf6juv0JobGTdaBu1wAe9I2atIluYobE/faxuB7cBnVIx3nQUfKx6t+ddjr7foKTwZDnwG9mQIL87SjUraUSky2DedfY4G3pWutmqkmsXRexQvwv7dUpXocOswTFOa88lSJeRohjB0lJ2Zj1MZm48swaiGCgOeK+G9sHaIpZiJqz1HEor5GSOE8fCPacrnLkC8jJf7KavYfOPnfcd+0Uu71booj6O8ye2iEDQi6yzB2NTmaz4RV4kIMg7eB+E0ZpEiCZVVh7ANhY9RvaV99Bf65juimDMKRs0hve2lA1FeavvFZoP89yZoyiKiCYkH+K8qY5lXEDygbGjktiUKSYSyRoP2tGxLJrGnhRjxnO689mNKpvvs1plkyBUu7VLAHKaUelL6ikwx8uqBCbrZrTuPxpAkkF1EhrMJp6hMLjA51OB83TPSsT/kBiL4jpbM7mRv/BfO5pRxcmvFex2X4UHJNhyuPHcOBLXwBhAtsXQbmtLvYTNBwDx8evgPLfDkk+j/tNtzCRvuhQ6dQjwglu7jmbKTLfNp2IdW4EvLJpW79LQFSpildv/JTciSaEJNNIkwcSLQkng1HUAYUbrWjzZa+hni0j5xN28E1Sty27nthpwuPbQiQ8mmp6J8BsE8RqFhMbW8bLpiEEzY03b95vfIrn644zjJHyL8lhsf+GNbhPl2xSkW+TGBx3/+USLmb7Jqa9aiNBGiuHgFrdT9vp1V7MKVTlClPY2f0A8uW1YwrPHp/khopPBqWUZ8CS2XGP1cDGlnF1QFcKGkWr0RQf55E/r9fA4k5X00OjwfeaMX+zCdF2T8LnZU4gauJ5OqPyRMnvCig/DqB65yxoyDpmtBKHV0hU71FQWuRMqnYm04zOFh4KAyObKUGT/853uLeQzR2aG3Ju/59oqM+movmxElsClfpBiA9SCnwYbWnoiKqbTg1nM+78djtVKLh+BbSnKUE35X+nH+IWdJ1xpiOamlOmpsw2I9jAxCCb+qBqFSjDIR5bYNjlxr5JiZ4DH5cBcjtmPRKzG37sF1Phm2Zfm1ugwUCXXSRgq7H0VIZTf338k33pzdUfFEAshiuXzEmnGx7bvwPzdqiub1rZYOFxpkdhMEJYlCNT+1SP/WNTCuBw64BlxxI5QorlgKO5jNz17AQzwaoY5x+gJBkid/s5ep6DQ7jpFLnljhcq5u58ari8QagfmZRSqLXEUoMVmi2bR0aewPPjV14dhxM3B7/ZbPjWE/Pibnhsz5hYX4gDlKeBcCXoDSZiLfdudgvK2zgv9Hq1115+q86DUr5ZTtfBwDSZLo29at5pKDZmKMyi6U3GxwWN4DF7SQe3gj/TIzk18FGfXFsDwKt015VnoZ7tES9ac0R8zh69FLliP4Y/USEcHEh6pcM1uc2pvB0kuJNoJtCpbPvVuDIJtmmOWgumvOWD26ejNtawXAUq+ujHcUO/TgRbz/0Xo9+/iinvotF/JB2DDaHUCjsaFQoEI66I2Zw4VYffUU9AZCb9EC8YLFTo4gDJ2DlYhy/brWsdk2oot94EdDu0r+PS5VF8J1/yCLfiph8NGq3wnPqeaKYzfDoeT11U3yxKkQfPG093gEEaD6GIo6BNwHeJfjQUPty8cpiP8Q0M9/7VuddC/F0rHfj708AAAAASUVORK5CYII=" class="img">
                        <span  class="name">Hướng dẫn cho người mới bắt đầu</span>
                    </div>
                    <div class="c-row c-row-middle">
                        <i class="van-icon van-icon-arrow" style="color: rgb(84, 94, 104); font-size: 20px;"></i>
                    </div>
                </div>
                <div class="item c-row c-row-between">
                    <div class="c-row c-row-middle">
                        <img  width="24px" height="24px" src="data:image/png;base64,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" class="img">
                        <span  class="name">VỀ CHÚNG TÔI</span>
                    </div>
                    <div class="c-row c-row-middle">
                        <i class="van-icon van-icon-arrow" style="color: rgb(84, 94, 104); font-size: 20px;"></i>
                    </div>
                </div>
                <a href="cham-soc-khach-hang{{Support::renderBackLinkParamater('tai-khoan')}}" class="item c-row c-row-between">
                    <div class="c-row c-row-middle">
                        <img  width="24px" height="24px" src="data:image/png;base64,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" class="img">
                        <span  class="name">CSKH trực tuyến 24/7</span>
                    </div>
                    <div class="c-row c-row-middle">
                        <i class="van-icon van-icon-arrow" style="color: rgb(84, 94, 104); font-size: 20px;"></i>
                    </div>
                </a>
            </div>
        </div>
        <div class="logout-btn m-t-40">
            <div class="gradient">
                <a href="dang-xuat" class="van-button van-button--default van-button--normal van-button--block van-button--round"
                    style="color: rgb(255, 255, 255); background: rgb(242, 65, 59); border-color: rgb(242, 65, 59);">
                    <div class="van-button__content">
                        <span class="van-button__text">
                            <span >ĐĂNG XUẤT</span>
                        </span>
                    </div>
                </a>
            </div>
        </div>
        @include('static_blocks.shortcut_box',['activeTab' => 'account'])
    </div>
</div>
@endsection