<?php

namespace App\Games\Plinko;

use App\Games\Plinko\Enums\Bag;
use App\Games\Plinko\Enums\BallType;
use App\Models\Games\Plinko\GamePlinkoPath;
use App\Models\Games\Plinko\GamePlinkoUserBet;
use App\Models\Games\Plinko\GamePlinkoUserBetDetail;

class Prize
{
    private $gameRequests;
    private $total = [];
    private $sum = 0;
    private $percentWin = 0;
    private $percentConvertToPrize = 0;
    private $totalPrize = 0;

    // Phần trăm bag cố định. Tư tưởng: ví dụ có 10 bi thì chỉ fix cố định giải lớn nhất cho x%, còn lại là random
    private $fixedPercent = 0;

    public function __construct($gameRequests, $percentWin = 50, $percentConvertToPrize = 40, $fixedPercent = 80)
    {
        $this->gameRequests = $gameRequests;
        $this->calculateTotal();
        $this->percentWin = $percentWin / 100;
        $this->percentConvertToPrize = $percentConvertToPrize / 100;
        $this->fixedPercent = $fixedPercent / 100;
    }

    private function calculateTotal()
    {

        foreach ($this->gameRequests as $key => $game) {
            $this->sum += $this->total[$key] = $game * BallType::getByValue($key)->getBetAmount();
        }
    }
    private function calculatePercent($type)
    {
        $tmp = array_key_exists($type, $this->total) ? $this->total[$type] : 0;
        return $tmp / $this->sum;
    }

    private function calculateTotalPrize()
    {
        return $this->totalPrize = $this->percentWin * $this->sum * $this->percentConvertToPrize;
    }

    private function calculateTotalPrizeByType($type)
    {
        return $this->calculatePercent($type) * $this->calculateTotalPrize();
    }



    public function calculateResultBags()
    {
        $listSorted = BallType::getListDescSorted();

        $totalPrize = $this->calculateTotalPrize();
        $result = [];
        foreach ($listSorted as $ballType => $ballValue) {
            $numBall = $this->gameRequests[$ballValue];
            $fixedBall = (int) ($numBall * $this->fixedPercent);
            $prizeBag = new PrizeBag($ballValue, $numBall, $fixedBall, $totalPrize);
            $prizeBag->calcBagPrizes();
            $totalPrize -= $prizeBag->getSum();
            $result[$ballValue] = $prizeBag;
        }
        return $result;
    }

    public function generateBetDetails($currentGameRecordId)
    {
        $resultBags = $this->calculateResultBags();
        $startPoints = [16, 18];
        $dataInserts = [];
        $count = 0;
        foreach ($resultBags as $kresultBag => $resultBag) {
            $oneBags = $resultBag->getResults();
            foreach ($oneBags as $kbag => $bag) {
                $numBall = $bag['num_ball'];
                if ($numBall == 0) continue;
                $bagValue = $bag['bag_value'];
                $bag = Bag::$kbag();
                $bagIndexs = $bag->getBagIndexs();
                $size = $numBall * 5;
                $paths = GamePlinkoPath::select('id', 'start', 'dest', 'path', 'zigzag')->whereIn('start', $startPoints)->whereIn('dest', $bagIndexs)->inRandomOrder()->limit($size)->get();
                for ($i = 0; $i < $numBall; $i++) {
                    $path = $paths->random(1)->first();
                    $dataInserts[] = [
                        'game_plinko_type_id' => 1,
                        'game_plinko_record_id' => $currentGameRecordId,
                        'created_at' => now(),
                        'updated_at' => now(),
                        'type' => $kresultBag,
                        'path' => $path->path,
                        'start' => $path->start,
                        'dest' => $path->dest,
                        'game_plinko_path_id' => $path->id,
                        'bag_name' => $kbag,
                        'bag_value' => $bagValue,
                        'zigzag' => $path->zigzag
                    ];
                    $count++;
                    if ($count % 200 == 0) {
                        GamePlinkoUserBetDetail::insert($dataInserts);
                        $dataInserts = [];
                    }
                }
            }
        }
        if (count($dataInserts)) {
            GamePlinkoUserBetDetail::insert($dataInserts);
        }
        $this->randomUserBetDetail($currentGameRecordId);
    }

    private function randomUserBetDetail($currentGameRecordId)
    {
        $bets = GamePlinkoUserBet::select('id', 'user_id', 'qty', 'type')->where('game_plinko_record_id', $currentGameRecordId)->get();
        foreach ($bets as $key => $bet) {
            $qty = $bet->qty;
            $type = $bet->type;
            $details = GamePlinkoUserBetDetail::select('id')->where('game_plinko_record_id', $currentGameRecordId)->where('type', $type)->inRandomOrder()->limit($qty)->get();
            foreach ($details as $kdetail => $detail) {
                $detail->user_id = $bet->user_id;
                $detail->game_plinko_user_bet_id = $bet->id;
                $detail->save();
            }
        }
    }


    /**
     * Get the value of sum
     *
     * @return  mixed
     */
    public function getSum()
    {
        return $this->sum;
    }

    /**
     * Set the value of sum
     *
     * @param   mixed  $sum  
     *
     * @return  self
     */
    public function setSum($sum)
    {
        $this->sum = $sum;
        return $this;
    }
}
