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
    public function calcPrize($numBall, $bagValue)
    {
        return $numBall * $this->getBetAmount() * $bagValue;
    }
}
