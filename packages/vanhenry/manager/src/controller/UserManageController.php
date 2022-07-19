<?php 
namespace vanhenry\manager\controller;
use App\Models\User;
class UserManageController extends Admin
{
    public function __construct()
    {
        parent::__construct();
    }
    public function userInfo()
    {
        $userId = request()->id ?? 0;
        $user = User::find($userId);
        if (!isset($user)) {
            abort(404);
        }
        return view('vh::user_manages.user_info',compact('user'));
    }
    public function loadUserWithdrawRequest()
    {
        $userId = request()->user ?? 0;
        $user = User::find($userId);
        if (!isset($user)) return '';
        $listItems = $user->withdrawalRequest()->paginate(10);
        return view('vh::user_manages.user_withdraw_request_result',compact('user','listItems'));
    }
}
