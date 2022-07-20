<?php
namespace vanhenry\manager\statisticals;

use App\Models\WalletTransactionType;

class UserStatical
{
    public static function getUserTotalCollect($user)
    {
        $userWallet = $user->getWallet();
        return $userWallet->walletHistory()->includedTheCost()->where('type',WalletTransactionType::RECHARGE_MONEY)->sum('amount');
    }
    public static function getUserTotalSpend($user)
    {
        $arrTypeSpend = [WalletTransactionType::WITHDRAW_MONEY,WalletTransactionType::REFUND_CANCEL_WITHDRAWAL_REQUEST];
        $userWallet = $user->getWallet();
        $total = $userWallet->walletHistory()->includedTheCost()->whereIn('type',$arrTypeSpend)->sum('amount');
        return abs($total);
    }
}
