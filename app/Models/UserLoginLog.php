<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class UserLoginLog extends BaseModel
{
    const PAGINATION_NUMBER = 20;
    use HasFactory;
}