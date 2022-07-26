<?php

namespace App\Games\Lotto\Generators;

use App\Games\Lotto\PrizeOneGame;

class RandomDe extends BaseRandom
{
    protected $gameDe;
    public function __construct($commonRandom, $gameDe)
    {
        parent::__construct($commonRandom);
        $this->gameDe = $gameDe;
    }
    public function random()
    {
        $num = -1;
        if (!$this->gameDe) {
            return $num;
        }
        $ins = $this->gameDe->getIncludeArrayNumbers();
        if (count($ins) > 0) {
            $num = $this->commonRandom->randomNumberWithExtraInclude($ins, 0);
        }
        // else {
        //     $rands = $this->randomNumber();
        //     $num = $rands[0];
        // }
        return $num;
    }
}
