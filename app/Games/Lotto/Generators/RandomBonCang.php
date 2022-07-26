<?php

namespace App\Games\Lotto\Generators;

use App\Games\Lotto\PrizeOneGame;

class RandomBonCang extends BaseRandom
{
    protected $gameDeBonCangs;
    public function __construct($commonRandom, $gameDeBonCangs)
    {
        parent::__construct($commonRandom);
        $this->gameDeBonCangs = $gameDeBonCangs;
    }
    public function random($num)
    {
        if ($num < 0) {
            $num = $this->randomDeBonCang();
        } else {
            $num = $this->checkDeBonCang($num);
        }
        if ($num < 0) {
            $exs = $this->gameDeBonCangs->getExcludeArrayNumbers();
            $num = $this->randomResult($exs, -1, 99);
        }
        return $num;
    }

    private function randomDeBonCang()
    {
        $num = -1;
        if (!$this->gameDeBonCangs) {
            return $num;
        }
        $ins = $this->gameDeBonCangs->getIncludeArrayNumbers();
        $exs = $this->gameDeBonCangs->getExcludeArrayNumbers();
        if (count($ins) > 0) {
            $key = array_rand($ins);
            $num = $ins[$key];
            $this->commonRandom->unsetInclude(substr($num, 2));
        } else {
            do {
                $rands = $this->commonRandom->randomNumber($num);
                $num = $rands[0];
                $add = rand(0, 99);
                $add = $add < 10 ? '0' . $add : $add;
                $tmpNum = $add . $num;
            } while (in_array($tmpNum, $exs));
        }
        return $num;
    }
    private function checkDeBonCang($num)
    {
        if (!$this->gameDeBonCangs) {
            return $num;
        }
        $ins = $this->gameDeBonCangs->getIncludeArrayNumbers();
        $exs = $this->gameDeBonCangs->getExcludeArrayNumbers();
        $result = $this->findNumIfMatchTwoOrThreeLastNumber($ins, $num);
        $num = $result->getNum();
        if (!$result->getStatus()) {
            $result = $this->makeFullNumber($exs, $num);
            $num = $result->getNum();
        }
        return $num;
    }

    private function findNumIfMatchTwoOrThreeLastNumber($ins, $num)
    {
        $flag = false;
        foreach ($ins as $in) {
            $number = $in;

            $tmp = substr($number, strlen($number) - strlen($num));
            if ($tmp == $num) {
                $num = $number;
                $flag = true;
                break;
            }
        }
        return new RandomResult($flag, $num);
    }
    private function makeFullNumber($exs, $num)
    {
        $currentLength = strlen($num);
        $missLength = (4 - $currentLength - 1);

        $max =  $missLength * 90 + 9;

        $flag = false;
        for ($i = 0; $i <= $max; $i++) {
            $add = rand(0, $max);

            $tmpNum = $add . $num;
            $tmpNum = str_repeat('0', 4 - strlen($tmpNum)) . $tmpNum;
            if (!in_array($tmpNum, $exs)) {
                $num = $tmpNum;
                $flag = true;
                break;
            }
        }
        if (!$flag) {
            $num = $this->randomResult($exs, $num, $max);
        }

        return new RandomResult($flag, $num);
    }
    private function randomResult($exs, $num = -1, $max = 99)
    {
        do {
            $rands = $this->commonRandom->randomNumber($num);
            $num = $rands[0];
            $add = rand(0, $max);
            $add = $add < 10 ? '0' . $add : $add;
            $tmpNum = $add . $num;
        } while (in_array($tmpNum, $exs));
        $num = $tmpNum;
        return $num;
    }
}
