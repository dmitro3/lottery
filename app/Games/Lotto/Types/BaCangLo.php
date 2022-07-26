<?php

namespace App\Games\Lotto\Types;

use App\Games\Lotto\Renderers\Renderer0099;
use App\Games\Lotto\TableResult;

class BaCangLo extends BaCangDe
{
    public function checkBet(TableResult $tableResult, $bet)
    {
        $numbers = explode(',', $bet->number);
        $datas = $tableResult->getThreeNumResultArray();
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
