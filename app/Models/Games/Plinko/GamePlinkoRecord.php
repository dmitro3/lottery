<?php

namespace App\Models\Games\Plinko;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel;
use App\Models\WalletTransactionType;
use App\Games\GoWin\Factories\MiniGameFactory;
use Exception;

class GamePlinkoRecord extends BaseModel
{
    public function getTimeRemaining()
    {
        return $this->end_time - now()->timestamp;
    }
}
