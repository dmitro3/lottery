<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Auth;
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
        $listItems = $user->loginLog()->paginate(20);
        if (isset(request()->type) && request()->type == 'load_item') {
            return response()->json([
                'code' => 200,
                'html' => view('auth.account.login_log_ajax',compact('user','listItems'))->render()
            ]);
        }
        return view('auth.account.login_log',compact('user','listItems'));
    }
}