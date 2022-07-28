<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class RechargeMethod extends BaseModel
{
    use HasFactory;
    const DIRECT_TRANSFER_METHOD = 1;
    const ONLINE_PAYMENT_PRINCE_PAY = 2;
    const ONLINE_TRANSFER_PRINCE_PAY = 3;
    
    public static function getPrincePayMethodChanel($rechargeMethodIdx)
    {
        switch ($rechargeMethodIdx) {
            case self::ONLINE_PAYMENT_PRINCE_PAY:
                return 907;
                break;
            case self::ONLINE_TRANSFER_PRINCE_PAY:
                return 908;
                break;
            default:
                return 0;
                break;
        }
    }
    public static function getPrincePayMethodId()
    {
        return [self::ONLINE_PAYMENT_PRINCE_PAY,self::ONLINE_TRANSFER_PRINCE_PAY];
    }
}