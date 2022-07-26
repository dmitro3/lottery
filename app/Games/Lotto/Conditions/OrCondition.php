<?php

namespace App\Games\Lotto\Conditions;

class OrCondition extends NumberCondition
{
    public function getNumbers()
    {
        $number = $this->getRealNumbers();
        $count = rand(0, count($number) - 1);
        array_splice($number, 0, $count);
        return array_map(function ($item) {

            if (strlen($item) > 2) {
                $item =  substr($item, strlen($item) - 2, 2);
            }
            return $item;
        }, $number);
    }
}
