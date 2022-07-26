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
        $num = $this->commonRandom->randomNumberWithExtraInclude($ins, 0);

        return $num;
    }
}
