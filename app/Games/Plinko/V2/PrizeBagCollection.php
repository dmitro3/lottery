<?php

namespace App\Games\Plinko\V2;

use App\Games\Plinko\Enums\Bag;
use App\Games\Plinko\Enums\BallType;
use App\Models\Games\Plinko\GamePlinkoPath;
use App\Models\Games\Plinko\GamePlinkoUserBetDetail;
use \vanhenry\helpers\helpers\SettingHelper as Setting;


class PrizeBagCollection
{
    protected $min = 0;
    protected $max = 0;
    protected $sum = 0;
    protected $prizeBags = [];

    protected $configKeys = [
        "plinko_percent_prize_ball_1000",
        "plinko_percent_prize_ball_500",
        "plinko_percent_prize_ball_100",
        "plinko_percent_prize_ball_10",
        "plinko_percent_prize_ball_5",
        "plinko_percent_prize_ball_11",
        "plinko_percent_prize_ball_1",
        "plinko_percent_prize_ball_05",
        "plinko_percent_prize_ball_01"
    ];
    public function generate()
    {
        $bags = Bag::getConstList();
        $bagKeys = array_keys($bags);
        $from = 0;

        foreach ($bagKeys as $key => $bag) {
            $num = 10 * Setting::getSetting($this->configKeys[$key], 0);
            $itemFrom = $from;
            $itemTo = $from + $num;
            $from = $itemTo;

            $prizeBag = new PrizeBag($bag);
            $prizeBag->setFrom($itemFrom);
            $prizeBag->setTo($itemTo);
            $prizeBag->setRange($num);
            $prizeBag->setBagValue($bags[$bag]);

            $this->prizeBags[] = $prizeBag;

            if ($key == 0) {
                $this->min = $itemFrom;
            }
            if ($key == count($bagKeys) - 1) {
                $this->max = $itemTo;
            }
            $this->sum += $num;
        }
    }


    /**
     * Get the value of max
     *
     * @return  mixed
     */
    public function getMax()
    {
        return $this->max;
    }

    /**
     * Get the value of min
     *
     * @return  mixed
     */
    public function getMin()
    {
        return $this->min;
    }

    /**
     * Get the value of bags
     *
     * @return  mixed
     */
    public function getBags()
    {
        return $this->bags;
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
     * Get the value of prizeBags
     *
     * @return  mixed
     */
    public function getPrizeBags()
    {
        return $this->prizeBags;
    }

    /**
     * Set the value of prizeBags
     *
     * @param   mixed  $prizeBags  
     *
     * @return  self
     */
    public function setPrizeBags($prizeBags)
    {
        $this->prizeBags = $prizeBags;
        return $this;
    }
}
