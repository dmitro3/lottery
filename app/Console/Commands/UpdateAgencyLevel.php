<?php

namespace App\Console\Commands;

use App\Models\CommissionLevelConfig;
use App\Models\CommissionUserDirectChildStatistics;
use App\Models\User;
use Illuminate\Console\Command;

class UpdateAgencyLevel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'site:update-agency-level';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Agency Level';

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
        $this->info("End " . $this->description);
    }
}
