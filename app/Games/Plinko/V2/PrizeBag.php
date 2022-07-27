<?php

namespace App\Games\Plinko\V2;

use App\Games\Plinko\Enums\BallType;
use App\Models\Games\Plinko\GamePlinkoPath;
use App\Models\Games\Plinko\GamePlinkoTotalBet;
use App\Models\Games\Plinko\GamePlinkoUserBet;
use App\Models\Games\Plinko\GamePlinkoUserBetDetail;
use \vanhenry\helpers\helpers\SettingHelper as Setting;

class PrizeBag
{
    private $name;
    private $from = 0;
    private $to = 0;
    private $percent = 0;
    private $range = 0;
    private float $bagValue;
    private int $numBall = 0;
    private int $numBallResidual = 0;


    public function __construct($name)
    {
        $this->name = $name;
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
     * Set the value of name
     *
     * @param   mixed  $name  
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get the value of from
     *
     * @return  mixed
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * Set the value of from
     *
     * @param   mixed  $from  
     *
     * @return  self
     */
    public function setFrom($from)
    {
        $this->from = $from;
        return $this;
    }

    /**
     * Get the value of percent
     *
     * @return  mixed
     */
    public function getPercent()
    {
        return $this->percent;
    }

    /**
     * Set the value of percent
     *
     * @param   mixed  $percent  
     *
     * @return  self
     */
    public function setPercent($percent)
    {
        $this->percent = $percent;
        return $this;
    }

    /**
     * Get the value of to
     *
     * @return  mixed
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * Set the value of to
     *
     * @param   mixed  $to  
     *
     * @return  self
     */
    public function setTo($to)
    {
        $this->to = $to;
        return $this;
    }

    /**
     * Get the value of range
     *
     * @return  mixed
     */
    public function getRange()
    {
        return $this->range;
    }

    /**
     * Set the value of range
     *
     * @param   mixed  $range  
     *
     * @return  self
     */
    public function setRange($range)
    {
        $this->range = $range;
        return $this;
    }

    /**
     * Get the value of bagValue
     *
     * @return  mixed
     */
    public function getBagValue()
    {
        return $this->bagValue;
    }

    /**
     * Set the value of bagValue
     *
     * @param   mixed  $bagValue  
     *
     * @return  self
     */
    public function setBagValue($bagValue)
    {
        $this->bagValue = $bagValue;
        return $this;
    }

    /**
     * Get the value of numBall
     *
     * @return  mixed
     */
    public function getNumBall()
    {
        return $this->numBall;
    }

    /**
     * Set the value of numBall
     *
     * @param   mixed  $numBall  
     *
     * @return  self
     */
    public function setNumBall($numBall)
    {
        $this->numBall = $numBall;
        return $this;
    }
    public function addNumBall($num)
    {
        $this->numBall += $num;
        return $this;
    }

	/**
	 * Get the value of numBallResidual
	 *
	 * @return  mixed
	 */
	public function getNumBallResidual()
	{
		return $this->numBallResidual;
	}

	/**
	 * Set the value of numBallResidual
	 *
	 * @param   mixed  $numBallResidual  
	 *
	 * @return  self
	 */
	public function setNumBallResidual($numBallResidual)
	{
		$this->numBallResidual = $numBallResidual;
		return $this;
	}
}
