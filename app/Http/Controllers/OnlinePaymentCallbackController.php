<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\RechargeRequest;
use App\Models\RechargeStatus;
use App\Models\TransactionPrincepay;
use App\Models\TransactionPrincepayStatus;
use App\Models\WalletTransactionType;
use SettingHelper;

class OnlinePaymentCallbackController extends Controller
{
    public function paymentSuccess()
    {
        return view('online_payments.payment_success');
    }
    public function callbackPrincePay()
    {
        // $logPath = public_path('logs/onlinePayments/princepay/');
        // if (!file_exists($logPath)) {
        //     mkdir($logPath, 0755, true);
        // }
        // $logFile = $logPath.'webhook.txt';
        // Support::log($logFile, date('Y-m-d H:i:s').'|'.json_encode(request()->all()), true);

        if(empty($_POST['status']) || empty($_POST['result']) || empty($_POST['sign'])){
            echo 'params Data error';
            return;
        }
        $resultData           = [];
        $resultData['status'] = $_POST['status'];
        $resultData['result'] = $_POST['result'];
        $resultData['sign']   = $_POST['sign'];
    
        $resultData['tempResult'] = json_decode($resultData['result']);
        if(json_last_error() != JSON_ERROR_NONE){
            echo 'Callback data error';
            return;
        }
        
        $signString = 'result='. $resultData['result']. '&status='. $resultData['status']. '&key='. SettingHelper::getSetting('prince_pay_md5key');
        $signString = strtoupper(md5($signString));
        if($resultData['sign'] != $signString){
            echo 'Verification error';
            return;
        }
    
        if($resultData['status'] != 10000){
            echo 'This transaction was unsuccessful';
            return;
        }
        $transactionPrincepay = TransactionPrincepay::where('transactionid',$resultData['tempResult']->transactionid ?? 0)
                                                    ->where('transaction_princepay_status_id',TransactionPrincepayStatus::WAIT_PAYMENT)
                                                    ->first();
        if (!isset($transactionPrincepay)) {
            echo 'Transaction not found';
            return;
        }
        $transactionPrincepay->callback_response = json_encode($resultData);
        $transactionPrincepay->transaction_princepay_status_id = TransactionPrincepayStatus::PAYMENT_SUCCESS;
        $transactionPrincepay->real_amount = $resultData['tempResult']->real_amount ?? 0;
        $transactionPrincepay->save();
        $itemRechargeRequest = RechargeRequest::whereHas('user')->with('user')->with('rechargeMethod')->find($transactionPrincepay->map_id);
        if (!isset($itemRechargeRequest)){
            echo 'Recharge request not found';
            return;
        }
        if ($itemRechargeRequest->recharged != 1) {
            $user = $itemRechargeRequest->user;
            $reason = vsprintf('Cộng tiền nạp tiền %s',isset($itemRechargeRequest->rechargeMethod) ? $itemRechargeRequest->rechargeMethod->name:'');
            $user->changeMoney($itemRechargeRequest->amount,$reason,WalletTransactionType::RECHARGE_MONEY,$itemRechargeRequest->id,$itemRechargeRequest->is_marketing,false);
            $itemRechargeRequest->recharged = 1;
            $itemRechargeRequest->recharge_status_id = RechargeStatus::STATUS_CONFIRMED;
            $itemRechargeRequest->recharged_at = now();
            $itemRechargeRequest->save();
        }
        echo 'success';
    }
}
