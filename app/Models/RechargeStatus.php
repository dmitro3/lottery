<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class RechargeStatus extends BaseModel
{
    use HasFactory;
    const STATUS_WAIT_CONFIRM = 1;
    const STATUS_CONFIRMED = 2;
    const STATUS_CANCEL = 3;
}