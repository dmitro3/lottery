<?php

namespace App\Games\LottoMb;

use App\Games\Lotto\Base\BasePrizeGameCollection;
use App\Games\Lotto\Base\Traits\LottoMbTrait;

class PrizeGameMbCollection extends BasePrizeGameCollection
{
    use LottoMbTrait;
    public function generate()
    {
        $generator = $this->makeGenerator();
        $generator->generate();
    }
}
