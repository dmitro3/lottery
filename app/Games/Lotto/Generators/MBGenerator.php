<?php

namespace App\Games\Lotto\Generators;

use App\Games\Lotto\PrizeOneGame;

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
    public function __construct($includeTwoNumbers, $excludeTwoNumbers)
    {
        $this->excludeTwoNumbers = $excludeTwoNumbers;
        $this->includeTwoNumbers = $includeTwoNumbers;
    }

    public function addGameGiaiBay(PrizeOneGame $game)
    {
        array_push($this->gameGiaiBays, $game);
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
        // return [
        //     'dac_biet' => $this->randomNumber(1),
        //     'nhat' => $this->randomNumber(1),
        //     'nhi' => $this->randomNumber(2),
        //     'ba' => $this->randomNumber(6),
        //     'bon' => $this->randomNumber(4),
        //     'nam' => $this->randomNumber(6),
        //     'sau' => $this->randomNumber(3),
        //     'bay' => $this->randomNumber(4),
        // ];
        dd($this->generateDacBiet());
    }

    private function generateDacBiet()
    {
        $randomDe = new RandomDe($this->includeTwoNumbers, $this->excludeTwoNumbers, $this->gameDe);
        $num = $randomDe->random();


        $randomBaCang = new RandomBaCang($this->includeTwoNumbers, $this->excludeTwoNumbers, $this->gameDeBaCangs);
        $num = $randomBaCang->random($num);
        dd($num);

        $randomBonCang = new RandomBonCang($this->includeTwoNumbers, $this->excludeTwoNumbers, $this->gameDeBaCangs);
        $num = $randomBonCang->random($num);

        $num = rand(0, 9) . $num;
        return $num;
    }
}
