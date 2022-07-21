<?php 
namespace vanhenry\manager\controller;

use App\Models\WalletHistory;
use App\Models\WalletTransactionType;
use App\Models\WithdrawalRequest;
use App\Models\WithdrawalRequestStatus;
use Carbon\Carbon;
use vanhenry\manager\statisticals\SystemStatical;

class SystemStaticalController extends Admin
{
    public function __construct()
    {
        parent::__construct();
    }

    public function analysisRequestTime()
    {
        $startDate = now()->startOfMonth();
        $endDate = now();
        if (request()->time) {
            $time = request()->time ?? '';
            $infoTime   = explode('-',$time);
            $startTimeRequest   = isset($infoTime[0]) ? $infoTime[0]:"null";
            $endTimeRequest     = isset($infoTime[1]) ? $infoTime[1]:"null";
            if (isset($startTimeRequest) && isset($endTimeRequest)) {
                $startDate 	= Carbon::createFromFormat('d/m/Y',$startTimeRequest);
	            $endDate 	= Carbon::createFromFormat('d/m/Y',$endTimeRequest);
            }
        }
        return [$startDate,$endDate];
    }
    public function allRevenueCost()
    {
        list($startDate,$endDate) = $this->analysisRequestTime();
        $totalReceipt = WalletHistory::with('wallet.user')
                                    ->includedTheCost()
                                    ->where('created_at','>=',$startDate)
                                    ->where('created_at','<=',$endDate)
                                    ->where('type',WalletTransactionType::RECHARGE_MONEY)
                                    ->sum('amount');
        $totalAmountSpent = WithdrawalRequest::with('user')
                                    ->includedTheCost()
                                    ->where('created_at','>=',$startDate)
                                    ->where('created_at','<=',$endDate)
                                    ->where('withdrawal_request_status_id',WithdrawalRequestStatus::STATUS_CONFIRMED)
                                    ->sum('amount_final');
        return response()->json([
            'html' => view('vh::statical.system.all_revenue_cost',compact('totalReceipt','totalAmountSpent'))->render()
        ]);
    }
    public function totalReceipt()
    {
        list($startDate,$endDate) = $this->analysisRequestTime();
        $listItems = WalletHistory::with('wallet.user')
                                ->includedTheCost()
                                ->where('created_at','>=',$startDate)
                                ->where('created_at','<=',$endDate)
                                ->where('type',WalletTransactionType::RECHARGE_MONEY)
                                ->paginate(10);
        return view('vh::statical.system.total_receipt_result',compact('listItems'));
    }
    public function totalAmountSpent()
    {
        list($startDate,$endDate) = $this->analysisRequestTime();
        $listItems = WithdrawalRequest::with('user')
                                ->includedTheCost()
                                ->where('created_at','>=',$startDate)
                                ->where('created_at','<=',$endDate)
                                ->where('withdrawal_request_status_id',WithdrawalRequestStatus::STATUS_CONFIRMED)
                                ->paginate(10);
        return view('vh::statical.system.total_amount_spent_result',compact('listItems'));
    }
}
