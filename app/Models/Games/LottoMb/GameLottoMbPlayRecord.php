<?php

namespace App\Models\Games\LottoMb;

use App\Models\Games\Lotto\GameLottoPlayRecord;

class GameLottoMbPlayRecord extends GameLottoPlayRecord
{
    public function gameLottoPlayUserBets()
    {
        return $this->hasMany(GameLottoMbPlayUserBet::class, 'game_lotto_play_record_id');
    }
}
