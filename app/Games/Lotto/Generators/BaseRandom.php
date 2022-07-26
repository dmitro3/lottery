<?php

namespace App\Games\Lotto\Generators;

use App\Games\Lotto\PrizeOneGame;

class BaseRandom
{
    protected $commonRandom;
    public function __construct($commonRandom)
    {
        $this->commonRandom = $commonRandom;
    }
}
