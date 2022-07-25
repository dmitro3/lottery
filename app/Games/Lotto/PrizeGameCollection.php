<?php

namespace App\Games\Lotto;

use App\Games\Lotto\Conditions\OrCondition;
use App\Games\Lotto\Generators\MBGenerator;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class PrizeGameCollection
{
    private $listPrizeGames;
    private $currentGameRecord;
    private $gameLottoPlayUserBets;
    private $totalBetMoney = 0;

    private $mixExcludeNumbers = [];
    private $mixIncludeNumbers = [];

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
        }
        foreach ($this->listPrizeGames as $game) {
            $this->mixExcludeNumbers($game->getExcludeNumbers());

            $this->mixIncludeNumbers($game->getIncludeNumbers());
        }
        $this->mixIncludeNumbers = array_diff($this->mixIncludeNumbers, $this->mixExcludeNumbers);









        $generator = $this->makeGenerator();
        $results = $generator->generate();
        dd($results);
    }
    private function makeGenerator()
    {
        $generator = new MBGenerator($this->mixIncludeNumbers, $this->mixExcludeNumbers);
        foreach ($this->listPrizeGames as $game) {
            if ($game->getGameKey() == 'DE_DAU') {
                $generator->addGameGiaiBay($game);
            } else if ($game->getGameKey() == 'BA_CANG_DE') {
                $generator->setGameDeBaCang($game);
            } else if ($game->getGameKey() == 'DE_TO_NHAT') {
                $generator->setGameDe($game);
            } else if ($game->getGameKey() == 'BA_CANG_LO') {
                $generator->setGameLoBaCang($game);
            } else if ($game->getGameKey() == 'BON_CANG_DE') {
                $generator->setGameDeBonCang($game);
            } else if ($game->getGameKey() == 'BON_CANG_LO') {
                $generator->setGameLoBonCang($game);
            }
        }
        return $generator;
    }
    private function mixExcludeNumbers($conditions)
    {
        foreach ($conditions as $condition) {
            $numbers = $condition->getNumbers();
            $this->mixExcludeNumbers = array_merge($this->mixExcludeNumbers, $numbers);
        }
    }
    private function mixIncludeNumbers($conditions)
    {
        foreach ($conditions as $condition) {
            $numbers = $condition->getNumbers();
            $this->mixIncludeNumbers = array_merge($this->mixIncludeNumbers, $numbers);
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
