<?php

namespace App\Console\Commands\LottoMb;

use App\Models\Games\Lotto\GameLottoPlayType;
use App\Models\Games\LottoMb\GameLottoMbPlayRecord;
use App\Models\Games\LottoMb\GameLottoMbPlayType;
use App\Models\Games\LottoMb\GameLottoMbTableResult;
use crawlmodule\loterie\XoSoSources\KetQuaNet;
use Illuminate\Console\Command;

class CrawlSample extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lottomb:crawl-sample';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crawl Sample';

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
        // $kq = new KetQuaNet(GameLottoMbPlayRecord::find($this->argument('id')));
        // $table = $kq->getResults();
        // foreach ($table as $key => $row) {
        //     foreach ($row as $col) {
        //         $CLASS_GAME_TABLE_RESULT = GameLottoMbTableResult::class;
        //         $item = new $CLASS_GAME_TABLE_RESULT();
        //         $item->game_lotto_play_record_id = $this->argument('id');
        //         $item->type_prize = $key + 1;
        //         $item->value = $col;
        //         $item->created_at = now();
        //         $item->updated_at = now();
        //         $item->save();
        //     }
        // }
        $din = new \stdClass();
        $din->year = 2022;
        $din->month = 7;
        $din->day = 27;
        $days = explode(',', '20/02/2022');
        foreach ($days as $d) {
            $date = \Carbon\Carbon::createFromFormat('d/m/Y', $d);
            if ($date->year == $din->year && $date->month == $din->month && $date->day == $din->day) {
                dd('true');
            }
        }
        $this->info("End " . $this->description);
    }
}
