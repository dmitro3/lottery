<?php

namespace App\Games\Lotto\Types;

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
            foreach ($statisticList as $key => $rate) {
                if ($rate > $maxRate) {
                    $this->excludeNumbers[$key] = $rate;
                } else {
                    $this->includeNumbers[$key] = $rate;
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
            $rate = $money / ($amount_base);
            foreach ($numbers as $number) {
                if (!Arr::exists($statisticList, $number)) {
                    $statisticList[$number] = $rate;
                } else {
                    $statisticList[$number] += $rate;
                }
            }
        }
        return $statisticList;
    }
}
