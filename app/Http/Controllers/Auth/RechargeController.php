<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use \Auth;
use App\Models\{
    RechargeMethod,
    RechargeRequest,
    RechargeStatus,
    RechargeDirectTransferBank,
    RechargeRequestDirectTransferBankInfo,
    TransactionPrincepay,
    TransactionPrincepayType,
};
class RechargeController extends Controller
{
    public function goLogin()
    {
        return \Support::response([
            'code' => 100,
            'message' => 'Vui lòng đăng nhập',
            'redirect' => 'dang-nhap'
        ]);
    }
    public function index(Request $request)
    {
        if(!Auth::check()) return $this->goLogin();
        $user = Auth::user();
        $listRechargeMethod = RechargeMethod::act()->get();
        return view('auth.wallet.recharge', compact('user','listRechargeMethod'));
    }
    public function initRechargeMethod()
    {
        $rechargeMethod = RechargeMethod::find(request()->idx ?? 0);
        if (!isset($rechargeMethod)) {
            return response()->json([
                'code' => 100,
                'html' => '<p class=""m-t-10>Phương thức thanh toán tạm thời không khả dụng.</p>'
            ]);
        }
        switch ($rechargeMethod->id) {
            case RechargeMethod::DIRECT_TRANSFER_METHOD:
                return $this->viewDirectTransferMethod($rechargeMethod);
                break;
            case RechargeMethod::ONLINE_PAYMENT:
            case RechargeMethod::ONLINE_TRANSFER:
                return $this->viewOnlinePaymentMethod($rechargeMethod);
                break;
            default:
                return response()->json([
                    'code' => 100,
                    'html' => '<p class=""m-t-10>Phương thức thanh toán tạm thời không khả dụng.</p>'
                ]);
                break;
        }
    }
    protected function validatorSendRecharge(array $data)
    {
        $minRechargeMoney = (int)\SettingHelper::getSetting('min_recharge_money',50000);
        $maxRechargeMoney = (int)\SettingHelper::getSetting('max_recharge_money',1000000000);
        return Validator::make($data, [
            'amount' => ['required','numeric','min:'.$minRechargeMoney,'max:'.$maxRechargeMoney],
        ], [
            'required' => 'Vui lòng nhập :attribute',
            'amount.numeric' => 'Vui lòng nhập số tiền ở dạng số nguyên',
            'amount.min' => 'Số tiền chuyển khoản tối thiểu '.number_format($minRechargeMoney,0,',','.').' đ',
            'amount.max' => 'Số tiền chuyển khoản tối đa '.number_format($maxRechargeMoney,0,',','.').' đ',
        ], [
            'amount' => 'Số tiền',
        ]);
    }
    
    public function sendRecharge(Request $request)
    {
        if(!Auth::check()) return $this->goLogin();
        $validator = $this->validatorSendRecharge($request->all());
        if ($validator->fails()) {
            return response()->json([
                'code' => 100,
                'message' => $validator->errors()->first(),
            ]);
        }
        $rechargeMethod = RechargeMethod::find(request()->idx ?? 0);
        if (!isset($rechargeMethod)) {
            return response()->json([
                'code'  => 100,
                'message' => 'Phương thức thanh toán tạm thời không khả dụng.'
            ]);
        }
        switch ($rechargeMethod->id) {
            case RechargeMethod::DIRECT_TRANSFER_METHOD:
                return $this->sendDirectTransferRecharge($request);
            case RechargeMethod::ONLINE_PAYMENT:
            case RechargeMethod::ONLINE_TRANSFER:
                return $this->sendPrincePayRecharge($request);
                break;
            default:
                return response()->json([
                    'code' => 100,
                    'message' => 'Phương thức thanh toán tạm thời không khả dụng'
                ]);
                break;
        }
    }



    // Chuyển khoản trực tiếp
    public function viewDirectTransferMethod($rechargeMethod)
    {
        return response()->json([
            'code' => 200,
            'html' => view('auth.wallet.recharge_method.direct_transfer',compact('rechargeMethod'))->render()
        ]);
    }
    public function sendDirectTransferRecharge(Request $request)
    {
        $user = Auth::user();
        $rechargeDirectTransferBank = RechargeDirectTransferBank::whereHas('bank')
                                                                ->with('bank')
                                                                ->act()
                                                                ->inRandomOrder()
                                                                ->first();
        if (!isset($rechargeDirectTransferBank)) {
            return response()->json([
                'code' => 100,
                'message' => 'Phương thức tạm thời đang bảo trì quý khách vui lòng chờ đợi hoặc liên hệ với bộ phận chăm sóc khách hàng.',
            ]);
        }
        $now = now();
        $rechargeRequest = new RechargeRequest;
        $rechargeRequest->agent_id = $user->introduce_user_id;
        $rechargeRequest->user_id = $user->id;
        $rechargeRequest->day = $now->day;
        $rechargeRequest->month = $now->month;
        $rechargeRequest->year = $now->year;
        $rechargeRequest->recharge_method_id = $request->idx;
        $rechargeRequest->recharge_status_id = RechargeStatus::STATUS_WAIT_CONFIRM;
        $rechargeRequest->amount = $request->amount;
        $rechargeRequest->recharged = 0;
        $rechargeRequest->is_marketing = $user->is_marketing_account;
        $rechargeRequest->user_ip = $request->ip();
        $rechargeRequest->user_agent = $request->header('User-Agent');
        $rechargeRequest->save();
        
        $rechargeRequestCode = $now->year.$now->month.$now->day.time().sprintf('%s%05s','',$rechargeRequest->id);
        $rechargeRequest->code = $rechargeRequestCode;
        $rechargeRequest->save();

        $rechargeRequestDirectTransferBankInfo = new RechargeRequestDirectTransferBankInfo;
        $rechargeRequestDirectTransferBankInfo->recharge_request_id = $rechargeRequest->id;
        $rechargeRequestDirectTransferBankInfo->bank_name = $rechargeDirectTransferBank->bank->name;
        $rechargeRequestDirectTransferBankInfo->bank_short_name = $rechargeDirectTransferBank->bank->short_name;
        $rechargeRequestDirectTransferBankInfo->account_holder = $rechargeDirectTransferBank->account_holder;
        $rechargeRequestDirectTransferBankInfo->account_number = $rechargeDirectTransferBank->account_number;
        $rechargeRequestDirectTransferBankInfo->account_branch = $rechargeDirectTransferBank->account_branch;
        $rechargeRequestDirectTransferBankInfo->save();

        $rechargeMethod = RechargeMethod::find($rechargeRequest->recharge_method_id);
        return response()->json([
            'code'      => 200,
            'message'   => 'Tạo yêu cầu nạp tiền thành công.',
            'type'      => 'html',
            'html'      => view('auth.wallet.recharge_method.direct_transfer_done_result',compact('rechargeMethod','rechargeRequest','rechargeRequestDirectTransferBankInfo'))->render()
        ]);
    }
    // End chuyển khoản trực tiếp


    // Thanh toán online. Nhưng chỉ nhận của princepay
    public function viewOnlinePaymentMethod($rechargeMethod)
    {
        return response()->json([
            'code' => 200,
            'html' => view('auth.wallet.recharge_method.prince_pay',compact('rechargeMethod'))->render()
        ]);
    }
    public function sendPrincePayRecharge($request)
    {
        // $Md5key = 'ytg5u';
        // $native = array(
        //     'uid' => 'princ',
        //     'orderid' => 'princepay1688',//order number
        //     'channel' => '907',//Merchant payment channel
        //     'notify_url' => "https://manager.qpr200.work/",//Server return address
        //     'return_url' => "https://manager.qpr200.work/",//Page jump return address
        //     'amount' => 100000,//Transaction amount
        //     'userip' => '43.228.125.138',//Client ip
        //     'timestamp' => 1608823688,//Timestamp
        //     'custom' => ''//Custom parameters
        // );
        // ksort($native);
        // $md5str = "";
        // foreach ($native as $key => $val) {
        //     $md5str = $md5str . $key . "=" . $val . "&";
        // }
        
        // $sign = strtoupper(md5($md5str . "key=" . $Md5key));
        // $native["sign"] = $sign;
    
        // $sendString = '';
        // foreach($native as $key => $value){
        //     $sendString .= $key. '='. $value. '&';
        // }
        // $sendString = trim($sendString, '&');
        // dd($sendString);
    
        // $postback = $this->send_post($sendUrl, $native);

        $user = Auth::user();
        $now = now();
        $rechargeRequest = new RechargeRequest;
        $rechargeRequest->agent_id = $user->introduce_user_id;
        $rechargeRequest->user_id = $user->id;
        $rechargeRequest->day = $now->day;
        $rechargeRequest->month = $now->month;
        $rechargeRequest->year = $now->year;
        $rechargeRequest->recharge_method_id = $request->idx;
        $rechargeRequest->recharge_status_id = RechargeStatus::STATUS_WAIT_CONFIRM;
        $rechargeRequest->amount = $request->amount;
        $rechargeRequest->recharged = 0;
        $rechargeRequest->is_marketing = $user->is_marketing_account;
        $rechargeRequest->user_ip = $request->ip();
        $rechargeRequest->user_agent = $request->header('User-Agent');
        $rechargeRequest->save();
        $rechargeRequestCode = $now->year.$now->month.$now->day.time().sprintf('%s%05s','',$rechargeRequest->id);
        $rechargeRequest->code = $rechargeRequestCode;
        $rechargeRequest->save();

        $transactionPrincepay =  new TransactionPrincepay;
        $transactionPrincepay->user_id = $user->id;
        $transactionPrincepay->map_id = $rechargeRequest->id;
        $transactionPrincepay->amount = $rechargeRequest->amount;
        $transactionPrincepay->transaction_princepay_status_id = TransactionPrincepayType::RECHARGE;
        $transactionPrincepay->created_at = now();
        $transactionPrincepay->updated_at = now();
        $transactionPrincepay->save();

        return response()->json([
            'code'      => 200,
            'message'   => 'Tạo yêu cầu nạp tiền thành công.',
            'type'      => 'url',
            'url'      => 'https://www.google.com/search?q=gg+search+console&oq=gg+se&aqs=chrome.0.69i59j69i57j0i512l5j69i60.1133j0j7&sourceid=chrome&ie=UTF-8',
        ]);
    }
    // End Thanh toán online. Nhưng chỉ nhận của princepay

    public function rechargeHistory()
    {
        if(!Auth::check()) return $this->goLogin();
        $user = Auth::user();
        $listItems = $user->rechargeRequest()->with('rechargeStatus')->orderBy('id','desc')->paginate(RechargeRequest::PAGINATION_NUMBER);
        if (isset(request()->type) && request()->type == 'load_item') {
            return response()->json([
                'code' => 200,
                'html' => view('auth.wallet.recharge_history_result',compact('user','listItems'))->render()
            ]);
        }
        return view('auth.wallet.recharge_history',compact('user','listItems'));
    }
}