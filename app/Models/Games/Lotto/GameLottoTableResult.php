<?php

namespace App\Models\Games\Lotto;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel;

class GameLottoTableResult extends BaseModel
{
    use HasFactory;

    public function gameLottoPlayRecords()
    {
        return $this->hasMany(GameLottoPlayRecord::class);
    }
}
