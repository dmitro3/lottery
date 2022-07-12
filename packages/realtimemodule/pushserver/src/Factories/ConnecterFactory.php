<?php
namespace realtimemodule\pushserver\Factories;
use Exception;
use realtimemodule\pushserver\Connecters\Games\GoWinGame;
use realtimemodule\pushserver\Connecters\Games\PlinkoConnector;
class ConnecterFactory {
	public static function getConnection($type)
	{
		if ($type == 1) {
			return new GoWinGame;
		}
		if ($type == 2) {
			return new PlinkoConnector;
		}
		throw new Exception("Method not exists!");
	}
}