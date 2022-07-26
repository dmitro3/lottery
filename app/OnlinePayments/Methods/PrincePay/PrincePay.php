<?php
namespace App\OnlinePayments\Methods\PrincePay;
use App\Models\TransactionPrincepay;
use App\Models\TransactionPrincepayStatus;
use App\Models\TransactionPrincepayType;
use App\OnlinePayments\Methods\BaseOnlinePayment;
use SettingHelper;

class PrincePay extends BaseOnlinePayment{
    protected $merchantId;
    protected $Md5key;
    protected $sendUrl;
    protected $redirectUrl = 'nap-tien-prince-pay';
    protected $callbackUrl = 'callback-prince-pay';

    public function __construct()
    {
        $this->merchantId = SettingHelper::getSetting('prince_pay_merchant_id');
        $this->Md5key = SettingHelper::getSetting('prince_pay_md5key');
        $this->sendUrl = SettingHelper::getSetting('prince_pay_send_url');
    }
    public function createPaymentRequest($data){
        $transactionPrincepay = new TransactionPrincepay();
        $transactionPrincepay->user_id = $data['user_id'];
        $transactionPrincepay->data = json_encode($data);
        $transactionPrincepay->map_id = $data['map_id'];
        $transactionPrincepay->amount = $data['amount'];
        $transactionPrincepay->transaction_princepay_status_id = TransactionPrincepayStatus::WAIT_PAYMENT;
        $transactionPrincepay->transaction_princepay_type_id = TransactionPrincepayType::RECHARGE;
        $transactionPrincepay->created_at = now();
        $transactionPrincepay->updated_at = now();
        $transactionPrincepay->save();

        $native = array(
            'uid' => $this->merchantId,
            'orderid' => $transactionPrincepay->id,
            'channel' => $data['channel'],
            'notify_url' => url()->to($this->redirectUrl),
            'return_url' => url()->to($this->callbackUrl),
            'amount' => $transactionPrincepay->amount,
            'userip' => $data['user_ip'],
            'timestamp' => time(),
            'custom' => ''
        );
        ksort($native);
        $md5str = "";
        foreach ($native as $key => $val) {
            $md5str = $md5str . $key . "=" . $val . "&";
        }
        $sign = strtoupper(md5($md5str . "key=" . $this->Md5key));
        $native["sign"] = $sign;
        $postback = $this->exeCurl($this->sendUrl,'POST',$native);
        $result = json_decode($postback);
        if(json_last_error() == JSON_ERROR_NONE){
            return [
                'code' => 100,
                'message_error' => 'Dữ liệu trả về không hợp lệ'
            ];
        }
        if($result->status != 10000){
            return [
                'code' => 100,
                'message_error' => 'Không thể kết nối thanh toán'
            ];
        }
        $resultSign = 'result='. json_encode($result->result). '&status='. $result->status. '&key='. $this->Md5key;
        $resultSign = strtoupper(md5($resultSign));
        if($resultSign != $result->sign){
            return [
                'code' => 100,
                'message_error' => 'Dữ liệu trả về không hợp lệ'
            ];
        }
        $ret = $this->extractJson($postback);
        $ret['code'] = 200;
        return $ret;
    }
}