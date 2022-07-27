<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class RechargeDirectTransferBank extends BaseModel
{
    use HasFactory;
    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }
}