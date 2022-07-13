<?php

namespace App\Models\Games\Plinko;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel;
use App\Models\WalletTransactionType;
use App\Games\GoWin\Factories\MiniGameFactory;
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
        $bets = $this->gamePlinkoUserBets()->get();
        foreach ($bets as $k => $bet) {
            $total = 0;
            $details = $bet->gamePlinkoUserBetDetails()->with('user')->get();
            foreach ($details as $kdetail => $detail) {
                
            }
            
        }
        // $listUserBet = $this->gameWinUserBet()
        //     ->whereHas('user')
        //     ->with('user')
        //     ->where('game_win_user_bet_status_id', GameWinUserBetStatus::STATUS_WAIT_RESULT)
        //     ->where('is_returned', 0)
        //     ->get();
        // foreach ($listUserBet as $itemUserBet) {
        //     $miniGame = MiniGameFactory::getMiniGame($itemUserBet->mini_game);
        //     if (!isset($miniGame)) {
        //         continue;
        //     }
        //     $miniGame->setValue($itemUserBet->select_value);
        //     if ($miniGame->isWin($this->win_number)) {
        //         $amountReturnUser = $miniGame->calculationAmountWin($this->win_number, $itemUserBet['amount']);
        //         $user = $itemUserBet->user;
        //         $reason = vsprintf('Cộng tiền thắng game GoWin. Phiên giao dịch %s %s.', [$this->id, isset($this->gameWinType) ? '(' . $this->gameWinType->name . ')' : '']);
        //         $user->changeMoney($amountReturnUser, $reason, WalletTransactionType::PLUS_MONEY_WIN_GAME_GOWIN, $itemUserBet->id);
        //         $itemUserBet->return_amount = $amountReturnUser;
        //         $itemUserBet->is_returned = 1;
        //         $itemUserBet->game_win_user_bet_status_id = GameWinUserBetStatus::STATUS_WIN;
        //         $itemUserBet->save();
        //     } else {
        //         $itemUserBet->game_win_user_bet_status_id = GameWinUserBetStatus::STATUS_LOSE;
        //         $itemUserBet->save();
        //     }
        // }
        $this->is_end = 1;
        $this->save();
    }
}
