<?php

namespace App\Games\Plinko\V2;

use App\Games\Plinko\Enums\Bag;
use App\Games\Plinko\Enums\BallType;
use App\Models\Games\Plinko\GamePlinkoPath;
use App\Models\Games\Plinko\GamePlinkoUserBetDetail;
use \vanhenry\helpers\helpers\SettingHelper as Setting;


class PrizeBagMktCollection extends PrizeBagCollection
{
    protected $configKeys = [
        "plinko_mkt_percent_prize_ball_1000",
        "plinko_mkt_percent_prize_ball_500",
        "plinko_mkt_percent_prize_ball_100",
        "plinko_mkt_percent_prize_ball_10",
        "plinko_mkt_percent_prize_ball_5",
        "plinko_mkt_percent_prize_ball_11",
        "plinko_mkt_percent_prize_ball_1",
        "plinko_mkt_percent_prize_ball_05",
        "plinko_mkt_percent_prize_ball_01"
    ];

    public function randomBag()
    {
        $idx = rand($this->min, $this->max);
        for ($i = 0; $i < count($this->prizeBags); $i++) {
            $prizeBag = $this->prizeBags[$i];
            $from = $prizeBag->getFrom();
            $to = $prizeBag->getTo();
            if ($idx > $from && $idx < $to) {
                $bagName = $prizeBag->getName();
                $bag = Bag::$bagName();
                return $bag;
            }
        }
    }

    private static $prizeBagMarketing;
    public static function getInstance()
    {
        if (!static::$prizeBagMarketing) {
            static::$prizeBagMarketing = new PrizeBagMktCollection();
        }
        static::$prizeBagMarketing->generate();
        return static::$prizeBagMarketing;
    }
}
