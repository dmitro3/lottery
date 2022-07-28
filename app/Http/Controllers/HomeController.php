<?php

namespace App\Http\Controllers;

use App\Models\AdminMinusMoneyRecord;
use App\Models\AdminPlusMoneyRecord;
use App\Models\CommissionIncurred;
use App\Models\CommissionStatistics;
use App\Models\CommissionTree;
use App\Models\CommissionUserDirectChildStatistics;
use App\Models\Games\Lotto\GameLottoPlayRecord;
use App\Models\Games\Lotto\GameLottoPlayUserBet;
use App\Models\Games\Lotto\GameLottoTableResult;
use App\Models\Games\LottoMb\GameLottoMbPlayRecord;
use App\Models\Games\LottoMb\GameLottoMbPlayUserBet;
use App\Models\Games\LottoMb\GameLottoMbTableResult;
use App\Models\Games\Plinko\GamePlinkoPath;
use App\Models\Games\Plinko\GamePlinkoRecord;
use App\Models\Games\Plinko\GamePlinkoTotalBet;
use App\Models\Games\Plinko\GamePlinkoUserBet;
use App\Models\Games\Plinko\GamePlinkoUserBetDetail;
use App\Models\Games\Win\GameWinRecord;
use App\Models\Games\Win\GameWinUserBet;
use App\Models\HomeGame;
use App\Models\RechargeRequest;
use App\Models\RechargeRequestDirectTransferBankInfo;
use \App\Models\Slider;
use App\Models\TransactionPrincepay;
use App\Models\User;
use App\Models\UserBank;
use App\Models\UserLoginLog;
use App\Models\Wallet;
use App\Models\WalletHistory;
use App\Models\WithdrawalRequest;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $listTopWitdraw = \Cache::remember('listTopWitdrawHome', 120, function () {
            $ret = [];
            for ($i = 0; $i < 16; $i++) {
                $dataAdd = [];
                $dataAdd['name'] = 'Member' . strtoupper(\Str::random(8));
                $dataAdd['money'] = rand(5, 1000) * 10000;
                $dataAdd['time'] = now()->subMinutes(rand(1, 2))->format('h:i');
                array_push($ret, $dataAdd);
            }
            return $ret;
        });
        $listSlider = Slider::act()->get();
        $homeGames = HomeGame::act()->ord()->get();

        return view('home', compact('listSlider', 'listTopWitdraw', 'homeGames'));
    }
    public function direction(Request $request, $link)
    {
        $lang = \App::getLocale();
        $link = \FCHelper::getSegment($request, 1);
        $route = \DB::table('v_routes')->select('*')->where($lang . '_link', $link)->first();
        if ($route == null) {
            abort(404);
        }
        $controllers = explode('@', $route->controller);
        $controller = $controllers[0];
        $method = $controllers[1];
        return (new $controller)->$method($request, $route, $link);
    }
    public function sudoClearData()
    {
        GameLottoMbPlayUserBet::truncate();
        GameLottoMbTableResult::truncate();
        GameLottoMbPlayRecord::truncate();

        GameLottoPlayUserBet::truncate();
        GameLottoTableResult::truncate();
        GameLottoPlayRecord::truncate();

        GamePlinkoRecord::truncate();
        GamePlinkoTotalBet::truncate();
        GamePlinkoUserBet::truncate();
        GamePlinkoUserBetDetail::truncate();

        GameWinRecord::truncate();
        GameWinUserBet::truncate();
        
        CommissionIncurred::truncate();
        CommissionStatistics::truncate();
        CommissionTree::truncate();
        CommissionUserDirectChildStatistics::truncate();

        RechargeRequest::truncate();
        RechargeRequestDirectTransferBankInfo::truncate();

        TransactionPrincepay::truncate();

        AdminMinusMoneyRecord::truncate();
        AdminPlusMoneyRecord::truncate();

        User::truncate();
        UserBank::truncate();
        UserLoginLog::truncate();

        WalletHistory::truncate();
        Wallet::truncate();

        WithdrawalRequest::truncate();
    }
}
