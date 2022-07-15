<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class CommissionUserDirectChildStatistics extends BaseModel
{
    use HasFactory;
    protected $table = "commission_user_direct_child_statistics";
    public static function getCurrentWeekRecord($userId)
    {
        $currentWeek = now()->format('W');
        $year = now()->year;
        $currentWeekRecord = self::where('user_id',$userId)
                                    ->where('week',$currentWeek)
                                    ->where('year',$year)
                                    ->first();
        if (isset($currentWeekRecord)) {
            return $currentWeekRecord;
        }
        $newCurrentWeekRecord = new CommissionUserDirectChildStatistics;
        $newCurrentWeekRecord->user_id = $userId;
        $newCurrentWeekRecord->week = $currentWeek;
        $newCurrentWeekRecord->year = $year;
        $newCurrentWeekRecord->total_amount = 0;
        $newCurrentWeekRecord->save();
        return $newCurrentWeekRecord;
    }
}