<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class RechargeRequest extends BaseModel
{
    use HasFactory;
    const PAGINATION_NUMBER = 20;
    public function rechargeRequestDirectTransferBankInfo()
    {
        return $this->belongsTo(RechargeRequestDirectTransferBankInfo::class,'id','recharge_request_id');
    }
    public function rechargeStatus()
    {
        return $this->belongsTo(RechargeStatus::class);
    }
    public function rechargeMethod()
    {
        return $this->belongsTo(RechargeMethod::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}