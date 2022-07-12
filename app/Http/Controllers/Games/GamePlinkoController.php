<?php

namespace App\Http\Controllers\Games;

use App\Games\Plinko\Enums\Bag;
use App\Games\Plinko\Enums\BallType;
use App\Games\Plinko\Prize;
use App\Models\Games\Plinko\GamePlinkoPath;
use App\Models\Games\Plinko\GamePlinkoRecord;
use App\Models\Games\Plinko\GamePlinkoType;
use App\Models\Games\Plinko\GamePlinkoUserBet;
use App\Models\Games\Plinko\GamePlinkoUserBetDetail;

class GamePlinkoController extends BaseGameController
{
    public function index($request)
    {
        $showBaseLoading = true;
        $user = \Auth::user();
        return view('games.plinko.index', compact('user', 'showBaseLoading'));
    }
    // private function generateBetResults()
    // {
    //     $currentGameRecord = GamePlinkoType::find(1)->getCurrentGameRecord();
    //     $records = GamePlinkoUserBet::where('game_plinko_record_id', $currentGameRecord->id)->get();
    //     $gameRequests = [
    //         BallType::NORMAL => 0,
    //         BallType::MID => 0,
    //         BallType::HOT => 0
    //     ];
    //     foreach ($records as $key => $record) {
    //         $type = $record->type;
    //         $qty = $record->qty;
    //         $gameRequests[$type] += $qty;
    //     }
    //     $prize = new Prize($gameRequests);
    //     $prize->generateBetDetails($currentGameRecord->id);
    // }
}
