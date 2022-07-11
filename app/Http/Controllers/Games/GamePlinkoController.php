<?php

namespace App\Http\Controllers\Games;

use App\Games\Plinko\Enums\BallType;
use App\Games\Plinko\Prize;
use App\Models\Games\Plinko\GamePlinkoPath;

class GamePlinkoController extends BaseGameController
{
    public function __construct()
    {
    }
    private function getAllGameRequest()
    {
        return [
            BallType::NORMAL => 100,
            BallType::MID => 20,
            BallType::HOT => 4
        ];
    }
    public function test()
    {
        // $files = scandir("C:\\Users\\Hung\\Downloads\\data");
        // foreach ($files as $key => $file) {
        //     if ($file == '.' || $file == '..') continue;
        //     $tmp = explode('_', str_replace('.txt', '', $file));
        //     $path = "C:\\Users\\Hung\\Downloads\\data" . "\\" . $file;
        //     $datas = explode(PHP_EOL, file_get_contents($path));

        //     foreach ($datas as $k => $item) {
        //         if (strlen($item) == 0) continue;
        //         $o = new GamePlinkoPath;
        //         $o->start = $tmp[0];
        //         $o->dest = $tmp[1];
        //         $o->path = $item;
        //         $o->save();
        //     }
        // }

        $items = GamePlinkoPath::get();
        foreach ($items as $key => $item) {
            $path = $item->path;
            $tmps = explode(' ', $path);
            $count = 0;
            for ($i = 2; $i < count($tmps) - 1; $i++) {
                $p2 = $tmps[$i];
                $p1 = $tmps[$i - 1];
                $p0 = $tmps[$i - 2];

                if ($p2 - $p1 != $p1 - $p0) {
                    $count++;
                }
            }
            $item->zigzag = $count;
            $item->save();
        }



        // $balls = $this->getAllGameRequest();
        // $prize = new Prize($balls);
        // $x = $prize->calculateResultBags();
        // dd($x);
    }
}
