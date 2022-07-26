<?php

namespace App\Games\Lotto\Generators;

use App\Games\Lotto\PrizeOneGame;

class CommonRandom
{
    protected $includeTwoNumbers;
    protected $excludeTwoNumbers;
    public function __construct($includeTwoNumbers, $excludeTwoNumbers)
    {
        $this->excludeTwoNumbers = $excludeTwoNumbers;
        $this->includeTwoNumbers = $includeTwoNumbers;
    }
    public function randomNumber($oldNumber = -1, $count = 1)
    {
        return $this->randomNumberByNo($this->excludeTwoNumbers, $this->includeTwoNumbers, $oldNumber, $count);
    }
    public function randomNumberByNo($exs, &$ins, $oldNumber = -1, $count = 1)
    {
        if ($oldNumber >= 0) {
            $ins[] = $oldNumber;
        }
        $results = [];

        for ($i = 0; $i < $count; $i++) {
            do {
                $num = rand(0, 99);
                $num = $num . '';

                $num = str_repeat('0', 2 - strlen($num)) . $num;
            } while (in_array($num, $exs));
            if ($idx = array_search($num, $ins)) {

                unset($ins[$idx]);
            }
            $results[] = $num;
        }

        return $results;
    }

    /**
     * Get the value of includeTwoNumbers
     *
     * @return  mixed
     */
    public function getIncludeTwoNumbers()
    {
        return $this->includeTwoNumbers;
    }

    public function unsetInclude($num)
    {
        if (in_array($num, $this->includeTwoNumbers)) {
            unset($this->includeTwoNumbers[$num]);
        }
    }

    /**
     * Get the value of excludeTwoNumbers
     *
     * @return  mixed
     */
    public function getExcludeTwoNumbers()
    {
        return $this->excludeTwoNumbers;
    }
}
