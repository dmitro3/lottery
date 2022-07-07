<?php
namespace App\Games\GoWin\MiniGames;
use App\Games\GoWin\Contracts\GoWinMiniGameInterface;
class Color extends MiniGame implements GoWinMiniGameInterface
{
    public $miniGameName = 'color';
    public $miniGamePreviewName = 'Màu sắc';
    public $validValue = ['green','violet','red'];
    public $valueNameMap = ['green'=>'Xanh','violet'=>'Tím','red'=>'Đỏ'];
    protected $colorNumberMap = [
        'green' => [1,3,5,7,9],
        'violet' => [0,5],
        'red' => [0,2,4,6,8]
    ];
    protected $colorMultiple = [
        'green' => 2,
        'violet' => 5,
        'red' => 2
    ];
    public function isWin($number)
    {
        return in_array($number,$this->colorNumberMap[$this->value] ?? []);
    }
    public function calculationAmountWin($number,$amountBet)
    {
        return $amountBet*($this->colorMultiple[$this->value] ?? 0);
    }
}