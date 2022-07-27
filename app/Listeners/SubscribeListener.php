<?php
namespace App\Listeners;
use App\Models\{
    RechargeRequest,
    RechargeStatus,
    RechargeMethod,
    WalletTransactionType,
    WithdrawalRequest,
    WithdrawalRequestStatus
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
            if ($tbl == 'withdrawal_requests') {
                $this->updateWithdrawalRequests($table, $data, $id , $oldData);
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
                    $user->changeMoney($itemRechargeRequest->amount,$reason,WalletTransactionType::RECHARGE_MONEY,$itemRechargeRequest->id,$itemRechargeRequest->is_marketing,false);
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
    public function updateWithdrawalRequests($table, $data, $id , $oldData)
    {
        if (!isset($data) || !isset($data['withdrawal_request_status_id'])) return;
        $itemWithdrawalRequest = WithdrawalRequest::whereHas('user')->with('user')->find($id);
        if (!isset($itemWithdrawalRequest)) return;

        if ($itemWithdrawalRequest->status_changed == 1) {
            $itemWithdrawalRequest->withdrawal_request_status_id = $oldData->withdrawal_request_status_id;
            $itemWithdrawalRequest->save();
        }else{
            if ($data['withdrawal_request_status_id'] == $oldData->withdrawal_request_status_id) return;
            if ($data['withdrawal_request_status_id'] == WithdrawalRequestStatus::STATUS_CANCEL) {
                $user = $itemWithdrawalRequest->user;
                $reason = 'Hoàn tiền khi hủy yêu cầu rút tiền';
                $user->changeMoney($itemWithdrawalRequest->amount,$reason,WalletTransactionType::REFUND_CANCEL_WITHDRAWAL_REQUEST,$itemWithdrawalRequest->id,$itemWithdrawalRequest->is_marketing,false);
            }
            $itemWithdrawalRequest->status_changed = 1;
            $itemWithdrawalRequest->status_changed_at = now();
            if (\Auth::guard('h_users')->check()) {
                $itemWithdrawalRequest->h_user_id = \Auth::guard('h_users')->id();
            }
            $itemWithdrawalRequest->save();
        }
    }
}