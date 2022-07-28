<?php

namespace App\Models\Games\Plinko;

use App\Games\Plinko\Enums\BallType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel;
use App\Models\User;
use App\Models\WalletTransactionType;

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
    public function end(GamePlinkoUserBetDetail $game)
    {
        $amount = $game->amount;
        $returnAmount = $game->return_amount;
        $status = $returnAmount > $amount ? GamePlinkoUserBet::STATUS_WIN : GamePlinkoUserBet::STATUS_LOSE;
        $this->game_win_user_bet_status_id = $status;
        $this->game_plinko_user_bet_status_id = $status;
        $this->return_amount = $returnAmount;
        $this->is_returned = 1;
        $this->is_residual = $game->is_residual;
        $this->is_marketing = $game->is_marketing;
        $this->save();
        $user = $this->user;
        $reason = vsprintf('Cộng tiền thắng game Plinko. Phiên giao dịch %s.', [$this->game_plinko_record_id]);
        $user->changeMoney($returnAmount, $reason, WalletTransactionType::PLUS_MONEY_BET_GAME_PLINKO, $this->id, $this->is_marketing, false);
    }

    public static function toDatabase($user, $currentGameRecord, BallType $ball, $mode, $qty)
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
