<?php

namespace App\Games\Lotto\Types;

use App\Games\Lotto\Contracts\ITypeGame;
use App\Games\Lotto\Renderers\Renderer0099;
use App\Models\Games\Lotto\GameLottoType;

abstract class ATypeGame implements ITypeGame
{
    protected GameLottoType $type;
    public function __construct(GameLottoType $type)
    {
        $this->type = $type;
    }
    public function renderHtml()
    {
        $renderer = new Renderer0099;
        return $renderer->renderHtml();
    }
}
