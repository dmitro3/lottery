<?php

namespace App\Http\Controllers\Games;

use App\Games\BaseLotto\LottoMb;

class GameLottoMBController extends GameLottoController
{
    public function __construct()
    {
        parent::__construct();
        $this->gameLottoProvider = new LottoMb();
    }
}
