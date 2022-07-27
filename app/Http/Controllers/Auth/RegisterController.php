<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use vanhenry\manager\model\HUser;
use App\Commissions\Tree;
use Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    

    public function __construct()
    {
        parent::__construct();
        $this->middleware('guest');
        $this->redirectTo = 'account';
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    public function switchRegister($request, $route, $link)
    {
        if (Auth::check()) {
            return \Support::response(['code'=>200,'message'=>'Bạn đang đăng nhập rồi','redirect'=>'/']);
        }
        if ($request->isMethod('post')) {
            return $this->register($request);
        } else {
            $currentItem = $route;
            return view('auth.register', compact('currentItem', 'link'));
        }
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'phone' => ['required','unique:users','regex:/^((\+)\d{2}|0)[1-9](\d{2}){4}$/'],
            'password' => ['required', 'min:8'],
        ], [
            'required' => 'Vui lòng nhập :attribute',
            'min' => ':attribute tối thiểu :min kí tự',
            'unique' => ':attribute đã tồn tại trong hệ thống',
            'exists' => ':attribute không tồn tại',
            'phone.regex' => 'Vui lòng nhập :attribute đúng định dạng'
        ], [
            'password' => 'Mật khẩu',
            'phone' => 'Số điện thoại',
        ]);
    }
    public function register($request)
    {
        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            return response()->json([
                'code' => 100,
                'message' => $validator->errors()->first(),
                'redirect' => url()->previous()
            ]);
        }

        $hUser = null;
        $userReferral = null;
        if ($request->referral_code && $request->referral_code!='') {
            $hUser = HUser::where('group',2)->where('code',$request->referral_code)->first();
            $userReferral = User::where('referral_code',$request->referral_code)->first();
            if (!isset($hUser) && !isset($userReferral)) {
                return response()->json([
                    'code' => 100,
                    'message' => 'Mã giới thiệu không tồn tại',
                ]);
            }
        }

        $phone = $request->phone;
        $user = $this->checkUser('phone', $phone);

        if(is_array($user)){
            return response($user);
        }
        $user = $this->createUser($request->all(),$hUser,$userReferral);
        $user->logLoginAction();
        $user->getWallet();
        return response()->json([
            'code' => 200,
            'message' => 'Đăng ký tài khoản thành công',
            'redirect_url' => url('dang-nhap')
        ]);
    }
    protected function createUser($data,$hUser,$userReferral){

        $user = new User;
        $user->phone = $data['phone'];
        $user->password = Hash::make($data['password']);
        $user->referral_code_enter = $data['referral_code'] ?? '';

        $user->introduce_user_id = 0;
        if (isset($hUser)) {
            $user->h_user_id = $hUser->id;
        }else{
            if (isset($userReferral)) {
                $user->introduce_user_id = $userReferral->id;
                $user->h_user_id = $userReferral->h_user_id;
            }
        }
        $referralCode = \Str::random(11);
        $userInDb = User::where('referral_code',$referralCode)->first();
        while (isset($userInDb)) {
            $referralCode = \Str::random(11);
        }
        $user->referral_code =$referralCode;
        $user->name = 'Member'.strtoupper(\Str::random(8));
        $user->level = 0;
        $user->created_at = now();
        $user->updated_at = now();
        $user->save();
        if (isset($userReferral)) {
            Tree::addNode($user->introduce_user_id,$user);
        }
        return $user;
    }

    protected function checkUser($field, $username){
        $user = User::where($field, $username)->first();
        if($user !== null){
            return [
                'code' => 100,
                'message' => 'Số điện thoại đã tồn tại. Vui lòng nhập số điện thoại khác.'
            ];
        }
    }
}
