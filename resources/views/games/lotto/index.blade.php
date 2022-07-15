@php
use \realtimemodule\pushserver\Helpers\PushServerHelper;
@endphp
@extends('index')
@section('css')
<link href="theme/frontend/lotto/css/style.css" rel="stylesheet">
<script type="text/javascript">
    var connectionGameType = '{{PushServerHelper::generateHash(2)}}';
</script>
@endsection
@section('content')
<div id="app">
    <div class="mian game">
        @include('games.base_game_bar',['gameName'=>'lotto'])
        <div class="game-betting">
            <div class="content">
                <div class="time-box c-row c-row-between m-b-10" id="game-lotto-time-box">
                    <div class="info" style="display: flex;align-items:center">
                        <div class="number">2022071411425</div>
                    </div>
                    <div class="out">
                        <div class="txt"> Thời gian còn lại để mua </div>
                        <div class="number c-row c-row-middle c-flew-end">
                            <div class="item">0</div>
                            <div class="item">0</div>
                            <div class="item c-row c-row-middle">:</div>
                            <div class="item">1</div>
                            <div class="item">9</div>
                        </div>
                    </div>
                </div>

                <section class="result_plot_threads">
                    <div class="plot_totay">
                        <div class="container">
                            <table class="table table-condensed kqcenter kqvertimarginw table-kq-border table-kq-hover-div table-bordered kqbackground table-kq-bold-border tb-phoi-border watermark table-striped" id="result_tab_mb">
                                <thead>
                                    <tr class="title_row">
                                        <td class="color333" colspan="2">
                                            <div class="col-sm-10">
                                                <h2 class="martop10 col-sm-8 chu16 kqcenter viethoa dosam vietdam">Xổ số Truyền
                                                    Thống
                                                </h2>
                                            </div>
                                            <div class="col-sm-10">
                                                <span class=" chu15" id="result_date">Thứ tư ngày 13-07-2022</span>
                                            </div>
                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="hover" style="width:18%;vertical-align:middle;font-size:14px;color:red;">Đặc biệt
                                        </td>
                                        <td style="padding: 0;">
                                            <div class="row-no-gutters text-center">
                                                <div style="width:100%; position: relative; float: left;" class="phoi-size db chu16 gray need_blank vietdam phoi-size chu30 maudo stop-reload hover">
                                                    95155
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="hover" style="width:18%;vertical-align:middle;font-size:14px;">Giải nhất</td>
                                        <td style="padding: 0;">
                                            <div class="row-no-gutters text-center">
                                                <div style="width:100%; position: relative; float: left;" class="phoi-size chu16 gray need_blank vietdam hover"> 90271</div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="hover" style="width:18%;vertical-align:middle;font-size:14px;">Giải nhì</td>
                                        <td style="padding: 0;">
                                            <div class="row-no-gutters text-center">
                                                <div style="width:50%; position: relative; float: left;" class="phoi-size chu16 gray need_blank vietdam border-right hover">89067</div>
                                                <div style="width:50%; position: relative; float: left;" class="phoi-size chu16 gray need_blank vietdam hover"> 33855</div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="hover" style="width:18%;vertical-align:middle;font-size:14px;">Giải ba</td>
                                        <td style="padding: 0;">
                                            <div class="row-no-gutters text-center">
                                                <div style="width:33.333333333333%; position: relative; float: left;" class="phoi-size chu16 gray need_blank vietdam border-bottom border-right hover">
                                                    32526
                                                </div>
                                                <div style="width:33.333333333333%; position: relative; float: left;" class="phoi-size chu16 gray need_blank vietdam border-bottom border-right hover">
                                                    01514
                                                </div>
                                                <div style="width:33.333333333333%; position: relative; float: left;" class="phoi-size chu16 gray need_blank vietdam border-bottom hover">13957</div>
                                                <div style="width:33.333333333333%; position: relative; float: left;" class="phoi-size chu16 gray need_blank vietdam border-right hover">62866</div>
                                                <div style="width:33.333333333333%; position: relative; float: left;" class="phoi-size chu16 gray need_blank vietdam border-right hover">63028</div>
                                                <div style="width:33.333333333333%; position: relative; float: left;" class="phoi-size chu16 gray need_blank vietdam hover"> 85948</div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="hover" style="width:18%;vertical-align:middle;font-size:14px;">Giải tư</td>
                                        <td style="padding: 0;">
                                            <div class="row-no-gutters text-center">
                                                <div style="width:25%; position: relative; float: left;" class="phoi-size chu16 gray need_blank vietdam border-right hover"> 0241</div>
                                                <div style="width:25%; position: relative; float: left;" class="phoi-size chu16 gray need_blank vietdam border-right hover"> 4057</div>
                                                <div style="width:25%; position: relative; float: left;" class="phoi-size chu16 gray need_blank vietdam border-right hover"> 2119</div>
                                                <div style="width:25%; position: relative; float: left;" class="phoi-size chu16 gray need_blank vietdam hover"> 1635</div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="hover" style="width:18%;vertical-align:middle;font-size:14px;">Giải năm</td>
                                        <td style="padding: 0;">
                                            <div class="row-no-gutters text-center">
                                                <div style="width:33.333333333333%; position: relative; float: left;" class="phoi-size chu16 gray need_blank vietdam border-bottom border-right hover">
                                                    6060
                                                </div>
                                                <div style="width:33.333333333333%; position: relative; float: left;" class="phoi-size chu16 gray need_blank vietdam border-bottom border-right hover">
                                                    9175
                                                </div>
                                                <div style="width:33.333333333333%; position: relative; float: left;" class="phoi-size chu16 gray need_blank vietdam border-bottom hover"> 6784</div>
                                                <div style="width:33.333333333333%; position: relative; float: left;" class="phoi-size chu16 gray need_blank vietdam border-right hover"> 6809</div>
                                                <div style="width:33.333333333333%; position: relative; float: left;" class="phoi-size chu16 gray need_blank vietdam border-right hover"> 2507</div>
                                                <div style="width:33.333333333333%; position: relative; float: left;" class="phoi-size chu16 gray need_blank vietdam hover"> 5397</div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="hover" style="width:18%;vertical-align:middle;font-size:14px;">Giải sáu</td>
                                        <td style="padding: 0;">
                                            <div class="row-no-gutters text-center">
                                                <div style="width:33.333333333333%; position: relative; float: left;" class="phoi-size chu16 gray need_blank vietdam border-right hover"> 893</div>
                                                <div style="width:33.333333333333%; position: relative; float: left;" class="phoi-size chu16 gray need_blank vietdam border-right hover"> 538</div>
                                                <div style="width:33.333333333333%; position: relative; float: left;" class="phoi-size chu16 gray need_blank vietdam hover"> 009</div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="hover" style="width:18%;vertical-align:middle;font-size:14px;">Giải bảy</td>
                                        <td style="padding: 0;">
                                            <div class="row-no-gutters text-center">
                                                <div style="width:25%; position: relative; float: left;" class="phoi-size chu16 gray need_blank vietdam border-right hover"> 80</div>
                                                <div style="width:25%; position: relative; float: left;" class="phoi-size chu16 gray need_blank vietdam border-right hover"> 20</div>
                                                <div style="width:25%; position: relative; float: left;" class="phoi-size chu16 gray need_blank vietdam border-right hover"> 26</div>
                                                <div style="width:25%; position: relative; float: left;" class="phoi-size chu16 gray need_blank vietdam hover">10 </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="container">
                        <div class="box box_choose">
                            <div class="game_types navv">
                                <label for="type-1" class="item_type_game nav-item" data-number="2" data-state="true" id="lb-type-1" data-target="#game-type-1">
                                    <input type="radio" id="type-1" checked value="1" name="type">
                                    <span class="name">Đánh lô</span>
                                </label>
                                <label for="type-2" class="item_type_game nav-item" data-number="3" data-state="false" id="lb-type-2" data-target="#game-type-2">
                                    <input type="radio" id="type-2" value="2" name="type">
                                    <span class="name">3 càng</span>
                                </label>
                                <label for="type-3" class="item_type_game nav-item" data-number="4" data-state="false" id="lb-type-3" data-target="#game-type-3">
                                    <input type="radio" id="type-3" value="3" name="type">
                                    <span class="name">4 càng</span>
                                </label>
                                <label for="type-4" class="item_type_game nav-item" data-number="2" data-state="false" id="lb-type-4" data-target="#game-type-4">
                                    <input type="radio" id="type-4" value="4" name="type">
                                    <span class="name">Đánh đề</span>
                                </label>
                                <label for="type-5" class="item_type_game nav-item" data-number="1" data-state="false" id="lb-type-5" data-target="#game-type-5">
                                    <input type="radio" id="type-5" value="5" name="type">
                                    <span class="name">Đầu đuôi</span>
                                </label>
                                <label for="type-6" class="item_type_game nav-item" data-number="2" data-state="false" id="lb-type-6" data-target="#game-type-6">
                                    <input type="radio" id="type-6" value="6" name="type">
                                    <span class="name">Lô xiên</span>
                                </label>
                            </div>
                            <div class="tab_panel">
                                <div class="panel" data-state="show" id="game-type-1">
                                    <div class="navv types">
                                        <button type="button" class="type type_js nav-item" data-state="true" id="lo2so" data-target="#panel-lo2so" data-max="2">LÔ 2 SỐ</button>
                                        <button type="button" class="type type_js nav-item" data-state="false" id="lo3so" data-target="#panel-lo3so" data-max="3">LÔ 3 SỐ</button>
                                    </div>
                                    <div class="tab_panel">
                                        <div class="panel" data-state="show" id="panel-lo2so">
                                            <span class="question">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C21.9939 17.5203 17.5203 21.9939 12 22ZM11 17V19H13V17H11ZM12 7C13.1046 7 14 7.89543 14 9C14.0035 9.53073 13.7904 10.0399 13.41 10.41L12.17 11.67C11.4214 12.4217 11.0008 13.4391 11 14.5V15H13C12.9223 13.925 13.3559 12.8763 14.17 12.17L15.07 11.25C15.6681 10.6543 16.003 9.84411 16 9C16 6.79086 14.2091 5 12 5C9.79086 5 8 6.79086 8 9H10C10 7.89543 10.8954 7 12 7Z" fill="#2E3A59" />
                                                </svg>
                                            </span>
                                            <div class="s-content">
                                                <p>Đánh 2 chữ số cuối trong lô 27 giải. Thắng gấp 99.4 lần, nếu số đó về N lần thì
                                                    tính kết quả x N lần. Ví dụ: đánh lô 79 - 1 con 1k, Tổng thanh toán: 1k x 27 =
                                                    27k. Nếu trong lô có 2 chữ số cuối là 79 thì Tiền thắng: 1k x 99.4 = 99.4k, nếu
                                                    có N lần 2 chữ số cuối là 79 thì Tiền thắng là: 1k x 99.4 x N
                                                </p>
                                            </div>
                                            <div class="ls_number">
                                                <label class="item_number" for="lo2so-01">
                                                    <input type="checkbox" id="lo2so-01" name="number[]" value="01">
                                                    <span class="text">01</span>
                                                </label>
                                                <label class="item_number" for="lo2so-02">
                                                    <input type="checkbox" id="lo2so-02" name="number[]" value="02">
                                                    <span class="text">02</span>
                                                </label>
                                                <label class="item_number" for="lo2so-03">
                                                    <input type="checkbox" id="lo2so-03" name="number[]" value="03">
                                                    <span class="text">03</span>
                                                </label>
                                                <label class="item_number" for="lo2so-04">
                                                    <input type="checkbox" id="lo2so-04" name="number[]" value="04">
                                                    <span class="text">04</span>
                                                </label>
                                                <label class="item_number" for="lo2so-05">
                                                    <input type="checkbox" id="lo2so-05" name="number[]" value="05">
                                                    <span class="text">05</span>
                                                </label>
                                                <label class="item_number" for="lo2so-06">
                                                    <input type="checkbox" id="lo2so-06" name="number[]" value="06">
                                                    <span class="text">06</span>
                                                </label>
                                                <label class="item_number" for="lo2so-07">
                                                    <input type="checkbox" id="lo2so-07" name="number[]" value="07">
                                                    <span class="text">07</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-09">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-09">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-09">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-09">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-09">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-09">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-09">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-09">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-09">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-09">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-09">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                                <label class="item_number" for="lo2so-08">
                                                    <input type="checkbox" id="lo2so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="panel" data-state="hide" id="panel-lo3so">
                                            <span class="question">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C21.9939 17.5203 17.5203 21.9939 12 22ZM11 17V19H13V17H11ZM12 7C13.1046 7 14 7.89543 14 9C14.0035 9.53073 13.7904 10.0399 13.41 10.41L12.17 11.67C11.4214 12.4217 11.0008 13.4391 11 14.5V15H13C12.9223 13.925 13.3559 12.8763 14.17 12.17L15.07 11.25C15.6681 10.6543 16.003 9.84411 16 9C16 6.79086 14.2091 5 12 5C9.79086 5 8 6.79086 8 9H10C10 7.89543 10.8954 7 12 7Z" fill="#2E3A59" />
                                                </svg>
                                            </span>
                                            <div class="s-content">
                                                <p>Đánh 3 chữ số cuối trong lô 23 giải. Thắng gấp 900 lần, nếu số đó về N lần thì
                                                    tính kết quả x N lần. Ví dụ: đánh lô 789 - 1 con 1k, Tổng thanh toán: 1k x 23 =
                                                    23k. Nếu trong lô có 3 chữ số cuối là 789 thì Tiền thắng: 1k x 900 = 900k, nếu
                                                    có N lần 3 chữ số cuối là 789 thì Tiền thắng là: 1k x 900 x N
                                                </p>
                                            </div>
                                            <div class="ls_number">
                                                <label class="item_number" for="lo3so-01">
                                                    <input type="checkbox" id="lo3so-01" name="number[]" value="01">
                                                    <span class="text">01</span>
                                                </label>
                                                <label class="item_number" for="lo3so-02">
                                                    <input type="checkbox" id="lo3so-02" name="number[]" value="02">
                                                    <span class="text">02</span>
                                                </label>
                                                <label class="item_number" for="lo3so-03">
                                                    <input type="checkbox" id="lo3so-03" name="number[]" value="03">
                                                    <span class="text">03</span>
                                                </label>
                                                <label class="item_number" for="lo3so-04">
                                                    <input type="checkbox" id="lo3so-04" name="number[]" value="04">
                                                    <span class="text">04</span>
                                                </label>
                                                <label class="item_number" for="lo3so-05">
                                                    <input type="checkbox" id="lo3so-05" name="number[]" value="05">
                                                    <span class="text">05</span>
                                                </label>
                                                <label class="item_number" for="lo3so-06">
                                                    <input type="checkbox" id="lo3so-06" name="number[]" value="06">
                                                    <span class="text">06</span>
                                                </label>
                                                <label class="item_number" for="lo3so-07">
                                                    <input type="checkbox" id="lo3so-07" name="number[]" value="07">
                                                    <span class="text">07</span>
                                                </label>
                                                <label class="item_number" for="lo3so-08">
                                                    <input type="checkbox" id="lo3so-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel" data-state="hide" id="game-type-2">
                                    <div class="navv types">
                                        <button type="button" class="type type_js nav-item" data-state="true" id="3cang" data-target="#panel-3cang" data-max="999">3 càng</button>
                                    </div>
                                    <div class="tab_panel">
                                        <div class="panel" data-state="show" id="panel-3cang">
                                            <span class="question">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C21.9939 17.5203 17.5203 21.9939 12 22ZM11 17V19H13V17H11ZM12 7C13.1046 7 14 7.89543 14 9C14.0035 9.53073 13.7904 10.0399 13.41 10.41L12.17 11.67C11.4214 12.4217 11.0008 13.4391 11 14.5V15H13C12.9223 13.925 13.3559 12.8763 14.17 12.17L15.07 11.25C15.6681 10.6543 16.003 9.84411 16 9C16 6.79086 14.2091 5 12 5C9.79086 5 8 6.79086 8 9H10C10 7.89543 10.8954 7 12 7Z" fill="#2E3A59" />
                                                </svg>
                                            </span>
                                            <div class="s-content">
                                                <p>Đánh 3 chữ số cuối của giải ĐB. Thắng gấp 900 lần. Ví dụ: đánh 1k cho số 879,
                                                    Tổng thanh toán: 1k. Nếu giải ĐB là xx879 thì Tiền thắng: 1k x 900 = 900K
                                                </p>
                                            </div>
                                            <div class="group_number">
                                                <label for="3cang-sl" class="xs">Chọn nhóm số</label>
                                                <select name="" id="3cang-sl">
                                                    <option value="">000-099</option>
                                                    <option value="">100-199</option>
                                                    <option value="">200-299</option>
                                                    <option value="">300-399</option>
                                                    <option value="">400-499</option>
                                                    <option value="">500-599</option>
                                                    <option value="">600-699</option>
                                                    <option value="">700-799</option>
                                                    <option value="">800-899</option>
                                                    <option value="">900-999</option>
                                                </select>
                                                <button class="btn_xs">Hiển thị</button>
                                            </div>
                                            <div class="ls_number">
                                                <label class="item_number" for="3cang-01">
                                                    <input type="checkbox" id="3cang-01" name="number[]" value="01">
                                                    <span class="text">01</span>
                                                </label>
                                                <label class="item_number" for="3cang-02">
                                                    <input type="checkbox" id="3cang-02" name="number[]" value="02">
                                                    <span class="text">02</span>
                                                </label>
                                                <label class="item_number" for="3cang-03">
                                                    <input type="checkbox" id="3cang-03" name="number[]" value="03">
                                                    <span class="text">03</span>
                                                </label>
                                                <label class="item_number" for="3cang-04">
                                                    <input type="checkbox" id="3cang-04" name="number[]" value="04">
                                                    <span class="text">04</span>
                                                </label>
                                                <label class="item_number" for="3cang-05">
                                                    <input type="checkbox" id="3cang-05" name="number[]" value="05">
                                                    <span class="text">05</span>
                                                </label>
                                                <label class="item_number" for="3cang-06">
                                                    <input type="checkbox" id="3cang-06" name="number[]" value="06">
                                                    <span class="text">06</span>
                                                </label>
                                                <label class="item_number" for="3cang-07">
                                                    <input type="checkbox" id="3cang-07" name="number[]" value="07">
                                                    <span class="text">07</span>
                                                </label>
                                                <label class="item_number" for="3cang-08">
                                                    <input type="checkbox" id="3cang-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel" data-state="hide" id="game-type-3">
                                    <div class="navv types">
                                        <button type="button" class="type type_js nav-item" data-state="true" id="4cang" data-target="#panel-4cang" data-max="999">4 càng</button>
                                    </div>
                                    <div class="tab_panel">
                                        <div class="panel" data-state="show" id="panel-4cang">
                                            <div class="group_number">
                                                <div class="group">
                                                    <label for="3cang-sl" class="xs">Chọn nhóm số</label>
                                                    <button class="btn_xs">Chọn</button>
                                                </div>
                                                <select name="" id="4cang-sl-1">
                                                    <option value="">0</option>
                                                    <option value="">1</option>
                                                    <option value="">2</option>
                                                    <option value="">3</option>
                                                    <option value="">4</option>
                                                    <option value="">5</option>
                                                    <option value="">6</option>
                                                    <option value="">7</option>
                                                    <option value="">8</option>
                                                    <option value="">9</option>
                                                </select>
                                                <select name="" id="4cang-sl-2">
                                                    <option value="">0</option>
                                                    <option value="">1</option>
                                                    <option value="">2</option>
                                                    <option value="">3</option>
                                                    <option value="">4</option>
                                                    <option value="">5</option>
                                                    <option value="">6</option>
                                                    <option value="">7</option>
                                                    <option value="">8</option>
                                                    <option value="">9</option>
                                                </select>
                                                <select name="" id="4cang-sl-3">
                                                    <option value="">0</option>
                                                    <option value="">1</option>
                                                    <option value="">2</option>
                                                    <option value="">3</option>
                                                    <option value="">4</option>
                                                    <option value="">5</option>
                                                    <option value="">6</option>
                                                    <option value="">7</option>
                                                    <option value="">8</option>
                                                    <option value="">9</option>
                                                </select>
                                                <select name="" id="4cang-sl-4">
                                                    <option value="">0</option>
                                                    <option value="">1</option>
                                                    <option value="">2</option>
                                                    <option value="">3</option>
                                                    <option value="">4</option>
                                                    <option value="">5</option>
                                                    <option value="">6</option>
                                                    <option value="">7</option>
                                                    <option value="">8</option>
                                                    <option value="">9</option>
                                                </select>
                                            </div>
                                            <div class="ls_number">
                                                <label class="item_number" for="4cang-01">
                                                    <input type="checkbox" id="4cang-01" name="number[]" value="01">
                                                    <span class="text">1224</span>
                                                </label>
                                            </div>
                                            <div class="s-content">
                                                <p>Đánh 3 chữ số cuối của giải ĐB. Thắng gấp 900 lần. Ví dụ: đánh 1k cho số 879,
                                                    Tổng thanh toán: 1k. Nếu giải ĐB là xx879 thì Tiền thắng: 1k x 900 = 900K
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel" data-state="hide" id="game-type-4">
                                    <div class="navv types">
                                        <button type="button" class="type type_js nav-item" data-state="true" id="dedau" data-target="#panel-dedau" data-max="999">Đề đầu</button>
                                        <button type="button" class="type type_js nav-item" data-state="false" id="dedacbiet" data-target="#panel-dedacbiet" data-max="999">Đề đặc biệt</button>
                                    </div>
                                    <div class="tab_panel">
                                        <div class="panel" data-state="show" id="panel-dedau">
                                            <span class="question">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C21.9939 17.5203 17.5203 21.9939 12 22ZM11 17V19H13V17H11ZM12 7C13.1046 7 14 7.89543 14 9C14.0035 9.53073 13.7904 10.0399 13.41 10.41L12.17 11.67C11.4214 12.4217 11.0008 13.4391 11 14.5V15H13C12.9223 13.925 13.3559 12.8763 14.17 12.17L15.07 11.25C15.6681 10.6543 16.003 9.84411 16 9C16 6.79086 14.2091 5 12 5C9.79086 5 8 6.79086 8 9H10C10 7.89543 10.8954 7 12 7Z" fill="#2E3A59" />
                                                </svg>
                                            </span>
                                            <div class="s-content">
                                                <p>Đánh 3 chữ số cuối của giải ĐB. Thắng gấp 900 lần. Ví dụ: đánh 1k cho số 879,
                                                    Tổng thanh toán: 1k. Nếu giải ĐB là xx879 thì Tiền thắng: 1k x 900 = 900K
                                                </p>
                                            </div>
                                            <div class="ls_number">
                                                <label class="item_number" for="dedau-01">
                                                    <input type="checkbox" id="dedau-01" name="number[]" value="01">
                                                    <span class="text">01</span>
                                                </label>
                                                <label class="item_number" for="dedau-02">
                                                    <input type="checkbox" id="dedau-02" name="number[]" value="02">
                                                    <span class="text">02</span>
                                                </label>
                                                <label class="item_number" for="dedau-03">
                                                    <input type="checkbox" id="dedau-03" name="number[]" value="03">
                                                    <span class="text">03</span>
                                                </label>
                                                <label class="item_number" for="dedau-04">
                                                    <input type="checkbox" id="dedau-04" name="number[]" value="04">
                                                    <span class="text">04</span>
                                                </label>
                                                <label class="item_number" for="dedau-05">
                                                    <input type="checkbox" id="dedau-05" name="number[]" value="05">
                                                    <span class="text">05</span>
                                                </label>
                                                <label class="item_number" for="dedau-06">
                                                    <input type="checkbox" id="dedau-06" name="number[]" value="06">
                                                    <span class="text">06</span>
                                                </label>
                                                <label class="item_number" for="dedau-07">
                                                    <input type="checkbox" id="dedau-07" name="number[]" value="07">
                                                    <span class="text">07</span>
                                                </label>
                                                <label class="item_number" for="dedau-08">
                                                    <input type="checkbox" id="dedau-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="panel" data-state="hide" id="panel-dedacbiet">
                                            <span class="question">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C21.9939 17.5203 17.5203 21.9939 12 22ZM11 17V19H13V17H11ZM12 7C13.1046 7 14 7.89543 14 9C14.0035 9.53073 13.7904 10.0399 13.41 10.41L12.17 11.67C11.4214 12.4217 11.0008 13.4391 11 14.5V15H13C12.9223 13.925 13.3559 12.8763 14.17 12.17L15.07 11.25C15.6681 10.6543 16.003 9.84411 16 9C16 6.79086 14.2091 5 12 5C9.79086 5 8 6.79086 8 9H10C10 7.89543 10.8954 7 12 7Z" fill="#2E3A59" />
                                                </svg>
                                            </span>
                                            <div class="s-content">
                                                <p>Đánh 2 chữ số cuối trong giải ĐB. Thắng gấp 95 lần. Ví dụ: đánh 1k cho số 79.
                                                    Tổng thanh toán: 1k. Nếu giải ĐB là xxx79 thì Tiền thắng: 1k x 95 = 95k
                                                </p>
                                            </div>
                                            <div class="ls_number">
                                                <label class="item_number" for="dedacbiet-01">
                                                    <input type="checkbox" id="dedacbiet-01" name="number[]" value="01">
                                                    <span class="text">01</span>
                                                </label>
                                                <label class="item_number" for="dedacbiet-02">
                                                    <input type="checkbox" id="dedacbiet-02" name="number[]" value="02">
                                                    <span class="text">02</span>
                                                </label>
                                                <label class="item_number" for="dedacbiet-03">
                                                    <input type="checkbox" id="dedacbiet-03" name="number[]" value="03">
                                                    <span class="text">03</span>
                                                </label>
                                                <label class="item_number" for="dedacbiet-04">
                                                    <input type="checkbox" id="dedacbiet-04" name="number[]" value="04">
                                                    <span class="text">04</span>
                                                </label>
                                                <label class="item_number" for="dedacbiet-05">
                                                    <input type="checkbox" id="dedacbiet-05" name="number[]" value="05">
                                                    <span class="text">05</span>
                                                </label>
                                                <label class="item_number" for="dedacbiet-06">
                                                    <input type="checkbox" id="dedacbiet-06" name="number[]" value="06">
                                                    <span class="text">06</span>
                                                </label>
                                                <label class="item_number" for="dedacbiet-07">
                                                    <input type="checkbox" id="dedacbiet-07" name="number[]" value="07">
                                                    <span class="text">07</span>
                                                </label>
                                                <label class="item_number" for="dedacbiet-08">
                                                    <input type="checkbox" id="dedacbiet-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel" data-state="hide" id="game-type-5">
                                    <div class="navv types">
                                        <button type="button" class="type type_js nav-item" data-state="true" id="dedau" data-target="#panel-dau" data-max="999">Đầu</button>
                                        <button type="button" class="type type_js nav-item" data-state="false" id="deduoi" data-target="#panel-duoi" data-max="999">Đuôi</button>
                                    </div>
                                    <div class="tab_panel">
                                        <div class="panel" data-state="show" id="panel-dau">
                                            <span class="question">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C21.9939 17.5203 17.5203 21.9939 12 22ZM11 17V19H13V17H11ZM12 7C13.1046 7 14 7.89543 14 9C14.0035 9.53073 13.7904 10.0399 13.41 10.41L12.17 11.67C11.4214 12.4217 11.0008 13.4391 11 14.5V15H13C12.9223 13.925 13.3559 12.8763 14.17 12.17L15.07 11.25C15.6681 10.6543 16.003 9.84411 16 9C16 6.79086 14.2091 5 12 5C9.79086 5 8 6.79086 8 9H10C10 7.89543 10.8954 7 12 7Z" fill="#2E3A59" />
                                                </svg>
                                            </span>
                                            <div class="s-content">
                                                <p>Đánh 1 chữ số ở hàng chục của giải ĐB. Thắng gấp 9.5 lần. Ví dụ: đánh 1k cho số
                                                    7. Tổng thanh toán: 1K. Nếu giải ĐB là xxx7x thì Tiền thắng: 1k x 9.5 = 9.5k
                                                </p>
                                            </div>
                                            <div class="ls_number">
                                                <label class="item_number" for="dau-01">
                                                    <input type="checkbox" id="dau-01" name="number[]" value="01">
                                                    <span class="text">01</span>
                                                </label>
                                                <label class="item_number" for="dau-02">
                                                    <input type="checkbox" id="dau-02" name="number[]" value="02">
                                                    <span class="text">02</span>
                                                </label>
                                                <label class="item_number" for="dau-03">
                                                    <input type="checkbox" id="dau-03" name="number[]" value="03">
                                                    <span class="text">03</span>
                                                </label>
                                                <label class="item_number" for="dau-04">
                                                    <input type="checkbox" id="dau-04" name="number[]" value="04">
                                                    <span class="text">04</span>
                                                </label>
                                                <label class="item_number" for="dau-05">
                                                    <input type="checkbox" id="dau-05" name="number[]" value="05">
                                                    <span class="text">05</span>
                                                </label>
                                                <label class="item_number" for="dau-06">
                                                    <input type="checkbox" id="dau-06" name="number[]" value="06">
                                                    <span class="text">06</span>
                                                </label>
                                                <label class="item_number" for="dau-07">
                                                    <input type="checkbox" id="dau-07" name="number[]" value="07">
                                                    <span class="text">07</span>
                                                </label>
                                                <label class="item_number" for="dau-08">
                                                    <input type="checkbox" id="dau-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="panel" data-state="hide" id="panel-duoi">
                                            <span class="question">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C21.9939 17.5203 17.5203 21.9939 12 22ZM11 17V19H13V17H11ZM12 7C13.1046 7 14 7.89543 14 9C14.0035 9.53073 13.7904 10.0399 13.41 10.41L12.17 11.67C11.4214 12.4217 11.0008 13.4391 11 14.5V15H13C12.9223 13.925 13.3559 12.8763 14.17 12.17L15.07 11.25C15.6681 10.6543 16.003 9.84411 16 9C16 6.79086 14.2091 5 12 5C9.79086 5 8 6.79086 8 9H10C10 7.89543 10.8954 7 12 7Z" fill="#2E3A59" />
                                                </svg>
                                            </span>
                                            <div class="s-content">
                                                <p>Đánh 1 chữ số cuối của giải ĐB. Thắng gấp 9.5 lần. Ví dụ: đánh 1k cho số 7. Tổng
                                                    thanh toán: 1K. Nếu giải ĐB là xxxx7 thì Tiền thắng: 1k x 9.5 = 9.5k
                                                </p>
                                            </div>
                                            <div class="ls_number">
                                                <label class="item_number" for="duoi-01">
                                                    <input type="checkbox" id="duoi-01" name="number[]" value="01">
                                                    <span class="text">01</span>
                                                </label>
                                                <label class="item_number" for="duoi-02">
                                                    <input type="checkbox" id="duoi-02" name="number[]" value="02">
                                                    <span class="text">02</span>
                                                </label>
                                                <label class="item_number" for="duoi-03">
                                                    <input type="checkbox" id="duoi-03" name="number[]" value="03">
                                                    <span class="text">03</span>
                                                </label>
                                                <label class="item_number" for="duoi-04">
                                                    <input type="checkbox" id="duoi-04" name="number[]" value="04">
                                                    <span class="text">04</span>
                                                </label>
                                                <label class="item_number" for="duoi-05">
                                                    <input type="checkbox" id="duoi-05" name="number[]" value="05">
                                                    <span class="text">05</span>
                                                </label>
                                                <label class="item_number" for="duoi-06">
                                                    <input type="checkbox" id="duoi-06" name="number[]" value="06">
                                                    <span class="text">06</span>
                                                </label>
                                                <label class="item_number" for="duoi-07">
                                                    <input type="checkbox" id="duoi-07" name="number[]" value="07">
                                                    <span class="text">07</span>
                                                </label>
                                                <label class="item_number" for="duoi-08">
                                                    <input type="checkbox" id="duoi-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel" data-state="hide" id="game-type-6">
                                    <div class="navv types">
                                        <button type="button" class="type type_js nav-item" data-state="true" id="xien2" data-target="#panel-xien2" data-max="2">Xiên 2</button>
                                        <button type="button" class="type type_js nav-item" data-state="false" id="xien3" data-target="#panel-xien3" data-max="3">Xiên 3</button>
                                        <button type="button" class="type type_js nav-item" data-state="false" id="xien4" data-target="#panel-xien4" data-max="4">Xiên 4</button>
                                    </div>
                                    <div class="tab_panel">
                                        <div class="panel" data-state="show" id="panel-xien2">
                                            <span class="question">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C21.9939 17.5203 17.5203 21.9939 12 22ZM11 17V19H13V17H11ZM12 7C13.1046 7 14 7.89543 14 9C14.0035 9.53073 13.7904 10.0399 13.41 10.41L12.17 11.67C11.4214 12.4217 11.0008 13.4391 11 14.5V15H13C12.9223 13.925 13.3559 12.8763 14.17 12.17L15.07 11.25C15.6681 10.6543 16.003 9.84411 16 9C16 6.79086 14.2091 5 12 5C9.79086 5 8 6.79086 8 9H10C10 7.89543 10.8954 7 12 7Z" fill="#2E3A59" />
                                                </svg>
                                            </span>
                                            <div class="s-content">
                                                <p>Xiên 2 của 2 chữ số cuối trong lô 27 giải. Thắng gấp 17 lần. Ví dụ : đánh 1k cho
                                                    xiên 11+13, Tổng thanh toán: 1k. Nếu trong lô có "2 chữ số cuối là 11 và 2 chữ
                                                    số cuối là 13" thì Tiền thắng: 1k x 17 = 17k
                                                </p>
                                            </div>
                                            <div class="ls_number">
                                                <label class="item_number" for="xien2-01">
                                                    <input type="checkbox" id="xien2-01" name="number[]" value="01">
                                                    <span class="text">01</span>
                                                </label>
                                                <label class="item_number" for="xien2-02">
                                                    <input type="checkbox" id="xien2-02" name="number[]" value="02">
                                                    <span class="text">02</span>
                                                </label>
                                                <label class="item_number" for="xien2-03">
                                                    <input type="checkbox" id="xien2-03" name="number[]" value="03">
                                                    <span class="text">03</span>
                                                </label>
                                                <label class="item_number" for="xien2-04">
                                                    <input type="checkbox" id="xien2-04" name="number[]" value="04">
                                                    <span class="text">04</span>
                                                </label>
                                                <label class="item_number" for="xien2-05">
                                                    <input type="checkbox" id="xien2-05" name="number[]" value="05">
                                                    <span class="text">05</span>
                                                </label>
                                                <label class="item_number" for="xien2-06">
                                                    <input type="checkbox" id="xien2-06" name="number[]" value="06">
                                                    <span class="text">06</span>
                                                </label>
                                                <label class="item_number" for="xien2-07">
                                                    <input type="checkbox" id="xien2-07" name="number[]" value="07">
                                                    <span class="text">07</span>
                                                </label>
                                                <label class="item_number" for="xien2-08">
                                                    <input type="checkbox" id="xien2-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="panel" data-state="hide" id="panel-xien3">
                                            <span class="question">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C21.9939 17.5203 17.5203 21.9939 12 22ZM11 17V19H13V17H11ZM12 7C13.1046 7 14 7.89543 14 9C14.0035 9.53073 13.7904 10.0399 13.41 10.41L12.17 11.67C11.4214 12.4217 11.0008 13.4391 11 14.5V15H13C12.9223 13.925 13.3559 12.8763 14.17 12.17L15.07 11.25C15.6681 10.6543 16.003 9.84411 16 9C16 6.79086 14.2091 5 12 5C9.79086 5 8 6.79086 8 9H10C10 7.89543 10.8954 7 12 7Z" fill="#2E3A59" />
                                                </svg>
                                            </span>
                                            <div class="s-content">
                                                <p>Xiên 3 của 2 chữ số cuối trong lô 27 giải. Thắng gấp 65 lần. Ví dụ : đánh 1k cho
                                                    xiên 11+13+15, Tổng thanh toán: 1k. Nếu trong lô có 2 chữ số cuối là 11,13,15
                                                    thì Tiền thắng: 1k x 65 = 65k
                                                </p>
                                            </div>
                                            <div class="ls_number">
                                                <label class="item_number" for="xien3-01">
                                                    <input type="checkbox" id="xien3-01" name="number[]" value="01">
                                                    <span class="text">01</span>
                                                </label>
                                                <label class="item_number" for="xien3-02">
                                                    <input type="checkbox" id="xien3-02" name="number[]" value="02">
                                                    <span class="text">02</span>
                                                </label>
                                                <label class="item_number" for="xien3-03">
                                                    <input type="checkbox" id="xien3-03" name="number[]" value="03">
                                                    <span class="text">03</span>
                                                </label>
                                                <label class="item_number" for="xien3-04">
                                                    <input type="checkbox" id="xien3-04" name="number[]" value="04">
                                                    <span class="text">04</span>
                                                </label>
                                                <label class="item_number" for="xien3-05">
                                                    <input type="checkbox" id="xien3-05" name="number[]" value="05">
                                                    <span class="text">05</span>
                                                </label>
                                                <label class="item_number" for="xien3-06">
                                                    <input type="checkbox" id="xien3-06" name="number[]" value="06">
                                                    <span class="text">06</span>
                                                </label>
                                                <label class="item_number" for="xien3-07">
                                                    <input type="checkbox" id="xien3-07" name="number[]" value="07">
                                                    <span class="text">07</span>
                                                </label>
                                                <label class="item_number" for="xien3-08">
                                                    <input type="checkbox" id="xien3-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="panel" data-state="hide" id="panel-xien4">
                                            <span class="question">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C21.9939 17.5203 17.5203 21.9939 12 22ZM11 17V19H13V17H11ZM12 7C13.1046 7 14 7.89543 14 9C14.0035 9.53073 13.7904 10.0399 13.41 10.41L12.17 11.67C11.4214 12.4217 11.0008 13.4391 11 14.5V15H13C12.9223 13.925 13.3559 12.8763 14.17 12.17L15.07 11.25C15.6681 10.6543 16.003 9.84411 16 9C16 6.79086 14.2091 5 12 5C9.79086 5 8 6.79086 8 9H10C10 7.89543 10.8954 7 12 7Z" fill="#2E3A59" />
                                                </svg>
                                            </span>
                                            <div class="s-content">
                                                <p>Xiên 4 của 2 chữ số cuối trong lô 27 giải. Thắng gấp 250 lần. Ví dụ : đánh 1k cho
                                                    xiên 11+13+15+20, Tổng thanh toán: 1k. Nếu trong lô có 2 chữ số cuối là
                                                    11,13,15,20 thì Tiền thắng: 1k x 250 = 250k
                                                </p>
                                            </div>
                                            <div class="ls_number">
                                                <label class="item_number" for="xien4-01">
                                                    <input type="checkbox" id="xien4-01" name="number[]" value="01">
                                                    <span class="text">01</span>
                                                </label>
                                                <label class="item_number" for="xien4-02">
                                                    <input type="checkbox" id="xien4-02" name="number[]" value="02">
                                                    <span class="text">02</span>
                                                </label>
                                                <label class="item_number" for="xien4-03">
                                                    <input type="checkbox" id="xien4-03" name="number[]" value="03">
                                                    <span class="text">03</span>
                                                </label>
                                                <label class="item_number" for="xien4-04">
                                                    <input type="checkbox" id="xien4-04" name="number[]" value="04">
                                                    <span class="text">04</span>
                                                </label>
                                                <label class="item_number" for="xien4-05">
                                                    <input type="checkbox" id="xien4-05" name="number[]" value="05">
                                                    <span class="text">05</span>
                                                </label>
                                                <label class="item_number" for="xien4-06">
                                                    <input type="checkbox" id="xien4-06" name="number[]" value="06">
                                                    <span class="text">06</span>
                                                </label>
                                                <label class="item_number" for="xien4-07">
                                                    <input type="checkbox" id="xien4-07" name="number[]" value="07">
                                                    <span class="text">07</span>
                                                </label>
                                                <label class="item_number" for="xien4-08">
                                                    <input type="checkbox" id="xien4-08" name="number[]" value="08">
                                                    <span class="text">08</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box box_booking">
                            <p class="title_lg" id="current-game">Đánh đề</p>
                            <div class="box_mini">
                                <div class="types">
                                    <span class="domain xs">Miền Bắc</span> / <span class="lotto xs">Đánh lô</span> / <span class="type xs">Lô 2 số</span>
                                </div>
                                <div class="ls_lotto" id="ls_lotto">
                                    <span class="no-result">Chưa chọn số</span>
                                </div>
                            </div>
                            <p class="xs lb_total">Tổng tiền đánh (K)</p>
                            <input type="number" value="1" class="ip" name="bet">
                            <div class="plot_total">
                                <p class="block_total min">Cược tối thiểu<span class="total">198</span>
                                </p>
                                <p class="block_total money">Tiền đánh / 1 con<span class="total">198</span>
                                </p>
                                <p class="block_total money_win">Tiền thắng / 1 con<span class="total">198</span>
                                </p>
                            </div>
                            <button type="submit" class="btn_all book">ĐẶT CƯỢC</button>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <div class="game-list p-b-20">
            @include('games.plinko.game_history')
        </div>
    </div>
</div>

@endsection
@section('js')
<script src="theme/frontend/lotto/js/gui.js" defer></script>
@endsection