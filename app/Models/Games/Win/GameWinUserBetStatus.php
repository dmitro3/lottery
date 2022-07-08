<?php
namespace App\Models\Games\Win;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel;
class GameWinUserBetStatus extends BaseModel
{
    use HasFactory;
    const STATUS_WAIT_RESULT = 1;
    const STATUS_LOSE = 2;
    const STATUS_WIN = 3;
}