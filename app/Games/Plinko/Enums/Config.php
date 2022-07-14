<?php

namespace App\Games\Plinko\Enums;

use App\Games\Plinko\Enums\BaseEnum;

class Config extends BaseEnum
{
    public const LAST_POINT_TO_BET  = 25;
    public const NUMBER_TIME_TO_CHECK = 5;

    public const MAXIMUM_BALL = 15;
    public const MINIMUM_BALL = 1;
}
