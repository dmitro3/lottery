<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Auth;
use App\Commissions\Tree;
use App\Models\{
    User,
    CommissionTree,
    CommissionStatistics,
    CommissionIncurred,
    CommissionLevelConfig,
    CommissionUserDirectChildStatistics,
    WalletTransactionType
};

class MarketingController extends Controller
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
        $listCommissionLevelConfig = CommissionLevelConfig::orderBy('level','asc')->get();
        return view('auth.marketing.index', compact('user','listCommissionLevelConfig'));
    }
    public function introductionHistory (Request $request)
    {
        if(!Auth::check()) return $this->goLogin();
        $user = Auth::user();
        $listItems = User::where('introduce_user_id',$user->id)->paginate(20);
        if (isset(request()->type) && request()->type == 'load_item') {
            return response()->json([
                'code' => 200,
                'html' => view('auth.marketing.introduction_history_result',compact('user','listItems'))->render()
            ]);
        }
        return view('auth.marketing.introduction_history', compact('user','listItems'));
    }
    public function guide(Request $request)
    {
        if(!Auth::check()) return $this->goLogin();
        $user = Auth::user();
        $listCommissionLevelConfig = CommissionLevelConfig::orderBy('level','asc')->get();
        return view('auth.marketing.guide', compact('user','listCommissionLevelConfig'));
    }
    public function myTeam(Request $request)
    {
        if(!Auth::check()) return $this->goLogin();
        $user = Auth::user();
        return view('auth.marketing.my_team', compact('user'));
    }


    /* Cron function */
    public function updateUserAgencyLevel()
    {
        set_time_limit(-1);
        $lastWeekTime = now()->subWeek();
        $lastWeek = $lastWeekTime->format('W');
        $lastWeekYear = $lastWeekTime->year;
        $listUser = User::get();
        $listCommissionLevelConfig = CommissionLevelConfig::orderBy('level','asc')->get();
        foreach ($listUser as $itemUser) {
            $lastWeekCommissionUserDirectChildStatisticsRecord = CommissionUserDirectChildStatistics::where('week',$lastWeek)
                                                                                                    ->where('user_id',$itemUser->id)
                                                                                                    ->where('year',$lastWeekYear)
                                                                                                    ->first();
            if (!isset($lastWeekCommissionUserDirectChildStatisticsRecord)) {
                $itemUser->level = 0;
                $itemUser->save();
            }else{
                $level = 0;
                foreach ($listCommissionLevelConfig as $itemCommissionLevelConfig) {
                    if ($lastWeekCommissionUserDirectChildStatisticsRecord->total_amount >= $itemCommissionLevelConfig->total_direct_child_bet_condition) {
                        $level = $itemCommissionLevelConfig->level;
                    }else{
                        continue 1;
                    }
                }
                $itemUser->level = $level;
                $itemUser->save();
            }
        }
        echo 'Thành công';
    }
    public function initUserCommissionIncurred()
    {
        set_time_limit(-1);
        $listCommissionLevelConfig = CommissionLevelConfig::orderBy('level','asc')->get();
        $maxLevelTree = count($listCommissionLevelConfig);
        $listCommissionIncurred = CommissionIncurred::where('inited',0)->get();
        $arrCommissionLevelConfig = [];
        foreach ($listCommissionLevelConfig as $itemCommissionLevelConfig) {
            $arrCommissionLevelConfig[$itemCommissionLevelConfig->level] = $itemCommissionLevelConfig->level_percent;
        }
        foreach ($listCommissionIncurred as $itemCommissionIncurred) {
            $listParentUser = Tree::getListParentNode($itemCommissionIncurred->user_id,$maxLevelTree);
            foreach ($listParentUser as $itemParentUser) {
                if ($itemParentUser['user']->level >= $itemParentUser['level_deviant']) {
                    $currnetParentLevelPercent = isset($arrCommissionLevelConfig[$itemParentUser['level_deviant']]) ? $arrCommissionLevelConfig[$itemParentUser['level_deviant']]:0;
                    $amountAdd = $itemCommissionIncurred->amount*$currnetParentLevelPercent/100;
                    $reason = 'Cộng tiền hoa hồng đội từ thành viên F'.$itemParentUser['level_deviant'];
                    $itemParentUser['user']->changeMoney($amountAdd,$reason,WalletTransactionType::PLUS_COMMISSION_TEAM,$itemCommissionIncurred->id);
                }
            }
            $itemCommissionIncurred->inited = 1;
            $itemCommissionIncurred->save();
        }
        echo 'Thành công';
    }
    /* End cron function */
}