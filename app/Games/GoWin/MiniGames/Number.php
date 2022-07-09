<?php
namespace App\Games\GoWin\MiniGames;
use App\Games\GoWin\Contracts\GoWinMiniGameInterface;
class Number extends MiniGame implements GoWinMiniGameInterface
{
    public $miniGameName = 'number';
    public $miniGamePreviewName = 'Số';
    public $validValue = [0,1,2,3,4,5,6,7,8,9];
    public $numberColorHistory = [
        0 => 'red',
        1 => 'green',
        2 => 'red',
        3 => 'green',
        4 => 'red',
        5 => 'green',
        6 => 'red',
        7 => 'green',
        8 => 'red',
        9 => 'green'
    ];

    public function isWin($number)
    {
        return $number == $this->value;
    }
    public function calculationAmountWin($number,$amountBet)
    {
        return $amountBet*10;
    }
    public function getHistoryHtml($winNumber)
    {
        return vsprintf('<span class="%s">%s</span>',[$this->numberColorHistory[$winNumber],$winNumber]);
    }
}