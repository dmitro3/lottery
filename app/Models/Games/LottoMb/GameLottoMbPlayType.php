<?php

namespace App\Models\Games\LottoMb;

use App\Models\Games\Lotto\GameLottoPlayType;

class GameLottoMbPlayType extends GameLottoPlayType
{

    public function getGameLottoRecordClass()
    {
        return GameLottoMbPlayRecord::class;
    }
    public function gameLottoPlayRecords()
    {
        return $this->hasMany(GameLottoMbPlayRecord::class, 'game_lotto_play_type_id');
    }
    public function getCurrentGameRecord()
    {
        $nowTimeStamp = now()->timestamp;
        return $this->getGameLottoRecordClass()::where('game_lotto_play_type_id', $this->id)
            ->where('start_time', '<=', $nowTimeStamp)
            ->where('end_time', '>', $nowTimeStamp)
            ->where('is_end', 0)
            ->first();
    }
    protected function renderGameRecord()
    {
        $yesterday = now()->addDays(-1);
        $existYesterday =  $this->isExistItemByDate($yesterday);
        if (!$existYesterday) {
            $this->generateGameByTime($yesterday);
        }

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
    private function isDayExcept($din)
    {

        try {
            $day = \SettingHelper::getSetting('lottomb_excerpt_day', '');
            $days = explode(',', $day);
            foreach ($days as $d) {
                $date = \Carbon\Carbon::createFromFormat('d/m/Y', $d);
                if ($date->year == $din->year && $date->month == $din->month && $date->day == $din->day) {
                    return true;
                }
            }
        } catch (\Exception $err) {
        }
        return false;
    }
    protected function generateGameByTime($timeAnchor)
    {
        $startDate = clone $timeAnchor;
        $endDate = clone $timeAnchor;
        if ($timeAnchor->hour < 19) {
            $startDate->addDays(-1);
        } else {
            $endDate->addDays(1);
        }

        $startDate->hour(19);
        $startDate->minute(0);
        $startDate->second(0);

        $endDate->hour(19);
        $endDate->minute(0);
        $endDate->second(0);

        $isEnd = $this->isDayExcept($endDate);

        $timeStampStart = $startDate->timestamp;


        $currentMinuteRange = $this->seconds / 60;
        $day = $endDate->day;
        $month = $endDate->month;
        $year = $endDate->year;
        $count = 1;
        $dataInsert = [];
        for ($i = 0; $i < 24; $i++) {
            for ($j = 0; $j < 60; $j++) {
                if (($i * 60 + $j) % $currentMinuteRange == 0) {
                    $dataAdd = [];
                    $dataAdd['id'] = (int)($year . $endDate->format('m') . $endDate->format('d') . $this->id . sprintf('%s%04s', '', $count));
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
                    $dataAdd['is_end'] = $isEnd;
                    $dataAdd['start_time'] = $timeStampStart;
                    $endTime = $endDate->timestamp;
                    $dataAdd['end_time'] = $endTime;
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
