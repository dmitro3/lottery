<?php
namespace App\Http\Controllers\Games;
use App\Http\Controllers\Controller;
use \Auth;

class BaseGameController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        if(!Auth::check()){
            return redirect('dang-nhap')->with('messageNotify', 'Vui lòng đăng nhập')->with('typeNotify', 100)->send();
        }
    }
}