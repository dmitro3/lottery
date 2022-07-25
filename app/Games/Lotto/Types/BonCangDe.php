<?php

namespace App\Games\Lotto\Types;

use App\Games\Lotto\Enums\NoPrize;
use App\Games\Lotto\Renderers\Renderer00009999;

class BonCangDe extends BaCangDe
{

    public function renderHtml()
    {
        $renderer = new Renderer00009999;
        return $renderer->renderHtml();
    }
}
