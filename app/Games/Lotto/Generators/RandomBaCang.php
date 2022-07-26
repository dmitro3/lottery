<?php

namespace App\Games\Lotto\Generators;

use App\Games\Lotto\PrizeOneGame;

class RandomBaCang extends BaseRandom
{
    protected $gameDeBaCangs;
    public function __construct($commonRandom, $gameDeBaCangs)
    {
        parent::__construct($commonRandom);
        $this->gameDeBaCangs = $gameDeBaCangs;
    }

    public function random($num)
    {

        if ($num < 0) {
            $num = $this->randomDeBaCang();
        } else {
            $num = $this->checkDeBaCang($num);
        }
        return $num;
    }


    private function randomDeBaCang()
    {

        $num = -1;
        if (!$this->gameDeBaCangs) {
            return $num;
        }
        $ins = $this->gameDeBaCangs->getIncludeArrayNumbers();
        $exs = $this->gameDeBaCangs->getExcludeArrayNumbers();
        if (count($ins) > 0) {
            $num = $this->commonRandom->randomNumberWithExtraInclude($ins, 1);
        }
        // else {
        //     do {
        //         $rands = $this->commonRandom->randomNumber($num);
        //         $num = $rands[0];
        //         $add = rand(0, 9);
        //         $tmpNum = $add . $num;
        //     } while (in_array($tmpNum, $exs));
        // }
        return $num;
    }
    private function checkDeBaCang($num)
    {
        if (!$this->gameDeBaCangs) {
            return $num;
        }
        $ins = $this->gameDeBaCangs->getIncludeArrayNumbers();
        $exs = $this->gameDeBaCangs->getExcludeArrayNumbers();
        $result = $this->findNumIfMatchTwoLastNumber($ins, $num);
        $num = $result->getNum();
        if (!$result->getStatus()) {
            $result = $this->makeFullNumber($exs, $num);
            $num = $result->getNum();
        }
        return $num;
    }
    private function makeFullNumber($exs, $num)
    {
        $flag = false;
        for ($i = 0; $i <= 9; $i++) {
            $add = rand(0, 9);
            $tmpNum = $add . $num;
            if (!in_array($tmpNum, $exs)) {
                $num = $tmpNum;
                $flag = true;
                break;
            }
        }
        if (!$flag) {
            do {
                $rands = $this->commonRandom->randomNumber($num);
                $num = $rands[0];
                $add = rand(0, 9);
                $tmpNum = $add . $num;
            } while (in_array($tmpNum, $exs));
            $num = $tmpNum;
        }
        return new RandomResult($flag, $num);
    }
    private function findNumIfMatchTwoLastNumber($ins, $num)
    {
        $flag = false;
        foreach ($ins as $k => $in) {
            $tmp = substr($in, 1);
            if ($tmp == $num) {
                $num = $in;
                $flag = true;
                break;
            }
        }
        return new RandomResult($flag, $num);
    }
}
