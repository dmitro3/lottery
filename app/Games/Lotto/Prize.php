<?php

namespace App\Games\Lotto;

use App\Games\Plinko\Enums\Bag;
use App\Games\Plinko\Enums\BallType;
use App\Models\Games\Lotto\GameLottoPlayUserBet;
use App\Models\Games\Plinko\GamePlinkoPath;
use App\Models\Games\Plinko\GamePlinkoUserBet;
use App\Models\Games\Plinko\GamePlinkoUserBetDetail;

class Prize
{
    private $currentGameRecord;
    private $totalBetMoney = 0;
    private $groupResultByGames = [];
    public function __construct($currentGameRecord)
    {
        $this->currentGameRecord  = $currentGameRecord;
    }
    public function calculate()
    {
        $prizeGameCollection = new PrizeGameCollection($this->currentGameRecord);
        $prizeGameCollection->generate();
        $prizeGameCollection->calculate();
    }
}
