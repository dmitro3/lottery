<?php

namespace App\Models\Games\LottoMb;

use App\Models\Games\Lotto\GameLottoPlayType;

class GameLottoMbPlayType extends GameLottoPlayType
{

    public function getGameLottoRecordClass()
    {
        return GameLottoMbPlayRecord::class;
    }
    public function gameLottoPlayRecords()
    {
        return $this->hasMany(GameLottoMbPlayRecord::class, 'game_lotto_play_type_id');
    }
}
