<?php

namespace App\Console\Commands\Lotto;

use App\Games\Lotto\Enums\Config as LottoConfig;
use App\Games\Lotto\Prize;
use App\Models\Games\Lotto\GameLottoPlayRecord;
use App\Models\Games\Lotto\GameLottoPlayType;
use App\Models\Games\Lotto\GameLottoPlayUserBet;
use Illuminate\Console\Command;

class CalculateResult extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lotto:generate-result';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate Result Lotto';

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

            if ($minute == 59 && $second > (60 - LottoConfig::LAST_POINT_TO_BET)) {
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
        $currentGameRecord = GameLottoPlayType::find(1)->getCurrentGameRecord();
        if (!$currentGameRecord) return;
        if ($currentGameRecord->is_end == 1) return;

        $prize = new Prize($currentGameRecord);
        $prize->calculate();
        $currentGameRecord->end();
    }
}
