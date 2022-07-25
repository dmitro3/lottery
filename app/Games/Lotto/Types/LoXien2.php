<?php

namespace App\Games\Lotto\Types;

use App\Games\Lotto\Conditions\AndCondition;
use App\Games\Lotto\Conditions\OrCondition;
use App\Games\Lotto\Renderers\Renderer0099;
use Arr;

class LoXien2 extends ATypeGame
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
                    $orCondition = new OrCondition($condition->getName(), $condition->getRate(), $condition->getRealNumbers());
                    $this->excludeNumbers[$key] = $orCondition;
                } else {
                    $this->includeNumbers[$key] = $condition;
                }
            }
        }
    }
    protected function statisticNumber($gameLottoPlayUserBets)
    {
        $statisticList = [];
        foreach ($gameLottoPlayUserBets as $key => $bet) {
            $number = $bet->numbers;
            $numbers = explode(',', $number);
            $money = $bet->money;
            $amount_base = $bet->amount_base;
            $rate = $this->getRateNumber($money, $numbers, $amount_base);

            $numberName = implode('_', $numbers);
            if (!Arr::exists($statisticList, $numberName)) {
                $condition = new AndCondition($numberName, $rate, $numbers);
                $statisticList[$numberName] = $condition;
            } else {
                $tmpCondition = $statisticList[$numberName];
                $tmpCondition->addRate($rate);
                $statisticList[$numberName] = $tmpCondition;
            }
        }
        return $statisticList;
    }
    protected function getRateNumber($money, $numbers, $amount_base)
    {
        return $money / ($amount_base);
    }
}
