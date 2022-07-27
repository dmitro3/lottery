<?php
namespace App\Models\Games\Win;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel;
use App\Models\User;
class GameWinUserBet extends BaseModel
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function gameWinUserBetStatus()
    {
        return $this->belongsTo(GameWinUserBetStatus::class);
    }
    public function gameWinType()
    {
        return $this->belongsTo(GameWinType::class);
    }
}