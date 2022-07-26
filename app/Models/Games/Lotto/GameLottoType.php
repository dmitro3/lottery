<?php

namespace App\Models\Games\Lotto;

use App\Games\Lotto\Types\TypeProvider;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel;
use App\Models\User;

class GameLottoType extends BaseModel
{
    use HasFactory;
    public function getTypeGame()
    {
        return TypeProvider::getTypeGame($this);
    }
    public function gameLottoPlayUserBets()
    {
        return $this->hasMany(GameLottoPlayUserBet::class);
    }
    public function gameLottoPlayRecords()
    {
        return $this->hasMany(GameLottoPlayUserBet::class);
    }
}
