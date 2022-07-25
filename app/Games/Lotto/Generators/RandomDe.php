<?php

namespace App\Games\Lotto\Generators;

use App\Games\Lotto\PrizeOneGame;

class RandomDe extends BaseRandom
{
    protected $gameDe;
    public function __construct($includeTwoNumbers, $excludeTwoNumbers, $gameDe)
    {
        parent::__construct($includeTwoNumbers, $excludeTwoNumbers);
        $this->gameDe = $gameDe;
    }
    public function random()
    {
        $num = -1;
        if (!$this->gameDe) {
            return $num;
        }
        $ins = $this->gameDe->getIncludeNumbers();

        if (count($ins) > 0) {
            $num = array_rand($ins);
        } else {
            $rands = $this->randomNumber();
            $num = $rands[0];
        }
        return $num;
    }
}
