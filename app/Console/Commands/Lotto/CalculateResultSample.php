<?php

namespace App\Console\Commands\Lotto;

use App\Games\Lotto\Enums\Config as LottoConfig;
use App\Games\Lotto\Prize;
use App\Models\Games\Lotto\GameLottoPlayRecord;
use App\Models\Games\Lotto\GameLottoPlayType;
use App\Models\Games\Lotto\GameLottoPlayUserBet;
use Illuminate\Console\Command;

class CalculateResultSample extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lotto:generate-result-sample {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate Result Lotto Sample';

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
        $this->generateGameResult();

        $this->info("End");
    }
    private function generateGameResult()
    {
        $currentGameRecord = GameLottoPlayRecord::find($this->argument('id'));
        // if (!$currentGameRecord) return;
        // if ($currentGameRecord->is_end == 1) return;

        $prize = new Prize($currentGameRecord);
        $prize->calculate();
        // $currentGameRecord->end();
    }
}
