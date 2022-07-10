<?php
namespace App\Http\Controllers\Games;
use realtimemodule\pushserver\Helpers\PushServerHelper;
use \Auth;
use App\Models\Games\Win\{
    GameWinType,
    GameWinMultiple,
    GameWinMoneyItem,
    GameWinUserBet,
};

class GameWinController extends BaseGameController
{
    public function index($request)
    {
        // $this->renderGameWinRecord();
        // foreach (GameWinRecord::get() as $item) {
        //     $item->win_number = rand(0,9);
        //     $item->save();
        // }
        // var_dump(1);die();

        $user = \Auth::user();
        $showBaseLoading = true;
        $activeAudio = isset($_COOKIE['switch_audio']) && $_COOKIE['switch_audio'] == 'true';
        $listGameWinType = GameWinType::where('act',1)->orderBy('ord','asc')->get();
        $listGameWinMultiple = GameWinMultiple::where('act',1)->orderBy('ord','asc')->get();
        $listGameWinMoneyItem = GameWinMoneyItem::where('act',1)->orderBy('ord','asc')->get();
        return view('games.win.index',compact('listGameWinType','listGameWinMultiple','listGameWinMoneyItem','activeAudio','user','showBaseLoading'));
    }
    public function renderGameWinRecord()
    {
        $listGameWinType = GameWinType::get();
        foreach ($listGameWinType as $itemGameWinType) {
            $itemGameWinType->renderGameRecord();
        }
    }
    public function getGameHistory($request)
    {
        $gameWinTypeId = PushServerHelper::unHash($request->game_type ?? '');
        $gameWinType = GameWinType::find($gameWinTypeId);
        if (!isset($gameWinType)) {
            return response()->json(['code'=>100]);
        }
        $listItems = $gameWinType->gameWinRecord()
                                ->where('end_time','<',now()->timestamp)
                                ->orderBy('id','desc')
                                ->paginate(10);
        return response()->json([
            'code' => 200,
            'html' => view('games.win.history_results.game_history_result',compact('listItems'))->render()
        ]);
    }
    public function getGameSupportChart($request)
    {
        $gameWinTypeId = PushServerHelper::unHash($request->game_type ?? '');
        $gameWinType = GameWinType::find($gameWinTypeId);
        if (!isset($gameWinType)) {
            return response()->json(['code'=>100]);
        }
        $listItems = $gameWinType->gameWinRecord()
                                ->where('end_time','<',now()->timestamp)
                                ->orderBy('id','desc')
                                ->paginate(10);
        return response()->json([
            'code' => 200,
            'html' => view('games.win.history_results.support_chart_result',compact('listItems'))->render()
        ]);
    }
    public function getGameUserBetHistory ($request)
    {
        $gameWinTypeId = PushServerHelper::unHash($request->game_type ?? '');
        $gameWinType = GameWinType::find($gameWinTypeId);
        if (!isset($gameWinType)) {
            return response()->json(['code'=>100]);
        }
        $user = \Auth::user();
        $listItems = GameWinUserBet::where('user_id',$user->id)
                                    ->with('gameWinUserBetStatus')
                                    ->where('game_win_type_id',$gameWinType->id)
                                    ->orderBy('id','desc')
                                    ->paginate(10);
        return response()->json([
            'code' => 200,
            'html' => view('games.win.history_results.user_bet_history',compact('listItems'))->render()
        ]);
    }
}