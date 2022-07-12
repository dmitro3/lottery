<?php

namespace App\Models\Games\Plinko;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel;
use App\Models\User;

class GamePlinkoUserBet extends BaseModel
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
