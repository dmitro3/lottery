<?php

namespace App\Games\Lotto\Types;

use App\Games\Lotto\Contracts\ITypeGame;
use App\Games\Lotto\Renderers\Renderer0099;
use App\Models\Games\Lotto\GameLottoType;
use Illuminate\Support\Arr;

abstract class ATypeGame implements ITypeGame
{
    protected GameLottoType $gameLottoType;
    private $includeNumbers = [];
    private $excludeNumbers = [];
    public function __construct(GameLottoType $gameLottoType)
    {
        $this->gameLottoType = $gameLottoType;
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
            foreach ($statisticList as $key => $rate) {
                if ($rate > $maxRate) {
                    $this->excludeNumbers[][$key] = $rate;
                } else {
                    $this->includeNumbers[][$key] = $rate;
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
            $rate = $money / (count($numbers) * $amount_base);
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
