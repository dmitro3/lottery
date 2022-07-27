<?php

namespace App\Games\BaseLotto;

use App\Games\LottoMb\Enums\Config;
use App\Games\LottoMb\Generators\MBMbGenerator;
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
    function getGenerator()
    {
        return MBMbGenerator::class;
    }
    function getConfig()
    {
        return Config::class;
    }
}
