<?php 
namespace vanhenry\manager\controller;

use App\Models\AdminMinusMoneyRecord;
use App\Models\AdminPlusMoneyRecord;
use App\Models\Bank;
use App\Models\CommissionStatistics;
use App\Models\CommissionTree;
use App\Models\RechargeMethod;
use App\Models\RechargeRequest;
use App\Models\RechargeStatus;
use App\Models\User;
use App\Models\WalletTransactionType;
use App\Models\WithdrawalRequestStatus;
use Validator;
use vanhenry\manager\model\HUser;
use vanhenry\manager\statisticals\UserStatical;

class UserManageController extends Admin
{
    public function __construct()
    {
        parent::__construct();
    }
    public function userInfo()
    {
        $userId = request()->id ?? 0;
        $user = User::with('hUser','userIntroduce')->find($userId);
        if (!isset($user)) {
            abort(404);
        }
        $userTreeNode = CommissionTree::getTreeNode($user->id);
        $dataStatical = [];
        if (isset($userTreeNode)) {
            $dataStatical['total_f1'] = $userTreeNode->getCountDirectChild();
            $dataStatical['total_child'] = $userTreeNode->getTotalChild();
            $dataStatical['total_f1_today'] = $userTreeNode->directChild()->where('created_at','>=',now()->startOfDay())->count();
            $dataStatical['total_child_today'] = $userTreeNode->getTotalChildToday();
            $dataStatical['total_commission_week'] = CommissionStatistics::getTotalAmountWeek($user->id);
            $dataStatical['total_commission'] = CommissionStatistics::getTotalAmount($user->id);
        }
        $listAdminAgencyUser = HUser::where('group',2)->get();
        $listBank = Bank::get();
        return view('vh::user_manages.user_info',compact('user','listAdminAgencyUser','listBank','dataStatical'));
    }
    public function loadUserStaticalMoney()
    {
        $userId = request()->user ?? 0;
        $user = User::with('hUser','userIntroduce')->find($userId);
        if (!isset($user)) {
            return response()->json([]);
        }
        $userAmount = $user->getAmount();
        $totalCollect = UserStatical::getUserTotalCollect($user);
        $totalSpend = UserStatical::getUserTotalSpend($user);
        $profitFinal = $totalCollect - $totalSpend;
        return response()->json([
            'user_amount' => \Currency::showMoney($userAmount),
            'total_collect' => \Currency::showMoney($totalCollect),
            'total_spend' => \Currency::showMoney($totalSpend),
            'profit_final' => \Currency::showMoney($profitFinal),
        ]);
    }
    public function loadUserWithdrawRequest()
    {
        $userId = request()->user ?? 0;
        $user = User::find($userId);
        if (!isset($user)) return '';
        $listWithdrawalRequestStatus = WithdrawalRequestStatus::get();
        $listItems = $user->withdrawalRequest()
                        ->with('withdrawalRequestStatus')
                        ->orderBy('id','desc')
                        ->paginate(10);
        return view('vh::user_manages.user_withdraw_request_result',compact('user','listItems','listWithdrawalRequestStatus'));
    }
    public function changeUserWithdrawRequest()
    {
        $userId = request()->user ?? 0;
        $user = User::find($userId);
        if (!isset($user)) return response()->json(['code'=>100,'message'=>'Không tìm thấy thông tin!']);
        $itemWithdrawalRequest = $user->withdrawalRequest()->find(request()->item ?? 0);
        if (!isset($itemWithdrawalRequest)) return response()->json(['code'=>100,'message'=>'Không tìm thấy thông tin!']);
        if ($itemWithdrawalRequest->status_changed != 0) {
            return response()->json([
                'code'=>100,
                'message'=>'Mỗi lệnh rút tiền chỉ có thể thay đổi trạng thái một lần!'
            ]);
        }
        $status = WithdrawalRequestStatus::find(request()->status ?? 0);
        if (!isset($status)) return response()->json(['code'=>100,'message'=>'Không tìm thấy trạng thái!']);

        if ($itemWithdrawalRequest->withdrawal_request_status_id != $status->id) {
            if ($status->id == WithdrawalRequestStatus::STATUS_CANCEL) {
                $reason = 'Hoàn tiền khi hủy yêu cầu rút tiền';
                $user->changeMoney($itemWithdrawalRequest->amount,$reason,WalletTransactionType::REFUND_CANCEL_WITHDRAWAL_REQUEST,$itemWithdrawalRequest->id,$itemWithdrawalRequest->is_marketing,false);
            }
            $itemWithdrawalRequest->withdrawal_request_status_id = $status->id;
            $itemWithdrawalRequest->status_changed = 1;
            $itemWithdrawalRequest->status_changed_at = now();
            if (\Auth::guard('h_users')->check()) {
                $itemWithdrawalRequest->h_user_id = \Auth::guard('h_users')->id();
            }
            $itemWithdrawalRequest->save();
        }
        return response()->json([
            'code'=>200,
            'message'=>'Đổi trạng thái thành công'
        ]);
    }
    public function loadUserRechargeRequest()
    {
        $userId = request()->user ?? 0;
        $user = User::find($userId);
        if (!isset($user)) return '';
        $listRechargeStatus = RechargeStatus::get();
        $listItems = $user->rechargeRequest()
                        ->with('rechargeStatus','rechargeMethod','rechargeRequestDirectTransferBankInfo')
                        ->orderBy('id','desc')
                        ->paginate(10);
        return view('vh::user_manages.user_recharge_request_result',compact('user','listItems','listRechargeStatus'));
    }
    public function changeUserRechargeRequest()
    {
        $userId = request()->user ?? 0;
        $user = User::find($userId);
        if (!isset($user)) return response()->json(['code'=>100,'message'=>'Không tìm thấy thông tin!']);

        $itemRechargeRequest = $user->rechargeRequest()->find(request()->item ?? 0);
        if (!isset($itemRechargeRequest)) return response()->json(['code'=>100,'message'=>'Không tìm thấy thông tin!']);
        if ($itemRechargeRequest->recharged != 0) {
            return response()->json([
                'code'=>100,
                'message'=>'Mỗi lệnh nạp tiền chỉ có thể thay đổi trạng thái một lần!'
            ]);
        }
        $status = WithdrawalRequestStatus::find(request()->status ?? 0);
        if (!isset($status)) return response()->json(['code'=>100,'message'=>'Không tìm thấy trạng thái!']);
        if ($itemRechargeRequest->recharge_status_id != $status->id) {
            if ($itemRechargeRequest->recharge_method_id == RechargeMethod::DIRECT_TRANSFER_METHOD) {
                if ($status->id == RechargeStatus::STATUS_CONFIRMED) {
                    $reason = 'Cộng tiền chuyển khoản trực tiếp';
                    $user->changeMoney($itemRechargeRequest->amount,$reason,WalletTransactionType::RECHARGE_MONEY,$itemRechargeRequest->id,$itemRechargeRequest->is_marketing,false);
                }
                $itemRechargeRequest->recharge_status_id = $status->id;
                $itemRechargeRequest->recharged = 1;
                $itemRechargeRequest->recharged_at = now();
                if (\Auth::guard('h_users')->check()) {
                    $itemRechargeRequest->h_user_id = \Auth::guard('h_users')->id();
                }
                $itemRechargeRequest->save();
            }
        }
        return response()->json([
            'code'=>200,
            'message'=>'Đổi trạng thái thành công'
        ]);
    }
    protected function validatorUpdateUserInfo(array $data)
    {
        return Validator::make($data, [
            'name' => ['required'],
            'h_user_id' => ['required'],
            'phone' => ['required','regex:/^((\+)\d{2}|0)[1-9](\d{2}){4}$/'],
        ], [
            'required' => 'Vui lòng nhập :attribute',
            'phone.regex' => 'Vui lòng nhập :attribute đúng định dạng'
        ], [
            'name'  => 'Tên người dùng',
            'phone' => 'Số điện thoại',
            'h_user_id' => 'Đại lý',
        ]);
    }
    public function editUserInfo()
    {
        $userId = request()->user ?? 0;
        $user = User::find($userId);
        if (!isset($user)) return response()->json(['code'=>100,'message'=>'Không tìm thấy thông tin người dùng!']);
        $validator = $this->validatorUpdateUserInfo(request()->all());
        if ($validator->fails()) {
            return response()->json([
                'code' => 100,
                'message' => $validator->errors()->first(),
            ]);
        }
        $userPhoneCheck = User::where('id','!=',$user->id)->where('phone',request()->phone)->first();
        if (isset($userPhoneCheck)) return response()->json(['code'=>100,'message'=>'Số điện thoại này đã tồn tại trong hệ thống!']);
        $user->name = request()->name;
        $user->phone = request()->phone;
        $user->h_user_id = request()->h_user_id;
        $user->save();
        return response()->json([
            'code' => 200,
            'message' => 'Thay đổi thông tin thành công!',
        ]);
    }
    public function userChangeStatus()
    {
        $userId = request()->user ?? 0;
        $user = User::find($userId);
        if (!isset($user)) return response()->json(['code'=>100,'message'=>'Không tìm thấy thông tin người dùng!']);
        if ($user->act == 1) {
            $user->act = 0;
            $user->save();
            return response()->json([
                'code' => 200,
                'message' => 'Khóa tài khoản thành công!',
            ]);
        }
        if ($user->act != 1) {
            $user->act = 1;
            $user->save();
            return response()->json([
                'code' => 200,
                'message' => 'Mở khóa tài khoản thành công!',
            ]);
        }
    }

    protected function validatorUpdateUserBankInfo(array $data)
    {
        return Validator::make($data, [
            'user_bank_id' => ['required','exists:user_banks,id'],
            'bank_id' => ['required','exists:banks,id'],
            'phone' => ['required','regex:/^((\+)\d{2}|0)[1-9](\d{2}){4}$/'],
            'account_holder' => ['required'],
            'account_number' => ['required'],
        ], [
            'required' => 'Vui lòng nhập :attribute',
            'exists' => ':attribute không tồn tại trong hệ thống',
            'phone.regex' => 'Vui lòng nhập :attribute đúng định dạng'
        ], [
            'user_bank_id'  => 'Thông tin ngân hàng người dùng',
            'bank_id'  => 'Ngân hàng',
            'phone' => 'Số điện thoại',
            'account_holder' => 'Chủ tài khoản',
            'account_number' => 'Số tài khoản',
        ]);
    }
    public function editUserBankInfo()
    {
        $userId = request()->user ?? 0;
        $user = User::find($userId);
        if (!isset($user)) return response()->json(['code'=>100,'message'=>'Không tìm thấy thông tin người dùng!']);
        $validator = $this->validatorUpdateUserBankInfo(request()->all());
        if ($validator->fails()) {
            return response()->json([
                'code' => 100,
                'message' => $validator->errors()->first(),
            ]);
        }
        $userBank = $user->userBank()->find(request()->user_bank_id);
        $userBank->bank_id = request()->bank_id;
        $userBank->account_holder = request()->account_holder;
        $userBank->account_number = request()->account_number;
        $userBank->account_branch = request()->account_branch ?? '';
        $userBank->email = request()->email ?? '';
        $userBank->phone = request()->phone ?? '';
        $userBank->province = request()->province ?? '';
        $userBank->save();

        return response()->json([
            'code' => 200,
            'message' => 'Thay đổi thông tin thành công!',
        ]);
    }

    protected function validatorAdminPlusUserMoney(array $data)
    {
        $arrTransactionType = [WalletTransactionType::RECHARGE_MONEY,WalletTransactionType::ADMIN_PLUS_MONEY];
        return Validator::make($data, [
            'amount' => ['required','numeric','min:1'],
            'transaction_type' => ['required','in:'.implode(',',$arrTransactionType)],
        ], [
            'required' => 'Vui lòng nhập :attribute',
            'numeric' => 'Vui lòng nhập đúng định dạng số tiền',
            'amount.min' => 'Số tiền phải lớn hơn 0',
            'in' => 'Giá trị :attribute không hợp lệ'
        ], [
            'amount'  => 'Số tiền',
            'transaction_type'  => 'Phương thức nạp tiền',
        ]);
    }
    public function plusUserMoney()
    {
        $userId = request()->user ?? 0;
        $user = User::find($userId);
        if (!isset($user)) return response()->json(['code'=>100,'message'=>'Không tìm thấy thông tin người dùng!']);
        $validator = $this->validatorAdminPlusUserMoney(request()->all());
        if ($validator->fails()) {
            return response()->json([
                'code' => 100,
                'message' => $validator->errors()->first(),
            ]);
        }
        $adminPlusMoneyRecord = new AdminPlusMoneyRecord;
        $adminPlusMoneyRecord->user_id = $user->id;
        $adminPlusMoneyRecord->is_marketing = $user->is_marketing_account;
        $adminPlusMoneyRecord->wallet_transaction_type_id = request()->transaction_type;
        $adminPlusMoneyRecord->amount = abs(request()->amount);
        if (\Auth::guard('h_users')->check()) {
            $adminPlusMoneyRecord->h_user_id = \Auth::guard('h_users')->id();
        }
        $adminPlusMoneyRecord->save();
        $reason = 'Admin cộng tiền';
        $user->changeMoney($adminPlusMoneyRecord->amount,$reason,$adminPlusMoneyRecord->wallet_transaction_type_id,$adminPlusMoneyRecord->id,$adminPlusMoneyRecord->is_marketing,false);
        return response()->json([
            'code' => 200,
            'message' => 'Cộng tiền thành công',
        ]);
    }

    protected function validatorAdminMinusUserMoney(array $data)
    {
        $arrTransactionType = [WalletTransactionType::WITHDRAW_MONEY,WalletTransactionType::ADMIN_MINUS_MONEY];
        return Validator::make($data, [
            'amount' => ['required','numeric','min:1'],
            'transaction_type' => ['required','in:'.implode(',',$arrTransactionType)],
        ], [
            'required' => 'Vui lòng nhập :attribute',
            'numeric' => 'Vui lòng nhập đúng định dạng số tiền',
            'amount.min' => 'Số tiền phải lớn hơn 0',
            'in' => 'Giá trị :attribute không hợp lệ'
        ], [
            'amount'  => 'Số tiền',
            'transaction_type'  => 'Phương thức nạp tiền',
        ]);
    }
    public function minusUserMoney()
    {
        $userId = request()->user ?? 0;
        $user = User::find($userId);
        if (!isset($user)) return response()->json(['code'=>100,'message'=>'Không tìm thấy thông tin người dùng!']);
        $validator = $this->validatorAdminMinusUserMoney(request()->all());
        if ($validator->fails()) {
            return response()->json([
                'code' => 100,
                'message' => $validator->errors()->first(),
            ]);
        }
        $adminMinusMoneyRecord = new AdminMinusMoneyRecord();
        $adminMinusMoneyRecord->user_id = $user->id;
        $adminMinusMoneyRecord->is_marketing = $user->is_marketing_account;
        $adminMinusMoneyRecord->wallet_transaction_type_id = request()->transaction_type;
        $adminMinusMoneyRecord->amount = abs(request()->amount);
        if (\Auth::guard('h_users')->check()) {
            $adminMinusMoneyRecord->h_user_id = \Auth::guard('h_users')->id();
        }
        $adminMinusMoneyRecord->save();
        $reason = 'Admin trừ tiền';
        $user->changeMoney(0 - $adminMinusMoneyRecord->amount,$reason,$adminMinusMoneyRecord->wallet_transaction_type_id,$adminMinusMoneyRecord->id,$adminMinusMoneyRecord->is_marketing,false);
        return response()->json([
            'code' => 200,
            'message' => 'Trừ tiền thành công',
        ]);
    }
    public function topRechargeUser()
    {
        $listItems = RechargeRequest::whereHas('user')
                                    ->includedTheCost()
                                    ->with('user')
                                    ->select('user_id','amount',\DB::raw("SUM(amount) as total_amount"))
                                    ->where('recharge_status_id',RechargeStatus::STATUS_CONFIRMED)
                                    ->groupBy('user_id')
                                    ->orderBy('total_amount','desc')
                                    ->paginate(10);
        return view('vh::pages.top_recharge_user',compact('listItems'));
    }
}
