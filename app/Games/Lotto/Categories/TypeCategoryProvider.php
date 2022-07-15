<?php

namespace App\Games\Lotto\Categories;

use App\Games\Lotto\Contracts\ITypeGameCategory;
use App\Models\Games\Lotto\GameLottoCategory;

class TypeCategoryProvider
{
    public static function getTypeGame(GameLottoCategory $category): ITypeGameCategory
    {
        $code = $category->code;
        switch ($code) {
            case 'BAO_LO':
                return new BaoLo($category);
            case 'LO_XIEN':
                return new LoXien($category);
            case 'DE':
                return new De($category);
            case '3_CANG':
                return new BaCang($category);
            case '4_CANG':
                return new BonCang($category);
            case 'LO_TRUOT':
                return new LoTruot($category);
        }
        return null;
    }
}
