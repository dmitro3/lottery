<?php

namespace App\Games\Lotto\Generators;

use App\Games\Lotto\Enums\NoPrize;
use App\Games\Lotto\PrizeOneGame;
use App\Models\Games\Lotto\GameLottoTableResult;

class MBGenerator
{
    private $includeTwoNumbers;
    private $excludeTwoNumbers;

    private $gameGiaiBays = [];
    private $gameDe;
    private $gameDeBaCangs;

    private $gameLoBaCangs;

    private $gameDeBonCangs;

    private $gameLoBonCangs;

    private $commonRandom;
    private $currentGameRecord;
    public function __construct($currentGameRecord, $includeTwoNumbers, $excludeTwoNumbers)
    {
        $this->currentGameRecord = $currentGameRecord;
        $this->excludeTwoNumbers = $excludeTwoNumbers;
        $this->includeTwoNumbers = $includeTwoNumbers;
        $this->commonRandom = new CommonRandom($this->includeTwoNumbers, $this->excludeTwoNumbers);
    }

    public function setGameGiaiBay(PrizeOneGame $game)
    {
        $this->gameGiaiBays = $game;
    }


    public function setGameDe(PrizeOneGame $game)
    {
        $this->gameDe =  $game;
    }
    public function setGameDeBaCang(PrizeOneGame $game)
    {
        $this->gameDeBaCangs =  $game;
    }

    public function setGameDeBonCang(PrizeOneGame $game)
    {
        $this->gameDeBonCangs =  $game;
    }

    public function setGameLoBaCang(PrizeOneGame $game)
    {
        $this->gameLoBaCangs =  $game;
    }

    public function setGameLoBonCang(PrizeOneGame $game)
    {
        $this->gameLoBonCangs =  $game;
    }



    public function generate()
    {

        $table = [];
        $table[NoPrize::DAC_BIET] = [$this->generateDacBiet()];

        $table[NoPrize::BAY] = $this->generateGiai7();
        $other = $this->generateGiaiKhac();
        $table = $table + $other;
        foreach ($table as $key => $row) {
            foreach ($row as $col) {
                $item = new GameLottoTableResult();
                $item->game_lotto_play_record_id = $this->currentGameRecord->id;
                $item->type_prize = $key;
                $item->value = $col;
                $item->created_at = now();
                $item->updated_at = now();
                $item->save();
            }
        }
    }

    private function generateDacBiet()
    {
        $randomDe = new RandomDe($this->commonRandom, $this->gameDe);
        $num = $randomDe->random();

        $randomBaCang = new RandomBaCang($this->commonRandom, $this->gameDeBaCangs);
        $num = $randomBaCang->random($num);

        $randomBonCang = new RandomBonCang($this->commonRandom, $this->gameDeBonCangs);
        $num = $randomBonCang->random($num);

        while (strlen($num) < 5) {
            $num = rand(0, 9) . $num;
        }

        return $num;
    }

    private function generateGiai7()
    {
        $position = rand(0, 3);

        $results = [];
        for ($i = 0; $i < 4; $i++) {
            if ($i != $position) {
                $tmps = $this->commonRandom->randomNumber();
                $results = array_merge($results, $tmps);
            } else {
                $randomGiai7 = new RandomGiai7($this->commonRandom, $this->gameGiaiBays);
                $num = $randomGiai7->random();
                $results[] = $num;
            }
        }
        return $results;
    }

    private function generateGiaiKhac()
    {
        $giais = [
            NoPrize::NHAT => 1,
            NoPrize::NHI => 2,
            NoPrize::BA => 6,
            NoPrize::BON => 4,
            NoPrize::NAM => 6,
            NoPrize::SAU => 3
        ];
        $ins = $this->commonRandom->getIncludeTwoNumbers();
        $exs = $this->commonRandom->getExcludeTwoNumbers();
        $results = [
            NoPrize::NHAT => [],
            NoPrize::NHI => [],
            NoPrize::BA => [],
            NoPrize::BON => [],
            NoPrize::NAM => [],
            NoPrize::SAU => []
        ];
        for ($i = 0; $i < 22; $i++) {
            if (count($ins) > 0) {
                $key = array_rand($ins);
                $num = $ins[$key];
                unset($ins[$key]);
            } else {
                do {
                    $tmp = rand(0, 99);
                    $tmp = $tmp < 10 ? '0' . $tmp : '' . $tmp;
                } while (in_array($tmp, $exs));
                $num = $tmp;
            }
            $keygiai = array_rand($giais);
            $giais[$keygiai]--;
            if ($giais[$keygiai] <= 0) {
                unset($giais[$keygiai]);
            }
            $nonum = $this->getNoNumByGiai($keygiai) - 2;
            for ($j = 0; $j < $nonum; $j++) {
                $num = rand(0, 9) . $num;
            }
            $results[$keygiai][] = $num;
        }
        return $results;
    }
    private function getNoNumByGiai($key)
    {
        $giais = [
            NoPrize::NHAT => 5,
            NoPrize::NHI => 5,
            NoPrize::BA => 5,
            NoPrize::BON => 4,
            NoPrize::NAM => 4,
            NoPrize::SAU => 3
        ];
        if (array_key_exists($key, $giais)) {
            return $giais[$key];
        }
        return 0;
    }
}
