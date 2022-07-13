<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class WithdrawalRequest extends BaseModel
{
    use HasFactory;
    const PAGINATION_NUMBER = 20;
    public function withdrawalRequestStatus()
    {
        return $this->belongsTo(WithdrawalRequestStatus::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}