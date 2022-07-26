<?php

namespace App\Games\Lotto\Generators;

use App\Games\Lotto\PrizeOneGame;

class RandomGiai7 extends BaseRandom
{
    protected $gameGiai7;
    public function __construct($commonRandom, $gameGiai7)
    {
        parent::__construct($commonRandom);
        $this->gameGiai7 = $gameGiai7;
    }
    public function random()
    {
        $num = -1;
        if (!$this->gameGiai7) {
            return $num;
        }
        $ins = $this->gameGiai7->getIncludeArrayNumbers();
        if (count($ins) > 0) {
            $key = array_rand($ins);
            $num = $ins[$key];
            $this->commonRandom->unsetInclude($num);
        } else {
            $rands = $this->commonRandom->randomNumber();
            $num = $rands[0];
        }
        return $num;
    }
}
