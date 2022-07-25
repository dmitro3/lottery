<?php

namespace App\Games\Lotto\Generators;

use App\Games\Lotto\PrizeOneGame;

class BaseRandom
{
    protected $includeTwoNumbers;
    protected $excludeTwoNumbers;
    public function __construct($includeTwoNumbers, $excludeTwoNumbers)
    {
        $this->excludeTwoNumbers = $excludeTwoNumbers;
        $this->includeTwoNumbers = $includeTwoNumbers;
    }
    protected function randomNumber($oldNumber = -1, $count = 1)
    {
        return $this->randomNumberByNo($this->excludeTwoNumbers, $this->includeTwoNumbers, $oldNumber, $count);
    }
    protected function randomNumberByNo($exs, $ins, $oldNumber = -1, $count = 1)
    {
        if ($oldNumber >= 0) {
            $ins[] = $oldNumber;
        }
        $results = [];
        for ($i = 0; $i < $count; $i++) {
            do {
                $num = rand(0, 99);
                $num = $num . '';
                $num = str_repeat('0', 2 - strlen($num));
            } while (in_array($num, $exs));

            if ($idx = array_search($num, $ins)) {
                unset($ins[$idx]);
            }
            $results[] = $num;
        }

        return $results;
    }
}
