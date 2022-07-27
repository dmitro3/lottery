<?php

namespace App\Console\Commands\Win;

use App\Models\Games\Win\GameWinType;
use Illuminate\Console\Command;

class CalculateResult extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'win:generate-result';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Game Win result';

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

            if ($second >= 55) {
                if (!$gameEnded) {
                    $listGameWinType = GameWinType::get();
                    foreach ($listGameWinType as $itemGameWinType) {
                        $currentGame = $itemGameWinType->getCurrentGameRecord();
                        $currentGame->initWinNumber();
                        $currentGame->end();
                    }
                    unset($listGameWinType);
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
}
