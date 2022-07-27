<?php

namespace App\Games\Lotto\Categories;

use App\Games\Lotto\Contracts\ITypeGameCategory;
use App\Models\Games\Lotto\GameLottoCategory;

abstract class ATypeGameCategory implements ITypeGameCategory
{
    protected GameLottoCategory $category;
    public function __construct(GameLottoCategory $category)
    {
        $this->category = $category;
    }
    public function renderHtml()
    {
        $category = $this->category;
        $types = $this->category->gameLottoTypes()->get();
        $view = 'games.lotto.mini_games.' . $this->getViewName();
        return view($view, compact('category', 'types'))->render();
    }
    public function toJson()
    {
        return response()->json(['code' => 200, 'html' => $this->renderHtml()]);
    }
}
