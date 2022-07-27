<?php

namespace App\Models\Games\LottoMb;

use App\Models\Games\Lotto\GameLottoTableResult;

class GameLottoMbTableResult extends GameLottoTableResult
{

    public function gameLottoPlayRecords()
    {
        return $this->hasMany(GameLottoMbPlayRecord::class, 'game_lotto_play_record_id');
    }
}
