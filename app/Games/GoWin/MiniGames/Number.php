<?php
namespace App\Games\GoWin\MiniGames;
use App\Games\GoWin\Contracts\GoWinMiniGameInterface;
class Number extends MiniGame implements GoWinMiniGameInterface
{
    public $miniGameName = 'number';
    public $miniGamePreviewName = 'Số';
    public $validValue = [0,1,2,3,4,5,6,7,8,9];

    public function isWin($number)
    {
        return $number == $this->value;
    }
    public function calculationAmountWin($number,$amountBet)
    {
        return $amountBet*10;
    }
}