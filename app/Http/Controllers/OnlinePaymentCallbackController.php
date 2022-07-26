<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use SettingHelper;
use Support;

class OnlinePaymentCallbackController extends Controller
{
    public function callbackPrincePay()
    {
        $logPath = public_path('logs/onlinePayments/princepay/');
        if (!file_exists($logPath)) {
            mkdir($logPath, 0755, true);
        }
        $logFile = $logPath.'webhook.txt';
        Support::log($logFile, date('Y-m-d H:i:s').'|'.json_encode(request()->all()), true);

        if(empty($_POST['status']) || empty($_POST['result']) || empty($_POST['sign'])){
            echo 'params Data error';
            return;
        }
        $resultData           = [];
        $resultData['status'] = $_POST['status'];
        $resultData['result'] = $_POST['result'];
        $resultData['sign']   = $_POST['sign'];
    
        $resultData['tempResult'] = json_decode($resultData['result']);
        if(json_last_error() == JSON_ERROR_NONE){
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
        
    }
}
