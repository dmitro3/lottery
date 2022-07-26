<?php

namespace App\Games\Lotto\Types;

use App\Games\Lotto\Conditions\AndCondition;
use App\Games\Lotto\Conditions\OrCondition;
use App\Games\Lotto\Renderers\Renderer000999;
use App\Games\Lotto\TableResult;
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
        $this->cleanIncludeNumbers($maxRate);
    }


    protected function getRateNumber($money, $numbers, $amount_base)
    {
        return $money / ($amount_base);
    }
    public function checkBet(TableResult $tableResult, $bet)
    {
        $numbers = explode(',', $bet->number);
        $datas = $tableResult->getTwoNumResultArray();
        $intersect = array_intersect($numbers, $datas);
        return count($intersect) == 0 ? $numbers : [];
    }
}
