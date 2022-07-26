<?php

namespace App\Games\Lotto\Conditions;

class NumberCondition
{
    protected $name;
    protected $rate;
    protected $numbers;
    protected $maxAppear = 0;
    public function __construct($name, $rate, $numbers)
    {
        $this->name = $name;
        $this->rate = $rate;
        $this->numbers = is_array($numbers) ? $numbers : [$numbers];
    }
    public function addRate($rate)
    {
        $this->rate += $rate;
    }

    /**
     * Get the value of rate
     *
     * @return  mixed
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Get the value of numbers
     *
     * @return  mixed
     */
    public function getRealNumbers()
    {
        return $this->numbers;
    }
    public function getNumbers()
    {
        return $this->getRealNumbers();
    }

    /**
     * Get the value of name
     *
     * @return  mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the value of maxAppear
     *
     * @return  mixed
     */
    public function getMaxAppear()
    {
        return $this->maxAppear;
    }

    /**
     * Set the value of maxAppear
     *
     * @param   mixed  $maxAppear  
     *
     * @return  self
     */
    public function setMaxAppear($maxAppear)
    {
        $this->maxAppear = $maxAppear;
        return $this;
    }
}
