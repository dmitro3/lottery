<?php

namespace realtimemodule\pushserver\Connecters\Games;

use App\Models\Games\Lotto\GameLottoPlayType;
use App\Models\Games\Lotto\GameLottoPlayUserBet;
use App\Models\Games\Lotto\GameLottoType;
use realtimemodule\pushserver\Contracts\ConnecterInterface;
use realtimemodule\pushserver\Models\User;


use App\Models\WalletTransactionType;
use \realtimemodule\pushserver\Enums\Lotto\Status as LottoStatus;


class LottoConnector implements ConnecterInterface
{


    protected $connection;
    protected $clients;
    protected $connectionList;
    protected $from;
    protected $messageInfo;
    public function setData($connection, $clients, $connectionList, $messageInfo, $from)
    {
        $this->connection = $connection;
        $this->clients = $clients;
        $this->connectionList = $connectionList;
        $this->messageInfo = $messageInfo;
        $this->from = $from;
    }
    public function response()
    {
        if (!isset($this->connection)) {
            $this->from->send($this->buildResponse(LottoStatus::GAME_CONNECT_STATUS_UNKNOWN_ERROR, false, 'Lỗi không xác định.'));
            return $this->connection;
        }
        if (!isset($this->connection['userTargetMessage'])) {
            $userTargetMessage = User::find($this->connection['user_id']);
            if (!isset($userTargetMessage)) {
                $this->from->send($this->buildResponse(LottoStatus::GAME_CONNECT_STATUS_NOT_LOGIN, false, 'Vui lòng đăng nhập để sử dụng tính năng này.'));
                return $this->connection;
            }
            $this->connection['userTargetMessage'] = $userTargetMessage;
        }
        $action = $this->messageInfo['action'] ?? 0;

        switch ($action) {
            case LottoStatus::GAME_ACTION_GET_CURRENT_GAME_INFO:
                return $this->getCurrentGameTypeInfo($action);
            case LottoStatus::GAME_ACTION_DO_BET:
                return $this->play($action);
            case LottoStatus::GAME_ACTION_RETRIEVE_RESULT:
                return $this->retrieveResult($action);
            default:
                return $this->connection;
        }
        return $this->connection;
    }
    private function getCurrentGameTypeInfo($action)
    {
        $gamePlinkoType = GameLottoPlayType::find(1);
        if (!isset($gamePlinkoType)) {
            $this->from->send($this->buildResponse(LottoStatus::GAME_CONNECT_STATUS_DATA_NOT_FOUND, false, 'Game tạm thời không khả dụng.'));
            return $this->connection;
        }
        $currentGame = $gamePlinkoType->getCurrentGameRecord();
        if (!isset($currentGame)) {
            $this->from->send($this->buildResponse(LottoStatus::GAME_CONNECT_STATUS_DATA_NOT_FOUND, false, 'Game tạm thời không khả dụng.'));
            return $this->connection;
        }
        $data = [];
        $timeRemaining = $currentGame->getTimeRemaining();
        $data['html'] = view('games.lotto.current_game_info', compact('currentGame', 'gamePlinkoType', $timeRemaining))->render();
        $data['time_remaining'] = $timeRemaining;
        $data['current_game_idx'] = $currentGame->id;
        $this->from->send($this->buildResponse(LottoStatus::GAME_CONNECT_STATUS_SUCCESS, true, 'Thành công.', $data, $action));
        return $this->connection;
    }
    private function validatorPlayRequest($data)
    {
        return \Validator::make($data, [

            'type' => ['required'],
            'money' => ['required', 'min:1'],
            'numbers' => ['required',],
        ], [
            'required' => 'Thông tin :attribute là bắt buộc!',
            'money.min' => 'Vui lòng chọn đúng mức cược!',
            'numbers' => 'Vui lòng chọn số!'
        ], [
            'type' => 'Loại trò chơi',
            'money' => 'Tiền cược',
            'numbers' => 'Số',
        ]);
    }
    private function play($action)
    {
        $currentGameClientInfo = $this->messageInfo['currentGame'] ?? null;
        $gameData = $this->messageInfo['gameData'] ?? null;
        if (!isset($currentGameClientInfo) || !isset($gameData)) {
            $this->from->send($this->buildResponse(LottoStatus::GAME_CONNECT_STATUS_DATA_NOT_FOUND, false, 'Game tạm thời không khả dụng.'));
        }
        $validator = $this->validatorPlayRequest($gameData);
        if ($validator->fails()) {
            $this->from->send($this->buildResponse(100, false, $validator->errors()->first()));
            return $this->connection;
        }

        $type = (int)$gameData['type'];
        $numbers = $gameData['numbers'];
        $numbers = is_array($numbers) ? $numbers : [];
        $numbers = array_unique($numbers);

        $money = (int) $gameData['money'];
        $gameType = GameLottoType::find($type)->act();
        if (!$gameType) {
            $this->from->send($this->buildResponse(LottoStatus::GAME_CONNECT_CURRENT_GAME_INVALID, false, 'Xảy ra lỗi.'));
        }
        $chooseMin = $gameType->choose_min;
        $chooseMax = $gameType->choose_max;
        $minBet = $gameType->min_bet;
        $qty = count($numbers);
        if ($qty < $chooseMin || $qty > $chooseMax) {
            $this->from->send($this->buildResponse(LottoStatus::GAME_CONNECT_GAME_DATA_INVALID, false, 'Số lượng số đã chọn không hợp lệ.'));
            return $this->connection;
        }
        $minBet = $minBet * $qty;
        if ($money < $minBet) {
            $this->from->send($this->buildResponse(LottoStatus::GAME_CONNECT_GAME_DATA_INVALID, false, vsprintf('Số tiền cược tối thiểu là %s', [$minBet])));
            return $this->connection;
        }




        $currentGameRecord = GameLottoPlayType::find(1)->getCurrentGameRecord();
        $user = $this->connection['userTargetMessage'];

        if ($money > $user->getAmount()) {
            $this->from->send($this->buildResponse(LottoStatus::GAME_CONNECT_NOT_ENOUGH_MONEY, false, 'Số tiền không đủ.'));
            return $this->connection;
        }

        $itemUserBet = GameLottoPlayUserBet::toDatabase($user, $currentGameRecord, $gameType, $numbers, $money);
        $reason = vsprintf('Trừ tiền cược game Lotto. Phiên giao dịch %s.', [$currentGameRecord->id]);
        $user->changeMoney(0 - $money, $reason, WalletTransactionType::MINUS_MONEY_BET_GAME_LOTTO, $itemUserBet->id);

        $this->from->send($this->buildResponse(200, true, 'Bet thành công!', [], $action));
        return $this->connection;
    }
    private function retrieveResult($action)
    {
        // $currentGameClientInfo = $this->messageInfo['currentGame'] ?? null;
        // if (!isset($currentGameClientInfo)) {
        //     $this->from->send($this->buildResponse(LottoStatus::GAME_CONNECT_STATUS_DATA_NOT_FOUND, false, 'Game tạm thời không khả dụng.'));
        // }

        // $user = $this->connection['userTargetMessage'];

        // $currentGameRecord = GamePlinkoType::find(1)->getCurrentGameRecord();
        // $userBet = $currentGameRecord->gamePlinkoUserBets()->where('user_id', $user->id)->where('is_returned', 0)->orderBy('id', 'desc')->first();
        // $games = [];
        // if ($userBet) {
        //     $games = $userBet->gamePlinkoUserBetDetails()->select('path', 'type')->orderBy('zigzag', 'desc')->get()->toArray();
        //     $userBet->is_returned = 1;
        //     $userBet->save();
        // }
        // $this->from->send($this->buildResponse(200, true, 'Lấy kết quả thành công!', compact('games'), $action));
        // return $this->connection;
    }
    private function buildResponse($code, $status, $message, $data = [], $action = null)
    {
        $dataResponse = [];
        $dataResponse['code'] = $code;
        $dataResponse['success'] = $status;
        $dataResponse['message'] = $message;
        $dataResponse['data'] = $data;
        $dataResponse['action'] = $action;
        return json_encode($dataResponse);
    }
}