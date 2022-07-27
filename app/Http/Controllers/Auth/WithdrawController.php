<?php
namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use \Auth;
use App\Models\{
    WithdrawalRequest,
    WithdrawalRequestStatus,
    WalletTransactionType,
};

class WithdrawController extends Controller
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
        $userBank = $user->userBank()->with('bank')->first();
        return view('auth.wallet.withdraw', compact('user','userBank'));
    }
    protected function validatorSendWithdrawRequest(array $data)
    {
        $minWithdrawMoney = (int)\SettingHelper::getSetting('min_withdraw_money',50000);
        $maxWithdrawMoney = (int)\SettingHelper::getSetting('max_withdraw_money',1000000000);
        return Validator::make($data, [
            'amount' => ['required','numeric','min:'.$minWithdrawMoney,'max:'.$maxWithdrawMoney],
            'password' => ['required'],
        ], [
            'required' => 'Vui lòng nhập :attribute',
            'amount.numeric' => 'Vui lòng nhập số tiền ở dạng số nguyên',
            'amount.min' => 'Số tiền rút tối thiểu '.number_format($minWithdrawMoney,0,',','.').' đ',
            'amount.max' => 'Số tiền rút tối đa '.number_format($maxWithdrawMoney,0,',','.').' đ',
        ], [
            'amount' => 'Số tiền rút',
            'password' => 'Mật khẩu',
        ]);
    }
    public function sendWithdrawRequest(Request $request)
    {
        if(!Auth::check()) return $this->goLogin();
        $user = Auth::user();
        $validator = $this->validatorSendWithdrawRequest($request->all());
        if ($validator->fails()) {
            return response()->json([
                'code' => 100,
                'message' => $validator->errors()->first(),
            ]);
        }
        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'code' => 100,
                'message' => 'Vui lòng nhập chính xác mật khẩu tài khoản để thực hiện yêu cầu rút tiền!',
            ]);
        }
        $userBank = $user->userBank()->with('bank')->first();
        if (!isset($userBank)) {
            return response()->json([
                'code' => 100,
                'message' => 'Vui lòng chọn thẻ ngân hàng!',
            ]);
        }
        $amount = (int)$request->amount;
        if ($user->getAmount() < $amount) {
            return response()->json([
                'code' => 100,
                'message' => 'Số tiền không đủ!',
            ]);
        }
        $feePercent = \SettingHelper::getSetting('fee_withdraw');
        $amountFinal = $amount - $amount*$feePercent/100;

        $now = now();
        $withdrawalRequest = new WithdrawalRequest;
        $withdrawalRequest->user_id = $user->id;
        $withdrawalRequest->email = $userBank->email;
        $withdrawalRequest->phone = $userBank->phone;
        $withdrawalRequest->province = $userBank->province;
        $withdrawalRequest->hour = $now->hour;
        $withdrawalRequest->day = $now->day;
        $withdrawalRequest->month = $now->month;
        $withdrawalRequest->year = $now->year;
        $withdrawalRequest->amount = $amount;
        $withdrawalRequest->fee_percent = $feePercent;
        $withdrawalRequest->amount_final = $amountFinal;
        $withdrawalRequest->withdrawal_request_status_id = WithdrawalRequestStatus::STATUS_WAIT_CONFIRM;
        $withdrawalRequest->bank_id = $userBank->bank_id;
        $withdrawalRequest->bank_name = isset($userBank->bank) ? $userBank->bank->name:'';
        $withdrawalRequest->bank_short_name = isset($userBank->bank) ? $userBank->bank->short_name:'';
        $withdrawalRequest->account_holder = $userBank->account_holder;
        $withdrawalRequest->account_number = $userBank->account_number;
        $withdrawalRequest->account_branch = $userBank->account_branch;
        $withdrawalRequest->status_changed = 0;
        $withdrawalRequest->is_marketing = $user->is_marketing_account;
        $withdrawalRequest->save();

        $withdrawalRequestCode = $now->year.$now->month.$now->day.time().sprintf('%s%05s','',$withdrawalRequest->id);
        $withdrawalRequest->code = $withdrawalRequestCode;
        $withdrawalRequest->save();

        $reason = 'Gửi yêu cầu rút tiền';
        $user->changeMoney(0 - $amount,$reason,WalletTransactionType::WITHDRAW_MONEY,$withdrawalRequest->id,$withdrawalRequest->is_marketing,false);

        return response()->json([
            'code' => 200,
            'message' => 'Gửi yêu cầu rút tiền thành công. Vui lòng chờ quản trị viên xác nhận yêu cầu của bạn.'
        ]);
    }
    public function withdrawHistory(Request $request)
    {
        if(!Auth::check()) return $this->goLogin();
        $user = Auth::user();
        $listItems = $user->withdrawalRequest()->with('withdrawalRequestStatus')->orderBy('id','desc')->paginate(WithdrawalRequest::PAGINATION_NUMBER);
        if (isset(request()->type) && request()->type == 'load_item') {
            return response()->json([
                'code' => 200,
                'html' => view('auth.wallet.withdraw_history_result',compact('user','listItems'))->render()
            ]);
        }
        return view('auth.wallet.withdraw_history',compact('user','listItems'));
    }
}