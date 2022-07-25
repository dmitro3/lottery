<?php

namespace App\Games\Lotto;

use App\Models\Games\Lotto\GameLottoPlayUserBet;
use Arr;
use \vanhenry\helpers\helpers\SettingHelper as Setting;

class PrizeOneGame
{
    private $gameLottoPlayUserBets = [];
    private $sum = 0;
    private $maxRate = 0;
    private $totalPrize = 0;
    private $gameKey;
    private $gameKeyId;
    private $includeNumbers = [];
    private $excludeNumbers = [];


    // var GameLotoType
    private $gameLottoType;
    public function __construct(string $gameKey, int $gameKeyId)
    {
        $this->gameKey = $gameKey;
        $this->gameKeyId = $gameKeyId;
    }
    public function addUserBet(GameLottoPlayUserBet $userBet)
    {
        if (!$this->gameLottoType) {

            $this->gameLottoType = $userBet->gameLottoType;
        }
        array_push($this->gameLottoPlayUserBets, $userBet);
        return $this;
    }
    public function addSum($money)
    {
        $this->sum  += $money;
        return $this;
    }
    public function getTotalPrize()
    {
        return $this->totalPrize = $this->sum * (float)(Setting::getSetting('lotto_percent_prize', 80) / 100);
    }

    public function getCountBet()
    {
        return count($this->gameLottoPlayUserBets);
    }

    public function calculate()
    {
        if ($this->gameLottoType) {
            $typeGame = $this->gameLottoType->getTypeGame();
            $totalPrize = $this->getTotalPrize();
            $typeGame->devideNumber($this->gameLottoPlayUserBets, $totalPrize);
            $this->includeNumbers = $typeGame->getIncludeNumbers();
            $this->excludeNumbers = $typeGame->getExcludeNumbers();
        }
    }

    /**
     * Get the value of gameLottoType
     *
     * @return  mixed
     */
    public function getGameLottoType()
    {
        return $this->gameLottoType;
    }

    /**
     * Get the value of includeNumbers
     *
     * @return  mixed
     */
    public function getIncludeNumbers()
    {
        return $this->includeNumbers;
    }

    /**
     * Get the value of excludeNumbers
     *
     * @return  mixed
     */
    public function getExcludeNumbers()
    {
        return $this->excludeNumbers;
    }

    /**
     * Get the value of gameKey
     *
     * @return  mixed
     */
    public function getGameKey()
    {
        return $this->gameKey;
    }

    /**
     * Get the value of gameKeyId
     *
     * @return  mixed
     */
    public function getGameKeyId()
    {
        return $this->gameKeyId;
    }
}
