<?php

namespace App\Games\Lotto\Types;

use App\Games\Lotto\Conditions\OrCondition;
use App\Games\Lotto\Contracts\ITypeGame;
use App\Games\Lotto\Enums\NoPrize;
use App\Games\Lotto\Renderers\Renderer0099;
use App\Models\Games\Lotto\GameLottoType;
use Illuminate\Support\Arr;

abstract class ATypeGame implements ITypeGame
{
    protected GameLottoType $gameLottoType;
    protected $includeNumbers = [];
    protected $excludeNumbers = [];
    protected $noPrize;

    public function __construct(GameLottoType $gameLottoType)
    {
        $this->gameLottoType = $gameLottoType;
        $this->noPrize = NoPrize::ALL();
    }
    public function renderHtml()
    {
        $renderer = new Renderer0099;
        return $renderer->renderHtml();
    }




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
                    $this->excludeNumbers[$key] = $condition;
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
            foreach ($numbers as $number) {
                if (!Arr::exists($statisticList, $number)) {
                    $number = $number . '';
                    $conditon = new OrCondition($number, $rate, $number);
                    $statisticList[$number] = $conditon;
                } else {
                    $condition = $statisticList[$number];
                    $condition->addRate($rate);
                    $statisticList[$number] = $condition;
                }
            }
        }
        return $statisticList;
    }
    protected function getRateNumber($money, $numbers, $amount_base)
    {
        return $money / (count($numbers) * $amount_base);
    }

    /**
     * Get the value of includeNumbers
     *
     * @return  mixed
     */
    public function getIncludeNumbers()
    {
        return $this->includeNumbers;
    }

    /**
     * Get the value of excludeNumbers
     *
     * @return  mixed
     */
    public function getExcludeNumbers()
    {
        return $this->excludeNumbers;
    }
}
