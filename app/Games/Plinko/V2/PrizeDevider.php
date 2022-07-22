<?php

namespace App\Games\Plinko\V2;

use App\Games\Plinko\Enums\Bag;
use App\Games\Plinko\Enums\BallType;
use App\Models\Games\Plinko\GamePlinkoPath;
use App\Models\Games\Plinko\GamePlinkoTotalBet;
use App\Models\Games\Plinko\GamePlinkoUserBet;
use App\Models\Games\Plinko\GamePlinkoUserBetDetail;
use \vanhenry\helpers\helpers\SettingHelper as Setting;

class PrizeDevider
{
    private $prizeBags;
    private $sum;
    public function __construct($prizeBags, $sum)
    {
        $this->prizeBags = $prizeBags;
        $this->sum = $sum;
    }
    public function devidePrizeMoney(int $ballType, $totalPrize = 100000)
    {
        $ball = BallType::getByValue($ballType);
        $ballAmount = $ball->getBetAmount();
        foreach ($this->prizeBags as $key => $prizeBag) {
            $tmpPrize = $totalPrize *  $prizeBag->getRange() / $this->sum;
            $bagValue = $prizeBag->getBagValue();
            $numBall = $tmpPrize / ($ballAmount * $bagValue);
            $prizeBag->setNumBall($numBall);
            $totalPrize -= $numBall * $bagValue * $ballAmount;
        }

        $this->devidePrizeToSmallestBag($ballAmount, $totalPrize);
    }
    public function generateBetDetails($ballType, $currentGameRecordId)
    {
        $prizeBags = $this->prizeBags;
        $startPoints = [16, 18];
        $dataInserts = [];
        $count = 0;
        foreach ($prizeBags as $kPrizeBag => $prizeBag) {
            $numBall = $prizeBag->getNumBall();
            $bagName = $prizeBag->getName();
            $bag = Bag::$bagName();
            $bagIndexs = $bag->getBagIndexs();
            $paths = collect();
            while ($numBall > 0) {
                $tmp = $paths->concat(GamePlinkoPath::select('id', 'start', 'dest', 'path', 'zigzag')->whereIn('start', $startPoints)->whereIn('dest', $bagIndexs)->inRandomOrder()->limit($numBall)->get());
                $paths = $paths->concat($tmp);
                $numBall = $numBall - $paths->count();
            }

            foreach ($paths as $path) {
                $dataInserts[] = [
                    'game_plinko_type_id' => 1,
                    'game_plinko_record_id' => $currentGameRecordId,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'type' => $ballType,
                    'path' => $path->path,
                    'start' => $path->start,
                    'dest' => $path->dest,
                    'game_plinko_path_id' => $path->id,
                    'bag_name' => $bag->getName(),
                    'bag_value' => $bag->getValue(),
                    'zigzag' => $path->zigzag
                ];
                if ($count % 200 == 0) {
                    GamePlinkoUserBetDetail::insert($dataInserts);
                    $dataInserts = [];
                }
                $count++;
            }
            $paths = collect();
            $numBallResidual = $prizeBag->getNumBallResidual();
            while ($numBallResidual > 0) {
                $tmp = GamePlinkoPath::select('id', 'start', 'dest', 'path', 'zigzag')->whereIn('start', $startPoints)->whereIn('dest', $bagIndexs)->inRandomOrder()->limit($numBallResidual)->get();
                $paths = $paths->concat($tmp);
                $numBallResidual = $numBallResidual - $tmp->count();
            }
            foreach ($paths as $path) {
                $dataInserts[] = [
                    'game_plinko_type_id' => 1,
                    'game_plinko_record_id' => $currentGameRecordId,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'type' => $ballType,
                    'path' => $path->path,
                    'start' => $path->start,
                    'dest' => $path->dest,
                    'game_plinko_path_id' => $path->id,
                    'bag_name' => $bag->getName(),
                    'bag_value' => $bag->getValue(),
                    'zigzag' => $path->zigzag,
                    'is_residual' => 1
                ];
                if ($count % 200 == 0) {
                    GamePlinkoUserBetDetail::insert($dataInserts);
                    $dataInserts = [];
                }
                $count++;
            }

            if (count($dataInserts) > 0) {
                GamePlinkoUserBetDetail::insert($dataInserts);
            }
        }
    }
    private function devidePrizeToSmallestBag($ballAmount, $totalPrize)
    {
        $smallestBag = $this->prizeBags[count($this->prizeBags) - 1];
        $bagValue = $smallestBag->getBagValue();
        $numBall =  $totalPrize / ($ballAmount * $bagValue);
        $smallestBag->addNumBall($numBall);
        $this->devidePrizeResidual($smallestBag);
    }
    private function devidePrizeResidual($smallestBag)
    {
        $numBall = 0;
        foreach ($this->prizeBags as $prizeBag) {
            $numBall += $prizeBag->getNumBall();
        }
        $totalRecord = Setting::getSetting('plinko_temp_record', 1000);
        if ($numBall < $totalRecord) {
            $smallestBag->setNumBallResidual($totalRecord - $numBall);
        }
    }
}
