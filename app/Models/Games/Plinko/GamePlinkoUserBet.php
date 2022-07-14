<?php

namespace App\Models\Games\Plinko;

use App\Games\Plinko\Enums\BallType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel;
use App\Models\User;

class GamePlinkoUserBet extends BaseModel
{
    const STATUS_WAIT_RESULT = 1;
    const STATUS_LOSE = 2;
    const STATUS_WIN = 3;

    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function toDatabase($user, $currentGameRecord, BallType $ball, $mode, $qty, $totalMoney)
    {
        $baseAmount = $ball->getBetAmount();
        $bet = new static();
        $bet->user_id = $user->id;
        $bet->game_plinko_type_id = 1;
        $bet->game_plinko_record_id = $currentGameRecord->id;
        $bet->type = $ball->getValue();
        $bet->mode = $mode;
        $bet->qty = $qty;
        $bet->amount_base = $baseAmount;
        $bet->amount = $baseAmount * $qty;
        $bet->return_amount = 0;
        $bet->game_win_user_bet_status_id = static::STATUS_WAIT_RESULT;
        $bet->save();
        return $bet;
    }
    public function gamePlinkoUserBetDetails()
    {
        return $this->hasMany(GamePlinkoUserBetDetail::class);
    }
}
