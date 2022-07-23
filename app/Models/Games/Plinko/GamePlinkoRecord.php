<?php

namespace App\Models\Games\Plinko;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel;
use App\Models\WalletTransactionType;
use App\Games\GoWin\Factories\MiniGameFactory;
use App\Games\Plinko\Enums\BallType;
use Exception;

class GamePlinkoRecord extends BaseModel
{
    public function getTimeRemaining()
    {
        return $this->end_time - now()->timestamp;
    }
    public function gamePlinkoUserBets()
    {
        return $this->hasMany(GamePlinkoUserBet::class);
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
        $gameWinUserBets = $this->gamePlinkoUserBets()->select('mode', \DB::raw('sum(amount) as total_amount_bet'))
            ->groupBy('mode')
            ->get();
        $ret = [];
        foreach ($gameWinUserBets as $item) {
            $ret[$item->mode] = $item->total_amount_bet;
        }
        $ret['total_bet'] = $gameWinUserBets->sum('total_amount_bet');
        return $ret;
    }
}
