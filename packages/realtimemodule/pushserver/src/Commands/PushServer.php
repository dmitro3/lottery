<?php
namespace realtimemodule\pushserver\Commands;

use \realtimemodule\pushserver\PushServerProvider;
use Illuminate\Console\Command;
use \Ratchet\Http\HttpServer;
use \Ratchet\Server\IoServer;
use \Ratchet\WebSocket\WsServer;

class PushServer extends Command
{
    protected $signature = 'pushserver:run';

    protected $description = 'Start push server';

    public function __construct()
    {
        parent::__construct();
    }
    public function handle()
    {
        // $hLock=fopen(base_path("cronPushServer.lock"), "w+");
        // if(!flock($hLock, LOCK_EX | LOCK_NB)){
        //     die("Already running. Exiting...");
        // }
        try {
            $server = IoServer::factory(
                new HttpServer(
                    new WsServer(
                        new PushServerProvider()
                    )
                ),
                8080
            );
            $server->run();
        } catch (\Exception $e) {
            print_r($e);
        }
        // flock($hLock, LOCK_UN);
        // fclose($hLock);
        // unlink(base_path("cronPushServer.lock"));
    }
}