@extends('index')
@section('content')
<div id="app">
    <div class="mian forgot">
        <div class="navbar">
            <div class="navbar-left">
                <a href="{{Support::generateBackLink()}}" class="bank c-row c-row-middle-center"><img src="theme/frontend/images/back.c3244ab0.png" class="navbar-back">
                </a>
            </div>
            <div class="navbar-title">Đăng ký</div>
            <div class="navbar-right"></div>
        </div>
        <div class="forgot-box">
            <form class="mian-from m-t-20 form-validate" action="dang-ky" autocomplete="off" absolute method="post" accept-charset="utf8" data-before="REGISTER_GUI.validateRegister" data-success="REGISTER_GUI.registerDone">
                @csrf
                <div class="lab">Định dạng số điện thoại:<span>+84</span>
                </div>
                <div class="item c-row c-row-center c-row-middle m-t-15 m-b-30 first">
                    <div class="c-row number">
                        <span class="c-row c-row-middle-center">
                            <img height="22px" width="15px" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABkAAAAoCAYAAAF8yGH9AAAAAXNSR0IArs4c6QAAAERlWElmTU0AKgAAAAgAAYdpAAQAAAABAAAAGgAAAAAAA6ABAAMAAAABAAEAAKACAAQAAAABAAAAGaADAAQAAAABAAAAKAAAAADEsgZoAAACNklEQVRIDe1XPW8UMRCd8e4p5BLlByAhAVKUkipNAHGnJbk9UVOkS582okbU+QkUNCcKfsChIJSjSE+LKNJEaWiScB9I3Hoy48Qr38bL+iCiON1Klu2Z98b289cagL/BVuO1JCnDz1bSNIXrsrIVm98wxOKxfA3wBW3FUgLyKw6iBiKF0gmk7G6RSBidTvTQBQjpRudcwB+dE6NYOujlipgR9VvNV0hUd8MR4jBGgAUC+O462PYwJqLR8kGv4zr6W4290k78D0fpzOSNKxX3JNlu46iVPNWUJdZQlSuMPsdjAFGmzwLsVxFEFMHnXagiuP5ZJJmVCIC1QZqsu4P1lUnrmtgNCYEWQGcvLDBT+H7l4+G3i7S5FmnatnaeGuBFC3GMtWOe3GfWIbkAeQMDaIFMfoLHYbv5mDLanHT5axjhJxUKlhCCNWMpbip/fJYJYNUQiputjCCH09TLZk4ok9O1z4JKZi2F7DwzcJ1d7Tx317mK+MpeleTGkRRM8AGtrfSYt4BijqM0va/1r52i47bqSt15p8b0+8FtBfTFkfhm+sTJ50fQ9eML5LPJNcVnzbL4vDPoI/2Lbd7IVOrN5ZrLNZUCU4FnZ3XlB6QcZn/xUAuSLVguQjjDaPFtfaPxRnKpB7XAoHwkVYSllcUOfuj+gG5XoCf0st0Zno92q3jij7mVMT8BKz8JOGgnXwHVCersHtcfVZIYIPF5KgAu0udP+Fd5o/jMDAlShpEnqlJwVO8eHl0Ce/y85QnW5WMAAAAASUVORK5CYII=" class="mobile">
                        </span>
                        <div class="p-l-5">+84</div>
                    </div>
                    <input type="text" placeholder="Điện thoại" name="phone">
                </div>
                <div class="item c-row c-row-center c-row-middle m-b-30">
                    <span class="img c-row c-row-middle-center">
                        <img height="20px" width="18px" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB8AAAAgCAYAAAGdhZPXAAAAAXNSR0IArs4c6QAAAERlWElmTU0AKgAAAAgAAYdpAAQAAAABAAAAGgAAAAAAA6ABAAMAAAABAAEAAKACAAQAAAABAAAAH6ADAAQAAAABAAAAIAAAAABT9vqhAAAEjUlEQVRIDa1XW2hcRRief845SXN27TaSoCglihRsvYCgINWHvbR7M1ERo30TUYrQJ8XLg6Drg4KI4osgRQSfBKOQhrrbxCbxofjig1SlrZeHhqgIrdrNnt3tZvfM+P8nO+u57m5lD2T/2/fNP/OfMzN/GOs+Vjb5otJZPZss9YxaLpMiw8qmnifJ6Yce4PzMjoa/9eLhe3tGqCLn58coUM8ln3PGgIWF7QDSyqWfVk4rl3pZ6UCKZ14qglJwdoGpeSp/PZd+9j8dcxrj+qZykIwtr33UsyW7oaeTQvWo5zP3eZzKsHLJV5TuTqN8HumeNNTyySNcsNs9iK4RW/m65FRHBaniqmrkoxX2qk8OAKj5q+gBIOIsAd0PZ661xk6tfusOUo2cUrudpOMqXifJub4qwZbSlofIxkm/QbLvQyWQpZJ3asiQUoK7PGqQAJACUCoJBVASCyCV7pFWsXhj2MgeUIhBHOLq0m7tB2B/+jFWPvUCCLmb/JLDVvzU+nseDHKIG7oEAhIBNO1H+guQXSPpLj2gmpXVzwNOn0PtmFfRb/hig8w2vtY3Q78DefSoUd/49QgweQuWfiM2s+9TOH687R8xQLbymbtB2I9h4Lxt6N9rHfsufP8HmKafiFVOf+ceILB2Ipq7dr8LS0u1LvA87ox4o3qJTi0P2VP5RuHQ/RJY00V0+LhrLMmgvlVIPRCZGb/xKQ34H26A0jVgv4NgU8om6cnsDgyjA65nAtfTO1iGIRHGTEy/rRMRDL5ifrn2zbDExkPpg8Rzph1GtArpbD2Xeo2kf1CFj1wz2OIgbnDuSD+7a0eSTXPP+4TZ7sowfiQZFhevEGGyK6+J3AWHnyrdYGRmig86EB3y1tyc58vpDhwpFB6ac9lbRWv7qUhkRICPj30S2JIRWHa1kL6tI+Uj6pwLw+GmqtmGsZQ4+dUvYXG/b2Dy+sOHb2KtzjP4zWiC8b+0CX3RPLHiubFp0Mbs7M2ybT2Kt9g0Xm8C+K6PzUrlN39Ct903ea1QmOZ28xgRdF3/Yrx8+gc3OUxvFTIHOrb9BMWkbn4YL5cDN4Xi9f1aDNa6xwFytjlMYsKOV1bPSc4ukg7y6g6fjJCnb3LbBqcj45IHG7GQwZRLk7CDF9LhK79fesreLBZn2mJ7rybkHgIKsGc4vkPAS1QK/rOfHGVLJvbh5ZMA4JexfbhIOJvDFYOPbU6UyxuK5ySv5dPzXIg7HCewS5zBPwowKimYnHQ+RhyQLnW6m8FphzvtWbpj4ivr74wqWdQ42Cq+hFWJMd04qQtbXEcvHpsjdVtG8Rx/LZt8EvH7/SDsrs6Zy+uf+f1+28kjWUzl9cf72pjkAs7U9oDQxl7vJ49vCCPQNwzixJfXqT8+2yhkHpe2fad6f4N4YfG+Wy2MMErf/05OXyt2EG8N01FGTZjrAE4DCIxf8yvw//8SlcTtV3koL/VNY83q5WOSDgU8TJiEM9zQRr/P2/YknrcPSuz+gUF1IjH1Qe+Eq87nrjesThq3wF46ndyzHYWO50iVa3yzHdfXEgvLf9OY/wLsYqnMSA3n7AAAAABJRU5ErkJggg==" class="password">
                    </span>
                    <input placeholder="Mật khẩu" class="pw-input" type="password" name="password">
                </div>
                <div class="item c-row c-row-center c-row-middle">
                    <span class="img c-row c-row-middle-center">
                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAYCAYAAAGabn0pAAAAAXNSR0IArs4c6QAAAERlWElmTU0AKgAAAAgAAYdpAAQAAAABAAAAGgAAAAAAA6ABAAMAAAABAAEAAKACAAQAAAABAAAAHqADAAQAAAABAAAAGAAAAABFAcKlAAADeElEQVRIDa1WT2yMQRSf9/1ZVMpBJC3BhXBQNOlBxIU4C5EsUd1td3vgQOLkhERInIQL8afd3RZhUxJ1cBIObo34dxCpi6OkUqLSZme+ed4bO5Nv9+uudpns7Mz785s38+a99w1USsMPBWJaVJsXJ5jnWYkdoVIcQkvwCJawAk+NFg5YphmtBEulbTUCIljmjEA2+75egWmnMJ+QeYld1Sji6OjGGkaMCHjOmwjb2lep2Z9fEYXhpfrz4CZVQBgD/tFiJAC8QsTdVliDJAHJodZl5tCel/bR+2RRCxklqnfGFz4EbySovVJEjxWqN5FQg+w8ou8T/SzepVDj1rHmQGwplclflaXhQ+S6or9M3DS8bG5rs104MCsFEJxQQl6CdP4i03ROT7wspnjuWntXBD09kukasNTyg1OiCTlI0zAX58Xnza83rjnPvHUwQNlsO4Rg+zwLN2RFoDdrrcsmrqwW3XnBzpuNHKwcH85hRNwlQC9dV2fg4RmlgzaBaiyxiCeuEO8J82MJA6+NImIX9OXfkaM3UCyuSXSEHUaP/pxlELBeBN4+EenHLAwyAw9o4J5oNsccOOwfOM1BQXe7MqHdgOHALFcjBUWDOwq+KCytx8GeARc0DiyLQxVOO/YiZXW7nJ25I7/ow/Vgcugs8UxJcmD0vFNC6xu07WlIp2dI4Ui11+OFPbPbYrhOFE32r+7oTGg3YLQenrTgP4EbbGhBbOev0E9tgr6+zwtCtajEfpZRZZLhznD9WnivsEkp/EiRPZbK5vjS/mtLGFbFoQwZK0ipbQAcppCjMIO3Ifj7qOZ+o+/rAyqNidBrtDOKutkwm2uLyxOGg/78CCXHEtT6llUEEFME7LY0ewDL5UERRSssr+GIWIGjR6fq5QnDrOD7qbEg03vbKpORldU05xJuWjVvOHdaavMaht7eaV6NsvYR+nCZjEy0tHoTUMKwHBk+J1DspN5Np+yASByUpaEJeiRMUmW8ljo2MKGKxf0I+j7JlzdZ24josaTpjq8H2dzJuK4NIMcLM7kL9HAYR4EdzOR6Rr9OqmfH2ajhBeIXCX5QmZ77W6dP7AyC+O4MVCeJEzOfLG2h/6cB+OfplbELNJ4Vc3McleZOw2P9z2m+lnVbba5yeS28gxZr1H2QCRiQK8rktjR/obVwQbvYNRemTwXCNLL5Gyh7jhiLtBYeAAAAAElFTkSuQmCC" class="code">
                    </span>
                    <input type="text" placeholder="Mã giới thiệu" name="referral_code">
                </div>
                <div class="c-row c-row-middle">
                    <div role="checkbox" tabindex="0" aria-checked="false" class="van-checkbox" id="register-accept-privacy-policy">
                        <div class="van-checkbox__icon van-checkbox__icon--square">
                            <i class="van-icon"></i>
                        </div>
                        <span class="van-checkbox__label">
                            <div class="agree p-r-10">Tôi đồng ý</div>
                        </span>
                    </div>
                    <a href="chinh-sach-bao-mat{{Support::renderBackLinkParamater('dang-ky')}}" class="smooth txt" title="Chính sách bảo mật">Chính sách bảo mật</a>
                </div>
                <div class="mian-btn m-t-40">
                    <button type="submit" class="gradient van-button van-button--default van-button--normal van-button--block van-button--round" style="color: rgb(255, 255, 255); background: rgb(92, 186, 71); border-color: rgb(92, 186, 71);">
                        <div class="van-button__content">
                            <span class="van-button__text">
                            <span>Đăng ký</span></span>
                        </div>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('jsl')
    <script src="theme/frontend/js/ValidateForm.js" defer></script>
@endsection
@section('js')
    <script src="theme/frontend/js/auth.js" defer></script>
@endsection