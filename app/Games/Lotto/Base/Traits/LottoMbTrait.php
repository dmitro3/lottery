<?php

namespace App\Games\Lotto\Base\Traits;

use App\Games\BaseLotto\LottoMb;

trait LottoMbTrait
{
    public function getGameLottoProvider()
    {
        return new LottoMb();
    }
}
