<?php

namespace App\Games\Lotto\Types;

use App\Games\Lotto\Enums\NoPrize;
use App\Models\Games\Lotto\GameLottoType;

class DeToNhat extends ATypeGame
{
    public function __construct(GameLottoType $gameLottoType)
    {
        parent::__construct($gameLottoType);
        $this->noPrize = NoPrize::DAC_BIET();
    }
}
