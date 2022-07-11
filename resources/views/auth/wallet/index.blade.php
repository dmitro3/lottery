@extends('index')
@section('css')
    <link rel="stylesheet" href="theme/frontend/css/wallet.css">
@endsection
@section('content')
<div id="app">
    <div class="mian">
        <div class="navbar">
            <div class="navbar-left"></div>
            <div class="navbar-title"> Ví tiền </div>
            <div class="navbar-right">
                <a href="cham-soc-khach-hang{{Support::renderBackLinkParamater('tai-khoan/vi-cua-toi')}}" class="c-row">
                    <img src="theme/frontend/images/audio.40994602.png" class="audio">
                </a>
            </div>
        </div>
        <div class="wallet">
            <div class="wallet-user c-tc">
                <div class="c-row c-row-center img">
                    <div class="van-image" border-radius="60px" style="width: 60px; height: 60px;">
                        <img src="theme/frontend/images/avatar.cfa8dd9d.svg" class="van-image__img">
                    </div>
                </div>
                <div class="name">{{Support::show($user,'name')}}</div>
            </div>
            <div class="wallet-box">
                <div class="box">
                    <div class="icon1"></div>
                    <div class="title">Ví tiền</div>
                    <div class="balance m-t-10">
                        <div class="txt c-row c-row-middle">
                            <img width="22px" height="18px" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACYAAAAfCAYAAAH8T49dAAAAAXNSR0IArs4c6QAAAERlWElmTU0AKgAAAAgAAYdpAAQAAAABAAAAGgAAAAAAA6ABAAMAAAABAAEAAKACAAQAAAABAAAAJqADAAQAAAABAAAAHwAAAAAow/qsAAADL0lEQVRYCc1XT0gUURj/3rQKgpFIUZhpEFl4qlMSFB0qqEuXQKqDHrqIdKkuHaNLYd2iQ/dgoyJio7pIQZCCFUtRhKWFUkHluv0BXZyd1+8b941vZt7uzqyz5Qcf7/v7e9/7PyMIJKUc55ZJCNElWIBRcqsopQRu7duHXNUYyakXGJNZZQkoPjx2WMqrWsY1RqqONqnIQDsFvQO1T6vAUF/F4VMkZz94eWUDOcIZuxwt0IsiuqsQvTFrzmHUNsC6Gl2H5vSJ7iBMk+WLguJbEN2pFodtoRlmo/wySqmjD1l0SdWkdK+V43dI/vxYOciLhsDdDeoGk6zmaRLOjeAhcGi5DIn9sLVhelbpPgUWBUDPM8npJMHKr4+pa/rzmexHJ0vLInHADvvCYlfmnqTG1djKCyTt+eWB+bIDinGHBWIiq+4wVTQOwVYlx2mxRd5zvJqzVsg3wZ1srEJ5+AcA8CIYl0I1zTDOgG+AR4MBBn0NbM+RtxeAT3U/H92L4Lfgc7qjimzDnwZgD9o8QH9zPIOtBXeD+RqMS24OQPnqF4mtJgAziYFhSLvLXnfG8RbyZGeOGV2iobklVmUMZHWfcM+m1b4nBBoLjLOtzQddENG5PwQWa5jW9l6yH/SRaO0imQu/O3yxp9FFb6ibcob8BDkTGdwavNU0shrn+VnnzZcEzcSeM62WkMhgIyFrbYYRdWss+0Hh4+TdZ5i0JhTUXkNROcDwrbNEANsF/prESlTAWIDvzFKvVSQE95fAimj3VQmvyQ3cFvBEqZ97kUAQnNS2LfUbu3GQ8Q48CHa3RKLbP9IsmIO4mG3gq2Au8vhKKSxY7qVY92IwO5IuHZK4+uS3LMlfU/gkLVZPSzVtqGthzrPz5OBrnclav5NEWw/J7698PzKmKvHGWXUrTE4/9opKHblF1MAfRiX68YbsJ2eVZmzrtsfEuh34iFn8PXDGrhAVC4sFFGapmL1mLEY3qqs/3pOpI1SSpU1O9jrJyfv8klaK9PmwlE59C/N1F0vJ1W0pY5VhCFaFzRl8/9M0p5ZyC6p4DeavgpVAfb4isEEPgF+CbfC/pk/o8DTYXcW/a6P8fWg/ndcAAAAASUVORK5CYII=" class="m-r-5 img">
                             Số dư của tôi： 
                        </div>
                        <div class="c-row balanceMoney c-row-middle-center">
                            <div class="money user-money-preview">
                                <div> {{number_format($user->getAmount(),0,',','.')}} đ</div>
                            </div>
                            <div class="profile-reload-user-money-btn" onclick="BASE_GUI.reloadUserMoney(this)">
                                <div class="van-image img m-l-15" style="width: 25px; height: 25px;">
                                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACIAAAAiCAYAAAFNQDtUAAAAAXNSR0IArs4c6QAAAERlWElmTU0AKgAAAAgAAYdpAAQAAAABAAAAGgAAAAAAA6ABAAMAAAABAAEAAKACAAQAAAABAAAAIqADAAQAAAABAAAAIgAAAAACeqFUAAADrElEQVRYCbWX3YtNURjGZ1waZXyOCxJ3mnwrMcOdC0XEXPjM9SCUOxf+BlwQpURECYUZH3El0iiUKyUpJR8XaswQM7bfs85aq7X3WXvZ55zmreesdz3v877vPmuvvc86bW3Wsiz74fy6kWBWRxqiGGG+yCsVxJaGxHaIc3WpkIe8yjuwg37iHEhjbm5GMSHBdBAcccFNYbDom2TzUYwEc8XbwUy4DaCzvb39TBBvMwLIkBP5FHwC04oBJSwOSRFmzng9DIS+EXllGLE+sT0RukCh+lug/JRYl/k6nik4pj0fHcapD47mKEQ3JLQ2lguGEwS3nIrxJTgP7oBx4GxqmON9Gx32RMJBu97q12g0UkssT+RFQzYv04pdAM+iqgqkCqlIN5hfQR+VkLvT3Duc3BMRVUdI0u6DX67INxXC1ka0UQrtL/C5LgjpVv0vfl8oYD4N3AWyL2Es6iPqBGfBO/ATDIF9UXGRRDgHOBvD0SbTZnvlSMYrxTw/J3jYCgc8WXCIL7Ga+i1PYJMN9hbyolO0w0Bf8zIYMiIc2YFoRglZS6l96hZfkluiLaVJWak8mdsnu0rViUCtRO3FmvHuzL88E4lhiCLPmeffr6GgIZ9qxxpKCMTkdoEOtyazglhllwJ6PE64IqUbLFWRArLJrkgzt/gBBcZNE1Mry74y/kx1DWNoe23ebFdkuxxIfb+RUBzz0ey3BQ7H4ir0wQr09ObuP/M+G9OwJVrAkQj0M/BHyoiVvwZcgbKRYsvAVaB3TFX7jVC/mKvL6lbiKbAV6KY507rfBlqa3HKFBRWzGvc6ZmrsPZ89oTbpIz5i0mofIwz9yYQKQWpoU4zWSpqNtENpzDvANjDDl2Gix/ELkCmp+tX7KmmHmuuAXswy9fIrbjIhuoGWXnYvXa61KPV1RNWDmzMtzxSgjSWrP1S31rc0m146THjThZyyM61IUy/I0m6JAL20FdxdML9aIo6ChYm8CQnRcwE4DronpEFTRbmat0D2uKkCLSTR84npnGUntUdC291C3YZSabo3aLyxeCGKrWioYhNieqwKLuKiKREQodvQwa+Ra6HJoaDRNZ8L+cIGdAztATrry3Q8rXSU9cUSDrXWgx/A2caEvBZCqcd53GUwDoDcX+z/FkFAjg7u90BoB2O5yQMr2fqvehoUT8c6V70BH8FnoDo6Js0FuuBJILSbTPo5H0sbteSFFDO4sOlwm4Fu2TIwD3SCMaAm+gf2GjwEj2j8nbGS/QNGLMJl6LkecQAAAABJRU5ErkJggg==" class="van-image__img">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="c-row c-row-between total-btn m-t-30">
                        <a href="tai-khoan/rut-tien{{Support::renderBackLinkParamater('tai-khoan/vi-cua-toi')}}" class="item c-row c-row-center">
                            <div class="li"> RÚT TIỀN </div>
                        </a>
                        <a href="tai-khoan/nap-tien{{Support::renderBackLinkParamater('tai-khoan/vi-cua-toi')}}" class="item c-row c-row-center">
                            <div class="li"> NẠP TIỀN </div>
                        </a>
                    </div>
                </div>
                <div class="list m-t-15">
                    <a href="tai-khoan/lich-su-nap-tien{{Support::renderBackLinkParamater('tai-khoan/vi-cua-toi')}}" class="item c-row c-row-between">
                        <div class="c-row c-row-middle">
                            <img width="35px" height="35px" src="data:image/png;base64,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" class="chackImg">
                            <span class="name">Lịch sử nạp tiền</span>
                        </div>
                        <div>
                            <i class="van-icon van-icon-arrow" style="color: rgb(84, 94, 104); font-size: 16px;"></i>
                        </div>
                    </a>
                    <a href="tai-khoan/lich-su-rut-tien{{Support::renderBackLinkParamater('tai-khoan/vi-cua-toi')}}" class="item c-row c-row-between">
                        <div class="c-row c-row-middle">
                            <img width="35px" height="35px" src="data:image/png;base64,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" class="chackImg">
                            <span class="name">Lịch sử rút tiền</span>
                        </div>
                        <div>
                            <i class="van-icon van-icon-arrow" style="color: rgb(84, 94, 104); font-size: 16px;"></i>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        @include('static_blocks.shortcut_box',['activeTab' => 'wallet'])
    </div>
</div>
@endsection