<?php

namespace App\Games\Lotto\Types;

use App\Games\Lotto\Renderers\Renderer00009999;

class BonCangDe extends ATypeGame
{
    public function renderHtml()
    {
        $renderer = new Renderer00009999;
        return $renderer->renderHtml();
    }
}
