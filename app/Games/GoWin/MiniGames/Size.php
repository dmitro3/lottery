<?php
namespace App\Games\GoWin\MiniGames;
use App\Games\GoWin\Contracts\GoWinMiniGameInterface;
class Size extends MiniGame implements GoWinMiniGameInterface
{
    public $miniGameName = 'size';
    public $miniGamePreviewName = 'Lớn nhỏ';
    public $validValue = ['big','small'];
    public $valueNameMap = ['big'=>'Lớn','small'=>'Nhỏ'];
    public $sizeNumberMap = [
        'big'   => [5,6,7,8,9],
        'small' => [0,1,2,3,4],
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
    public $valueImageMap = [
        'big' => 'data:image/png;base64,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',
        'small' => 'data:image/png;base64,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',
    ];
    public static function getSizeMultiple()
    {
        $sizeMultiple = [
            'big'   => (float)\SettingHelper::getSetting('wingo_percent_size_big_refund',1),
            'small' => (float)\SettingHelper::getSetting('wingo_percent_size_small_refund',1)
        ];
        return $sizeMultiple;
    }
    public function isWin($number)
    {
        return in_array($number,$this->sizeNumberMap[$this->value] ?? []);
    }
    public function calculationAmountWin($number,$amountBet)
    {
        $sizeMultiple = self::getSizeMultiple();
        return $amountBet*($sizeMultiple[$this->value] ?? 0);
    }
    public function getHistoryHtml($winNumber)
    {
        $winNumber = (int)$winNumber;
        if (!isset($this->sizeHistoryPreview[$winNumber])) {
            return '';
        }
        return vsprintf('<span class="%s">%s</span>',[$this->sizeHistoryPreview[$winNumber]['color'],$this->sizeHistoryPreview[$winNumber]['name']]);
    }
    public function getUserBetHistoryHtml()
    {
        return vsprintf('<div class="select select-%s">
            <div class="van-image" style="width: 30px; height: 30px;">
                <img src="%s" class="van-image__img">
            </div>
        </div>',[$this->value,$this->valueImageMap[$this->value]]);
    }
}