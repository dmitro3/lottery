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
    public function generateBetDetails($ballType, $gameRecordId)
    {
        $prizeBags = $this->prizeBags;
        $startPoints = [16, 18];
        $dataInserts = [];
        $count = 0;
        foreach ($prizeBags as $kPrizeBag => $prizeBag) {

            $bagName = $prizeBag->getName();
            $bag = Bag::$bagName();
            $bagIndexs = $bag->getBagIndexs();

            $numBall = $prizeBag->getNumBall();
            $paths = $this->retreivePaths($numBall, $startPoints, $bagIndexs);
            $this->createBetDetail($paths, $gameRecordId, $ballType, $bag);

            $numBallResidual = $prizeBag->getNumBallResidual();
            $paths = $this->retreivePaths($numBallResidual, $startPoints, $bagIndexs);
            $this->createBetDetail($paths, $gameRecordId, $ballType, $bag, 1);
        }
    }
    private function createBetDetail($paths, $gameRecordId, $ballType, $bag, $is_residual = 0)
    {
        $count = 0;
        $dataInserts = [];
        foreach ($paths as $path) {
            $dataInserts[] = [
                'game_plinko_type_id' => 1,
                'game_plinko_record_id' => $gameRecordId,
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
                'is_residual' => $is_residual
            ];
            if ($count % 100 == 0) {
                GamePlinkoUserBetDetail::insert($dataInserts);
                $dataInserts = [];
            }
            $count++;
        }
        if (count($dataInserts) > 0) {
            GamePlinkoUserBetDetail::insert($dataInserts);
        }
    }
    private function retreivePaths($numBall, $startPoints, $bagIndexs)
    {
        $paths = collect();
        while ($numBall > 0) {
            $tmp = GamePlinkoPath::select('id', 'start', 'dest', 'path', 'zigzag')->whereIn('start', $startPoints)->whereIn('dest', $bagIndexs)->inRandomOrder()->limit($numBall)->get();
            $paths = $paths->concat($tmp);
            $numBall = $numBall - $tmp->count();
        }
        return $paths;
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
