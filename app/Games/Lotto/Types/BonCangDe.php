<?php

namespace App\Games\Lotto\Types;

use App\Games\Lotto\Enums\NoPrize;
use App\Games\Lotto\Renderers\Renderer00009999;
use App\Games\Lotto\TableResult;

class BonCangDe extends BaCangDe
{

    public function renderHtml()
    {
        $renderer = new Renderer00009999;
        return $renderer->renderHtml();
    }
    public function checkBet(TableResult $tableResult, $bet)
    {
        $numbers = explode(',', $bet->number);
        $datas = $tableResult->getByGiai(NoPrize::DAC_BIET);
        $rootNumber = $datas[0];
        $compareNumber = substr($rootNumber, -4);
        $result = [];
        foreach ($numbers as $number) {
            if ($compareNumber == $number) {
                $result[] = $number;
            }
        }
        return $result;
    }
}
