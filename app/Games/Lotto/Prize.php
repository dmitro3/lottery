<?php

namespace App\Games\Lotto;

use App\Games\Plinko\Enums\Bag;
use App\Games\Plinko\Enums\BallType;
use App\Models\Games\Lotto\GameLottoPlayUserBet;
use App\Models\Games\Plinko\GamePlinkoPath;
use App\Models\Games\Plinko\GamePlinkoUserBet;
use App\Models\Games\Plinko\GamePlinkoUserBetDetail;

class Prize
{
    private $gameLottoPlayUserBets;
    private $totalBetMoney = 0;
    private $groupResultByGames = [];
    public function __construct($gameLottoPlayUserBets)
    {
        $this->gameLottoPlayUserBets  = $gameLottoPlayUserBets;
        $this->calculateTotalMoneyByGame();
    }
    public function calculateResult()
    {
        dd($this->totalBetMoney, $this->groupResultByGames);
    }
    private function calculateTotalMoneyByGame()
    {
        $result = [];
        $total = 0;
        foreach ($this->gameLottoPlayUserBets as $key => $userBet) {
            $gameKey = $userBet->game_lotto_type_code;
            $subtotal = $userBet->money;
            if (!array_key_exists($gameKey, $result)) {
                $result[$gameKey] = [
                    'sum' => $subtotal,
                    'items' => $userBet
                ];
            } else {
                $items = $result[$gameKey]['items'];
                array_push($items, $userBet);
                $sum = $result[$gameKey]['sum'];
                $sum += $subtotal;
                $result[$gameKey] = [
                    'sum' => $sum,
                    'items' => $items
                ];
            }
            $total += $subtotal;
        }
        $this->groupResultByGames = $result;
        $this->totalBetMoney = $total;
    }
}
