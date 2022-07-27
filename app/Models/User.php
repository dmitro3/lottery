<?php
namespace App\Models;

use App\Notifications\ResetPasswordNotification;
use App\Notifications\User as UserNotify;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Helpers\Mobile_Detect;
use App\Models\Games\Lotto\GameLottoPlayUserBet;
use vanhenry\manager\model\HUser;
use App\Models\Games\Win\{
    GameWinUserBet
};
use App\Models\Games\Plinko\{
    GamePlinkoUserBet
};

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $hidden = ['password', 'remember_token'];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function sendNotification(array $data, int $type)
    {
        $this->notify(new UserNotify($data, $type, $this));
    }

    public function province()
    {
        return $this->belongsTo(Province::class,'province_id','id');
    }

    public function ward()
    {
        return $this->belongsTo(Ward::class,'ward_id','id');
    }

    public function district()
    {
        return $this->belongsTo(District::class,'district_id','id');
    }
    public function getWallet()
    {
        $userWallet = Wallet::where('user_id', $this->id)->with('user')->first();
        if (!isset($userWallet)) {
            $userWallet = new Wallet;
            $userWallet->user_id = $this->id;
            $userWallet->amount = 0;
            $userWallet->amount_freeze = 0;
            $userWallet->amount_availability = 0;
            $userWallet->save();
        }
        return $userWallet;
    }
    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }
    public function getAmount()
    {
        $userWallet = $this->getWallet();
        return $userWallet->amount;
    }
    public function changeMoney($amount,$reason,$type,$mapId,$isMarketing = 0,$chechAgain = true)
    {
        $userWallet = $this->getWallet();
        return $userWallet->changeMoney($amount,$reason,$type,$mapId,$isMarketing,$chechAgain);
    }
    public function logLoginAction()
    {
        $mobileDetect = new Mobile_Detect;
        $userLoginLog = new UserLoginLog;
        $userLoginLog->user_id = $this->id;
        $userLoginLog->user_ip = request()->ip();
        $userLoginLog->user_agent = request()->header('User-Agent');
        $userLoginLog->device_type = $mobileDetect->isMobile() ? 'Mobile':'Pc';
        $userLoginLog->save();
    }
    public function loginLog()
    {
        return $this->hasMany(UserLoginLog::class);
    }
    public function rechargeRequest()
    {
        return $this->hasMany(RechargeRequest::class);
    }
    public function userBank()
    {
        return $this->hasMany(UserBank::class);
    }
    public function withdrawalRequest()
    {
        return $this->hasMany(WithdrawalRequest::class);
    }
    public function gameWinUserBet()
    {
        return $this->hasMany(GameWinUserBet::class);
    }
    public function gamePlinkoUserBet()
    {
        return $this->hasMany(GamePlinkoUserBet::class);
    }
    public function gameLottoPlayUserBet()
    {
        return $this->hasMany(GameLottoPlayUserBet::class);
    }
    public function userIntroduce()
    {
        return $this->belongsTo(User::class,'introduce_user_id');
    }
    public function hUser()
    {
        return $this->belongsTo(HUser::class,'h_user_id');
    }
    public function buildIntroduceLink()
    {
        return url()->to('dang-ky').'?r_code='.$this->referral_code;
    }
    public static function getTotalRecordToday()
    {
        return self::where('created_at',now()->startOfDay())->count();
    }
}
