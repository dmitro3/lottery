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
    public $sizeHistoryPreview = [
        0 => ['color'=>'green','name'=>'Nhỏ'],
        1 => ['color'=>'green','name'=>'Nhỏ'],
        2 => ['color'=>'green','name'=>'Nhỏ'],
        3 => ['color'=>'green','name'=>'Nhỏ'],
        4 => ['color'=>'green','name'=>'Nhỏ'],
        5 => ['color'=>'yellow','name'=>'Lớn'],
        6 => ['color'=>'yellow','name'=>'Lớn'],
        7 => ['color'=>'yellow','name'=>'Lớn'],
        8 => ['color'=>'yellow','name'=>'Lớn'],
        9 => ['color'=>'yellow','name'=>'Lớn']
    ];
    public function isWin($number)
    {
        return in_array($number,$this->sizeNumberMap[$this->value] ?? []);
    }
    public function calculationAmountWin($number,$amountBet)
    {
        return $amountBet*($this->sizeMultiple[$this->value] ?? 0);
    }
    public function getHistoryHtml($winNumber)
    {
        $winNumber = (int)$winNumber;
        if (!isset($this->sizeHistoryPreview[$winNumber])) {
            return '';
        }
        return vsprintf('<span class="%s">%s</span>',[$this->sizeHistoryPreview[$winNumber]['color'],$this->sizeHistoryPreview[$winNumber]['name']]);
    }
}