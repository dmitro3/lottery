<?php

namespace App\Games\Lotto\Types;

use App\Games\Lotto\Enums\NoPrize;
use App\Games\Lotto\Renderers\Renderer0099;
use App\Models\Games\Lotto\GameLottoType;

class DeDau extends ATypeGame
{
    public function __construct(GameLottoType $gameLottoType)
    {
        parent::__construct($gameLottoType);
        $this->noPrize = NoPrize::DAC_BIET();
    }
    protected function getRateNumber($money, $numbers, $amount_base)
    {
        return $money / (4 * $amount_base);
    }
}
