<div class="plot_totay">
    <div class="container">
        <table class="table table-condensed kqcenter kqvertimarginw table-kq-border table-kq-hover-div table-bordered kqbackground table-kq-bold-border tb-phoi-border watermark table-striped" id="result_tab_mb">
            <thead>
                <tr class="title_row">
                    <td class="color333" colspan="2">
                        <div class="col-sm-10">
                            <h2 class="martop10 col-sm-8 chu16 kqcenter viethoa dosam vietdam">Kết quả quay số phiên trước
                            </h2>
                        </div>
                        <div class="col-sm-10">
                            <span class=" chu15" id="result_date">Phiên {{$prevGameRecordId ??'-'}}</span>
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
                            @php
                                $items = $tableResult->getByGiai(\App\Games\Lotto\Enums\NoPrize::DAC_BIET);
                            @endphp
                            @foreach ($items as $item)
                                <div style="width:100%; position: relative; float: left;" class="phoi-size db chu16 gray need_blank vietdam phoi-size chu30 maudo stop-reload hover">
                                    {{$item}}
                                </div>    
                            @endforeach
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="hover" style="width:18%;vertical-align:middle;font-size:14px;">Giải nhất</td>
                    <td style="padding: 0;">
                        <div class="row-no-gutters text-center">
                            @php
                                $items = $tableResult->getByGiai(\App\Games\Lotto\Enums\NoPrize::NHAT);
                            @endphp
                            @foreach ($items as $item)
                            <div style="width:100%; position: relative; float: left;" class="phoi-size chu16 gray need_blank vietdam hover"> {{$item}}</div>
                            @endforeach
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="hover" style="width:18%;vertical-align:middle;font-size:14px;">Giải nhì</td>
                    <td style="padding: 0;">
                        <div class="row-no-gutters text-center">
                            @php
                                $items = $tableResult->getByGiai(\App\Games\Lotto\Enums\NoPrize::NHI);
                            @endphp
                            @foreach ($items as $item)
                            <div style="width:50%; position: relative; float: left;" class="phoi-size chu16 gray need_blank vietdam border-right hover">{{$item}}</div>
                            @endforeach
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="hover" style="width:18%;vertical-align:middle;font-size:14px;">Giải ba</td>
                    <td style="padding: 0;">
                        <div class="row-no-gutters text-center">
                            @php
                                $items = $tableResult->getByGiai(\App\Games\Lotto\Enums\NoPrize::BA);
                            @endphp
                            @foreach ($items as $item)
                            <div style="width:33.333333333333%; position: relative; float: left;" class="phoi-size chu16 gray need_blank vietdam border-bottom border-right hover">
                                {{$item}}
                            </div>
                            @endforeach
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="hover" style="width:18%;vertical-align:middle;font-size:14px;">Giải tư</td>
                    <td style="padding: 0;">
                        <div class="row-no-gutters text-center">
                            @php
                                $items = $tableResult->getByGiai(\App\Games\Lotto\Enums\NoPrize::BON);
                            @endphp
                            @foreach ($items as $item)
                            <div style="width:25%; position: relative; float: left;" class="phoi-size chu16 gray need_blank vietdam border-right hover"> {{$item}}</div>
                            @endforeach
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="hover" style="width:18%;vertical-align:middle;font-size:14px;">Giải năm</td>
                    <td style="padding: 0;">
                        <div class="row-no-gutters text-center">
                            @php
                                $items = $tableResult->getByGiai(\App\Games\Lotto\Enums\NoPrize::NAM);
                            @endphp
                            @foreach ($items as $item)
                            <div style="width:33.333333333333%; position: relative; float: left;" class="phoi-size chu16 gray need_blank vietdam border-bottom border-right hover">
                                {{$item}}
                            </div>
                            @endforeach
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="hover" style="width:18%;vertical-align:middle;font-size:14px;">Giải sáu</td>
                    <td style="padding: 0;">
                        <div class="row-no-gutters text-center">
                            @php
                                $items = $tableResult->getByGiai(\App\Games\Lotto\Enums\NoPrize::SAU);
                            @endphp
                            @foreach ($items as $item)
                            <div style="width:33.333333333333%; position: relative; float: left;" class="phoi-size chu16 gray need_blank vietdam border-right hover"> {{$item}}</div>
                            @endforeach
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="hover" style="width:18%;vertical-align:middle;font-size:14px;">Giải bảy</td>
                    <td style="padding: 0;">
                        <div class="row-no-gutters text-center">
                            @php
                                $items = $tableResult->getByGiai(\App\Games\Lotto\Enums\NoPrize::BAY);
                            @endphp
                            @foreach ($items as $item)
                            <div style="width:25%; position: relative; float: left;" class="phoi-size chu16 gray need_blank vietdam border-right hover"> {{$item}}</div>
                            @endforeach
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>