<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Auth;
use App\Models\RechargeMethod;
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
}