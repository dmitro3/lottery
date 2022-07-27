<?php

namespace App\Http\Controllers\Games;

use App\Games\BaseLotto\Lotto;

class GameLottoController extends GameBaseLottoController
{
    public function __construct()
    {
        parent::__construct();
        $this->gameLottoProvider = new Lotto();
    }
}
