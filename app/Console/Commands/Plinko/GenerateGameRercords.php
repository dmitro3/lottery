<?php

namespace App\Console\Commands\Plinko;

use App\Games\Plinko\Enums\BallType;
use App\Games\Plinko\Enums\Config as PlinkoConfig;
use App\Games\Plinko\Prize;
use App\Models\Games\Plinko\GamePlinkoType;
use App\Models\Games\Plinko\GamePlinkoUserBet;
use Illuminate\Console\Command;

class GenerateGameRercords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'plinko:generate-records';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Game Plinko Records';

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
        GamePlinkoType::find(1)->generateGameRecords();
        $this->info("End " . $this->description);
    }
}
