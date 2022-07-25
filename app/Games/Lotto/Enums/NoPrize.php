<?php

namespace App\Games\Lotto\Enums;

use App\Games\Plinko\Enums\BaseEnum;

class NoPrize extends BaseEnum
{
    const DAC_BIET = 0;
    const NHAT = 1;
    const NHI = 2;
    const BA = 3;
    const BON = 4;
    const NAM = 5;
    const SAU = 6;
    const BAY = 7;
    const ALL = 1000;

    public function getNumPrizeCount()
    {
        switch ($this->getValue()) {
            case static::DAC_BIET:
            case static::NHAT:
                return 1;
            case static::NHI:
                return 2;
            case static::BA:
            case static::NAM:
                return 6;
            case static::BON:
            case static::BAY:
                return 4;
            case static::SAU:
                return 3;
            default:
                return 0;
        }
    }
}
