<?php

namespace App\Games\Lotto\Generators;

use App\Games\Lotto\PrizeOneGame;

class CommonRandom
{
    protected $includeTwoNumbers;
    protected $maxAppearNumbers;
    protected $excludeTwoNumbers;
    public function __construct($maxAppearNumbers, $includeTwoNumbers, $excludeTwoNumbers)
    {
        $this->excludeTwoNumbers = $excludeTwoNumbers;
        $this->includeTwoNumbers = $includeTwoNumbers;
        $this->maxAppearNumbers = $maxAppearNumbers;
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

                $tmp = $ins[$idx];
                $this->maxAppearNumbers[$tmp]--;
                if ($this->maxAppearNumbers[$tmp] <= 0) {
                    unset($ins[$idx]);
                    unset($this->maxAppearNumbers[$tmp]);
                }
            }
            $results[] = $num;
        }

        return $results;
    }


    public function randomNumberWithExtraInclude($extraIncludes, $noNum = 1)
    {
        $tmpExtraIncludes = [];
        foreach ($extraIncludes as $item) {
            $item = substr($item, $noNum);
            $tmpExtraIncludes[] = $item;
        }
        $intersect = array_intersect($tmpExtraIncludes, $this->includeTwoNumbers);

        if (count($intersect) > 0) {
            $key = array_rand($intersect);
            $value = $intersect[$key];
            $key = array_search($value, $tmpExtraIncludes);
            $num = $extraIncludes[$key];
        } else {
            $num = -1;
        }
        return $num;
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


    /**
     * Get the value of excludeTwoNumbers
     *
     * @return  mixed
     */
    public function getExcludeTwoNumbers()
    {
        return $this->excludeTwoNumbers;
    }

    /**
     * Get the value of maxAppearNumbers
     *
     * @return  mixed
     */
    public function getMaxAppearNumbers()
    {
        return $this->maxAppearNumbers;
    }
}
