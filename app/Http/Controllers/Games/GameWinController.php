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
    public function index()
    {
        $listGameWinType = GameWinType::get();
        foreach ($listGameWinType as $key => $itemGameWinType) {
            $itemGameWinType->renderGameRecord();
        }


        $gameType = 1;
        $gameWinType = GameWinType::find($gameType);
        $gameWinType->renderGameRecord();
        dd($gameWinType);

        $user = Auth::user();
        $listGameWinType = GameWinType::where('act',1)->orderBy('ord','asc')->get();
        $listGameWinMultiple = GameWinMultiple::where('act',1)->orderBy('ord','asc')->get();
        $listGameWinMoneyItem = GameWinMoneyItem::where('act',1)->orderBy('ord','asc')->get();
        return view('games.win.index',compact('listGameWinType','listGameWinMultiple','listGameWinMoneyItem'));
    }
}