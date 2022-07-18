<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class CommissionStatistics extends BaseModel
{
    use HasFactory;
    protected $table = "commission_statistics";
    public static function getCurrentDayRecord($userId)
    {
        $now = now();
        $day = $now->day;
        $month = $now->month;
        $year = $now->year;
        $currentDayRecord = self::where('user_id',$userId)
                                    ->where('day',$day)
                                    ->where('month',$month)
                                    ->where('year',$year)
                                    ->first();
        if (isset($currentDayRecord)) {
            return $currentDayRecord;
        }
        $newCurrentDayRecord = new CommissionStatistics;
        $newCurrentDayRecord->user_id = $userId;
        $newCurrentDayRecord->day = $day;
        $newCurrentDayRecord->month = $month;
        $newCurrentDayRecord->year = $year;
        $newCurrentDayRecord->total_amount = 0;
        $newCurrentDayRecord->save();
        return $newCurrentDayRecord;
    }
}