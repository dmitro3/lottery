<?php

namespace App\Console\Commands\Plinko;

use App\Models\Games\Lotto\GameLottoPlayType;
use Illuminate\Console\Command;

class GenerateGameRercords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lotto:generate-records';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Game Lotto Records';

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
        GameLottoPlayType::find(1)->generateGameRecords();
        $this->info("End " . $this->description);
    }
}
