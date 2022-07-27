<?php

namespace App\Console\Commands\LottoMb;

use App\Games\Lotto\Enums\Config as LottoConfig;
use App\Games\LottoMb\PrizeMb;
use App\Models\Games\LottoMb\GameLottoMbPlayRecord;
use App\Models\Games\LottoMb\GameLottoMbPlayType;
use Illuminate\Console\Command;

class CalculateResultMb extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lottomb:generate-result';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate Result LottoMb';

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
            $hour = $now->hour;
            $second = $now->second;

            if ($hour >= 19 &&  $minute >= 0 && $second >= 0) {
                if (!$gameEnded) {
                    $this->generateGameResult();
                    $gameEnded = true;
                }
            } else {
                $gameEnded = false;
            }

            $this->info($minute . '-' . $second);
            sleep(300);
        }

        $this->info("End");
    }
    private function generateGameResult()
    {
        $currentGameRecord = GameLottoMbPlayType::find(1)->getCurrentGameRecord();
        if (!$currentGameRecord) return;
        if ($currentGameRecord->is_end == 1) return;

        $prize = new PrizeMb($currentGameRecord);
        $prize->calculate();
        $currentGameRecord->end();
        unset($currentGameRecord);
        unset($prize);
    }
}
