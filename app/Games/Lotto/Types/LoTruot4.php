<?php

namespace App\Games\Lotto\Types;

use App\Games\Lotto\Conditions\AndCondition;
use App\Games\Lotto\Conditions\OrCondition;
use App\Games\Lotto\Renderers\Renderer000999;
use Arr;

class LoTruot4 extends LoXien2
{
    public function devideNumber($gameLottoPlayUserBets, $totalPrize)
    {
        $win = $this->gameLottoType->win;
        $maxRate = $totalPrize / $win;
        $statisticList = $this->statisticNumber($gameLottoPlayUserBets);
        if ($maxRate == 0) {
            $this->excludeNumbers = $statisticList;
        } else {
            foreach ($statisticList as $key => $condition) {
                if ($condition->getRate() > $maxRate) {
                    $orCondition = new OrCondition($condition->getName(), $condition->getRate(), $condition->getNumbers());
                    $this->includeNumbers[$key] = $orCondition;
                } else {
                    $this->excludeNumbers[$key] = $condition;
                }
            }
        }
    }


    protected function getRateNumber($money, $numbers, $amount_base)
    {
        return $money / ($amount_base);
    }
}
