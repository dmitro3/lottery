<?php
namespace App\Games\GoWin\MiniGames;
use App\Games\GoWin\Contracts\GoWinMiniGameInterface;
use App\Models\Games\Win\{
    GameWinUserBet,
    GameWinUserBetStatus
};
class MiniGame implements GoWinMiniGameInterface
{
    public $miniGameName = '';
    public $miniGamePreviewName = '';
    public $value;
    public $validValue = [];
    public $valueNameMap = [];
    public function setValue($value)
    {
        $this->value = $value;
    }
    public function validateValue()
    {
        return in_array($this->value,$this->validValue);
    }
    public function toDatabase($gameWinType,$currentGame,$user,$qty,$amoutItem)
    {
        $itemGameWinUserBet = new GameWinUserBet;
        $itemGameWinUserBet->user_id = $user->id;
        $itemGameWinUserBet->game_win_type_id = $gameWinType->id;
        $itemGameWinUserBet->game_win_record_id = $currentGame->id;
        $itemGameWinUserBet->mini_game = $this->miniGameName;
        $itemGameWinUserBet->select_value = $this->value;
        $itemGameWinUserBet->qty = $qty;
        $itemGameWinUserBet->amount_base = $amoutItem->money;
        $itemGameWinUserBet->amount = $amoutItem->money * $qty;
        $itemGameWinUserBet->return_amount = 0;
        $itemGameWinUserBet->game_win_user_bet_status_id = GameWinUserBetStatus::STATUS_WAIT_RESULT;
        $itemGameWinUserBet->is_returned = 0;
        $itemGameWinUserBet->created_at = now();
        $itemGameWinUserBet->updated_at = now();
        $itemGameWinUserBet->save();
        return $itemGameWinUserBet;
    }
    public function getValuePreviewName()
    {
        return isset($this->valueNameMap[$this->value]) ? $this->valueNameMap[$this->value]:$this->value;
    }
    public function isWin($number)
    {
        return false;
    }
    public function calculationAmountWin($number,$amountBet)
    {
        return 0;
    }
    public function getHistoryHtml($winNumber)
    {
        return '';
    }
}