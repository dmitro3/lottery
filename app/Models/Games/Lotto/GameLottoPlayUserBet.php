<?php

namespace App\Models\Games\Lotto;

use App\Games\Plinko\Enums\BallType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel;
use App\Models\User;

class GameLottoPlayUserBet extends BaseModel
{
    const STATUS_WAIT_RESULT = 1;
    const STATUS_LOSE = 2;
    const STATUS_WIN = 3;

    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function gameLottoType()
    {
        return $this->belongsTo(GameLottoType::class);
    }

    public static function toDatabase($user, $currentGameRecord, $gameType, $numbers, $money)
    {
        $bet = new static();
        $bet->user_id = $user->id;
        $bet->game_lotto_type_id = $gameType->id;
        $bet->game_lotto_type_code = $gameType->code;
        $bet->game_lotto_play_type_id = 1;
        $bet->game_lotto_play_record_id = $currentGameRecord->id;
        $bet->money = $money;
        $bet->numbers = implode(',', $numbers);
        $bet->amount_base = $gameType->bet * 1000;
        $bet->amount = $money;
        $bet->return_amount = 0;
        $bet->game_lotto_play_user_bet_status_id = static::STATUS_WAIT_RESULT;
        $bet->save();
        return $bet;
    }
}
