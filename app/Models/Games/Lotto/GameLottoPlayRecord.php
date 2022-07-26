<?php

namespace App\Models\Games\Lotto;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel;
use Exception;

class GameLottoPlayRecord extends BaseModel
{
    public function getTimeRemaining()
    {
        return $this->end_time - now()->timestamp;
    }
    public function gameLottoPlayUserBets()
    {
        return $this->hasMany(GameLottoPlayUserBet::class);
    }

    public function end()
    {
        $this->fresh();
        if ($this->is_end == 1) {
            return false;
        }
        $this->is_end = 1;
        $this->save();
    }
}
