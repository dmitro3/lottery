<?php
namespace realtimemodule\pushserver\Helpers;
use \Auth;
use \Str;
use realtimemodule\pushserver\Models\User;
class PushServerHelper {
    public static function generateHash($key)
    {
        $hash = $key.rand(100,999);
    	$hash = base64_encode($hash);
        $hash = base64_encode($hash.Str::random(30));
        $hash = base64_encode(Str::random(30).$hash);
    	return $hash;
    }
    public static function unHash($hash)
    {
        $key = base64_decode($hash);
        $key = Str::substr($key,30,Str::length($key));
        $key = base64_decode($key);
        $key = Str::substr($key,0,Str::length($key) - 30);
        $key = base64_decode($key);
        $key = Str::substr($key,0,Str::length($key) - 3);
        return $key;
    }
    public static function getTokenUserKey()
    {
    	if (!Auth::check()) {
    		return '';
    	}
    	return self::generateHash(Auth::id());
    }
    public static function getUserByHash($hash)
    {
        $userId = self::unHash($hash);
        return User::find($userId);
    }
    public static function extractJson($json,$isArray = true,$def = []) {
        json_decode($json);
        if (json_last_error() != JSON_ERROR_NONE) return $def;
        return $isArray ? json_decode($json,true):json_decode($json);
    }
}