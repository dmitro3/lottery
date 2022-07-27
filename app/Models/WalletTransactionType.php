<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class WalletTransactionType extends BaseModel
{
    use HasFactory;

    const RECHARGE_MONEY = 1;
    const WITHDRAW_MONEY = 2;
    const MINUS_MONEY_BET_GAME_GOWIN = 3;
    const PLUS_MONEY_WIN_GAME_GOWIN = 4;
    const REFUND_CANCEL_WITHDRAWAL_REQUEST = 5;
    const PLUS_COMMISSION_TEAM = 6;

    const ADMIN_PLUS_MONEY = 7;
    const ADMIN_MINUS_MONEY = 8;


    const MINUS_MONEY_BET_GAME_PLINKO = 10;
    const PLUS_MONEY_BET_GAME_PLINKO = 11;


    const MINUS_MONEY_BET_GAME_LOTTO = 20;
    const PLUS_MONEY_BET_GAME_LOTTO = 21;

    public static function getArrTypeTakeCommissionAble()
    {
        return [self::MINUS_MONEY_BET_GAME_GOWIN, self::MINUS_MONEY_BET_GAME_PLINKO, self::MINUS_MONEY_BET_GAME_LOTTO];
    }
}
