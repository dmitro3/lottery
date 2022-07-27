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
        $listCommissionLevelConfig = CommissionLevelConfig::orderBy('level','asc')->get();
        $userCommissionStatisticsCurrentDayRecord = CommissionStatistics::getCurrentDayRecord($user->id);
        return view('auth.marketing.index', compact('user','listCommissionLevelConfig','userCommissionStatisticsCurrentDayRecord','dataStatical'));
    }
    public function introductionHistory (Request $request)
    {
        if(!Auth::check()) return $this->goLogin();
        $user = Auth::user();
        $listItems = User::where('introduce_user_id',$user->id)->orderBy('id','desc')->paginate(20);
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
        $listCommissionLevelConfig = CommissionLevelConfig::orderBy('level','asc')->get();
        $user = Auth::user();
        $maxLevelTree = count($listCommissionLevelConfig);
        $userTreeNode = CommissionTree::getTreeNode($user->id);
        $listItems = [];
        if (isset($userTreeNode)) {
            $childLevel = request()->child_level ?? null;
            $uid = request()->uid ?? null;
            $listItems = CommissionTree::whereRaw('FIND_IN_SET(?, list_parent)', [$user->id])
                                        ->whereHas('user')
                                        ->with('directChild')
                                        ->with(['user'=>function($q){
                                            $q->with('wallet');
                                        }])
                                        ->where('level','<=',$userTreeNode->level+$maxLevelTree)
                                        ->when($childLevel,function($q) use ($childLevel,$userTreeNode){
                                            $q->where('level',$childLevel + $userTreeNode->level);
                                        })
                                        ->when($uid,function($q) use ($uid){
                                            $q->where('user_id',$uid);
                                        })
                                        ->paginate(20);
            if (isset(request()->type) && request()->type == 'load_item') {
                return response()->json([
                    'code' => 200,
                    'html' => view('auth.marketing.my_team_result',compact('user','listItems'))->render()
                ]);
            }
        }
        return view('auth.marketing.my_team', compact('user','listCommissionLevelConfig','listItems'));
    }
    public function receiptHistory(Request $request)
    {
        if(!Auth::check()) return $this->goLogin();
        $user = Auth::user();
        $userWaller = $user->getWallet();
        $listItems = $userWaller->walletHistory()
                                ->with('walletTransactionType')
                                ->where('type',WalletTransactionType::PLUS_COMMISSION_TEAM)
                                ->orderBy('id','desc')
                                ->paginate(20);
        if (isset(request()->type) && request()->type == 'load_item') {
            return response()->json([
                'code' => 200,
                'html' => view('auth.marketing.receipt_history_result',compact('user','listItems'))->render()
            ]);
        }
        return view('auth.marketing.receipt_history',compact('user','listItems'));
    }
}