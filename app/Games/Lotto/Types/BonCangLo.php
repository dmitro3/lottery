<?php

namespace App\Games\Lotto\Types;

use App\Games\Lotto\Renderers\Renderer00009999;
use App\Games\Lotto\TableResult;

class BonCangLo extends BonCangDe
{
    public function checkBet(TableResult $tableResult, $bet)
    {
        $numbers = explode(',', $bet->number);
        $datas = $tableResult->getFourNumResultArray();
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
