<?php

namespace App\Games\Plinko\Enums;

use App\Games\Plinko\Enums\BaseEnum;

class Bag extends BaseEnum
{
    public const BAG1 = 1000;
    public const BAG2 = 500;
    public const BAG3 = 100;
    public const BAG4 = 10;
    public const BAG5 = 5;
    public const BAG6 = 1.1;
    public const BAG7 = 1;
    public const BAG8 = 0.5;
    public const BAG9 = 0.1;

    public function getBagIndexs()
    {
        $consts = array_keys(static::getConstList());
        $idx = array_search($this->getName(), $consts);
        $count = count($consts);
        $start = 526;
        $idxs = [];
        $idxs[] = $start + $idx * 2;
        $idxs[] = $start + $idx * 2 + ($count - $idx - 1) * 4;
        return $idxs;
    }
}
