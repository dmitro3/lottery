<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Wallet extends BaseModel
{
    use HasFactory;
    public function changeMoney($amount,$reason,$type,$mapId)
    {
        $listTypeCommissionAble = WalletTransactionType::getArrTypeTakeCommissionAble();
        if (in_array($type,$listTypeCommissionAble)) {
            $commissionIncurred = new CommissionIncurred;
            $commissionIncurred->user_id = $this->user_id;
            $commissionIncurred->amount = abs($amount);
            $commissionIncurred->inited = 0;
            $commissionIncurred->save();

            $user = $this->user ?? null;
            if (isset($user) && $user->introduce_user_id > 0) {
                $currentWeekCommissionUserDirectChildStatisticsRecord = CommissionUserDirectChildStatistics::getCurrentWeekRecord($user->introduce_user_id);
                $currentWeekCommissionUserDirectChildStatisticsRecord->total_amount = $currentWeekCommissionUserDirectChildStatisticsRecord->total_amount + abs($amount);
                $currentWeekCommissionUserDirectChildStatisticsRecord->save();
            }
        }

        $amountBefore              = $this->amount;
        $amountAvailabilityBefore  = $this->amount_availability;
        $this->amount              = $this->amount + $amount;
        $this->amount_availability = $this->amount_availability + $amount;
        $this->save();
        $dataHistory = array(
            'wallet_id'        => $this->id,
            'type'                       => $type,
            'map_id'                     => $mapId,
            'amount'                     => $amount,
            'amount_before'              => $amountBefore,
            'amount_after'               => $this->amount,
            'amount_freeze_before'       => $this->amount_freeze,
            'amount_freeze_after'        => $this->amount_freeze,
            'amount_availability_before' => $amountAvailabilityBefore,
            'amount_availability_after'  => $this->amount_availability,
            'reason'                     => $reason,
            'created_at'                 => now(),
            'updated_at'                 => now(),
        );
        $this->createHistory($dataHistory);
    }
    public function changeMoneyFreeze($amount,$reason,$type,$mapId)
    {
        $amountFreezeBefore        = $this->amount_freeze;
        $amountAvailabilityBefore  = $this->amount_availability;
        $this->amount_freeze       = $this->amount_freeze + $amount;
        $this->amount_availability = $this->amount_availability - $amount;
        $this->save();
        $dataHistory = array(
            'affiliate_wallet_id'        => $this->id,
            'type'                       => $type,
            'map_id'                     => $mapId,
            'amount'                     => $amount,
            'amount_before'              => $this->amount,
            'amount_after'               => $this->amount,
            'amount_freeze_before'       => $amountFreezeBefore,
            'amount_freeze_after'        => $this->amount_freeze,
            'amount_availability_before' => $amountAvailabilityBefore,
            'amount_availability_after'  => $this->amount_availability,
            'reason'                     => $reason,
            'created_at'                 => now(),
            'updated_at'                 => now(),
        );
        $this->createHistory($dataHistory);
    }
    public function createHistory($dataHistory)
    {
        WalletHistory::insert($dataHistory);
    }
    public function walletHistory()
    {
        return $this->hasMany(WalletHistory::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}