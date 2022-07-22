<?php

namespace App\Games\Plinko;

use App\Games\Plinko\Enums\Bag;
use App\Games\Plinko\Enums\BallType;
use App\Models\Games\Plinko\GamePlinkoPath;
use App\Models\Games\Plinko\GamePlinkoTotalBet;
use App\Models\Games\Plinko\GamePlinkoUserBet;
use App\Models\Games\Plinko\GamePlinkoUserBetDetail;

class PrizeV2
{

    private function calculateTotalBets($currentGameRecordId)
    {
        $totalbet = (int) GamePlinkoUserBet::where('game_plinko_record_id', $currentGameRecordId)->sum('amount');
        
    }
}
