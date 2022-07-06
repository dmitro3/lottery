<div class="van-overlay" style="z-index: 2031; display: none;"></div>
<div class="van-popup van-popup--round van-popup--bottom van-slide-up-enter-active"
    style="max-width: 10rem; left: auto; z-index: 2032; display: none;">
    <div class="betting-mark">
        <div class="head">
            <div class="box">
                <div class="con"></div>
                <div class="color">
                    Chọn 
                    <span class="p-l-10 choose">Nhỏ</span>
                </div>
            </div>
        </div>
        <div class="info">
            <div class="item c-row c-row-between">
                <div class="tit">Số tiền</div>
                <div class="c-row amount-box">
                    @foreach ($listGameWinMoneyItem as $key => $itemGameWinMoneyItem)
                        <div class="li{{$key == 0 ? ' active default':''}}" data-amount="{{Support::show($itemGameWinMoneyItem,'money')}}">{{Support::show($itemGameWinMoneyItem,'name')}}</div>
                    @endforeach
                </div>
            </div>
            <div class="item c-row c-row-between">
                <div class="tit">Số lượng</div>
                <div class="c-row c-row-between stepper-box">
                    <div class="li minus">-</div>
                    <div class="digit-box van-cell van-field">
                        <div class="van-cell__value van-cell__value--alone van-field__value">
                            <div class="van-field__body">
                                <input type="number" class="van-field__control" value="1" id="gowin-qty-input">
                            </div>
                        </div>
                    </div>
                    <div class="li plus active c-row c-row-middle-center">+</div>
                </div>
            </div>
            <div class="item c-row c-flew-end">
                <div class="c-row multiple-box">
                    @foreach ($listGameWinMultiple as $key => $itemGameWinMultiple)
                        <div class="li{{$key == 0 ? ' active default':''}}" data-multiple="{{$itemGameWinMultiple->multiple}}">{{$itemGameWinMultiple->name}}</div>
                    @endforeach
                </div>
            </div>
            <div class="item c-row c-row-middle">
                <div role="checkbox" tabindex="0" aria-checked="false" class="van-checkbox">
                    <div class="van-checkbox__icon van-checkbox__icon--square">
                        <i class="van-icon"></i>
                    </div>
                    <span class="van-checkbox__label">
                        <div class="agree p-r-15">Tôi đồng ý</div>
                    </span>
                </div>
                <span class="txt">Quy tắc bán trước</span>
            </div>
        </div>
        <div class="foot c-row">
            <div class="left"> Hủy </div>
            <div class="right">
                <span class="p-r-5">Tổng số tiền</span>
                <span id="betting-mark-total-money"></span>
            </div>
        </div>
    </div>
</div>