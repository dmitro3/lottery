<?php

namespace App\Models\Games\Lotto;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel;
use App\Models\User;

class GameLottoCategory extends BaseModel
{
    use HasFactory;
    public function gameLottoTypes()
    {
        return $this->hasMany(GameLottoType::class);
    }
}
