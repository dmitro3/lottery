<?php

namespace App\Games\Plinko\Enums;

use App\Games\Plinko\Enums\BaseEnum;

class Config extends BaseEnum
{
    public const LAST_POINT_TO_BET  = 10;
    public const NUMBER_TIME_TO_CHECK = 5; // Sử dụng ở V1, V2 không sử dụng
    public const LAST_POINT_TO_COUNT_DOWN = 5;

    public const MAXIMUM_BALL = 99;
    public const MINIMUM_BALL = 1;
}
