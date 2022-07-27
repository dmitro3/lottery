<?php

namespace App\Console\Commands\Plinko;

use App\Games\Plinko\Enums\BallType;
use App\Games\Plinko\Enums\Config as PlinkoConfig;
use App\Games\Plinko\Prize;
use App\Games\Plinko\V2\PrizeV2;
use App\Models\Games\Plinko\GamePlinkoType;
use App\Models\Games\Plinko\GamePlinkoUserBet;
use Illuminate\Console\Command;

class CalculateResultV2 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'plinko:generate-resultv2';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate Result V2 Plinko';

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

        $this->info("Start");
        $gameEnded = false;

        while (true) {
            $now = now();
            $minute = $now->minute;
            $second = $now->second;

            if ($second > (60 - PlinkoConfig::LAST_POINT_TO_BET)) {
                if (!$gameEnded) {
                    $this->generateGameResult();
                    $gameEnded = true;
                }
            } else {
                $gameEnded = false;
            }

            $this->info($minute . '-' . $second);
            sleep(1);
        }
        $this->info("End");
    }
    private function generateGameResult()
    {
        $currentGameRecord = GamePlinkoType::find(1)->getCurrentGameRecord();
        if (!$currentGameRecord) return;
        if ($currentGameRecord->is_end == 1) return;
        $prize = new PrizeV2();
        $prize->calculate($currentGameRecord->id);
        $currentGameRecord->end();
        unset($currentGameRecord);
        unset($prize);
    }
}
