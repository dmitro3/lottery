<?php

namespace App\Games\Lotto\Types;

use App\Games\Lotto\Renderers\Renderer000999;

class BaCangDe extends ATypeGame
{
    public function renderHtml()
    {
        $renderer = new Renderer000999;
        return $renderer->renderHtml();
    }
}
