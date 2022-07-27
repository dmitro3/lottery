<?php
namespace crawlmodule\loterie\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class SxmbTime extends BaseModel
{
    use HasFactory;
    public static function getCurrentCrawlTimeRecord(){
        $now = now();
        $minute = $now->minute;
        $hour = $now->hour;
        $timeAnchor = now();
        if ($hour < 18 || ($hour == 18 && $minute < 15)) {
            $timeAnchor = now()->subDays(1);
        }
        $day = $timeAnchor->day;
        $month = $timeAnchor->month;
        $year = $timeAnchor->year;
        $oldRecord = self::where('day',$day)
                        ->where('month',$month)
                        ->where('year',$year)
                        ->first();
        if (isset($oldRecord)) {
            return $oldRecord;
        }
        $sxmbTime = new self;
        $sxmbTime->day = $day;
        $sxmbTime->month = $month;
        $sxmbTime->year = $year;
        $sxmbTime->save();
        return $sxmbTime;
    }
}
