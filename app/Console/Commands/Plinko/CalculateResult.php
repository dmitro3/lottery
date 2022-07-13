<?php

namespace App\Console\Commands\Plinko;

use App\Games\Plinko\Enums\BallType;
use App\Games\Plinko\Enums\Config as PlinkoConfig;
use App\Games\Plinko\Prize;
use App\Models\Games\Plinko\GamePlinkoType;
use App\Models\Games\Plinko\GamePlinkoUserBet;
use Illuminate\Console\Command;

class CalculateResult extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'plinko:generate-result';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate Result Plinko';

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
        if ($currentGameRecord->is_end == 1) return;
        $records = GamePlinkoUserBet::where('game_plinko_record_id', $currentGameRecord->id)->get();
        $gameRequests = [
            BallType::NORMAL => 0,
            BallType::MID => 0,
            BallType::HOT => 0
        ];
        foreach ($records as $key => $record) {
            $type = $record->type;
            $qty = $record->qty;
            $gameRequests[$type] += $qty;
        }
        $prize = new Prize($gameRequests);
        $prize->generateBetDetails($currentGameRecord->id);
        $currentGameRecord->end();
    }
}
