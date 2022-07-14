<?php
namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Auth;
use App\Models\{
    UserLoginLog,
    Bank,
    UserBank
};
class AccountController extends Controller
{
    public function goLogin()
    {
        return \Support::response([
            'code' => 100,
            'message' => 'Vui lòng đăng nhập',
            'redirect' => 'dang-nhap'
        ]);
    }
    public function account(Request $request)
    {
        if(!Auth::check()) return $this->goLogin();
        $user = Auth::user();
        return view('auth.account.account', compact('user'));
    }
    public function profile (Request $request)
    {
        if(!Auth::check()) return $this->goLogin();
        $user = Auth::user();
        if ($request->isMethod("POST")) {
            return $this->updateProfile($request, $user);
        }
        return view('auth.account.profile', compact('user'));
    }
    public function updateProfile($request, $user)
    {
        if (!isset($request->name) || $request->name == '') {
            return response()->json([
                'code' => 100,
                'message' => 'Vui lòng nhập tên người dùng.'
            ]);
        }
        if (\Str::length($request->name) > 16) {
            return response()->json([
                'code' => 100,
                'message' => 'Tên người dùng không thể dài quá 16 kí tự'
            ]);
        }
        $user->name = $request->name;
        $user->save();
        return response()->json([
            'code' => 200,
            'message' => 'Cập nhật thông tin thành công'
        ]);
    }

    public function switchChangePassword(Request $request, $route)
    {
        if(!Auth::check()) return $this->goLogin();
        if($request->isMethod("POST")){
            return $this->changePass($request);
        }
        $user = Auth::user();
        return view('auth.account.change_password',compact('user'));
    }
    private function changePass($request){
        $user = Auth::user();
        $validator = $this->validatorChangePassword($request, $user);

        return response()->json([
            'code' => 200,
            'message' => 'Thay đổi mật khẩu thành công. Vui lòng đăng nhập lại.',
            'redirect_url' => 'dang-nhap'
        ]);
    }
    public function getUserMoney(){
        if(!Auth::check()) return $this->goLogin();
        $user = Auth::user();
        return response()->json([
            'code' => 200,
            'money' => number_format($user->getAmount(),0,',','.').' đ'
        ]);
    }
    public function loginLog()
    {
        if(!Auth::check()) return $this->goLogin();
        $user = Auth::user();
        $listItems = $user->loginLog()->orderBy('id','desc')->paginate(UserLoginLog::PAGINATION_NUMBER);
        if (isset(request()->type) && request()->type == 'load_item') {
            return response()->json([
                'code' => 200,
                'html' => view('auth.account.login_log_ajax',compact('user','listItems'))->render()
            ]);
        }
        return view('auth.account.login_log',compact('user','listItems'));
    }
    public function addBankAccount(Request $request)
    {
        if(!Auth::check()) return $this->goLogin();
        $user = Auth::user();
        $listBanks = Bank::act()->get();
        return view('auth.account.add_bank_account',compact('user','listBanks'));
    }

    protected function validatorSendAddBankAccount(array $data)
    {
        return Validator::make($data, [
            'bank_id' => ['required','exists:banks,id'],
            'account_holder' => ['required'],
            'account_number' => ['required'],
            'email' => ['required'],
            'phone' => ['required','regex:/^((\+)\d{2}|0)[1-9](\d{2}){4}$/'],
        ], [
            'required' => 'Vui lòng nhập :attribute!',
            'phone.regex' => 'Vui lòng nhập đúng định dang số điện thoại!',
            'bank_id.exists' => 'Dữ liệu ngân hàng không hợp lệ!',
        ], [
            'bank_id' => 'Ngân hàng',
            'account_holder' => 'Tên chủ tài khoản',
            'account_number' => 'Số tài khoản',
            'email' => 'Email',
            'phone' => 'Số điện thoại',
        ]);
    }

    public function sendAddBankAccount(Request $request)
    {
        if(!Auth::check()) return $this->goLogin();
        $user = Auth::user();
        $userBank = $user->userBank()->first();
        if ($userBank) {
            return response()->json([
                'code' => 100,
                'message' => 'Bạn đã ràng buộc thẻ ngân hàng, vui lòng liên hệ với bộ phận chăm sóc khách hàng để sửa đổi.'
            ]);
        }
        $validator = $this->validatorSendAddBankAccount($request->all());
        if ($validator->fails()) {
            return response()->json([
                'code' => 100,
                'message' => $validator->errors()->first(),
            ]);
        }
        $userBank = new UserBank;
        $userBank->user_id = $user->id;
        $userBank->bank_id = $request->bank_id;
        $userBank->account_holder = $request->account_holder;
        $userBank->account_number = $request->account_number;
        $userBank->account_branch = $request->account_branch ?? '';
        $userBank->email = $request->email;
        $userBank->phone = $request->phone;
        $userBank->province = $request->province ?? '';
        $userBank->default = 1;
        $userBank->save();
        
        return response()->json([
            'code' => 200,
            'message' => 'Liên kết tài khoản ngân hàng thành công',
            'back_link' => $request->back_link ?? 'tai-khoan/rut-tien?'
        ]);
    }
    public function transactionHistory ()
    {
        if(!Auth::check()) return $this->goLogin();
        $user = Auth::user();
        $userWaller = $user->getWallet();
        $listItems = $userWaller->walletHistory()
                                ->with('walletTransactionType')
                                ->orderBy('id','desc')
                                ->paginate(20);
        if (isset(request()->type) && request()->type == 'load_item') {
            return response()->json([
                'code' => 200,
                'html' => view('auth.account.transaction_history_ajax',compact('user','listItems'))->render()
            ]);
        }
        return view('auth.account.transaction_history',compact('user','listItems'));
    }
    public function betHistory()
    {
        if(!Auth::check()) return $this->goLogin();
        $user = Auth::user();
        return view('auth.account.bet_history',compact('user'));
    }
    public function wingoBetHistory()
    {
        if(!Auth::check()) return $this->goLogin();
        $user = Auth::user();
        $listItems = $user->gameWinUserBet()
                        ->with('gameWinUserBetStatus','gameWinType')
                        ->orderBy('id','desc')
                        ->paginate(20);
        $type = 'normal';
        if (isset(request()->type) && request()->type == 'load_item') {
            $type = 'load_item';
        }
        return response()->json([
            'code' => 200,
            'html' => view('auth.account.wingo_bet_history_result',compact('user','listItems','type'))->render()
        ]);
    }
    public function plinkoBetHistory()
    {
        if(!Auth::check()) return $this->goLogin();
        $user = Auth::user();
        $listItems = $user->gamePlinkoUserBet()
                        ->orderBy('id','desc')
                        ->paginate(20);
        $type = 'normal';
        if (isset(request()->type) && request()->type == 'load_item') {
            $type = 'load_item';
        }
        return response()->json([
            'code' => 200,
            'html' => view('auth.account.plinko_bet_history_result',compact('user','listItems','type'))->render()
        ]);
    }
}