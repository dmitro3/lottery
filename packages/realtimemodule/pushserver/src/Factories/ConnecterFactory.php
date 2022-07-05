<?php
namespace realtimemodule\pushserver\Factories;
use Exception;
use realtimemodule\pushserver\Connecters\Games\GoWinGame;
class ConnecterFactory {
	public static function getConnection($type)
	{
		if ($type == 1) {
			return new GoWinGame;
		}
		throw new Exception("Method not exists!");
	}
}