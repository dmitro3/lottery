<?php

namespace App\Games\Lotto\Generators;

class RandomResult
{
    protected $status = false;
    protected $num;
    public function __construct($status, $num)
    {
        $this->status = $status;
        $this->num = $num;
    }


    /**
     * Get the value of status
     *
     * @return  mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get the value of num
     *
     * @return  mixed
     */
    public function getNum()
    {
        return $this->num;
    }
}
