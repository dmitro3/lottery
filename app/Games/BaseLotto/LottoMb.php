<?php

namespace App\Games\BaseLotto;

use App\Models\Games\LottoMb\GameLottoMbPlayRecord;
use App\Models\Games\LottoMb\GameLottoMbPlayType;
use App\Models\Games\LottoMb\GameLottoMbPlayUserBet;
use App\Models\Games\LottoMb\GameLottoMbTableResult;

class LottoMb extends BaseLotto
{
    function getGamePlayType()
    {
        return GameLottoMbPlayType::class;
    }
    function getGameRecord()
    {
        return GameLottoMbPlayRecord::class;
    }
    function getGameTableResult()
    {
        return GameLottoMbTableResult::class;
    }
    function getGameUserBet()
    {
        return GameLottoMbPlayUserBet::class;
    }
}
