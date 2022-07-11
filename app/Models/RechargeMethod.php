<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class RechargeMethod extends BaseModel
{
    use HasFactory;
    const DIRECT_TRANSFER_METHOD = 1;
}