<?php 
namespace realtimemodule\pushserver\Connecters\Games;
use realtimemodule\pushserver\Contracts\ConnecterInterface;
use realtimemodule\pushserver\Helpers\PushServerHelper;
use realtimemodule\pushserver\Models\User;
use App\Models\Games\Win\{
    GameWinType,
    GameWinMultiple,
    GameWinMoneyItem
};
class GoWinGame implements ConnecterInterface
{
    const GAME_CONNECT_STATUS_SUCCESS = 200;
    const GAME_CONNECT_STATUS_NOT_LOGIN = 401;
    const GAME_CONNECT_STATUS_UNKNOWN_ERROR = 603;
    const GAME_CONNECT_STATUS_DATA_NOT_FOUND = 604;

    const GAME_ACTION_GET_CURRENT_GAME_TYPE_INFO = 1;

    protected $connection;
    protected $clients;
    protected $connectionList;
    protected $from;
    protected $messageInfo;
    public function setData($connection,$clients,$connectionList,$messageInfo,$from) {
        $this->connection = $connection;
        $this->clients = $clients;
        $this->connectionList = $connectionList;
        $this->messageInfo = $messageInfo;
        $this->from = $from;
    }
    public function response()
    {
        if (!isset($this->connection)) {
            $this->from->send($this->buildResponse(self::GAME_CONNECT_STATUS_UNKNOWN_ERROR,false,'Lỗi không xác định.'));
            return $this->connection;
        }
        if (!isset($this->connection['userTargetMessage'])) {
            $userTargetMessage = User::find($this->connection['user_id']);
            if (!isset($userTargetMessage)) {
                $this->from->send($this->buildResponse(self::GAME_CONNECT_STATUS_NOT_LOGIN,false,'Vui lòng đăng nhập để sử dụng tính năng này.'));
                return $this->connection;
            }
            $this->connection['userTargetMessage'] = $userTargetMessage;
        }
        $action = $this->messageInfo['action'] ?? 0;
        switch ($action) {
            case self::GAME_ACTION_GET_CURRENT_GAME_TYPE_INFO:
                return $this->getCurrentGameTypeInfo($action);
            default:
                return $this->connection;
                break;
        }
        return $this->connection;
    }
    private function getCurrentGameTypeInfo($action){
        $gameWinTypeId = PushServerHelper::unHash($this->messageInfo['game_type']);
        $gameWinType = GameWinType::find($gameWinTypeId);
        if (!isset($gameWinType)) {
            $this->from->send($this->buildResponse(self::GAME_CONNECT_STATUS_DATA_NOT_FOUND,false,'Game tạm thời không khả dụng.'));
            return $this->connection;
        }
        $currentGame = $gameWinType->getCurrentGameRecord();
        if (!isset($currentGame)) {
            $this->from->send($this->buildResponse(self::GAME_CONNECT_STATUS_DATA_NOT_FOUND,false,'Game tạm thời không khả dụng.'));
            return $this->connection;
        }
        $data = [];
        $timeRemaining = $currentGame->getTimeRemaining();
        $data['html'] = view('games.win.current_game_info',compact('currentGame','gameWinType',$timeRemaining))->render();
        $data['time_remaining'] = $timeRemaining;
        $data['game_type'] = $this->messageInfo['game_type'];
        $data['game_type_name'] = $gameWinType->name;
        $data['current_game_idx'] = $currentGame->id;
        $this->from->send($this->buildResponse(self::GAME_CONNECT_STATUS_SUCCESS,true,'Thành công.',$data,$action));
        return $this->connection;
    }
    private function buildResponse($code,$status,$message,$data = [],$action = null){
        $dataResponse = [];
        $dataResponse['code'] = $code;
        $dataResponse['success'] = $status;
        $dataResponse['message'] = $message;
        $dataResponse['data'] = $data;
        $dataResponse['action'] = $action;
        return json_encode($dataResponse);
    }
}
