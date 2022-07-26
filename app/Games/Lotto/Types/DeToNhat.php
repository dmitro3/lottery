<?php

namespace App\Games\Lotto\Types;

use App\Games\Lotto\Enums\NoPrize;
use App\Games\Lotto\TableResult;
use App\Models\Games\Lotto\GameLottoType;

class DeToNhat extends ATypeGame
{
    public function __construct(GameLottoType $gameLottoType)
    {
        parent::__construct($gameLottoType);
    }
    public function checkBet(TableResult $tableResult, $bet)
    {
        $numbers = explode(',', $bet->number);
        $datas = $tableResult->getByGiai(NoPrize::DAC_BIET);
        $rootNumber = $datas[0];
        $compareNumber = substr($rootNumber, -2);
        $result = [];
        foreach ($numbers as $number) {
            if ($compareNumber == $number) {
                $result[] = $number;
            }
        }
        return $result;
    }
}
