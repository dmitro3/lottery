<?php

namespace App\Games\LottoMb;

use App\Games\Lotto\Prize;

class PrizeMb extends Prize
{
    protected $currentGameRecord;
    public function __construct($currentGameRecord)
    {
        $this->currentGameRecord  = $currentGameRecord;
    }
    public function calculate()
    {
        $prizeGameCollection = new PrizeGameMbCollection($this->currentGameRecord);
        $prizeGameCollection->generate();
        $prizeGameCollection->calculate();
    }
}
