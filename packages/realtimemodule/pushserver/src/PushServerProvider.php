<?php

namespace realtimemodule\pushserver;

use Illuminate\Support\Collection;
use \Ratchet\MessageComponentInterface;
use \Ratchet\ConnectionInterface;
use realtimemodule\pushserver\Helpers\PushServerHelper;
use realtimemodule\pushserver\Factories\ConnecterFactory;

class PushServerProvider implements MessageComponentInterface
{

    const TYPE_GAME_WIN = 1;
    const TYPE_GAME_PLINKO = 2;
    const TYPE_GAME_LOTTO = 3;
    const TYPE_GAME_LOTTO_MB = 4;

    protected $clients;
    protected $connectionList;
    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
        $this->connectionList = new Collection;
    }
    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
        $this->identifyConnectionInfo($conn);
    }
    public function onMessage(ConnectionInterface $from, $message)
    {
        $resourceId = $from->resourceId;
        $connection = $this->connectionList->get($resourceId) ?? null;
        $messageInfo = PushServerHelper::extractJson($message);
        if (isset($messageInfo['type'])) {
            $connecter = ConnecterFactory::getConnection(PushServerHelper::unHash($messageInfo['type']));
            $connecter->setData($connection, $this->clients, $this->connectionList, $messageInfo, $from);
            $connection = $connecter->response();
            $this->connectionList->put($resourceId, $connection);
        } else {
            $from->send(json_encode([
                'code'      => 604,
                'success '  => false,
                'message'   => 'Không tìm thấy phương thức!'
            ]));
        }
    }
    public function onClose(ConnectionInterface $conn)
    {
        $this->connectionList->forget($conn->resourceId);
        $this->clients->detach($conn);
    }
    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        $this->connectionList->forget($conn->resourceId);
        echo $e->getMessage();
        $conn->close();
    }
    private function identifyConnectionInfo($conn)
    {
        parse_str($conn->httpRequest->getUri()->getQuery(), $clientInfoParam);
        $userId = PushServerHelper::unHash($clientInfoParam['auth_token'] ?? null);
        $itemConnection = [];
        $itemConnection['user_id'] = $userId;
        $this->connectionList->put($conn->resourceId, $itemConnection);
    }
}
