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
        $bets = $this->gamePlinkoUserBets()->where('game_win_user_bet_status_id', GamePlinkoUserBet::STATUS_WAIT_RESULT)->with('user')->get();
        foreach ($bets as $k => $bet) {
            $type = (int)$bet->type;
            $ball = BallType::getByValue($type);
            $baseAmount = $ball->getBetAmount();
            $total = 0;
            $details = $bet->gamePlinkoUserBetDetails()->get();
            foreach ($details as $kdetail => $detail) {
                $amount = $baseAmount * 1;
                $bagValue = $detail->bag_value;
                $subtotal = $bagValue * $amount;
                $total += $subtotal;
                $detail->is_checked = 1;
                $detail->amount_base = $baseAmount;
                $detail->amount = $amount;
                $detail->return_amount = $subtotal;
                $detail->save();
            }
            $status = $total > $bet->amount ? GamePlinkoUserBet::STATUS_WIN : GamePlinkoUserBet::STATUS_LOSE;
            $bet->game_win_user_bet_status_id = $status;
            $bet->return_amount = $total;
            $bet->save();
            $user = $bet->user;
            $reason = vsprintf('Cộng tiền thắng game Plinko. Phiên giao dịch %s.', [$this->id]);
            $user->changeMoney($total, $reason, WalletTransactionType::PLUS_MONEY_BET_GAME_PLINKO, $bet->id);
        }
        $this->is_end = 1;
        $this->save();
    }
    public function buildAdminHistoryData()
    {
        $gameWinUserBets = $this->gamePlinkoUserBets()->select('mode',\DB::raw('sum(amount) as total_amount_bet'))
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
