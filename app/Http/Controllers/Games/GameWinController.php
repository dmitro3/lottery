<?php
namespace App\Http\Controllers\Games;
use \Auth;
use App\Models\Games\Win\{
    GameWinType,
    GameWinMultiple,
    GameWinMoneyItem,
    GameWinUserBet,
    GameWinRecord
};
use Dotenv\Parser\Value;

class GameWinController extends BaseGameController
{
    public function index($request)
    {
        $itemGameRecord = GameWinRecord::find(2022070740085);
        $itemGameRecord->initWinNumber();

        $activeAudio = isset($_COOKIE['switch_audio']) && $_COOKIE['switch_audio'] == 'true';
        $listGameWinType = GameWinType::where('act',1)->orderBy('ord','asc')->get();
        $listGameWinMultiple = GameWinMultiple::where('act',1)->orderBy('ord','asc')->get();
        $listGameWinMoneyItem = GameWinMoneyItem::where('act',1)->orderBy('ord','asc')->get();
        return view('games.win.index',compact('listGameWinType','listGameWinMultiple','listGameWinMoneyItem','activeAudio'));
    }
    public function renderGameWinRecord()
    {
        $listGameWinType = GameWinType::get();
        foreach ($listGameWinType as $key => $itemGameWinType) {
            $itemGameWinType->renderGameRecord();
        }
    }
    private function _fakeUserBetRecord($idGameWinRecord){
        $arrMiniGame = [
            'size' => ['big','small'],
            'color' => ['green','violet','red'],
            'number' => [0,1,2,3,4,5,6,7,8,9]
        ];
        $arrMoney = [1000,10000,100000,1000000];
        $dataInsert = [];
        for ($i=0; $i < 20000; $i++) { 
            $dataAdd = [];
            $dataAdd['user_id'] = 1;
            $dataAdd['game_win_type_id'] = 4;
            $dataAdd['game_win_record_id'] = $idGameWinRecord;
            $dataAdd['mini_game'] = array_rand($arrMiniGame);
            $dataAdd['select_value'] = $arrMiniGame[$dataAdd['mini_game']][array_rand($arrMiniGame[$dataAdd['mini_game']])];
            $dataAdd['qty'] = rand(1,999);
            $dataAdd['amount_base'] = $arrMoney[array_rand($arrMoney)];
            $dataAdd['amount'] = $dataAdd['amount_base'] * $dataAdd['qty'];
            $dataAdd['return_amount'] = 0;
            $dataAdd['status'] = 1;
            $dataAdd['is_returned'] = 0;
            $dataAdd['created_at'] = now();
            $dataAdd['updated_at'] = now();
            array_push($dataInsert,$dataAdd);
            if (count($dataInsert) >= 1000) {
                GameWinUserBet::insert($dataInsert);
                $dataInsert = [];
            }
        }
        if (count($dataInsert) > 0) {
            GameWinUserBet::insert($dataInsert);
        }
    }
}