<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Auth;
use App\Models\User;
class AccountController extends Controller
{
    public function goLogin()
    {
        return \Support::response([
            'code' => 100,
            'message' => 'Vui lòng đăng nhập',
            'redirect' => \VRoute::get('login')
        ]);
    }
    public function profile(Request $request, $route)
    {
        if(!Auth::check()){
            return $this->goLogin();
        }
        $user = Auth::user();
        if ($request->isMethod("POST")) {
            return $this->updateProfile($request, $user);
        }
        return view('auth.account.profile', compact('user'));
    }
    public function getUserMoney(){
        if(!Auth::check()){
            return $this->goLogin();
        }
        $user = Auth::user();
        return response()->json([
            'code' => 200,
            'money' => number_format($user->getAmount(),0,',','.').' đ'
        ]);
    }

    public function switchChangePassword(Request $request, $route)
    {
        if(!Auth::check()){
            return $this->goLogin();
        }
        if($request->isMethod("POST")){
            return $this->changePass($request);
        }
        $user = Auth::user();
        return view('auth.account.change_password',compact('user'));
    }
    private function changePass($request){
        $user = Auth::user();
        $validator = $this->validatorChangePassword($request, $user);

        if (empty($user->password)) {
            $validator = $this->validatorPasswordNew($request);
        } else {
            $validator = $this->validatorChangePassword($request, $user);
        }

        if ($validator->fails()) {
            return response()->json([
            'code' => 100,
            'message' => $validator->errors()->first(),
            ]);
        }
        
        $user->password = \Hash::make($request->password);
        $user->save();
        Auth::logout();

        return response()->json([
            'code' => 200,
            'message' => 'Thay đổi mật khẩu thành công. Vui lòng đăng nhập lại.',
            'redirect_url' => 'dang-nhap'
        ]);
    }
    private function validatorChangePassword($request, $user)
    {
        return \Validator::make($request->all(), [
            'current_password' => ['required', function ($attr, $v, $fail) use ($user) {
                if (!\Hash::check($v, $user->password)) {
                    return $fail(trans("fdb::pass_cur_incorrect"));
                }
            }],
            'password' => ['required', 'confirmed','min:8','different:current_password'],
        ], [
            'required' => trans("fdb::pls_enter").' :attribute',
            'min' => ':attribute '.trans("fdb::at_le").' :min '.trans("fdb::crt"),
            'confirmed' => ':attribute '.trans('fdb::dnm'),
            'different' => trans("fdb::different_pass"),
        ], [
            'current_password' => trans("fdb::current_password"),
            'password' => trans("fdb::pass_new"),
            'password_confirmation' => trans("fdb::pass_confirm"),
        ]);
    }
    private function validatorPasswordNew($request)
    {
        return \Validator::make($request->all(), [
            'password' => ['required', 'confirmed', 'min:8'],
        ], [
            'required' => trans("fdb::pls_enter").' :attribute',
            'min' => ':attribute '.trans("fdb::at_le").' :min '.trans("fdb::crt"),
            'confirmed' => ':attribute '.trans('fdb::dnm'),
        ], [
            'password' => trans("fdb::pass_new"),
            'password_confirmation' => trans("fdb::pass_confirm"),
        ]);
    }
}