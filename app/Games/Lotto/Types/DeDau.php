<?php

namespace App\Games\Lotto\Types;

use App\Games\Lotto\Enums\NoPrize;
use App\Games\Lotto\Renderers\Renderer0099;
use App\Games\Lotto\TableResult;
use App\Models\Games\Lotto\GameLottoType;

class DeDau extends ATypeGame
{
    public function __construct(GameLottoType $gameLottoType)
    {
        parent::__construct($gameLottoType);
    }
    protected function getRateNumber($money, $numbers, $amount_base)
    {
        return $money / (4 * $amount_base);
    }
    public function checkBet(TableResult $tableResult, $bet)
    {
        $numbers = explode(',', $bet->number);
        $datas = $tableResult->getByGiai(NoPrize::BAY);
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
