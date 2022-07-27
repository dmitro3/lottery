<?php

namespace App\Games\BaseLotto;

use App\Games\Lotto\Generators\MBGenerator;
use App\Models\Games\Lotto\GameLottoPlayRecord;
use App\Models\Games\Lotto\GameLottoPlayType;
use App\Models\Games\Lotto\GameLottoPlayUserBet;
use App\Models\Games\Lotto\GameLottoTableResult;

class Lotto extends BaseLotto
{
    function getGamePlayType()
    {
        return GameLottoPlayType::class;
    }
    function getGameRecord()
    {
        return GameLottoPlayRecord::class;
    }
    function getGameTableResult()
    {
        return GameLottoTableResult::class;
    }
    function getGameUserBet()
    {
        return GameLottoPlayUserBet::class;
    }
    function getGenerator()
    {
        return MBGenerator::class;
    }
}
