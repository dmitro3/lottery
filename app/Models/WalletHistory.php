<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class WalletHistory extends BaseModel
{
    use HasFactory;
    public function walletTransactionType()
    {
        return $this->belongsTo(WalletTransactionType::class,'type');
    }
    public function wallet()
    {
        return $this->belongsTo(Wallet::class,'type');
    }
}