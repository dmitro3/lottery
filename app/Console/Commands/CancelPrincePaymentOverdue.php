<?php

namespace App\Console\Commands;

use App\Models\RechargeMethod;
use App\Models\RechargeRequest;
use App\Models\RechargeStatus;
use App\Models\TransactionPrincepay;
use App\Models\TransactionPrincepayStatus;
use Illuminate\Console\Command;

class CancelPrincePaymentOverdue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'princepay:cancel-overdue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cancel Prince Payment Overdue';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $this->info("Start " . $this->description);
        $listPrincepayOverdue = TransactionPrincepay::where('created_at','<',now()->subMinutes(15))
                                                    ->where('transaction_princepay_status_id',TransactionPrincepayStatus::WAIT_PAYMENT)
                                                    ->get();
        foreach ($listPrincepayOverdue as $key => $transactionPrincepay) {
            $transactionPrincepay->transaction_princepay_status_id = TransactionPrincepayStatus::PAYMENT_FAIL;
            $transactionPrincepay->save();
            $itemRechargeRequest = RechargeRequest::whereHas('user')->with('user')->with('rechargeMethod')->find($transactionPrincepay->map_id);
            if (isset($itemRechargeRequest)){
                if ($itemRechargeRequest->recharged != 1) {
                    $itemRechargeRequest->recharged = 1;
                    $itemRechargeRequest->recharge_status_id = RechargeStatus::STATUS_CANCEL;
                    $itemRechargeRequest->recharged_at = now();
                    $itemRechargeRequest->save();
                }
            }
        }

        $listRechargeRequestOverdue = RechargeRequest::where('created_at','<',now()->subMinutes(30))
                                                    ->where('recharged',0)
                                                    ->where('recharge_status_id',RechargeStatus::STATUS_WAIT_CONFIRM)
                                                    ->whereIn('recharge_method_id',RechargeMethod::getPrincePayMethodId())
                                                    ->get();
        foreach ($listRechargeRequestOverdue as $key => $itemRechargeRequest) {
            $itemRechargeRequest->recharged = 1;
            $itemRechargeRequest->recharge_status_id = RechargeStatus::STATUS_CANCEL;
            $itemRechargeRequest->recharged_at = now();
            $itemRechargeRequest->save();
        }
        $this->info("End " . $this->description);
    }
}
