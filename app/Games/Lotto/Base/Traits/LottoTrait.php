<?php

namespace App\Games\Lotto\Base\Traits;

use App\Games\BaseLotto\Lotto;

trait LottoTrait
{
    public function getGameLottoProvider()
    {
        return new Lotto();
    }
}
