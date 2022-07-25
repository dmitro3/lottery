<?php

namespace App\Games\Lotto;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class PrizeGameCollection
{
    private $listPrizeGames;
    private $currentGameRecord;
    private $gameLottoPlayUserBets;
    private $totalBetMoney = 0;

    public function __construct($currentGameRecord)
    {
        $this->listPrizeGames = [];
        $this->gameLottoPlayUserBets = $currentGameRecord->gameLottoPlayUserBets()->get();
    }
    public function calculate()
    {
        foreach ($this->gameLottoPlayUserBets as $gameBet) {
            $this->addGameToList($gameBet);
        }
        foreach ($this->listPrizeGames as $game) {
            $game->calculate();
            var_dump($game->getExcludeNumbers());
            var_dump($game->getIncludeNumbers());
        }
    }
    private function addGameToList($gameBet)
    {
        $gameKey = $gameBet->game_lotto_type_code;
        $gameKeyId = $gameBet->game_lotto_type_id;
        $subTotal = $gameBet->money;
        if (!Arr::exists($this->listPrizeGames, $gameKey)) {
            $prizeOneGame = new PrizeOneGame($gameKey, $gameKeyId);
        } else {
            $prizeOneGame = $this->listPrizeGames[$gameKey];
        }
        $prizeOneGame->addUserBet($gameBet);
        $prizeOneGame->addSum($subTotal);

        $this->listPrizeGames[$gameKey] = $prizeOneGame;

        $this->totalBetMoney += $subTotal;
    }

    /**
     * Get the value of currentGameRecord
     *
     * @return  mixed
     */
    public function getCurrentGameRecord()
    {
        return $this->currentGameRecord;
    }

    /**
     * Get the value of listPrizeGames
     *
     * @return  mixed
     */
    public function getListPrizeGames()
    {
        return $this->listPrizeGames;
    }

    /**
     * Get the value of totalBetMoney
     *
     * @return  mixed
     */
    public function getTotalBetMoney()
    {
        return $this->totalBetMoney;
    }
}
