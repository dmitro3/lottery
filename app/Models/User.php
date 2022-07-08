<?php
namespace App\Models;

use App\Notifications\ResetPasswordNotification;
use App\Notifications\User as UserNotify;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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
        $userWallet = Wallet::where('user_id', $this->id)->first();
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
    public function getAmount()
    {
        $userWallet = $this->getWallet();
        return $userWallet->amount;
    }
    public function changeMoney($amount,$reason,$type,$mapId)
    {
        $userWallet = $this->getWallet();
        return $userWallet->changeMoney($amount,$reason,$type,$mapId);
    }
    public function changeMoneyFreeze($amount,$reason,$type,$mapId)
    {
        $userWallet = $this->getWallet();
        return $userWallet->changeMoneyFreeze($amount,$reason,$type,$mapId);
    }
}
