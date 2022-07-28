<?php

namespace App\Games\Plinko\Enums;

use App\Games\Plinko\Enums\BaseEnum;

class BallType extends BaseEnum
{
    public const NORMAL  = 0;
    public const MID  = 1;
    public const HOT  = 2;


    public function getBetAmount()
    {
        $amount = $this->_getBetAmount();
        $fee = (float)\SettingHelper::getSetting('game_fee', 2);
        $realAmount = $amount - (int)($fee * $amount / 100);
        return $realAmount;
    }
    private function _getBetAmount()
    {
        switch ($this->getValue()) {
            case BallType::NORMAL:
                return 1000;
            case BallType::MID:
                return 10000;
            case BallType::HOT:
                return 100000;
        }
        return 0;
    }

    public function getBetAmountText()
    {
        switch ($this->getValue()) {
            case BallType::NORMAL:
                return '1k';
            case BallType::MID:
                return '10k';
            case BallType::HOT:
                return '100k';
        }
        return 0;
    }
    public function calcPrize($numBall, $bagValue)
    {
        return $numBall * $this->getBetAmount() * $bagValue;
    }
}
