@php
    use \realtimemodule\pushserver\Helpers\PushServerHelper;
@endphp
@extends('index')
@section('css')
    <link rel="stylesheet" href="theme/frontend/css/base.css">
    <link rel="stylesheet" href="theme/frontend/css/app.css">
    <link rel="stylesheet" href="theme/frontend/css/van.css">
    <script type="text/javascript">
        var connectionGameType = '{{PushServerHelper::generateHash(1)}}';
    </script>
@endsection
@section('content')
<div id="app">
    <div class="mian game">
        @include('games.base_game_bar')
        <div class="game-betting">
            <div class="tab">
                <div class="box c-row">
                    @foreach ($listGameWinType as $key => $itemGameWinType)
                        <div class="item c-tc{{$key == 0 ? ' action':''}}" data-id="{{PushServerHelper::generateHash($itemGameWinType->id)}}"  src-active="theme/frontend/img/icon_clock_active.png"
                        src-disable="theme/frontend/img/icon_clock.png">
                            <div class="circular c-row c-row-middle-center c-tc"><span class="li">?</span></div>
                            <div class="img c-row c-row-center p-b-10">
                                <div class="van-image" style="width: 30px; height: 30px;">
                                    <img src="{{$key == 0 ? 'theme/frontend/img/icon_clock_active.png':'theme/frontend/img/icon_clock.png'}}" class="van-image__img">
                                </div>
                                <i class="triangle"></i>
                            </div>
                            <div class="txt c-tc">{{Support::show($itemGameWinType,'name')}}</div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="content">
                <div class="time-box c-row c-row-between m-b-10">
                    
                </div>
                <div class="box">
                    <div class="mark-box c-row c-row-middle-center" style="display: none;">
                        <span class="item m-r-20">2</span>
                        <span class="item m-l-20">0</span>
                    </div>
                    <div class="con-box">
                        <div class="color-box c-row c-row-between">
                            <button type="button" class="btn green" data-color="green">Xanh</button>
                            <button type="button" class="btn violet" data-color="violet">Tím</button>
                            <button type="button" class="btn red" data-color="red">Đỏ</button>
                        </div>
                    </div>
                    <div class="number-box m-t-10 c-row c-row-between c-flex-warp">
                        @for ($i = 0; $i < 10; $i++)
                            <button type="button" class="item c-row c-row-middle-center m-b-10">
                                <div class="number c-row c-row-middle-center"><span class="txt">{{$i}}</span></div>
                            </button>
                        @endfor
                    </div>
                    <div class="c-row c-row-between random-box"><button class="random">ngẫu nhiên</button>
                        <div class="c-row">
                            @foreach ($listGameWinMultiple as $key => $itemGameWinMultiple)
                                <div class="item" style="{{$key == 0 ? 'background-color: rgb(92, 186, 71); color: rgb(255, 255, 255);':'background-color: rgb(240, 240, 240); color: rgb(0, 0, 0);'}}">{{$itemGameWinMultiple->name}}</div>
                            @endforeach
                        </div>
                    </div>
                    <div class="btn-box c-row">
                        <button class="item yellow" data-size="big"> Lớn </button>
                        <button class="item green" data-size="small"> Nhỏ </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="game-list p-b-20">
            <div class="tab c-row c-row-between">
                <div class="li c-row c-row-center"><span class="txt action"> Lịch sử trò chơi </span></div>
                <div class="li c-row c-row-center"><span class="txt"> Biểu đồ trên </span></div>
                <div class="li c-row c-row-center"><span class="txt"> Đặt cược của tôi </span></div>
            </div>
            <div class="con-box" style="">
                <div class="list m-t-10">
                    <div class="wrap">
                        <div class="c-tc van-row">
                            <div class="van-col van-col--8"> Kỳ xổ </div>
                            <div class="van-col van-col--5"> Số lượng </div>
                            <div class="van-col van-col--5"> Lớn Nhỏ </div>
                            <div class="van-col van-col--6"> Màu sắc </div>
                        </div>
                    </div>
                    <div>
                        <div class="hb">
                            <div class="c-tc item van-row">
                                <div class="van-col van-col--8">
                                    <div class="c-tc goItem">2022070120195</div>
                                </div>
                                <div class="van-col van-col--5">
                                    <div class="c-tc goItem"><span class="red"> 0 </span>
                                    </div>
                                </div>
                                <div class="van-col van-col--5">
                                    <div class="c-tc goItem">
                                        <span>Nhỏ </span>
                                    </div>
                                </div>
                                <div class="van-col van-col--6">
                                    <div class="goItem c-row c-tc c-row-center">
                                        <div class="c-tc c-row box c-row-center c-row-middle">
                                            <span class="li red"></span>
                                            <span class="li violet"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="c-tc item van-row">
                                <div class="van-col van-col--8">
                                    <div class="c-tc goItem">2022070120194</div>
                                </div>
                                <div class="van-col van-col--5">
                                    <div class="c-tc goItem">
                                        <span class="green"> 5 </span>
                                    </div>
                                </div>
                                <div class="van-col van-col--5">
                                    <div class="c-tc goItem"><span> Lớn </span>
                                    </div>
                                </div>
                                <div class="van-col van-col--6">
                                    <div class="goItem c-row c-tc c-row-center">
                                        <div class="c-tc c-row box c-row-center"><span class="li green"></span>
                                            <span class="li violet"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="c-tc item van-row">
                                <div class="van-col van-col--8">
                                    <div class="c-tc goItem">2022070120193</div>
                                </div>
                                <div class="van-col van-col--5">
                                    <div class="c-tc goItem">
                                        <span class="green"> 7 </span>
                                    </div>
                                </div>
                                <div class="van-col van-col--5">
                                    <div class="c-tc goItem"><span> Lớn </span>
                                    </div>
                                </div>
                                <div class="van-col van-col--6">
                                    <div class="goItem c-row c-tc c-row-center">
                                        <div class="c-tc c-row box c-row-center"><span class="li green"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="c-tc item van-row">
                                <div class="van-col van-col--8">
                                    <div class="c-tc goItem">2022070120192</div>
                                </div>
                                <div class="van-col van-col--5">
                                    <div class="c-tc goItem"><span class="red"> 4 </span>
                                    </div>
                                </div>
                                <div class="van-col van-col--5">
                                    <div class="c-tc goItem">
                                        <span>Nhỏ </span>
                                    </div>
                                </div>
                                <div class="van-col van-col--6">
                                    <div class="goItem c-row c-tc c-row-center">
                                        <div class="c-tc c-row box c-row-center"><span class="li red"></span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="c-tc item van-row">
                                <div class="van-col van-col--8">
                                    <div class="c-tc goItem">2022070120191</div>
                                </div>
                                <div class="van-col van-col--5">
                                    <div class="c-tc goItem"><span class="red"> 4 </span>
                                    </div>
                                </div>
                                <div class="van-col van-col--5">
                                    <div class="c-tc goItem">
                                        <span>Nhỏ </span>
                                    </div>
                                </div>
                                <div class="van-col van-col--6">
                                    <div class="goItem c-row c-tc c-row-center">
                                        <div class="c-tc c-row box c-row-center"><span class="li red"></span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="c-tc item van-row">
                                <div class="van-col van-col--8">
                                    <div class="c-tc goItem">2022070120190</div>
                                </div>
                                <div class="van-col van-col--5">
                                    <div class="c-tc goItem"><span class="red"> 2 </span>
                                    </div>
                                </div>
                                <div class="van-col van-col--5">
                                    <div class="c-tc goItem">
                                        <span>Nhỏ </span>
                                    </div>
                                </div>
                                <div class="van-col van-col--6">
                                    <div class="goItem c-row c-tc c-row-center">
                                        <div class="c-tc c-row box c-row-center"><span class="li red"></span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="c-tc item van-row">
                                <div class="van-col van-col--8">
                                    <div class="c-tc goItem">2022070120189</div>
                                </div>
                                <div class="van-col van-col--5">
                                    <div class="c-tc goItem"><span class="red"> 8 </span>
                                    </div>
                                </div>
                                <div class="van-col van-col--5">
                                    <div class="c-tc goItem"><span> Lớn </span>
                                    </div>
                                </div>
                                <div class="van-col van-col--6">
                                    <div class="goItem c-row c-tc c-row-center">
                                        <div class="c-tc c-row box c-row-center"><span class="li red"></span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="c-tc item van-row">
                                <div class="van-col van-col--8">
                                    <div class="c-tc goItem">2022070120188</div>
                                </div>
                                <div class="van-col van-col--5">
                                    <div class="c-tc goItem">
                                        <span class="green"> 7 </span>
                                    </div>
                                </div>
                                <div class="van-col van-col--5">
                                    <div class="c-tc goItem"><span> Lớn </span>
                                    </div>
                                </div>
                                <div class="van-col van-col--6">
                                    <div class="goItem c-row c-tc c-row-center">
                                        <div class="c-tc c-row box c-row-center"><span class="li green"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="c-tc item van-row">
                                <div class="van-col van-col--8">
                                    <div class="c-tc goItem">2022070120187</div>
                                </div>
                                <div class="van-col van-col--5">
                                    <div class="c-tc goItem">
                                        <span class="green"> 7 </span>
                                    </div>
                                </div>
                                <div class="van-col van-col--5">
                                    <div class="c-tc goItem"><span> Lớn </span>
                                    </div>
                                </div>
                                <div class="van-col van-col--6">
                                    <div class="goItem c-row c-tc c-row-center">
                                        <div class="c-tc c-row box c-row-center"><span class="li green"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="c-tc item van-row">
                                <div class="van-col van-col--8">
                                    <div class="c-tc goItem">2022070120186</div>
                                </div>
                                <div class="van-col van-col--5">
                                    <div class="c-tc goItem"><span class="red"> 4 </span>
                                    </div>
                                </div>
                                <div class="van-col van-col--5">
                                    <div class="c-tc goItem">
                                        <span>Nhỏ </span>
                                    </div>
                                </div>
                                <div class="van-col van-col--6">
                                    <div class="goItem c-row c-tc c-row-center">
                                        <div class="c-tc c-row box c-row-center"><span class="li red"></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="list-fooder"></div>
                </div>
                <div class="page-nav c-row c-row-center c-tc">
                    <div class="arr c-row c-row-middle-center"><i class="van-icon van-icon-arrow-left icon"
                            style="font-size: 20px;">
                        </i></div>
                    <div class="number">1/644</div>
                    <div class="arr c-row c-row-middle-center action"><i class="van-icon van-icon-arrow icon action"
                            style="font-size: 20px;">
                        </i></div>
                </div>
            </div>
            <div class="con-box p-b-20" style="display: none;">
                <div class="list m-t-10">
                    <div class="wrap">
                        <div class="c-tc van-row">
                            <div class="van-col van-col--8"> Kỳ xổ </div>
                            <div class="van-col van-col--16"> Số lượng </div>
                        </div>
                    </div>
                    <div class="con-Missing">
                        <div class="m-b-10"> Hỗ trợ cá cược (100 kỳ trước) </div>
                        <div class="item c-row c-row-between">
                            <div> Số kỳ chưa xổ </div>
                            <div class="c-row">
                                <div class="li">8</div>
                                <div class="li">1</div>
                                <div class="li">12</div>
                                <div class="li">16</div>
                                <div class="li">4</div>
                                <div class="li">0</div>
                                <div class="li">2</div>
                                <div class="li">5</div>
                                <div class="li">9</div>
                                <div class="li">10</div>
                            </div>
                        </div>
                        <div class="item c-row c-row-between">
                            <div> Bình quân số kỳ </div>
                            <div class="c-row">
                                <div class="li">7</div>
                                <div class="li">7</div>
                                <div class="li">15</div>
                                <div class="li">12</div>
                                <div class="li">18</div>
                                <div class="li">8</div>
                                <div class="li">9</div>
                                <div class="li">9</div>
                                <div class="li">11</div>
                                <div class="li">8</div>
                            </div>
                        </div>
                        <div class="item c-row c-row-between">
                            <div> Tần số xuất hiện </div>
                            <div class="c-row">
                                <div class="li">13</div>
                                <div class="li">12</div>
                                <div class="li">5</div>
                                <div class="li">11</div>
                                <div class="li">6</div>
                                <div class="li">12</div>
                                <div class="li">10</div>
                                <div class="li">10</div>
                                <div class="li">9</div>
                                <div class="li">12</div>
                            </div>
                        </div>
                        <div class="item c-row c-row-between">
                            <div> Lần xổ liên tiếp </div>
                            <div class="c-row">
                                <div class="li">1</div>
                                <div class="li">2</div>
                                <div class="li">1</div>
                                <div class="li">4</div>
                                <div class="li">2</div>
                                <div class="li">2</div>
                                <div class="li">2</div>
                                <div class="li">2</div>
                                <div class="li">2</div>
                                <div class="li">3</div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div issuenumber="2022070110563" number="5" colour="green,violet" rowid="1" class="hb">
                            <div class="p-l-5 p-l-5 p-t-20 p-b-20 van-row">
                                <div class="van-col van-col--8">
                                    <div class="c-tc">2022070110563</div>
                                </div>
                                <div class="van-col van-col--16">
                                    <div class="c-row c-row-between">
                                        <div></div>
                                        <div class="c-row qiu"><canvas canvas="" id="myCanvas1"
                                                class="line-canvas"></canvas>
                                            <div class="li">
                                                <div>0</div>
                                            </div>
                                            <div class="li">
                                                <div>1</div>
                                            </div>
                                            <div class="li">
                                                <div>2</div>
                                            </div>
                                            <div class="li">
                                                <div>3</div>
                                            </div>
                                            <div class="li">
                                                <div>4</div>
                                            </div>
                                            <div class="li action5">
                                                <div>5</div>
                                            </div>
                                            <div class="li">
                                                <div>6</div>
                                            </div>
                                            <div class="li">
                                                <div>7</div>
                                            </div>
                                            <div class="li">
                                                <div>8</div>
                                            </div>
                                            <div class="li">
                                                <div>9</div>
                                            </div>
                                            <div class="m-l-5">
                                                <div class="li actionB">B</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div issuenumber="2022070110562" number="1" colour="green" rowid="2" class="hb">
                            <div class="p-l-5 p-l-5 p-t-20 p-b-20 van-row">
                                <div class="van-col van-col--8">
                                    <div class="c-tc">2022070110562</div>
                                </div>
                                <div class="van-col van-col--16">
                                    <div class="c-row c-row-between">
                                        <div></div>
                                        <div class="c-row qiu"><canvas canvas="" id="myCanvas2"
                                                class="line-canvas"></canvas>
                                            <div class="li">
                                                <div>0</div>
                                            </div>
                                            <div class="li action1">
                                                <div>1</div>
                                            </div>
                                            <div class="li">
                                                <div>2</div>
                                            </div>
                                            <div class="li">
                                                <div>3</div>
                                            </div>
                                            <div class="li">
                                                <div>4</div>
                                            </div>
                                            <div class="li">
                                                <div>5</div>
                                            </div>
                                            <div class="li">
                                                <div>6</div>
                                            </div>
                                            <div class="li">
                                                <div>7</div>
                                            </div>
                                            <div class="li">
                                                <div>8</div>
                                            </div>
                                            <div class="li">
                                                <div>9</div>
                                            </div>
                                            <div class="m-l-5">
                                                <div class="li actionS">S</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div issuenumber="2022070110561" number="6" colour="red" rowid="3" class="hb">
                            <div class="p-l-5 p-l-5 p-t-20 p-b-20 van-row">
                                <div class="van-col van-col--8">
                                    <div class="c-tc">2022070110561</div>
                                </div>
                                <div class="van-col van-col--16">
                                    <div class="c-row c-row-between">
                                        <div></div>
                                        <div class="c-row qiu"><canvas canvas="" id="myCanvas3"
                                                class="line-canvas"></canvas>
                                            <div class="li">
                                                <div>0</div>
                                            </div>
                                            <div class="li">
                                                <div>1</div>
                                            </div>
                                            <div class="li">
                                                <div>2</div>
                                            </div>
                                            <div class="li">
                                                <div>3</div>
                                            </div>
                                            <div class="li">
                                                <div>4</div>
                                            </div>
                                            <div class="li">
                                                <div>5</div>
                                            </div>
                                            <div class="li action6">
                                                <div>6</div>
                                            </div>
                                            <div class="li">
                                                <div>7</div>
                                            </div>
                                            <div class="li">
                                                <div>8</div>
                                            </div>
                                            <div class="li">
                                                <div>9</div>
                                            </div>
                                            <div class="m-l-5">
                                                <div class="li actionB">B</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div issuenumber="2022070110560" number="6" colour="red" rowid="4" class="hb">
                            <div class="p-l-5 p-l-5 p-t-20 p-b-20 van-row">
                                <div class="van-col van-col--8">
                                    <div class="c-tc">2022070110560</div>
                                </div>
                                <div class="van-col van-col--16">
                                    <div class="c-row c-row-between">
                                        <div></div>
                                        <div class="c-row qiu"><canvas canvas="" id="myCanvas4"
                                                class="line-canvas"></canvas>
                                            <div class="li">
                                                <div>0</div>
                                            </div>
                                            <div class="li">
                                                <div>1</div>
                                            </div>
                                            <div class="li">
                                                <div>2</div>
                                            </div>
                                            <div class="li">
                                                <div>3</div>
                                            </div>
                                            <div class="li">
                                                <div>4</div>
                                            </div>
                                            <div class="li">
                                                <div>5</div>
                                            </div>
                                            <div class="li action6">
                                                <div>6</div>
                                            </div>
                                            <div class="li">
                                                <div>7</div>
                                            </div>
                                            <div class="li">
                                                <div>8</div>
                                            </div>
                                            <div class="li">
                                                <div>9</div>
                                            </div>
                                            <div class="m-l-5">
                                                <div class="li actionB">B</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div issuenumber="2022070110559" number="4" colour="red" rowid="5" class="hb">
                            <div class="p-l-5 p-l-5 p-t-20 p-b-20 van-row">
                                <div class="van-col van-col--8">
                                    <div class="c-tc">2022070110559</div>
                                </div>
                                <div class="van-col van-col--16">
                                    <div class="c-row c-row-between">
                                        <div></div>
                                        <div class="c-row qiu"><canvas canvas="" id="myCanvas5"
                                                class="line-canvas"></canvas>
                                            <div class="li">
                                                <div>0</div>
                                            </div>
                                            <div class="li">
                                                <div>1</div>
                                            </div>
                                            <div class="li">
                                                <div>2</div>
                                            </div>
                                            <div class="li">
                                                <div>3</div>
                                            </div>
                                            <div class="li action4">
                                                <div>4</div>
                                            </div>
                                            <div class="li">
                                                <div>5</div>
                                            </div>
                                            <div class="li">
                                                <div>6</div>
                                            </div>
                                            <div class="li">
                                                <div>7</div>
                                            </div>
                                            <div class="li">
                                                <div>8</div>
                                            </div>
                                            <div class="li">
                                                <div>9</div>
                                            </div>
                                            <div class="m-l-5">
                                                <div class="li actionS">S</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div issuenumber="2022070110558" number="7" colour="green" rowid="6" class="hb">
                            <div class="p-l-5 p-l-5 p-t-20 p-b-20 van-row">
                                <div class="van-col van-col--8">
                                    <div class="c-tc">2022070110558</div>
                                </div>
                                <div class="van-col van-col--16">
                                    <div class="c-row c-row-between">
                                        <div></div>
                                        <div class="c-row qiu"><canvas canvas="" id="myCanvas6"
                                                class="line-canvas"></canvas>
                                            <div class="li">
                                                <div>0</div>
                                            </div>
                                            <div class="li">
                                                <div>1</div>
                                            </div>
                                            <div class="li">
                                                <div>2</div>
                                            </div>
                                            <div class="li">
                                                <div>3</div>
                                            </div>
                                            <div class="li">
                                                <div>4</div>
                                            </div>
                                            <div class="li">
                                                <div>5</div>
                                            </div>
                                            <div class="li">
                                                <div>6</div>
                                            </div>
                                            <div class="li action7">
                                                <div>7</div>
                                            </div>
                                            <div class="li">
                                                <div>8</div>
                                            </div>
                                            <div class="li">
                                                <div>9</div>
                                            </div>
                                            <div class="m-l-5">
                                                <div class="li actionB">B</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div issuenumber="2022070110557" number="6" colour="red" rowid="7" class="hb">
                            <div class="p-l-5 p-l-5 p-t-20 p-b-20 van-row">
                                <div class="van-col van-col--8">
                                    <div class="c-tc">2022070110557</div>
                                </div>
                                <div class="van-col van-col--16">
                                    <div class="c-row c-row-between">
                                        <div></div>
                                        <div class="c-row qiu"><canvas canvas="" id="myCanvas7"
                                                class="line-canvas"></canvas>
                                            <div class="li">
                                                <div>0</div>
                                            </div>
                                            <div class="li">
                                                <div>1</div>
                                            </div>
                                            <div class="li">
                                                <div>2</div>
                                            </div>
                                            <div class="li">
                                                <div>3</div>
                                            </div>
                                            <div class="li">
                                                <div>4</div>
                                            </div>
                                            <div class="li">
                                                <div>5</div>
                                            </div>
                                            <div class="li action6">
                                                <div>6</div>
                                            </div>
                                            <div class="li">
                                                <div>7</div>
                                            </div>
                                            <div class="li">
                                                <div>8</div>
                                            </div>
                                            <div class="li">
                                                <div>9</div>
                                            </div>
                                            <div class="m-l-5">
                                                <div class="li actionB">B</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div issuenumber="2022070110556" number="7" colour="green" rowid="8" class="hb">
                            <div class="p-l-5 p-l-5 p-t-20 p-b-20 van-row">
                                <div class="van-col van-col--8">
                                    <div class="c-tc">2022070110556</div>
                                </div>
                                <div class="van-col van-col--16">
                                    <div class="c-row c-row-between">
                                        <div></div>
                                        <div class="c-row qiu"><canvas canvas="" id="myCanvas8"
                                                class="line-canvas"></canvas>
                                            <div class="li">
                                                <div>0</div>
                                            </div>
                                            <div class="li">
                                                <div>1</div>
                                            </div>
                                            <div class="li">
                                                <div>2</div>
                                            </div>
                                            <div class="li">
                                                <div>3</div>
                                            </div>
                                            <div class="li">
                                                <div>4</div>
                                            </div>
                                            <div class="li">
                                                <div>5</div>
                                            </div>
                                            <div class="li">
                                                <div>6</div>
                                            </div>
                                            <div class="li action7">
                                                <div>7</div>
                                            </div>
                                            <div class="li">
                                                <div>8</div>
                                            </div>
                                            <div class="li">
                                                <div>9</div>
                                            </div>
                                            <div class="m-l-5">
                                                <div class="li actionB">B</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div issuenumber="2022070110555" number="0" colour="red,violet" rowid="9" class="hb">
                            <div class="p-l-5 p-l-5 p-t-20 p-b-20 van-row">
                                <div class="van-col van-col--8">
                                    <div class="c-tc">2022070110555</div>
                                </div>
                                <div class="van-col van-col--16">
                                    <div class="c-row c-row-between">
                                        <div></div>
                                        <div class="c-row qiu"><canvas canvas="" id="myCanvas9"
                                                class="line-canvas"></canvas>
                                            <div class="li action0">
                                                <div>0</div>
                                            </div>
                                            <div class="li">
                                                <div>1</div>
                                            </div>
                                            <div class="li">
                                                <div>2</div>
                                            </div>
                                            <div class="li">
                                                <div>3</div>
                                            </div>
                                            <div class="li">
                                                <div>4</div>
                                            </div>
                                            <div class="li">
                                                <div>5</div>
                                            </div>
                                            <div class="li">
                                                <div>6</div>
                                            </div>
                                            <div class="li">
                                                <div>7</div>
                                            </div>
                                            <div class="li">
                                                <div>8</div>
                                            </div>
                                            <div class="li">
                                                <div>9</div>
                                            </div>
                                            <div class="m-l-5">
                                                <div class="li actionS">S</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div issuenumber="2022070110554" number="8" colour="red" rowid="10" class="hb">
                            <div class="p-l-5 p-l-5 p-t-20 p-b-20 van-row">
                                <div class="van-col van-col--8">
                                    <div class="c-tc">2022070110554</div>
                                </div>
                                <div class="van-col van-col--16">
                                    <div class="c-row c-row-between">
                                        <div></div>
                                        <div class="c-row qiu"><canvas canvas="" id="myCanvas10"
                                                class="line-canvas"></canvas>
                                            <div class="li">
                                                <div>0</div>
                                            </div>
                                            <div class="li">
                                                <div>1</div>
                                            </div>
                                            <div class="li">
                                                <div>2</div>
                                            </div>
                                            <div class="li">
                                                <div>3</div>
                                            </div>
                                            <div class="li">
                                                <div>4</div>
                                            </div>
                                            <div class="li">
                                                <div>5</div>
                                            </div>
                                            <div class="li">
                                                <div>6</div>
                                            </div>
                                            <div class="li">
                                                <div>7</div>
                                            </div>
                                            <div class="li action8">
                                                <div>8</div>
                                            </div>
                                            <div class="li">
                                                <div>9</div>
                                            </div>
                                            <div class="m-l-5">
                                                <div class="li actionB">B</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="list-fooder"></div>
                </div>
                <div class="page-nav c-row c-row-center c-tc">
                    <div class="arr c-row c-row-middle-center"><i class="van-icon van-icon-arrow-left icon"
                            style="font-size: 20px;">
                        </i></div>
                    <div class="number">1/1929</div>
                    <div class="arr c-row c-row-middle-center action"><i class="van-icon van-icon-arrow icon action"
                            style="font-size: 20px;">
                        </i></div>
                </div>
            </div>
            <div class="con-box p-b-20" style="display: none;">
                <div class="c-row c-flew-end p-r-20">
                    <div class="bettingMore c-tc c-row c-row-middle-center">Hơn<i class="van-icon van-icon-arrow"
                            style="color: rgb(84, 94, 104); font-size: 15px;">
                        </i></div>
                </div>
                <div class="list m-t-10">
                    <div class="p-t-5 p-b-5">
                        <div class="van-empty">
                            <div class="van-empty__image"><img
                                    src="https://img.yzcdn.cn/vant/empty-image-default.png"></div>
                            <p class="van-empty__description">Không có dữ liệu</p>
                        </div>
                    </div>
                    <div class="list-fooder"></div>
                </div>
            </div>
        </div>
        <div class="van-overlay" style="z-index: 2031; display: none;"></div>
        <div class="van-popup van-popup--round van-popup--bottom van-slide-up-enter-active"
            style="max-width: 10rem; left: auto; z-index: 2032; display: none;">
            <div class="betting-mark">
                <div class="head">
                    <div class="box">
                        <div class="con">3 Phút</div>
                        <div class="color" style="color: rgb(92, 186, 71);">Chọn <span
                                class="p-l-10 choose">Nhỏ</span>
                        </div>
                    </div>
                </div>
                <div class="info">
                    <div class="item c-row c-row-between">
                        <div class="tit">Số tiền</div>
                        <div class="c-row amount-box">
                            <div class="li" style="background-color: rgb(92, 186, 71); color: rgb(255, 255, 255);">
                                1000</div>
                            <div class="li" style="background-color: rgb(240, 240, 240); color: rgb(0, 0, 0);">10000
                            </div>
                            <div class="li" style="background-color: rgb(240, 240, 240); color: rgb(0, 0, 0);">
                                100000</div>
                            <div class="li" style="background-color: rgb(240, 240, 240); color: rgb(0, 0, 0);">
                                1000000</div>
                        </div>
                    </div>
                    <div class="item c-row c-row-between">
                        <div class="tit">Số lượng</div>
                        <div class="c-row c-row-between stepper-box">
                            <div class="li minus"
                                style="background-color: rgb(240, 240, 240); color: rgb(200, 201, 204);">-</div>
                            <div class="digit-box van-cell van-field">
                                <div class="van-cell__value van-cell__value--alone van-field__value">
                                    <div class="van-field__body"><input type="tel" inputmode="numeric"
                                            class="van-field__control"></div>
                                </div>
                            </div>
                            <div class="li plus c-row c-row-middle-center"
                                style="background-color: rgb(92, 186, 71); color: rgb(255, 255, 255);">+</div>
                        </div>
                    </div>
                    <div class="item c-row c-flew-end">
                        <div class="c-row multiple-box">
                            <div class="li" style="background-color: rgb(92, 186, 71); color: rgb(255, 255, 255);">
                                X1</div>
                            <div class="li" style="background-color: rgb(240, 240, 240); color: rgb(0, 0, 0);">X5
                            </div>
                            <div class="li" style="background-color: rgb(240, 240, 240); color: rgb(0, 0, 0);"> X10
                            </div>
                            <div class="li" style="background-color: rgb(240, 240, 240); color: rgb(0, 0, 0);"> X20
                            </div>
                            <div class="li" style="background-color: rgb(240, 240, 240); color: rgb(0, 0, 0);">X50
                            </div>
                            <div class="li" style="background-color: rgb(240, 240, 240); color: rgb(0, 0, 0);">X100
                            </div>
                        </div>
                    </div>
                    <div class="item c-row c-row-middle">
                        <div role="checkbox" tabindex="0" aria-checked="true" class="van-checkbox">
                            <div class="van-checkbox__icon van-checkbox__icon--square van-checkbox__icon--checked">
                                <i class="van-icon van-icon-success"
                                    style="border-color: rgb(244, 69, 62); background-color: rgb(244, 69, 62);">
                                </i>
                            </div><span class="van-checkbox__label">
                                <div class="agree p-r-15">Tôi đồng ý</div>
                            </span>
                        </div><span class="txt">Quy tắc bán trước</span>
                    </div>
                </div>
                <div class="foot c-row">
                    <div class="left"> Hủy </div>
                    <div class="right" style="background-color: rgb(92, 186, 71);"><span class="p-r-5">Tổng số
                            tiền</span>
                        <span>1000.00 ₫ </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script src="theme/frontend/js/win.js" defer></script>
@endsection