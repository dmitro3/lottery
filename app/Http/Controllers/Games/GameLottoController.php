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

class GameLottoController extends BaseGameController
{
    public function index($request)
    {
        $showBaseLoading = true;
        $user = \Auth::user();
        return view('games.plinko.index', compact('user', 'showBaseLoading'));
    }
}
