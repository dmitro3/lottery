<?php

namespace App\Games\Lotto\Types;

use App\Games\Lotto\TableResult;
use Arr;

class BaoLo2So extends ATypeGame
{
    public function checkBet(TableResult $tableResult, $bet)
    {
        $numbers = explode(',', $bet->number);
        $datas = $tableResult->getTwoNumResultArray();
        $result = [];
        foreach ($datas as $data) {
            foreach ($numbers as $number) {
                if ($data == $number) {
                    $result[] = $number;
                }
            }
        }
        return $result;
    }
}
