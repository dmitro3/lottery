<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class CommissionTree extends BaseModel
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function directChild()
    {
        return $this->hasMany(CommissionTree::class,'user_introduce_id','user_id');
    }
    public static function getTreeNode(int $userId)
    {
        return self::where('user_id',$userId)->first();
    }
    public static function getListTreeNodeChild(int $userId)
    {
        return self::where('user_introduce_id',$userId)->get();
    }
    public static function getExactlyNode(int $userIntroduceId, int $userChildId)
    {
        return self::where(['user_introduce_id'=>$userIntroduceId,'user_id'=>$userChildId])->first();
    }
    public function getCountDirectChild()
    {
        return self::select('id')->where('user_introduce_id',$this->user_id)->count();
    }
}