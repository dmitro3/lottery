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
        $action = request()->action;
        switch ($action) {
            case 'load_current_game_type_history':
                return $this->loadCurrentGameWingoTypeHistory();
                break;
            case 'load_current_game':
                return $this->loadCurrentGameWingo();
                break;
            default:
                break;
        }
        $listGameWintype = GameWinType::get();
        return view('vh::game_infos.wingo',compact('listGameWintype'));
    }
    private function loadCurrentGameWingoTypeHistory(){
        $gameWinType = GameWinType::find(request()->game_type ?? 0);
        if (!isset($gameWinType)) {
            return 'Game tạm thời không khả dụng';
        }
        $listItems = $gameWinType->gameWinRecord()
                                ->orderBy('id','desc')
                                ->where('end_time','<=',now()->timestamp)
                                ->paginate(10);
        return view('vh::game_infos.wingo_history_result',compact('listItems'))->render();
    }
    private function loadCurrentGameWingo(){
        $gameWinType = GameWinType::find(request()->game_type ?? 0);
        if (!isset($gameWinType)) {
            return 'Game tạm thời không khả dụng';
        }
        $currentGame = $gameWinType->getCurrentGameRecord();
        return response()->json([
            'current_game_idx' => $currentGame->id,
            'time_remaining' => $currentGame->getTimeRemaining(),
            'html' => view('vh::game_infos.wingo_current_game_result',compact('currentGame'))->render()
        ]);
    }
}
