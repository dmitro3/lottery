<?php
namespace App\Http\Controllers\Games;
use \Auth;
use App\Models\Games\Win\{
    GameWinType,
    GameWinMultiple,
    GameWinMoneyItem
};
class GameWinController extends BaseGameController
{
    public function index($request)
    {
        // $listGameWinType = GameWinType::get();
        // foreach ($listGameWinType as $key => $itemGameWinType) {
        //     $itemGameWinType->renderGameRecord();
        // }
        $value = $request->cookie('switch_audio');
        $activeAudio = isset($_COOKIE['switch_audio']) && $_COOKIE['switch_audio'] == 'true';
        $listGameWinType = GameWinType::where('act',1)->orderBy('ord','asc')->get();
        $listGameWinMultiple = GameWinMultiple::where('act',1)->orderBy('ord','asc')->get();
        $listGameWinMoneyItem = GameWinMoneyItem::where('act',1)->orderBy('ord','asc')->get();
        return view('games.win.index',compact('listGameWinType','listGameWinMultiple','listGameWinMoneyItem','activeAudio'));
    }
}