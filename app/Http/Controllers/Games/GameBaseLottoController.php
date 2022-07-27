<?php

namespace App\Http\Controllers\Games;

use App\Games\BaseLotto\BaseLotto;
use App\Games\Lotto\Categories\TypeCategoryProvider;
use App\Games\Lotto\Enums\NoPrize;
use App\Games\Lotto\TableResult;
use App\Models\Games\Lotto\GameLottoCategory;
use App\Models\Games\Lotto\GameLottoPlayRecord;
use App\Models\Games\Lotto\GameLottoPlayType;
use App\Models\Games\Lotto\GameLottoPlayUserBet;
use App\Models\Games\Lotto\GameLottoTableResult;
use App\Models\Games\Lotto\GameLottoType;

abstract class GameBaseLottoController extends BaseGameController
{
    protected BaseLotto $gameLottoProvider;
    protected $game = 'lotto';

    public function index($request)
    {
        $showBaseLoading = false;
        $user = \Auth::user();
        $categories = GameLottoCategory::select('name', 'id')->act()->get();
        $types = GameLottoType::select('id', 'code', 'choose_min', 'choose_max', 'bet', 'win', 'min_bet')->act()->get()->keyBy('code');
        $currentGameRecord = $this->gameLottoProvider->getGamePlayType()::find(1)->getCurrentGameRecord();

        $prevGameRecord = $this->gameLottoProvider->getGameRecord()::select('id')->where('id', '<', $currentGameRecord->id)->orderBy('id', 'desc')->limit(1)->first();
        $results = [];
        $prevGameRecordId = 0;
        if ($prevGameRecord) {
            $prevGameRecordId = $prevGameRecord->id;
            $results =  $this->gameLottoProvider->getGameTableResult()::select('type_prize', 'value')->where('game_lotto_play_record_id', $prevGameRecordId)->get()->groupBy('type_prize')->toArray();
        }
        $tableResult = new TableResult($results);
        return view('games.' . $this->game . '.index', compact('user', 'showBaseLoading', 'categories', 'types', 'tableResult', 'prevGameRecordId'));
    }
    public function getGameContent($request)
    {
        $type = (int)$request->input('typeGame', 0);
        if ($type == 0) return;
        $category = GameLottoCategory::act()->find($type);
        $typeGame = TypeCategoryProvider::getTypeGame($category);
        if (!$typeGame) return;

        return $typeGame->toJson();
    }
    public function getGameHistory($request)
    {
        $user = \Auth::user();
        $listItems =  $this->gameLottoProvider->getGameUserBet()::where('user_id', $user->id)->where('game_lotto_play_user_bet_status_id', '<>', GameLottoPlayUserBet::STATUS_WAIT_RESULT)->orderBy('id', 'desc')->paginate(10);
        return response()->json([
            'code' => 200,
            'html' => view('games.lotto.history_results.game_history_result', compact('listItems'))->render()
        ]);
    }
    public function getGameChoosenNumber($request)
    {
        $type = (int)$request->input('typeGame', 0);
        if ($type == 0) return;
        $currentGameRecord = $this->gameLottoProvider->getGamePlayType()::find(1)->getCurrentGameRecord();
        $user = \Auth::user();
        $bets = $currentGameRecord->gameLottoPlayUserBets()->select('numbers')->where('user_id', $user->id)->get()->pluck('numbers');
        return response()->json(
            ['code' => 200, 'data' => $bets]
        );
    }
}
