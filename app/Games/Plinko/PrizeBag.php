<?php

namespace App\Games\Plinko;

use App\Games\Plinko\Enums\Bag;
use App\Games\Plinko\Enums\BallType;

class PrizeBag
{
    private $ballType;
    private $numBall;
    private $fixedBall;
    private $totalPrize;
    private $results = [];
    private $sum = 0;
    private $bags = [];

    public function __construct($type, $numBall, $fixedBall, $totalPrize)
    {
        $this->fixedBall = $fixedBall;
        $this->numBall = $numBall;
        $this->totalPrize = $totalPrize;
        $this->ballType = BallType::getByValue($type);
        $this->bags = Bag::getListDescSorted();;
    }
    public function calcBagPrizes()
    {
        if ($this->totalPrize < 0) throw new \Exception('Prize must larger than 0!');
        $this->calcPivotBagPrize();
        $this->calcOtherBagPrize();
    }
    protected function calcPivotBagPrize()
    {
        $betAmount = $this->ballType->getBetAmount();

        $count = 0;
        foreach ($this->bags as $key => $bagValue) {
            $count++;
            $round = (int)($this->totalPrize / $bagValue / $betAmount);
            if ($round > $this->fixedBall) {
                $this->results[$key] = [
                    'num_ball' => $this->fixedBall,
                    'bag_value' => $bagValue
                ];
                $this->sum += $this->ballType->calcPrize($this->fixedBall, $bagValue);
                array_splice($this->bags, 0, $count);
                break;
            }
        }
    }
    protected function calcOtherBagPrize()
    {
        $max = $this->numBall - $this->fixedBall;
        for ($i = 0; $i < $max; $i++) {
            $key = array_rand($this->bags);
            $bagValue = $this->bags[$key];
            if (array_key_exists($key, $this->results)) {
                $tmp = $this->results[$key];
                $tmp['num_ball']++;
                $this->results[$key] = $tmp;
            } else {
                $this->results[$key] = [
                    'num_ball' => 1,
                    'bag_value' => $bagValue
                ];
            }
            $this->sum += $this->ballType->calcPrize(1, $bagValue);
        }
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
     * Get the value of results
     *
     * @return  mixed
     */
    public function getResults()
    {
        return $this->results;
    }
}
