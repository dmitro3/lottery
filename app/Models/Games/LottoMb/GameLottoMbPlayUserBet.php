<?php

namespace App\Models\Games\LottoMb;

use App\Models\Games\Lotto\GameLottoPlayUserBet;

class GameLottoMbPlayUserBet extends GameLottoPlayUserBet
{
    public function gameLottoType()
    {
        return $this->belongsTo(GameLottoMbType::class, 'game_lotto_type_id');
    }
}
