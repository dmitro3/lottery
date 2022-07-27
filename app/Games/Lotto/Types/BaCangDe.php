<?php

namespace App\Games\Lotto\Types;

use App\Games\Lotto\Enums\NoPrize;
use App\Games\Lotto\Renderers\Renderer000999;
use App\Games\Lotto\TableResult;
use App\Models\Games\Lotto\GameLottoType;

class BaCangDe extends ATypeGame
{
    public function __construct(GameLottoType $gameLottoType)
    {
        parent::__construct($gameLottoType);
    }
    public function renderHtml()
    {
        $renderer = new Renderer000999;
        return $renderer->renderHtml();
    }

    public function checkBet(TableResult $tableResult, $bet)
    {
        $numbers = explode(',', $bet->numbers);
        $datas = $tableResult->getByGiai(NoPrize::DAC_BIET);
        $rootNumber = $datas[0];
        $compareNumber = substr($rootNumber, -3);
        $result = [];
        foreach ($numbers as $number) {
            if ($compareNumber == $number) {
                $result[] = $number;
            }
        }
        return $result;
    }
}
