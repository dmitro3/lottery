<?php

namespace App\Console\Commands\Win;

use App\Models\Games\Win\GameWinType;
use Illuminate\Console\Command;

class GenerateGameRercords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'win:generate-records';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Game Wingo Records';

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
        $listGameWinType = GameWinType::get();
        foreach ($listGameWinType as $itemGameWinType) {
            $itemGameWinType->renderGameRecord();
        }
        $this->info("End " . $this->description);
    }
}
