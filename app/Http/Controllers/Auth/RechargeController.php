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
            default:
                return response()->json([
                    'code' => 100,
                    'html' => '<p class=""m-t-10>Phương thức thanh toán tạm thời không khả dụng.</p>'
                ]);
                break;
        }
    }
    public function viewDirectTransferMethod($rechargeMethod)
    {
        return response()->json([
            'code' => 200,
            'html' => view('auth.wallet.recharge_method.direct_transfer',compact('rechargeMethod'))->render()
        ]);
    }
    protected function validatorSendDirectTransfer(array $data)
    {
        return Validator::make($data, [
            'amount' => ['required','numeric','min:50000','max:1000000000'],
        ], [
            'required' => 'Vui lòng nhập :attribute',
            'amount.numeric' => 'Vui lòng nhập số tiền ở dạng số nguyên',
            'amount.min' => 'Số tiền chuyển khoản tối thiểu 50.000 đ',
            'amount.max' => 'Số tiền chuyển khoản tối đa 1000.000.000 đ',
        ], [
            'amount' => 'Số tiền',
        ]);
    }
    public function sendDirectTransferRecharge(Request $request)
    {
        if(!Auth::check()) return $this->goLogin();
        $user = Auth::user();
        $validator = $this->validatorSendDirectTransfer($request->all());
        if ($validator->fails()) {
            return response()->json([
                'code' => 100,
                'message' => $validator->errors()->first(),
            ]);
        }
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
        $rechargeRequest->recharge_method_id = RechargeMethod::DIRECT_TRANSFER_METHOD;
        $rechargeRequest->recharge_status_id = RechargeStatus::STATUS_WAIT_CONFIRM;
        $rechargeRequest->amount = $request->amount;
        $rechargeRequest->recharged = 0;
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
            'html'      => view('auth.wallet.recharge_method.direct_transfer_done_result',compact('rechargeMethod','rechargeRequest','rechargeRequestDirectTransferBankInfo'))->render()
        ]);
    }
}