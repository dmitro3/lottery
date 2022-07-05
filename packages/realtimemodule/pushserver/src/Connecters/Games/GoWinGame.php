<?php 
namespace realtimemodule\pushserver\Connecters\Games;
use realtimemodule\pushserver\Contracts\ConnecterInterface;
class GoWinGame implements ConnecterInterface
{
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
        var_dump($this->messageInfo);die();
    }
    private function buildResponse($status,$data,$action = null){
        $dataMessage = [];
        $dataMessage['success'] = $status;
        $dataMessage['data'] = $data;
        $dataMessage['action'] = $action;
        return json_encode($dataMessage);
    }
}
