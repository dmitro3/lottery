<?php

namespace App\Games\Lotto\Types;

use App\Games\Lotto\Contracts\ITypeGame;
use App\Models\Games\Lotto\GameLottoType;
use Str;

class TypeProvider
{
    public static function getTypeGame(GameLottoType $type): ITypeGame
    {
        $code = $type->code;
        $clazz = '\App\Games\Lotto\Types\\' . ucwords(Str::camel(strtolower($code)));
        if (class_exists($clazz)) {
            return new $clazz($type);
        }
        return null;
    }
}
