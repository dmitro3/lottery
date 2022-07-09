@extends('index')
@section('content')
<div id="app">
    <div class="mian login">
        <div class="login-banner">
            <div class="bankPage c-row c-row-middle-center">
                <a href="/" class="bank c-row c-row-middle-center">
                    <img src="theme/frontend/images/back.c3244ab0.png" class="navbar-back">
                </a>
            </div>
            <img src="{Ilogo.imgI}" class="logo">
        </div>
        <div class="login-box">
            <div class="tit"> Đăng nhập </div>
            <div class="mian-from">
                <div class="lab"> Định dạng số điện thoại:<span>+84</span>
                </div>
                <div class="item c-row c-row-center first">
                    <div class="c-row number">
                        <span class="c-row c-row-middle-center">
                            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABkAAAAoCAYAAAF8yGH9AAAAAXNSR0IArs4c6QAAAERlWElmTU0AKgAAAAgAAYdpAAQAAAABAAAAGgAAAAAAA6ABAAMAAAABAAEAAKACAAQAAAABAAAAGaADAAQAAAABAAAAKAAAAADEsgZoAAACNklEQVRIDe1XPW8UMRCd8e4p5BLlByAhAVKUkipNAHGnJbk9UVOkS582okbU+QkUNCcKfsChIJSjSE+LKNJEaWiScB9I3Hoy48Qr38bL+iCiON1Klu2Z98b289cagL/BVuO1JCnDz1bSNIXrsrIVm98wxOKxfA3wBW3FUgLyKw6iBiKF0gmk7G6RSBidTvTQBQjpRudcwB+dE6NYOujlipgR9VvNV0hUd8MR4jBGgAUC+O462PYwJqLR8kGv4zr6W4290k78D0fpzOSNKxX3JNlu46iVPNWUJdZQlSuMPsdjAFGmzwLsVxFEFMHnXagiuP5ZJJmVCIC1QZqsu4P1lUnrmtgNCYEWQGcvLDBT+H7l4+G3i7S5FmnatnaeGuBFC3GMtWOe3GfWIbkAeQMDaIFMfoLHYbv5mDLanHT5axjhJxUKlhCCNWMpbip/fJYJYNUQiputjCCH09TLZk4ok9O1z4JKZi2F7DwzcJ1d7Tx317mK+MpeleTGkRRM8AGtrfSYt4BijqM0va/1r52i47bqSt15p8b0+8FtBfTFkfhm+sTJ50fQ9eML5LPJNcVnzbL4vDPoI/2Lbd7IVOrN5ZrLNZUCU4FnZ3XlB6QcZn/xUAuSLVguQjjDaPFtfaPxRnKpB7XAoHwkVYSllcUOfuj+gG5XoCf0st0Zno92q3jij7mVMT8BKz8JOGgnXwHVCersHtcfVZIYIPF5KgAu0udP+Fd5o/jMDAlShpEnqlJwVO8eHl0Ce/y85QnW5WMAAAAASUVORK5CYII=" class="mobile">
                        </span>
                    <div class="p-l-5">+84</div>
                    </div>
                    <input type="text" name="phone" placeholder="Điện thoại">
                </div>
                <div class="item c-row c-row-center">
                    <span class="img c-row c-row-middle-center">
                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB8AAAAgCAYAAAGdhZPXAAAAAXNSR0IArs4c6QAAAERlWElmTU0AKgAAAAgAAYdpAAQAAAABAAAAGgAAAAAAA6ABAAMAAAABAAEAAKACAAQAAAABAAAAH6ADAAQAAAABAAAAIAAAAABT9vqhAAAEjUlEQVRIDa1XW2hcRRief845SXN27TaSoCglihRsvYCgINWHvbR7M1ERo30TUYrQJ8XLg6Drg4KI4osgRQSfBKOQhrrbxCbxofjig1SlrZeHhqgIrdrNnt3tZvfM+P8nO+u57m5lD2T/2/fNP/OfMzN/GOs+Vjb5otJZPZss9YxaLpMiw8qmnifJ6Yce4PzMjoa/9eLhe3tGqCLn58coUM8ln3PGgIWF7QDSyqWfVk4rl3pZ6UCKZ14qglJwdoGpeSp/PZd+9j8dcxrj+qZykIwtr33UsyW7oaeTQvWo5zP3eZzKsHLJV5TuTqN8HumeNNTyySNcsNs9iK4RW/m65FRHBaniqmrkoxX2qk8OAKj5q+gBIOIsAd0PZ661xk6tfusOUo2cUrudpOMqXifJub4qwZbSlofIxkm/QbLvQyWQpZJ3asiQUoK7PGqQAJACUCoJBVASCyCV7pFWsXhj2MgeUIhBHOLq0m7tB2B/+jFWPvUCCLmb/JLDVvzU+nseDHKIG7oEAhIBNO1H+guQXSPpLj2gmpXVzwNOn0PtmFfRb/hig8w2vtY3Q78DefSoUd/49QgweQuWfiM2s+9TOH687R8xQLbymbtB2I9h4Lxt6N9rHfsufP8HmKafiFVOf+ceILB2Ipq7dr8LS0u1LvA87ox4o3qJTi0P2VP5RuHQ/RJY00V0+LhrLMmgvlVIPRCZGb/xKQ34H26A0jVgv4NgU8om6cnsDgyjA65nAtfTO1iGIRHGTEy/rRMRDL5ifrn2zbDExkPpg8Rzph1GtArpbD2Xeo2kf1CFj1wz2OIgbnDuSD+7a0eSTXPP+4TZ7sowfiQZFhevEGGyK6+J3AWHnyrdYGRmig86EB3y1tyc58vpDhwpFB6ac9lbRWv7qUhkRICPj30S2JIRWHa1kL6tI+Uj6pwLw+GmqtmGsZQ4+dUvYXG/b2Dy+sOHb2KtzjP4zWiC8b+0CX3RPLHiubFp0Mbs7M2ybT2Kt9g0Xm8C+K6PzUrlN39Ct903ea1QmOZ28xgRdF3/Yrx8+gc3OUxvFTIHOrb9BMWkbn4YL5cDN4Xi9f1aDNa6xwFytjlMYsKOV1bPSc4ukg7y6g6fjJCnb3LbBqcj45IHG7GQwZRLk7CDF9LhK79fesreLBZn2mJ7rybkHgIKsGc4vkPAS1QK/rOfHGVLJvbh5ZMA4JexfbhIOJvDFYOPbU6UyxuK5ySv5dPzXIg7HCewS5zBPwowKimYnHQ+RhyQLnW6m8FphzvtWbpj4ivr74wqWdQ42Cq+hFWJMd04qQtbXEcvHpsjdVtG8Rx/LZt8EvH7/SDsrs6Zy+uf+f1+28kjWUzl9cf72pjkAs7U9oDQxl7vJ49vCCPQNwzixJfXqT8+2yhkHpe2fad6f4N4YfG+Wy2MMErf/05OXyt2EG8N01FGTZjrAE4DCIxf8yvw//8SlcTtV3koL/VNY83q5WOSDgU8TJiEM9zQRr/P2/YknrcPSuz+gUF1IjH1Qe+Eq87nrjesThq3wF46ndyzHYWO50iVa3yzHdfXEgvLf9OY/wLsYqnMSA3n7AAAAABJRU5ErkJggg==" class="password">
                    </span>
                    <input type="password" name="password" placeholder="Mật khẩu" class="pw-input">
                </div>
                <div class="mian-btn">
                    <button class="gradient van-button van-button--default van-button--normal van-button--block van-button--round" style="color: rgb(255, 255, 255); background: rgb(92, 186, 71); border-color: rgb(92, 186, 71);">
                        <div class="van-button__content">
                            <span class="van-button__text">
                                <span>Đăng nhập</span>
                            </span>
                        </div>
                    </button>
                    <div class="text m-t-15 c-row c-row-middle-center">
                        <a href="dang-ky" class="text p-r-5">Đăng ký</a>
                        ｜
                        <a href="quen-mat-khau" class="text p-l-5">Lấy lại mật khẩu</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection