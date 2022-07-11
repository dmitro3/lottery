<?php

namespace App\Games\Plinko;

use App\Games\Plinko\Enums\Bag;
use App\Games\Plinko\Enums\BallType;

class Prize
{
    private $gameRequests;
    private $total = [];
    private $sum = 0;
    private $percentWin = 0;
    private $percentConvertToPrize = 0;
    private $totalPrize = 0;

    // Phần trăm bag cố định. Tư tưởng: ví dụ có 10 bi thì chỉ fix cố định giải lớn nhất cho x%, còn lại là random
    private $fixedPercent = 0;

    public function __construct($gameRequests, $percentWin = 50, $percentConvertToPrize = 40, $fixedPercent = 80)
    {
        $this->gameRequests = $gameRequests;
        $this->calculateTotal();
        $this->percentWin = $percentWin / 100;
        $this->percentConvertToPrize = $percentConvertToPrize / 100;
        $this->fixedPercent = $fixedPercent / 100;
    }

    private function calculateTotal()
    {

        foreach ($this->gameRequests as $key => $game) {
            $this->sum += $this->total[$key] = $game * BallType::getByValue($key)->getBetAmount();
        }
    }
    public function calculatePercent($type)
    {
        $tmp = array_key_exists($type, $this->total) ? $this->total[$type] : 0;
        return $tmp / $this->sum;
    }

    public function calculateTotalPrize()
    {
        return $this->totalPrize = $this->percentWin * $this->sum * $this->percentConvertToPrize;
    }

    public function calculateTotalPrizeByType($type)
    {
        return $this->calculatePercent($type) * $this->calculateTotalPrize();
    }



    public function calculateResultBags()
    {
        $listSorted = BallType::getListDescSorted();

        $totalPrize = $this->calculateTotalPrize();
        $result = [];
        foreach ($listSorted as $ballType => $ballValue) {
            $numBall = $this->gameRequests[$ballValue];
            $fixedBall = (int) ($numBall * $this->fixedPercent);
            $prizeBag = new PrizeBag($ballValue, $numBall, $fixedBall, $totalPrize);
            $prizeBag->calcBagPrizes();
            $totalPrize -= $prizeBag->getSum();
            $result[$ballValue] = $prizeBag;
        }
        return $result;
    }

    /**
     * Get the value of sum
     *
     * @return  mixed
     */
    public function getSum()
    {
        return $this->sum;
    }

    /**
     * Set the value of sum
     *
     * @param   mixed  $sum  
     *
     * @return  self
     */
    public function setSum($sum)
    {
        $this->sum = $sum;
        return $this;
    }
}
