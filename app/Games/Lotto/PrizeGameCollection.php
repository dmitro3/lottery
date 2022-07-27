<?php

namespace App\Games\Lotto;

use App\Games\Lotto\Conditions\OrCondition;
use App\Games\Lotto\Generators\MBGenerator;
use App\Models\Games\Lotto\GameLottoPlayUserBet;
use App\Models\Games\Lotto\GameLottoTableResult;
use App\Models\WalletTransactionType;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class PrizeGameCollection
{
    protected $listPrizeGames;
    protected $currentGameRecord;
    protected $gameLottoPlayUserBets;
    protected $totalBetMoney = 0;

    protected $mixExcludeNumbers = [];
    protected $mixIncludeNumbers = [];
    protected $maxAppearIncludeNumbers = [];

    public function __construct($currentGameRecord)
    {
        $this->currentGameRecord = $currentGameRecord;
        $this->listPrizeGames = [];
        $this->gameLottoPlayUserBets = $currentGameRecord->gameLottoPlayUserBets()->get();
    }

    public function calculate()
    {
        $results =  GameLottoTableResult::select('type_prize', 'value')->where('game_lotto_play_record_id', $this->currentGameRecord->id)->get()->groupBy('type_prize')->toArray();
        $tableResult = new TableResult($results);
        foreach ($this->gameLottoPlayUserBets as $userBet) {
            $gameLottoType = $userBet->gameLottoType;
            $typeGame = $gameLottoType->getTypeGame();

            $user = $userBet->user;
            $numberWins = $typeGame->checkBet($tableResult, $userBet);

            if (($count = count($numberWins)) > 0) {
                $amount = $userBet->amount;
                $minbet = $gameLottoType->min_bet;
                $win = $gameLottoType->win;
                $prize = ($amount / $minbet) * $win * $count;

                $reason = vsprintf('Tiền thưởng game Lotto - %s (%s) - phiên game %s.', [$gameLottoType->name, json_encode($numberWins), $this->currentGameRecord->id]);
                $user->changeMoney($prize, $reason, WalletTransactionType::PLUS_MONEY_BET_GAME_LOTTO, $userBet->id);
                $userBet->return_amount = $prize;
                $userBet->game_lotto_play_user_bet_status_id = GameLottoPlayUserBet::STATUS_WIN;
            } else {
                $userBet->game_lotto_play_user_bet_status_id = GameLottoPlayUserBet::STATUS_LOSE;
            }
            $userBet->is_returned = 1;
            $userBet->save();
        }
    }




    public function generate()
    {
        foreach ($this->gameLottoPlayUserBets as $gameBet) {
            $this->addGameToList($gameBet);
        }
        foreach ($this->listPrizeGames as $game) {
            $game->calculate();
        }
        foreach ($this->listPrizeGames as $game) {
            $this->mixExcludeNumbers($game->getExcludeNumbers());

            $this->calculateMaxAppearIncludeNumbers($game->getIncludeNumbers());
        }
        $this->mixIncludeNumbers = array_keys($this->maxAppearIncludeNumbers);
        $this->mixIncludeNumbers = array_diff($this->mixIncludeNumbers, $this->mixExcludeNumbers);
        $this->standardMaxAppear();
        $generator = $this->makeGenerator();
        $generator->generate();
    }

    private function standardMaxAppear()
    {
        foreach ($this->maxAppearIncludeNumbers as $number => $appear) {
            if (!in_array($number, $this->mixIncludeNumbers)) {
                unset($this->maxAppearIncludeNumbers[$number]);
            } else {
                $max = min(3, $appear);
                $max = $max > 2 ? rand(2, 3) : $max;
                $this->maxAppearIncludeNumbers[$number] = $max;
            }
        }
    }
    private function makeGenerator()
    {
        $generator = new MBGenerator($this->currentGameRecord, $this->maxAppearIncludeNumbers, $this->mixIncludeNumbers, $this->mixExcludeNumbers);
        foreach ($this->listPrizeGames as $game) {
            if ($game->getGameKey() == 'DE_DAU') {
                $generator->setGameGiaiBay($game);
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
    private function calculateMaxAppearIncludeNumbers($conditions)
    {
        foreach ($conditions as $condition) {
            $numbers = $condition->getNumbers();
            $maxAppear = $condition->getMaxAppear();
            foreach ($numbers as $number) {
                if (Arr::exists($this->maxAppearIncludeNumbers, $number)) {
                    $currentMaxAppear = $this->maxAppearIncludeNumbers[$number];
                    $currentMaxAppear = min($currentMaxAppear, $maxAppear);
                    $this->maxAppearIncludeNumbers[$number] = $currentMaxAppear;
                } else {
                    $this->maxAppearIncludeNumbers[$number] = $maxAppear;
                }
            }
        }
    }
    private function mixExcludeNumbers($conditions)
    {
        foreach ($conditions as $condition) {
            $numbers = $condition->getNumbers();
            $this->mixExcludeNumbers = array_merge($this->mixExcludeNumbers, $numbers);
        }
        $this->mixExcludeNumbers = array_unique($this->mixExcludeNumbers);
    }
    private function mixIncludeNumbers($conditions)
    {
        foreach ($conditions as $condition) {
            $numbers = $condition->getNumbers();
            $this->mixIncludeNumbers = array_merge($this->mixIncludeNumbers, $numbers);
        }
        $this->mixIncludeNumbers = array_unique($this->mixIncludeNumbers);
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
