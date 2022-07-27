<?php

namespace App\Games\Lotto\Renderers;

class Renderer000999 extends RendererNToM
{
    public function __construct($from = 0, $to = 999)
    {
        parent::__construct($from, $to);
    }
    public function renderHtml()
    {
        $view = 'games.lotto.mini_games.types.fromntom2';
        $num = strlen($this->to);
        return view($view, compact('num'))->render();
    }
}
