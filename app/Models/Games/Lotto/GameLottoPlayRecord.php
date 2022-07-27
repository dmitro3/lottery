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
    public function buildAdminHistoryData()
    {
        $gameWinUserBets = $this->gameLottoPlayUserBets()->select('game_lotto_type_id',\DB::raw('sum(amount) as total_amount_bet'))
                                                ->groupBy('game_lotto_type_id')
                                                ->get();
        $ret = [];
        foreach ($gameWinUserBets as $item) {
            $ret[$item->game_lotto_type_id] = $item->total_amount_bet;
        }
        $ret['total_bet'] = $gameWinUserBets->sum('total_amount_bet');
        return $ret;
    }
}
