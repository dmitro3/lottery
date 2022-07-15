<?php 
namespace vanhenry\manager\controller;
use vanhenry\manager\helpers\CT;
use App\Models\Games\Win\{
    GameWinType,
    GameWinRecord,
};
class GameViewController extends Admin
{
    public function __construct()
    {
        parent::__construct();
        $ar = \Session::get(CT::$KEY_SESSION_USER_LOGIN);
        if (!isset($ar) || !array_key_exists('module', $ar)) {
            abort(404);
        }
        $fil = collect($ar['module']);
        if (count($fil->where('parent',28)) == 0) {
            abort(404);
        }
    }
    public function gameInfo($game)
    {
        switch ($game) {
            case 'wingo':
                return $this->gameInfoWinfo();
                break;
            default:
                abort(404);
                break;
        }
    }
    private function gameInfoWinfo()
    {
        $listGameWintype = GameWinType::get();
        return view('vh::game_infos.wingo',compact('listGameWintype'));
    }
}
