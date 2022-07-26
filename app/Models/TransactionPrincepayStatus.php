<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class TransactionPrincepayStatus extends BaseModel
{
    use HasFactory;
    const WAIT_PAYMENT = 1;
    const PAYMENT_SUCCESS = 2;
    const PAYMENT_FAIL = 3;
}