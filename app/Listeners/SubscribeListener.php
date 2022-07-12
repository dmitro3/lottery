<?php
namespace App\Listeners;
use App\Models\{
    RechargeRequest,
    RechargeStatus,
    RechargeMethod,
    WalletTransactionType
};
class SubscribeListener
{
    public function subscribe($events)
    {
        $events->listen('vanhenry.manager.update_normal.success', function($table, $data, $id , $oldData = null){
            $tbl = $table;
            if ($table instanceof \vanhenry\manager\model\VTable)
            {
                $tbl = $table->table_map;
            }
            if ($tbl == 'recharge_requests') {
                $this->updateRechargeRequests($table, $data, $id , $oldData);
            }
        });
    }
    public function updateRechargeRequests($table, $data, $id , $oldData)
    {
        if (!isset($data) || !isset($data['recharge_status_id'])) return;
        $itemRechargeRequest = RechargeRequest::whereHas('user')->with('user')->find($id);
        if (!isset($itemRechargeRequest)) return;
        if ($itemRechargeRequest->recharge_method_id == RechargeMethod::DIRECT_TRANSFER_METHOD) {
            if ($itemRechargeRequest->recharged == 1) {
                $itemRechargeRequest->recharge_status_id = $oldData->recharge_status_id;
                $itemRechargeRequest->save();
            }else{
                if ($data['recharge_status_id'] == $oldData->recharge_status_id) return;
                if ($data['recharge_status_id'] == RechargeStatus::STATUS_CONFIRMED) {
                    $user = $itemRechargeRequest->user;
                    $reason = 'Cộng tiền chuyển khoản trực tiếp';
                    $user->changeMoney($itemRechargeRequest->amount,$reason,WalletTransactionType::RECHARGE_MONEY,$itemRechargeRequest->id);
                }
                $itemRechargeRequest->recharged = 1;
                $itemRechargeRequest->recharged_at = now();
                if (\Auth::guard('h_users')->check()) {
                    $itemRechargeRequest->h_user_id = \Auth::guard('h_users')->id();
                }
                $itemRechargeRequest->save();
            }
        }
    }
}