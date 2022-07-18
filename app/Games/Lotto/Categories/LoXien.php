<?php

namespace App\Games\Lotto\Categories;

use App\Models\Games\Lotto\GameLottoCategory;

class LoXien extends ATypeGameCategory
{
    public function getViewName()
    {
        return 'range_number';
    }
}
