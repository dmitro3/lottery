<?php

namespace App\Models\Games\Lotto;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel;

class GameLottoPlayType extends BaseModel
{
    use HasFactory;

    public function getGameLottoRecordClass()
    {
        return GameLottoPlayRecord::class;
    }
    public function gameLottoPlayRecords()
    {
        return $this->hasMany(GameLottoPlayRecord::class);
    }
    public function getCurrentGameRecord()
    {
        $nowTimeStamp = now()->timestamp;
        return $this->getGameLottoRecordClass()::where('game_lotto_play_type_id', $this->id)
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

    protected function renderGameRecord()
    {
        $today = now();
        $yesterday = $today->addDays(-1);
        $existYesterday =  $this->isExistItemByDate($yesterday);
        if (!$existYesterday) {
            $this->generateGameByTime($yesterday);
        }
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

    protected function isExistItemByDate($time)
    {
        $day = $time->day;
        $month = $time->month;
        $year = $time->year;
        $item = $this->getGameLottoRecordClass()::where('day', $day)
            ->where('month', $month)
            ->where('year', $year)
            ->first();
        return isset($item);
    }
    protected function generateGameByTime($timeAnchor)
    {
        $hour = $timeAnchor->hour;
        $startTime = $timeAnchor;
        if ($hour >= 19) {
            $startTime = $timeAnchor->addDays(1);
        }
        $startTime->hour(19);
        $startTime->minute(0);
        $startTime->second(0);
        $timeStampStart = $timeAnchor->timestamp - 86400;


        $currentMinuteRange = $this->seconds / 60;
        $day = $timeAnchor->day;
        $month = $timeAnchor->month;
        $year = $timeAnchor->year;
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
                    $dataAdd['game_lotto_play_type_id'] = $this->id;
                    $dataAdd['is_end'] = 0;
                    $dataAdd['admin_init'] = 0;
                    $dataAdd['created_at'] = now();
                    $dataAdd['updated_at'] = now();
                    $dataAdd['start_time'] = $timeStampStart;
                    $endTime = $timeStampStart;
                    $dataAdd['end_time'] = $endTime - 3600; //end vào lúc 18h, quay số lúc 18h15
                    $timeStampStart = $endTime;
                    array_push($dataInsert, $dataAdd);
                    $count++;
                }
            }
            if ($count % 200 == 0) {
                $this->getGameLottoRecordClass()::insert($dataInsert);
                $dataInsert = [];
            }
        }
        if (count($dataInsert) > 0) {
            $this->getGameLottoRecordClass()::insert($dataInsert);
        }
    }
}
