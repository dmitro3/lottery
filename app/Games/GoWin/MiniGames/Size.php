<?php
namespace App\Games\GoWin\MiniGames;
use App\Games\GoWin\Contracts\GoWinMiniGameInterface;
class Size extends MiniGame implements GoWinMiniGameInterface
{
    public $miniGameName = 'size';
    public $miniGamePreviewName = 'Lớn nhỏ';
    public $validValue = ['big','small'];
    public $valueNameMap = ['big'=>'Lớn','small'=>'Nhỏ'];
    protected $sizeNumberMap = [
        'big' => [5,6,7,8,9],
        'small' => [0,1,2,3,4],
    ];
    protected $sizeMultiple = [
        'big' => 2,
        'small' => 2,
    ];
    public function isWin($number)
    {
        return in_array($number,$this->sizeNumberMap[$this->value] ?? []);
    }
    public function calculationAmountWin($number,$amountBet)
    {
        return $amountBet*($this->sizeMultiple[$this->value] ?? 0);
    }
}