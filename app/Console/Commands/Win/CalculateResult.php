<?php

namespace App\Console\Commands\Win;

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

            if ($second > 60) {
                if (!$gameEnded) {
                    // $this->generateGameResult();
                    //code here
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
