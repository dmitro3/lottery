<?php

namespace App\Models\Games\LottoMb;

use App\Models\Games\Lotto\GameLottoPlayRecord;

class GameLottoMbPlayRecord extends GameLottoPlayRecord
{
    public function gameLottoPlayUserBets()
    {
        return $this->hasMany(GameLottoMbPlayUserBet::class, 'game_lotto_play_record_id');
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
                    $dataAdd['end_time'] = $endTime; //end vào lúc 18h, quay số lúc 18h15
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
