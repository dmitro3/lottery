<?php

namespace App\Games\Lotto\Base\Abstracts;

use App\Games\BaseLotto\BaseLotto;
use App\Games\Lotto\Base\Contracts\Lottoable;

abstract class ALottoable implements Lottoable
{
    protected BaseLotto $gameLottoProvider;
    public function __construct()
    {
        $this->gameLottoProvider = $this->getGameLottoProvider();
    }
}
