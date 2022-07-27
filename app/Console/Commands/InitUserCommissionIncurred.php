<?php

namespace App\Console\Commands;

use App\Commissions\Tree;
use App\Models\CommissionIncurred;
use App\Models\CommissionLevelConfig;
use App\Models\CommissionStatistics;
use App\Models\WalletTransactionType;
use Illuminate\Console\Command;

class InitUserCommissionIncurred extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'site:init-user-commission-incurred';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Init User Commission Incurred';

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

                    $parentCommissionStatisticsCurrentDayRecord = CommissionStatistics::getCurrentDayRecord($itemParentUser['user']->id);
                    $parentCommissionStatisticsCurrentDayRecord->total_amount = $parentCommissionStatisticsCurrentDayRecord->total_amount + $amountAdd;
                    $parentCommissionStatisticsCurrentDayRecord->save();

                    $reason = 'Cộng tiền hoa hồng đội từ thành viên F'.$itemParentUser['level_deviant'];
                    $itemParentUser['user']->changeMoney($amountAdd,$reason,WalletTransactionType::PLUS_COMMISSION_TEAM,$itemCommissionIncurred->id);
                }
            }
            $itemCommissionIncurred->inited = 1;
            $itemCommissionIncurred->save();
        }
        $this->info("End " . $this->description);
    }
}
