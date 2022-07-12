<?php

namespace App\Models\Games\Plinko;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel;
use App\Models\Games\Plinko\GamePlinkoRecord;

class GamePlinkoType extends BaseModel
{
    use HasFactory;

    public function getCurrentGameRecord()
    {
        $nowTimeStamp = now()->timestamp;
        return GamePlinkoRecord::where('game_win_type_id', $this->id)
            ->where('start_time', '<=', $nowTimeStamp)
            ->where('end_time', '>', $nowTimeStamp)
            ->first();
    }
    public static function generateGameRecords()
    {
        $types = static::select('id', 'seconds')->act()->get();

        foreach ($types as $key => $type) {
            $type->renderGameRecord();
        }
    }

    private function renderGameRecord()
    {
        $today = now();
        $existToday =  $this->isExistItemByDate($today);
        if (!$existToday) {
            $this->generateGameByTime($today);
        }
        $tomorrow = now()->addDays(1);
        $existTomorrow = $this->isExistItemByDate($tomorrow);
        if (!$existTomorrow) {
            $this->generateGameByTime($tomorrow);
        }
    }

    private function isExistItemByDate($time)
    {
        $day = $time->day;
        $month = $time->month;
        $year = $time->year;
        $item = GamePlinkoRecord::where('day', $day)
            ->where('month', $month)
            ->where('year', $year)
            ->first();
        return isset($item);
    }
    private function generateGameByTime($timeAnchor)
    {

        $currentMinuteRange = $this->seconds / 60;
        $day = $timeAnchor->day;
        $month = $timeAnchor->month;
        $year = $timeAnchor->year;
        $timeStampStart = $timeAnchor->startOfDay()->timestamp;
        $count = 1;
        $dataInsert = [];
        for ($i = 0; $i < 24; $i++) {
            for ($j = 0; $j < 60; $j++) {
                if (($i * 60 + $j) % $currentMinuteRange == 0) {
                    $dataAdd = [];
                    $dataAdd['id'] = (int)($year . $timeAnchor->format('m') . $timeAnchor->format('d') . $this->id . sprintf('%s%04s', '', $count));
                    $dataAdd['day'] = $day;
                    $dataAdd['month'] = $month;
                    $dataAdd['year'] = $year;
                    $dataAdd['minute'] = $j;
                    $dataAdd['hour'] = $i;
                    $dataAdd['game_win_type_id'] = $this->id;
                    $dataAdd['is_end'] = 0;
                    $dataAdd['admin_init'] = 0;
                    $dataAdd['created_at'] = now();
                    $dataAdd['updated_at'] = now();
                    $dataAdd['start_time'] = $timeStampStart;
                    $dataAdd['end_time'] = $timeStampStart + $this->seconds;
                    $timeStampStart = $dataAdd['end_time'];
                    array_push($dataInsert, $dataAdd);
                    $count++;
                }
            }
            if ($count % 200 == 0) {
                GamePlinkoRecord::insert($dataInsert);
                $dataInsert = [];
            }
        }
        if (count($dataInsert) > 0) {
            GamePlinkoRecord::insert($dataInsert);
        }
    }
}
