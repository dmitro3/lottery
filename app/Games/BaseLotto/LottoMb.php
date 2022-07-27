<?php

namespace App\Games\BaseLotto;



class LottoMb extends BaseLotto
{
    function getGamePlayType()
    {
        return GameLottoMbPlayType::class;
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
}
