<?php

namespace App\Games\Lotto\Renderers;

class RendererNToM
{
    protected $from;
    protected $to;
    public function __construct($from, $to)
    {
        $this->from = $from;
        $this->to = $to;
    }
    public function renderHtml()
    {
        $view = 'games.lotto.mini_games.types.fromntom';
        $from = $this->from;
        $to = $this->to;
        return view($view, compact('from', 'to'))->render();
    }
}
