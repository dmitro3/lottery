<?php

namespace App\Console\Commands\LottoMb;

use App\Models\Games\Lotto\GameLottoPlayType;
use App\Models\Games\LottoMb\GameLottoMbPlayType;
use Illuminate\Console\Command;

class GenerateGameMbRercords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lottomb:generate-records';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Game LottoMb Records';

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
        GameLottoMbPlayType::find(1)->generateGameRecords();
        $this->info("End " . $this->description);
    }
}
