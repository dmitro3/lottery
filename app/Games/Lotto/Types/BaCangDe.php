<?php

namespace App\Games\Lotto\Types;

use App\Games\Lotto\Enums\NoPrize;
use App\Games\Lotto\Renderers\Renderer000999;
use App\Models\Games\Lotto\GameLottoType;

class BaCangDe extends ATypeGame
{
    public function __construct(GameLottoType $gameLottoType)
    {
        parent::__construct($gameLottoType);
    }
    public function renderHtml()
    {
        $renderer = new Renderer000999;
        return $renderer->renderHtml();
    }
}
